<?php

// Session beginning
session_start();

// Loading environment variables
use Dotenv\Dotenv;
require __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Root definition
require __DIR__ . "/app/controller/config.php";

// Routes file
require RACINE . "/controller/routes.php";

// Include authentication file
require_once RACINE . "/model/db.authentication.php"; 

// Check for the action to perform
$action = isset($_GET["action"]) ? $_GET["action"] : "default";

// Redirect to the corresponding action
$file = redirectTo($action);
require RACINE . "/controller/" . $file;

?>



