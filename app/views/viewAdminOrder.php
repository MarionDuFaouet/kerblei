<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    die('Erreur : '.basename(__FILE__));
}

$title="Kerblei Admin Commandes";
include RACINE. '/views/header.php'; ?>
<!-- question : puis-je ajouter ce head? (pour ne pas indexer cette page) -->
<head>
    <meta name="robots" content="noindex" />
    <meta name="googlebot" content="noindex" />
</head>


<!-- tableau de bord commandes -->
<h1>Gestion commandes</h1>

<h2>Nouvelles commandes</h2>
<ul>
<?php foreach ($carts as $cart): ?>
    affichage idOrder, orderDate, deliveryDate, KerbleiUser['name'], produits, prixtotal, checkbox livré
        <li>
            <p><?php echo $orderProduct['quantity']; ?></p>
            <p><?php echo $product['name']; ?></p>

            <p><?php echo $cart['orderDate']; ?></p>
            <p><?php echo $cart['deliveryDate']; ?></p>
            <p><?php echo $cart['statement']; ?></p>
            
        </li>
    <?php endforeach; ?>
</ul>

<h2>Commandes livrées</h2>
<ul>
<?php foreach ($orderProducts as $OrderProduct): ?>
    affichage idOrder, deliveryDate, name, produits, prixtotal
        <li>
            <p><?php echo $orderProduct['quantity']; ?></p>
            <p><?php echo $product['name']; ?></p>

            <p><?php echo $cart['orderDate']; ?></p>
            <p><?php echo $cart['deliveryDate']; ?></p>
            <p><?php echo $cart['statement']; ?></p>
            
        </li>
    <?php endforeach; ?>
</ul>


<!-- redirection vers adminOrder ou adminProduct -->
<a href="./?action=adminProduct" title="Cliquez ici pour gérer votre boutique" class="cta-button">Gestion des produits</a>
<hr>
<a href="./?action=admin" title="Cliquez ici pour retourner au menu principal" class="cta-button">Accueil admin</a>



<?php require_once RACINE. '/views/footer.php'?>
