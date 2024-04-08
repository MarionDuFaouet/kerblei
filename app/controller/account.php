<?php

require_once RACINE . "/model/db.user.php";
$msg = null;


$mail = $_SESSION['mail'];
###DEBUG
// Récupérer les données de l'utilisateur depuis la base de données
// var_dump($mail);
$user = getUserByMail($mail);



// Obtenir la liste des commandes
require_once RACINE . "/model/db.cart.php";
$accountId= $user['accountId'];
###DEBUG
// var_dump($accountId);
$orders = getCartByAccountId($accountId);


// Préremplir le formulaire si les champs sont vides et si l'utilisateur existe dans la base de données
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
