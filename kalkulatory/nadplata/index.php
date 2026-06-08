<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="/media/main-icon.png" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator nadpłaty kredytu hipotecznego — Alicja Muryn | Ekspert Kredytowy Koszalin</title>
    <meta name="description" content="Oblicz ile zaoszczędzisz na odsetkach dzięki nadpłacie kredytu hipotecznego. Porównaj skrócenie okresu kredytowania z obniżeniem raty.">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Alicja Muryn">
    <link rel="canonical" href="https://kredyty-koszalin.pl/kalkulatory/nadplata/">

    <meta property="og:type" content="website">
    <meta property="og:url" content="https://kredyty-koszalin.pl/kalkulatory/nadplata/">
    <meta property="og:title" content="Kalkulator nadpłaty kredytu hipotecznego — Alicja Muryn">
    <meta property="og:description" content="Oblicz ile zaoszczędzisz na odsetkach dzięki nadpłacie kredytu hipotecznego.">
    <meta property="og:image" content="https://kredyty-koszalin.pl/media/og-image.jpg">
    <meta property="og:locale" content="pl_PL">
    <meta property="og:site_name" content="Ekspert Kredytowy Koszalin">

    <script type="application/ld+json">
    [
      {
        "@context": "https://schema.org",
        "@type": "WebPage",
        "name": "Kalkulator nadpłaty kredytu hipotecznego",
        "description": "Oblicz ile zaoszczędzisz na odsetkach dzięki nadpłacie kredytu hipotecznego. Porównaj skrócenie okresu z obniżeniem raty.",
        "url": "https://kredyty-koszalin.pl/kalkulatory/nadplata/",
        "inLanguage": "pl",
        "author": { "@type": "Person", "name": "Alicja Muryn", "url": "https://kredyty-koszalin.pl" }
      },
      {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [
          { "@type": "ListItem", "position": 1, "name": "Strona główna", "item": "https://kredyty-koszalin.pl" },
          { "@type": "ListItem", "position": 2, "name": "Kalkulatory", "item": "https://kredyty-koszalin.pl/kalkulatory/" },
          { "@type": "ListItem", "position": 3, "name": "Kalkulator nadpłaty", "item": "https://kredyty-koszalin.pl/kalkulatory/nadplata/" }
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
                    <div class="stag">Kalkulator 01</div>
                    <h1 class="page-title">Kalkulator nadpłaty kredytu hipotecznego</h1>
                    <p class="page-lead">Wpisz dane swojego kredytu i kwotę nadpłaty — kalkulator policzy, ile zaoszczędzisz na odsetkach i jak zmieni się Twój harmonogram spłaty.</p>
                    <div class="rule"></div>
                </div>

                <!-- FORMULARZ -->
                <div class="kalk-block">
                    <div class="kalk-block-title">Dane kredytu</div>
                    <div class="kalk-grid">
                        <div class="kalk-field">
                            <label for="saldo">Aktualne saldo kredytu</label>
                            <div class="kalk-input-wrap">
                                <input type="number" id="saldo" value="400000" min="1000" step="1000">
                                <span class="unit">PLN</span>
                            </div>
                        </div>
                        <div class="kalk-field">
                            <label for="oprocentowanie">Oprocentowanie nominalne</label>
                            <div class="kalk-input-wrap">
                                <input type="number" id="oprocentowanie" value="7.5" min="0.1" max="30" step="0.1">
                                <span class="unit">% rocznie</span>
                            </div>
                        </div>
                        <div class="kalk-field">
                            <label for="okres">Pozostały okres kredytowania</label>
                            <div class="kalk-input-wrap">
                                <input type="number" id="okres" value="25" min="1" max="35" step="1">
                                <span class="unit">lat</span>
                            </div>
                        </div>
                        <div class="kalk-field">
                            <label for="rata-aktualna">Aktualna rata miesięczna</label>
                            <div class="kalk-input-wrap">
                                <input type="number" id="rata-aktualna" value="2850" min="100" step="10">
                                <span class="unit">PLN</span>
                            </div>
                            <span class="kalk-hint">Wpisz ratę z ostatniego wyciągu lub harmonogramu spłat</span>
                        </div>
                        <div class="kalk-field">
                            <label for="nadplata">Kwota jednorazowej nadpłaty</label>
                            <div class="kalk-input-wrap">
                                <input type="number" id="nadplata" value="30000" min="100" step="500">
                                <span class="unit">PLN</span>
                            </div>
                        </div>
                    </div>
                    <div class="kalk-grid-2col">
                        <div class="kalk-field">
                            <label for="typ-raty">Typ raty</label>
                            <select id="typ-raty">
                                <option value="rowne">Raty równe (annuitetowe)</option>
                                <option value="malejace">Raty malejące (kapitałowe)</option>
                            </select>
                        </div>
                        <div class="kalk-field">
                            <label for="cel-nadplaty">Po nadpłacie chcę</label>
                            <select id="cel-nadplaty">
                                <option value="skrocenie">Skrócić okres kredytowania</option>
                                <option value="obnizenie">Obniżyć wysokość raty</option>
                            </select>
                        </div>
                    </div>
                    <button class="kalk-btn" onclick="oblicz()">Oblicz oszczędności z nadpłaty</button>
                </div>

                <!-- WYNIKI -->
                <div class="kalk-results" id="wyniki">

                    <div class="kalk-metrics" id="kalk-metrics-grid">
                        <div class="kalk-metric kalk-metric--accent">
                            <div class="kalk-metric-label">Oszczędność na odsetkach</div>
                            <div class="kalk-metric-val" id="r-oszczednosc">—</div>
                            <div class="kalk-metric-sub">dzięki nadpłacie</div>
                        </div>
                        <div class="kalk-metric">
                            <div class="kalk-metric-label">Aktualna rata</div>
                            <div class="kalk-metric-val" id="r-rata-przed">—</div>
                            <div class="kalk-metric-sub">PLN miesięcznie</div>
                        </div>
                        <div class="kalk-metric">
                            <div class="kalk-metric-label" id="r-label-po">Rata po nadpłacie</div>
                            <div class="kalk-metric-val" id="r-rata-po">—</div>
                            <div class="kalk-metric-sub" id="r-sub-po">PLN miesięcznie</div>
                        </div>
                        <div class="kalk-metric">
                            <div class="kalk-metric-label" id="r-label-okres">Skrócenie okresu</div>
                            <div class="kalk-metric-val" id="r-okres-po">—</div>
                            <div class="kalk-metric-sub" id="r-sub-okres">—</div>
                        </div>
                    </div>

                    <div class="kalk-table-wrap">
                        <table class="kalk-compare">
                            <thead>
                                <tr>
                                    <th>Parametr</th>
                                    <th>Bez nadpłaty</th>
                                    <th>Z nadpłatą</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Okres kredytowania</td>
                                    <td id="t-okres-przed">—</td>
                                    <td class="better" id="t-okres-po">—</td>
                                </tr>
                                <tr>
                                    <td>Łączna suma odsetek</td>
                                    <td id="t-odsetki-przed">—</td>
                                    <td class="better" id="t-odsetki-po">—</td>
                                </tr>
                                <tr>
                                    <td>Łączna kwota do spłaty</td>
                                    <td id="t-suma-przed">—</td>
                                    <td class="better" id="t-suma-po">—</td>
                                </tr>
                                <tr>
                                    <td>Miesięczna rata</td>
                                    <td id="t-rata-przed">—</td>
                                    <td class="better" id="t-rata-po">—</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="kalk-rec">
                        <div class="kalk-rec-rule"></div>
                        <div>
                            <div class="kalk-rec-title" id="rec-title">—</div>
                            <p class="kalk-rec-text" id="rec-text">—</p>
                        </div>
                    </div>

                </div>
                <!-- /WYNIKI -->

                <div class="kalk-disclaimer">
                    <p><strong>Uwaga:</strong> Wyniki mają charakter informacyjny i poglądowy. Kalkulator zakłada stałe oprocentowanie przez cały okres kredytowania. Rzeczywiste efekty nadpłaty zależą od warunków umowy kredytowej, polityki banku dotyczącej nadpłat (możliwe prowizje w niektórych bankach), aktualnego salda i harmonogramu spłat. Skontaktuj się ze swoim bankiem lub doradcą kredytowym przed podjęciem decyzji.</p>
                </div>

                <div class="kalk-article">
                    <h2>Kiedy warto nadpłacać kredyt hipoteczny?</h2>
                    <p>Nadpłata kredytu to jedna z najskuteczniejszych metod redukcji kosztów kredytu. Każda złotówka wpłacona ponad wymaganą ratę bezpośrednio zmniejsza kapitał, od którego naliczane są odsetki — a to oznacza, że przez resztę okresu kredytowania płacisz odsetki od mniejszej kwoty.</p>

                    <h2>Skrócenie okresu vs. obniżenie raty</h2>
                    <p>Banki zwykle oferują dwa warianty po nadpłacie:</p>
                    <ul>
                        <li><strong>Skrócenie okresu</strong> — rata pozostaje taka sama, ale kredyt spłacisz wcześniej. To rozwiązanie przynosi większe oszczędności na odsetkach.</li>
                        <li><strong>Obniżenie raty</strong> — okres kredytowania pozostaje taki sam, ale miesięczna rata maleje. Poprawia to płynność finansową, ale oznacza mniejsze łączne oszczędności.</li>
                    </ul>
                    <p>Które wybrać? To zależy od Twojej sytuacji. Jeśli masz stabilne dochody i nie obawiasz się o płynność — skrócenie okresu jest zazwyczaj korzystniejsze finansowo. Jeśli potrzebujesz większego buforu bezpieczeństwa co miesiąc — warto rozważyć obniżenie raty.</p>

                    <h2>Czy bank może pobierać prowizję za nadpłatę?</h2>
                    <p>Zgodnie z ustawą o kredycie hipotecznym, banki mogą pobierać prowizję za nadpłatę jedynie przez pierwsze 3 lata trwania umowy. Po tym czasie nadpłata powinna być bezpłatna. Warto jednak sprawdzić zapisy swojej umowy kredytowej.</p>
                </div>

                <div class="kalk-cta">
                    <div class="kalk-cta-title">Chcesz omówić strategię nadpłat?</div>
                    <p class="kalk-cta-text">Pomogę Ci dobrać optymalną strategię nadpłat do Twojej sytuacji — bezpłatnie, bez zobowiązań.</p>
                    <a href="/kontakt/" class="kalk-cta-btn">Umów konsultację</a>
                </div>

            </main>
            <?php include __DIR__ . '/../../komponenty/pasek-boczny-komentarze.php'; ?>
        </div>
    </div>

    <?php include __DIR__ . '/../../komponenty/stopka.php'; ?>

<script>
function fmt(n) {
    return Math.round(n).toLocaleString('pl-PL') + ' zł';
}
function fmtLat(mies) {
    const l = Math.floor(mies / 12);
    const m = Math.round(mies % 12);
    if (l === 0) return m + ' mies.';
    if (m === 0) return l + ' lat';
    return l + ' lat ' + m + ' mies.';
}

function symuluj(kapitalStart, stopa_m, rata) {
    let K = kapitalStart;
    let sumaOdsetek = 0;
    let miesiace = 0;
    const MAX = 600;
    while (K > 0.01 && miesiace < MAX) {
        const ods = K * stopa_m;
        const kapCzesc = Math.min(rata - ods, K);
        if (kapCzesc <= 0) break;
        sumaOdsetek += ods;
        K -= kapCzesc;
        miesiace++;
    }
    return { miesiace, sumaOdsetek };
}

function rataRowna(K, r, n) {
    if (r === 0) return K / n;
    return K * r * Math.pow(1 + r, n) / (Math.pow(1 + r, n) - 1);
}

function oblicz() {
    const saldo       = parseFloat(document.getElementById('saldo').value);
    const oprocRoczne = parseFloat(document.getElementById('oprocentowanie').value) / 100;
    const okresLat    = parseInt(document.getElementById('okres').value);
    const rataAkt     = parseFloat(document.getElementById('rata-aktualna').value);
    const nadplata    = parseFloat(document.getElementById('nadplata').value);
    const cel         = document.getElementById('cel-nadplaty').value;

    if (!saldo || !oprocRoczne || !okresLat || !rataAkt || !nadplata) {
        alert('Wypełnij wszystkie pola.');
        return;
    }
    if (nadplata >= saldo) {
        alert('Kwota nadpłaty nie może być wyższa niż saldo kredytu.');
        return;
    }

    const stopa_m = oprocRoczne / 12;
    const n = okresLat * 12;
    const minRata = saldo * stopa_m;

    if (rataAkt <= minRata) {
        alert('Podana rata (' + Math.round(rataAkt).toLocaleString('pl-PL') + ' zł) jest za niska — nie pokrywa nawet odsetek od aktualnego salda (' + Math.round(minRata).toLocaleString('pl-PL') + ' zł). Sprawdź dane.');
        return;
    }

    // BEZ NADPŁATY
    const simBez = symuluj(saldo, stopa_m, rataAkt);
    const odsetkiBez  = simBez.sumaOdsetek;
    const miesiąceBez = simBez.miesiace;
    const sumaBez     = saldo + odsetkiBez;

    // Z NADPŁATĄ
    const noweKapital = saldo - nadplata;
    let rataPoVal, odsetkiPo, miesiacePo, sumaPo;

    if (cel === 'skrocenie') {
        const simPo = symuluj(noweKapital, stopa_m, rataAkt);
        rataPoVal  = rataAkt;
        odsetkiPo  = simPo.sumaOdsetek;
        miesiacePo = simPo.miesiace;
        sumaPo     = noweKapital + odsetkiPo + nadplata;
    } else {
        miesiacePo = n;
        rataPoVal  = rataRowna(noweKapital, stopa_m, n);
        const simPo = symuluj(noweKapital, stopa_m, rataPoVal);
        odsetkiPo  = simPo.sumaOdsetek;
        sumaPo     = noweKapital + odsetkiPo + nadplata;
    }

    const oszczednosc = sumaBez - sumaPo;

    // WYNIKI
    document.getElementById('r-oszczednosc').textContent = fmt(oszczednosc);
    document.getElementById('r-rata-przed').textContent  = Math.round(rataAkt).toLocaleString('pl-PL');

    if (cel === 'skrocenie') {
        const skrocMies = miesiąceBez - miesiacePo;
        document.getElementById('r-label-po').textContent    = 'Rata po nadpłacie';
        document.getElementById('r-rata-po').textContent     = Math.round(rataPoVal).toLocaleString('pl-PL');
        document.getElementById('r-sub-po').textContent      = 'PLN (bez zmian)';
        document.getElementById('r-label-okres').textContent = 'Skrócenie okresu';
        document.getElementById('r-okres-po').textContent    = fmtLat(skrocMies);
        document.getElementById('r-sub-okres').textContent   = fmtLat(miesiąceBez) + ' → ' + fmtLat(miesiacePo);
    } else {
        const obnizenie = rataAkt - rataPoVal;
        document.getElementById('r-label-po').textContent    = 'Nowa rata';
        document.getElementById('r-rata-po').textContent     = Math.round(rataPoVal).toLocaleString('pl-PL');
        document.getElementById('r-sub-po').textContent      = 'PLN (obniżona o ' + Math.round(obnizenie).toLocaleString('pl-PL') + ' zł)';
        document.getElementById('r-label-okres').textContent = 'Oszczędność na odsetkach';
        document.getElementById('r-okres-po').textContent    = fmt(oszczednosc);
        document.getElementById('r-sub-okres').textContent   = 'mniejsza suma odsetek';
    }

    document.getElementById('t-okres-przed').textContent   = fmtLat(miesiąceBez);
    document.getElementById('t-okres-po').textContent      = fmtLat(miesiacePo);
    document.getElementById('t-odsetki-przed').textContent = fmt(odsetkiBez);
    document.getElementById('t-odsetki-po').textContent    = fmt(odsetkiPo);
    document.getElementById('t-suma-przed').textContent    = fmt(sumaBez);
    document.getElementById('t-suma-po').textContent       = fmt(sumaPo);
    document.getElementById('t-rata-przed').textContent    = fmt(rataAkt) + '/mies.';
    document.getElementById('t-rata-po').textContent       = fmt(rataPoVal) + '/mies.';

    const recTitle = document.getElementById('rec-title');
    const recText  = document.getElementById('rec-text');
    if (cel === 'skrocenie') {
        const skrocMies = miesiąceBez - miesiacePo;
        recTitle.textContent = 'Nadpłata skraca kredyt o ' + fmtLat(skrocMies);
        recText.textContent  = 'Wpłacając jednorazowo ' + fmt(nadplata) + ' na poczet kapitału i zachowując dotychczasową ratę ' + fmt(rataAkt) + ', zakończysz spłatę ' + fmtLat(skrocMies) + ' wcześniej. Łączna oszczędność na odsetkach wyniesie ' + fmt(oszczednosc) + '. Warto sprawdzić w banku, czy w Twoim przypadku nie obowiązuje prowizja za wcześniejszą spłatę.';
    } else {
        const obnizenie = rataAkt - rataPoVal;
        recTitle.textContent = 'Rata obniży się o ' + fmt(obnizenie) + ' miesięcznie';
        recText.textContent  = 'Wpłacając jednorazowo ' + fmt(nadplata) + ' i zachowując dotychczasowy okres kredytowania (' + fmtLat(n) + '), Twoja miesięczna rata zmniejszy się z ' + fmt(rataAkt) + ' do ' + fmt(rataPoVal) + '. Łączna oszczędność na odsetkach wyniesie ' + fmt(oszczednosc) + '. To rozwiązanie poprawia bieżącą płynność finansową.';
    }

    const wyniki = document.getElementById('wyniki');
    wyniki.classList.add('visible');
    wyniki.scrollIntoView({ behavior: 'smooth', block: 'start' });
}
</script>

</body>
</html>
