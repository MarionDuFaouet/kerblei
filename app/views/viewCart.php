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
        <tbody>
            <tr>
                <th scope="row">blonde</th>
                <td>5 &#x20AC</td>
                <td>curseur quantité</td>
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
                <th scope="row" colspan="3">Date de retrait</th>
                <td colspan="1">curseur date</td>
            </tr>
            <tr>
                <th scope="row" colspan="3"></th>
                <!-- ajouter action -->
                <td colspan="2"><a href="./?action=order" 
                class="cta-button" 
                title="Cliquez ici pour valider votre commande">Je réserve</a> 
</td>
            </tr>
        </tfoot>
    </table>
</section>


<?php
include RACINE . "/views/viewMap.php";
include RACINE . "/views/footer.php";
?>