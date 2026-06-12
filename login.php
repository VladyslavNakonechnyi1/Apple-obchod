<?php
session_start();
// Pripojime databazu
require_once 'Database.php';

// Ak uz je prihlaseny rovno ho hodime do adminu
if (isset($_SESSION['prihlaseny_uzivatel'])) {
    header("Location: admin.php");
    exit();
}

$chyba = "";

// Spracovanie formulara
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $database = new Database();
    $db = $database->getConnection();
    // Deletne medzery
    $meno = trim($_POST['meno']);
    $heslo = trim($_POST['heslo']);

    $hladaj = $db->prepare("SELECT * FROM users WHERE username = ?");
    $hladaj->execute([$meno]);
    $uzivatel = $hladaj->fetch(PDO::FETCH_ASSOC);

    // Kontrola hesla
    if ($uzivatel && password_verify($heslo, $uzivatel['password'])) {
        $_SESSION['prihlaseny_uzivatel'] = $uzivatel['username'];
        header("Location: admin.php");
        exit();
    } else {
        $chyba = "Zlé meno alebo heslo!";
    }
}
?>

<?php include 'header/header.php'; ?>

<link rel="stylesheet" href="/apple-obchod/css/kontakt.css">

<section class="Kontakt">
    <h1>Prihlásenie</h1>
    <p class="dole">Zadajte svoje údaje pre vstup do administrácie</p>

    <?php if($chyba): ?>
        <p style="color: red; font-weight: bold; text-align: center;"><?php echo $chyba; ?></p>
    <?php endif; ?>

    <form id="contactForm" action="login.php" method="POST">
        <input type="text" name="meno" placeholder="Prihlasovacie meno" required>
        <input type="password" name="heslo" placeholder="Heslo" required>
        <button type="submit">Prihlásiť sa</button>
    </form>
    
    <div style="text-align: center; margin-top: 20px;">
        <a href="register.php" style="color: inherit; text-decoration: underline;">Nemáš účet? Zaregistruj sa</a>
    </div>
</section>

<?php include 'footer/footer.php'; ?>