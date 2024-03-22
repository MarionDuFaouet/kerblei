<?php

function redirectTo($action="default") {
	
    $actions = array();
    $actions["default"] = "home.php";
    $actions["account"] = "account.php";
    $actions["adminCart"] = "adminCart.php";
    $actions["adminProduct"] = "adminProduct.php";
    $actions["authentication"] = "authentication.php";
    $actions["cart"] = "cart.php";
    $actions["products"] = "products.php";
    $actions["register"] = "register.php";
    $actions["legalNotices"] = "legalNotices.php";

	$controler_id = $actions[$action];

	//si le fichier n'existe pas :
	if(! file_exists(__DIR__ . '/'. $controller_id) ) die("Le fichier : " . $controller_id . " n'existe pas !");

	//si la clé "action" existe dans notre tableau "lesActions" :
    if (array_key_exists($action, $actions)) {
		// le fichier à inclure sera retourné :
        return $controller_id;
    } else {
        return $actions["default"];
    }
}

?>