<?php

include_once "db.connec.php";

// retrieve an order
// va me permettre de récupérer une commande depuis adminOrder
function getOrders($dbConnection, $startDate = null, $endDate = null, $status = null){
    $result = array();
    try {
        $cnx = connexionPDO();
        $query = $cnx->prepare("SELECT 
        nameFirstname AS Client,
        GROUP_CONCAT(p.name SEPARATOR ' ') AS Produits_Commandés,
        GROUP_CONCAT(op.quantity SEPARATOR ', ') AS Quantités,
        SUM(op.quantity * p.unitPrice) AS Prix_Total,
        o.orderDate AS Date_Commande,
        o.status AS Statut_Commande,
        o.deliveryDate AS Date_Livraison
    FROM 
        `Order` o
    JOIN 
        `User` u ON o.userId = u.userId
    JOIN 
        `Order_Product` op ON o.orderId = op.orderId
    JOIN 
        `Product` p ON op.productId = p.productId
    GROUP BY 
        o.orderId;");
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

// retrieve an order by its id
// va me permettre de récupérer les commandes en cours et passées depuis account

//je dois faire une requête qui va me renvoyer le nomPrénom du client,, la date de commande, 
// la date de livraison, le nom des produits et leur quantité, le prix total de la commande, 
// depuis les tables user, order et produit = jointure
// function getOrderByAccountId($accountId) {
//     $result = array();
//     try {
//         $cnx = connexionPDO();
//         $query = $cnx->prepare("SELECT name, unitPrice FROM `Order` WHERE accountId=:accountId");
//         $query->bindValue(':accountId', $accountId, PDO::PARAM_INT);
//         $query->execute();

//         // Récupération de toutes les lignes de résultat
//         $result = $query->fetchAll(PDO::FETCH_ASSOC);
//     } catch (PDOException $e) {
//         die("Erreur !: " . $e->getMessage());
//     }
//     return $result;
// }



// retrieve an order by status
// va me permettre d'afficher mes commandes selon leur statut dans deux sections différentes de adminOrder
function getOrderByStatement($statement){

}

// change order status
// va me permettre de changer le statut d'une commande, depuis adminOrder et order
function updateStatement(){

}

// calcul price of an order
// va me permettre de calculer le prix total  d'une commande depuis order
function calculateCartTotal($unitPrice){
    
}

// ajouter un produit dans le panier
function addProductToCart(){

}
// retirer un article dans le panier
function removeProductFromCart(){
    
}

// effacer un produit d'une commande
function deleteProductFromOrder(){

}

?>