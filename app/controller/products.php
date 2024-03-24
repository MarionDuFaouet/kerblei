<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    die('Erreur : '.basename(__FILE__));
}

require_once RACINE . "/model/db.product.php";

$products = getProducts();

require_once RACINE . "/views/viewProducts.php";
?>