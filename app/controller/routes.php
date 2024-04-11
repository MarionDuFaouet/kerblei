<?php

function redirectTo($action="default") {
    
    $actions = array();
    $actions["default"] = "home.php";
    $actions["account"] = "account.php";
    $actions["admin"] = "admin.php";
    $actions["login"] = "login.php";
    $actions["logout"] = "logout.php";
    $actions["cartAdd"] = "cartAdd.php";
    $actions["cartUpdate"] = "cartUpdate.php";
    $actions["cartDelete"] = "cartDelete.php";
    $actions["products"] = "products.php";
    $actions["register"] = "register.php";
    $actions["legalNotices"] = "legalNotices.php";
    $actions["map"] = "map.php";

    
    $controller_id = $actions[$action];
    if (!file_exists(__DIR__ . '/' . $controller_id)) {
        http_response_code(404);
        echo "Le fichier : {$controller_id} n'existe pas !";
        
    }

    if (array_key_exists($action, $actions)) {
        return $actions[$action];
    } else {
        return $actions["default"];
    }
}

?>