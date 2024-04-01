<?php

$registeredProduct = false;
$msg = null;

?>
<!-- -----------------------------------ADMIN ORDER----------------------------------------- -->

<!-- -----------------------------------ADMIN PRODUCT--------------------------------------- -->

<?php
// ADD PRODUCTS
require_once RACINE . "/model/db.product.php";

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
// Include the view of the form to add products
require_once RACINE . "/views/viewAdmin.php";


// -------------------------------------------------------

//affichage des produits
$products = getProducts();

// MODIFICATION / SUPRESSION DES PRODUITS
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["updateProduct"])) {
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
        $msg = "Product updated successfully.";
    } else {
        // Afficher un message d'erreur si la mise à jour a échoué
        $msg = "Error updating product.";
    }
}

// Function to delete product from admin
function deleteProductFromAdmin($productId){
    deleteProductById($productId);
    $msg = "Product updated successfully!";
    // Note: This message won't be displayed if called within a function unless you use it outside the function's scope.
}

// Include the view of the form to add products
require_once RACINE . "/views/viewAdmin.php";
?>