<?php


$msg = null;

// if the user applying is already logged in
if (isset($_SESSION['mail'])) {
    $msg = 'Vous êtes déjà connecté depuis le compte associé à ce mail "' . $_SESSION['mail'] . '". Merci de vous déconnecter.';
    require RACINE .  "/views/viewLogin.php";
    exit;                           // end of script  
}

//  if not already is logged in
if (!isset($_POST['mail']) || !isset($_POST['password'])) {
    require RACINE .  "/views/viewLogin.php";   // stay on the same page
    exit;                               // end of script
}

/* maintenant, soumission du formulaire de connexion */
/* is one of the input fields empty ? */
if (empty($_POST['mail']) || empty($_POST['password'])) {
    $msg = 'Vos mail et mot de passe doivent être renseignés.';
    require RACINE .  "/views/viewLogin.php";
    exit;
}



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
var_dump($_SESSION);

if ($_SESSION['admin']==0){
    require RACINE . "/views/viewAccount.php";
} else require RACINE . "/views/viewAdmin.php";
//header ("Location: ?action=home");     // login is achieved. Go to the landing page (home)
// require RACINE . "/views/viewLogin.php";

