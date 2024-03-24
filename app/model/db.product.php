<?php

include_once RACINE . "/model/connec.php";

// retrieve and return all about products from the database.
function getProducts() {
    $products = array();
    try {
        $cnx = connexionPDO();
        $query = $cnx->prepare("SELECT name, designation, unitPrice, pictureRef FROM Product");
        $query->execute();
        $products = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die( "Erreur !: " . $e->getMessage() );
    }
    return $products;
}



// retrieve a product by its id
// va me permettre de retrouver un produit dans ma base, afin de le modifier dans adminProduct
function getProductById($productId) {
    try {
        $cnx = connexionPDO();
        $query = $cnx->prepare("SELECT name, designation, unitPrice, pictureRef FROM Product WHERE productId=:productId");
        $query->bindValue(':productId', $productId, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die( "Erreur !: " . $e->getMessage() );
    }
    return $result;
}

// add products
// va enregistrer un nouveau produit depuis adminProduct
function createProduct($name, $designation, $unitPrice, $pictureRef){
    try{
        $cnx = connexionPDO();
        $query = $cnx ->prepare("INSERT into Product (name, designation, unitPrice, pictureRef) values(:name,:designation, :unitPrice, :pictureRef)");
        $query->bindValue(':name,', $name, PDO::PARAM_STR);
        $query->bindValue(':designation,', $designation, PDO::PARAM_STR);
        $query->bindValue(':unitPrice,', $unitPrice, PDO::PARAM_STR); // ??? dans ma bdd, le type est en decimal!!!
        $query->bindValue(':pictureRef,', $pictureRef, PDO::PARAM_STR);
        $result = $query->execute();
    } catch (PDOException $e) {
        die( "Erreur !: " . $e->getMessage() );
    }
    return $result;
}


// delete product
// va me permettre de supprimer un produit depuis adminProduct
function deleteProductById($productId){
    try {
        $cnx = connexionPDO();
        $query = $cnx->prepare("DELETE FROM Product WHERE productId=:productId");
        $query->bindValue(':productId', $productId, PDO::PARAM_INT);
        $result= $query->execute();
    } catch (PDOException $e) {
        die( "Erreur !: " . $e->getMessage() );
    }
    return $result;
}


?>
