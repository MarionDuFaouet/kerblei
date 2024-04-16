<?php

include_once RACINE . "/model/connec.inc.php";

/*
 * Retrieves user data from the database based on email.
 *
 * @param string $mail The email of the user to retrieve.
 * @return array|false An associative array containing user data if found, or false if not found.
 */
function getUserByMail($mail) {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT * FROM kerbleiuser WHERE mail = :mail");
        $req->bindValue(':mail', $mail, PDO::PARAM_STR);
        $req->execute();

        $result = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        throw new Exception("Erreur !: " . $e->getMessage());
    }
    return $result;
}


/**
 * Add a new user to the KerbleiUser table.
 *
 * @param string $mail The email address of the user.
 * @param string $password The password of the user.
 * @param string $name The last name of the user.
 * @param string $firstname The first name of the user.
 * @return bool True if the user was successfully added, false otherwise.
 * @throws Exception If an error occurs during the database operation.
 */
function addUser($mail, $password, $name, $firstname) {
    try {
        $cnx = connexionPDO();
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $query = $cnx->prepare("INSERT INTO kerbleiuser (mail, password, name, firstname) VALUES (:mail, :password, :name, :firstname)");
        $query->bindValue(':mail', htmlspecialchars($mail), PDO::PARAM_STR);
        $query->bindValue(':password', $passwordHash, PDO::PARAM_STR);
        $query->bindValue(':name', htmlspecialchars($name), PDO::PARAM_STR);
        $query->bindValue(':firstname', htmlspecialchars($firstname), PDO::PARAM_STR);
        $result = $query->execute();
    } catch (PDOException $e) {
        throw new Exception("Erreur !: " . $e->getMessage());
    }
    return $result;
}

/**
 * Delete a user from the KerbleiUser table.
 *
 * @param string $mail The email address of the user.
 * @return bool True if the user was successfully deleted, false otherwise.
 * @throws Exception If an error occurs during the database operation.
 */
function deleteUser($accountId) {
    try {
        $cnx = connexionPDO();
        $query = $cnx->prepare("DELETE FROM kerbleiuser WHERE `accountId` = :accountId AND `isAdmin` = 0");
        $query->bindValue(':accountId', $accountId, PDO::PARAM_INT);
        $result = $query->execute();
        // détruit les données associées à la session courante
        session_destroy();
        // detruit les variables de la session
        session_unset();
    } catch (PDOException $e) {
        throw new Exception("Erreur !: " . $e->getMessage());
    }
    return $result;
}


/**
 * Update user information in the database.
 *
 * @param string $mail The email address of the user.
 * @param string $name The new name of the user.
 * @param string $firstname The new firstname of the user.
 * @param string $phone The new phone number of the user.
 * @param string $passwordHash The hashed password of the user.
 * @return bool True if the update was successful, false otherwise.
 */
function updateUser($mail, $name, $firstname, $phone, $password) {
    try {
        $cnx = connexionPDO();
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $query = $cnx->prepare("UPDATE kerbleiuser SET `name` = :name, `firstname` = :firstname, `phone` = :phone, `password` = :password WHERE mail = :mail");
        $query->bindValue(':mail', htmlspecialchars($mail), PDO::PARAM_STR);
        $query->bindValue(':name', htmlspecialchars($name), PDO::PARAM_STR);
        $query->bindValue(':firstname', htmlspecialchars($firstname), PDO::PARAM_STR);
        $query->bindValue(':phone', $phone, PDO::PARAM_STR);
        $query->bindValue(':password', $passwordHash, PDO::PARAM_STR);
        $result = $query->execute();
    } catch (PDOException $e) {
        throw new Exception("Erreur !: " . $e->getMessage());
    }
    return $result;
}
