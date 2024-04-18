<?php

require_once RACINE . "/model/db.user.php";
$msg = "";

$mail = $_SESSION['mail'];
$user = getUserByMail($mail);
$accountId = $user['accountId'];

// get Orders
require_once RACINE . "/model/db.cart.php";

$orders=array();
$orderHeaders = getOrdersByUser($accountId, '*');   // array of simple orders (just the header: id, order and delivery dates, status)

foreach($orderHeaders as $index => $orderHeader) {
    $order = $orderHeader;
    // get order content
    $orderContent = getOrderFullContent($orderHeader["cartId"]);
    $order['content'] = $orderContent;
    $orders[]=$order;
}

// fill form with account datas
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $_POST["name"] = !isset($_POST["name"]) ? $user['name'] : $_POST["name"];
    $_POST["firstname"] = !isset($_POST["firstname"]) ? $user['firstname'] : $_POST["firstname"];
    $_POST["phone"] = !isset($_POST["phone"]) ? $user['phone'] : $_POST["phone"];
}
if (isset($_GET['update'])) {
    // Update user data
    if (empty($_POST["name"]) || empty($_POST["firstname"])) {
        $msg = "Veuillez remplir tous les champs";
        goto output;
    }
    $name = $_POST["name"];
    $firstname = $_POST["firstname"];
    $phone = !empty($_POST["phone"]) ? $_POST["phone"] : NULL;
    $password = !empty($_POST["password"]) ? password_hash($_POST["password"], PASSWORD_DEFAULT) : NULL;

    updateUser($accountId, $name, $firstname, $phone, $password);

    // delete user data
} elseif (isset($_GET['delete'])) {
    $orders = getOrdersByAccountId($accountId, "*");
    foreach ($orders as $key => $value) {
        updateCartStatement($value['cartId'], "orpheline");
    }

    deleteUser($accountId);
    $msg = 'Compte supprimé'; // N/A
    session_destroy();
    header("Location: ?action=default");
    exit();
} else {
}

output:


// ---------------------------------------------------------------------------------
require_once RACINE . "/views/viewAccount.php";
exit;
