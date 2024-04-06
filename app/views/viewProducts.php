<?php

// meta description and title
$description = "Découvrez notre gamme de bières artisanales.";
$title = "Kerblei - Nos produits";

require_once RACINE . "/views/header.php";
?>
<!-- -------------------------------------------------------------------------- -->

<h2>Nos produits</h2>

<header class="container">
    <p>Chers clients, ici vous pouvez réserver vos bières en quelques clic. <br>
        Nous préparons votre commmande et vous venez la récupérer le jour de votre choix à la brasserie.</p>
    <p class="msg">Paiement au retrait.</p>
    <!-- <p class="msg"><?php echo $msg; ?></p> -->

</header>
<!-- ----------------------------------------- -->
<!-- ------------------------------------------- -->
<!-- show products -->
<section class="container">
    <div class="cards">

        <?php foreach ($products as $product) : ?>
            <article class="card">

                <img src="./statics/images/<?php echo $product['pictureRef']; ?>" alt="<?php echo $product['name'] ?>">
                <div class="content">
                    <p><?php echo $product['name']; ?></p>
                    <p><?php echo $product['degree']; ?>&#37 vol</p>
                    <p><?php echo $product['designation']; ?></p>
                    <p><?php echo $product['unitPrice']; ?> </p>
                </div>
                <footer>
                    <!-- bouton panier -->
                    <a href="./?action=cartAdd&id=<?php echo $product['productId']; ?>" class="cta-button" title="Cliquez ici pour créer un compte">Ajouter au panier</a>
                </footer>
            </article>
        <?php endforeach; ?>

    </div>
</section>



<!-- view calling -->
<?php require_once RACINE . "/views/footer.php"; ?>