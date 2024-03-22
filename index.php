<?php

// root definition
require __DIR__ . "//app/controller/config.php";

// loading environment variables
use Dotenv\Dotenv;
require __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

require RACINE . "/model/db.connec.php";


require RACINE . "/controller/routes.php";

require_once RACINE . "/model/authentication.php"; 

?>


