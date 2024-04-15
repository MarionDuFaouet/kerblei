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
                    <th class="cartProductName" scope="col">Produits</th>
                    <th class="cartProductUP" scope="col">Prix unitaire</th>
                    <th class="cartProductQuantity" scope="col">Quantité</th>
                    <th class="cartProductSubTotal" scope="col">Sous-total</th>
                    <th class="cartProductTrash" scope="col">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <!-- hidden fake item row that can be duplicated as a template -->
                <tr id="product-0" data-id=0 style="display: none;">
                    <td>Product name</td>
                    <td><span id="cartUnitPrice-0">Unit price</span>&euro;</td>
                    <td >
                        <i onclick="decrProductInCart(this)" class="fa-solid fa-square-minus"></i>
                        <input type="text" id="cartQuantity-0" size=3 maxlength=3 value="0" />
                        <i onclick="incrProductInCart(this)" class="fa-solid fa-square-plus"></i>
                    </td>
                    <td><span id="cartSubTotal-0">0</span>&euro;</td>
                    <td>
                        <i onclick="deleteProductInCart(this)" class="fa-solid fa-trash"></i>
                    </td>
                </tr>

                <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $productId => $product) { ?>
                        <tr id="<?= 'product-'.$productId; ?>" data-id=<?= $productId; ?> >
                            <td><?= $product['name']; ?></td>
                            <td><span id="<?= 'cartUnitPrice-'.$productId; ?>"><?= $product['unitPrice']; ?></span>&euro;</td>
                            <!-- boutons cartModify -->
                            <td>
                                <!-- i onclick="updateProductInCart(<?= $product['productId']; ?>)" class="fa-solid fa-square-minus"></i -->
                                <i onclick="decrProductInCart(this)" class="fa-solid fa-square-minus"></i>
                                <input type="text" id="<?= 'cartQuantity-'.$productId; ?>" size=3 maxlength=3 value="<?= $product['quantity']; ?>" />
                                <i onclick="incrProductInCart(this)" class="fa-solid fa-square-plus"></i>
                            </td>
                            <td>
                                <span id="<?= 'cartSubTotal-'.$productId; ?>"><?= $product['quantity'] * $product['unitPrice']; ?></span>&euro;
                            </td>
                            <!-- boutons cartDelete -->
                            <td>
                                <i onclick="deleteProductInCart(this)" class="fa-solid fa-trash"></i>
                            </td>
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <!-- tr>
                        <td colspan="1">Votre panier est vide.</td>
                    </tr -->
                <?php
                }
                ?>


            </tbody>

            <tfoot>
                <tr>
                    <th scope="row" colspan="3">Total</th>
                    <?php
                        // Calculer le total du panier
                        $total = 0;
                        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                            foreach ($_SESSION['cart'] as $product) {
                                $total += $product['quantity'] * $product['unitPrice'];
                            }
                        }
                    ?>
                    <td colspan="1"><span id="cartTotal"><?= $total ?></span> &euro;</td>
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