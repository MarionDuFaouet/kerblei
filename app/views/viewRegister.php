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

    <label for="name">Mon nom</label>
    <input type="text" name="name" placeholder="Nom" /><br />

    <label for="firstname">Mon prénom</label>
    <input type="text" name="firstname" placeholder="Prénom" /><br />

    <label for="mail">J'entre mon identifiant</label>
    <input type="email" name="mail" placeholder="Mon Email" /><br />

    <label for="password">J'entre mon mot de passe</label>
    <input type="password" name="password" placeholder="au moins 8 caratères, dont caractère spécial"  /><br />

    <input class="cta-button" type="submit" title="Création votre compte" value="Je créé mon compte"/>

</form>
<br />

<hr>

 <!-- include footer -->
<?php require_once RACINE . "/views/footer.php";?>