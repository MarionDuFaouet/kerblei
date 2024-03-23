<?php

if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    die('Erreur : '.basename(__FILE__));
}

include_once RACINE . "/model/db.connec.php";
include_once RACINE . "/model/db.cart.php";
include_once RACINE . "/model/db.user.php";
include_once RACINE . "/model/db.product.php";
require_once RACINE . "/model/authentication.inc.php";


// recuperation des donnees GET, POST, et SESSION

// appel des fonctions permettant de recuperer les donnees utiles a l'affichage 

// traitement si necessaire des donnees recuperees



?>