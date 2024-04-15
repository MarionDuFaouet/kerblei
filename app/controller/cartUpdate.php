<?php

$data = json_decode(stripslashes(file_get_contents("php://input")));
$productId = $data->productId;
$productQuantity = $data->productQuantity;

// The product should already be in the cart
if ($productQuantity == 0) unset($_SESSION['cart'][$productId]);
else $_SESSION['cart'][$productId]['quantity']=$productQuantity;

header('Content-Type: application/json; charset=utf-8');
echo json_encode($_SESSION['cart']);

exit;