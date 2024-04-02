<?php

function redirectTo($action="default") {
    
    $actions = array();
    $actions["default"] = "home.php";
    $actions["account"] = "account.php";
    $actions["admin"] = "admin.php";
    $actions["login"] = "login.php";
    $actions["logout"] = "logout.php";
    $actions["cart"] = "cart.php";
    $actions["products"] = "products.php";
    $actions["register"] = "register.php";
    $actions["legalNotices"] = "legalNotices.php";


    //### DEBUG 4,5 de test d'existence du fichier de controleur
    // Si le fichier n'existe pas :
    $controller_id = $actions[$action];
    if (!file_exists(__DIR__ . '/' . $controller_id)) {
        // http_response_code(404);
        echo "Le fichier : {$controller_id} n'existe pas !";
    }

    // if "action" exist in ["actions"]
    if (array_key_exists($action, $actions)) {
        return $actions[$action];
    } else {
        return $actions["default"];
    }
}

?>