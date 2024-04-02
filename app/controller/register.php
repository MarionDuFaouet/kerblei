<?php

require RACINE . "/model/db.user.php";


$registered = false;
$msg = null;

if (isset($_POST["mail"]) && isset($_POST["password"]) && isset($_POST["name"])&& isset($_POST["firstname"])) {
 
    if ($_POST["mail"] != "" && $_POST["password"] != "" && $_POST["name"] != "" && $_POST["firstname"] != "") {
        $mail = $_POST["mail"];
        $password = $_POST["password"];
        $name = $_POST["name"];
        $firstname = $_POST["firstname"];

        // Vérification de la longueur du mot de passe et des caractères précis (au moins une majuscule et un caractère spécial)
        if (strlen($password) < 8 || !preg_match("/[!@#$%^&*()\-_=+{};:,<.>]/", $password)) {
            $msg = "Le mot de passe doit contenir au moins 8 caractères dont 1 caractère spécial.";
        } else {
            if (getUserByMail($mail) != null) $msg = "L'utilisateur existe déjà.";
            else{
                // register user data
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