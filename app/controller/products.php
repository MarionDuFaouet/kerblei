<?php



// MAIS A QUOI SERT CETTE PAGE MAINTENANT???


require_once RACINE . "/model/db.product.php";

// affichage des produits
$products = getProducts();

###DEBUG
// var_dump($products);

// mise en panier si session exists,




// /**
//  * Add product to cart
//  *
//  * @param int $productId L'identifiant du produit à ajouter.
//  * @return void
//  */
// // ajout de produits au panier
// function addToCart($productId)
// {
//     // Initialiser la session si elle n'est pas déjà démarrée
//     if (session_status() == PHP_SESSION_NONE) {
//         session_start();
//     }
//     // Vérifier si le produit est déjà présent dans le panier
//     if (isset($_SESSION["cart"][$productId])) {
//         // Si oui, incrémente simplement la quantité
//         $_SESSION["cart"][$productId]++;
//     } else {
//         // Si le produit n'est pas déjà dans le panier, ajoute-le
//         $_SESSION["cart"][$productId] = 1;
//     }

//     ###DEBUG
//     var_dump($_SESSION["cart"],'youhou');
//     // à chaque fois que je refresh, ça me rajoute un produit dans mon panier???
// }


// // Vérifie si le formulaire a été soumis et si l'action est d'ajouter au panier
// if (isset($_POST['addToCart'])) {

//     // Vérifie si productId est défini dans les données postées
//     if (isset($_POST['productId'])) {
//         // Récupère l'identifiant du produit depuis les données postées
//         $productId = $_POST['productId'];
//         // Appelle la fonction addToCart avec l'identifiant du produit
//         addToCart($productId);
//         // var_dump($productId);
//         // var_dump($product);
//         var_dump('coucoucoucoucoucoucoucoucoucou');
//         // Afficher un message de succès
//         $msg = 'Produit ajouté avec succès !';
//     }
// }

// Inclure la vue des produits
require_once RACINE . "/views/viewProducts.php";

exit;
