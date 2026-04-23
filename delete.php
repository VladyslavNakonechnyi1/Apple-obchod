<?php
// Підключаємо наші класи
require_once 'Database.php';
require_once 'Product.php';

// Перевіряємо, чи є ID у посиланні
if (isset($_GET['id'])) {
    
    // Створюємо з'єднання
    $database = new Database();
    $db = $database->getConnection();
    $product = new Product($db);
    
    // Видаляємо і повертаємось назад
    if ($product->delete($_GET['id'])) {
        header("Location: galeria.php");
        exit;
    }
}

// Якщо щось пішло не так - все одно повертаємось в галерею
header("Location: galeria.php");
exit;
?>