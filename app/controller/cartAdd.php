<?php

require_once RACINE . "/model/db.product.php";

// SOS clean cart from SESSION
//if (isset($_SESSION['cart'])) unset($_SESSION['cart']);

/* update the cart in SESSION */
$data = json_decode(stripslashes(file_get_contents("php://input")));
$productId = $data->productId;

if ($productId != 0) {

    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId]['quantity']++;
    } else {
        // Get the product information and add it to the cart with a quantity of 1
        $product = getProductById($productId);
        if ($product) {
            $_SESSION['cart'][$productId] = array(
                'productId' => $product['productId'],
                'name' => $product['name'],
                'unitPrice' => $product['unitPrice'],
                'quantity' => 1
            );
        }
    }
}

/* update (or create) the order in the database if the user is connected */
if (isset($_SESSION['mail'])) {
    require RACINE . "/model/db.user.php";
    require RACINE . "/model/db.cart.php";
    $user = getUserByMail($_SESSION['mail']);
    $pendinCarts = getPendingOrdersByAccountId($user['accountId']);

    if (empty($pendinCarts)) {
        // create a pending cart
        createOrderForUser($user['accountId']);
    }

}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($_SESSION['cart']);

exit;