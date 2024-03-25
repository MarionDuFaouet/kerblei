<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    die('Erreur : '.basename(__FILE__));
}

require_once RACINE . "/model/db.product.php";
require_once RACINE . "/model/db.cart.php";


require_once RACINE . 'views/viewAdminCart.php';