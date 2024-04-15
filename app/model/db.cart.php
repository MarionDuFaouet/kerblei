<?php

include_once RACINE . "/model/connec.inc.php";



function createOrderForUser($userId) {
    $result = FALSE;
    try {
        $cnx = connexionPDO();
        $query = $cnx->prepare("INSERT INTO `Cart` (`accountId`, `statement`) VALUES (:userId, :statement)");
        $result = $query->execute([
            ':userId' => $userId,
            ':statement' => "pending",
        ]);
    } catch (PDOException $e) {
        throw new Exception("Erreur !: " . $e->getMessage());
    }
    return $result;
}

/**
 * Retrieves cart information by account ID.
 *
 * @param int $accountId The ID of the account.
 * @param string $status status filter, all status if "*".
 * @return array An array containing cart information.
 * @throws Exception If an error occurs during the database operation.
 */

function getOrdersByAccountId($accountId, $status) {
    $result = array();
    try {
        $cnx = connexionPDO();
        $sql=
        "SELECT 
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
        c.accountId = :accountId";
        if ($status != '*') $sql .= ' AND c.statement = :statement';
var_dump($sql);
        $query = $cnx->prepare($sql);
        $query->bindValue(':accountId', $accountId, PDO::PARAM_INT);
        if ($status != '*') $query->bindValue(':statement', $status, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        throw new Exception("Erreur !: " . $e->getMessage());
    }
    return $result;
}

/**
 * Retrieves cart information by account ID.
 *
 * @param int $accountId The ID of the account.
 * @return array An array containing cart information.
 * @throws Exception If an error occurs during the database operation.
 */
function getPendingOrdersByAccountId($accountId) {
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
        c.accountId = :accountId AND c.statement = 'pending';");
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
 * @throws Exception If an error occurs during the database operation.
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
 * @param int $cartId The ID of the cart to update.
 * @return bool True on success, false on failure.
 * @throws Exception If an error occurs during the database operation.
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




// // ORDERID
// /**
//  * Adds a product to a specific order in the database.
//  *
//  * @param int $orderId The ID of the order to add the product to.
//  * @param int $productId The ID of the product to add.
//  * @param int $quantity The quantity of the product to add.
//  * @return bool True on success, false on failure.
//  * @throws Exception If an error occurs during the database operation.
//  */
// function addProductToOrder($orderId, $productId, $quantity) {
//     try {
//         $cnx = connexionPDO();
//         $query = $cnx->prepare("INSERT INTO orderProduct (cartId, productId, quantity) VALUES (:cartId, :productId, :quantity)");
//         $query->bindValue(':cartId', $orderId, PDO::PARAM_INT);
//         $query->bindValue(':productId', $productId, PDO::PARAM_INT);
//         $query->bindValue(':quantity', $quantity, PDO::PARAM_INT);
//         $query->execute();
//         return $query->rowCount() > 0;
//     } catch (PDOException $e) {
//         throw new Exception("Erreur !: " . $e->getMessage());
//         return false;
//     }
// }

// /**
//  * Removes a product from a specific order in the database.
//  *
//  * @param int $orderId The ID of the order to remove the product from.
//  * @param int $productId The ID of the product to remove.
//  * @return bool True on success, false on failure.
//  * @throws Exception If an error occurs during the database operation.
//  */
// function removeProductFromOrder($orderId, $productId) {
//     try {
//         $cnx = connexionPDO();
//         $query = $cnx->prepare("DELETE FROM orderProduct WHERE orderId = :orderId AND productId = :productId");
//         $query->bindValue(':orderId', $orderId, PDO::PARAM_INT);
//         $query->bindValue(':productId', $productId, PDO::PARAM_INT);
//         $query->execute();
//         return $query->rowCount() > 0;
//     } catch (PDOException $e) {
//         throw new Exception("Erreur !: " . $e->getMessage());
//         return false;
//     }
// }



// -------------------------------------------------------
// CARTID
/**
 * Adds a product to a specific order in the database.
 *
 * @param int $cartId The ID of the cart to add the product to.
 * @param int $productId The ID of the product to add.
 * @param int $quantity The quantity of the product to add.
 * @return bool True on success, false on failure.
 * @throws Exception If an error occurs during the database operation.
 */
function addProductToCart($cartId, $productId, $quantity) {
    try {
        $cnx = connexionPDO();
        $query = $cnx->prepare("INSERT INTO orderProduct (cartId, productId, quantity) VALUES (:cartId, :productId, :quantity)");
        $query->bindValue(':cartId', $cartId, PDO::PARAM_INT);
        $query->bindValue(':productId', $productId, PDO::PARAM_INT);
        $query->bindValue(':quantity', $quantity, PDO::PARAM_INT);
        $query->execute();
        return $query->rowCount() > 0;
    } catch (PDOException $e) {
        throw new Exception("Erreur !: " . $e->getMessage());
        return false;
    }
}

/**
 * Removes a product from a specific cart in the database.
 *
 * @param int $cartId The ID of the order to remove the product from.
 * @param int $productId The ID of the product to remove.
 * @return bool True on success, false on failure.
 * @throws Exception If an error occurs during the database operation.
 */
function removeProductFromCart($cartId, $productId) {
    try {
        $cnx = connexionPDO();
        $query = $cnx->prepare("DELETE FROM orderProduct WHERE cartId = :cartId AND productId = :productId");
        $query->bindValue(':cartId', $cartId, PDO::PARAM_INT);
        $query->bindValue(':productId', $productId, PDO::PARAM_INT);
        $query->execute();
        return $query->rowCount() > 0;
    } catch (PDOException $e) {
        throw new Exception("Erreur !: " . $e->getMessage());
        return false;
    }
}