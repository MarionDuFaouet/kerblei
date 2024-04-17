<?php

// meta description and title
$description = "Kerblei Admin.";
$title = "Kerblei Admin";

require_once RACINE . '/views/head.start.php';
?>
<script src="./statics/js/backoffice.js" defer></script>
<?php
require_once RACINE . '/views/head.stop.php';
require_once RACINE . '/views/menu.php';

?>
<!-- ---------------------------------------------------------------------- -->
<div id="backOfficeAdmin">
    <!-- to logout -->
    <a href="./?action=logout" class="cta-button" title="Cliquez ici pour vous déconnecter">Se déconnecter</a>

    <div class="tabs">
        <!-- TAB -->
        <div class="tabsBtnContainer" role="tabList" aria-label="tab component">
            <!-- accessibility -->
            <button class="tab activeTab" role="tab" aria-controls="panel-1" id="tab-1" 
                    type="button" aria-selected="true" tabindex="0">Gestion des commandes
            </button>
            <!-- accessibility -->
            <button class="tab" role="tab" aria-controls="panel-2" id="tab-2" type="button" 
                    aria-selected="false" tabindex="-1">Gestion des produits
            </button>
        </div>

        <!--------------------------- backOffice Order beginning ------------------------------->
        <!-- TAB CONTENT -->
        <!-- accessibility -->
        <div class="tabContent activeTabContent" id="panel-1" role="tabpanel" tabindex="0" aria-labelledby="tab-1">
            <h2>Gestion commandes</h2>
            <p class="msg"><?php echo $msg; ?></p>
            <h2>Nouvelles commandes</h2>
            <table class="adminTable">
                <thead>
                    <tr>
                        <th>Date commande</th>
                        <th>Date retrait</th>
                        <th>Client</th>
                        <th>Contenu</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order) : ?>
                        <?php if ($order['statement'] == 'validée') : ?>
                            <tr>
                                <td><?php echo $order['orderDate']; ?></td>
                                <td><?php echo $order['deliveryDate']; ?></td>
                                <td><?php echo $order['KerbleiUserName'] . ' ' . $order['KerbleiUserFirstname'] . '<br> ' . $order['phone']; ?></td>
                                <td><?php echo $order['productName']; ?></td>
                                <td><?php echo $order['productUnitPrice'] * $order['productQuantity'] . '&#8364;'; ?></td>
                                <td>
                                    <form action="./?action=admin" method="POST">
                                        <input type="hidden" name="cartId" value="<?php echo $order['cartId']; ?>">
                                        <input type="submit" name="updateOrder" value="livrée">
                                    </form>
                                </td>

                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <hr>
            <h2 id="adminTable2">Commandes livrées</h2>
            <table class="adminTable">
                <thead>
                    <tr>
                        <th>Date de retrait</th>
                        <th>Client</th>
                        <th>Contenu</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order) : ?>
                        <?php if ($order['statement'] == 'livrée') : ?>
                            <tr>
                                <td><?php echo $order['deliveryDate']; ?></td>
                                <td><?php echo $order['KerbleiUserName'] . ' ' . $order['KerbleiUserFirstname']; ?></td>
                                <td><?php echo $order['productName']; ?></td>
                                <td><?php echo $order['productUnitPrice'] * $order['productQuantity'] . '&euro;'; ?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>

        <!---------------------------- backOffice Order end ------------------------------>

        <!----------------------------- backOffice Products beginning -------------------------->

        <!-- TAB CONTENT -->
        <!-- accessibility -->
        <div class="tabContent" id="panel-2" role="tabpanel" tabindex="0" aria-labelledby="tab-2">
            <h2>Gestion produits</h2>

            <h2>Ajouter un produit</h2>
            <!-- ADD PRODUCTS -->
            <p class="msg"><?php echo $msg; ?></p>

            <form action="./?action=admin" class="forms" method="POST" enctype="multipart/form-data">
                <label for="name">Nom</label>
                <input type="text" name="name" placeholder="ex : Ambrée">
                <label for="degree">Degrés</label>
                <input type="text" name="degree" placeholder="ex : 6,1">
                <label for="designation">Désignation</label>
                <input type="text" name="designation" placeholder="texte max 50 car.">
                <label for="unitPrice">Prix unitaire</label>
                <input type="text" name="unitPrice" placeholder="00.00">

                <label for="pictureRef">Image</label>
                <input type="file" id="pictureRef" name="pictureRef" accept="image/jpeg" placeholder="monimage.jpg"><br>

                <input class="cta-button" type="submit" name="addProduct" title="Cliquez ici pour ajouter un nouveau produit" value="Ajouter produit">
            </form>
            <!-- -------------------------------------------------------------------------- -->


            <h2>Modifier les produits</h2>
            <!-- SHOW PRODUCTS -->
            <p class="msg"><?php echo $msg; ?></p>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Degrés</th>
                        <th>Description</th>
                        <th>Prix</th>
                        <th>Réf image</th>
                        <th>Select</th>
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
                                <!-- product selection button -->
                                <input type="radio" name="selectedProduct" 
                                    value="<?php echo $product['productId']; ?>" 
                                    onclick="fillForm(<?php echo htmlspecialchars(json_encode($product)); ?>)">
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>


            <!-- MODIFY / DELETE PRODUCT -->

            <!-- <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< -->
            <form action="./?action=admin&updateProduct" class="forms" method="POST">
            <!-- <form action="./?action=admin" class="forms" method="POST"> -->
                <!-- <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< -->

                <!-- selected product ID hidden field -->
                <input type="hidden" name="selectedProductId" id="selectedProductId">
                <!-- Pre-filled modification fields -->
                <label for="productName">Nom</label>
                <input type="text" id="productName" name="productName">
                <label for="productDegre">Degrés</label>
                <input type="text" id="productDegre" name="productDegre">
                <label for="productDescription">Designation</label>
                <input type="text" id="productDescription" name="productDescription">
                <label for="productPrice">Prix unitaire</label>
                <input type="text" id="productPrice" name="productPrice">
                <!-- >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> -->
                <!-- MODIF FORMULAIRE ADMIN PRODUCT??? -->
            <!-- To modify product -->
            <div class="accountAction">
                <input class="cta-button" type="submit" accept="image/jpeg" name="updateProduct" title="Modification de produit" value="Modifier">
            </div>
            </form>
            <!-- to delete product ??? -->
            <div>
                <a href="./?action=admin&deleteProduct" class="cta-button center" title="Suppression de  produit">Supprimer</a>
            </div>
            <!-- >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> -->

                <!-- <div class="accountAction">
                    <input class="cta-button" type="submit" accept="image/jpeg" name="updateProduct" title="Modification de produit" value="Modifier">
                    <input class="cta-button" type="submit" name="deleteProduct" title="Suppression de produit" value="Supprimer">
                </div>
            </form> -->

            

        </div>
        <!----------------------------- backOffice Products end ----------------------------->

    </div>

</div>

<!-- view calling -->
<?php require_once RACINE . '/views/footer.php' ?>