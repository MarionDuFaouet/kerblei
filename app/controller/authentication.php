<?php

if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    die('Erreur : '.basename(__FILE__));
}

require_once RACINE . "/model/db.authentication.php";

// recuperation des donnees GET, POST, et SESSION
if (isset($_POST["mail"]) && isset($_POST["password"])){
    $mail=$_POST["mail"];
    $password=$_POST["password"];
}
else
{
    $mail=null;
    $password=null;
}

// traitement si necessaire des donnees recuperees
login($mail,$password);

if (isLoggedOn()){ // si l'utilisateur est connecté on redirige vers le controleur monProfil
    include RACINE . "/app/controller/viewCart.php";
}
else{ 
    include RACINE . "app/views/viewRegister.php";
}

?>