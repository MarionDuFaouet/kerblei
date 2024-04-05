<?php

// meta description and title
$description = "Nouveau compte kerblei";
$title = "Kerblei - S'inscrire";

// include header
require_once RACINE . "/views/header.php";
?>
<!-- --------------------------------------------------------- -->


<h2>Je créé mon compte</h2>
<p class="msg"><?php echo $msg; ?></p>

<form class="forms" action="./?action=register" method="POST">

    <label for="name">Mon nom *</label>
    <input type="text" name="name" placeholder="Nom" 
    required maxlength="20" /><br />

    <label for="firstname">Mon prénom *</label>
    <input type="text" name="firstname" placeholder="Prénom" 
    value="<?php if(!empty($_POST['firstname'])) echo $_POST['firstname']; ?>" 
    required maxlength="20" /><br />

    <label for="mail">J'entre mon identifiant *</label>
    <input type="email" name="mail" placeholder="Mon Email" 
    value="<?php if(!empty($_POST['mail'])) echo $_POST['mail']; ?>" 
    required maxlength="50"/><br />

    <label for="password">J'entre mon mot de passe *</label>
    <input type="password" name="password" placeholder="min. 8 caractères, dont 1 caractère spécial" 
    required minlength="8" pattern="(?=.*[!@#$%^&*()\-_=+{};:,<.>])\S+" /><br />

    <input class="cta-button" type="submit" title="Création votre compte" value="Je créé mon compte"/>

</form>

<br />

<hr>

 <!-- include footer -->
<?php require_once RACINE . "/views/footer.php";?>