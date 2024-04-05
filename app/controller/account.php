<?php

// require_once RACINE . "/model/db.product.php";
// require_once RACINE . "/model/db.cart.php";
// obtenir l'identifiant de compte de l'utilisateur authentifié



require_once RACINE . "/model/db.user.php";
$msg = null;

// Récupérer les données de l'utilisateur depuis la base de données
// $user = getUser();
$mail = $_SESSION['mail'];
###DEBUG
var_dump($mail);
$user = getUserByMail($mail);



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
// comment gérer le mail de l'utilisateur nécéssaire à la fonction? En hiden?
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

// Obtenir la liste des commandes
// $orderProducts = getCartByAccountId($accountId);

// Inclure la vue du compte client
require_once RACINE . "/views/viewAccount.php";
exit;
