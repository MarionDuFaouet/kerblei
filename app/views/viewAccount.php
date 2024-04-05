<?php

// meta description and title
$title = "Micro-Brasserie Kerblei - Mon compte";
$description = "Mon compte Kerblei";
include RACINE . '/views/header.php' ?>


<!-- --------------------------------------------------------------------------- -->
<h2>Mon compte</h2>


<!-- vue commandes passées et en cours -->
<h2>Mes commandes</h2>


<hr>

<h2>Modifier mes données personnelles</h2>


<p class="msg"><?php echo $msg; ?></p>


<form class="forms" action="./?action=account" method="POST">
    

    <label for="name">Modifier mon nom</label>
    <input type="text" id="name" name="name" placeholder="mon nom" 
    value="<?php echo isset($_POST['name']) ? ($_POST['name']) : ($user['name'] ?? ''); ?>" 
    required maxlength="20"><br />
    
    <label for="firstname">Modifier mon prénom</label>
    <input type="text" id="firstname" name="firstname" placeholder="mon prénom" 
    value="<?php echo isset($_POST['firstname']) ? ($_POST['firstname']) : ($user['firstname'] ?? ''); ?>" 
    required maxlength="20"><br />
    
    <label for="phone">Modifier mon téléphone</label>
    <input type="tel" id="phone" name="phone" placeholder="01 01 01 01 01" 
    value="<?php echo isset($_POST['phone']) ? ($_POST['phone']) : ($user['phone'] ?? ''); ?>" 
    required pattern="[0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2}"><br />
    
    <label for="password">Modifier mon mot de passe</label>
    <input type="password" id="password" name="password" placeholder="Mot de passe" 
    required minlength="8" pattern="(?=.*[!@#$%^&*()\-_=+{};:,<.>])\S+"><br />

    <!-- to modify or delete account -->
    <input class="cta-button" name="updateUser" type="submit" title="Modification de vos données" value="Je valide ces modifications" />
    <input class="cta-button" name="deleteUser" type="submit" title="Suppression du compte" value="Je supprime mon compte" />
    <!-- to logout -->
    <a href="./?action=logout" class="cta-button" title="Cliquez ici pour vous déconnecter">Se déconnecter</a>

</form>



<?php include RACINE . "/views/footer.php"; ?>