<footer>
  <nav>
    <a href="index.php">Domov</a>
    <a href="o-nas.php">O nás</a>
    <a href="galeria.php">Galéria</a>
    <a href="kontakt.php">Kontakt</a>
    
    <?php if (isset($_SESSION['prihlaseny_uzivatel'])): ?>
        <a href="admin.php" style="color: #0071e3; font-weight: bold;">Admin</a>
        <a href="logout.php" style="color: red;">Odhlásiť</a>
    <?php else: ?>
        <a href="login.php">Prihlásenie</a>
    <?php endif; ?>
  </nav>
  <p>© 2026 Fan stranka Apple. Všetky práva vyhradené</p>
  <p>Vytvoril: Vladyslav Nakonechnyi</p>
  <p>Email: <a href="mailto:info@apple.com" class="contact-link">info@apple.com</a></p>
  <p>Tel: <a href="tel:+421901234567" class="contact-link">+421 923 456 567</a></p>
</footer>
</body>
</html>