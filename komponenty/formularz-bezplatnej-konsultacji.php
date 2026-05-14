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
<script>
    // Conditional helpers so component works standalone
    if (typeof showFieldErr !== 'function') {
        function showFieldErr(id, msg) { var el = document.getElementById(id); if (!el) return; el.textContent = msg; el.classList.add('show'); }
    }
    if (typeof clearFieldErr !== 'function') {
        function clearFieldErr(id) { var el = document.getElementById(id); if (el) { el.textContent = ''; el.classList.remove('show'); } }
    }
    if (typeof setInvalid !== 'function') { function setInvalid(inp) { if (inp) inp.classList.add('invalid'); } }
    if (typeof clearInvalid !== 'function') { function clearInvalid(inp) { if (inp) inp.classList.remove('invalid'); } }

    if (typeof validateName !== 'function') {
        function validateName(val) {
            var parts = (val || '').trim().split(' ').filter(function (p) { return p.trim().length > 0; });
            if (parts.length < 2) return false;
            for (var i = 0; i < parts.length; i++) if (parts[i].length < 2) return false;
            return true;
        }
    }
    if (typeof validatePhone !== 'function') {
        function validatePhone(val) { var digits = (val || '').replace(/[^0-9]/g, ''); return val && val.charAt(0) === '+' && digits.length === 11; }
    }
    if (typeof validateEmail !== 'function') {
        function validateEmail(val) { val = (val || '').trim(); var at = val.indexOf('@'); var dot = val.lastIndexOf('.'); return at > 0 && dot > at + 1 && dot < val.length - 1; }
    }

    if (typeof formatPhoneInput !== 'function') {
        function formatPhoneInput(input) {
            var digits = (input.value || '').replace(/[^0-9]/g, '').slice(0, 11);
            if (digits.length === 0) { input.value = ''; return; }
            var f = '+' + digits.slice(0, 2);
            if (digits.length > 2) f += ' ' + digits.slice(2, 5);
            if (digits.length > 5) f += ' ' + digits.slice(5, 8);
            if (digits.length > 8) f += ' ' + digits.slice(8, 11);
            input.value = f;
        }
        (function () { var t = document.getElementById('contact-tel'); if (t) t.addEventListener('input', function () { formatPhoneInput(this); }); })();
    }

    function submitContact(e) {
        e.preventDefault();
        var form = document.getElementById('contact-form');
        var btn = document.getElementById('contact-submit');
        var nameInp = document.getElementById('contact-name');
        var telInp = document.getElementById('contact-tel');
        var emailInp = document.getElementById('contact-email');
        var name = nameInp ? nameInp.value.trim() : '';
        var tel = telInp ? telInp.value.trim() : '';
        var email = emailInp ? emailInp.value.trim() : '';

        clearFieldErr('contact-name-err'); clearInvalid(nameInp);
        clearFieldErr('contact-tel-err'); clearInvalid(telInp);
        clearFieldErr('contact-email-err'); clearInvalid(emailInp);
        var genErr = document.getElementById('contact-err-general');
        var success = document.getElementById('contact-success');
        if (genErr) genErr.classList.remove('show');
        if (success) success.classList.remove('show');

        var ok = true;
        if (!name) { showFieldErr('contact-name-err', 'Proszę podać imię i nazwisko.'); setInvalid(nameInp); ok = false; }
        else if (!validateName(name)) { showFieldErr('contact-name-err', 'Podaj imię i nazwisko — każde co najmniej 2 litery, oddzielone spacją.'); setInvalid(nameInp); ok = false; }
        if (!tel) { showFieldErr('contact-tel-err', 'Proszę podać numer telefonu.'); setInvalid(telInp); ok = false; }
        else if (!validatePhone(tel)) { showFieldErr('contact-tel-err', 'Podaj numer w formacie +XX XXX XXX XXX (znak "+" i dokładnie 11 cyfr).'); setInvalid(telInp); ok = false; }
        if (email && !validateEmail(email)) { showFieldErr('contact-email-err', 'Podaj poprawny adres e-mail (np. jan@example.com).'); setInvalid(emailInp); ok = false; }
        if (!ok) return;

        btn.disabled = true; btn.textContent = 'Wysyłanie…';
        var data = { name: name, tel: tel.replace(/\s/g, ''), email: email, type: form.elements['type'].value, message: form.elements['message'].value.trim() };
        fetch(CFG_ENDPOINT_CONTACT, { method: 'POST', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify(data) })
            .then(function (r) {
                if (r.status === 429) { btn.disabled = false; btn.textContent = 'Wyślij zapytanie'; if (genErr) { genErr.textContent = 'Dzienny limit wiadomości (2) został osiągnięty. Spróbuj ponownie jutro lub zadzwoń bezpośrednio.'; genErr.classList.add('show'); } return; }
                if (!r.ok) throw new Error('HTTP ' + r.status);
                btn.disabled = false; btn.textContent = 'Wyślij zapytanie'; if (success) success.classList.add('show'); form.reset();
            })
            .catch(function () { btn.disabled = false; btn.textContent = 'Wyślij zapytanie'; if (genErr) genErr.classList.add('show'); });
    }
</script>