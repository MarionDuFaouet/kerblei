<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    die('Erreur : ' . basename(__FILE__));
}

// meta description and title
$title = "Connexion Kerblei";
$description = "Mon compte Kerblei";

require_once RACINE . '/views/header.php';
?>

<!-- question : puis-je ajouter ici ce head? (pour ne pas indexer cette page) -->
<!-- <head>
    <meta name="robots" content="noindex" />
    <meta name="googlebot" content="noindex" />
</head> -->
<!-- ------------------------------------------------------------------------ -->


<h2>Je Possède un compte</h2>
<form action="./?action=authentication" method="POST">
    <label for="mail">J'entre mon identifiant</label>
    <input type="text" name="mail" placeholder="Mon Email" /><br />

    <label for="password">J'entre mon mot de passe</label>
    <input type="password" name="password" placeholder="Mon mot de passe" /><br />

    <input class="cta-button" type="submit" title="Connexion à votre compte" value="Je me connecte" />
</form>

<?php var_dump($_POST); ?>
<?php var_dump($_SESSION); ?>

pour test : Mathilda Milsom, mathildamilsom@example.com mdp
pour test : Yoann Le Cerf, yoannlecerf@example.com mdp (isAdmin ==1)
<br />
<a href="./?action=register" class="cta-button" title="Cliquez pour créer un compte">Pas encore de compte ?</a>

<hr>

<?php require_once RACINE . '/views/footer.php' ?>