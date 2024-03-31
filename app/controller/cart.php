<?php

$msg = null;

function addToCart($productId) {

    // Vérifiez si le panier est déjà créé dans la session, sinon, créez-le
    if (!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = array();
    }
    // Ajoutez le produit au panier
    $_SESSION["cart"]["productId"] = $productId;
    // Afficher un message de succès
    $msg = 'Produit ajouté avec succès !';

    echo "<script>alert('Produit ajouté avec succès !');</script>";
}

/* successfull add product to cart */
$_SESSION['cart'] = $user['cart'];
//$_SESSION['firstname'] = $user['firstname'];
$_SESSION['admin'] = $user['isAdmin'];
$msg = 'Salut ' . $user['firstname'] . '! Vous êtes connecté.';

// ##DEBUG
var_dump($_SESSION);


require_once RACINE . "/views/viewCart.php";
?>

<!-- // // si je veux interdire l'accès à une page à l'admin
// if (!((isset($_SESSION['admin'])) && $_SESSION['admin'])) {
//     $_SESSION['msg']=['level'=> 'warning', 'content' => 'You must be an administrator to reach this page'];
// } -->