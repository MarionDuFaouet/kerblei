<?php

$msg = null;

// Il faudrait que quand on arrive sur cette page et que le panier est vide, 
$msg = 'Votre panier est vide';

//sinon, affichage panier



// ##DEBUG
// var_dump($_SESSION['cart']);


require_once RACINE . "/views/viewCart.php";


// // si je veux interdire l'accès à une page à l'admin
// if (!((isset($_SESSION['admin'])) && $_SESSION['admin'])) {
//     $msg="You must be an administrator to reach this page;
// }