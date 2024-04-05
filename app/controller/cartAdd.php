<?php
$idProduct = isset($_GET["id"]) ? $_GET["id"] : 0;

if ($idProduct != 0) {
   
    if (isset($_SESSION['cart'][$idProduct])) $_SESSION['cart'][$idProduct]++;
    else $_SESSION['cart'][$idProduct] = 1;
}
var_dump($idProduct);
var_dump($_SESSION['cart'][$idProduct]);

require_once RACINE . "/model/db.product.php";

// affichage des produits
$products = getProducts();

// Inclure la vue des produits
require_once RACINE . "/views/viewProducts.php";