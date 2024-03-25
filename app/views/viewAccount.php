<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    die('Erreur : '.basename(__FILE__));
}

// meta description and title
$title="Micro-Brasserie Kerblei - Mon compte" ;
include RACINE. '/views/header.php' ?>

<!-- question : puis-je ajouter ce head? (pour ne pas indexer cette page) -->
<head>
    <meta name="robots" content="noindex" />
    <meta name="googlebot" content="noindex" />
</head>

<!-- modif données perso utilisateur -->
<h2>Mon compte</h2>
<form action="./?action=account" method="POST">
    
    <label for="nameFirstname">Mon nom et prénom</label>
    <input type="text" name="nameFirstname" placeholder="Nom Prénom" /><br />

    <label for="mail">Mon mail</label>
    <input type="text" name="mail" placeholder="Mon Email" /><br />
    
    <label for="password">J'entre mon mot de passe</label>
    <input type="password" name="password" placeholder="Mon mot de passe"  /><br />
    
    <input class="cta-button" type="submit" title="Modification de vos données" value="Je valide ces modifications"/>
</form>
<br />

<hr>
<!-- vue commandes passées et en cours -->

<ul>
<?php foreach ($orderProducts as $OrderProduct): ?>
        <li>
            <p><?php echo $orderProduct['quantity']; ?></p>
            <p><?php echo $product['name']; ?></p>

            <p><?php echo $cart['orderDate']; ?></p>
            <p><?php echo $cart['deliveryDate']; ?></p>
            <p><?php echo $cart['statement']; ?></p>
            
        </li>
    <?php endforeach; ?>
</ul>

<!-- to logout -->
<a href="./?action=logout">Se déconnecter</a>


<?php include RACINE . "/views/footer.php";?>

    