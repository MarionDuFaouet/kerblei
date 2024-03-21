<?php

include_once "db.connec.php";



?>

- getUser()

Pour le modèle "User", il en manque... Que faire dans le cas d'une inscription ? d'une désinscription ? ... ?


// add User
function addUser($mail, $password, $nameFirstname) {
    try {
        $cnx = connexionPDO();

        $passwordCrypt = crypt($password, "sel");
        $query = $cnx->prepare("insert into User (mail, password, nameFirstname) values(:mail,:password,:nameFirstname)");
        $query->bindValue(':mail', $mail, PDO::PARAM_STR);
        $query->bindValue(':password', $passwordCrypt, PDO::PARAM_STR);
        $query->bindValue(':nameFirstname', $nameFirstname, PDO::PARAM_STR);
        
        $result = $query->execute();
    } catch (PDOException $e) {
        die( "Erreur !: " . $e->getMessage() );
    }
    return $result;
}