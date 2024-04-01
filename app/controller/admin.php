<?php

$registeredProduct = false;
$msg = null;


// -----------------------------------ADMIN ORDER-----------------------------------------

// -----------------------------------ADMIN PRODUCT---------------------------------------

// ADD PRODUCTS
require RACINE . "/model/db.product.php";

// Check if form data has been submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if all fields are filled
    if (
        !empty($_POST["name"]) && !empty($_POST["degree"]) && !empty($_POST["designation"])
        && !empty($_POST["unitPrice"]) && !empty($_POST["img"])
    ) {
        // Get form data
        $name = $_POST["name"];
        $degree = $_POST["degree"];
        $designation = $_POST["designation"];
        $unitPrice = $_POST["unitPrice"];
        $pictureRef = $_POST["img"];

        // Check field lengths and display appropriate error messages
        if (strlen($name) > 20) {
            $msg = "Le nom ne doit pas excéder 20 caractères";
        } else if (strlen($degree) > 5) {
            $msg = "Le degré ne doit pas excéder 5 caractères.";
        } else if (strlen($designation) > 70) {
            $msg = "La désignation ne doit pas excéder 70 caractères.";
        } else if (strlen($unitPrice) > 5) {
            $msg = "Le prix doit être de 5 caractères maximum.";
        } else {
            // All validations successful, call the model function to create a new product in the database
            $result = createProduct($name, $degree, $designation, $unitPrice, $pictureRef);

            // Check if product creation was successful
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



// -------------------------------------------------------
// Inclure le fichier contenant les fonctions du modèle pour les produits
require_once RACINE . "/model/db.product.php";

// Récupérer les produits depuis la base de données
$products = getProducts();

// MODIFICATION / SUPRESSION DES PRODUITS
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Vérifier si le bouton de mise à jour du produit a été cliqué
    if (isset($_POST["updateProduct"])) {
        // Récupérer les données du formulaire
        $productId = $_POST["productId"];
        $newData = array(
            "name" => $_POST["name"],
            "degree" => $_POST["degree"],
            "designation" => $_POST["designation"],
            "unitPrice" => $_POST["unitPrice"],
            "pictureRef" => $_POST["img"]
        );

        // Appeler la fonction du modèle pour mettre à jour le produit dans la base de données
        $rowCount = updateProduct($productId, $newData);

        // Vérifier si la mise à jour a réussi
        if ($rowCount > 0) {
            $msg = "Mise à jour réussie.";
        } else {
            // Afficher un message d'erreur si la mise à jour a échoué
            $msg = "La mise à jour a échoué.";
        }
    }

    // Vérifier si le bouton de suppression du produit a été cliqué
    if (isset($_POST["deleteProduct"])) {
        // Récupérer l'ID du produit à supprimer
        $productIdToDelete = $_POST["productIdToDelete"];

        // Appeler la fonction du modèle pour supprimer le produit de la base de données
        $rowCount = deleteProductById($productIdToDelete);

        // Vérifier si la suppression a réussi
        if ($rowCount > 0) {
            $msg = "Produit supprimé avec succès.";
        } else {
            // Afficher un message d'erreur si la suppression a échoué
            $msg = "La suppression du produit a échoué.";
        }
    }
}

// Include the view of the form to add products
require_once RACINE . "/views/viewAdmin.php";
