<?php
require_once 'Database.php';
require_once 'Product.php';

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);
$stmt = $product->read(); 
$all_products = $stmt->fetchAll(PDO::FETCH_ASSOC); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="galeria">
    <meta name="keywords" content="Apple">
    <meta name="author" content="Vladyslav Nakonechnyi">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Apple</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/galeria.css">
</head>
<body>
   <header>
    <div class="logo">
        <a href="galeria.php"><img src="/img/11-114612_apple-logo-png-ios-6-apple-logo.png" alt="Logo"></a>
    </div>
    <input id="burger-toggle" type="checkbox">
    <label for="burger-toggle">
        <span></span>
    </label>
    <nav class="menu">
        <ul>
            <li><a href="index.html" class="menu_link">Domov</a></li>
            <li><a href="o-nas.html" class="menu_link">O nás</a></li>
            <li><a href="galeria.php" class="menu_link">Galéria</a></li>
            <li><a href="kontakt.html" class="menu_link">Kontakt</a></li>
        </ul>
    </nav>
</header>

<div class="container">
    <div class="text-center">
        <h1 class="hore">Galéria</h1>
    </div>
</div>

<section class="boxes" id="galeria">
    <?php foreach ($all_products as $row): ?>
    <div class="box">
        <p><?php echo htmlspecialchars($row['name']); ?>:</p>
        <img src="img/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
        <p><?php echo htmlspecialchars($row['description']); ?></p>
        <p><strong>€<?php echo htmlspecialchars($row['price']); ?></strong></p>
        <button class="buy-btn" id="btn">Kúpiť</button>
        <br><br>
        <a href="delete.php?id=<?php echo $row['id']; ?>" style="color:red; text-decoration:underline;">Zmazať produkt</a>
    </div>
    <?php endforeach; ?>
</section>

<section class="tabulka">
  <h2>Naše produkty</h2>
  <table>
    <thead>
      <tr>
        <th>Produkt</th>
        <th>Popis</th>
        <th>Cena</th>
        <th>Kúpiť</th>
        <th>Akcia</th> </tr>
    </thead>
    <tbody>
      <?php foreach ($all_products as $row): ?>
      <tr>
        <td><?php echo htmlspecialchars($row['name']); ?></td>
        <td><?php echo htmlspecialchars($row['description']); ?></td>
        <td>€<?php echo htmlspecialchars($row['price']); ?></td>
        <td><button class="buy-btn">Kúpiť</button></td>
        <td><a href="delete.php?id=<?php echo $row['id']; ?>" style="color:red; font-weight:bold;">Zmazať</a></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</section>

<footer>
  <nav>
    <a href="index.html">Domov</a>
    <a href="o-nas.html">O nás</a>
    <a href="galeria.php">Galéria</a>
    <a href="kontakt.html">Kontakt</a>
  </nav>

  <p>© 2025 Fan stranka Apple. Všetky práva vyhradené</p>
  <p>Vytvoril: Vladyslav Nakonechnyi</p>
  <p>Email: <a href="https://www.apple.com" class="contact-link">apple.com</a></p>
  <p>Tel: <a href="tel:+421901234567" class="contact-link">+421 923 456 567</a></p>
</footer>
<script src="js/galeria.js"></script>
</body>
</html>