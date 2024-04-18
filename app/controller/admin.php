<?php

$msg = "";           // reset all the messages
$orderMsg = ""; 
$productAddMsg = "";
$productUpdateMsg = "";

// -----------------------------------ADMIN ORDER-----------------------------------------

require_once RACINE . "/model/db.cart.php";
require RACINE . "/model/db.product.php";

$orders = getOrders();
$products = getProducts();

if (isset($_GET["updateOrder"])) {
    // cartID present in POST request?    
    if (isset($_POST["cartId"])) {
        // Retrieve cartID from POST request
        $cartId = $_POST["cartId"];
        // Call the function to update the order status
        updateCartStatement($cartId, 'livrée');
        // update le list of orders
        $orders = getOrders();
    } else {
        //if cartID is not present in the POST request
        error_log("L'identifiant du panier n'a pas été fourni dans la requête POST");
    }
}

// -----------------------------------ADMIN PRODUCT---------------------------------------

// ADD PRODUCT
elseif (isset($_GET["addProduct"]) || isset($_GET["updateProduct"])) {

    if (
        !empty($_POST["name"]) && !empty($_POST["degree"]) && !empty($_POST["designation"])
        && !empty($_POST["unitPrice"]) && !empty($_FILES["pictureRef"])) 
    {
        $name = $_POST["name"];
        $degree = $_POST["degree"];
        $designation = $_POST["designation"];
        $unitPrice = $_POST["unitPrice"];
        $pictureRef = $_FILES["pictureRef"];

        if (strlen($name) > 30) {
            $msg = "Le nom ne doit pas excéder 30 caractères.";
        } else if (strlen($degree) > 5) {
            $msg = "Le degré ne doit pas excéder 5 caractères.";
        } else if (strlen($designation) > 70) {
            $msg = "La désignation ne doit pas excéder 70 caractères.";
        } else if (strlen($unitPrice) > 5) {
            $msg = "Le prix doit être de 5 caractères maximum.";
        } else {
            // everything is fine
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

            if (isset($_GET["addProduct"])) {
                // Add product in DB
                $result = addProduct($name, $degree, $designation, $unitPrice, $imageName);
                $msg = ($result)? "Produit ajouté avec succès.": "L'ajout du produit a échoué.";
            }
            else {
                // Update product in DB
                $productId = $_POST["selectedProductId"];
                if (!isset($productId) || empty($productId)) {
                    error_log("L'identifiant du produit n'a pas été fourni dans la requête POST");
                    $msg = "Le produit n'a pas pu être mis à jour.";
                }
                else {
                    // the update can be done
                    $result = updateProduct($productId, $name, $degree, $description, $unitPrice, $imageName);
                    $msg = ($result)? "Produit modifié avec succès.": "la mise à jour du produit a échoué.";
                }
            }
            // update product list for display
            $products = getProducts();
        }
    }
    else {
        $msg = "Veuillez remplir tous les champs.";
    }
    
    if (isset($_GET["addProduct"])) $productAddMsg = $msg;
        else $productUpdateMsg = $msg;
}
elseif (!isset($_GET) || empty($_GET)){
    // this the first access to the page -> nothing else to do
}

else {
    // wrong parameter -> nothing to do
}

require_once RACINE . "/views/viewAdmin.php";
