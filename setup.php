<?php
$host = "127.0.0.1";
$port = "3307";
$user = "root";
$pass = "";

try {
    // 1. Підключаємось до сервера MySQL
    $pdo = new PDO("mysql:host=$host", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 2. Створюємо базу даних
    $pdo->exec("CREATE DATABASE IF NOT EXISTS apple_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    echo "База 'apple_db' успішно створена або вже існує.<br>";

    // 3. Підключаємось вже до конкретної бази
    $pdo->exec("USE apple_db");

    // 4. Створюємо таблицю товарів
    $sql = "CREATE TABLE IF NOT EXISTS products (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        description TEXT,
        price DECIMAL(10, 2) NOT NULL,
        image VARCHAR(255),
        category VARCHAR(100),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB;";

    $pdo->exec($sql);
    echo "Таблиця 'products' готова!<br>";

    // 5. Додамо пробні дані
    $check = $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
    if ($check == 0) {
        $pdo->exec("INSERT INTO products (name, description, price, image, category) VALUES 
            ('iPhone 15 Pro', 'Titanium design, A17 Pro chip', 999.00, 'iphone15.jpg', 'Phones'),
            ('MacBook Air M3', 'Supercharged by M3 chip', 1299.00, 'macbook.jpg', 'Laptops')");
        echo "Пробні товари додані!";
    }

} catch (PDOException $e) {
    die("Помилка: " . $e->getMessage());
}
?>