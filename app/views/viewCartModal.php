<div id="cartModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content" id="cart">
        <span class="close">&times;</span>
        <!-- title -->
        <h2>Mon panier</h2>
        <!-- show cart, modify and validate -->
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
                    <td>
                        <i onclick="decrProductInCart(this)" class="fa-solid fa-square-minus"></i>
                        <input type="text" id="cartQuantity-0" size=3 maxlength=3 value="0" />
                        <i onclick="incrProductInCart(this)" class="fa-solid fa-square-plus"></i>
                    </td>
                    <td><span id="cartSubTotal-0">0</span>&euro;</td>
                    <td>
                        <i onclick="deleteProductInCart(this)" class="fa-solid fa-trash"></i>
                    </td>
                </tr>

                <?php if (isset($_SESSION['cart']['products']) && !empty($_SESSION['cart']['products'])) {
                    foreach ($_SESSION['cart']['products'] as $productId => $product) { ?>
                        <tr id="<?= 'product-' . $productId; ?>" data-id=<?= $productId; ?>>
                            <td><?= $product['name']; ?></td>
                            <td><span id="<?= 'cartUnitPrice-' . $productId; ?>"><?= $product['unitPrice']; ?></span>&euro;</td>
                            <!-- boutons cartModify -->
                            <td>
                                <i onclick="decrProductInCart(this)" class="fa-solid fa-square-minus"></i>
                                <input type="text" id="<?= 'cartQuantity-' . $productId; ?>" size=3 maxlength=3 value="<?= $product['quantity']; ?>" />
                                <i onclick="incrProductInCart(this)" class="fa-solid fa-square-plus"></i>
                            </td>
                            <td>
                                <span id="<?= 'cartSubTotal-' . $productId; ?>"><?= $product['quantity'] * $product['unitPrice']; ?></span>&euro;
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
                <?php
                }
                ?>


            </tbody>

            <tfoot>
                <tr>
                    <th scope="row" colspan="3">Total</th>
                    <?php
                    // Calculate total
                    $total = 0;
                    if (isset($_SESSION['cart']) && !empty($_SESSION['cart']['products'])) {
                        foreach ($_SESSION['cart']['products'] as $product) {
                            $total += $product['quantity'] * $product['unitPrice'];
                        }
                    }
                    ?>
                    <td colspan="1"><span id="cartTotal"><?= $total ?></span> &euro;</td>
                </tr>
            </tfoot>

        </table>

        <div id="modalFooter">
            <p id="cartMessage" class="msg"><?php if (isset($_SESSION['cart']['message'])) echo $_SESSION['cart']['message']; ?></p>
            <label for="date">Date de retrait souhaitée :</label>
            <input id="cartDate" type="date" name="cartDate" required />
            <a class="cta-button" onclick="validateCart()" title="Cliquez ici pour valider votre commande">Je réserve</a>
        </div>
    </div>

</div>