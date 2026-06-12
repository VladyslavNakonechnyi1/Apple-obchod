<?php
// Kontrola ci uz bezi session aby php nehadzalo cervene chyby
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Hlavná stránka Apple">
    <meta name="keywords" content="Apple">
    <meta name="author" content="Vladyslav Nakonechnyi">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Apple Store</title>
    
    <link rel="stylesheet" href="/apple-obchod/css/main.css">
    <link rel="stylesheet" href="/apple-obchod/css/index.css">
</head>
<body>
    <header>
        <div class="logo">
            <a href="/apple-obchod/index.php">
                <img src="/apple-obchod/img/11-114612_apple-logo-png-ios-6-apple-logo.png" alt="Logo">
            </a>
        </div>
        
        <input id="burger-toggle" type="checkbox">
        <label for="burger-toggle">
            <span></span>
        </label>
        
        <nav class="menu">
            <ul>
                <li><a href="index.php" class="menu_link">Domov</a></li>
                <li><a href="o-nas.php" class="menu_link">O nás</a></li>
                <li><a href="galeria.php" class="menu_link">Galéria</a></li>
                <li><a href="kontakt.php" class="menu_link">Kontakt</a></li>
                
                <?php if (isset($_SESSION['prihlaseny_uzivatel'])): ?>
                    <li><a href="admin.php" class="menu_link" style="color: #0071e3; font-weight: bold;">Admin</a></li>
                    <li><a href="logout.php" class="menu_link" style="color: red;">Odhlásiť</a></li>
                <?php else: ?>
                    <li><a href="login.php" class="menu_link">Prihlásenie</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>