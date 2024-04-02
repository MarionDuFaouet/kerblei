<?php

// meta description and title
$title = "Micro-Brasserie Kerblei - Mon compte";
$description = "Mon compte Kerblei";
include RACINE . '/views/header.php' ?>


<!-- --------------------------------------------------------------------------- -->
<h2>Mon compte</h2>


<!-- vue commandes passées et en cours -->
<h2>Mes commandes</h2>
<ul>
    <?php foreach ($orderProducts as $OrderProduct) : ?>
        <li>
            <p><?php echo $orderProduct['quantity']; ?></p>
            <p><?php echo $product['name']; ?></p>
            <p><?php echo $cart['orderDate']; ?></p>
            <p><?php echo $cart['deliveryDate']; ?></p>
            <p><?php echo $cart['statement']; ?></p>

        </li>
    <?php endforeach; ?>
</ul>

<hr>

<!-- modif données perso utilisateur -->
<h2>Modifier mes données personnelles</h2>
<!-- ne fonctionne pas pour l'instant, à faire -->
<form class="forms" action="./?action=account" method="POST" onsubmit="return validateForm()">

    <label for="name">Modifier mon nom</label>
    <input type="text" id="name" name="name" placeholder="<?php echo isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name']) : 'Nom'; ?>" required><br />

    <label for="firstname">Modifier mon prénom</label>
    <input type="text" id="firstname" name="firstname" placeholder="<?php echo isset($_SESSION['firstname']) ? htmlspecialchars($_SESSION['firstname']) : 'Prénom'; ?>" required><br />

    <label for="mail">Modifier mon mail</label>
    <input type="email" id="mail" name="mail" placeholder="<?php echo isset($_SESSION['mail']) ? htmlspecialchars($_SESSION['mail']) : 'monmail@exemple.fr'; ?>" required><br />

    <label for="phone">Modifier mon téléphone</label>
    <input type="tel" id="phone" name="phone" placeholder="<?php echo isset($_SESSION['phone']) ? htmlspecialchars($_SESSION['phone']) : '01 01 01 01 01'; ?>" required pattern="[0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2}"><br />

    <label for="password">Modifier mon mot de passe</label>
    <input type="password" id="password" name="password" placeholder="Mot de passe" required minlength="8"><br />

    <input class="cta-button" type="submit" title="Modification de vos données" value="Je valide ces modifications" />
    <button class="cta-button" type="button" onclick="confirmDelete()">Je supprime mon compte</button>
    <p id="deleteConfirmation" style="display: none;">Attention, cette action est irréversible. Confirmez-vous la suppression de votre compte ?</p>

    <!-- to logout -->
    <a href="./?action=logout" class="cta-button" title="Cliquez ici pour vous déconnecter">Se déconnecter</a>

</form>



<?php include RACINE . "/views/footer.php"; ?>