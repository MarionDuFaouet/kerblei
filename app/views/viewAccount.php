<?php

// meta description and title
$title = "Kerblei - Mon compte";
$description = "Mon compte Kerblei";

require_once RACINE . '/views/head.start.php';
require_once RACINE . '/views/head.stop.php';
require_once RACINE . '/views/menu.php';
?>
<!-- --------------------------------------------------------------------------- -->

<!-- User Orders -->
<h2>Bienvenue <?php echo ($user['firstname']); ?></h2>

<h2>Mes commandes</h2>
<section class="container">

    <table class="accountTable">
        <thead>
            <tr>
                <th scope="col">Contenu</th>
                <th scope="col">Prix total</th>
                <th scope="col">Date de retrait</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order) : ?>
                <tr>
                    <td><?php echo $order['productName']; ?></td>
                    <td><?php echo $order['productUnitPrice'] * $order['productQuantity'].' &#8364;'; ?></td>
                    <td><?php echo $order['deliveryDate']; ?></td>
                    <td><?php echo $order['statement']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</section>


<hr>
<!-- Users datas -->
<h2>Modifier mes données personnelles</h2>


<p class="msg"><?php echo $msg; ?></p>


<form class="forms" action="./?action=account" method="POST">


    <label for="name">Modifier mon nom</label>
    <input type="text" id="name" name="name" placeholder="mon nom" value="<?php echo isset($_POST['name']) ? ($_POST['name']) : ($user['name'] ?? ''); ?>" maxlength="20">
    <label for="firstname">Modifier mon prénom</label>
    <input type="text" id="firstname" name="firstname" placeholder="mon prénom" value="<?php echo isset($_POST['firstname']) ? ($_POST['firstname']) : ($user['firstname'] ?? ''); ?>" maxlength="20">
    <label for="phone">Modifier mon téléphone</label>
    <input type="tel" id="phone" name="phone" placeholder="01 01 01 01 01" value="<?php echo isset($_POST['phone']) ? ($_POST['phone']) : ($user['phone'] ?? ''); ?>" pattern="[0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2}">
    <label for="password">Modifier mon mot de passe</label>
    <input type="password" id="password" name="password" placeholder="Mot de passe" minlength="8" pattern="(?=.*[!@#$%^&*()\-_=+{};:,<.>])\S+">
    <!-- to modify or delete account -->
    <div class="accountAction">
        <input class="cta-button" name="updateUser" type="submit" title="Modification de vos données" value="Je valide ces modifications">
        <input class="cta-button" name="deleteUser" type="submit" title="Suppression du compte" value="Je supprime mon compte">
    </div>
    <!-- to logout -->
    <a href="./?action=logout" class="cta-button" title="Cliquez ici pour vous déconnecter">Se déconnecter</a>

</form>



<?php include RACINE . "/views/footer.php"; ?>