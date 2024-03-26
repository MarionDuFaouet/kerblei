<?php

include_once RACINE . "/model/connec.php";


/*
 * Retrieves user data from the database based on email.
 *
 * @param string $mail The email of the user to retrieve.
 * @return array|false An associative array containing user data if found, or false if not found.
 */
function getUserByMail($mail) {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT * FROM KerbleiUser WHERE mail = :mail");        
        $req->bindValue(':mail', $mail, PDO::PARAM_STR);
        $req->execute();
        
        $result = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die( "Erreur !: " . $e->getMessage() );
    }
    return $result;
}

// add User
// création de compte pour register
function addUser($mail, $password, $nameFirstname) {
    try {
        $cnx = connexionPDO();
        // Utilisation de password_hash pour hacher le mot de passe de manière sécurisée
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $query = $cnx->prepare("INSERT INTO KerbleiUser (mail, password, nameFirstname) VALUES (:mail, :password, :nameFirstname)");
        $query->bindValue(':mail', $mail, PDO::PARAM_STR);
        $query->bindValue(':password', $passwordHash, PDO::PARAM_STR);
        $query->bindValue(':nameFirstname', $nameFirstname, PDO::PARAM_STR);
        $result = $query->execute();
    } catch (PDOException $e) {
        die( "Erreur !: " . $e->getMessage() );
    }
    return $result;
}

// delete User
// suppression de compte depuis account
function deleteUser($userId) {
    try {
        $cnx = connexionPDO();
        $query = $cnx->prepare("DELETE FROM KerbleiUser WHERE userId = :userId AND isAdmin = 0");
        $query->bindValue(':userId', $userId, PDO::PARAM_INT);
        $result = $query->execute();
        // détruit les données associées à la session courante
        session_destroy();
        // detruit les variables de la session
        session_unset();
        
    } catch (PDOException $e) {
        die("Erreur !: " . $e->getMessage());
    }
    return $result;
}


?>

