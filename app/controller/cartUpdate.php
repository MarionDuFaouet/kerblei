<?php

// default return for message and post-action
unset ($_SESSION['cart']['message']);      // nothing to display if not set
unset ($_SESSION['cart']['action']);       // nothing to do if not set

$data = json_decode(stripslashes(file_get_contents("php://input")));
$productId = $data->productId;
$productQuantity = $data->productQuantity;

// The product should already be in the cart
if ($productQuantity == 0) unset($_SESSION['cart']['products'][$productId]);
else $_SESSION['cart']['products'][$productId]['quantity']=$productQuantity;

header('Content-Type: application/json; charset=utf-8');
echo json_encode($_SESSION['cart']);

exit;