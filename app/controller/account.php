<?php

require_once RACINE . "/model/db.product.php";
require_once RACINE . "/model/db.cart.php";

require_once RACINE . "/model/db.user.php";
// obtenir l'identifiant de compte de l'utilisateur authentifié
// rangé dans la session ($accountId)



// Obtenir la liste des commandes
$orderProducts = getCartByAccountId($accountId);

// Inclure la vue du compte client
require_once RACINE . "/views/viewAccount.php";
exit;
?>
