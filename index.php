<?php

// root definition
require __DIR__ . "/app/controller/config.php";

// loading environment variables
use Dotenv\Dotenv;
require __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// database connection file
require RACINE . "/model/db.connec.php";

// routes file
require RACINE . "/controller/routes.php";

//authentication file
require_once RACINE . "/model/authentication.php"; 

// check for the action to perform
if (isset($_GET["action"])) {
	$action = $_GET["action"];
}

// Redirect to the corresponding action
$file = redirectTo($action);
require RACINE . "/controller/" . $file;

?>


