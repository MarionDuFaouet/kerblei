<?php
include_once RACINE."/model/db.user.php";


// Function to authenticate user based on email and password
function login($mail, $password) {
    // Retrieve user data from database based on email
    $user = getUserByMail($mail);
    // Check if user exists
    if ($user) {
        // Retrieve hashed password from database
        $hashedPasswordDB = $user["password"];
        // Verify provided password against hashed password
        if (password_verify($password, $hashedPasswordDB)) {
            // Passwords match, store email in session
            $_SESSION["mail"] = $mail;
            return true; // Authentication successful
        } else {
            return false; // Incorrect password
        }
    } else {
        return false; // User not found
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