<?php

$msg = null;


// // user already logged
// if (isset($_SESSION['mail'])) {
//     $msg = 'Vous êtes déjà connecté au compte associé à ce mail "' . $_SESSION['mail'] . '". Merci de vous déconnecter.';
//     require RACINE .  "/views/viewLogin.php";
//     exit;  
// }

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
$user = getUserByMail($_POST['mail']);

if (($user == null) || !(password_verify($_POST['password'], $user['password']))) {
    $msg = 'Identifiant ou mot de passe erroné';
    require RACINE . "/views/viewLogin.php";
    exit;
}


/* successfull login */
$_SESSION['mail'] = $user['mail'];
$_SESSION['admin'] = $user['isAdmin'];
$_SESSION['phone'] = $user['phone'];
$_SESSION['name'] = $user['name'];
$_SESSION['firstname'] = $user['firstname'];
$_SESSION['accountId'] = $user['accountId'];


// ##DEBUG
// var_dump($_SESSION);

// when isAdmin and when not
if ($_SESSION['admin'] == 0) {
    header("Location: ./?action=account");
} else {
    header("Location: ./?action=admin");
}

exit;
?>














