<?php include 'header/header.php'; ?>

<link rel="stylesheet" href="/apple-obchod/css/kontakt.css">

<section class="Kontakt">
    <h1>Kontakt</h1>
    <p class="dole">Máte otázky? Napíšte nám a my vám odpovieme čo najskôr</p>

    <form id="contactForm" action="dakujem.php" method="get">
        <input type="text" name="Meno" placeholder="Meno" required>
        <input type="email" name="email" placeholder="Email" required>
        <textarea name="message" placeholder="Vaša správa" required></textarea>
        <label class="suhlas">
            <input type="checkbox" name="consent" required>
            Súhlas so spracovaním osobných údajov
        </label>
        <button type="submit">Odoslať</button>
    </form>
</section>

<?php include 'footer/footer.php'; ?>