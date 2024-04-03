<?php

include_once RACINE . "/model/connec.inc.php";

###DEBUG
// var_dump('coucou');

/**
 * Retrieve and return all products from the database.
 *
 * @return array An array containing all products fetched from the database.
 */
// to show all products in admin list and shop
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
 * Creates a new product in the database.
 *
 * @param string $name Product name.
 * @param string $degree Alcohol degree of the product.
 * @param string $designation Product description.
 * @param string $unitPrice Unit price of the product.
 * @param string $pictureRef Reference of the product image.
 * @return bool Returns true if the product was successfully created, otherwise returns false.
 */
// to add product in admin
function addProduct($name, $degree, $designation, $unitPrice, $pictureRef)
{
    try {
        $cnx = connexionPDO();
        $query = $cnx->prepare("INSERT INTO Product (name, degree, designation, unitPrice, pictureRef) VALUES (:name, :degree, :designation, :unitPrice, :pictureRef)");
        $query->bindValue(':name', $name, PDO::PARAM_STR);
        $query->bindValue(':degree', $degree, PDO::PARAM_STR);
        $query->bindValue(':designation', $designation, PDO::PARAM_STR);
        $query->bindValue(':unitPrice', $unitPrice, PDO::PARAM_STR); // Change to PDO::PARAM_DECIMAL if the price is stored as a DECIMAL in the database
        $query->bindValue(':pictureRef', $pictureRef, PDO::PARAM_STR);
        $result = $query->execute();
    } catch (PDOException $e) {
        die("Erreur !: " . $e->getMessage());
    }
    return $result;
}


/**
 * Updates a product in the database.
 *
 * @param int $productId The ID of the product to update.
 * @param string $productName The updated name of the product.
 * @param string $productDegree The updated degree of the product.
 * @param string $productDescription The updated description of the product.
 * @param string $productPrice The updated unit price of the product.
 * @param string $productPictureRef The updated picture reference of the product.
 * @return int The number of rows affected by the update operation.
 */
function updateProduct($productId, $productName, $productDegree, $productDescription, $productPrice, $productPictureRef) {
    try {
        $cnx = connexionPDO();
        $query = $cnx->prepare("UPDATE Product SET name = :name, degree = :degree, designation = :designation, unitPrice = :unitPrice, pictureRef = :pictureRef WHERE productId = :productId");
        $query->bindValue(':productId', $productId, PDO::PARAM_INT);
        $query->bindValue(':name', $productName, PDO::PARAM_STR);
        $query->bindValue(':degree', $productDegree, PDO::PARAM_STR);
        $query->bindValue(':designation', $productDescription, PDO::PARAM_STR);
        $query->bindValue(':unitPrice', $productPrice, PDO::PARAM_STR);
        $query->bindValue(':pictureRef', $productPictureRef, PDO::PARAM_STR);
        $query->execute();
        // Check the number of affected rows (to confirm the success of the update)
        $rowCount = $query->rowCount();
        // Close the database connection
        $cnx = null;
        // Return the number of affected rows (0 if the update failed)
        return $rowCount;
    } catch (PDOException $e) {
        die("Error updating the product: " . $e->getMessage());
    }
}

/**
 * Deletes a product from the database.
 *
 * @param int $productId The ID of the product to delete.
 * @return bool True if the deletion was successful, false otherwise.
 */
function deleteProduct($productId) {
    try {
        $cnx = connexionPDO();
        $query = $cnx->prepare("DELETE FROM Product WHERE productId=:productId");
        $query->bindValue(':productId', $productId, PDO::PARAM_INT);
        $result = $query->execute();
        // Return true if the deletion was successful
        return $result;
    } catch (PDOException $e) {
        // Handle any errors that occur during deletion
        die("Error deleting the product: " . $e->getMessage());
    }
}
