<?php


// ma messagerie ne fonctionne pas !!!
$msg = null;

require_once RACINE . "/model/db.product.php";
// require_once RACINE . "/model/db.cart.php";

// Affiche les produits
$products = getProducts();



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





function addToCart($productId)
{
    $msg = null;

    // Initialiser la session si elle n'est pas déjà démarrée
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Vérifier si le produit est déjà présent dans le panier
    if (isset($_SESSION["cart"][$productId])) {
        // Si oui, incrémente simplement la quantité
        $_SESSION["cart"][$productId]++;
        $msg = 'Produit ajouté avec succès !';

    } else {
        // Si le produit n'est pas déjà dans le panier, ajoutez-le
        $_SESSION["cart"][$productId] = 1;
        $msg = 'Produit ajouté avec succès !';

    }

    // Afficher les informations du panier après l'ajout du produit
    var_dump($_SESSION["cart"]);
}

// Inclure la vue des produits
require_once RACINE . "/views/viewProducts.php";
exit;

?>
