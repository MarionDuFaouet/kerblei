<?php

include_once RACINE . "/model/connec.inc.php";


/**
 * Retrieves cart information by account ID
 *
 * @param int $accountId The account ID for which to retrieve the cart
 * @return array The cart information as an associative array
 * @throws Exception If a PDO error occurs during the execution of the SQL query
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
 * @return array An array containing orders information.
 * Each element of the array represents an order and is an associative array 
 * with keys such as 'cartId', 'orderDate', 'deliveryDate', 'statement', 
 * 'KerbleiUser' (customer name), 'phone', 'productId', 'productName', 
 * 'quantity', and 'unitPrice'.
 * @throws Exception If a PDO error occurs during the execution of the SQL query
 */
// va me permettre de récupérer les commandes depuis adminCart
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


 


// retrieve an cart by status
// affiche les dates de commande et date de livraison choisie par le client
// des commandes par leur statut
// va me permettre d'afficher mes commandes selon leur statut dans deux sections différentes de adminCart et account
function getCartByStatement($statement){
    try {
        $cnx = connexionPDO();
        $query = $cnx->prepare("SELECT orderDate, deliveryDate FROM Cart WHERE statement=:statement");
        $query->bindValue(':statement', $statement, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        throw new Exception("Erreur !: " . $e->getMessage());    
    }
    return $result;
}


/**
 * Update the statement of a cart in the database to 'completed'.
 *
 * @param int $cartId The ID of the cart to update.
 * @return bool True if the statement is successfully updated, false otherwise.
 * @throws Exception If an error occurs while executing the SQL query.
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


// Exemple d'utilisation
// $cart = [
//     ['name' => 'Product 1', 'unitPrice' => 5],
//     ['name' => 'Product 2', 'unitPrice' => 5],
//     ['name' => 'Product 3', 'unitPrice' => 5]
// ];

// $total = calculateCartTotal($cart);
// echo "Prix total de votre commande: $total";



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