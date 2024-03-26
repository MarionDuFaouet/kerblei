<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    die('Erreur : '.basename(__FILE__));
}

require_once RACINE . "/views/viewRegister.php";

require_once RACINE . "/model/db.authentication.php";
require_once RACINE . "/model/db.user.php";

// ajouter une vérif , si email déjà existant dans la base, pop up cet email 
// appartient déjà à un compte.

$registered = false;
$msg = null;

if (isset($_POST["mail"]) && isset($_POST["password"]) && isset($_POST["nameFirstname"])) {
    if ($_POST["mail"] != "" && $_POST["password"] != "" && $_POST["nameFirstname"] != "") {
        $mail = $_POST["mail"];
        $password = $_POST["password"];
        $nameFirstname = $_POST["nameFirstname"];

        // Vérification de la longueur du mot de passe et des caractères précis (au moins une majuscule et un caractère spécial)
        if (strlen($password) < 8 || strlen($password) > 12) {
            $msg = "Le mot de passe doit contenir entre 8 et 12 caractères.";
        } elseif (!preg_match("/[A-Z]/", $password) || !preg_match("/[!@#$%^&*()\-_=+{};:,<.>]/", $password)) {
            $msg = "Le mot de passe doit contenir au moins une lettre majuscule et un caractère spécial.";
        } else {
            // Enregistrement des données
            $ret = addUser($mail, $password, $nameFirstname);
            if ($ret) {
                $registered = true;
                $msg = "Inscription confirmée";
            } else {
                $msg = "L'utilisateur n'a pas été enregistré.";
            }
        }
    } else {
        $msg = "Renseignez tous les champs...";
    }
}

?>