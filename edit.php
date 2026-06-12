<?php
// Pripojenie databazy a objektu
require_once 'Database.php';
require_once 'Product.php';

$database = new Database();
$db = $database->getConnection();
$product = new Product($db);

// Ak uzivatel klikol na tlacitko ulozit zmeny 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Zavolame funkciu UPDATE z Product.php
    $product->update($_POST['id'], $_POST['price'], $_POST['description']);
    
    // Hned ho presmerujeme spat do galerie, aby videl zmenu
    header("Location: galeria.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Vytiahneme len tento jeden konkretny produkt podla ID
    $query = "SELECT * FROM products WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->execute([$id]);
    $current_product = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    die("Chyba: ID produktu nebolo zadane.");
}
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Upravit produkt</title>
    <link rel="stylesheet" href="css/main.css">
    <style>
        .admin-box { max-width: 450px; margin: 50px auto; padding: 30px; border: 1px solid #ddd; border-radius: 8px; text-align: center; }
        .admin-box input, .admin-box textarea { width: 90%; margin-bottom: 15px; padding: 10px; border-radius: 5px; border: 1px solid #ccc; }
    </style>
</head>
<body>
    <div class="admin-box">
        <h2>Upravit produkt: <?php echo htmlspecialchars($current_product['name']); ?></h2>
        
        <form action="edit.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $current_product['id']; ?>">
            
            <p style="text-align: left; margin: 5px; font-weight: bold;">Popis:</p>
            <textarea name="description" required rows="4"><?php echo htmlspecialchars($current_product['description']); ?></textarea>
            
            <p style="text-align: left; margin: 5px; font-weight: bold;">Cena (€):</p>
            <input type="number" step="0.01" name="price" value="<?php echo htmlspecialchars($current_product['price']); ?>" required>
            
            <button type="submit" class="buy-btn" style="padding: 10px 20px; width: 100%; cursor:pointer;">Ulozit zmeny</button>
        </form>
        <br><br>
        <a href="galeria.php" style="color: #333; text-decoration: underline;">Zrusit a spat do galerie</a>
    </div>
</body>
</html>