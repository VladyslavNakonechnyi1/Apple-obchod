<?php
require_once 'Database.php';
require_once 'Product.php';

$message = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $database = new Database();
    $db = $database->getConnection();
    $product = new Product($db);

  
    $image = !empty($_POST['image']) ? $_POST['image'] : 'default.png';

  
    if ($product->create($_POST['name'], $_POST['description'], $_POST['price'], $image)) {
        $message = "Produkt bol úspešne pridaný!";
    } else {
        $message = "Chyba pri pridávaní produktu.";
    }
}
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Admin - Pridať produkt</title>
    <link rel="stylesheet" href="css/main.css">
    <style>
        .admin-box { max-width: 450px; margin: 50px auto; padding: 30px; border: 1px solid #ddd; border-radius: 8px; text-align: center; }
        .admin-box input, .admin-box textarea { width: 90%; margin-bottom: 15px; padding: 10px; border-radius: 5px; border: 1px solid #ccc; }
    </style>
</head>
<body>
    <div class="admin-box">
        <h2>Pridať nový produkt</h2>
        
        <?php if($message) echo "<p style='color:green; font-weight:bold;'>$message</p>"; ?>
        
        <form action="admin.php" method="POST">
            <input type="text" name="name" placeholder="Názov produktu (napr. iPhone 18)" required>
            <textarea name="description" placeholder="Krátky popis" required></textarea>
            <input type="number" step="0.01" name="price" placeholder="Cena v €" required>
            <input type="text" name="image" placeholder="Názov obrázka (napr. iphone18.png)">
            <button type="submit" class="buy-btn" style="padding: 10px 20px; cursor: pointer; width: 100%;">Pridať do databázy</button>
        </form>
        <br><br>
        <a href="galeria.php" style="color: #333; text-decoration: underline;">Späť do galérie</a>
    </div>
</body>
</html>