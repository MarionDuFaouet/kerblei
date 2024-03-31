<?php


$msg = null;

// if the user applying is already logged in
if (isset($_SESSION['mail'])) {
    $msg = 'Vous êtes déjà connecté depuis le compte associé à ce mail "' . $_SESSION['mail'] . '". Merci de vous déconnecter.';
    // $_SESSION['msg'] = ['level' => 'info', 'content' => 'Vous êtes déjà connecté depuis le compte associé à ce mail "' . $_SESSION['mail'] . '". Merci de vous déconnecter.'];
    // $message = ['msg' => 'Vous êtes déjà connecté sur le compte "'.$_SESSION['mail'].'". Déconnectez-vous avant si vous souhaitez ouvrir un autre compte.'];
    require RACINE .  "/views/viewAuthentication.php";
    exit;                           // end of script  
}

//  if not already is logged in
if (!isset($_POST['mail']) || !isset($_POST['password'])) {
    require RACINE .  "/views/viewAuthentication.php";   // stay on the same page
    exit;                               // end of script
}

/* maintenant, soumission du formulaire de connexion */
/* is one of the input fields empty ? */
if (empty($_POST['mail']) || empty($_POST['password'])) {
    $msg = 'Vos mail et mot de passe doivent être renseignés.';
    // $_SESSION['msg'] = ['level' => 'Attention', 'content' => 'Vos mail et mot de passe doivent être renseignés.'];
    require RACINE .  "/views/viewAuthentication.php";
    exit;
}



// require RACINE . "/model/authentication.inc.php";
require RACINE . "/model/db.user.php";
// login($mail, $password);
$user = getUserByMail($_POST['mail']);
if (($user == null) || ($_POST['password'] != $user['password'])) {
    $msg = 'Identifiant ou mot de passe erroné';
    // $_SESSION['msg'] = ['level' => 'Attention', 'content' => 'Identifiant ou mot de passe erroné'];
    require RACINE . "/views/viewAuthentication.php";
    exit;
}

/* successfull login */
$_SESSION['mail'] = $user['mail'];
//$_SESSION['firstname'] = $user['firstname'];
$_SESSION['admin'] = $user['isAdmin'];
// $_SESSION['msg'] = ['level' => 'success', 'content' => 'Salut ' . $user['firstname'] . '! Vous êtes connecté.'];



// ##DEBUG
var_dump($_SESSION);

if ($_SESSION['admin']==0){
    require RACINE . "/views/viewAccount.php";
} else require RACINE . "/views/viewAdmin.php";
//header ("Location: ?action=home");     // login is achieved. Go to the landing page (home)
// require RACINE . "/views/viewAuthentication.php";

