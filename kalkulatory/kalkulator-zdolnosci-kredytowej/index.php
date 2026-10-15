<?php
// Kalkulator zdolności kredytowej — kredyt hipoteczny.
// Cała logika liczy się po stronie przeglądarki (brak wysyłania danych klienta na serwer).
// Założenia modelu (koszty utrzymania, wagi dochodów, limit wieku) są w obiekcie ZAL w skrypcie na dole pliku.
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="/media/main-icon.png" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator zdolności kredytowej – kredyt hipoteczny | Alicja Muryn</title>
    <meta name="description" content="Sprawdź w 2 minuty, jaki kredyt hipoteczny możesz dostać. Kalkulator uwzględnia bufor KNF, karty kredytowe, koszty utrzymania i pokazuje, jak zwiększyć zdolność.">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Alicja Muryn">
    <link rel="canonical" href="https://kredyty-koszalin.pl/kalkulatory/zdolnosc-kredytowa/">

    <meta property="og:type" content="website">
    <meta property="og:url" content="https://kredyty-koszalin.pl/kalkulatory/zdolnosc-kredytowa/">
    <meta property="og:title" content="Kalkulator zdolności kredytowej – kredyt hipoteczny | Alicja Muryn">
    <meta property="og:description" content="Sprawdź w 2 minuty, jaki kredyt hipoteczny możesz dostać. Kalkulator uwzględnia bufor KNF, karty kredytowe, koszty utrzymania i pokazuje, jak zwiększyć zdolność.">
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
        "name": "Kalkulator zdolności kredytowej – kredyt hipoteczny",
        "description": "Sprawdź w 2 minuty, jaki kredyt hipoteczny możesz dostać. Kalkulator uwzględnia bufor KNF, karty kredytowe, koszty utrzymania i pokazuje, jak zwiększyć zdolność.",
        "url": "https://kredyty-koszalin.pl/kalkulatory/zdolnosc-kredytowa/",
        "inLanguage": "pl",
        "author": { "@type": "Person", "name": "Alicja Muryn", "url": "https://kredyty-koszalin.pl" }
      },
      {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [
          { "@type": "ListItem", "position": 1, "name": "Strona główna", "item": "https://kredyty-koszalin.pl" },
          { "@type": "ListItem", "position": 2, "name": "Kalkulatory", "item": "https://kredyty-koszalin.pl/kalkulatory/" },
          { "@type": "ListItem", "position": 3, "name": "Kalkulator zdolności kredytowej", "item": "https://kredyty-koszalin.pl/kalkulatory/zdolnosc-kredytowa/" }
        ]
      },
      {
        "@context": "https://schema.org",
        "@type": "FAQPage",
        "mainEntity": [
          { "@type": "Question", "name": "Czym jest bufor stopy procentowej?",
            "acceptedAnswer": { "@type": "Answer", "text": "Bank liczy zdolność przy oprocentowaniu podwyższonym o bufor (zgodnie z Rekomendacją S KNF co najmniej 2,5 p.p.), aby sprawdzić, czy utrzymasz ratę, gdy stopy wzrosną. Dlatego rata w teście banku jest wyższa niż rata, którą faktycznie zapłacisz." } },
          { "@type": "Question", "name": "Czy nieużywana karta kredytowa obniża zdolność?",
            "acceptedAnswer": { "@type": "Answer", "text": "Tak. Banki traktują przyznany limit jako potencjalne zobowiązanie i doliczają do miesięcznych obciążeń zwykle kilka procent limitu, nawet jeśli karta nie jest używana. Zamknięcie zbędnych kart przed wnioskiem często realnie podnosi zdolność." } },
          { "@type": "Question", "name": "Czy wynik kalkulatora jest decyzją banku?",
            "acceptedAnswer": { "@type": "Answer", "text": "Nie. To szacunek oparty na typowych zasadach oceny zdolności. Każdy bank ma własny scoring, własne koszty utrzymania i własne limity, więc rzeczywista zdolność może się różnić w każdą stronę." } }
        ]
      }
    ]
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;1,300;1,400&family=Jost:wght@300;400;500&display=swap" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;1,300;1,400&family=Jost:wght@300;400;500&display=swap"></noscript>
    <link rel="stylesheet" href="/main.css">
    <link rel="stylesheet" href="/kalkulatory/kalkulatory.css">
    <style>
        :root {
            --ink: #16241c;
            --accent: #24402f;
            --accent-soft: #eaf0ea;
            --brass: #a8763e;
            --sage: #b9c7bb;
            --line: rgba(22,36,28,0.09);
            --line-soft: rgba(22,36,28,0.05);
            --paper: #ffffff;
            --paper-tint: rgba(22,36,28,0.025);
        }

        /* --- komponenty wspólne z pozostałymi kalkulatorami --- */
        .kalk-alert { grid-column: 1 / -1; margin-top: 10px; padding: 14px 18px; border-radius: 8px; border-left: 4px solid; font-family: 'Jost', sans-serif; font-size: 0.95rem; line-height: 1.55; }
        .kalk-alert strong { display: block; margin-bottom: 4px; font-family: 'Cormorant Garamond', serif; font-size: 1.15rem; font-weight: 500; }
        .kalk-alert--error { background: #fdecec; border-left-color: #c0392b; color: #7a1f17; }
        .kalk-alert--warning { background: #fff5e6; border-left-color: #e08a1e; color: #6e4a0e; }
        .kalk-alert--ok { background: #eaf3ec; border-left-color: var(--accent); color: #1c3626; }
        .kalk-alert--info { background: #f1f4f7; border-left-color: #5b7590; color: #2b3d4f; }
        .kalk-btn:disabled { opacity: 0.5; cursor: not-allowed; }
        .kalk-teaser { margin-top: 28px; padding: 22px 24px; border: 1px solid var(--line); border-radius: 10px; background: var(--paper-tint); }
        .kalk-teaser-label { font-family: 'Jost', sans-serif; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.12em; opacity: 0.6; margin-bottom: 8px; }
        .kalk-teaser-title { font-family: 'Cormorant Garamond', serif; font-weight: 500; font-size: 1.35rem; line-height: 1.3; margin: 0 0 10px; }
        .kalk-teaser-text { margin: 0 0 14px; line-height: 1.65; }
        .kalk-teaser-link { font-family: 'Jost', sans-serif; font-weight: 500; text-decoration: underline; text-underline-offset: 3px; }

        .kalk-pillrow { display: flex; flex-wrap: wrap; gap: 8px; margin: 8px 0 4px; }
        .kalk-pill {
            font-family: 'Jost', sans-serif; font-size: 0.85rem; padding: 7px 16px; border-radius: 999px;
            border: 1px solid rgba(22,36,28,0.16); background: #fff; cursor: pointer; transition: all .15s ease; user-select: none;
        }
        .kalk-pill:hover { border-color: var(--accent); }
        .kalk-pill:focus-visible { outline: 2px solid var(--accent); outline-offset: 2px; }
        .kalk-pill.active { background: var(--accent); border-color: var(--accent); color: #fff; }
        .kalk-substep-label { font-family: 'Jost', sans-serif; font-size: 0.78rem; text-transform: uppercase; letter-spacing: 0.08em; opacity: 0.55; margin: 16px 0 2px; }

        .kalk-ministats { display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px; margin-top: 14px; }
        .kalk-ministat { background: var(--paper); border: 1px solid var(--line-soft); border-radius: 8px; padding: 12px 14px; box-shadow: 0 1px 2px rgba(22,36,28,0.03); }
        .kalk-ministat-label { font-family: 'Jost', sans-serif; font-size: 0.66rem; text-transform: uppercase; letter-spacing: 0.06em; opacity: 0.55; }
        .kalk-ministat-val { font-family: 'Cormorant Garamond', serif; font-size: 1.4rem; font-weight: 500; color: var(--ink); margin-top: 1px; }

        .kalk-tape {
            position: relative; margin-top: 24px; padding: 24px 26px 22px; border: 1px solid var(--line); border-radius: 10px;
            background:
                radial-gradient(circle, var(--paper) 5px, transparent 5.5px) top / 22px 14px repeat-x,
                repeating-linear-gradient(45deg, #fff, #fff 11px, var(--paper-tint) 11px, var(--paper-tint) 22px);
            box-shadow: 0 1px 2px rgba(22,36,28,0.04), 0 10px 28px -18px rgba(22,36,28,0.35);
            display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap;
        }
        .kalk-tape-label { font-family: 'Jost', sans-serif; font-size: 0.74rem; text-transform: uppercase; letter-spacing: 0.12em; opacity: 0.55; }
        .kalk-tape-val { font-family: 'Cormorant Garamond', serif; font-size: 2rem; font-weight: 500; color: var(--accent); margin-top: 3px; }
        .kalk-tape-side { font-family: 'Jost', sans-serif; font-size: 0.92rem; text-align: right; color: var(--accent); }
        .kalk-tape-side span { opacity: 0.6; color: var(--ink); }

        .kalk-chart-block { margin-top: 32px; }
        .kalk-chart-title { font-family: 'Cormorant Garamond', serif; font-size: 1.3rem; font-weight: 500; margin-bottom: 2px; color: var(--ink); }
        .kalk-chart-sub { font-family: 'Jost', sans-serif; font-size: 0.8rem; opacity: 0.55; margin-bottom: 10px; }
        .kalk-chart-canvas-wrap { border: 1px solid var(--line-soft); border-radius: 10px; padding: 14px 12px 8px; background: var(--paper); box-shadow: 0 1px 2px rgba(22,36,28,0.03), 0 8px 22px -18px rgba(22,36,28,0.4); }
        .kalk-chart-legend { display: flex; flex-wrap: wrap; gap: 8px 18px; margin-top: 10px; font-family: 'Jost', sans-serif; font-size: 0.8rem; }
        .kalk-chart-legend span { display: inline-flex; align-items: center; gap: 6px; }
        .kalk-chart-legend i { width: 12px; height: 12px; border-radius: 2px; display: inline-block; border: 1px solid rgba(22,36,28,0.12); }

        .kalk-expert-table { width: 100%; border-collapse: collapse; margin-top: 10px; font-family: 'Jost', sans-serif; font-size: 0.88rem; min-width: 440px; }
        .kalk-expert-table th { text-align: right; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.05em; opacity: 0.55; font-weight: 500; padding: 8px 10px; border-bottom: 1px solid var(--line); white-space: nowrap; }
        .kalk-expert-table th:first-child, .kalk-expert-table td:first-child { text-align: left; }
        .kalk-expert-table td { text-align: right; padding: 8px 10px; border-bottom: 1px solid var(--line-soft); font-variant-numeric: tabular-nums; }
        .kalk-expert-table td:first-child { white-space: normal; }
        .kalk-expert-table tbody tr:hover td { background: var(--paper-tint); }
        .kalk-expert-table tr.is-active td { background: var(--accent-soft); font-weight: 600; color: var(--accent); }
        .kalk-table-wrap { overflow-x: auto; -webkit-overflow-scrolling: touch; border-radius: 10px; }
        @media (max-width: 480px) {
            .kalk-expert-table { font-size: 0.82rem; }
            .kalk-expert-table th, .kalk-expert-table td { padding: 6px 8px; }
        }

        .kalk-metric, .kalk-rec { box-shadow: 0 1px 2px rgba(22,36,28,0.03), 0 10px 26px -20px rgba(22,36,28,0.4); }
        .kalk-metric--accent .kalk-metric-val { color: var(--accent); }

        /* --- nowe komponenty tego kalkulatora --- */
        .kalk-advanced { margin-top: 18px; border-top: 1px solid var(--line-soft); padding-top: 12px; }
        .kalk-advanced summary, .kalk-faq summary { cursor: pointer; font-family: 'Jost', sans-serif; font-size: 0.9rem; color: var(--accent); text-decoration: underline; text-underline-offset: 3px; }
        .kalk-advanced .kalk-grid { margin-top: 12px; }

        .kalk-budget-bar { display: flex; height: 34px; border-radius: 8px; overflow: hidden; border: 1px solid var(--line); background: #fff; }
        .kalk-budget-bar div { height: 100%; transition: width .25s ease; }
        @media (prefers-reduced-motion: reduce) { .kalk-budget-bar div { transition: none; } }

        .kalk-faq { margin-top: 32px; }
        .kalk-faq details { border-bottom: 1px solid var(--line-soft); padding: 12px 0; }
        .kalk-faq details p { margin: 10px 0 0; line-height: 1.65; font-size: 0.95rem; }

        .kalk-print-link { display: inline-block; margin-top: 14px; font-family: 'Jost', sans-serif; font-size: 0.85rem; text-decoration: underline; text-underline-offset: 3px; cursor: pointer; color: var(--accent); background: none; border: 0; padding: 0; }
        @media print {
            .mobile-back-bar, .page-back, .kalk-btn, .kalk-print-link, .kalk-cta, .kalk-teaser, .kalk-block, #alerty:empty { display: none !important; }
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
                    <div class="stag">Kalkulator 04</div>
                    <h1 class="page-title">Kalkulator zdolności kredytowej</h1>
                    <p class="page-lead">Sprawdź, jaki kredyt hipoteczny może Ci przyznać bank. Kalkulator liczy tak jak bank: dolicza bufor na wzrost stóp, uwzględnia limity kart i koszty utrzymania rodziny, a na końcu pokazuje, co możesz zrobić, żeby zdolność była wyższa.</p>
                    <div class="rule"></div>
                </div>

                <noscript><div class="kalk-alert kalk-alert--warning"><strong>Wymagany JavaScript</strong>Kalkulator liczy wynik w przeglądarce. Włącz JavaScript i odśwież stronę.</div></noscript>

                <!-- SEKCJA 1: DOCHODY -->
                <div class="kalk-block">
                    <div class="kalk-block-title">Kto bierze kredyt i z jakiego dochodu?</div>

                    <div class="kalk-substep-label" style="margin-top:0;">Liczba kredytobiorców</div>
                    <div class="kalk-pillrow" id="pillrow-osoby" role="group" aria-label="Liczba kredytobiorców">
                        <div class="kalk-pill active" data-val="1" tabindex="0" role="button">Jedna osoba</div>
                        <div class="kalk-pill" data-val="2" tabindex="0" role="button">Dwie osoby</div>
                    </div>

                    <div class="kalk-grid" style="margin-top:8px;">
                        <div class="kalk-field">
                            <label for="dochod1">Dochód netto (na rękę) miesięcznie</label>
                            <div class="kalk-input-wrap">
                                <input type="number" id="dochod1" value="8000" min="0" step="100" inputmode="decimal">
                                <span class="unit">PLN</span>
                            </div>
                        </div>
                        <div class="kalk-field">
                            <label for="typ1">Źródło dochodu</label>
                            <div class="kalk-input-wrap">
                                <select id="typ1">
                                    <option value="uop_nieokreslona">Umowa o pracę na czas nieokreślony</option>
                                    <option value="uop_okreslona">Umowa o pracę na czas określony</option>
                                    <option value="b2b">Własna działalność (dochód netto)</option>
                                    <option value="zlecenie">Umowa zlecenie / o dzieło</option>
                                    <option value="emerytura">Emerytura / renta</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div id="drugi-kredytobiorca" style="display:none;">
                        <div class="kalk-grid" style="margin-top:8px;">
                            <div class="kalk-field">
                                <label for="dochod2">Dochód netto drugiej osoby</label>
                                <div class="kalk-input-wrap">
                                    <input type="number" id="dochod2" value="5000" min="0" step="100" inputmode="decimal">
                                    <span class="unit">PLN</span>
                                </div>
                            </div>
                            <div class="kalk-field">
                                <label for="typ2">Źródło dochodu drugiej osoby</label>
                                <div class="kalk-input-wrap">
                                    <select id="typ2">
                                        <option value="uop_nieokreslona">Umowa o pracę na czas nieokreślony</option>
                                        <option value="uop_okreslona">Umowa o pracę na czas określony</option>
                                        <option value="b2b">Własna działalność (dochód netto)</option>
                                        <option value="zlecenie">Umowa zlecenie / o dzieło</option>
                                        <option value="emerytura">Emerytura / renta</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="kalk-grid" style="margin-top:8px;">
                        <div class="kalk-field">
                            <label for="dzieci">Dzieci na utrzymaniu</label>
                            <div class="kalk-input-wrap">
                                <input type="number" id="dzieci" value="0" min="0" max="10" step="1" inputmode="numeric">
                                <span class="unit">os.</span>
                            </div>
                        </div>
                        <div class="kalk-field">
                            <label for="wiek">Wiek (najstarszy kredytobiorca)</label>
                            <div class="kalk-input-wrap">
                                <input type="number" id="wiek" value="35" min="18" max="80" step="1" inputmode="numeric">
                                <span class="unit">lat</span>
                            </div>
                        </div>
                        <div class="kalk-field">
                            <label for="wydatki">Własne miesięczne wydatki (opcjonalnie)</label>
                            <div class="kalk-input-wrap">
                                <input type="number" id="wydatki" placeholder="jeśli znasz" min="0" step="100" inputmode="decimal">
                                <span class="unit">PLN</span>
                            </div>
                            <p class="kalk-hint">Bank przyjmie wyższą kwotę: Twoją albo własny wzorzec kosztów utrzymania.</p>
                        </div>
                    </div>
                </div>

                <!-- SEKCJA 2: ZOBOWIĄZANIA -->
                <div class="kalk-block">
                    <div class="kalk-block-title">Twoje obecne zobowiązania</div>
                    <p class="kalk-hint" style="margin-top:-6px;">Zostaw 0, jeśli nic z tego nie dotyczy. Nawet nieużywane limity obniżają zdolność.</p>
                    <div class="kalk-grid">
                        <div class="kalk-field">
                            <label for="raty">Miesięczne raty kredytów i leasingu</label>
                            <div class="kalk-input-wrap">
                                <input type="number" id="raty" value="0" min="0" step="50" inputmode="decimal">
                                <span class="unit">PLN</span>
                            </div>
                        </div>
                        <div class="kalk-field">
                            <label for="karty">Suma limitów kart kredytowych</label>
                            <div class="kalk-input-wrap">
                                <input type="number" id="karty" value="0" min="0" step="500" inputmode="decimal">
                                <span class="unit">PLN</span>
                            </div>
                        </div>
                        <div class="kalk-field">
                            <label for="debet">Suma limitów debetowych na koncie</label>
                            <div class="kalk-input-wrap">
                                <input type="number" id="debet" value="0" min="0" step="500" inputmode="decimal">
                                <span class="unit">PLN</span>
                            </div>
                        </div>
                        <div class="kalk-field">
                            <label for="alimenty">Alimenty i inne stałe zobowiązania</label>
                            <div class="kalk-input-wrap">
                                <input type="number" id="alimenty" value="0" min="0" step="50" inputmode="decimal">
                                <span class="unit">PLN</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SEKCJA 3: KREDYT -->
                <div class="kalk-block">
                    <div class="kalk-block-title">Kredyt, który planujesz</div>

                    <div class="kalk-substep-label" style="margin-top:0;">Okres kredytowania</div>
                    <div class="kalk-pillrow" id="pillrow-okres" role="group" aria-label="Okres kredytowania">
                        <div class="kalk-pill" data-val="15" tabindex="0" role="button">15 lat</div>
                        <div class="kalk-pill" data-val="20" tabindex="0" role="button">20 lat</div>
                        <div class="kalk-pill active" data-val="25" tabindex="0" role="button">25 lat</div>
                        <div class="kalk-pill" data-val="30" tabindex="0" role="button">30 lat</div>
                        <div class="kalk-pill" data-val="35" tabindex="0" role="button">35 lat</div>
                    </div>

                    <div class="kalk-grid" style="margin-top:8px;">
                        <div class="kalk-field">
                            <label for="okres">Okres (własna wartość)</label>
                            <div class="kalk-input-wrap">
                                <input type="number" id="okres" value="25" min="1" max="35" step="1" inputmode="numeric">
                                <span class="unit">lat</span>
                            </div>
                        </div>
                        <div class="kalk-field">
                            <label for="oprocentowanie">Oprocentowanie kredytu</label>
                            <div class="kalk-input-wrap">
                                <input type="number" id="oprocentowanie" value="6.0" min="0.1" max="30" step="0.05" inputmode="decimal">
                                <span class="unit">% rocznie</span>
                            </div>
                            <p class="kalk-hint">Nie znasz oferty? Wpisz orientacyjnie WIBOR 3M plus marżę banku.</p>
                        </div>
                        <div class="kalk-field">
                            <label for="wklad">Wkład własny (opcjonalnie)</label>
                            <div class="kalk-input-wrap">
                                <input type="number" id="wklad" placeholder="np. 100000" min="0" step="5000" inputmode="decimal">
                                <span class="unit">PLN</span>
                            </div>
                        </div>
                        <div class="kalk-field">
                            <label for="planowana">Planowana kwota kredytu (opcjonalnie)</label>
                            <div class="kalk-input-wrap">
                                <input type="number" id="planowana" placeholder="sprawdź, czy się zmieści" min="0" step="10000" inputmode="decimal">
                                <span class="unit">PLN</span>
                            </div>
                        </div>
                    </div>

                    <details class="kalk-advanced">
                        <summary>Założenia banku (dla zaawansowanych)</summary>
                        <div class="kalk-grid">
                            <div class="kalk-field">
                                <label for="bufor">Bufor stopy procentowej</label>
                                <div class="kalk-input-wrap">
                                    <input type="number" id="bufor" value="2.5" min="0" max="10" step="0.1" inputmode="decimal">
                                    <span class="unit">p.p.</span>
                                </div>
                                <p class="kalk-hint">Minimum wg Rekomendacji S KNF to 2,5 p.p. Część banków stosuje więcej przy stopie zmiennej.</p>
                            </div>
                            <div class="kalk-field">
                                <label for="proc-limitow">Limity liczone jako rata</label>
                                <div class="kalk-input-wrap">
                                    <input type="number" id="proc-limitow" value="5" min="0" max="100" step="0.5" inputmode="decimal">
                                    <span class="unit">% limitu</span>
                                </div>
                            </div>
                            <div class="kalk-field">
                                <label for="dti-nis">Maks. obciążenie dochodu (niższe dochody)</label>
                                <div class="kalk-input-wrap">
                                    <input type="number" id="dti-nis" value="50" min="10" max="100" step="1" inputmode="numeric">
                                    <span class="unit">% dochodu</span>
                                </div>
                            </div>
                            <div class="kalk-field">
                                <label for="dti-wys">Maks. obciążenie dochodu (wyższe dochody)</label>
                                <div class="kalk-input-wrap">
                                    <input type="number" id="dti-wys" value="65" min="10" max="100" step="1" inputmode="numeric">
                                    <span class="unit">% dochodu</span>
                                </div>
                            </div>
                            <div class="kalk-field">
                                <label for="prog-dochodu">Próg „wyższego” dochodu</label>
                                <div class="kalk-input-wrap">
                                    <input type="number" id="prog-dochodu" value="7000" min="0" step="100" inputmode="decimal">
                                    <span class="unit">PLN netto</span>
                                </div>
                                <p class="kalk-hint">Limity obciążenia to polityka poszczególnych banków. Tu ustawiasz typowe wartości.</p>
                            </div>
                        </div>
                    </details>

                    <button class="kalk-btn" id="oblicz-btn" type="button" onclick="oblicz(true)" style="margin-top:18px;">Sprawdź zdolność kredytową</button>
                </div>

                <div id="alerty" aria-live="polite"></div>

                <!-- WYNIKI -->
                <div class="kalk-results visible" id="wyniki">

                    <div class="kalk-metrics">
                        <div class="kalk-metric kalk-metric--accent">
                            <div class="kalk-metric-label">Maksymalna zdolność</div>
                            <div class="kalk-metric-val" id="r-max">—</div>
                            <div class="kalk-metric-sub" id="r-max-sub">kwota kredytu</div>
                        </div>
                        <div class="kalk-metric kalk-metric--accent">
                            <div class="kalk-metric-label">Kwota z zapasem 20%</div>
                            <div class="kalk-metric-val" id="r-komfort">—</div>
                            <div class="kalk-metric-sub" id="r-komfort-sub">rozsądniejszy wybór</div>
                        </div>
                        <div class="kalk-metric">
                            <div class="kalk-metric-label">Rata przy maksymalnym kredycie</div>
                            <div class="kalk-metric-val" id="r-rata">—</div>
                            <div class="kalk-metric-sub" id="r-rata-sub">przy oprocentowaniu ofertowym</div>
                        </div>
                        <div class="kalk-metric">
                            <div class="kalk-metric-label">Rata w teście banku</div>
                            <div class="kalk-metric-val" id="r-rata-test">—</div>
                            <div class="kalk-metric-sub" id="r-rata-test-sub">z buforem</div>
                        </div>
                    </div>

                    <div class="kalk-tape">
                        <div>
                            <div class="kalk-tape-label">Taśma sumująca · Twoja zdolność</div>
                            <div class="kalk-tape-val" id="tape-kwota">—</div>
                        </div>
                        <div class="kalk-tape-side" id="tape-side">—</div>
                    </div>

                    <div id="alerty-wynik"></div>

                    <!-- BUDŻET -->
                    <div class="kalk-chart-block">
                        <div class="kalk-chart-title">Twój miesięczny budżet w oczach banku</div>
                        <div class="kalk-chart-sub" id="budzet-sub">—</div>
                        <div class="kalk-budget-bar" id="budzet-bar" role="img" aria-label="Podział miesięcznego dochodu"></div>
                        <div class="kalk-chart-legend" id="budzet-legend"></div>
                        <div class="kalk-ministats">
                            <div class="kalk-ministat"><div class="kalk-ministat-label">Dochód uwzględniany</div><div class="kalk-ministat-val" id="ms-dochod">—</div></div>
                            <div class="kalk-ministat"><div class="kalk-ministat-label">Koszty utrzymania</div><div class="kalk-ministat-val" id="ms-koszty">—</div></div>
                            <div class="kalk-ministat"><div class="kalk-ministat-label">Obecne zobowiązania</div><div class="kalk-ministat-val" id="ms-zob">—</div></div>
                            <div class="kalk-ministat"><div class="kalk-ministat-label">Dostępne na ratę</div><div class="kalk-ministat-val" id="ms-maxrata">—</div></div>
                        </div>
                    </div>

                    <!-- KOMENTARZ -->
                    <div class="kalk-rec" style="margin-top:32px;">
                        <div class="kalk-rec-rule"></div>
                        <div>
                            <div class="kalk-rec-title" id="rec-title">—</div>
                            <p class="kalk-rec-text" id="rec-text">—</p>
                        </div>
                    </div>

                    <!-- WYKRES: OKRES -->
                    <div class="kalk-chart-block">
                        <div class="kalk-chart-title">Jak okres kredytowania zmienia zdolność</div>
                        <div class="kalk-chart-sub">maksymalna kwota kredytu przy różnych okresach, pozostałe dane bez zmian</div>
                        <div class="kalk-chart-canvas-wrap"><canvas id="chart-okres" height="220" role="img" aria-label="Zdolność kredytowa w zależności od okresu kredytowania"></canvas></div>
                        <div class="kalk-chart-legend">
                            <span><i style="background:#24402f;"></i>Twój wybór</span>
                            <span><i style="background:#b9c7bb;"></i>inne okresy</span>
                        </div>
                    </div>

                    <!-- JAK ZWIĘKSZYĆ -->
                    <div class="kalk-chart-block">
                        <div class="kalk-chart-title">Jak zwiększyć zdolność kredytową?</div>
                        <div class="kalk-chart-sub">policzone dla Twoich danych, od najskuteczniejszego</div>
                        <div class="kalk-table-wrap">
                        <table class="kalk-expert-table">
                            <thead><tr><th>Działanie</th><th>Nowa zdolność</th><th>Zmiana</th></tr></thead>
                            <tbody id="boost-body"></tbody>
                        </table>
                        </div>
                    </div>

                    <!-- WRAŻLIWOŚĆ NA OPROCENTOWANIE -->
                    <div class="kalk-chart-block">
                        <div class="kalk-chart-title">A jeśli oprocentowanie będzie inne?</div>
                        <div class="kalk-chart-sub">zdolność przy zmianie oprocentowania oferty</div>
                        <div class="kalk-table-wrap">
                        <table class="kalk-expert-table">
                            <thead><tr><th>Oprocentowanie</th><th>Maks. kredyt</th><th>Zmiana</th></tr></thead>
                            <tbody id="rate-body"></tbody>
                        </table>
                        </div>
                    </div>

                    <button type="button" class="kalk-print-link" onclick="window.print()">Wydrukuj lub zapisz wynik jako PDF</button>

                </div>
                <!-- /WYNIKI -->

                <div class="kalk-disclaimer">
                    <p><strong>Uwaga:</strong> Wynik ma charakter informacyjny i poglądowy. Kalkulator stosuje uproszczony model: bufor stopy procentowej, limit obciążenia dochodu, typowy wzorzec kosztów utrzymania oraz stałą ratę annuitetową. Nie uwzględnia historii w BIK, stażu pracy, wartości nieruchomości, wieku dochodów z działalności ani indywidualnego scoringu banku, dlatego rzeczywista zdolność może się od wyniku różnić, także znacząco. Ostateczną decyzję zawsze podejmuje bank. Skontaktuj się z doradcą kredytowym przed złożeniem wniosku. Założenia modelu: wrzesień 2026.</p>
                </div>

                <div class="kalk-faq">
                    <div class="kalk-chart-title">Najczęstsze pytania</div>
                    <details><summary>Czym jest bufor stopy procentowej?</summary>
                        <p>Bank liczy zdolność przy oprocentowaniu podwyższonym o bufor (zgodnie z Rekomendacją S KNF co najmniej 2,5 p.p.), aby sprawdzić, czy utrzymasz ratę, gdy stopy wzrosną. Dlatego rata w teście banku jest wyższa niż rata, którą faktycznie zapłacisz.</p></details>
                    <details><summary>Czy nieużywana karta kredytowa obniża zdolność?</summary>
                        <p>Tak. Banki traktują przyznany limit jako potencjalne zobowiązanie i doliczają do miesięcznych obciążeń zwykle kilka procent limitu, nawet jeśli karta nie jest używana. Zamknięcie zbędnych kart przed wnioskiem często realnie podnosi zdolność.</p></details>
                    <details><summary>Czy wynik kalkulatora jest decyzją banku?</summary>
                        <p>Nie. To szacunek oparty na typowych zasadach oceny zdolności. Każdy bank ma własny scoring, własne koszty utrzymania i własne limity, więc rzeczywista zdolność może się różnić w każdą stronę.</p></details>
                </div>

                <div class="kalk-teaser">
                    <div class="kalk-teaser-label">Komentarz eksperta</div>
                    <div class="kalk-teaser-title">Zdolność to nie to samo co kwota, którą warto pożyczyć</div>
                    <p class="kalk-teaser-text">Bank liczy zdolność ostrożnie, ale nie pyta o Twoje plany na życie. Zobacz, jak dobrać kwotę kredytu tak, by rata została komfortowa także wtedy, gdy zmieni się sytuacja rodzinna lub zawodowa.</p>
                    <a href="/komentarze/zdolnosc-kredytowa/" class="kalk-teaser-link">Czytaj cały komentarz →</a>
                </div>

                <div class="kalk-cta">
                    <div class="kalk-cta-title">Chcesz poznać swoją realną zdolność w bankach?</div>
                    <p class="kalk-cta-text">Sprawdzę Twoją sytuację w kilkunastu bankach jednocześnie i wskażę ofertę, w której zdolność jest najwyższa. Bezpłatnie, bez zobowiązań.</p>
                    <a onclick="openKonsultacjaModal()" class="kalk-cta-btn">Umów konsultację</a>
                </div>

            </main>
            <?php include __DIR__ . '/../../komponenty/pasek-boczny-komentarze.php'; ?>
        </div>
    </div>

    <?php include __DIR__ . '/../../komponenty/stopka.php'; ?>
    <div id="konsultacja-modal" class="modal-overlay" onclick="handleModalOverlayClick(event)">
        <div class="modal-box">
            <button class="modal-close" onclick="closeKonsultacjaModal()" aria-label="Zamknij">&times;</button>
            <div class="modal-title">Bezpłatna konsultacja</div>
            <div class="modal-sub">Wypełnij formularz — odezwę się w ciągu 24 godzin.</div>
            <div class="modal-fields">
                <div class="fg"><label for="kons-name">Imię i nazwisko</label><input type="text" id="kons-name" placeholder="Jan Kowalski"><div class="field-error" id="kons-name-err"></div></div>
                <div class="fg"><label for="kons-tel">Telefon</label><input type="tel" id="kons-tel" placeholder="+48 500 000 000"><div class="field-error" id="kons-tel-err"></div></div>
                <div class="fg"><label for="kons-email">E-mail</label><input type="email" id="kons-email" placeholder="jan@example.com"><div class="field-error" id="kons-email-err"></div></div>
                <div class="fg">
                    <label for="kons-type">Rodzaj kredytu</label>
                    <select id="kons-type">
                        <option value="">— Wybierz —</option>
                        <option>Kredyt hipoteczny</option>
                        <option>Kredyt firmowy</option>
                        <option>Refinansowanie</option>
                        <option>Analiza zdolności</option>
                        <option>Kredyt gotówkowy</option>
                        <option>Dom modułowy</option>
                        <option>Inne</option>
                    </select>
                </div>
                <div class="fg"><label for="kons-note">Wiadomość (opcjonalnie)</label><textarea id="kons-note" placeholder="Krótko opisz swoją sytuację…"></textarea></div>
            </div>
            <button class="btn-modal-submit" id="kons-submit" onclick="submitKonsultacja()">Wyślij zapytanie</button>
            <div class="form-err-general" id="kons-err-general"></div>
            <div class="modal-ok" id="kons-ok">
                <div class="modal-ok-icon">&#10003;</div>
                <div class="modal-ok-text">Wiadomość wysłana!<br><span>Odezwę się w ciągu 24 godzin.</span></div>
            </div>
        </div>
    </div>
    <script>var CFG_ENDPOINT_CONTACT="/api/contact";function openKonsultacjaModal(){document.getElementById("konsultacja-modal").classList.add("open"),document.body.style.overflow="hidden"}function closeKonsultacjaModal(){document.getElementById("konsultacja-modal").classList.remove("open"),document.body.style.overflow=""}function handleModalOverlayClick(e){e.target===document.getElementById("konsultacja-modal")&&closeKonsultacjaModal()}function validateName(e){return/^[A-Za-zÀ-žĄąĆćĘęŁłŃńÓóŚśŹźŻż]{2,}[\s\-][A-Za-zÀ-žĄąĆćĘęŁłŃńÓóŚśŹźŻż]{2,}/.test(e)}function validatePhone(e){return/^\+\d{11}$/.test(e.replace(/\s/g,""))}function validateEmail(e){return/^[^\s@]{1,}@[^\s@]{1,}\.[^\s@]{1,}$/.test(e.trim())}function showErr(e,n){var t=document.getElementById(e);t&&(t.textContent=n,t.classList.add("show"))}function clearErr(e){var n=document.getElementById(e);n&&(n.textContent="",n.classList.remove("show"))}function setInvalid(e){e&&e.classList.add("invalid")}function clearInvalid(e){e&&e.classList.remove("invalid")}function submitKonsultacja(){var e=document.getElementById("kons-name"),n=document.getElementById("kons-tel"),t=document.getElementById("kons-email"),a=e?e.value.trim():"",o=n?n.value.trim():"",l=t?t.value.trim():"";clearErr("kons-name-err"),clearInvalid(e),clearErr("kons-tel-err"),clearInvalid(n),clearErr("kons-email-err"),clearInvalid(t),clearErr("kons-err-general");var r=!0;if(a?validateName(a)||(showErr("kons-name-err","Podaj imię i nazwisko — każde co najmniej 2 litery, oddzielone spacją."),setInvalid(e),r=!1):(showErr("kons-name-err","Proszę podać imię i nazwisko."),setInvalid(e),r=!1),o?validatePhone(o)||(showErr("kons-tel-err",'Podaj numer w formacie +XX XXX XXX XXX (znak "+" i dokładnie 11 cyfr).'),setInvalid(n),r=!1):(showErr("kons-tel-err","Proszę podać numer telefonu."),setInvalid(n),r=!1),l&&!validateEmail(l)&&(showErr("kons-email-err","Podaj poprawny adres e-mail (np. jan@example.com)."),setInvalid(t),r=!1),r){var s=document.getElementById("kons-submit"),i=document.getElementById("kons-ok");s.disabled=!0,s.textContent="Wysyłanie…";var d={name:a,tel:o.replace(/\s/g,""),email:l,type:document.getElementById("kons-type").value,message:document.getElementById("kons-note").value.trim(),source:"artykul"};fetch(CFG_ENDPOINT_CONTACT,{method:"POST",headers:{"Content-Type":"application/json"},body:JSON.stringify(d)}).then(function(e){if(429===e.status)return s.disabled=!1,s.textContent="Wyślij zapytanie",void showErr("kons-err-general","Dzienny limit wiadomości został osiągnięty. Spróbuj jutro lub zadzwoń bezpośrednio.");if(!e.ok)throw new Error("HTTP "+e.status);s.style.display="none",i.style.display="flex",setTimeout(function(){closeKonsultacjaModal()},3e3)}).catch(function(){s.disabled=!1,s.textContent="Wyślij zapytanie",showErr("kons-err-general","Wystąpił błąd serwera. Spróbuj ponownie lub zadzwoń bezpośrednio.")})}}function formatPhoneInput(e){var n=e.value.replace(/\D/g,"").slice(0,11);if(0!==n.length){var t="+"+n.slice(0,2);n.length>2&&(t+=" "+n.slice(2,5)),n.length>5&&(t+=" "+n.slice(5,8)),n.length>8&&(t+=" "+n.slice(8,11)),e.value=t}else e.value=""}document.addEventListener("keydown",function(e){"Escape"===e.key&&closeKonsultacjaModal()}),["kons-tel","contact-tel"].forEach(function(e){var n=document.getElementById(e);n&&(n.addEventListener("input",function(){formatPhoneInput(this)}),n.addEventListener("keydown",function(e){-1===[8,46,9,37,38,39,40,35,36].indexOf(e.keyCode)&&e.key&&!/^\d$/.test(e.key)&&"+"!==e.key&&e.preventDefault()}))});</script>

<script>
// --- ZAŁOŻENIA MODELU (do edycji w jednym miejscu) --------------------------
const ZAL = {
    // Miesięczne koszty utrzymania przyjmowane przez model, gdy klient nie poda własnych (wyższa wartość wygrywa).
    koszty: { dorosly1: 1800, dorosly2: 1100, dziecko: 800 },
    // Jaką część deklarowanego dochodu bank zwykle uznaje w pełni.
    wagiDochodu: { uop_nieokreslona: 1, uop_okreslona: 1, b2b: 1, zlecenie: 0.85, emerytura: 1 },
    maxWiekKoniec: 75,       // wiek kredytobiorcy w dniu ostatniej raty
    maxOkresLat: 35,
    zapas: 0.8,              // "kwota z zapasem"
    maxLtv: 0.9,             // minimum 10% wkładu własnego
    ltvBezUbezpieczenia: 0.8,
    wspolkredytobiorcaTest: 4000  // dochód netto hipotetycznego współkredytobiorcy w tabeli "jak zwiększyć"
};

// --- FORMATOWANIE ---------------------------------------------------------
function fmt(n) { return Math.round(n).toLocaleString('pl-PL') + ' zł'; }
function fmtZm(n) { return (n >= 0 ? '+' : '−') + Math.abs(Math.round(n)).toLocaleString('pl-PL') + ' zł'; }
function fmtProc(n) { return n.toLocaleString('pl-PL', { minimumFractionDigits: 0, maximumFractionDigits: 2 }) + '%'; }
function fmtKrotko(v) {
    if (v >= 1000000) return (v / 1000000).toLocaleString('pl-PL', { maximumFractionDigits: 2 }) + ' mln';
    return Math.round(v / 1000).toLocaleString('pl-PL') + ' tys.';
}
function slowoLat(l) {
    if (l === 1) return 'rok';
    const last = l % 10, last2 = l % 100;
    if (last2 >= 12 && last2 <= 14) return 'lat';
    if (last >= 2 && last <= 4) return 'lata';
    return 'lat';
}
function htmlAlert(typ, tytul, tekst) {
    return '<div class="kalk-alert kalk-alert--' + typ + '"><strong>' + tytul + '</strong>' + tekst + '</div>';
}

// --- SILNIK -------------------------------------------------------------------
function pmt(P, rm, n) {
    if (P <= 0 || n <= 0) return 0;
    if (rm === 0) return P / n;
    const f = Math.pow(1 + rm, n);
    return P * rm * f / (f - 1);
}
function pv(rata, rm, n) {
    if (rata <= 0 || n <= 0) return 0;
    if (rm === 0) return rata * n;
    return rata * (1 - Math.pow(1 + rm, -n)) / rm;
}
// p: { dochod, koszty, zob, dtiLimit, n (mies.), stopa (% rocznie), bufor (p.p.) }
function licz(p) {
    const nadwyzka = p.dochod - p.koszty - p.zob;          // limit z budżetu domowego
    const limitDti = p.dtiLimit * p.dochod - p.zob;        // limit ze wskaźnika obciążenia dochodu
    const maxRata = Math.max(0, Math.min(nadwyzka, limitDti));
    const rmTest = (p.stopa + p.bufor) / 100 / 12;
    const rmReal = p.stopa / 100 / 12;
    const kwota = pv(maxRata, rmTest, p.n);
    return {
        nadwyzka: nadwyzka, limitDti: limitDti, maxRata: maxRata,
        ograniczenie: nadwyzka <= limitDti ? 'budzet' : 'dti',
        kwota: kwota, rataReal: pmt(kwota, rmReal, p.n), rmReal: rmReal, rmTest: rmTest
    };
}
function zaokr(kwota) { return Math.floor(kwota / 100) * 100; }

// --- ODCZYT UI ----------------------------------------------------------------
function num(id) { const v = parseFloat(document.getElementById(id).value); return isFinite(v) ? v : 0; }
function pobierzAktywny(rowId) {
    const el = document.querySelector('#' + rowId + ' .kalk-pill.active');
    return el ? el.dataset.val : null;
}
function ustawPillrow(rowId, callback) {
    const pills = document.querySelectorAll('#' + rowId + ' .kalk-pill');
    pills.forEach(function (p) {
        function wybierz() {
            pills.forEach(function (x) { x.classList.remove('active'); });
            p.classList.add('active');
            if (callback) callback(p.dataset.val);
        }
        p.addEventListener('click', wybierz);
        p.addEventListener('keydown', function (e) { if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); wybierz(); } });
    });
}
function synchronizujPillOkres() {
    const v = String(num('okres'));
    document.querySelectorAll('#pillrow-okres .kalk-pill').forEach(function (p) { p.classList.toggle('active', p.dataset.val === v); });
}
ustawPillrow('pillrow-osoby', function (v) {
    document.getElementById('drugi-kredytobiorca').style.display = v === '2' ? 'block' : 'none';
    oblicz(false);
});
ustawPillrow('pillrow-okres', function (v) { document.getElementById('okres').value = v; oblicz(false); });

// --- WYKRES SŁUPKOWY (canvas, bez bibliotek) ----------------------------------
function rysujSlupki(canvasId, dane) {
    const canvas = document.getElementById(canvasId);
    const ctx = canvas.getContext('2d');
    const dpr = window.devicePixelRatio || 1;
    const cssW = Math.max(240, canvas.parentElement.clientWidth - 24);
    const cssH = 220;
    canvas.width = cssW * dpr; canvas.height = cssH * dpr;
    canvas.style.width = cssW + 'px'; canvas.style.height = cssH + 'px';
    ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
    ctx.clearRect(0, 0, cssW, cssH);
    if (!dane.length) return;

    const padL = 58, padR = 10, padT = 22, padB = 24;
    const w = cssW - padL - padR, h = cssH - padT - padB;
    const maxY = Math.max.apply(null, dane.map(function (d) { return d.val; })) || 1;

    ctx.strokeStyle = 'rgba(22,36,28,0.07)'; ctx.lineWidth = 1; ctx.setLineDash([3, 4]);
    ctx.fillStyle = 'rgba(22,36,28,0.5)'; ctx.font = '11px Jost, sans-serif'; ctx.textAlign = 'right';
    for (let i = 0; i <= 4; i++) {
        const y = padT + h - (h * i / 4);
        ctx.beginPath(); ctx.moveTo(padL, y); ctx.lineTo(padL + w, y); ctx.stroke();
        ctx.fillText(fmtKrotko(maxY * i / 4), padL - 8, y + 4);
    }
    ctx.setLineDash([]);

    const slot = w / dane.length, barW = Math.min(56, slot * 0.62);
    dane.forEach(function (d, i) {
        const x = padL + i * slot + (slot - barW) / 2;
        const bh = (d.val / maxY) * h;
        ctx.fillStyle = d.aktywny ? '#24402f' : '#b9c7bb';
        ctx.fillRect(x, padT + h - bh, barW, bh);
        ctx.textAlign = 'center';
        ctx.fillStyle = d.aktywny ? '#24402f' : 'rgba(22,36,28,0.6)';
        ctx.font = (d.aktywny ? '500 ' : '') + '11px Jost, sans-serif';
        ctx.fillText(fmtKrotko(d.val), x + barW / 2, padT + h - bh - 6);
        ctx.fillStyle = 'rgba(22,36,28,0.5)'; ctx.font = '11px Jost, sans-serif';
        ctx.fillText(d.label, x + barW / 2, cssH - 6);
    });
}

// --- GŁÓWNE OBLICZENIA -----------------------------------------------------------
// przewin = true tylko po kliknięciu przycisku. Przeliczenia w tle (wpisywanie, resize,
// klawiatura na telefonie) nigdy nie przewijają strony.
function oblicz(przewin) {
    const alerty = [];     // ostrzeżenia dot. danych (nad wynikami)
    const uwagi = [];      // uwagi do wyniku (pod taśmą)

    const osoby = Number(pobierzAktywny('pillrow-osoby'));
    const typy = [document.getElementById('typ1').value];
    const dochody = [num('dochod1')];
    if (osoby === 2) { typy.push(document.getElementById('typ2').value); dochody.push(num('dochod2')); }

    let dochod = 0;
    dochody.forEach(function (d, i) { dochod += d * ZAL.wagiDochodu[typy[i]]; });
    const dochodDeklar = dochody.reduce(function (s, d) { return s + d; }, 0);

    const stopa = num('oprocentowanie');
    const bufor = num('bufor');
    let lata = Math.round(num('okres'));
    const wiek = num('wiek');

    // --- walidacja (komunikaty na stronie, bez okienek alert) ---
    if (dochodDeklar <= 0) {
        alerty.push(htmlAlert('error', 'Brakuje dochodu', 'Wpisz miesięczny dochód netto, aby policzyć zdolność.'));
    }
    if (stopa < 0.1 || stopa > 30) {
        alerty.push(htmlAlert('error', 'Sprawdź oprocentowanie', 'Podaj oprocentowanie kredytu w przedziale od 0,1% do 30% rocznie.'));
    }
    if (lata < 1) {
        alerty.push(htmlAlert('error', 'Sprawdź okres kredytowania', 'Okres kredytowania musi wynosić co najmniej 1 rok.'));
    }
    if (alerty.length) {
        document.getElementById('alerty').innerHTML = alerty.join('');
        document.getElementById('wyniki').style.display = 'none';
        return;
    }
    document.getElementById('wyniki').style.display = '';

    // --- ograniczenia okresu (maks. 35 lat i wiek na koniec spłaty) ---
    let lataMax = ZAL.maxOkresLat;
    if (wiek > 0) lataMax = Math.min(lataMax, ZAL.maxWiekKoniec - Math.floor(wiek));
    if (lataMax < 1) {
        document.getElementById('alerty').innerHTML = htmlAlert('warning', 'Ograniczenie wieku',
            'Przy podanym wieku banki zwykle nie zgadzają się na kredyt hipoteczny, bo spłata kończyłaby się po ok. ' + ZAL.maxWiekKoniec + '. roku życia. Warto omówić możliwości, na przykład dodanie młodszego współkredytobiorcy.');
        document.getElementById('wyniki').style.display = 'none';
        return;
    }
    if (lata > lataMax) {
        alerty.push(htmlAlert('warning', 'Okres skrócony do ' + lataMax + ' ' + slowoLat(lataMax),
            'Wpisany okres przekracza limit wynikający z Twojego wieku i zasad banków (' + (wiek > 0 ? 'ostatnia rata przed ' + ZAL.maxWiekKoniec + '. rokiem życia, ' : '') + 'maks. ' + ZAL.maxOkresLat + ' lat). Obliczenia uwzględniają okres skrócony.'));
        lata = lataMax;
    }
    const n = lata * 12;

    // --- koszty i zobowiązania ---
    const dzieci = Math.max(0, Math.floor(num('dzieci')));
    const kosztyModel = ZAL.koszty.dorosly1 + (osoby === 2 ? ZAL.koszty.dorosly2 : 0) + dzieci * ZAL.koszty.dziecko;
    const koszty = Math.max(kosztyModel, num('wydatki'));
    const procLim = num('proc-limitow') / 100;
    const limity = num('karty') + num('debet');
    const raty = num('raty');
    const zobLimity = limity * procLim;
    const zob = raty + zobLimity + num('alimenty');

    const dtiLimit = (dochod >= num('prog-dochodu') ? num('dti-wys') : num('dti-nis')) / 100;

    const P = { dochod: dochod, koszty: koszty, zob: zob, dtiLimit: dtiLimit, n: n, stopa: stopa, bufor: bufor };
    const w = licz(P);

    // --- uwagi dotyczące dochodów ---
    const zestawTypow = typy.join(',');
    if (zestawTypow.indexOf('b2b') >= 0) uwagi.push(htmlAlert('info', 'Dochód z działalności', 'Banki zwykle wymagają co najmniej 12 miesięcy prowadzenia działalności i liczą dochód z uśrednienia, więc wynik w banku może odbiegać od tego oszacowania.'));
    if (zestawTypow.indexOf('uop_okreslona') >= 0) uwagi.push(htmlAlert('info', 'Umowa na czas określony', 'Część banków wymaga dłuższej historii zatrudnienia lub przedłużenia umowy. Warto to sprawdzić przed złożeniem wniosku.'));
    if (zestawTypow.indexOf('zlecenie') >= 0) uwagi.push(htmlAlert('info', 'Umowa zlecenie / o dzieło', 'Dochód z takich umów jest uznawany ostrożniej (tu przyjęto 85%) i zwykle wymaga stażu 6–12 miesięcy.'));
    if (zestawTypow.indexOf('emerytura') >= 0) uwagi.push(htmlAlert('info', 'Emerytura / renta', 'Banki ograniczają okres kredytowania do wieku kredytobiorcy. Wynik uwzględnia ten limit.'));

    // --- wkład własny ---
    const wklad = num('wklad');
    let kredytPoWkladzie = w.kwota, wkladLimituje = false;
    if (wklad > 0) {
        const limitLtv = wklad * ZAL.maxLtv / (1 - ZAL.maxLtv);   // przy LTV 90%: kredyt <= 9 x wkład
        if (w.kwota > limitLtv) { kredytPoWkladzie = limitLtv; wkladLimituje = true; }
    }

    // --- wyniki podstawowe ---
    const kwotaMax = zaokr(w.kwota);
    const kwotaKomfort = zaokr(w.kwota * ZAL.zapas);
    const rataKomfort = pmt(kwotaKomfort, w.rmReal, n);
    const rataTest = w.maxRata;

    document.getElementById('r-max').textContent = fmt(kwotaMax);
    document.getElementById('r-max-sub').textContent = 'na ' + lata + ' ' + slowoLat(lata);
    document.getElementById('r-komfort').textContent = fmt(kwotaKomfort);
    document.getElementById('r-komfort-sub').textContent = 'rata ok. ' + fmt(rataKomfort);
    document.getElementById('r-rata').textContent = fmt(w.rataReal);
    document.getElementById('r-rata-sub').textContent = 'przy ' + fmtProc(stopa) + ' rocznie';
    document.getElementById('r-rata-test').textContent = fmt(rataTest);
    document.getElementById('r-rata-test-sub').textContent = 'przy ' + fmtProc(stopa + bufor) + ' (z buforem ' + bufor.toLocaleString('pl-PL') + ' p.p.)';

    document.getElementById('tape-kwota').textContent = kwotaMax > 0 ? 'Możesz pożyczyć do ' + fmt(kwotaMax) : 'Brak zdolności przy tych danych';
    if (wklad > 0 && kwotaMax > 0) {
        const cena = kredytPoWkladzie + wklad;
        document.getElementById('tape-side').innerHTML = 'Nieruchomość do ' + fmt(zaokr(cena)) + '<br><span>przy wkładzie ' + fmt(wklad) + '</span>';
    } else {
        document.getElementById('tape-side').innerHTML = 'Rata ok. ' + fmt(w.rataReal) + '<br><span>przy ' + fmtProc(stopa) + ' rocznie</span>';
    }

    // --- uwagi do wyniku ---
    if (kwotaMax <= 0) {
        let powod = 'Po odjęciu kosztów utrzymania (' + fmt(koszty) + ') i zobowiązań (' + fmt(zob) + ') z dochodu (' + fmt(dochod) + ') nie zostaje kwota na ratę.';
        if (w.ograniczenie === 'dti') powod = 'Twoje zobowiązania (' + fmt(zob) + ') zajmują cały limit obciążenia dochodu (' + fmtProc(dtiLimit * 100) + ').';
        uwagi.unshift(htmlAlert('error', 'Bank najprawdopodobniej nie przyzna kredytu', powod + ' Zobacz poniżej, co można zmienić.'));
    }
    if (wkladLimituje) {
        uwagi.push(htmlAlert('info', 'Wkład własny ogranicza kredyt', 'Bank finansuje zwykle do ' + Math.round(ZAL.maxLtv * 100) + '% wartości nieruchomości. Przy wkładzie ' + fmt(wklad) + ' kwota kredytu jest ograniczona do ' + fmt(zaokr(kredytPoWkladzie)) + '. Wyższy wkład odblokuje resztę zdolności.'));
    } else if (wklad > 0 && kwotaMax > 0) {
        const cenaPelna = kredytPoWkladzie + wklad;
        const ltv = kredytPoWkladzie / cenaPelna;
        if (ltv > ZAL.ltvBezUbezpieczenia) uwagi.push(htmlAlert('info', 'Wkład własny poniżej 20%', 'Przy wkładzie poniżej 20% wartości nieruchomości banki zwykle wymagają ubezpieczenia niskiego wkładu, co podnosi koszt kredytu.'));
    }

    const plan = num('planowana');
    if (plan > 0 && kwotaMax > 0) {
        const rataPlan = pmt(plan, w.rmReal, n);
        const marza = kwotaMax - plan;
        if (plan <= kwotaMax) {
            uwagi.unshift(htmlAlert('ok', 'Planowany kredyt mieści się w zdolności',
                'Kredyt ' + fmt(plan) + ' to rata ok. ' + fmt(rataPlan) + ' miesięcznie przy ' + fmtProc(stopa) + '. Zapas do maksymalnej zdolności: ' + fmt(marza) + '.' +
                (plan > kwotaMax * ZAL.zapas ? ' Uwaga: kwota przekracza poziom z 20% zapasem, więc przy wzroście kosztów lub stóp budżet będzie napięty.' : '')));
        } else {
            uwagi.unshift(htmlAlert('warning', 'Planowany kredyt przekracza zdolność',
                'Brakuje około ' + fmt(-marza) + ' (kredyt ' + fmt(plan) + ' vs zdolność ' + fmt(kwotaMax) + '). Poniżej sprawdzisz, co pomoże: dłuższy okres, spłata zobowiązań, drugi kredytobiorca.'));
        }
    } else if (plan > 0) {
        uwagi.unshift(htmlAlert('error', 'Planowany kredyt nie mieści się w zdolności', 'Przy obecnych danych zdolność wynosi 0 zł. Sprawdź, co można zmienić, w tabeli poniżej.'));
    }

    document.getElementById('alerty').innerHTML = alerty.join('');
    document.getElementById('alerty-wynik').innerHTML = uwagi.join('');

    // --- budżet ---
    document.getElementById('ms-dochod').textContent = fmt(dochod);
    document.getElementById('ms-koszty').textContent = fmt(koszty);
    document.getElementById('ms-zob').textContent = fmt(zob);
    document.getElementById('ms-maxrata').textContent = fmt(w.maxRata);
    document.getElementById('budzet-sub').textContent = 'podział dochodu ' + fmt(dochod) + ' przy maksymalnym kredycie, z ratą liczoną po oprocentowaniu oferty';

    const zostaje = Math.max(0, dochod - koszty - zob - w.rataReal);
    const segmenty = [
        { nazwa: 'koszty utrzymania', v: koszty, kolor: '#b9c7bb' },
        { nazwa: 'obecne zobowiązania', v: zob, kolor: '#a8763e' },
        { nazwa: 'rata nowego kredytu', v: w.rataReal, kolor: '#24402f' },
        { nazwa: 'zostaje w budżecie', v: zostaje, kolor: '#ffffff' }
    ];
    const suma = segmenty.reduce(function (s, x) { return s + x.v; }, 0) || 1;
    document.getElementById('budzet-bar').innerHTML = segmenty.map(function (x) {
        return '<div style="width:' + (x.v / suma * 100).toFixed(2) + '%;background:' + x.kolor + ';"></div>';
    }).join('');
    document.getElementById('budzet-legend').innerHTML = segmenty.map(function (x) {
        return '<span><i style="background:' + x.kolor + ';"></i>' + x.nazwa + ' ' + fmt(x.v) + '</span>';
    }).join('');

    // --- komentarz ---
    let tytul, tekst;
    if (kwotaMax <= 0) {
        tytul = 'Zdolność wymaga poprawy';
        tekst = 'Przy obecnych danych bank nie wyliczy dodatniej zdolności. Największy wpływ mają zwykle limity kart i debetów, raty innych kredytów oraz okres kredytowania. Sprawdź tabelę „Jak zwiększyć zdolność”.';
    } else {
        tytul = 'Bank pozwoli pożyczyć do ' + fmt(kwotaMax);
        tekst = (w.ograniczenie === 'budzet'
            ? 'O wyniku decyduje budżet domowy: po odjęciu kosztów utrzymania (' + fmt(koszty) + ') i zobowiązań (' + fmt(zob) + ') zostaje ' + fmt(w.maxRata) + ' miesięcznie na ratę.'
            : 'O wyniku decyduje limit obciążenia dochodu (' + fmtProc(dtiLimit * 100) + '): na ratę zostaje ' + fmt(w.maxRata) + ' miesięcznie, mimo że budżet domowy dałby więcej.')
            + ' Bank liczy ratę przy oprocentowaniu ' + fmtProc(stopa + bufor) + ' (oferta plus bufor), dlatego faktyczna rata przy ' + fmtProc(stopa) + ' wyniesie ok. ' + fmt(w.rataReal) + '.'
            + ' Rozsądniej jednak nie wykorzystywać zdolności do końca: kredyt ' + fmt(kwotaKomfort) + ' oznacza ratę ok. ' + fmt(rataKomfort) + ' i zapas na wzrost stóp oraz nieplanowane wydatki.';
    }
    document.getElementById('rec-title').textContent = tytul;
    document.getElementById('rec-text').textContent = tekst;

    // --- wykres: okres ---
    const okresy = [10, 15, 20, 25, 30, 35].filter(function (l) { return l <= lataMax; });
    if (okresy.indexOf(lata) < 0) { okresy.push(lata); okresy.sort(function (a, b) { return a - b; }); }
    rysujSlupki('chart-okres', okresy.map(function (l) {
        return { label: l + ' ' + slowoLat(l), val: licz(Object.assign({}, P, { n: l * 12 })).kwota, aktywny: l === lata };
    }));

    // --- jak zwiększyć zdolność ---
    const warianty = [];
    if (zobLimity > 0) warianty.push({ nazwa: 'Zamknij karty kredytowe i limity debetowe', p: Object.assign({}, P, { zob: zob - zobLimity }) });
    if (raty > 0) warianty.push({ nazwa: 'Spłać kredyty ratalne i zakończ leasing', p: Object.assign({}, P, { zob: zob - raty }) });
    if (lataMax > lata) warianty.push({ nazwa: 'Wydłuż okres kredytowania do ' + lataMax + ' ' + slowoLat(lataMax), p: Object.assign({}, P, { n: lataMax * 12 }) });
    if (stopa > 0.6) warianty.push({ nazwa: 'Wynegocjuj oprocentowanie niższe o 0,5 p.p.', p: Object.assign({}, P, { stopa: stopa - 0.5 }) });
    if (osoby === 1) {
        const nowyDochod = dochod + ZAL.wspolkredytobiorcaTest;
        warianty.push({
            nazwa: 'Dodaj współkredytobiorcę (dochód ' + fmt(ZAL.wspolkredytobiorcaTest) + ' netto)',
            p: Object.assign({}, P, {
                dochod: nowyDochod, koszty: koszty + ZAL.koszty.dorosly2,
                dtiLimit: (nowyDochod >= num('prog-dochodu') ? num('dti-wys') : num('dti-nis')) / 100
            })
        });
    }
    const wiersze = warianty.map(function (x) {
        const k = licz(x.p).kwota;
        return { nazwa: x.nazwa, kwota: k, delta: k - w.kwota };
    }).filter(function (x) { return x.delta >= 1000; }).sort(function (a, b) { return b.delta - a.delta; });

    const boost = document.getElementById('boost-body');
    boost.innerHTML = '';
    if (!wiersze.length) {
        boost.innerHTML = '<tr><td colspan="3" style="text-align:left;">Przy Twoich danych żadna z typowych zmian nie podnosi zdolności o więcej niż 1 000 zł.</td></tr>';
    } else {
        wiersze.forEach(function (x) {
            const tr = document.createElement('tr');
            tr.innerHTML = '<td>' + x.nazwa + '</td><td>' + fmt(zaokr(x.kwota)) + '</td><td>' + fmtZm(x.delta) + '</td>';
            boost.appendChild(tr);
        });
    }

    // --- wrażliwość na oprocentowanie ---
    const rateBody = document.getElementById('rate-body');
    rateBody.innerHTML = '';
    [-1, -0.5, 0, 0.5, 1, 2].forEach(function (d) {
        const s = stopa + d;
        if (s < 0.1) return;
        const k = licz(Object.assign({}, P, { stopa: s })).kwota;
        const tr = document.createElement('tr');
        if (d === 0) tr.classList.add('is-active');
        tr.innerHTML = '<td>' + fmtProc(s) + (d === 0 ? ' (Twoje)' : '') + '</td><td>' + fmt(zaokr(k)) + '</td><td>' + (d === 0 ? '—' : fmtZm(k - w.kwota)) + '</td>';
        rateBody.appendChild(tr);
    });

    if (przewin) {
        document.getElementById('wyniki').scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
}

// Przeliczanie na żywo podczas wpisywania (z opóźnieniem, bez przewijania strony).
let liveTimer = null;
function planujPrzeliczenie() { clearTimeout(liveTimer); liveTimer = setTimeout(function () { oblicz(false); }, 200); }
document.querySelectorAll('input, select').forEach(function (el) {
    el.addEventListener('input', planujPrzeliczenie);
    el.addEventListener('change', planujPrzeliczenie);
});
document.getElementById('okres').addEventListener('input', synchronizujPillOkres);

window.addEventListener('load', function () { oblicz(false); });

let resizeTimer = null;
window.addEventListener('resize', function () {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(function () { oblicz(false); }, 250);
});
</script>

</body>
</html>
