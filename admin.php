<?php
// Pripojenie potrebnych suborov pre databazu a objekty
require_once 'Database.php';
require_once 'Product.php';

$message = "";

// Kontrola ci bol formular odoslany (metoda POST je bezpecnejsia pre data)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inicializacia pripojenia k databaze
    $database = new Database();
    $db = $database->getConnection();
    
    // Vytvorenie instancie triedy Product (nas objekt)
    $product = new Product($db);

    //Kontrola obrazka (ak uzivatel nic nezada, pouzije sa defaultny obrazok)
    $image = !empty($_POST['image']) ? $_POST['image'] : 'default.png';

    // Volanie funkcie CREATE z Product.php na ulozenie do databazy
    if ($product->create($_POST['name'], $_POST['description'], $_POST['price'], $image)) {
        $message = "Produkt bol uspesne pridany!";
    } else {
        $message = "Chyba pri pridavani produktu.";
    }
}
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Admin - Pridat produkt</title>
    <link rel="stylesheet" href="css/main.css">
    <style>
        .admin-box { max-width: 450px; margin: 50px auto; padding: 30px; border: 1px solid #ddd; border-radius: 8px; text-align: center; }
        .admin-box input, .admin-box textarea { width: 90%; margin-bottom: 15px; padding: 10px; border-radius: 5px; border: 1px solid #ccc; }
    </style>
</head>
<body>
    <div class="admin-box">
        <h2>Pridat novy produkt</h2>
        
        <?php if($message) echo "<p style='color:green; font-weight:bold;'>$message</p>"; ?>
        
        <form action="admin.php" method="POST">
            <input type="text" name="name" placeholder="Nazov produktu (napr. iPhone 18)" required>
            <textarea name="description" placeholder="Kratky popis" required></textarea>
            <input type="number" step="0.01" name="price" placeholder="Cena v €" required>
            <input type="text" name="image" placeholder="Nazov obrazka (napr. 17pro.png)">
            <button type="submit" class="buy-btn" style="padding: 10px 20px; cursor: pointer; width: 100%;">Pridat do databazy</button>
        </form>
        <br><br>
        <a href="galeria.php" style="color: #333; text-decoration: underline;">Spat do galerie</a>
    </div>
</body>
</html>