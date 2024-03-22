<?php

include_once "db.connec.php";

function getUserByMail($mail) {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT * FROM User WHERE mail=:mail AND isAdmin = 0");
        $req->bindValue(':mail', $mail, PDO::PARAM_STR);
        $req->execute();
        
        $resultat = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die( "Erreur !: " . $e->getMessage() );
    }
    return $resultat;
}

// add User
// création de compte pour register
function addUser($mail, $password, $nameFirstname) {
    try {
        $cnx = connexionPDO();
        // Utilisation de password_hash pour hacher le mot de passe de manière sécurisée
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $query = $cnx->prepare("INSERT INTO User (mail, password, nameFirstname) VALUES (:mail, :password, :nameFirstname)");
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
        $query = $cnx->prepare("DELETE FROM User WHERE userId = :userId");
        $query->bindValue(':userId', $userId, PDO::PARAM_INT);
        $result = $query->execute();
    } catch (PDOException $e) {
        die( "Erreur !: " . $e->getMessage() );
    }
    return $result;
}

function login($mail, $password) {
    if (!isset($_SESSION)) {
        session_start();
    }
    $user = getUserbyMail($mail);
    $pwDB = $user["password"];

    if (trim($pwDB) == trim(crypt($pw, $pwDB))) {
        // le mot de passe est celui de l'utilisateur dans la base de donnees
        $_SESSION["mail"] = $mail;
        $_SESSION["password"] = $passwordDB;
    }
}

?>

