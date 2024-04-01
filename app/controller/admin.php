<?php

$registeredProduct = false;
$msg = null;

// view calling
// require RACINE . "./views/viewAdmin.php"; 
?>
<!-- -----------------------------------ADMIN ORDER--------------------------------- -->

<!-- -----------------------------------ADMIN PRODUCT--------------------------------------- -->

<?php
// AJOUT DES PRODUITS
require_once RACINE . "/model/db.product.php";

// AJOUTER PROCESS DE VERIF POUR CHAQUE ENTREE

// Vérifiez si des données de formulaire ont été soumises
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Vérifiez si tous les champs sont renseignés
    if (!empty($_POST["name"]) && !empty($_POST["degree"]) && !empty($_POST["designation"]) && !empty($_POST["unitPrice"]) && !empty($_POST["img"])) {
        // Récupérez les données du formulaire
        $name = $_POST["name"];
        $degree = $_POST["degree"];
        $designation = $_POST["designation"];
        $unitPrice = $_POST["unitPrice"];
        $pictureRef = $_POST["img"]; // Assurez-vous que le nom de l'input correspond à "img" dans votre formulaire
        
        // Vérifiez les longueurs des champs et affichez les messages d'erreur appropriés
        if (strlen($name) > 20) {
            $msg = "Le nom ne doit pas dépasser 20 caractères.";
        } else if (strlen($degree) > 5) {
            $msg = "Le degré ne doit pas dépasser 5 caractères.";
        } else if (strlen($designation) > 50) {
            $msg = "La désignation ne doit pas dépasser 50 caractères.";
        } else if (strlen($unitPrice) > 5) {
            $msg = "Le prix ne doit pas dépasser 5 caractères.";
        } else {
            // Toutes les validations réussies, appelez la fonction du modèle pour créer un nouveau produit dans la base de données
            $result = createProduct($name, $degree, $designation, $unitPrice, $pictureRef);

            // Vérifiez si la création du produit a réussi
            if ($result) {
                $msg = "Produit ajouté avec succès.";
            } else {
                $msg = "Erreur lors de l'ajout du produit.";
            }
        }
    } else {
        // Afficher un message d'erreur si tous les champs ne sont pas renseignés
        $msg = "Veuillez renseigner tous les champs.";
    }
}
// Incluez la vue du formulaire pour ajouter des produits
require_once RACINE . "/views/viewAdmin.php";
?>








// MODIFICATION DES PRODUITS
// Vérifier si des données de formulaire ont été soumises pour la mise à jour du produit
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["updateProduct"])) {
// Récupérer les données du formulaire
$productId = $_POST["productId"];
$newData = array(
"name" => $_POST["name"],
"degree" => $_POST["degree"],
"designation" => $_POST["designation"],
"unitPrice" => $_POST["unitPrice"],
"pictureRef" => $_POST["pictureRef"]
);

//affichage des produits
$products = getProducts();
// Appeler la fonction du modèle pour mettre à jour le produit dans la base de données
$rowCount = updateProduct($productId, $newData);

// Vérifier si la mise à jour a réussi
if ($rowCount > 0) {
$msg= "Produit ajouté avec succès.";

} else {
// Afficher un message d'erreur si la mise à jour a échoué
$msg = "Erreur lors de la mise à jour du produit.";
}
}

function deleteProductFromAdmin($productId){
deleteProductById($productId);
$msg="Produit mis à jour avec succès !"; //ne fonctionne pas si au sein d'une fonction
}

?>