<?php


// Je dois juste récupérer la valeur numéraire de nouvelle quantité
// et mettre à jour la quantité d'un produit dans la session



$newQuantity = isset($_GET["quantity"]) ? intval($_GET["quantity"]) : 0;

if (isset($_GET["quantity"])) {
    $_SESSION['cart'][$idProduct]['quantity'] = $newQuantity;
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($_SESSION['cart']);

exit;