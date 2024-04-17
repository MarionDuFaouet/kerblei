<?php

// meta description and title
$description = "Nouveau compte kerblei";
$title = "Kerblei - S'inscrire";

require_once RACINE . '/views/head.start.php';
require_once RACINE . '/views/head.stop.php';
require_once RACINE . '/views/menu.php';
?>
<!-- --------------------------------------------------------- -->

<h2>Je créé mon compte</h2>
<p class="msg"><?php echo $msg; ?></p>

<form class="forms" action="./?action=register" method="POST">

    <label for="name">Mon nom *</label>
    <input type="text" id="name" name="name" placeholder="Nom" value="<?php if (!empty($_POST['name'])) echo $_POST['name']; ?>" required maxlength="20">

    <label for="firstname">Mon prénom *</label>
    <input type="text" id="firstname" name="firstname" placeholder="Prénom" value="<?php if (!empty($_POST['firstname'])) echo $_POST['firstname']; ?>" required maxlength="20">

    <label for="mail">J'entre mon identifiant *</label>
    <input type="email" id="mail" name="mail" placeholder="Mon Email" value="<?php if (!empty($_POST['mail'])) echo $_POST['mail']; ?>" required maxlength="50">

    <label for="password">J'entre mon mot de passe *</label>
    <input type="password" id="password" name="password" placeholder="min. 8 caractères, dont 1 caractère spécial" required minlength="8" pattern="(?=.*[!@#$%^&*()\-_=+{};:,<.>])\S+">
    <div >
        <input class="top" class="cta-button" type="submit" title="Création de votre compte" value="Je créé mon compte">
    </div>
</form>

<br>

<!-- include footer -->
<?php require_once RACINE . "/views/footer.php"; ?>