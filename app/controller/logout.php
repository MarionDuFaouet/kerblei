<?php

// to be sure there's session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// to logout
function logout() {
    session_unset();
    session_destroy();
    require RACINE . "/views/viewHome.php";
    exit();
}

// calling logout
logout();


