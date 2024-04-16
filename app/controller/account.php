<?php

require_once RACINE . "/model/db.user.php";
$msg = null;

$mail = $_SESSION['mail'];
$user = getUserByMail($mail);
$accountId= $user['accountId'];
// -----------------------------------------------------------------------------

// get Orders
require_once RACINE . "/model/db.cart.php";
$orders = getOrdersByAccountId($accountId, '*');

// fill form with account datas
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (empty($_POST["name"]) && empty($_POST["firstname"]) && empty($_POST["phone"]) && empty($_POST["password"])) {
        if ($user) {
            $_POST["name"] = $user['name'] ?? '';
            $_POST["firstname"] = $user['firstname'] ?? '';
            $_POST["phone"] = $user['phone'] ?? '';
            $_POST["password"] = $user['password'] ?? '';
        }
    }
}

// Update user datas
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["updateUser"])) {
    if (isset($_POST["name"]) || isset($_POST["firstname"]) || isset($_POST["phone"]) || isset($_POST["password"])) {
        $name = $_POST["name"];
        $firstname = $_POST["firstname"];
        $phone = $_POST["phone"];
        $passwordHash = $_POST["password"];

        updateUser($mail, $name, $firstname, $phone, $passwordHash);
    }
    // delete user data
} elseif ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["deleteUser"])) {
    deleteUser($accountId);
    $msg = 'Compte supprimé';
    
}


// ---------------------------------------------------------------------------------
require_once RACINE . "/views/viewAccount.php";
exit;
