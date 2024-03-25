<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    die('Erreur : '.basename(__FILE__));
}

require_once RACINE . "/views/viewRegister.php";

require_once RACINE . "/model/db.authentication.php";

// ajouter une vérif , si email déjà existant dans la base, pop up cet email 
// appartient déjà à un compte.
?>