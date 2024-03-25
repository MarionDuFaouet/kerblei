<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    die('Erreur : '.basename(__FILE__));
}

require_once RACINE . "/views/viewRegister.php";

require_once RACINE . "/model/db.authentication.php";
require_once RACINE . "/model/db.user.php";

// ajouter une vérif , si email déjà existant dans la base, pop up cet email 
// appartient déjà à un compte.
if (isset($_POST["mail"]) && isset($_POST["password"]) && isset($_POST["nameFirstname"])) {

    if ($_POST["mail"] != "" && $_POST["password"] != "" && $_POST["nameFirstname"] != "") {
        $mail = $_POST["mail"];
        $password = $_POST["password"];
        $nameFirstname = $_POST["nameFirstname"];

        // enregistrement des donnees
        $ret = addUser($mail, $password, $nameFirstname);
        if ($ret) {
            $registered = true;
        } else {
            $msg1 = "l'utilisateur n'a pas été enregistré.";
        }
    }
 else {
    $msg1="Renseigner tous les champs...";    
    }
}

if ($registered) {
    // appel du script de vue qui permet de gerer l'affichage des donnees
    $msg2 = "Inscription confirmée";
} else {
    // appel du script de vue qui permet de gerer l'affichage des donnees
    $msg2 = "Inscription pb";
    include RACINE . "/vue/entete.html.php";
    include RACINE . "/vue/vueInscription.php";
    include RACINE . "/vue/pied.html.php";
}

?>