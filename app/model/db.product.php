<?php

include_once "db.connec.php";

// get all from product table
//pour afficher les produits dans ma vue/produit
//affiche le nom, le prix, la description, l'image
function getProducts() {
    $result = array();
    try {
        $cnx = connexionPDO();
        $query = $cnx->prepare("SELECT name, designation, unitPrice, pictureLink FROM Product");
        $query->execute();
        $row = $query->fetch(PDO::FETCH_ASSOC);
        while ($row) {
            $result[] = $row;
            $row = $query->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        die( "Erreur !: " . $e->getMessage() );
    }
    return $result;
}



// retrieve a product by its id
// va me permettre de retrouver un produit dans ma base, afin de le modifier dans adminProduct
function getProductById($productId) {
    try {
        $cnx = connexionPDO();
        $query = $cnx->prepare("SELECT name, designation, unitPrice, pictureLink FROM Product WHERE productId=:productId");
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
function createProduct($name, $designation, $unitPrice, $pictureLink){
    try{
        $cnx = connexionPDO();
        $query = $cnx ->prepare("INSERT into Product (name, designation, unitPrice, pictureLink) values(:name,:designation, :unitPrice, :pictureLink)");
        $query->bindValue(':name,', $name, PDO::PARAM_STR);
        $query->bindValue(':designation,', $designation, PDO::PARAM_STR);
        $query->bindValue(':unitPrice,', $unitPrice, PDO::PARAM_STR); // ??? dans ma bdd, le type est en decimal!!!
        $query->bindValue(':pictureLink,', $pictureLink, PDO::PARAM_STR);
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
