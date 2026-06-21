<?php
/**
 * Generator sitemap.xml — kredyty-koszalin.pl
 * 
 * Jak działa:
 *  - Skanuje katalogi /komentarze/ i /kalkulatory/ w poszukiwaniu podkatalogów z index.php
 *  - Pobiera datę: ze schema.org "dateModified", z meta article:modified_time,
 *    z komentarza <!-- dateModified: YYYY-MM-DD -->, lub z daty pliku (fallback)
 *  - Regeneruje sitemap.xml w głównym katalogu strony
 * 
 * Uruchomienie ręczne:  php generate_sitemap.php
 * Uruchomienie przez przeglądarkę: https://kredyty-koszalin.pl/generate_sitemap.php
 * CRON (codziennie o 3:00):  0 3 * * * php /ścieżka/do/generate_sitemap.php
 */

// ─── KONFIGURACJA ────────────────────────────────────────────────────────────

define('BASE_URL',      'https://kredyty-koszalin.pl');
define('BASE_DIR',      __DIR__);                        // katalog główny strony
define('SITEMAP_FILE',  BASE_DIR . '/sitemap.xml');
define('KOMENTARZE_DIR',  BASE_DIR . '/komentarze');
define('KALKULATORY_DIR', BASE_DIR . '/kalkulatory');

// ─── POMOCNICZA: odczyt dateModified z pliku PHP ─────────────────────────────
//
// Sprawdza w tej kolejności:
//   1. Pole "dateModified" w schema.org:                    "dateModified": "2026-06-07T..."
//   2. Meta tag Open Graph:    <meta property="article:modified_time" content="2026-06-20T...">
//   3. Komentarz HTML z ręcznie wpisaną datą:                <!-- dateModified: 2026-06-20 -->
//   4. Fallback — data modyfikacji pliku na serwerze (filemtime)

function extract_date_modified(string $filepath): string {
    $content = file_get_contents($filepath);

    if ($content !== false) {
        // 1. Schema.org — "dateModified": "2026-06-07T09:00:00+02:00"
        if (preg_match('/"dateModified"\s*:\s*"(\d{4}-\d{2}-\d{2})/', $content, $matches)) {
            return $matches[1];
        }

        // 2. Open Graph — <meta property="article:modified_time" content="2026-06-20T09:00:00+02:00">
        if (preg_match('/article:modified_time"\s+content="(\d{4}-\d{2}-\d{2})/', $content, $matches)) {
            return $matches[1];
        }

        // 3. Ręczny komentarz — <!-- dateModified: 2026-06-20 -->
        if (preg_match('/<!--\s*dateModified\s*:\s*(\d{4}-\d{2}-\d{2})\s*-->/', $content, $matches)) {
            return $matches[1];
        }
    }

    // Fallback — data modyfikacji pliku na serwerze
    return date('Y-m-d', filemtime($filepath));
}

// Strony statyczne — edytuj ręcznie jeśli dodajesz nowe sekcje
$static_pages = [
    [
        'loc'        => BASE_URL . '/',
        'lastmod'    => extract_date_modified(BASE_DIR . '/index.php'),
        'changefreq' => 'monthly',
        'priority'   => '1.0',
    ],
    [
        'loc'        => BASE_URL . '/komentarze/',
        'lastmod'    => extract_date_modified(KOMENTARZE_DIR . '/index.php'),
        'changefreq' => 'weekly',
        'priority'   => '0.8',
    ],
    [
        'loc'        => BASE_URL . '/kalkulatory/',
        'lastmod'    => extract_date_modified(KALKULATORY_DIR . '/index.php'),
        'changefreq' => 'weekly',
        'priority'   => '0.8',
    ],
    [
        'loc'        => BASE_URL . '/polityka-prywatnosci/',
        'lastmod'    => extract_date_modified(BASE_DIR . '/polityka-prywatnosci/index.php'),
        'changefreq' => 'yearly',
        'priority'   => '0.2',
    ],
];

// ─── FUNKCJA SKANUJĄCA PODKATALOGI ───────────────────────────────────────────

function scan_subpages(string $base_url_prefix, string $dir, string $changefreq, string $priority): array {
    $pages = [];

    if (!is_dir($dir)) {
        return $pages;
    }

    foreach (glob($dir . '/*', GLOB_ONLYDIR) as $subdir) {
        $index_php = $subdir . '/index.php';

        if (!file_exists($index_php)) {
            continue;
        }

        $pages[] = [
            'loc'        => $base_url_prefix . basename($subdir) . '/',
            'lastmod'    => extract_date_modified($index_php),
            'changefreq' => $changefreq,
            'priority'   => $priority,
        ];
    }

    // Sortujemy od najnowszego
    usort($pages, fn($a, $b) => strcmp($b['lastmod'], $a['lastmod']));

    return $pages;
}

// ─── SKANOWANIE /komentarze/ ─────────────────────────────────────────────────

$article_pages = scan_subpages(
    BASE_URL . '/komentarze/',
    KOMENTARZE_DIR,
    'monthly',
    '0.9'
);

// ─── SKANOWANIE /kalkulatory/ ────────────────────────────────────────────────

$calculator_pages = scan_subpages(
    BASE_URL . '/kalkulatory/',
    KALKULATORY_DIR,
    'monthly',
    '0.9'
);

// ─── BUDOWANIE XML ───────────────────────────────────────────────────────────

$all_pages = array_merge($static_pages, $article_pages, $calculator_pages);

$xml  = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
$xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n\n";

foreach ($all_pages as $page) {
    $xml .= "  <url>\n";
    $xml .= "    <loc>"        . htmlspecialchars($page['loc'])        . "</loc>\n";
    $xml .= "    <lastmod>"    . htmlspecialchars($page['lastmod'])    . "</lastmod>\n";
    $xml .= "    <changefreq>" . htmlspecialchars($page['changefreq']) . "</changefreq>\n";
    $xml .= "    <priority>"   . htmlspecialchars($page['priority'])   . "</priority>\n";
    $xml .= "  </url>\n\n";
}

$xml .= '</urlset>' . "\n";

// ─── ZAPIS PLIKU ─────────────────────────────────────────────────────────────

$result = file_put_contents(SITEMAP_FILE, $xml);

// ─── ODPOWIEDŹ ───────────────────────────────────────────────────────────────

$count           = count($all_pages);
$static_count    = count($static_pages);
$article_count   = count($article_pages);
$calculator_count = count($calculator_pages);

if (PHP_SAPI === 'cli') {
    // Uruchomienie z terminala / CRON
    if ($result !== false) {
        echo "[OK] sitemap.xml zaktualizowany — {$count} URL-i ({$article_count} artykułów + {$calculator_count} kalkulatorów + {$static_count} stałych stron)\n";
        echo "[OK] Plik: " . SITEMAP_FILE . "\n";
    } else {
        echo "[BŁĄD] Nie można zapisać sitemap.xml — sprawdź uprawnienia do pliku.\n";
        exit(1);
    }
} else {
    // Uruchomienie przez przeglądarkę
    header('Content-Type: text/plain; charset=UTF-8');
    if ($result !== false) {
        echo "✅ sitemap.xml zaktualizowany\n\n";
        echo "Łącznie URL-i:   {$count}\n";
        echo "Artykuły:        {$article_count}\n";
        echo "Kalkulatory:     {$calculator_count}\n";
        echo "Stałe strony:    {$static_count}\n\n";
        echo "Wygenerowane URL-i:\n";
        foreach ($all_pages as $p) {
            echo "  " . $p['loc'] . "  [{$p['lastmod']}]\n";
        }
    } else {
        http_response_code(500);
        echo "❌ Błąd: nie można zapisać sitemap.xml\n";
        echo "Sprawdź uprawnienia do pliku (chmod 644 sitemap.xml)\n";
    }
}
