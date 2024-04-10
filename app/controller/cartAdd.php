<?php

require_once RACINE . "/model/db.product.php";

// SOS clean cart from SESSION
if (isset($_SESSION['cart'])) unset($_SESSION['cart']);

$idProduct = isset($_GET["productId"]) ? $_GET["productId"] : 0;

if ($idProduct != 0) {

    $product = getProductById($idProduct);

    if ($product) {
        if (isset($_SESSION['cart'][$idProduct])) {
            $_SESSION['cart'][$idProduct]['quantity']++;
        } else {
            // Add the product to the cart with a quantity of 1
            $_SESSION['cart'][$idProduct] = array(
                'productId' => $product['productId'],
                'name' => $product['name'],
                'unitPrice' => $product['unitPrice'],
                'quantity' => 1
            );
        }
    }
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($_SESSION['cart']);

exit;
