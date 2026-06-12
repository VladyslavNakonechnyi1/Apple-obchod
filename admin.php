<?php
session_start();

// Ak uzivatel nie je prihlaseny, vyhodime ho na login
if (!isset($_SESSION['prihlaseny_uzivatel'])) {
    header("Location: login.php");
    exit();
}

// Pripojenie potrebnych suborov pre databazu a objekty
require_once 'Database.php';
require_once 'Product.php';

$message = "";

// Kontrola ci bol formular odoslany
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pripojenie k databaze
    $database = new Database();
    $db = $database->getConnection();
    
    // Vytvorenie instancie triedy Product 
    $product = new Product($db);

    // Kontrola obrazka 
    $image = !empty($_POST['image']) ? $_POST['image'] : 'default.png';

    // Volanie funkcie CREATE z Product.php na ulozenie do databazy
    if ($product->create($_POST['name'], $_POST['description'], $_POST['price'], $image)) {
        $message = "Produkt bol uspesne pridany!";
    } else {
        $message = "Chyba pri pridavani produktu.";
    }
}
?>

<?php include 'header/header.php'; ?>

<link rel="stylesheet" href="/apple-obchod/css/kontakt.css">

<section class="Kontakt">
    <h1>Pridať produkt</h1>
    <p class="dole">Administračný panel pre pridávanie nových zariadení</p>

    <?php if($message): ?>
        <p style="color: <?php echo strpos($message, 'Chyba') !== false ? 'red' : 'green'; ?>; font-weight: bold; text-align: center; margin-bottom: 15px;">
            <?php echo $message; ?>
        </p>
    <?php endif; ?>

    <form id="contactForm" action="admin.php" method="POST">
        <input type="text" name="name" placeholder="Názov produktu (napr. iPhone 18)" required>
        <textarea name="description" placeholder="Krátky popis" required></textarea>
        <input type="number" step="0.01" name="price" placeholder="Cena v €" required>
        <input type="text" name="image" placeholder="Názov obrázka (napr. 17pro.png)">
        <button type="submit">Pridať do databázy</button>
    </form>
    
    <div style="text-align: center; margin-top: 20px;">
        <a href="galeria.php" style="color: inherit; text-decoration: underline; margin-right: 15px;">Späť do galérie</a>
        <a href="logout.php" style="color: red; text-decoration: underline; font-weight: bold;">Odhlásiť sa</a>
    </div>
</section>

<?php include 'footer/footer.php'; ?>