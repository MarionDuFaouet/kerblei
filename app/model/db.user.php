<?php

include_once RACINE . "/model/connec.php";

function getUserByMail($mail) {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT * FROM KerbleiUser WHERE mail = :mail");        
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
        // j'ai le droit à ça???
        session_destroy();
        session_unset();
        
    } catch (PDOException $e) {
        die("Erreur !: " . $e->getMessage());
    }
    return $result;
}


?>

