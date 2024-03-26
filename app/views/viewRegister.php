<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    die('Erreur : '.basename(__FILE__));
}

// meta description and title
$description = "Nouveau compte kerblei";
$title = "Kerblei - S'inscrire";

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

    <label for="nameFirstname">Mon nom</label>
    <input type="text" name="nameFirstname" placeholder="Nom Prénom" /><br />

    <label for="mail">J'entre mon identifiant</label>
    <input type="text" name="mail" placeholder="Mon Email" /><br />

    <label for="password">J'entre mon mot de passe</label>
    <input type="password" name="password" placeholder="Mon mot de passe"  /><br />

    <input class="cta-button" type="submit" title="Création votre compte" value="Je créé mon compte"/>

</form>
<br />

<hr>
<?php require_once RACINE . "/views/footer.php";?>