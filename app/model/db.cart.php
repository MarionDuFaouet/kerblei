<?php

include_once RACINE . "/model/connec.inc.php";


/**
 * Récupère les informations du panier par identifiant de compte
 *
 * @param int $accountId L'identifiant du compte pour lequel récupérer le panier
 * @return array Les informations du panier sous forme d'un tableau associatif
 * @throws Exception Si une erreur PDO survient lors de l'exécution de la requête SQL
 */
function getCartByAccountId($accountId) {
    $result = array();
    try {
        $cnx = connexionPDO();
        $query = $cnx->prepare("SELECT orderDate, deliveryDate, statement FROM `Cart` WHERE accountId=:accountId");
        $query->bindValue(':accountId', $accountId, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        throw new Exception("Erreur !: " . $e->getMessage());    
    }
    return $result;
}




// TOUT CE QUI CONCERNE LA PAGE PANIER ET NON PRODUCTS

// retrieve an cart
// retourne dans un tableau le détail de la commande d'un client
// va me permettre de récupérer une commande depuis adminCart
// function getCartDetails() {
//     $result = array();
//     try {
//         $cnx = connexionPDO();
//         $query = $cnx->prepare("SELECT K.name K.firstname AS userName, P.name AS productName, 
//         P.designation AS designation, C.statement AS statement, C.orderDate AS orderDate, C.deliveryDate AS deliveryDate
//             FROM Cart C
//             JOIN KerbleiUser K ON C.userId = K.userId
//             JOIN OrderProduct OP ON C.cartId = OP.cartId
//             JOIN Product P ON OP.productId = P.productId
//             ORDER BY C.orderDate DESC");
//         $query->execute();
//         while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
//             $result[] = $row;
//         }

//         // !!! message d'erreur plus sécure? à faire valider !!!
//     } catch (PDOException $e) {
//         error_log("Erreur PDO : " . $e->getMessage());
//         die("Une erreur s'est produite lors du traitement de votre requête.");
//     }
//     return $result;
// }


 


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


// change cart status
// met à jour le statut d'une commande identifiée
// utilisé dans adminCart et cart
// ???mon statement est de type ENUM, est-ce que je le gère bien???
function updateCartStatement($cartId, $newStatus){
    try {
        $cnx = connexionPDO();
        $query = $cnx->prepare("UPDATE `Cart` SET `statement` = :newStatus WHERE cartId = :cartId");
        $query->bindValue(':newStatus', $newStatus, PDO::PARAM_STR);
        $query->bindValue(':cartId', $cartId, PDO::PARAM_INT);
        $query->execute();
        return true;
    } catch (PDOException $e) {
        throw new Exception("Erreur !: " . $e->getMessage());    
        return false;
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