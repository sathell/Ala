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

<script>!function(){var e="am_cookie_consent";function t(){var t=document.getElementById("cookie-banner");if(t){var n;(n=document.cookie.match(new RegExp("(?:^|; )"+e+"=([^;]*)")))&&n[1]||setTimeout(function(){t.classList.add("visible")},600);var o=document.getElementById("cookie-accept-all");o&&o.addEventListener("click",function(){i("all"),a()});var c=document.getElementById("cookie-accept-necessary");c&&c.addEventListener("click",function(){i("necessary"),a()})}function i(t){var n=new Date;n.setFullYear(n.getFullYear()+1),document.cookie=e+"="+t+"; expires="+n.toUTCString()+"; path=/; SameSite=Lax"}function a(){t.classList.remove("visible"),setTimeout(function(){t.style.display="none"},350)}}"loading"===document.readyState?document.addEventListener("DOMContentLoaded",t):t()}();</script>