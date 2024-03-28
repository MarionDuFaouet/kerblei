<?php

require RACINE . "/model/db.authentication.php";


// récupération des données GET, POST et SESSION
if (isset($_POST["mail"]) && isset($_POST["password"])) {
    $mail = $_POST["mail"];
    $password = $_POST["password"];


    // je voudrais que ce message ne s'affiche qu'après une tentative de connexion
 //   $msg = "Erreur : Adresse e-mail et/ou mot de passe manquant(s).";
 //   $mail = null;
 //  $password = null;

// traitement si nécessaire des données récupérées
    login($mail, $password);


// <!-- !!! = ne prend pas en compte mon mail dans le session!!! -->

    if (isLoggedOn()) {
        // Si l'utilisateur est connecté, vérifiez son rôle
        if ($_SESSION["isAdmin"] == 1) {
            $message = "Bienvenue Admin";
            include_once RACINE . 'viewAdmin.php';
        } else {
            $message = "Bienvenue Utilisateur";
            // redirection vers page précédente??
            include_once RACINE . '.php';
        }
    }
}
require RACINE . "/views/viewAuthentication.php";
