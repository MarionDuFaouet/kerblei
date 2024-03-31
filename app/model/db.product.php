<?php

include_once RACINE . "/model/connec.inc.php";

// retrieve and return all about products from the database.
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



// retrieve a product by its id
// va me permettre de retrouver un produit dans ma base, afin de le modifier dans adminProduct
function getProductById($productId)
{
    try {
        $cnx = connexionPDO();
        $query = $cnx->prepare("SELECT name, degree, designation, unitPrice, pictureRef FROM Product WHERE productId=:productId");
        $query->bindValue(':productId', $productId, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erreur !: " . $e->getMessage());
    }
    return $result;
}

// add products
// va enregistrer un nouveau produit depuis adminProduct
function createProduct($name, $degree, $designation, $unitPrice, $pictureRef)
{
    try {
        $cnx = connexionPDO();
        $query = $cnx->prepare("INSERT into Product (name, degree, designation, unitPrice, pictureRef) values(:name, :degree, :designation, :unitPrice, :pictureRef)");
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
