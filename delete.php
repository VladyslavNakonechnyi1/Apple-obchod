<?php

require_once 'Database.php';
require_once 'Product.php';


if (isset($_GET['id'])) {
    

    $database = new Database();
    $db = $database->getConnection();
    $product = new Product($db);
    
  
    if ($product->delete($_GET['id'])) {
        header("Location: galeria.php");
        exit;
    }
}


header("Location: galeria.php");
exit;
?>