<?php

// chargement des variables d'environnement
use DOTENV\Dotenv;
require __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();
require RACINE . "/model/db.connec.php";



// root definition
require dirname(__FILE__) . "/controller/config.php";

require RACINE . "/controller/routes.php";

require_once RACINE . "/model/authentication.inc.php"; 

?>


