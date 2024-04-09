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
                    <th scope="col">gecge</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $productId => $product) { ?>
                        <tr>
                            <td><?= $product['name']; ?></td>
                            <td><?= $product['unitPrice']; ?>&euro;</td>
                            <td>
                                <input type="number" size="3" value="<?= $product['quantity']; ?>" />
                                <!-- ajouter les boutons carModify -->
                            </td>
                            <td><?= $product['quantity'] * $product['unitPrice']; ?>&euro;</td>
                            <!-- ajouter les boutons cartDelete -->
                            <td>
                                <i onclick = "deleteProductInCart (<?php echo $product['productId']; ?>)" class="fa-solid fa-trash"></i>
                            </td>
                        </tr>
                    <?php
                    }
                } else {
                    // Afficher un message si le panier est vide
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
            <a href="?action=order" class="cta-button" title="Cliquez ici pour valider votre commande">Je réserve</a>
        </div>
    </div>

</div>