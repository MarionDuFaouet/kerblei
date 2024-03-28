<?php

require RACINE . "/model/db.authentication.php";
//require RACINE . "/model/db.user.php";

// ajouter une vérif , si email déjà existant dans la base, pop up cet email 
// appartient déjà à un compte.

$registered = false;
$msg = null;

if (isset($_POST["mail"]) && isset($_POST["password"]) && isset($_POST["name"])&& isset($_POST["firstname"])&& isset($_POST["phone"])) {
    var_dump($_POST);
 
    if ($_POST["mail"] != "" && $_POST["password"] != "" && $_POST["name"] != "" && $_POST["firstname"] != "" && $_POST["phone"] != "") {
        $mail = $_POST["mail"];
        $password = $_POST["password"];
        $name = $_POST["name"];
        $firstname = $_POST["firstname"];
        $phone = $_POST["phone"];

        // Vérification de la longueur du mot de passe et des caractères précis (au moins une majuscule et un caractère spécial)
        if (strlen($password) < 8 || strlen($password) > 12) {
            $msg = "Le mot de passe doit contenir entre 8 et 12 caractères.";
        } else if (!preg_match("/[A-Z]/", $password) || !preg_match("/[!@#$%^&*()\-_=+{};:,<.>]/", $password)) {
            $msg = "Le mot de passe doit contenir au moins une lettre majuscule et un caractère spécial.";
        } else {
            if (getUserByMail($mail) != null) $msg = "L'utilisateur existe déjà.";
            else{
                // Enregistrement des données
                $ret = addUser($mail, $password, $name, $firstname, $phone);
                if ($ret) {
                    $registered = true;
                    $msg = "Inscription confirmée";
                } else {
                    $msg = "L'utilisateur n'a pas été enregistré.";
                }
            }
        }
    } else {
        $msg = "Renseignez tous les champs...";
    }
}
require RACINE . "/views/viewRegister.php";
?>