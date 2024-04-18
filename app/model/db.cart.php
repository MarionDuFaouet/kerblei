<?php

include_once RACINE . "/model/connec.inc.php";

/**
 * Create an new order for a identified user (empty order).
 *
 * @param Int $userId The ID of the account.
 * @param String $deliveryDate The expected delivery date.
 * @return Int The last id inserted into the table, 0 if error.
 * @throws Exception If an error occurs during the database operation.
 */

function createOrderForUser($userId, $deliveryDate) {
    $result = 0;
    try {
        $cnx = connexionPDO();
        $query = $cnx->prepare("
            INSERT INTO `cart` (`deliveryDate`, `statement`, `accountId`) 
            VALUES (:deliveryDate, 'déposée', :userId)");
        $query->execute([
            ':deliveryDate' => $deliveryDate,
            ':userId' => $userId
        ]);
        $result = $cnx->lastInsertId();
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
        c.cartId,
        c.orderDate,
        c.deliveryDate,
        c.statement,
        p.name AS productName,
        op.quantity AS productQuantity,
        p.unitPrice AS productUnitPrice
    FROM 
        cart AS c
    JOIN 
        orderproduct AS op ON c.cartId = op.cartId
    JOIN 
        product AS p ON op.productId = p.productId
    WHERE 
        c.accountId = :accountId";
        if ($status != '*') $sql .= ' AND c.statement = :statement';
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

// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
/**
 * Retrieves cart information by account ID.
 *
 * @param int $userId The ID of the user (account owner).
 * @param string $status status filter, all status if "*".
 * @return array An array containing order (header) information.
 * @throws Exception If an error occurs during the database operation.
 */

function getOrdersByUser($userId, $status) {
    $result = array();
    try {
        $cnx = connexionPDO();
        $sql="SELECT c.cartId, c.orderDate, c.deliveryDate, c.statement
            FROM cart AS c
            WHERE c.accountId = :accountId";
        if ($status != '*') $sql .= ' AND c.statement = :statement';
        $query = $cnx->prepare($sql);
        $query->bindValue(':accountId', $userId, PDO::PARAM_INT);
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
 * @param int $cartId The ID of the order.
 * @return array An array containing (full) product information (name, unit price, quantity, description).
 * @throws Exception If an error occurs during the database operation.
 */

 function getOrderFullContent($cartId) {
    $result = array();
    try {
        $cnx = connexionPDO();
        $sql="SELECT 
            p.name AS productName, 
            p.designation AS productDesignation, 
            p.unitPrice AS productUnitPrice,
            op.quantity AS productQuantity 
        FROM 
            orderproduct AS op
        JOIN 
            product AS p ON op.productId = p.productId
        WHERE 
            op.cartId = :cartId";
        
        $query = $cnx->prepare($sql);
        $query->bindValue(':cartId', $cartId, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        throw new Exception("Erreur !: " . $e->getMessage());
    }
    return $result;
}
// -------------------------------

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
        cart c
    JOIN 
        kerbleiuser k ON c.accountId = k.accountId
    JOIN 
        orderproduct op ON c.cartId = op.cartId
    JOIN 
        product p ON op.productId = p.productId");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        throw new Exception("Erreur !: " . $e->getMessage());
    }
    return $result;
}

/**
 * Update the statement of a cart in the database
 *
 * @param int $cartId The ID of the cart to update.
 * @param string $statement of the cart.
 * @return bool True on success, false on failure.
 * @throws Exception If an error occurs during the database operation.
 */
function updateCartStatement($cartId, $status) {
    try {
        $cnx = connexionPDO();
        $query = $cnx->prepare("UPDATE `cart` SET `statement` = :statement WHERE cartId = :cartId");
        $query->bindValue(':cartId', $cartId, PDO::PARAM_INT);
        $query->bindValue(':statement', $status, PDO::PARAM_STR);
        $query->execute();
        return true;
    } catch (PDOException $e) {
        throw new Exception("Erreur !: " . $e->getMessage());
    }
}


/**
 * Adds a product to a specific order in the database.
 *
 * @param int $orderId The ID of the order to add the product to.
 * @param int $productId The ID of the product to add.
 * @param int $quantity The quantity of the product to add.
 * @return bool True on success, false on failure.
 * @throws Exception If an error occurs during the database operation.
 */
function addProductToOrder($orderId, $productId, $quantity) {
    try {
        $cnx = connexionPDO();
        $query = $cnx->prepare("INSERT INTO orderproduct (cartId, productId, quantity) VALUES (:cartId, :productId, :quantity)");
        $query->bindValue(':cartId', $orderId, PDO::PARAM_INT);
        $query->bindValue(':productId', $productId, PDO::PARAM_INT);
        $query->bindValue(':quantity', $quantity, PDO::PARAM_INT);
        return $query->execute();
        //return $query->rowCount() > 0;
    } catch (PDOException $e) {
        throw new Exception("Erreur !: " . $e->getMessage());
        return false;
    }
}

// -------------------------------------------------------
// CART
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
        $query = $cnx->prepare("INSERT INTO orderproduct (cartId, productId, quantity) VALUES (:cartId, :productId, :quantity)");
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
        $query = $cnx->prepare("DELETE FROM orderproduct WHERE cartId = :cartId AND productId = :productId");
        $query->bindValue(':cartId', $cartId, PDO::PARAM_INT);
        $query->bindValue(':productId', $productId, PDO::PARAM_INT);
        $query->execute();
        return $query->rowCount() > 0;
    } catch (PDOException $e) {
        throw new Exception("Erreur !: " . $e->getMessage());
        return false;
    }
}