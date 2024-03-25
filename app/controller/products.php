<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    die('Erreur : '.basename(__FILE__));
}

require_once RACINE . "/model/db.product.php";

$products = getProducts();

require_once RACINE . "/views/viewProducts.php";


function addToCart($productId) {
    session_start();

    // Vérifiez si le panier est déjà créé dans la session, sinon, créez-le
    if (!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = array();
    }

    // Ajoutez le produit au panier
    $_SESSION["cart"][] = $productId;

    // Afficher un message de succès dans une pop-up
    echo "<script>alert('Produit ajouté avec succès !');</script>";
}
?>



