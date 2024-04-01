<?php

// to ensure there's session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Fonction de déconnexion
function logout() {
    session_unset();
    session_destroy();
    require RACINE . "/views/viewHome.php";
    exit(); // stop script
}

// calling logout
logout();
//###DEBUG
var_dump($_SESSION);
// pourquoi ma session ne se vide pas alors que la deconnexion fonctionne?


