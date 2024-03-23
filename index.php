<?php

// root definition
require __DIR__ . "/app/controller/config.php";

// loading environment variables
use Dotenv\Dotenv;
require __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Un problème de chemin??? /\ pb linux?
// si je mets un \ avant routes.php l.19, r disparait!!!

// database connection file
require RACINE . "/model/db.connec.php";

// routes file
require RACINE . "/controller/routes.php";

//authentication file
require_once RACINE . "/model/authentication.php"; 

// // check for the action to perform
// if (isset($_GET["action"])) {
// 	$action = $_GET["action"];
// }

// // Redirect to the corresponding action
// $file = redirectTo($action);
// require RACINE . "/controller/" . $file;

// Définir une valeur par défaut pour $action si elle n'est pas définie
$action = isset($_GET["action"]) ? $_GET["action"] : "default";

// Appeler la fonction redirectTo() pour obtenir le nom du fichier à inclure
$file = redirectTo($action);

// Inclure le fichier correspondant depuis le répertoire des contrôleurs
require_once RACINE . "/controller/" . $file;

?>


