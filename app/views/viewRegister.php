<?php

// meta description and title
$description = "Nouveau compte kerblei";
$title = "Kerblei - S'inscrire";

// include header
require_once RACINE . "/views/header.php";
?>

<!-- question : puis-je ajouter ce head? (pour ne pas indexer cette page) -->
<head>
    <meta name="robots" content="noindex" />
    <meta name="googlebot" content="noindex" />
</head>
<!-- --------------------------------------------------------- -->


<h2>Je créé mon compte</h2>


<form action="./?action=register" method="POST">

    <label for="name">Mon nom</label>
    <input type="text" name="name" placeholder="Nom" /><br />

    <label for="firstname">Mon prénom</label>
    <input type="text" name="firstname" placeholder="Prénom" /><br />

    <label for="mail">J'entre mon identifiant</label>
    <input type="email" name="mail" placeholder="Mon Email" /><br />

    <label for="phone">J'entre mon numéro de téléphone</label>
    <input type="phone" name="phone" placeholder="Mon numéro de téléphone" /><br />

    <label for="password">J'entre mon mot de passe</label>
    <input type="password" name="password" placeholder="Mon mot de passe"  /><br />

    <input class="cta-button" type="submit" title="Création votre compte" value="Je créé mon compte"/>
    <p><?php echo $msg; ?></p>

</form>
<br />

<hr>

 <!-- include footer -->
<?php require_once RACINE . "/views/footer.php";?>