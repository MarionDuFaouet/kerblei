<?php

if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    die('Erreur : '.basename(__FILE__));
}

include_once RACINE . "/modele/db.connec.php";
include_once RACINE . "/modele/db.cart.php";
include_once RACINE . "/modele/db.user.php";
include_once RACINE . "/modele/db.product.php";
require_once RACINE . "/modele/authentification.inc.php";


// recuperation des donnees GET, POST, et SESSION
$idR = $_GET["idR"];
// appel des fonctions permettant de recuperer les donnees utiles a l'affichage 

// traitement si necessaire des donnees recuperees



?>