<?php

if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    die('Erreur : ' . basename(__FILE__));
}

require_once RACINE . "/model/db.authentication.php";

// récupération des données GET, POST et SESSION
if (isset($_POST["mail"]) && isset($_POST["password"])) {
    $mail = $_POST["mail"];
    $password = $_POST["password"];
} else {
    $mail = null;
    $password = null;
}

// traitement si nécessaire des données récupérées
login($mail, $password);

if (isLoggedOn()) {
    // Si l'utilisateur est connecté, vérifiez son rôle
    if ($_SESSION["isAdmin"] == 1) {
        // Redirection vers la vue admin si isAdmin est égal à 1
        include RACINE . "/controller/viewAdmin.php";
    } else {
        // Sinon, redirigez vers la vue du panier
        include RACINE . "/controller/viewCart.php";
    }
} else {
    // Si l'utilisateur n'est pas connecté, affichez la vue d'inscription
    include RACINE . "/views/viewRegister.php";
}

?>
