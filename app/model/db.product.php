<?php

include_once RACINE . "/model/connec.inc.php";

function getProductById($productId)
{
    try {
        $cnx = connexionPDO();
        $query = $cnx->prepare("SELECT productId, name, unitPrice FROM product WHERE productId = :productId");
        $query->bindParam(':productId', $productId);
        $query->execute();
        $product = $query->fetch(PDO::FETCH_ASSOC);

        return $product;
    } catch (PDOException $e) {
        throw new Exception("Erreur lors de la récupération du produit: " . $e->getMessage());
    }
}


/**
 * Retrieve and return all products from the database.
 *
 * @return array An array containing all products fetched from the database.
 */
function getProducts()
{
    $products = array();
    try {
        $cnx = connexionPDO();
        $query = $cnx->prepare("SELECT productId, name, degree, designation, unitPrice, pictureRef FROM product");
        $query->execute();
        $products = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        throw new Exception("Erreur !: " . $e->getMessage());
    }
    return $products;
}


/**
 * Creates a new product in the database.
 *
 * @param string $name Product name.
 * @param string $degree Alcohol degree of the product.
 * @param string $designation Product description.
 * @param string $unitPrice Unit price of the product.
 * @param string $pictureRef Reference of the product image.
 * @return bool Returns true if the product was successfully created, otherwise returns false.
 */
function addProduct($name, $degree, $designation, $unitPrice, $pictureRef)
{
    try {
        $cnx = connexionPDO();
        $query = $cnx->prepare("INSERT INTO product (name, degree, designation, unitPrice, pictureRef) VALUES (:name, :degree, :designation, :unitPrice, :pictureRef)");
        $query->bindValue(':name', $name, PDO::PARAM_STR);
        $query->bindValue(':degree', $degree, PDO::PARAM_STR);
        $query->bindValue(':designation', $designation, PDO::PARAM_STR);
        $query->bindValue(':unitPrice', $unitPrice, PDO::PARAM_STR);
        $query->bindValue(':pictureRef', $pictureRef, PDO::PARAM_STR);
        $result = $query->execute();
    } catch (PDOException $e) {
        throw new Exception("Erreur !: " . $e->getMessage());
    }
    return $result;
}
// TRAITEMENT IMG à RETRAVAILLER
// function addProduct($name, $degree, $designation, $unitPrice, $pictureRef)
// {
//     try {
//         // Vérifier si le fichier a été téléchargé sans erreur
//         if ($pictureRef['error'] === UPLOAD_ERR_OK) {
//             // Déplacer le fichier téléchargé vers un répertoire sur le serveur
//             $uploadDir = 'uploads/'; // Répertoire où vous souhaitez enregistrer les images
//             $uploadFile = $uploadDir . basename($pictureRef['name']);
//             if (move_uploaded_file($pictureRef['tmp_name'], $uploadFile)) {
//                 // Insérer les données dans la base de données
//                 $cnx = connexionPDO();
//                 $query = $cnx->prepare("INSERT INTO Product (name, degree, designation, unitPrice, pictureRef) VALUES (:name, :degree, :designation, :unitPrice, :pictureRef)");
//                 $query->bindValue(':name', $name, PDO::PARAM_STR);
//                 $query->bindValue(':degree', $degree, PDO::PARAM_STR);
//                 $query->bindValue(':designation', $designation, PDO::PARAM_STR);
//                 $query->bindValue(':unitPrice', $unitPrice, PDO::PARAM_STR);
//                 $query->bindValue(':pictureRef', $uploadFile, PDO::PARAM_STR); // Utilisez le chemin d'accès du fichier enregistré
//                 $result = $query->execute();
//                 return $result;
//             } else {
//                 throw new Exception("Erreur lors de l'enregistrement de l'image.");
//             }
//         } else {
//             throw new Exception("Erreur lors du téléchargement de l'image.");
//         }
//     } catch (PDOException $e) {
//         throw new Exception("Erreur !: " . $e->getMessage());
//     }
// }


/**
 * Updates a product in the database.
 *
 * @param int $productId The ID of the product to update.
 * @param string $productName The updated name of the product.
 * @param string $productDegree The updated degree of the product.
 * @param string $productDescription The updated description of the product.
 * @param string $productPrice The updated unit price of the product.
 * @param string $productPictureRef The updated picture reference of the product.
 */
function updateProduct($productId, $productName, $productDegree, $productDescription, $productPrice)
{
    try {
        $cnx = connexionPDO();
        $query = $cnx->prepare("UPDATE product SET `name` = :name, `degree` = :degree, `designation` = :designation, `unitPrice` = :unitPrice WHERE productId = :productId");
        $query->bindValue(':productId', $productId, PDO::PARAM_INT);
        $query->bindValue(':name', $productName, PDO::PARAM_STR);
        $query->bindValue(':degree', $productDegree, PDO::PARAM_STR);
        $query->bindValue(':designation', $productDescription, PDO::PARAM_STR);
        $query->bindValue(':unitPrice', $productPrice, PDO::PARAM_STR);
        
        $query->execute();
    } catch (PDOException $e) {
        throw new Exception("Erreur PDO : " . $e->getMessage());
    }
}

/**
 * Deletes a product from the database.
 *
 * @param int $productId The ID of the product to delete.
 * @return bool True if the deletion was successful, false otherwise.
 */
function deleteProduct($productId)
{
    try {
        $cnx = connexionPDO();
        $query = $cnx->prepare("DELETE FROM product WHERE productId=:productId");
        $query->bindValue(':productId', $productId, PDO::PARAM_INT);
        $result = $query->execute();
        return $result;
    } catch (PDOException $e) {
        throw new Exception("Erreur PDO : " . $e->getMessage());
    }
}
