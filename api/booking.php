<?php
declare(strict_types=1);

require_once __DIR__ . '/db.php';

// ── Nagłówki ────────────────────────────────────
header('Content-Type: application/json; charset=utf-8');
header('X-Content-Type-Options: nosniff');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('Allow: GET, POST, OPTIONS');
    http_response_code(204);
    exit;
}

// Inicjalizacja bazy i codzienny cleanup
try {
    $pdo = getDb();
    dailyCleanup($pdo);
} catch (Throwable $e) {
    error_log('[booking.php] DB init error: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode(['error' => 'db_unavailable', 'detail' => $e->getMessage()]);
    exit;
}

// ════════════════════════════════════════════════
//  GET — zwraca listę zajętych slotów (przyszłych)
// ════════════════════════════════════════════════
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    header('Cache-Control: public, max-age=300'); // 5 minut — sloty zmieniają się rzadko
    $stmt = $pdo->query(
        "SELECT slot FROM bookings
         WHERE slot >= strftime('%Y-%m-%d %H:00', 'now', 'localtime')
         ORDER BY slot"
    );
    $slots = $stmt->fetchAll(PDO::FETCH_COLUMN);
    echo json_encode(['booked' => $slots]);
    exit;
}

// ════════════════════════════════════════════════
//  POST — rezerwuje slot i wysyła maila
// ════════════════════════════════════════════════
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'method_not_allowed']);
    exit;
}

$raw  = file_get_contents('php://input');
$body = json_decode($raw, true);

if (!is_array($body)) {
    http_response_code(400);
    echo json_encode(['error' => 'invalid_json']);
    exit;
}

$name  = trim($body['name']  ?? '');
$tel   = trim($body['tel']   ?? '');
$email = trim(is_string($body['email'] ?? '') ? ($body['email'] ?? '') : '');
$topic = trim(is_string($body['topic'] ?? '') ? ($body['topic'] ?? '') : '');
$message  = trim(is_string($body['message'] ?? '') ? ($body['message'] ?? '') : '');
$date  = trim(is_string($body['date'] ?? '') ? ($body['date'] ?? '') : '');   // format: YYYY-MM-DD
$hour  = trim(is_string($body['hour'] ?? '') ? ($body['hour'] ?? '') : '');   // format: H:00 lub HH:00

// ── Walidacja ────────────────────────────────────
$errors = [];

if (!preg_match('/^\p{L}{2,}(\s+\p{L}{2,})+$/u', $name)) {
    $errors[] = 'invalid_name';
}
if (!preg_match('/^\+\d{11}$/', $tel)) {
    $errors[] = 'invalid_tel';
}
if ($email !== '' && !preg_match('/^[^\s@]+@[^\s@]+\.[^\s@]+$/', $email)) {
    $errors[] = 'invalid_email';
}
if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
    $errors[] = 'invalid_date';
}
if (!preg_match('/^\d{1,2}:00$/', $hour)) {
    $errors[] = 'invalid_hour';
}

if ($errors) {
    http_response_code(422);
    echo json_encode(['error' => 'validation', 'fields' => $errors]);
    exit;
}

// ── Zbuduj klucz slotu (format: YYYY-MM-DD HH:00) ──
$slotHour = (int) explode(':', $hour)[0];
$slot     = sprintf('%s %02d:00', $date, $slotHour);

// Sprawdź, czy slot jest w przyszłości
$slotDT = DateTime::createFromFormat('Y-m-d H:i', $slot);
$now    = new DateTime();
if (!$slotDT || $slotDT <= $now) {
    http_response_code(422);
    echo json_encode(['error' => 'slot_in_past']);
    exit;
}

// ── Rate limiting ─────────────────────────────────
if (!checkRateLimit($pdo, $email)) {
    http_response_code(429);
    echo json_encode(['error' => 'rate_limit']);
    exit;
}

// ── Zapis do bazy (PRIMARY KEY — nie duplikuje) ──
try {
    $stmt = $pdo->prepare('INSERT INTO bookings (slot) VALUES (?)');
    $stmt->execute([$slot]);
} catch (PDOException $e) {
    // UNIQUE constraint → ten termin jest już zajęty
    http_response_code(409);
    echo json_encode(['error' => 'slot_taken']);
    exit;
}

// ── Wysyłka maila z potwierdzeniem rezerwacji ────
$slotPretty = $slotDT->format('d.m.Y') . ' o ' . $hour;
$subject    = '=?UTF-8?B?' . base64_encode("Rezerwacja spotkania — {$name}") . '?=';

$text = implode("\n", [
    'Nowa rezerwacja spotkania:',
    '',
    "Imię i nazwisko : {$name}",
    "Telefon         : {$tel}",
    "E-mail          : {$email}",
    "Temat           : {$topic}",
    "Termin          : {$slotPretty}",
    '',
    'Dodatkowe informacje:',
    $message !== '' ? $message : '(brak dodatkowej wiadomości)',
]);

$replyTo = ($email !== '') ? $email : MAIL_TO;
$headers = implode("\r\n", [
    'From: Formularz rezerwacji <' . MAIL_FROM . '>',
    'Reply-To: ' . $replyTo,
    'MIME-Version: 1.0',
    'Content-Type: text/plain; charset=UTF-8',
    'Content-Transfer-Encoding: base64',
]);

// Mail wysyłamy "best-effort" — błąd nie blokuje odpowiedzi 200
mail(MAIL_TO, $subject, base64_encode($text), $headers);

echo json_encode(['ok' => true, 'slot' => $slot]);
