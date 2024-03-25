<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    die('Erreur : ' . basename(__FILE__));
}

$title = "Kerblei Admin Produits";
include RACINE . '/views/header.php'; ?>
<!-- question : puis-je ajouter ce head? (pour ne pas indexer cette page) -->

<head>
    <meta name="robots" content="noindex" />
    <meta name="googlebot" content="noindex" />
</head>


<!-- crud produits -->
<h1>Gestion produits</h1>

<h2>Ajouter un produit</h2>
<form action="./?action=product" method="POST">

    <label for="name">Nom</label>
    <input type="text" name="name" placeholder="ex : Ambrée 6,1 %.vol" /><br />

    <label for="designation">Désignation</label>
    <input type="text" name="designation" placeholder="texte max 50 car." /><br />

    <label for="price">Prix unitaire</label>
    <input type="text" name="price" placeholder="00.00" /><br />

    <label for="img">Image</label>
    <input type="text" name="img" placeholder="monimage.jpg" /><br />

    <input class="cta-button" type="submit" title="Cliquez ici pour ajouter un nouveau produit" value="Ajouter produit" />

</form>

<h2>Modifier les produits</h2>


<!-- comment combiner ces deux approches? -->
<div id="productBoard">
    <form method="post" action="traitement.php">
        <ul>
            <?php foreach ($products as $product) : ?>
                <li>
                    <img src="./statics/images/<?php echo $product['pictureRef']; ?>" alt="Bières Kerblei">
                    <p><?php echo $product['productId']; ?></p>
                    <p><?php echo $product['name']; ?></p>
                    <p><?php echo $product['designation']; ?></p>
                    <p><?php echo $product['unitPrice']; ?> &#x20AC</p>
                    <!-- bouton supprimer -->
                    <button type="submit" class="cta-button" name="deleteProduct" value="<?php echo $product['productId']; ?>">Supprimer</button>
                    <!-- bouton modifier -->
                    <button type="submit" class="cta-button" name="updateProduct" value="<?php echo $product['productId']; ?>">Enregistrer les modifications</button>
                </li>
            <?php endforeach; ?>
        </ul>
    </form>

    <form action="./?action=updateProduct" method="post">
        <label for="productId">Identifiant produit</label>
        <input type="text" name="productId" value="<?php echo $product['productId']; ?>">

        <!-- Champ pour le nom du produit -->
        <label for="name">Nom du produit:</label>
        <input type="text" name="name" id="name" value="<?php echo $product['name']; ?>">

        <!-- Champ pour la désignation du produit -->
        <label for="designation">Désignation:</label>
        <input type="text" name="designation" id="designation" value="<?php echo $product['designation']; ?>">

        <!-- Champ pour le prix unitaire du produit -->
        <label for="unitPrice">Prix unitaire:</label>
        <input type="text" name="unitPrice" id="unitPrice" value="<?php echo $product['unitPrice']; ?>">

        <!-- Champ pour la référence de l'image du produit -->
        <label for="pictureRef">Référence de l'image:</label>
        <input type="text" name="pictureRef" id="pictureRef" value="<?php echo $product['pictureRef']; ?>">

        <!-- Bouton pour soumettre le formulaire -->
        <button type="submit" name="updateProduct">Enregistrer les modifications</button>
    </form>



</div>


<!-- redirection vers adminOrder ou adminProduct -->
<a href="./?action=adminOrder" title="Cliquez ici pour gérer vos commandes" class="cta-button">Gestion des commandes</a>
<hr>
<a href="./?action=admin" title="Cliquez ici pour retourner au menu principal" class="cta-button">Accueil admin</a>

<?php require_once RACINE . '/views/footer.php' ?>