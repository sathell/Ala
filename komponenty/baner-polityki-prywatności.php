<style>
    #cookie-banner {
        display: none;
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        z-index: 9999;
        background: var(--dark);
        border-top: 2px solid var(--gold);
        box-shadow: 0 -4px 24px rgba(0, 0, 0, .35);
        padding: 18px 24px;
        animation: cookieSlideUp .35s ease;
    }

    #cookie-banner.visible {
        display: block;
    }
</style>

<div id="cookie-banner" role="dialog" aria-label="Informacja o plikach cookie" aria-modal="false">
    <div class="cookie-inner">
        <p class="cookie-text">
            Ta strona używa plików <strong>cookie</strong> w celu zapewnienia prawidłowego działania, analizy ruchu
            oraz personalizacji treści.
            Korzystając ze strony, wyrażasz zgodę na ich używanie zgodnie z <a href="/polityka-prywatnosci"
                class="cookie-link">Polityką prywatności</a>.
        </p>
        <div class="cookie-btns">
            <button id="cookie-accept-all" class="cookie-btn cookie-btn--primary">Akceptuję wszystkie</button>
            <button id="cookie-accept-necessary" class="cookie-btn cookie-btn--secondary">Tylko niezbędne</button>
        </div>
    </div>
</div>

<script>
(function () {
    var COOKIE_KEY = 'am_cookie_consent';
    function init() {
        var banner = document.getElementById('cookie-banner');
        if (!banner) return;

        function setCookie(value) {
            var d = new Date();
            d.setFullYear(d.getFullYear() + 1);
            document.cookie = COOKIE_KEY + '=' + value + '; expires=' + d.toUTCString() + '; path=/; SameSite=Lax';
        }

        function getCookie() {
            var match = document.cookie.match(new RegExp('(?:^|; )' + COOKIE_KEY + '=([^;]*)'));
            return match ? match[1] : null;
        }

        function hideBanner() {
            banner.classList.remove('visible');
            setTimeout(function () { banner.style.display = 'none'; }, 350);
        }

        if (!getCookie()) {
            setTimeout(function () { banner.classList.add('visible'); }, 600);
        }

        var btnAll = document.getElementById('cookie-accept-all');
        if (btnAll) btnAll.addEventListener('click', function () { setCookie('all'); hideBanner(); });
        var btnNecessary = document.getElementById('cookie-accept-necessary');
        if (btnNecessary) btnNecessary.addEventListener('click', function () { setCookie('necessary'); hideBanner(); });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
</script>