<?php

require_once RACINE . "/model/db.product.php";

// default return for message and post-action
unset ($_SESSION['cart']['message']);      // nothing to display if not set
unset ($_SESSION['cart']['action']);       // nothing to do if not set

/* update the cart in SESSION */
$data = json_decode(stripslashes(file_get_contents("php://input")));
$productId = $data->productId;

if ($productId != 0) {
        if (isset($_SESSION['cart']['products'][$productId])) {
            $_SESSION['cart']['products'][$productId]['quantity']++;
        } else {
            // Get the product information and add it to the cart with a quantity of 1
            $product = getProductById($productId);
            if ($product) {
                $_SESSION['cart']['products'][$productId] = array(
    
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