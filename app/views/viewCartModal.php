<!-- The Cart Mdal -->
<div id="cartModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content" id="cart">
        <span class="close">&times;</span>
        <!-- title -->
        <h2>Mon panier</h2>
        <!-- vue panier, modif et validation -->
        <table>
            <thead>
                <tr>
                    <th scope="col">Produit</th>
                    <th scope="col">Prix unitaire</th>
                    <th scope="col">Quantité</th>
                    <th scope="col">Sous-total</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <!-- ici je dois construire mon panier en récupérant du json -->
                <!-- <tr>
                    <td id="cart1ProductName"></td>
                    <td id="cart2UnitPrice"></td>
                    <td id="cart3Quantity"></td>
                    <td id="cart4 SubTotal"></td>
                    <td><i onclick="deleteProductInCart (<?php echo $product['productId']; ?>)" class="fa-solid fa-trash"></i></td>
                </tr> -->
                <!-- ici je dois construire mon panier en récupérant du json -->


                <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $productId => $product) { ?>
                        <tr>
                            <td><?= $product['name']; ?></td>
                            <td><?= $product['unitPrice']; ?>&euro;</td>
                            <!-- boutons cartModify -->
                            <td>
                                <input id="<?php echo ('item'.$productId); ?>"
                                    onchange="updateProductInCart (<?php echo $productId; ?>)" 
                                    type="number" size="3"
                                    value="<?= $product['quantity']; ?>" />
                            </td>
                            <td><?= $product['quantity'] * $product['unitPrice']; ?>&euro;</td>
                            <!-- boutons cartDelete -->
                            <td>
                                <i onclick="deleteProductInCart (<?php echo $product['productId']; ?>)" class="fa-solid fa-trash"></i>
                            </td>
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="1">Votre panier est vide.</td>
                    </tr>
                <?php
                }
                ?>


            </tbody>

            <tfoot>
                <tr>
                    <th scope="row" colspan="3">Total</th>
                    <td colspan="1">
                        <?php
                        // Calculer le total du panier
                        $total = 0;
                        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                            foreach ($_SESSION['cart'] as $product) {
                                $total += $product['quantity'] * $product['unitPrice'];
                            }
                        }
                        echo $total . '&euro;';
                        ?>
                    </td>
                </tr>
            </tfoot>

        </table>

        <div id="modalFooter">
            <label for="date">Date de retrait souhaitée :</label>
            <input type="date" id="date">
            <!-- ajouter action valider le panier-->
            <!-- validation de panier possible si utilisateur connecté -->
            <a class="cta-button" title="Cliquez ici pour valider votre commande">Je réserve</a>
        </div>
    </div>

</div>