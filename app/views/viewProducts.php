<?php

// meta description and title
$description = "Découvrez notre gamme de bières artisanales.";
$title = "Kerblei - Nos produits";



require_once RACINE . "/views/header.php";
?>
<h2>Nos produits</h2>
<!-- affichage message -->
<p class="msg"><?php echo $msg; ?></p>
<!-- affichage de mes produits -->
<section class="container product">
    <?php foreach ($products as $product) : ?>
        <div class="productShow">
            <img src="./statics/images/<?php echo $product['pictureRef']; ?>" alt="<?php echo $product['name'] ?>">
            <p><?php echo $product['name']; ?></p>
            <p><?php echo $product['degree']; ?>&#37 vol</p>
            <p><?php echo $product['designation']; ?></p>
            <p><?php echo $product['unitPrice']; ?> &#x20AC</p>
            <!-- bouton panier -->
            <!-- j'envoie vers cart ou product??? -->
            <form action="./?action=products" method="POST">
                <button type="submit" class="cta-button" name="addToCart" value="<?php echo $product['productId']; ?>">Ajouter au panier</button>
            </form>


            
        </div>
    <?php endforeach; ?>
    
    

</section>


<?php require_once RACINE . "/views/footer.php"; ?>