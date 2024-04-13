<?php

require RACINE . "/model/db.user.php";

$registered = false;
$msg = null;
$erreurs = [];


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["mail"]) && isset($_POST["password"]) && isset($_POST["name"]) && isset($_POST["firstname"])) {

        $mail = $_POST["mail"];
        $password = $_POST["password"];
        $name = htmlspecialchars($_POST["name"]);
        $firstname = htmlspecialchars($_POST["firstname"]);

        if (empty($mail) || empty($password) || empty($name) || empty($firstname)) {
            $erreurs[] = "Veuillez remplir tous les champs.";
        }

        if (strlen($password) < 8 || !preg_match("/[!@#$%^&*()\-_=+{};:,<.>]/", $password)) {
            $erreurs[] = "Le mot de passe doit comporter au moins 8 caractères dont au moins 1 caractère spécial.";
        }

        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $erreurs[] = "L'adresse e-mail n'est pas valide.";
        }

        if (getUserByMail($mail) != null) {
            $erreurs[] = "L'utilisateur existe déjà.";
        }

        if (empty($erreurs)) {
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

require RACINE . "/views/viewRegister.php";
