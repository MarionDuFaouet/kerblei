<?php

$msg = null;

require_once RACINE . "/model/db.product.php";

// affichage des produits
$products = getProducts();



// ajout de produits au panier
function addToCart($productId)
{
    // Initialiser la session si elle n'est pas déjà démarrée
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Vérifier si le produit est déjà présent dans le panier
    if (isset($_SESSION["cart"][$productId])) {
        // Si oui, incrémente simplement la quantité
        $_SESSION["cart"][$productId]++;

    } else {
        // Si le produit n'est pas déjà dans le panier, ajoutez-le
        $_SESSION["cart"][$productId] = 1;
    }

    // Afficher les informations du panier après l'ajout du produit
    var_dump($_SESSION["cart"]);
}



// require_once RACINE . "/model/db.cart.php";
// Vérifie si le formulaire a été soumis et si l'action est d'ajouter au panier
if (isset($_POST['addToCart'])) {
    // Vérifie si productId est défini dans les données postées
    if (isset($_POST['productId'])) {
        // Récupère l'identifiant du produit depuis les données postées
        $productId = $_POST['productId'];
        // Appele la fonction addToCart avec l'identifiant du produit
        addToCart($productId);
        var_dump($productId);
    }
    
}


/* successfull add product to cart */
$_SESSION['cart'] = $user['cart'];
// Afficher un message de succès
$msg = 'Produit ajouté avec succès !';

// Inclure la vue des produits
require_once RACINE . "/views/viewProducts.php";
exit;

?>
