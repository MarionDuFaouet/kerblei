<?php
require_once RACINE . "/model/db.product.php";

// to show products in view
$products = getProducts();

require_once RACINE . "/views/viewProducts.php";
