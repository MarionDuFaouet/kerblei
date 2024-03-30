<?php

function connexionPDO() {
        $cnx = new PDO("mysql:host=".$_ENV['DB_HOST'].";dbname=".$_ENV['DB_NAME'], $_ENV['DB_LOGIN'], $_ENV['DB_PASSWORD']); 
        $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $cnx;
}

// pas de try / catch dans ma connexion, parce qu'il est systématique dans mes fonctions du model
?>