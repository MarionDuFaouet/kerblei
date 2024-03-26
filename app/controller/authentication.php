<?php

if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    die('Erreur : ' . basename(__FILE__));
}

require_once RACINE . "/model/db.authentication.php";
require_once RACINE . "/views/viewAuthentication.php";



// récupération des données GET, POST et SESSION
if (isset($_POST["mail"]) && isset($_POST["password"])) {
    $mail = $_POST["mail"];
    $password = $_POST["password"];
} else {
    echo "Erreur : Adresse e-mail et/ou mot de passe manquant(s).";
    $mail = null;
    $password = null;
}

// traitement si nécessaire des données récupérées
login($mail, $password);

if (isLoggedOn()) {
    // Si l'utilisateur est connecté, vérifiez son rôle
    if ($_SESSION["isAdmin"] == 1) {
        $message = "Bienvenue, admin!";
    } else {
        $message = "Bienvenue, utilisateur!";
    }
}