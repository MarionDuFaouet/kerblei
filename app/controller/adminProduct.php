<?php
require_once RACINE . "/model/db.product.php";

$products = getProducts();

require_once RACINE . 'views/viewAdminProduct.php';


// Vérifier si des données de formulaire ont été soumises pour la mise à jour du produit
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["updateProduct"])) {
    // Récupérer les données du formulaire
    $productId = $_POST["productId"];
    $newData = array(
        "name" => $_POST["name"],
        "designation" => $_POST["designation"],
        "unitPrice" => $_POST["unitPrice"],
        "pictureRef" => $_POST["pictureRef"]
    );

    // Appeler la fonction du modèle pour mettre à jour le produit dans la base de données
    $rowCount = updateProduct($productId, $newData);

    // Vérifier si la mise à jour a réussi
    if ($rowCount > 0) {
        echo "Produit ajouté avec succès.";

    } else {
        // Afficher un message d'erreur si la mise à jour a échoué
        echo "Erreur lors de la mise à jour du produit.";
    }
}

function deleteProdcuctFromAdmin($productId){
    deleteProductById($productId);
    echo "<script>alert('Produit mis à jour avec succès !');</script>";

}

?>