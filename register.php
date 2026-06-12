<?php
session_start();
// Pripojime databazu
require_once 'Database.php';

// Ak uz je prihlaseny hodime ho prec
if (isset($_SESSION['prihlaseny_uzivatel'])) {
    header("Location: galeria.php");
    exit();
}

$chyba = "";
$uspech = "";

// Spracovanie formulara
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $database = new Database();
    $db = $database->getConnection();
    // Deletne medzery
    $meno = trim($_POST['meno']);
    $heslo = trim($_POST['heslo']);

    if (!empty($meno) && !empty($heslo)) {
        $kontrola = $db->prepare("SELECT id FROM users WHERE username = ?");
        $kontrola->execute([$meno]);

        if ($kontrola->rowCount() > 0) {
            $chyba = "Toto meno uz niekto pouziva, skus ine.";
        } else {
            // Bezpecne hashovanie hesla
            $zahasovane_heslo = password_hash($heslo, PASSWORD_DEFAULT);
            $vlozit = $db->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            
            if ($vlozit->execute([$meno, $zahasovane_heslo])) {
                $uspech = "Super, si zaregistrovany. Mozes sa prihlasit!";
            } else {
                $chyba = "Chyba pri zapise do databazy.";
            }
        }
    } else {
        $chyba = "Musis vyplnit vsetky policka!";
    }
}
?>

<?php include 'header/header.php'; ?>

<link rel="stylesheet" href="/apple-obchod/css/kontakt.css">

<section class="Kontakt">
    <h1>Registrácia</h1>
    <p class="dole">Vytvorte si účet pre prístup do administrácie</p>

    <?php if($chyba): ?>
        <p style="color: red; font-weight: bold; text-align: center;"><?php echo $chyba; ?></p>
    <?php endif; ?>
    
    <?php if($uspech): ?>
        <p style="color: green; font-weight: bold; text-align: center;"><?php echo $uspech; ?></p>
    <?php endif; ?>

    <form id="contactForm" action="register.php" method="POST">
        <input type="text" name="meno" placeholder="Prihlasovacie meno" required>
        <input type="password" name="heslo" placeholder="Heslo" required>
        <button type="submit">Registrovať</button>
    </form>
    
    <div style="text-align: center; margin-top: 20px;">
        <a href="login.php" style="color: inherit; text-decoration: underline;">Už máš účet? Prihlás sa tu</a>
    </div>
</section>

<?php include 'footer/footer.php'; ?>