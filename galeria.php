<?php
require_once 'Database.php';
require_once 'Product.php';

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);
$stmt = $product->read(); 
$all_products = $stmt->fetchAll(PDO::FETCH_ASSOC); 
?>

<?php include 'header/header.php'; ?>

<link rel="stylesheet" href="/apple-obchod/css/galeria.css">

<div class="container">
    <div class="text-center">
        <h1 class="hore">Galéria</h1>
    </div>
</div>

<section class="boxes" id="galeria">
    <?php foreach ($all_products as $row): ?>
    <div class="box">
        <p><?php echo htmlspecialchars($row['name']); ?>:</p>
        <img src="/apple-obchod/img/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
        <p><?php echo htmlspecialchars($row['description']); ?></p>
        <p><strong>€<?php echo htmlspecialchars($row['price']); ?></strong></p>
        <button class="buy-btn" id="btn" onclick="window.open('https://www.apple.com/sk/', '_blank')">Kúpiť</button>
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
        <th>Akcia</th> 
      </tr>
    </thead>
    <tbody>
      <?php foreach ($all_products as $row): ?>
      <tr>
        <td><?php echo htmlspecialchars($row['name']); ?></td>
        <td><?php echo htmlspecialchars($row['description']); ?></td>
        <td>€<?php echo htmlspecialchars($row['price']); ?></td>
        <button class="buy-btn" onclick="window.open('https://www.apple.com/sk/search/<?php echo urlencode($row['name']); ?>', '_blank')">Kúpiť</button>
        <td><a href="delete.php?id=<?php echo $row['id']; ?>" style="color:red; font-weight:bold;">Zmazať</a></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</section>

<script src="/apple-obchod/js/galeria.js"></script>

<?php include 'footer/footer.php'; ?>