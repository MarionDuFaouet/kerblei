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
        <!--------------------------- backOffice Order beginning ------------------------------->
        <h2>Gestion commandes</h2>
        <p class="msg"><?php echo $msg; ?></p>
        <h3>Nouvelles commandes</h3>
        

        <h3>Commandes livrées</h3>
      
        <!---------------------------- backOffice Order end ------------------------------>
    </div>





    <!-- TAB CONTENT -->
    <!-- accessibility -->
    <div class="tabContent" id="panel-2" role="tabpanel" tabindex="0" aria-labelledby="tab-2">
        <!----------------------------- backOffice Products beginning -------------------------->
        <h2>Gestion produits</h2>
        <!-- AJOUT DE PRODUITS -->
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
        <p class="msg"><?php echo $msg; ?></p>
        <!-- AFFICHAGE DES PRODUITS -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Degrés</th>
                    <th>Description</th>
                    <th>Prix</th>
                    <th>Référence de l'image</th>
                    <th>Sélectionner</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product) : ?>
                    <tr>
                        <td><?php echo $product['productId']; ?></td>
                        <td><?php echo $product['name']; ?></td>
                        <td><?php echo $product['degree']; ?>&#37 vol</td>
                        <td><?php echo $product['designation']; ?></td>
                        <td><?php echo $product['unitPrice']; ?> €</td>
                        <td><?php echo $product['pictureRef']; ?></td>
                        <td>
                            <!-- Bouton de sélection du produit -->
                            <input type="checkbox"></button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- FORMULAIRE DE MODIFICATION / SUPPRESSION DES PRODUITS -->
        <!-- <form method="post" action="admin.php"> -->
            <!-- Champ caché pour stocker l'ID du produit sélectionné -->
            <!-- <input type="hidden" name="selectedProductId" id="selectedProductId"> -->

            <!-- Champ de modification pré-rempli -->
            <!-- <label for="productName">Nom</label>
            <input type="text" id="productName" name="productName"><br>
            <label for="productDegre">Degrés</label>
            <input type="text" id="productDegre" name="productDegre"><br>
            <label for="productDescription">Designation</label>
            <input type="text" id="productDescription" name="productDescription"><br>
            <label for="productPrice">Prix unitaire</label>
            <input type="text" id="productPrice" name="productPrice"><br>
            <label for="productPictureRef">Image</label>
            <input type="text" id="productPictureRef" name="productPictureRef"><br> -->

            <!-- Boutons d'action -->
            <!-- <button class="cta-button" type="submit" name="updateProduct">Valider les modifications</button>
            <button class="cta-button" type="submit" name="deleteProduct">Supprimer le produit</button>
        </form> -->
        <!----------------------------- backOffice Products end ----------------------------->
    </div>
</div>

<!-- src : youtube/Ecole du web/ coder des onglets en javasccript -->


<!-- view calling -->
<?php require_once RACINE . '/views/footer.php' ?>