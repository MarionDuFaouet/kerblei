<?php

require_once RACINE . "/model/db.user.php";
$msg = null;


###DEBUG
// Récupérer les données de l'utilisateur depuis la base de données
// var_dump($mail);

$mail = $_SESSION['mail'];
$user = getUserByMail($mail);
$accountId= $user['accountId'];



// liste des commandes
require_once RACINE . "/model/db.cart.php";

$orders = getOrdersByAccountId($accountId);







// formulaire modif données perso
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (empty($_POST["name"]) && empty($_POST["firstname"]) && empty($_POST["phone"]) && empty($_POST["password"])) {
        if ($user) {
            // Préremplir le formulaire avec les données de l'utilisateur
            $_POST["name"] = $user['name'] ?? '';
            $_POST["firstname"] = $user['firstname'] ?? '';
            $_POST["phone"] = $user['phone'] ?? '';
            $_POST["password"] = $user['password'] ?? '';
        }
    }
}


// Modifications des données
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["updateUser"])) {
    if (isset($_POST["name"]) || isset($_POST["firstname"]) || isset($_POST["phone"]) || isset($_POST["password"])) {
        // Retrieve form data
        $name = $_POST["name"];
        $firstname = $_POST["firstname"];
        $phone = $_POST["phone"];
        $passwordHash = $_POST["password"];

        // Call the model function to update user's data
        updateUser($mail, $name, $firstname, $phone, $passwordHash);
        var_dump(updateUser($mail, $name, $firstname, $phone, $passwordHash));
    }
    // Suppression des données
} elseif ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["deleteUser"])) {
    // faire apparaître un message pour être informer de l'irreversibilité de l'action
    deleteUser($mail);
    // faire apparaître ce message sur home, pendant quelques secondes
    $msg = 'Compte supprimé';
    exit;
}




// Inclure la vue du compte client
require_once RACINE . "/views/viewAccount.php";
exit;
