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
        Nous préparons votre commmande et vous la livrons le samedi de votre choix au marché de Baden.</p>
    <p class="msg">Paiement sur place à la récupération de votre commande.</p>

</header>

<!-- show products -->
<section class="container product">
    <?php foreach ($products as $product) : ?>
        <div class="productShow">

            <form action="./?action=products" method="POST">

                <img src="./statics/images/<?php echo $product['pictureRef']; ?>" alt="<?php echo $product['name'] ?>">
                <p><?php echo $product['name']; ?></p>
                <p><?php echo $product['degree']; ?>&#37 vol</p>
                <p><?php echo $product['designation']; ?></p>
                <p><?php echo $product['unitPrice']; ?> &#x20AC</p>
                <!-- Champ de formulaire caché pour productId -->
                <!-- <input type="hidden" name="productId" value="<?php echo $product['productId']; ?>"> -->
                <!-- ###DEBUG -->
                <p><?php echo $product['productId']; ?></p>
                <p class="msg"><?php echo $msg; ?></p>

                <!-- bouton panier -->
                <button type="submit" class="cta-button" name="addToCart" value="<?php echo $product['productId']; ?>">Ajouter au panier</button>
            
            </form>

        </div>

    <?php endforeach; ?>

</section>



<!-- view calling -->
<?php require_once RACINE . "/views/footer.php"; ?>