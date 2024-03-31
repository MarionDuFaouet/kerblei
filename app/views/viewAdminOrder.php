<?php
$title="Kerblei Admin Commandes";
include RACINE. '/views/header.php'; ?>
<!-- question : puis-je ajouter ce head? (pour ne pas indexer cette page) -->
<head>
    <meta name="robots" content="noindex" />
    <meta name="googlebot" content="noindex" />
</head>


<!-- tableau de bord commandes -->
<h1>Gestion commandes</h1>

<h3>Nouvelles commandes</h3>
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

<h3>Commandes livrées</h3>
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

<?php require_once RACINE. '/views/footer.php'?>
