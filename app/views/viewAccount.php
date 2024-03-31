<?php

// meta description and title
$title = "Micro-Brasserie Kerblei - Mon compte";
$description = "Mon compte Kerblei";
include RACINE . '/views/header.php' ?>

<!-- question : puis-je ajouter ce head? (pour ne pas indexer cette page) -->
<!-- <head>
    <meta name="robots" content="noindex" />
    <meta name="googlebot" content="noindex" />
</head> -->

<!-- --------------------------------------------------------------------------- -->
<h2>Mon compte</h2>


<!-- vue commandes passées et en cours -->
<h2>Mes commandes</h2>
<ul>
    <?php foreach ($orderProducts as $OrderProduct) : ?>
        <li>
            <p><?php echo $orderProduct['quantity']; ?></p>
            <p><?php echo $product['name']; ?></p>
            <p><?php echo $cart['orderDate']; ?></p>
            <p><?php echo $cart['deliveryDate']; ?></p>
            <p><?php echo $cart['statement']; ?></p>

        </li>
    <?php endforeach; ?>
</ul>

<hr>

<!-- modif données perso utilisateur -->
<h2>Modifier mes données personnelles</h2>
<form action="./?action=account" method="POST">

    <label for="name">Mon nom</label>
    <input type="text" name="name" placeholder="Nom" /><br />

    <label for="firstname">Mon prénom</label>
    <input type="text" name="firstname" placeholder="Prénom" /><br />

    <label for="mail">Mon mail</label>
    <input type="text" name="mail" placeholder="Email" /><br />

    <label for="password">Mon nouveau mot de passe</label>
    <input type="password" name="password" placeholder="Mot de passe" /><br />

    <input class="cta-button" type="submit" title="Modification de vos données" value="Je valide ces modifications" />
    <!-- to logout -->
    <a href="./?action=logout" class="cta-button" title="Cliquez ici pour vous déconnecter">Se déconnecter</a>

</form>



<?php include RACINE . "/views/footer.php"; ?>