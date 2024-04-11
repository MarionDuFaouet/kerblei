<?php

include_once RACINE . "/model/connec.inc.php";

/**
 * Retrieves cart information by account ID
 *
 * @param int
 * @return array
 * @throws Exception 
 */
function getOrdersByAccountId($accountId) {
    $result = array();
    try {
        $cnx = connexionPDO();
        $query = $cnx->prepare("SELECT 
        c.orderDate,
        c.deliveryDate,
        c.statement,
        p.name AS productName,
        op.quantity AS productQuantity,
        p.unitPrice AS productUnitPrice
    FROM 
        Cart AS c
    JOIN 
        orderproduct AS op ON c.cartId = op.cartId
    JOIN 
        product AS p ON op.productId = p.productId
    WHERE 
        c.accountId = :accountId;");
        $query->bindValue(':accountId', $accountId, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        throw new Exception("Erreur !: " . $e->getMessage());    
    }
    return $result;
}

/**
 * Retrieves orders information including order details, customer information, 
 * and product information.
 *
 * @return array 
 * @throws Exception
 */
function getOrders() {
    $result = array();
    try {
        $cnx = connexionPDO();
        $query = $cnx->prepare("SELECT 
        c.cartId,
        c.orderDate,
        c.deliveryDate,
        c.statement,
        k.name AS KerbleiUserName,
        k.firstname AS KerbleiUserFirstname,
        k.phone,
        p.productId,
        p.name AS productName,
        op.quantity AS productQuantity,
        p.unitPrice AS productUnitPrice
    FROM 
        Cart c
    JOIN 
        KerbleiUser k ON c.accountId = k.accountId
    JOIN 
        orderProduct op ON c.cartId = op.cartId
    JOIN 
        Product p ON op.productId = p.productId");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
throw new Exception("Erreur !: " . $e->getMessage());    
}
return $result;
}

/**
 * Update the statement of a cart in the database to 'terminée'.
 *
 * @param int
 * @return bool
 * @throws Exception
 */
function updateCartStatement($cartId) {
    try {
        $cnx = connexionPDO();
        $query = $cnx->prepare("UPDATE `Cart` SET `statement` = 'terminée' WHERE cartId = :cartId");
        $query->bindValue(':cartId', $cartId, PDO::PARAM_INT);
        $query->execute();
        return true;
    } catch (PDOException $e) {
        throw new Exception("Erreur !: " . $e->getMessage());
    }
}

// récupère le contenu du panier et met à jour la quantité des produits qu'il contient
// lié au curseur numérique de mon panier
// function updateProductQuantity($cartId, $productId, $newQuantity) {
//     try {
//         $cnx = connexionPDO();
//         // Vérifie d'abord si le produit est déjà dans le panier
//         $queryCheck = $cnx->prepare("SELECT * FROM orderProduct WHERE cartId = :cartId AND productId = :productId");
//         $queryCheck->bindValue(':cartId', $cartId, PDO::PARAM_INT);
//         $queryCheck->bindValue(':productId', $productId, PDO::PARAM_INT);
//         $queryCheck->execute();
        
//         if ($queryCheck->rowCount() > 0) {
//             // Le produit est déjà dans le panier, met à jour la quantité
//             $queryUpdate = $cnx->prepare("UPDATE orderProduct SET quantity = :quantity WHERE cartId = :cartId AND productId = :productId");
//             $queryUpdate->bindValue(':cartId', $cartId, PDO::PARAM_INT);
//             $queryUpdate->bindValue(':productId', $productId, PDO::PARAM_INT);
//             $queryUpdate->bindValue(':quantity', $newQuantity, PDO::PARAM_INT);
//             $queryUpdate->execute();
//             // Vérifie si la mise à jour a réussi
//             return true;
//         } else {
//             // Le produit n'est pas dans le panier, retourne faux
//             return false;
//         }
//     } catch (PDOException $e) {
//         // En cas d'erreur, affiche un message d'erreur et retourne faux
//         throw new Exception("Erreur !: " . $e->getMessage());    
//         return false;
//     }
// }

// delete all of an item from a cart
// supprime la totalité d'un produit identifié dans une commande identifiée
// lié à l'icone trash du panier
// function removeProductsById($cartId, $productId) {
//     try {
//         $cnx = connexionPDO();
//         $query = $cnx->prepare("DELETE FROM orderProduct WHERE cartId = :cartId AND productId = :productId");
//         $query->bindValue(':cartId', $cartId, PDO::PARAM_INT);
//         $query->bindValue(':productId', $productId, PDO::PARAM_INT);
//         $query->execute();
//         // Vérifier si des produits ont été supprimés avec succès
//         return $query->rowCount() > 0;
//     } catch (PDOException $e) {
//         throw new Exception("Erreur !: " . $e->getMessage());    
//         return false;
//     }
// }

?>