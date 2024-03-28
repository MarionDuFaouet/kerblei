<?php

// meta description and title
$description = "Découvrez notre gamme de bières artisanales.";
$title = "Kerblei - Nos produits";



require_once RACINE . "/views/header.php";
?>
<h2>Nos produits</h2>
<!-- affichage de mes produits -->
<ul class="container">
<?php foreach ($products as $product): ?>
        <li class="product">
            <img src="./statics/images/<?php echo $product['pictureRef']; ?>" alt="<?php echo $product['name']?>">
            <p><?php echo $product['name']; ?></p>
            <p><?php echo $product['degree']; ?></p>
            <p><?php echo $product['designation']; ?></p>
            <p><?php echo $product['unitPrice']; ?> &#x20AC</p>
            <!-- bouton panier -->
            <button type="submit" class="cta-button" name="addToCart" value="<?php echo $product['productId']; ?>">Ajouter au panier</button>
        </li>
    <?php endforeach; ?>
</ul>

<?php require_once RACINE . "/views/footer.php";?>