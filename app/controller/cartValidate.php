<?php
// default return for message and post-action
unset ($_SESSION['cart']['message']);      // nothing to display if not set
unset ($_SESSION['cart']['action']);       // nothing to do if not set

/* create the order in the database if the user is connected */
if (!isset($_SESSION['mail'])) {
    // user must be connected -> return cart message
    $_SESSION['cart']['message'] = "Vous devez être connecté pour valider votre panier";
    goto output;
}
if (!isset($_SESSION['cart']['products']) || (count($_SESSION['cart']['products'])) == 0) {
    // cart must not be empty -> return cart message
    $_SESSION['cart']['message'] = "Votre panier est vide";
    goto output;
}

require RACINE . "/model/db.user.php";
require RACINE . "/model/db.cart.php";

// get parameters from the request
$data = json_decode(stripslashes(file_get_contents("php://input")));
$deliveryDate = $data->deliveryDate;

$user = getUserByMail($_SESSION['mail']);   // get userId (Note: it should be kept in session)

$cartId = createOrderForUser($user['accountId'], $deliveryDate);

if ($cartId == 0) {
    // error creating the order
    $_SESSION['cart']['message'] = "Erreur dans la création de votre commande";
    goto output;
}

// add all products to the order ; set from the $_SESSION['cart'] content)
foreach ($_SESSION['cart']['products'] as $productId => $product) {
    addProductToOrder($cartId, $productId, $product['quantity']);
}
unset($_SESSION['cart']['products']);   // remove all products
$_SESSION['cart']['message'] = "Votre commande a été enregistrée";
$_SESSION['cart']['action'] = "DROP";

// end of treatment
output:
header('Content-Type: application/json; charset=utf-8');
echo json_encode($_SESSION['cart']);

exit;