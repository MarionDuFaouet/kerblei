<!-- A SUPPRIMER?? -->


<?php

// meta description and title
$description = "Découvrez notre gamme de bières artisanales.";
$title = "Micro-Brasserie Kerblei - Panier";

require_once RACINE . '/views/header.php';
?>


<!-- -------------------------------------------------------------------------- -->
<section class="container">
    <h2>Mon panier</h2>
    <p class="msg"><?php echo $msg; ?></p>
    
<!-- ###DEBUG -->


    <!-- vue panier, modif et validation -->
    <!-- afficher les session_cart -->
    <?php foreach ($cartProducts as $cartProduct) : ?>

        <table id="cart">
            <thead>
                <tr>
                    <th scope="col">Produit</th>
                    <th scope="col">Prix</th>
                    <th scope="col">Quantité</th>
                    <th scope="col">Sous-total</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row"><?php echo ($product['name']); ?></th>
                    <td><?php echo ($product['unitPrice']); ?> &#x20AC</td>
                    <td><i class="fa-solid fa-minus"> <?php echo ($product['quantity']); ?> <i class="fa-solid fa-plus"></i></i></td>
                    <td>5 &#x20AC</td> 
                    <td><i class="fa-solid fa-trash"></i></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th scope="row" colspan="3">TOTAL</th>
                    <td colspan="1">77 &#x20AC</td>
                </tr>
                <tr>
                    <td colspan="5">Date de retrait <input type="date"></td>
                </tr>
                <tr>
                    <!-- ajouter action -->
                    <td colspan="5"><a href="./?action=order" class="cta-button" title="Cliquez ici pour valider votre commande">Je réserve</a>
                    </td>
                </tr>
            </tfoot>
        </table>
    <?php endforeach; ?>

</section>


<?php
include RACINE . "/views/viewMap.php";
include RACINE . "/views/footer.php";
?>