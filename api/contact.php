<?php
declare(strict_types=1);

require_once __DIR__ . '/db.php';

// ── Nagłówki ────────────────────────────────────
header('Content-Type: application/json; charset=utf-8');
header('X-Content-Type-Options: nosniff');

// Pre-flight CORS (jeśli strona i API są na różnych domenach)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('Allow: POST, OPTIONS');
    http_response_code(204);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'method_not_allowed']);
    exit;
}

// ── Odczyt danych ────────────────────────────────
$raw  = file_get_contents('php://input');
$body = json_decode($raw, true);

if (!is_array($body)) {
    http_response_code(400);
    echo json_encode(['error' => 'invalid_json']);
    exit;
}

$name    = trim(is_string($body['name']    ?? '') ? ($body['name']    ?? '') : '');
$tel     = trim(is_string($body['tel']     ?? '') ? ($body['tel']     ?? '') : '');
$email   = trim(is_string($body['email']   ?? '') ? ($body['email']   ?? '') : '');
$type    = trim(is_string($body['type']    ?? '') ? ($body['type']    ?? '') : '');
$message = trim(is_string($body['message'] ?? '') ? ($body['message'] ?? '') : '');
$source  = trim(is_string($body['source']  ?? '') ? ($body['source']  ?? '') : '');

// ── Walidacja po stronie serwera ─────────────────
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

if ($errors) {
    http_response_code(422);
    echo json_encode(['error' => 'validation', 'fields' => $errors]);
    exit;
}

// ── Rate limiting ─────────────────────────────────
try {
    $pdo = getDb();
    if (!checkRateLimit($pdo, $email)) {
        http_response_code(429);
        echo json_encode(['error' => 'rate_limit']);
        exit;
    }
} catch (Throwable $e) {
    error_log('[contact.php] DB error: ' . $e->getMessage());
    // Przy niedostępnej bazie blokuj ostrożnie — zwróć błąd serwera
    http_response_code(500);
    echo json_encode(['error' => 'db_error']);
    exit;
}

// ── Wysyłka maila ────────────────────────────────
$isWermado = ($source === 'wermado');
$subjectLabel = $isWermado ? "Zapytanie Wermado od {$name}" : "Zapytanie od {$name}";
$subject = '=?UTF-8?B?' . base64_encode($subjectLabel) . '?=';

$lines = [
    $isWermado ? 'Nowe zapytanie z formularza Wermado:' : 'Nowe zapytanie z formularza kontaktowego:',
    '',
    "Imię i nazwisko : {$name}",
    "Telefon         : {$tel}",
    "E-mail          : " . ($email !== '' ? $email : '(nie podano)'),
];
if (!$isWermado && $type !== '') {
    $lines[] = "Rodzaj kredytu  : {$type}";
}
$lines[] = '';
$lines[] = 'Wiadomość:';
$lines[] = ($message !== '' ? $message : '(brak wiadomości)');

$text = implode("\n", $lines);

$replyTo = ($email !== '') ? $email : MAIL_TO;
$headers = implode("\r\n", [
    'From: Formularz kontaktowy <' . MAIL_FROM . '>',
    'Reply-To: ' . $replyTo,
    'MIME-Version: 1.0',
    'Content-Type: text/plain; charset=UTF-8',
    'Content-Transfer-Encoding: base64',
]);

// mail() jest "best-effort" — błąd nie blokuje odpowiedzi 200
$sent = @mail(MAIL_TO, $subject, base64_encode($text), $headers);
if (!$sent) {
    error_log('[contact.php] mail() failed for: ' . MAIL_TO);
}

// Jeśli zapytanie pochodzi z formularza Wermado — wyślij kopię na adres Wermado
if ($isWermado) {
    @mail('a.muryn@wp.pl', $subject, base64_encode($text), $headers);
}

echo json_encode(['ok' => true]);
