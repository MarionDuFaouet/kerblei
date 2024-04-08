<!-- The Cart Mdal -->
<div id="cartModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times;</span>
        <!-- title -->
        <h2>Mon panier</h2>
        <!-- vue panier, modif et validation -->
        <table>
            <thead>
                <tr>
                    <th scope="col">Produit</th>
                    <th scope="col">Prix</th>
                    <th scope="col">Quantité</th>
                    <th scope="col">Sous-total</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <?php
                // dump cart from $_SESSION
                //foreach ... ?>
            
                <tbody>
                    <tr>
                        <th scope="row">Kerblei blonde</th>
                        <td>5&euro;</td>
                        <td><input type=number size=3 value="4" />
                        <!-- td><i class="fa-solid fa-minus"> 5 <i class="fa-solid fa-plus"></i></i></td -->
                        <td>20&euro;</td>
                        <td><i class="fa-solid fa-trash"></i></td>
                    </tr>
                </tbody>
            <?php ?>

            <tfoot>
                 <tr>
                    <th scope="row" colspan="3">Total</th>
                    <td colspan="1">20&euro;</td>
                </tr>
                <tr>
                    <th scope="row" colspan="3">Date de retrait</th>
                    <td colspan="1"><input type="date"></td>
                </tr>
                <tr>
                    <th colspan="3"></th>
                    <!-- ajouter action -->
                    <td colspan="2"><a href="?action=order" 
                        class="cta-button" 
                        title="Cliquez ici pour valider votre commande">Je réserve</a> 
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>

</div>

