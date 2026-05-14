<aside class="sidebar">
    <div class="sidebar-brand">Alicja Muryn<br>Ekspert Kredytowy</div>
    <nav class="sidebar-nav">
        <a href="/">Strona główna</a>
        <a href="/#o-mnie">O mnie</a>
        <a href="/#oferta">Oferta</a>
        <?php
        $current_uri = $_SERVER['REQUEST_URI'] ?? '/';
        $path = parse_url($current_uri, PHP_URL_PATH);
        $is_komentarze = trim($path, '/') === 'komentarze';
        ?>
        <a href="<?php echo $is_komentarze ? '/#wermado' : '/komentarze'; ?>"><?php echo $is_komentarze ? 'Domy modułowe' : 'Komentarze eksperta'; ?></a>
        <a href="/#opinie">Opinie klientów</a>
        <a href="/#kontakt">Kontakt</a>
    </nav>
    <?php include __DIR__ . '\formularz-bezplatnej-konsultacji.php'; ?>
</aside>