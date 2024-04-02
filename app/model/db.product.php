<?php

include_once RACINE . "/model/connec.inc.php";

###DEBUG
// var_dump('coucou');

/**
 * Retrieve and return all products from the database.
 *
 * @return array An array containing all products fetched from the database.
 */
//me permet d'afficher les produits
function getProducts() {
    $products = array();
    try {
        $cnx = connexionPDO();
        $query = $cnx->prepare("SELECT productId, name, degree, designation, unitPrice, pictureRef FROM Product");
        $query->execute();
        $products = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erreur !: " . $e->getMessage());
    }
    return $products;
}

/**
 * Retrieve product information by its ID.
 *
 * @param int $productId The ID of the product to retrieve.
 * @return array|null Returns an associative array containing product information if found, otherwise returns null.
 */
function getProductById($productId)
{
    try {
        $cnx = connexionPDO();
        $query = $cnx->prepare("SELECT name, degree, designation, unitPrice, pictureRef FROM Product WHERE productId=:productId");
        $query->bindValue(':productId', $productId, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result; // Return product information
    } catch (PDOException $e) {
        // Instead of using die(), you can log the error and handle it more gracefully
        error_log("Error fetching product: " . $e->getMessage());
        return null; // Return null to indicate failure
    }
}

// add products
// va enregistrer un nouveau produit depuis adminProduct
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
function createProduct($name, $degree, $designation, $unitPrice, $pictureRef)
{
    try {
        $cnx = connexionPDO();
        $query = $cnx->prepare("INSERT INTO Product (name, degree, designation, unitPrice, pictureRef) VALUES (:name, :degree, :designation, :unitPrice, :pictureRef)");
        $query->bindValue(':name', $name, PDO::PARAM_STR);
        $query->bindValue(':degree', $degree, PDO::PARAM_STR);
        $query->bindValue(':designation', $designation, PDO::PARAM_STR);
        $query->bindValue(':unitPrice', $unitPrice, PDO::PARAM_STR); // ??? dans ma bdd, le type est en decimal!!!
        $query->bindValue(':pictureRef', $pictureRef, PDO::PARAM_STR);
        $result = $query->execute();
    } catch (PDOException $e) {
        die("Erreur !: " . $e->getMessage());
    }
    return $result;
}

// va me permettre de mettre à jour un produit
function updateProduct($productId, $newData){
    try {
        $cnx = connexionPDO();

        $query = $cnx->prepare("UPDATE Product SET name = :name, degree = :degree, designation = :designation, unitPrice = :unitPrice, pictureRef = :pictureRef WHERE productId = :productId");
        $query->bindValue(':productId', $productId, PDO::PARAM_INT);
        $query->bindValue(':name', $newData['name'], PDO::PARAM_STR);
        $query->bindValue('degree', $newData['degree'], PDO::PARAM_STR);
        $query->bindValue(':designation', $newData['designation'], PDO::PARAM_STR);
        $query->bindValue(':unitPrice', $newData['unitPrice'], PDO::PARAM_STR);
        $query->bindValue(':pictureRef', $newData['pictureRef'], PDO::PARAM_STR);

        $query->execute();

        // Vérification du nombre de lignes affectées (pour confirmer la réussite de la mise à jour)
        $rowCount = $query->rowCount();

        // Fermeture de la connexion à la base de données
        $cnx = null;

        // Retourner le nombre de lignes affectées (0 si la mise à jour a échoué)
        return $rowCount;
    } catch (PDOException $e) {
        die("Erreur lors de la mise à jour du produit : " . $e->getMessage());
    }
}


// delete product
// va me permettre de supprimer un produit depuis adminProduct
function deleteProductById($productId)
{
    try {
        $cnx = connexionPDO();
        $query = $cnx->prepare("DELETE FROM Product WHERE productId=:productId");
        $query->bindValue(':productId', $productId, PDO::PARAM_INT);
        $result = $query->execute();
    } catch (PDOException $e) {
        die("Erreur !: " . $e->getMessage());
    }
    return $result;
}
