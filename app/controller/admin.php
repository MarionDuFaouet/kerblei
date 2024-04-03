<?php

$registeredProduct = false;
$msg = null;

// !!! Mieux nommer mes variables, moins de commentaires
//commentaires sur fonctionnalités, facilitent la lecture
// -----------------------------------ADMIN ORDER-----------------------------------------

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
        // Display an error message if all fields are not filled
        $msg = "Veuillez remplir tous les champs.";
    }
}
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
