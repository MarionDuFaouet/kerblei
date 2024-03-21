<?php
include_once RACINE."model/db.connec.php";

function login($mail, $pw) {
    if (!isset($_SESSION)) {
        session_start();
    }

    $user = getUserByMail($mail);
    $pwDB = $user["pw"];

    if (trim($pwDB) == trim(crypt($pw, $pwDB))) {
        // le mot de passe est celui de l'utilisateur dans la base de donnees
        $_SESSION["mail"] = $mail;
        $_SESSION["pw"] = $pwDB;
    }
}

function logout() {
    if (!isset($_SESSION)) {
        session_start();
    }
    unset($_SESSION["mail"]);
    unset($_SESSION["pw"]);
}

function getMailLoggedOn(){
    if (isLoggedOn()){
        $stm = $_SESSION["mail"];
    }
    else {
        $stm = null;
    }
    return $stm;
        
}

function isLoggedOn() {
    if (!isset($_SESSION)) {
        session_start();
    }
    $stm = false;

    if (isset($_SESSION["mail"])) {
        $user = getUserByMailU($_SESSION["mail"]);
        if ($user["mail"] == $_SESSION["mail"] && $user["pw"] == $_SESSION["pw"]
        ) {
            $stm = true;
        }
    }
    return $stm;
}

if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    // prog principal de test
    header('Content-Type:text/plain');

    // deconnexion
    logout();
}
?>