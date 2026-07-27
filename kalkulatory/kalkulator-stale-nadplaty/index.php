<?php
// Dzisiejsza data liczona po stronie serwera — zasila podpowiedź "który to numer raty".
$dzisiajISO = date('Y-m-d');
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="/media/main-icon.png" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator stałych nadpłat kredytu hipotecznego — Alicja Muryn | Ekspert Kredytowy Koszalin</title>
    <meta name="description"
        content="Podaj kwotę, okres i oprocentowanie kredytu — kalkulator sam wyliczy aktualne saldo i pokaże, ile zaoszczędzisz dzięki regularnym, stałym nadpłatom miesięcznym.">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Alicja Muryn">
    <link rel="canonical" href="https://kredyty-koszalin.pl/kalkulatory/nadplata-stala/">

    <meta property="og:type" content="website">
    <meta property="og:url" content="https://kredyty-koszalin.pl/kalkulatory/nadplata-stala/">
    <meta property="og:title" content="Kalkulator stałych nadpłat kredytu hipotecznego — Alicja Muryn">
    <meta property="og:description"
        content="Oblicz efekt regularnych, comiesięcznych nadpłat kredytu hipotecznego — bez podawania aktualnego salda.">
    <meta property="og:image" content="https://kredyty-koszalin.pl/media/og-image.jpg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:locale" content="pl_PL">
    <meta property="og:site_name" content="Ekspert Kredytowy Koszalin">

    <script type="application/ld+json">
    [
      {
        "@context": "https://schema.org",
        "@type": "WebPage",
        "name": "Kalkulator stałych nadpłat kredytu hipotecznego",
        "description": "Oblicz efekt regularnych, comiesięcznych nadpłat kredytu hipotecznego bez podawania aktualnego salda.",
        "url": "https://kredyty-koszalin.pl/kalkulatory/nadplata-stala/",
        "inLanguage": "pl",
        "author": { "@type": "Person", "name": "Alicja Muryn", "url": "https://kredyty-koszalin.pl" }
      },
      {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [
          { "@type": "ListItem", "position": 1, "name": "Strona główna", "item": "https://kredyty-koszalin.pl" },
          { "@type": "ListItem", "position": 2, "name": "Kalkulatory", "item": "https://kredyty-koszalin.pl/kalkulatory/" },
          { "@type": "ListItem", "position": 3, "name": "Kalkulator stałych nadpłat", "item": "https://kredyty-koszalin.pl/kalkulatory/nadplata-stala/" }
        ]
      }
    ]
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;1,300;1,400&family=Jost:wght@300;400;500&display=swap"
        media="print" onload="this.media='all'">
    <noscript>
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;1,300;1,400&family=Jost:wght@300;400;500&display=swap">
    </noscript>
    <link rel="stylesheet" href="/main.css">
    <link rel="stylesheet" href="/kalkulatory/kalkulatory.css">
    <style>
        /* --- komponenty przejęte 1:1 z kalkulatora nadpłaty jednorazowej --- */
        .kalk-alert {
            grid-column: 1 / -1;
            margin-top: 6px;
            padding: 14px 18px;
            border-radius: 8px;
            border-left: 4px solid;
            font-family: 'Jost', sans-serif;
            font-size: 0.95rem;
            line-height: 1.55;
        }

        .kalk-alert strong {
            display: block;
            margin-bottom: 4px;
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.15rem;
            font-weight: 500;
        }

        .kalk-alert--error {
            background: #fdecec;
            border-left-color: #c0392b;
            color: #7a1f17;
        }

        .kalk-alert--warning {
            background: #fff5e6;
            border-left-color: #e08a1e;
            color: #6e4a0e;
        }

        .kalk-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .kalk-teaser {
            margin-top: 28px;
            padding: 22px 24px;
            border: 1px solid rgba(0, 0, 0, 0.09);
            border-radius: 10px;
            background: rgba(0, 0, 0, 0.02);
        }

        .kalk-teaser-label {
            font-family: 'Jost', sans-serif;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            opacity: 0.6;
            margin-bottom: 8px;
        }

        .kalk-teaser-title {
            font-family: 'Cormorant Garamond', serif;
            font-weight: 500;
            font-size: 1.35rem;
            line-height: 1.3;
            margin: 0 0 10px;
        }

        .kalk-teaser-text {
            margin: 0 0 14px;
            line-height: 1.65;
        }

        .kalk-teaser-link {
            font-family: 'Jost', sans-serif;
            font-weight: 500;
            text-decoration: underline;
            text-underline-offset: 3px;
        }

        /* --- nowe komponenty potrzebne dla kalkulatora stałych nadpłat --- */
        .kalk-pillrow {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin: 8px 0 4px;
        }

        .kalk-pill {
            font-family: 'Jost', sans-serif;
            font-size: 0.85rem;
            padding: 7px 16px;
            border-radius: 999px;
            border: 1px solid rgba(0, 0, 0, 0.15);
            background: #fff;
            cursor: pointer;
            transition: all .15s ease;
            user-select: none;
        }

        .kalk-pill:hover {
            border-color: rgba(0, 0, 0, 0.35);
        }

        .kalk-pill.active {
            background: var(--dark);
            border-color: var(--dark);
            color: #fff;
        }

        .kalk-substep-label {
            font-family: 'Jost', sans-serif;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            opacity: 0.55;
            margin: 16px 0 2px;
        }

        .kalk-slider-wrap {
            margin-top: 4px;
        }

        .kalk-slider-wrap input[type=range] {
            width: 100%;
            accent-color: var(--dark);
        }

        .kalk-slider-read {
            font-family: 'Jost', sans-serif;
            font-size: 0.85rem;
            text-align: right;
            opacity: 0.7;
            margin-top: 2px;
        }

        .kalk-ministats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
            margin-top: 14px;
        }

        .kalk-ministat {
            background: rgba(0, 0, 0, 0.03);
            border-radius: 8px;
            padding: 10px 12px;
        }

        .kalk-ministat-label {
            font-family: 'Jost', sans-serif;
            font-size: 0.68rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            opacity: 0.55;
        }

        .kalk-ministat-val {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.25rem;
            font-weight: 500;
        }

        .kalk-tape {
            margin-top: 22px;
            padding: 20px 24px;
            border: 1px solid rgba(0, 0, 0, 0.09);
            border-radius: 10px;
            background: repeating-linear-gradient(45deg, #fff, #fff 10px, rgba(0, 0, 0, 0.015) 10px, rgba(0, 0, 0, 0.015) 20px);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
        }

        .kalk-tape-label {
            font-family: 'Jost', sans-serif;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            opacity: 0.55;
        }

        .kalk-tape-val {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.7rem;
            font-weight: 500;
            margin-top: 2px;
        }

        .kalk-tape-side {
            font-family: 'Jost', sans-serif;
            font-size: 0.9rem;
            text-align: right;
            opacity: 0.75;
        }

        .kalk-chart-block {
            margin-top: 26px;
        }

        .kalk-chart-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.25rem;
            font-weight: 500;
            margin-bottom: 2px;
        }

        .kalk-chart-sub {
            font-family: 'Jost', sans-serif;
            font-size: 0.8rem;
            opacity: 0.55;
            margin-bottom: 8px;
        }

        .kalk-chart-canvas-wrap {
            border: 1px solid rgba(0, 0, 0, 0.08);
            border-radius: 8px;
            padding: 12px;
            background: #fff;
        }

        .kalk-chart-legend {
            display: flex;
            gap: 18px;
            margin-top: 8px;
            font-family: 'Jost', sans-serif;
            font-size: 0.8rem;
        }

        .kalk-chart-legend span {
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .kalk-chart-legend i {
            width: 12px;
            height: 12px;
            border-radius: 2px;
            display: inline-block;
        }

        .kalk-scenario-table,
        .kalk-expert-table,
        .kalk-schedule-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-family: 'Jost', sans-serif;
            font-size: 0.88rem;
        }

        .kalk-scenario-table th,
        .kalk-expert-table th,
        .kalk-schedule-table th {
            text-align: right;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            opacity: 0.55;
            font-weight: 500;
            padding: 6px 10px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.09);
            white-space: nowrap;
        }

        .kalk-scenario-table th:first-child,
        .kalk-expert-table th:first-child,
        .kalk-schedule-table th:first-child,
        .kalk-scenario-table td:first-child,
        .kalk-expert-table td:first-child,
        .kalk-schedule-table td:first-child {
            text-align: left;
        }

        .kalk-scenario-table td,
        .kalk-expert-table td,
        .kalk-schedule-table td {
            text-align: right;
            padding: 6px 10px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            white-space: nowrap;
        }

        .kalk-expert-table tr.is-active td {
            background: rgba(0, 0, 0, 0.035);
            font-weight: 600;
        }

        /* Zabezpieczenie na wypadek, gdyby .kalk-table-wrap na tej podstronie nie
           odziedziczyło reguły przewijania z głównego arkusza — bez tego tabele
           na mobile ściskają kolumny do nieczytelności zamiast przewijać się w bok. */
        .kalk-table-wrap {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .kalk-schedule-table {
            min-width: 620px;
        }

        .kalk-expert-table {
            min-width: 440px;
        }

        .kalk-scenario-table {
            min-width: 380px;
        }

        @media (max-width: 480px) {

            .kalk-scenario-table,
            .kalk-expert-table,
            .kalk-schedule-table {
                font-size: 0.82rem;
            }

            .kalk-scenario-table th,
            .kalk-expert-table th,
            .kalk-schedule-table th,
            .kalk-scenario-table td,
            .kalk-expert-table td,
            .kalk-schedule-table td {
                padding: 6px 8px;
            }
        }

        .kalk-toggle-link {
            display: inline-block;
            margin-top: 10px;
            font-family: 'Jost', sans-serif;
            font-size: 0.85rem;
            text-decoration: underline;
            text-underline-offset: 3px;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <div class="mobile-back-bar">
        <a href="/kalkulatory/">Powrót do kalkulatorów</a>
    </div>

    <div class="outer">
        <div class="page">

            <main class="content">

                <div class="page-header">
                    <a class="page-back" href="/kalkulatory/">Wróć do kalkulatorów</a>
                    <div class="stag">Kalkulator 02</div>
                    <h1 class="page-title">Kalkulator stałych nadpłat kredytu hipotecznego</h1>
                    <p class="page-lead">Nie musisz znać aktualnego salda. Podaj kwotę kredytu, okres, oprocentowanie i
                        miesiąc uruchomienia — resztę, łącznie z dzisiejszym saldem, policzy kalkulator na podstawie
                        pełnego harmonogramu spłat.</p>
                    <div class="rule"></div>
                </div>

                <!-- SEKCJA 1: DANE KREDYTU -->
                <div class="kalk-block">
                    <div class="kalk-block-title">Dane kredytu</div>
                    <div class="kalk-grid">
                        <div class="kalk-field">
                            <label for="kwota">Kwota kredytu</label>
                            <div class="kalk-input-wrap">
                                <input type="number" id="kwota" value="500000" min="10000" step="10000">
                                <span class="unit">PLN</span>
                            </div>
                        </div>
                        <div class="kalk-field">
                            <label for="okres">Okres kredytowania</label>
                            <div class="kalk-input-wrap">
                                <input type="number" id="okres" value="30" min="1" max="40" step="1">
                                <span class="unit">lat</span>
                            </div>
                        </div>
                        <div class="kalk-field">
                            <label for="oprocentowanie">Oprocentowanie</label>
                            <div class="kalk-input-wrap">
                                <input type="number" id="oprocentowanie" value="7.15" min="0.1" max="30" step="0.05">
                                <span class="unit">% rocznie</span>
                            </div>
                        </div>
                        <div class="kalk-field">
                            <label for="miesiac-start">Miesiąc rozpoczęcia spłaty</label>
                            <div class="kalk-input-wrap" style="gap:8px;">
                                <select id="miesiac-start">
                                    <option value="0">styczeń</option>
                                    <option value="1">luty</option>
                                    <option value="2">marzec</option>
                                    <option value="3">kwiecień</option>
                                    <option value="4">maj</option>
                                    <option value="5">czerwiec</option>
                                    <option value="6" selected>lipiec</option>
                                    <option value="7">sierpień</option>
                                    <option value="8">wrzesień</option>
                                    <option value="9">październik</option>
                                    <option value="10">listopad</option>
                                    <option value="11">grudzień</option>
                                </select>
                                <input type="number" id="rok-start" value="2023" min="1990" max="2035" step="1"
                                    style="max-width:90px;">
                            </div>
                        </div>
                    </div>

                    <!-- SEKCJA 2: GDZIE JESTEŚ DZIŚ -->
                    <div class="kalk-block-title">Gdzie jesteś dziś?</div>
                    <p class="kalk-hint" style="margin-top:-6px;">Podpowiedź liczona względem dzisiejszej daty — możesz
                        ją skorygować suwakiem.</p>
                    <div class="kalk-slider-wrap">
                        <input type="range" id="numer-raty" min="0" max="360" value="0">
                        <div class="kalk-slider-read" id="numer-raty-read">rata nr 0</div>
                    </div>
                    <div class="kalk-ministats">
                        <div class="kalk-ministat">
                            <div class="kalk-ministat-label">Aktualne saldo</div>
                            <div class="kalk-ministat-val" id="ms-saldo">—</div>
                        </div>
                        <div class="kalk-ministat">
                            <div class="kalk-ministat-label">Spłacony kapitał</div>
                            <div class="kalk-ministat-val" id="ms-kapital">—</div>
                        </div>
                        <div class="kalk-ministat">
                            <div class="kalk-ministat-label">Zapłacone odsetki</div>
                            <div class="kalk-ministat-val" id="ms-odsetki">—</div>
                        </div>
                        <div class="kalk-ministat">
                            <div class="kalk-ministat-label">Rata bez nadpłat</div>
                            <div class="kalk-ministat-val" id="ms-rata">—</div>
                        </div>
                    </div>

                    <!-- SEKCJA 3: NADPŁATA -->
                    <div class="kalk-block-title">Nadpłata</div>

                    <div class="kalk-substep-label">Stała kwota miesięczna</div>
                    <div class="kalk-pillrow" id="pillrow-kwota">
                        <div class="kalk-pill" data-val="300">300 zł</div>
                        <div class="kalk-pill active" data-val="500">500 zł</div>
                        <div class="kalk-pill" data-val="1000">1000 zł</div>
                        <div class="kalk-pill" data-val="1500">1500 zł</div>
                    </div>
                    <div class="kalk-field" style="margin-top:8px;">
                        <div class="kalk-input-wrap">
                            <input type="number" id="nadplata-custom" placeholder="własna kwota" min="0" step="50">
                            <span class="unit">PLN</span>
                        </div>
                    </div>

                    <div class="kalk-substep-label">Od kiedy?</div>
                    <div class="kalk-pillrow" id="pillrow-kiedy">
                        <div class="kalk-pill active" data-val="0">od razu</div>
                        <div class="kalk-pill" data-val="3">za 3 miesiące</div>
                        <div class="kalk-pill" data-val="12">za rok</div>
                    </div>

                    <div class="kalk-substep-label">Cel nadpłaty</div>
                    <div class="kalk-pillrow" id="pillrow-cel">
                        <div class="kalk-pill active" data-val="skrocenie">Skrócenie okresu</div>
                        <div class="kalk-pill" data-val="obnizenie">Obniżenie raty</div>
                    </div>

                    <button class="kalk-btn" id="oblicz-btn" onclick="oblicz(true)" style="margin-top:18px;">Oblicz
                        efekt nadpłaty</button>

                    <!-- WYNIKI -->
                    <div class="kalk-results visible" id="wyniki">

                        <div class="kalk-metrics">
                            <div class="kalk-metric">
                                <div class="kalk-metric-label">Pozostało rat (bez nadpłat)</div>
                                <div class="kalk-metric-val" id="r-raty-bez">—</div>
                                <div class="kalk-metric-sub">do końca kredytu</div>
                            </div>
                            <div class="kalk-metric">
                                <div class="kalk-metric-label">Odsetki do zapłaty (bez nadpłat)</div>
                                <div class="kalk-metric-val" id="r-odsetki-bez">—</div>
                                <div class="kalk-metric-sub">łącznie</div>
                            </div>
                            <div class="kalk-metric kalk-metric--accent">
                                <div class="kalk-metric-label">Pozostało rat (z nadpłatą)</div>
                                <div class="kalk-metric-val" id="r-raty-po">—</div>
                                <div class="kalk-metric-sub" id="r-skrocenie">—</div>
                            </div>
                            <div class="kalk-metric kalk-metric--accent">
                                <div class="kalk-metric-label">Oszczędność na odsetkach</div>
                                <div class="kalk-metric-val" id="r-oszczednosc">—</div>
                                <div class="kalk-metric-sub">dzięki nadpłacie</div>
                            </div>
                        </div>

                        <div class="kalk-tape">
                            <div>
                                <div class="kalk-tape-label">Taśma sumująca · efekt nadpłaty</div>
                                <div class="kalk-tape-val" id="tape-oszczednosc">—</div>
                            </div>
                            <div class="kalk-tape-side" id="tape-skrocenie">—</div>
                        </div>

                        <!-- CO BY BYŁO GDYBY -->
                        <div class="kalk-chart-block">
                            <div class="kalk-chart-title">Co by było, gdyby…</div>
                            <p id="gdyby-tekst"
                                style="font-family:'Jost',sans-serif; font-size:0.92rem; line-height:1.6;">—
                            </p>
                            <div class="kalk-table-wrap">
                                <table class="kalk-scenario-table">
                                    <thead>
                                        <tr>
                                            <th>Rozpoczęcie nadpłat</th>
                                            <th>Oszczędność odsetkowa</th>
                                        </tr>
                                    </thead>
                                    <tbody id="scenario-body"></tbody>
                                </table>
                            </div>
                        </div>

                        <!-- WYKRESY -->
                        <div class="kalk-chart-block">
                            <div class="kalk-chart-title">Saldo kredytu w czasie</div>
                            <div class="kalk-chart-sub">linia bez nadpłat vs. z nadpłatami</div>
                            <div class="kalk-chart-canvas-wrap"><canvas id="chart-saldo" height="220"></canvas></div>
                            <div class="kalk-chart-legend">
                                <span><i style="background:#b08650;"></i>bez nadpłat</span>
                                <span><i style="background:#1f2a20;"></i>z nadpłatami</span>
                            </div>
                        </div>

                        <div class="kalk-chart-block">
                            <div class="kalk-chart-title">Suma zapłaconych odsetek</div>
                            <div class="kalk-chart-sub">narastająco, bez nadpłat vs. z nadpłatami</div>
                            <div class="kalk-chart-canvas-wrap"><canvas id="chart-odsetki" height="220"></canvas></div>
                            <div class="kalk-chart-legend">
                                <span><i style="background:#b08650;"></i>bez nadpłat</span>
                                <span><i style="background:#1f2a20;"></i>z nadpłatami</span>
                            </div>
                        </div>

                        <div class="kalk-chart-block">
                            <div class="kalk-chart-title">Struktura raty (wariant z nadpłatą)</div>
                            <div class="kalk-chart-sub">udział kapitału i odsetek w racie miesięcznej</div>
                            <div class="kalk-chart-canvas-wrap"><canvas id="chart-struktura" height="220"></canvas>
                            </div>
                            <div class="kalk-chart-legend">
                                <span><i style="background:#1f2a20;"></i>kapitał + nadpłata</span>
                                <span><i style="background:#b08650;"></i>odsetki</span>
                            </div>
                        </div>

                        <!-- KOMENTARZ EDUKACYJNY -->
                        <div class="kalk-rec">
                            <div class="kalk-rec-rule"></div>
                            <div>
                                <div class="kalk-rec-title" id="rec-title">—</div>
                                <p class="kalk-rec-text" id="rec-text">—</p>
                            </div>
                        </div>

                        <!-- PORÓWNANIE WARIANTÓW -->
                        <div class="kalk-chart-block">
                            <div class="kalk-chart-title">Porównaj kilka wariantów nadpłaty</div>
                            <div class="kalk-table-wrap">
                                <table class="kalk-expert-table">
                                    <thead>
                                        <tr>
                                            <th>Nadpłata</th>
                                            <th>Koniec kredytu</th>
                                            <th>Odsetki łącznie</th>
                                        </tr>
                                    </thead>
                                    <tbody id="expert-body"></tbody>
                                </table>
                            </div>
                        </div>

                        <!-- CZY WARTO ZWIĘKSZYĆ NADPŁATĘ -->
                        <div class="kalk-chart-block">
                            <div class="kalk-chart-title">Czy warto zwiększyć nadpłatę?</div>
                            <div class="kalk-chart-sub" id="worth-sub">—</div>
                            <div class="kalk-table-wrap">
                                <table class="kalk-expert-table">
                                    <thead>
                                        <tr>
                                            <th>Wariant</th>
                                            <th>Dodatkowe miesiące</th>
                                            <th>Dodatkowa oszczędność</th>
                                        </tr>
                                    </thead>
                                    <tbody id="worth-body"></tbody>
                                </table>
                            </div>
                        </div>

                        <!-- HARMONOGRAM -->
                        <div class="kalk-chart-block">
                            <div class="kalk-chart-title">Harmonogram spłat</div>
                            <div class="kalk-table-wrap">
                                <table class="kalk-schedule-table">
                                    <thead>
                                        <tr>
                                            <th>Rata</th>
                                            <th>Saldo</th>
                                            <th>Kapitał</th>
                                            <th>Odsetki</th>
                                            <th>Nadpłata</th>
                                            <th>Nowe saldo</th>
                                        </tr>
                                    </thead>
                                    <tbody id="schedule-body"></tbody>
                                </table>
                            </div>
                            <span class="kalk-toggle-link" id="schedule-toggle" onclick="toggleSchedule()">Pokaż pełny
                                harmonogram</span>
                        </div>

                    </div>
                    <!-- /WYNIKI -->

                    <div class="kalk-disclaimer">
                        <p><strong>Uwaga:</strong> Kalkulator zakłada stałe oprocentowanie przez cały okres kredytowania
                            i
                            brak wcześniejszych nadpłat lub zmian oprocentowania — na tej podstawie szacuje aktualne
                            saldo.
                            Wyniki mają charakter informacyjny i poglądowy. Rzeczywiste warunki (w tym ewentualna
                            prowizja
                            za nadpłatę w pierwszych 3 latach umowy) zależą od Twojego banku. Skontaktuj się ze swoim
                            bankiem lub doradcą kredytowym przed podjęciem decyzji.</p>
                    </div>

                    <div class="kalk-teaser">
                        <div class="kalk-teaser-label">Komentarz eksperta</div>
                        <div class="kalk-teaser-title">Regularna nadpłata kontra jednorazowa wpłata — co daje większą
                            oszczędność?</div>
                        <p class="kalk-teaser-text">Jednorazowa wpłata robi wrażenie, ale to regularność i moment startu
                            nadpłat mają zwykle większy wpływ na całkowity koszt kredytu. Sprawdź, jak niewielka,
                            systematyczna kwota miesięcznie zmienia harmonogram na przestrzeni lat.</p>
                        <a href="/komentarze/nadplata-kredytu-hipotecznego/" class="kalk-teaser-link">Czytaj cały
                            komentarz
                            →</a>
                    </div>

                    <div class="kalk-cta">
                        <div class="kalk-cta-title">Chcesz omówić strategię nadpłat?</div>
                        <p class="kalk-cta-text">Pomogę Ci dobrać optymalną strategię nadpłat do Twojej sytuacji —
                            bezpłatnie, bez zobowiązań.</p>
                        <a href="/kontakt/" class="kalk-cta-btn">Umów konsultację</a>
                    </div>
                </div>

            </main>
            <?php include __DIR__ . '/../../komponenty/pasek-boczny-komentarze.php'; ?>
        </div>
    </div>

    <?php include __DIR__ . '/../../komponenty/stopka.php'; ?>

    <script>
        const DZISIAJ = new Date('<?php echo $dzisiajISO; ?>');
        const MIESIACE_PL = ['styczeń', 'luty', 'marzec', 'kwiecień', 'maj', 'czerwiec', 'lipiec', 'sierpień', 'wrzesień', 'październik', 'listopad', 'grudzień'];

        let fullSchedule = false;

        // --- FORMATOWANIE ---------------------------------------------------------
        function fmt(n) { return Math.round(n).toLocaleString('pl-PL') + ' zł'; }
        function fmtLat(mies) {
            const l = Math.floor(mies / 12);
            const m = Math.round(mies % 12);
            if (l === 0) return m + ' mies.';
            if (m === 0) return l + ' ' + slowoLat(l);
            return l + ' ' + slowoLat(l) + ' ' + m + ' mies.';
        }
        function slowoLat(l) {
            if (l === 1) return 'rok';
            const last = l % 10, last2 = l % 100;
            if (last2 >= 12 && last2 <= 14) return 'lat';
            if (last >= 2 && last <= 4) return 'lata';
            return 'lat';
        }

        // --- SILNIK AMORTYZACJI ----------------------------------------------------
        function stopaMiesieczna(procRoczny) { return procRoczny / 100 / 12; }
        function rataRowna(P, rm, n) {
            if (n <= 0) return P;
            if (rm === 0) return P / n;
            const f = Math.pow(1 + rm, n);
            return P * rm * f / (f - 1);
        }
        function zbudujHarmonogramBazowy(P, procRoczny, n) {
            const rm = stopaMiesieczna(procRoczny);
            const rata = rataRowna(P, rm, n);
            let saldo = P;
            const rows = [];
            for (let i = 1; i <= n; i++) {
                const odsetki = saldo * rm;
                let kapital = rata - odsetki;
                if (kapital > saldo || i === n) kapital = saldo;
                saldo = Math.max(0, saldo - kapital);
                rows.push({ mies: i, rata: kapital + odsetki, odsetki, kapital, saldo });
                if (saldo <= 0) break;
            }
            return { rm, rata, rows };
        }
        // Symuluje spłatę od zadanego salda startowego z nadpłatą uruchamianą po `offset` miesiącach
        function symulujDalej(saldoStart, rm, rataBazowa, pozostaloMiesiecyBaz, nadplata, offset, cel) {
            let saldo = saldoStart;
            let rataBiez = rataBazowa;
            let sumaOdsetek = 0;
            const rows = [];
            let i = 0;
            while (saldo > 0.5 && i < 2000) {
                i++;
                const odsetki = saldo * rm;
                let kapital = rataBiez - odsetki;
                const naNadplate = i > offset ? nadplata : 0;
                let redukcja = kapital + naNadplate;
                if (redukcja >= saldo) { redukcja = saldo; kapital = Math.min(kapital, saldo); }
                const faktycznaNadplata = Math.max(0, redukcja - kapital);
                sumaOdsetek += odsetki;
                saldo = Math.max(0, saldo - redukcja);
                rows.push({ mies: i, odsetki, kapital, nadplata: faktycznaNadplata, saldo });
                if (cel === 'obnizenie' && faktycznaNadplata > 0 && saldo > 0) {
                    const pozostalo = pozostaloMiesiecyBaz - i;
                    if (pozostalo > 0) rataBiez = rataRowna(saldo, rm, pozostalo);
                }
                if (saldo <= 0) break;
            }
            return { rows, sumaOdsetek, miesiecy: i };
        }

        // --- ODCZYT STANU UI --------------------------------------------------------
        function pobierzAktywny(rowId) {
            const el = document.querySelector('#' + rowId + ' .kalk-pill.active');
            return el ? el.dataset.val : null;
        }
        function ustawPillrow(rowId, callback) {
            document.querySelectorAll('#' + rowId + ' .kalk-pill').forEach(function (p) {
                p.addEventListener('click', function () {
                    document.querySelectorAll('#' + rowId + ' .kalk-pill').forEach(function (x) { x.classList.remove('active'); });
                    p.classList.add('active');
                    if (callback) callback();
                });
            });
        }
        ustawPillrow('pillrow-kwota', function () { document.getElementById('nadplata-custom').value = ''; aktualizujStanBiezacy(); });
        ustawPillrow('pillrow-kiedy', aktualizujStanBiezacy);
        ustawPillrow('pillrow-cel', aktualizujStanBiezacy);
        document.getElementById('nadplata-custom').addEventListener('input', aktualizujStanBiezacy);

        function pobierzNadplate() {
            const custom = document.getElementById('nadplata-custom').value;
            if (custom !== '') return Number(custom) || 0;
            return Number(pobierzAktywny('pillrow-kwota'));
        }

        // --- SUGESTIA NUMERU RATY NA PODSTAWIE DATY --------------------------------
        function przelicznumerRatySugestia() {
            const rok = Number(document.getElementById('rok-start').value);
            const mies = Number(document.getElementById('miesiac-start').value);
            const start = new Date(rok, mies, 1);
            let diff = (DZISIAJ.getFullYear() - start.getFullYear()) * 12 + (DZISIAJ.getMonth() - start.getMonth());
            const n = Number(document.getElementById('okres').value) * 12;
            diff = Math.max(0, Math.min(diff, n));
            document.getElementById('numer-raty').max = n;
            document.getElementById('numer-raty').value = diff;
        }
        ['okres', 'kwota', 'oprocentowanie', 'miesiac-start', 'rok-start'].forEach(function (id) {
            document.getElementById(id).addEventListener('change', function () { przelicznumerRatySugestia(); aktualizujStanBiezacy(); });
        });
        document.getElementById('numer-raty').addEventListener('input', aktualizujStanBiezacy);

        // --- SEKCJA "GDZIE JESTEŚ DZIŚ" ---------------------------------------------
        function aktualizujStanBiezacy() {
            const P = Number(document.getElementById('kwota').value);
            const proc = Number(document.getElementById('oprocentowanie').value);
            const lata = Number(document.getElementById('okres').value);
            const n = lata * 12;
            if (!P || !proc || !lata) return;

            const baza = zbudujHarmonogramBazowy(P, proc, n);
            const numerRaty = Math.min(Number(document.getElementById('numer-raty').value), baza.rows.length);

            document.getElementById('numer-raty-read').textContent = 'rata nr ' + numerRaty + ' · ' + fmtLat(numerRaty) + ' spłacania';

            const saldoTeraz = numerRaty === 0 ? P : (baza.rows[numerRaty - 1] ? baza.rows[numerRaty - 1].saldo : 0);
            const splaconyKapital = baza.rows.slice(0, numerRaty).reduce(function (s, r) { return s + r.kapital; }, 0);
            const zaplaconeOdsetki = baza.rows.slice(0, numerRaty).reduce(function (s, r) { return s + r.odsetki; }, 0);

            document.getElementById('ms-saldo').textContent = fmt(saldoTeraz);
            document.getElementById('ms-kapital').textContent = fmt(splaconyKapital);
            document.getElementById('ms-odsetki').textContent = fmt(zaplaconeOdsetki);
            document.getElementById('ms-rata').textContent = fmt(baza.rata);
        }

        // --- WYKRESY (canvas, bez bibliotek) -----------------------------------------
        function rysujWykresLiniowy(canvasId, serie, kolory, formatX) {
            const canvas = document.getElementById(canvasId);
            const ctx = canvas.getContext('2d');
            const dpr = window.devicePixelRatio || 1;
            const cssW = canvas.parentElement.clientWidth - 24;
            const cssH = 220;
            canvas.width = cssW * dpr; canvas.height = cssH * dpr;
            canvas.style.width = cssW + 'px'; canvas.style.height = cssH + 'px';
            ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
            ctx.clearRect(0, 0, cssW, cssH);

            const padL = 46, padR = 10, padT = 10, padB = 22;
            const w = cssW - padL - padR, h = cssH - padT - padB;

            let maxX = 0, maxY = 0;
            serie.forEach(function (s) { s.data.forEach(function (p) { if (p.x > maxX) maxX = p.x; if (p.y > maxY) maxY = p.y; }); });
            if (maxY === 0) maxY = 1;

            // siatka
            ctx.strokeStyle = 'rgba(0,0,0,0.08)'; ctx.lineWidth = 1;
            for (let i = 0; i <= 4; i++) {
                const y = padT + h - (h * i / 4);
                ctx.beginPath(); ctx.moveTo(padL, y); ctx.lineTo(padL + w, y); ctx.stroke();
                ctx.fillStyle = 'rgba(0,0,0,0.45)'; ctx.font = '11px Jost, sans-serif'; ctx.textAlign = 'right';
                ctx.fillText(Math.round(maxY * i / 4 / 1000) + 'k', padL - 8, y + 4);
            }

            serie.forEach(function (s, idx) {
                ctx.strokeStyle = kolory[idx]; ctx.lineWidth = 2; ctx.beginPath();
                s.data.forEach(function (p, i) {
                    const x = padL + (p.x / maxX) * w;
                    const y = padT + h - (p.y / maxY) * h;
                    if (i === 0) ctx.moveTo(x, y); else ctx.lineTo(x, y);
                });
                ctx.stroke();
            });

            ctx.fillStyle = 'rgba(0,0,0,0.45)'; ctx.font = '11px Jost, sans-serif'; ctx.textAlign = 'center';
            for (let i = 0; i <= 4; i++) {
                const x = padL + (w * i / 4);
                ctx.fillText(Math.round((maxX * i / 4) / 12) + ' r.', x, cssH - 4);
            }
        }

        function rysujWykresStruktury(canvasId, dane) {
            const canvas = document.getElementById(canvasId);
            const ctx = canvas.getContext('2d');
            const dpr = window.devicePixelRatio || 1;
            const cssW = canvas.parentElement.clientWidth - 24;
            const cssH = 220;
            canvas.width = cssW * dpr; canvas.height = cssH * dpr;
            canvas.style.width = cssW + 'px'; canvas.style.height = cssH + 'px';
            ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
            ctx.clearRect(0, 0, cssW, cssH);

            const padL = 46, padR = 10, padT = 10, padB = 22;
            const w = cssW - padL - padR, h = cssH - padT - padB;
            if (!dane.length) return;
            const maxY = Math.max.apply(null, dane.map(function (d) { return d.kapital + d.odsetki; }));
            const barW = w / dane.length;

            dane.forEach(function (d, i) {
                const x = padL + i * barW;
                const totalH = ((d.kapital + d.odsetki) / maxY) * h;
                const kapH = (d.kapital / maxY) * h;
                const y0 = padT + h - totalH;
                ctx.fillStyle = '#b08650';
                ctx.fillRect(x, y0, Math.max(1, barW - 1), totalH - kapH);
                ctx.fillStyle = '#1f2a20';
                ctx.fillRect(x, y0 + (totalH - kapH), Math.max(1, barW - 1), kapH);
            });

            ctx.fillStyle = 'rgba(0,0,0,0.45)'; ctx.font = '11px Jost, sans-serif'; ctx.textAlign = 'center';
            for (let i = 0; i <= 4; i++) {
                const idx = Math.min(dane.length - 1, Math.round(i * (dane.length - 1) / 4));
                const x = padL + idx * barW;
                ctx.fillText(Math.round(dane[idx].m / 12) + ' r.', x, cssH - 4);
            }
        }

        // --- PRZYCISK "TOGGLE HARMONOGRAM" ------------------------------------------
        function toggleSchedule() {
            fullSchedule = !fullSchedule;
            document.getElementById('schedule-toggle').textContent = fullSchedule ? 'Zwiń harmonogram' : 'Pokaż pełny harmonogram';
            oblicz(false);
        }

        // --- GŁÓWNE OBLICZENIA -------------------------------------------------------
        // `przewin` = true tylko wtedy, gdy chcemy faktycznie przewinąć widok do wyników
        // (czyli wyłącznie po kliknięciu przycisku). Przeliczenia w tle (ładowanie strony,
        // zmiana rozmiaru okna / pojawienie się klawiatury na mobile, rozwijanie harmonogramu)
        // NIE mogą przewijać strony — to właśnie powodowało "uciekanie" strony na telefonie.
        function oblicz(przewin) {
            const P = Number(document.getElementById('kwota').value);
            const proc = Number(document.getElementById('oprocentowanie').value);
            const lata = Number(document.getElementById('okres').value);
            const n = lata * 12;
            const nadplata = pobierzNadplate();
            const offset = Number(pobierzAktywny('pillrow-kiedy'));
            const cel = pobierzAktywny('pillrow-cel');

            if (!P || !proc || !lata || !nadplata) {
                alert('Uzupełnij dane kredytu i kwotę nadpłaty.');
                return;
            }

            const baza = zbudujHarmonogramBazowy(P, proc, n);
            const numerRaty = Math.min(Number(document.getElementById('numer-raty').value), baza.rows.length);

            const saldoTeraz = numerRaty === 0 ? P : (baza.rows[numerRaty - 1] ? baza.rows[numerRaty - 1].saldo : 0);
            const zaplaconeOdsetkiDoDzis = baza.rows.slice(0, numerRaty).reduce(function (s, r) { return s + r.odsetki; }, 0);
            const pozostaloMiesiecyBaz = baza.rows.length - numerRaty;
            const wierszeReszta = baza.rows.slice(numerRaty);
            const odsetkiBez = wierszeReszta.reduce(function (s, r) { return s + r.odsetki; }, 0);
            const miesiaceBez = wierszeReszta.length;

            if (nadplata >= saldoTeraz) {
                alert('Kwota nadpłaty nie może być wyższa niż aktualne saldo kredytu.');
                return;
            }

            const symPo = symulujDalej(saldoTeraz, baza.rm, baza.rata, pozostaloMiesiecyBaz, nadplata, offset, cel);
            const oszczednosc = odsetkiBez - symPo.sumaOdsetek;
            const skrocenieMies = miesiaceBez - symPo.miesiecy;

            document.getElementById('r-raty-bez').textContent = miesiaceBez;
            document.getElementById('r-odsetki-bez').textContent = fmt(odsetkiBez);
            document.getElementById('r-raty-po').textContent = symPo.miesiecy;
            document.getElementById('r-skrocenie').textContent = '−' + fmtLat(skrocenieMies);
            document.getElementById('r-oszczednosc').textContent = fmt(oszczednosc);

            document.getElementById('tape-oszczednosc').textContent = 'Oszczędzasz ' + fmt(oszczednosc);
            document.getElementById('tape-skrocenie').innerHTML = '−' + fmtLat(skrocenieMies) + '<br><span style="opacity:.6;">krótszy kredyt</span>';

            // --- CO BY BYŁO GDYBY ---
            const sumaOdsetekPelnaBaz = baza.rows.reduce(function (s, r) { return s + r.odsetki; }, 0);
            const scenariusze = [
                { etykieta: 'od pierwszej raty', off: 0 },
                { etykieta: 'od 2. roku', off: 23 },
                { etykieta: 'od 5. roku', off: 59 },
                { etykieta: 'od dziś', off: numerRaty }
            ].filter(function (s) { return s.off <= n; });

            let symOdPoczatku = null;
            const scenarioBody = document.getElementById('scenario-body');
            scenarioBody.innerHTML = '';
            scenariusze.forEach(function (s) {
                const sim = symulujDalej(P, baza.rm, baza.rata, n, nadplata, s.off, cel);
                const oszcz = sumaOdsetekPelnaBaz - sim.sumaOdsetek;
                if (s.etykieta === 'od pierwszej raty') symOdPoczatku = sim;
                const tr = document.createElement('tr');
                tr.innerHTML = '<td>' + s.etykieta + '</td><td>' + fmt(oszcz) + '</td>';
                scenarioBody.appendChild(tr);
            });

            if (symOdPoczatku && numerRaty > 0) {
                const saldoGdyby = numerRaty <= symOdPoczatku.rows.length ? symOdPoczatku.rows[numerRaty - 1].saldo : 0;
                document.getElementById('gdyby-tekst').innerHTML =
                    'Gdybyś od początku kredytu nadpłacał ' + fmt(nadplata) + ' miesięcznie, dziś pozostałoby do spłaty <b>' + fmt(saldoGdyby) + '</b>, zamiast <b>' + fmt(saldoTeraz) + '</b>.';
            } else {
                document.getElementById('gdyby-tekst').textContent = 'Dopiero zaczynasz spłacać — nadpłaty od pierwszej raty i „od dziś” dają ten sam efekt.';
            }

            // --- KOMENTARZ EDUKACYJNY ---
            const kiedyTxt = offset === 0 ? 'od teraz' : (offset === 3 ? 'za 3 miesiące' : 'za rok');
            document.getElementById('rec-title').textContent = 'Nadpłata skraca kredyt o ' + fmtLat(skrocenieMies);
            let recTxt = 'Rozpoczęcie regularnych nadpłat w wysokości ' + fmt(nadplata) + ' miesięcznie (' + kiedyTxt + ') skróci okres kredytowania o ' + fmtLat(skrocenieMies) + ', a łączna kwota odsetek zmniejszy się o ' + fmt(oszczednosc) + '.';
            const scenOdPoczatku = symOdPoczatku ? sumaOdsetekPelnaBaz - symOdPoczatku.sumaOdsetek : null;
            if (scenOdPoczatku !== null) {
                recTxt += ' Gdyby identyczne nadpłaty były realizowane już od pierwszej raty, oszczędność odsetkowa wyniosłaby około ' + fmt(scenOdPoczatku) + '.';
            }
            recTxt += ' Regularność i wczesne rozpoczęcie nadpłat mają zwykle większy wpływ na całkowity koszt kredytu niż sporadyczne jednorazowe wpłaty.';
            document.getElementById('rec-text').textContent = recTxt;

            // --- TABELA PORÓWNAWCZA WARIANTÓW ---
            const expertBody = document.getElementById('expert-body');
            expertBody.innerHTML = '';
            [200, 500, 1000, 1500, 2000].forEach(function (kwota) {
                const sim = symulujDalej(saldoTeraz, baza.rm, baza.rata, pozostaloMiesiecyBaz, kwota, offset, cel);
                const razem = numerRaty + sim.miesiecy;
                const tr = document.createElement('tr');
                if (kwota === nadplata) tr.classList.add('is-active');
                tr.innerHTML = '<td>' + kwota + ' zł</td><td>' + fmtLat(razem) + '</td><td>' + fmt(zaplaconeOdsetkiDoDzis + sim.sumaOdsetek) + '</td>';
                expertBody.appendChild(tr);
            });

            // --- CZY WARTO ZWIĘKSZYĆ NADPŁATĘ ---
            document.getElementById('worth-sub').textContent = 'Punkt odniesienia: ' + fmt(nadplata) + ' miesięcznie.';
            const worthBody = document.getElementById('worth-body');
            worthBody.innerHTML = '';
            [0, 200, 500, 1000].forEach(function (delta) {
                const kwota = nadplata + delta;
                const sim = symulujDalej(saldoTeraz, baza.rm, baza.rata, pozostaloMiesiecyBaz, kwota, offset, cel);
                const tr = document.createElement('tr');
                if (delta === 0) {
                    tr.innerHTML = '<td>' + kwota + ' zł (obecnie)</td><td>—</td><td>—</td>';
                } else {
                    const dodatkoweMiesiace = symPo.miesiecy - sim.miesiecy;
                    const dodatkoweOdsetki = symPo.sumaOdsetek - sim.sumaOdsetek;
                    tr.innerHTML = '<td>+' + delta + ' zł → ' + kwota + ' zł</td><td>−' + dodatkoweMiesiace + ' rat</td><td>' + fmt(dodatkoweOdsetki) + '</td>';
                }
                worthBody.appendChild(tr);
            });

            // --- HARMONOGRAM ---
            const scheduleBody = document.getElementById('schedule-body');
            scheduleBody.innerHTML = '';
            const iloscDoPokazania = fullSchedule ? symPo.rows.length : Math.min(12, symPo.rows.length);
            let saldoPoprzednie = saldoTeraz;
            for (let i = 0; i < iloscDoPokazania; i++) {
                const r = symPo.rows[i];
                const tr = document.createElement('tr');
                tr.innerHTML = '<td>' + (numerRaty + r.mies) + '</td><td>' + fmt(saldoPoprzednie) + '</td><td>' + fmt(r.kapital) +
                    '</td><td>' + fmt(r.odsetki) + '</td><td>' + (r.nadplata ? fmt(r.nadplata) : '—') + '</td><td>' + fmt(r.saldo) + '</td>';
                scheduleBody.appendChild(tr);
                saldoPoprzednie = r.saldo;
            }

            // --- WYKRESY: przygotowanie danych ---
            const seriaSaldoBez = [], seriaSaldoZ = [], seriaOdsetkiBez = [], seriaOdsetkiZ = [];
            let cumOdsBez = zaplaconeOdsetkiDoDzis, cumOdsZ = zaplaconeOdsetkiDoDzis;
            // historia wspólna
            for (let i = 0; i <= numerRaty; i += Math.max(1, Math.round(n / 200))) {
                const bal = i === 0 ? P : (baza.rows[i - 1] ? baza.rows[i - 1].saldo : 0);
                seriaSaldoBez.push({ x: i, y: bal }); seriaSaldoZ.push({ x: i, y: bal });
                seriaOdsetkiBez.push({ x: i, y: i === 0 ? 0 : cumOdsBez }); seriaOdsetkiZ.push({ x: i, y: i === 0 ? 0 : cumOdsZ });
            }
            const maxLen = Math.max(miesiaceBez, symPo.miesiecy);
            for (let k = 1; k <= maxLen; k++) {
                const bezRow = wierszeReszta[k - 1];
                if (bezRow) cumOdsBez += bezRow.odsetki;
                const zRow = symPo.rows[k - 1];
                if (zRow) cumOdsZ += zRow.odsetki;
                seriaSaldoBez.push({ x: numerRaty + k, y: bezRow ? bezRow.saldo : 0 });
                seriaSaldoZ.push({ x: numerRaty + k, y: zRow ? zRow.saldo : 0 });
                seriaOdsetkiBez.push({ x: numerRaty + k, y: cumOdsBez });
                seriaOdsetkiZ.push({ x: numerRaty + k, y: cumOdsZ });
            }

            rysujWykresLiniowy('chart-saldo', [{ data: seriaSaldoBez }, { data: seriaSaldoZ }], ['#b08650', '#1f2a20']);
            rysujWykresLiniowy('chart-odsetki', [{ data: seriaOdsetkiBez }, { data: seriaOdsetkiZ }], ['#b08650', '#1f2a20']);

            const krokStruktury = Math.max(1, Math.round(symPo.rows.length / 60));
            const struktDane = symPo.rows.filter(function (_, i) { return i % krokStruktury === 0; })
                .map(function (r) { return { m: numerRaty + r.mies, kapital: r.kapital + (r.nadplata || 0), odsetki: r.odsetki }; });
            rysujWykresStruktury('chart-struktura', struktDane);

            if (przewin) {
                document.getElementById('wyniki').scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        }

        window.addEventListener('load', function () {
            przelicznumerRatySugestia();
            aktualizujStanBiezacy();
            oblicz(false);
        });

        // Przeliczenie na resize jest potrzebne tylko po to, by wykresy dopasowały
        // szerokość do nowego rozmiaru okna — nigdy nie powinno przewijać strony.
        // Dodatkowo "debounce", żeby telefon (pokazywanie/chowanie klawiatury,
        // zmiany paska adresu) nie przeliczał wszystkiego dziesiątki razy na sekundę.
        let resizeTimer = null;
        window.addEventListener('resize', function () {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function () { oblicz(false); }, 250);
        });
    </script>

</body>

</html>