<?php

function connexionPDO() {
        $cnx = new PDO("mysql:host=".$_ENV['DB_HOST'].";dbname=".$_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASS']); 
        // $cnx = new PDO("mysql:host=".$_ENV['DB_HOST'].";dbname=".$_ENV['DB_NAME'], $login, $password);        

        $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $cnx;
}

// pas de try / catch dans ma connexion, parce qu'il est systématique dans mes fonctions du model
?>