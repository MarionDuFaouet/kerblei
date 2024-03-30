<?php

require_once RACINE . "/model/db.product.php";

$products = getProducts();

require_once RACINE . "/views/viewProducts.php";


function addToCart($productId) {

    // Vérifiez si le panier est déjà créé dans la session, sinon, créez-le
    if (!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = array();
    }

    // Ajoutez le produit au panier
    $_SESSION["cart"]["productId"] = $productId;

    // Afficher un message de succès dans une pop-up
    echo "<script>alert('Produit ajouté avec succès !');</script>";
}
?>
<!-- // // si je veux interdire l'accès à une page à l'admin
// if (!((isset($_SESSION['admin'])) && $_SESSION['admin'])) {
//     $_SESSION['msg']=['level'=> 'warning', 'content' => 'You must be an administrator to reach this page'];
// } -->


