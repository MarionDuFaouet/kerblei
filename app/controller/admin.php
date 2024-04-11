<?php

$registeredProduct = false;
$msg = null;
// -----------------------------------ADMIN ORDER-----------------------------------------

require_once RACINE . "/model/db.cart.php";
$orders = getOrders();
// validateImageUpload(input);
// if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["updateOrder"])) {
//     $cartId= $order['cartId'];
//     updateCartStatement($cartId);
// }
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["updateOrder"])) {
    // Vérifiez si l'identifiant du panier est présent dans la requête POST
    if (isset($_POST["cartId"])) {
        // Récupérez l'identifiant du panier à partir de la requête POST
        $cartId = $_POST["cartId"];
        // Appelez la fonction pour mettre à jour le statut de la commande
        updateCartStatement($cartId);
    } else {
        // Gérez le cas où l'identifiant du panier n'est pas présent dans la requête POST
        echo "L'identifiant du panier n'a pas été fourni dans la requête POST.";
    }
}

// -----------------------------------ADMIN PRODUCT---------------------------------------
require RACINE . "/model/db.product.php";

// ADD PRODUCTS
// Check if form data has been submitted
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["addProduct"])) {

    if (!empty($_POST["name"]) && !empty($_POST["degree"]) && !empty($_POST["designation"])
        && !empty($_POST["unitPrice"]) && !empty($_POST["pictureRef"])) {
        $name = $_POST["name"];
        $degree = $_POST["degree"];
        $designation = $_POST["designation"];
        $unitPrice = $_POST["unitPrice"];
        $pictureRef = $_POST["pictureRef"];

        if (strlen($name) > 20) {
            $msg = "Le nom ne doit pas excéder 20 caractères";
        } else if (strlen($degree) > 5) {
            $msg = "Le degré ne doit pas excéder 5 caractères.";
        } else if (strlen($designation) > 70) {
            $msg = "La désignation ne doit pas excéder 70 caractères.";
        } else if (strlen($unitPrice) > 5) {
            $msg = "Le prix doit être de 5 caractères maximum.";
        } else {
            $result = addProduct($name, $degree, $designation, $unitPrice, $pictureRef);

            if ($result) {
                $msg = "Produit ajouté avec succès.";
            } else {
                $msg = "L'ajout du produit a échoué.";
            }
        }
    } else {
        $msg = "Veuillez remplir tous les champs.";
    }
}

///MAIS WHYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYY?????????????????? pourquoi j'arrive pas à vérifier l'image?????
// if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["addProduct"])) {
//     if (
//         !empty($_POST["name"]) && !empty($_POST["degree"]) && !empty($_POST["designation"])
//         && !empty($_POST["unitPrice"]) && !empty($_FILES["pictureRef"])
//     ) {
//         $name = $_POST["name"];
//         $degree = $_POST["degree"];
//         $designation = $_POST["designation"];
//         $unitPrice = $_POST["unitPrice"];
//         $pictureRef = $_FILES["pictureRef"];

//         if (strlen($name) > 20) {
//             $msg = "Le nom ne doit pas excéder 20 caractères.";
//         } else if (strlen($degree) > 5) {
//             $msg = "Le degré ne doit pas excéder 5 caractères.";
//         } else if (strlen($designation) > 70) {
//             $msg = "La désignation ne doit pas excéder 70 caractères.";
//         } else if (strlen($unitPrice) > 5) {
//             $msg = "Le prix doit être de 5 caractères maximum.";
//         } else {
//             // Vérification de l'image
//             $allowedFormats = ['image/jpeg'];
//             $maxSizeInBytes = 700 * 1024; // 700 Ko

//             if (!in_array($pictureRef["type"], $allowedFormats)) {
//                 $msg = "Veuillez sélectionner une image au format JPEG.";
//             } else if ($pictureRef["size"] > $maxSizeInBytes) {
//                 $msg = "La taille de l'image dépasse la limite autorisée (700 Ko).";
//             } else {

//                 // Ajout du produit
//                 $result = addProduct($name, $degree, $designation, $unitPrice, $pictureRef);

//                 if ($result) {
//                     $msg = "Produit ajouté avec succès.";
//                 } else {
//                     $msg = "L'ajout du produit a échoué.";
//                 }
//             }
//         }
//     }
// } else {
//     $msg = "Veuillez remplir tous les champs.";
// }

###DEBUG
// var_dump($name, $degree, $designation, $unitPrice, $pictureRef );

// -------------------------------------------------------------------------------------------




// MODIFICATION / SUPRESSION PRODUCTS
$products = getProducts();

###DEBUG
// var_dump($products);
// Convertir les données des produits en JSON
// $productsJSON = json_encode($products);
###DEBUG
// var_dump($productsJSON);

// Form processing for product modification or deletion
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["updateProduct"])) {

    // Retrieve form data
    $productId = $_POST["selectedProductId"];
    $productName = $_POST["productName"];
    $productDegree = $_POST["productDegre"];
    $productDescription = $_POST["productDescription"];
    $productPrice = $_POST["productPrice"];
    $productPictureRef = $_POST["productPictureRef"];

    // Call the model function to update the product
    updateProduct($productId, $productName, $productDegree, $productDescription, $productPrice, $productPictureRef);
    var_dump(getProducts());
} elseif (isset($_POST["deleteProduct"])) {
    // Retrieve the ID of the product to delete
    $productIdToDelete = $_POST["selectedProductId"];

    // Call the model function to delete the product
    deleteProduct($productIdToDelete);
}

$products = getProducts();

// Include the view of the form to add products
require_once RACINE . "/views/viewAdmin.php";
