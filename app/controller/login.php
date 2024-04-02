<?php

$msg = null;
$products=[];


// user already logged
if (isset($_SESSION['mail'])) {
    $msg = 'Vous êtes déjà connecté au compte associé à ce mail "' . $_SESSION['mail'] . '". Merci de vous déconnecter.';
    require RACINE .  "/views/viewLogin.php";
    exit;  
}

//  if not already logged in
if (!isset($_POST['mail']) || !isset($_POST['password'])) {
    require RACINE .  "/views/viewLogin.php";
    exit;
}

/* empty inputs? */
if (empty($_POST['mail']) || empty($_POST['password'])) {
    $msg = 'Vos mail et mot de passe doivent être renseignés.';
    require RACINE .  "/views/viewLogin.php";
    exit;
}

/* Now, submit login form */
require RACINE . "/model/db.user.php";
// login($mail, $password);
$user = getUserByMail($_POST['mail']);
if (($user == null) || ($_POST['password'] != $user['password'])) {
    $msg = 'Identifiant ou mot de passe erroné';
    require RACINE . "/views/viewLogin.php";
    exit;
}

/* successfull login */
$_SESSION['mail'] = $user['mail'];
$_SESSION['admin'] = $user['isAdmin'];


// ##DEBUG
// var_dump($_SESSION);

if ($_SESSION['admin']==0){
    require RACINE . "/views/viewAccount.php";
// logged Go to home page
} else require RACINE . "/views/viewAdmin.php"; 
// } else require RACINE . "admin.php"; 


// pas au point mon affaire, ça m'envoie encore vers login