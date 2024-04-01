<?php

// meta description and title
$description = "Bienvenue Kerblei Admin.";
$title = "Kerblei Admin";
// view calling
include RACINE . '/views/header.php' ?>

<!-- question : puis-je ajouter ce head? (pour ne pas indexer cette page) -->
<!-- <head>
    <meta name="robots" content="noindex" />
    <meta name="googlebot" content="noindex" />
</head> -->
<!-- ---------------------------------------------------------------------- -->


<!-- puis-je faire des button href ou action, ou mes routeurs seront appelés comment? -->
<div class="tabs">
    <!-- TAB -->
    <div class="tabsBtnContainer" role="tabList" aria-label="tab component">
        <!-- accessibility -->
        <button class="tab activeTab" role="tab" aria-controls="panel-1" id="tab-1" type="button" aria-selected="true" tabindex="0">Gestion des commandes🛒</button>
        <!-- accessibility -->
        <button class="tab" role="tab" aria-controls="panel-2" id="tab-2" type="button" aria-selected="false" tabindex="-1">Gestion des produits🧴</button>
    </div>

    <!-- TAB CONTENT -->
    <!-- accessibility -->
    <div class="tabContent activeTabContent" id="panel-1" role="tabpanel" tabindex="0" aria-labelledby="tab-1">
        <!--------------------------- backOffice Order début------------------------------->
        <h2>Gestion commandes</h2>
        <p><?php echo $msg; ?></p>
        <h3>Nouvelles commandes</h3>
        <ul>
            <?php foreach ($carts as $cart) : ?>
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
            <?php foreach ($orderProducts as $OrderProduct) : ?>
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
        <!---------------------------- backOffice Order fin------------------------------>
    </div>





    <!-- TAB CONTENT -->
    <!-- accessibility -->
    <div class="tabContent" id="panel-2" role="tabpanel" tabindex="0" aria-labelledby="tab-2">
        <!----------------------------- backOffice Products début-------------------------->
        <h2>Gestion produits</h2>



        <h2>Ajouter un produit</h2>
        <p class="msg"><?php echo $msg; ?></p>
        <form action="./?action=admin" method="POST">

            <label for="name">Nom</label>
            <input type="text" name="name" placeholder="ex : Ambrée" /><br />

            <label for="degree">Degrés</label>
            <input type="text" name="degree" placeholder="ex : 6,1" /><br />
            
            <label for="designation">Désignation</label>
            <input type="text" name="designation" placeholder="texte max 50 car." /><br />

            <label for="unitPrice">Prix unitaire</label>
            <input type="text" name="unitPrice" placeholder="00.00 euros" /><br />

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
        <!----------------------------- backOffice Products fin----------------------------->
    </div>
</div>

<!-- src : youtube/Ecole du web/ coder des onglets en javasccript -->













<!-- view calling -->
<?php require_once RACINE . '/views/footer.php' ?>