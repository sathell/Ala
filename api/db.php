<?php
declare(strict_types=1);

// ═══════════════════════════════════════════════
//  KONFIGURACJA
// ═══════════════════════════════════════════════
define('MAIL_TO',      'alicja.muryn@outlook.com');
define('MAIL_FROM',    'noreply@kredyty-koszalin.pl');

define('DB_PATH',      __DIR__ . '/db/bookings.db');
define('CLEANUP_FLAG', __DIR__ . '/db/.last_cleanup');

// ═══════════════════════════════════════════════
//  BAZA DANYCH
// ═══════════════════════════════════════════════

/**
 * Zwraca połączenie PDO z bazą SQLite.
 * Jeśli plik lub katalog nie istnieje – tworzy je.
 */
function getDb(): PDO
{
    $dir = dirname(DB_PATH);
    if (!is_dir($dir)) {
        if (!mkdir($dir, 0755, true) && !is_dir($dir)) {
            throw new \RuntimeException('Nie można utworzyć katalogu bazy: ' . $dir);
        }
    }
    if (!is_writable($dir)) {
        throw new \RuntimeException('Katalog bazy nie jest zapisywalny: ' . $dir);
    }

    $pdo = new PDO('sqlite:' . DB_PATH);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Jedna tabela, jedna kolumna: zajęte sloty w formacie "YYYY-MM-DD HH:00"
    $pdo->exec(
        'CREATE TABLE IF NOT EXISTS bookings (
             slot TEXT NOT NULL PRIMARY KEY
         )'
    );

    // Tabela do ograniczania liczby wysłanych maili (rate limiting)
    $pdo->exec(
        'CREATE TABLE IF NOT EXISTS rate_limits (
             id        INTEGER PRIMARY KEY AUTOINCREMENT,
             email     TEXT    NOT NULL,
             sent_date TEXT    NOT NULL
         )'
    );
    $pdo->exec(
        'CREATE INDEX IF NOT EXISTS idx_rl_email_date ON rate_limits (email, sent_date)'
    );

    return $pdo;
}

/**
 * Sprawdza limit wysłanych maili dla danego adresu e-mail (max $maxPerDay dziennie).
 * Jeśli limit nie jest przekroczony — zapisuje wpis i zwraca true.
 * Jeśli limit jest przekroczony — zwraca false.
 * Gdy email jest pusty (pole opcjonalne), używa adresu IP jako klucza.
 */
function checkRateLimit(PDO $pdo, string $email, int $maxPerDay = 3): bool
{
    // Klucz: email (jeśli podany) + IP — oba muszą zmieścić się w limicie
    $ip    = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    $key   = ($email !== '') ? strtolower($email) : $ip;
    $today = date('Y-m-d');

    $stmt = $pdo->prepare(
        'SELECT COUNT(*) FROM rate_limits WHERE email = ? AND sent_date = ?'
    );
    $stmt->execute([$key, $today]);
    $count = (int) $stmt->fetchColumn();

    if ($count >= $maxPerDay) {
        return false;
    }

    $ins = $pdo->prepare(
        'INSERT INTO rate_limits (email, sent_date) VALUES (?, ?)'
    );
    $ins->execute([$key, $today]);

    return true;
}

/**
 * Raz dziennie usuwa z bazy rekordy ze slotami, które już minęły.
 * Sprawdza flagę w pliku, żeby nie wykonywać cleanup przy każdym żądaniu.
 */
function dailyCleanup(PDO $pdo): void
{
    $today = date('Y-m-d');

    if (is_file(CLEANUP_FLAG) && trim(file_get_contents(CLEANUP_FLAG)) === $today) {
        return; // cleanup już był dziś
    }

    // Usuwa sloty, których godzina już minęła (czas lokalny serwera)
    $pdo->exec(
        "DELETE FROM bookings
         WHERE slot < strftime('%Y-%m-%d %H:00', 'now', 'localtime')"
    );

    file_put_contents(CLEANUP_FLAG, $today);
}
