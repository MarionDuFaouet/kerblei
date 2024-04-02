<?php

// Including the user database model file
require RACINE . "/model/db.user.php";

// Initializing variables
$registered = false;
$msg = null;
$erreurs = [];

// Checking if the request method is POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Checking if the required fields are set
    if (isset($_POST["mail"]) && isset($_POST["password"]) && isset($_POST["name"]) && isset($_POST["firstname"])) {

        // Data cleaning
        $mail = htmlspecialchars($_POST["mail"]);
        $password = htmlspecialchars($_POST["password"]);
        $name = htmlspecialchars($_POST["name"]);
        $firstname = htmlspecialchars($_POST["firstname"]);

        // Validating mandatory fields
        if (empty($mail) || empty($password) || empty($name) || empty($firstname)) {
            $erreurs[] = "Veuillez remplir tous les champs.";
        }

        // Validating password length and content
        if (strlen($password) < 8 || !preg_match("/[!@#$%^&*()\-_=+{};:,<.>]/", $password)) {
            $erreurs[] = "Le mot de passe doit comporter au moins 8 caractères dont au moins 1 caractère spécial.";
        }

        // Validating email address
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $erreurs[] = "L'adresse e-mail n'est pas valide.";
        }

        // Checking if the user already exists
        if (getUserByMail($mail) != null) {
            $erreurs[] = "L'utilisateur existe déjà.";
        }

        // Proceeding with registration if there are no errors
        if (empty($erreurs)) {
            // Adding the user
            $ret = addUser($mail, $password, $name, $firstname);
            if ($ret) {
                $registered = true;
                $msg = "Inscription réussie.";
            } else {
                $msg = "L'utilisateur n'a pas pu être enregistré.";
            }
        } else {
            // Displaying errors if any
            foreach ($erreurs as $erreur) {
                $msg .= "<p>$erreur</p>";
            }
        }
    } else {
        $msg = "Veuillez saisir tous les champs.";
    }
}

// Including the registration view file
require RACINE . "/views/viewRegister.php";?>