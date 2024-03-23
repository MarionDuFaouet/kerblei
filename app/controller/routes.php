<?php

function redirectTo($action="default") {
    
    $actions = array();
    $actions["default"] = "home.php";
    $actions["account"] = "account.php";
    $actions["adminCart"] = "adminCart.php";
    $actions["adminProduct"] = "adminProduct.php";
    $actions["authentication"] = "authentication.php";
    $actions["logout"] = "logout.php";
    $actions["cart"] = "cart.php";
    $actions["products"] = "products.php";
    $actions["register"] = "register.php";
    $actions["map"] = "./views/map.php";
    $actions["legalNotices"] = "legalNotices.php";

    $controller_id = $actions[$action];

    // Si le fichier n'existe pas :
    if (!file_exists(__DIR__ . '/' . $controller_id)) {
        die("Le fichier : " . $controller_id . " n'existe pas !");
    }

    // Si la clé "action" existe dans notre tableau "lesActions" :
    if (array_key_exists($action, $actions)) {
        // Le fichier à inclure sera retourné :
        return $controller_id;
    } else {
        return $actions["default"];
    }
}

?>