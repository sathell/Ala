<div>
    <div class="form-heading">Bezpłatna konsultacja</div>
    <p class="form-sub">Wypełnij formularz — odezwę się w ciągu 24 godzin.</p>
    <form id="contact-form" onsubmit="submitContact(event)" novalidate>
        <div class="fg"><label for="contact-name">Imię i nazwisko</label><input type="text" id="contact-name"
                name="name" placeholder="Jan Kowalski" required>
            <div class="field-error" id="contact-name-err"></div>
        </div>
        <div class="fg"><label for="contact-tel">Telefon</label><input type="tel" id="contact-tel" name="tel"
                placeholder="+48 500 000 000" required>
            <div class="field-error" id="contact-tel-err"></div>
        </div>
        <div class="fg"><label for="contact-email">E-mail</label><input type="email" id="contact-email" name="email"
                placeholder="jan@example.com">
            <div class="field-error" id="contact-email-err"></div>
        </div>
        <div class="fg">
            <label for="contact-type">Rodzaj kredytu</label>
            <select name="type" id="contact-type">
                <option value="">— Wybierz —</option>
                <option>Kredyt hipoteczny</option>
                <option>Kredyt firmowy</option>
                <option>Refinansowanie</option>
                <option>Analiza zdolności</option>
                <option>Inne</option>
            </select>
        </div>
        <div class="fg"><label for="contact-message">Wiadomość (opcjonalnie)</label><textarea id="contact-message"
                name="message" placeholder="Krótko opisz swoją sytuację…"></textarea></div>
        <button type="submit" class="btn" id="contact-submit">Wyślij zapytanie</button>
        <div class="form-success" id="contact-success">Wiadomość wysłana! Odezwę się w ciągu 24 godzin.
        </div>
        <div class="form-err-general" id="contact-err-general">Wystąpił błąd serwera. Spróbuj ponownie
            lub zadzwoń bezpośrednio.</div>
    </form>
</div>
<script>if("function"!=typeof showFieldErr)function showFieldErr(e,t){var n=document.getElementById(e);n&&(n.textContent=t,n.classList.add("show"))}if("function"!=typeof clearFieldErr)function clearFieldErr(e){var t=document.getElementById(e);t&&(t.textContent="",t.classList.remove("show"))}if("function"!=typeof setInvalid)function setInvalid(e){e&&e.classList.add("invalid")}if("function"!=typeof clearInvalid)function clearInvalid(e){e&&e.classList.remove("invalid")}if("function"!=typeof validateName)function validateName(e){var t=(e||"").trim().split(" ").filter(function(e){return e.trim().length>0});if(t.length<2)return!1;for(var n=0;n<t.length;n++)if(t[n].length<2)return!1;return!0}if("function"!=typeof validatePhone)function validatePhone(e){var t=(e||"").replace(/[^0-9]/g,"");return e&&"+"===e.charAt(0)&&11===t.length}if("function"!=typeof validateEmail)function validateEmail(e){var t=(e=(e||"").trim()).indexOf("@"),n=e.lastIndexOf(".");return t>0&&n>t+1&&n<e.length-1}if("function"!=typeof formatPhoneInput){function formatPhoneInput(e){var t=(e.value||"").replace(/[^0-9]/g,"").slice(0,11);if(0!==t.length){var n="+"+t.slice(0,2);t.length>2&&(n+=" "+t.slice(2,5)),t.length>5&&(n+=" "+t.slice(5,8)),t.length>8&&(n+=" "+t.slice(8,11)),e.value=n}else e.value=""}!function(){var e=document.getElementById("contact-tel");e&&e.addEventListener("input",function(){formatPhoneInput(this)})}()}function submitContact(e){e.preventDefault();var t=document.getElementById("contact-form"),n=document.getElementById("contact-submit"),a=document.getElementById("contact-name"),i=document.getElementById("contact-tel"),o=document.getElementById("contact-email"),l=a?a.value.trim():"",r=i?i.value.trim():"",c=o?o.value.trim():"";clearFieldErr("contact-name-err"),clearInvalid(a),clearFieldErr("contact-tel-err"),clearInvalid(i),clearFieldErr("contact-email-err"),clearInvalid(o);var d=document.getElementById("contact-err-general"),s=document.getElementById("contact-success");d&&d.classList.remove("show"),s&&s.classList.remove("show");var m=!0;if(l?validateName(l)||(showFieldErr("contact-name-err","Podaj imię i nazwisko — każde co najmniej 2 litery, oddzielone spacją."),setInvalid(a),m=!1):(showFieldErr("contact-name-err","Proszę podać imię i nazwisko."),setInvalid(a),m=!1),r?validatePhone(r)||(showFieldErr("contact-tel-err",'Podaj numer w formacie +XX XXX XXX XXX (znak "+" i dokładnie 11 cyfr).'),setInvalid(i),m=!1):(showFieldErr("contact-tel-err","Proszę podać numer telefonu."),setInvalid(i),m=!1),c&&!validateEmail(c)&&(showFieldErr("contact-email-err","Podaj poprawny adres e-mail (np. jan@example.com)."),setInvalid(o),m=!1),m){n.disabled=!0,n.textContent="Wysyłanie…";var u={name:l,tel:r.replace(/\s/g,""),email:c,type:t.elements.type.value,message:t.elements.message.value.trim()};fetch(CFG_ENDPOINT_CONTACT,{method:"POST",headers:{"Content-Type":"application/json"},body:JSON.stringify(u)}).then(function(e){if(429===e.status)return n.disabled=!1,n.textContent="Wyślij zapytanie",void(d&&(d.textContent="Dzienny limit wiadomości (2) został osiągnięty. Spróbuj ponownie jutro lub zadzwoń bezpośrednio.",d.classList.add("show")));if(!e.ok)throw new Error("HTTP "+e.status);n.disabled=!1,n.textContent="Wyślij zapytanie",s&&s.classList.add("show"),t.reset()}).catch(function(){n.disabled=!1,n.textContent="Wyślij zapytanie",d&&d.classList.add("show")})}}</script>