<?php

$msg = "";  // reset message

// -----------------------------------ADMIN ORDER-----------------------------------------

require_once RACINE . "/model/db.cart.php";
$orders = getOrders();

//if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["updateOrder"])) {
if (isset($_GET["updateOrder"])) {
    // cartID present in POST request?    
    if (isset($_POST["cartId"])) {
        // Retrieve cartID from POST request
        $cartId = $_POST["cartId"];
        // Call the function to update the order status
        updateCartStatement($cartId, 'livrée');
    } else {
        //if cartID is not present in the POST request
        echo "L'identifiant du panier n'a pas été fourni dans la requête POST.";
    }
}

// -----------------------------------ADMIN PRODUCT---------------------------------------
require RACINE . "/model/db.product.php";

// ADD PRODUCTS
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["addProduct"])) {
    if (
        !empty($_POST["name"]) && !empty($_POST["degree"]) && !empty($_POST["designation"])
        && !empty($_POST["unitPrice"]) && !empty($_FILES["pictureRef"])
    ) {
        $name = $_POST["name"];
        $degree = $_POST["degree"];
        $designation = $_POST["designation"];
        $unitPrice = $_POST["unitPrice"];
        $pictureRef = $_FILES["pictureRef"];

        if (strlen($name) > 20) {
            $msg = "Le nom ne doit pas excéder 20 caractères.";
        } else if (strlen($degree) > 5) {
            $msg = "Le degré ne doit pas excéder 5 caractères.";
        } else if (strlen($designation) > 70) {
            $msg = "La désignation ne doit pas excéder 70 caractères.";
        } else if (strlen($unitPrice) > 5) {
            $msg = "Le prix doit être de 5 caractères maximum.";
        } else {
            // img verify
            // var_dump($_FILES);
            if ($_FILES["pictureRef"]["error"] == UPLOAD_ERR_OK) {

                $allowedFormats = ['image/jpeg', 'image/jpg', 'image/png'];
                $maxSizeInBytes = 100 * 1024; // 100 Ko

                if (!in_array($pictureRef["type"], $allowedFormats)) {
                    $msg = "Veuillez sélectionner une image au format JPEG, JPG ou PNG.";
                } else if ($pictureRef["size"] > $maxSizeInBytes) {
                    $msg = "La taille de l'image dépasse la limite autorisée (100 Ko).";
                } else {
                    // load and save image file
                    $tmp_name = $_FILES["pictureRef"]["tmp_name"];
                    // basename() can help prevent file system traversal attacks; 
                    $imageName = basename($_FILES["pictureRef"]["name"]);

                    move_uploaded_file($tmp_name, RACINE . "/../statics/images/" . $imageName);
                }
            }

            // Add Product
            $result = addProduct($name, $degree, $designation, $unitPrice, $imageName);
            // ----------------------------------------------
            if ($result) {
                $msg = "Produit ajouté avec succès.";
            } else {
                $msg = "L'ajout du produit a échoué.";
            }
        }
    }
} else {
    $msg = "Veuillez remplir tous les champs.";
}

// -------------------------------------------------------------------------------------------

// MODIFICATION / SUPRESSION PRODUCTS
$products = getProducts();

// Form processing for product modification or deletion
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["updateProduct"])) {

    // Retrieve form data
    $productId = $_POST["selectedProductId"];
    $productName = $_POST["productName"];
    $productDegree = $_POST["productDegre"];
    $productDescription = $_POST["productDescription"];
    $productPrice = $_POST["productPrice"];

    // Call the model function to update the product
    updateProduct($productId, $productName, $productDegree, $productDescription, $productPrice);
    $msg = "Produit modifié avec succès.";

} elseif (isset($_POST["deleteProduct"])) {
    // Retrieve the ID of the product to delete
    $productIdToDelete = $_POST["selectedProductId"];

    // Call the model function to delete the product
    deleteProduct($productIdToDelete);
    $msg = "Produit supprimé avec succès.";
}

$products = getProducts();

require_once RACINE . "/views/viewAdmin.php";
