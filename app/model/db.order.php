<?php

include_once "db.connec.php";

// !!! peut-être que je fais fausse route, ma requête doit peut-être 
// juste récupérer mes commandes, et c'est mon routeur qui fera le 
// travail en allant chercher à la fois dans user, order et product
// les infos demandées dans la vue ???

// retrieve an order
// va me permettre de récupérer une commande depuis adminOrder
function getOrderDetails() {
    $result = array();
    try {
        $cnx = connexionPDO();
        $query = $cnx->prepare("SELECT U.name AS userName, U.firstname AS userFirstname, P.name AS productName, 
        P.designation, O.statement, O.orderDate, O.deliveryDate
            FROM `Order` O
            JOIN User U ON O.userId = U.userId
            JOIN orderProduct OP ON O.orderId = OP.orderId
            JOIN Product P ON OP.productId = P.productId");
        $query->execute();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $result[] = $row;
        }
    } catch (PDOException $e) {
        die("Erreur !: " . $e->getMessage());
    }

    return $result;
}

// retrieve an order by its id
// va me permettre de récupérer les commandes en cours et passées depuis account
function getOrderByAccountId($orderId) {
    $result = array();
    try {
        $cnx = connexionPDO();
        $query = $cnx->prepare("SELECT orderDate, deliveryDate, statement FROM `Order` WHERE orderId=:orderId");
        $query->bindValue(':accountId', $accountId, PDO::PARAM_INT);
        $query->execute();

        // Récupération de toutes les lignes de résultat
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erreur !: " . $e->getMessage());
    }
    return $result;
}



// retrieve an order by status
// va me permettre d'afficher mes commandes selon leur statut dans deux sections différentes de adminOrder et compteUser
function getOrderByStatement($statement){
    try {
        $cnx = connexionPDO();
        $query = $cnx->prepare("SELECT orderDate, deliveryDate FROM Order WHERE statement=:statement");
        $query->bindValue(':statement', $statement, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die( "Erreur !: " . $e->getMessage() );
    }
    return $result;
}


// change order status
// va me permettre de changer le statut d'une commande, depuis adminOrder et order
// ???mon statement est de type ENUM, est-ce que je le gère bien???
function updateOrderStatement($orderId, $newStatus){
    try {
        $cnx = connexionPDO();
        $query = $conn->prepare("UPDATE `Order` SET status = :newStatus WHERE orderId = :orderId");
        $query->bindValue(':newStatus', $newStatus, PDO::PARAM_STR);
        $query->bindValue(':orderId', $orderId, PDO::PARAM_INT);
        $query->execute();
        return true;
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
        return false;
    }
}

// calcul price of an order
// va me permettre de calculer le prix total  d'une commande depuis order
function calculateOrderTotal($order){
    $totalPrice = 0;
    foreach ($order as $product) {
        $totalPrice += $product['unitPrice'];
    }
    return $totalPrice;
}
// Exemple d'utilisation
// $order = [
//     ['name' => 'Product 1', 'unitPrice' => 5],
//     ['name' => 'Product 2', 'unitPrice' => 5],
//     ['name' => 'Product 3', 'unitPrice' => 5]
// ];

// $total = calculateOrderTotal($order);
// echo "Prix total de votre commande: $total";


// add product on order
// va permettre d'ajouter un produit depuis order
function addProductToOrder($orderId, $productId, $quantity) {
    try {
        $cnx = connexionPDO();
        // Vérifier si le produit existe déjà dans la commande
        $query = $cnx->prepare("SELECT * FROM orderProduct WHERE orderId = :orderId AND productId = :productId");
        $query->bindValue(':orderId', $orderId, PDO::PARAM_INT);
        $query->bindValue(':productId', $productId, PDO::PARAM_INT);
        $query->execute();
        // Si le produit existe déjà, mettre à jour la quantité
        if ($query->rowCount() > 0) {
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $newQuantity = $row['quantity'] + $quantity;
            $updateQuery = $cnx->prepare("UPDATE orderProduct SET quantity = :newQuantity WHERE orderId = :orderId AND productId = :productId");
            $updateQuery->bindValue(':newQuantity', $newQuantity, PDO::PARAM_INT);
            $updateQuery->bindValue(':orderId', $orderId, PDO::PARAM_INT);
            $updateQuery->bindValue(':productId', $productId, PDO::PARAM_INT);
            $updateQuery->execute();
        } else { // Sinon, ajouter un nouveau produit à la commande
            $insertQuery = $cnx->prepare("INSERT INTO orderProduct (orderId, productId, quantity) VALUES (:orderId, :productId, :quantity)");
            $insertQuery->bindValue(':orderId', $orderId, PDO::PARAM_INT);
            $insertQuery->bindValue(':productId', $productId, PDO::PARAM_INT);
            $insertQuery->bindValue(':quantity', $quantity, PDO::PARAM_INT);
            $insertQuery->execute();
        }
        return true;
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
        return false;
    }
}

// remove an item from the cart
// lié au curseur numérique de mon panier
function removeProductsByIdAndQuantity($orderId, $productId, $cartQuantity) {
    try {
        $cnx = connexionPDO();
        // Supprimer un certain nombre de produits ayant l'identifiant spécifié de la commande
        $query = $cnx->prepare("DELETE FROM orderProduct WHERE orderId = :orderId AND productId = :productId LIMIT :quantity");
        $query->bindValue(':orderId', $orderId, PDO::PARAM_INT);
        $query->bindValue(':productId', $productId, PDO::PARAM_INT);
        $query->bindValue(':quantity', $cartQuantity, PDO::PARAM_INT);
        $query->execute();
        // Vérifier si des produits ont été supprimés avec succès
        return $query->rowCount() > 0;
    } catch (PDOException $e) {
        // En cas d'erreur, afficher un message d'erreur et retourner faux
        echo "Erreur : " . $e->getMessage();
        return false;
    }
}

// delete all of an item from a cart
// lié à l'icone trash du panier
function removeAllProductsById($orderId, $productId) {
    try {
        $cnx = connexionPDO();
        $query = $cnx->prepare("DELETE FROM orderProduct WHERE orderId = :orderId AND productId = :productId");
        $query->bindValue(':orderId', $orderId, PDO::PARAM_INT);
        $query->bindValue(':productId', $productId, PDO::PARAM_INT);
        $query->execute();
        // Vérifier si des produits ont été supprimés avec succès
        return $query->rowCount() > 0;
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
        return false;
    }
}

?>