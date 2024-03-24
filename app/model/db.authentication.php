<?php
include_once RACINE."/model/db.user.php";

function login($mail, $password) {
    if (!isset($_SESSION)) {
        session_start();
    }

    $user = getUserByMail($mail);

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["mail"] = $mail;
        // Rediriger l'utilisateur vers une page sécurisée après la connexion
        // proscrire le header et le echo, trouver autre chose
        header("Location: viewCart.php");
        exit;
    } else {
        echo "Identifiants invalides";
    }
}


function logout() {
    if (!isset($_SESSION)) {
        session_start();
    }
    unset($_SESSION["mail"]);
    unset($_SESSION["password"]);
    header("Location: viewHome.php");
    exit;
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
        $user = getUserByMail($_SESSION["mail"]);
        if ($user["mail"] == $_SESSION["mail"] && $user["password"] == $_SESSION["password"]
        ) {
            $stm = true;
        }
    }
    return $stm;
}

?>