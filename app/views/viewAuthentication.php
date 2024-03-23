<?php

// restreinte d'accès (definition sur entete.html.php)
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
	// Un MVC utilise uniquement ses requêtes depuis le contrôleur principal : index.php
    die('Erreur : '.basename(__FILE__));
}

require_once RACINE. '/views/header.php';

?>

<!-- question : puis-je ajouter ce head? (pour ne pas indexer cette page) -->
<head>
    <meta name="robots" content="noindex" />
    <meta name="googlebot" content="noindex" />
</head>

<h1>Je Possède un compte</h1>
<form action="./?action=authentication" method="POST">
    <input type="text" name="mail" placeholder="Mon Email" /><br />
    <input type="password" name="password" placeholder="Mon mot de passe"  /><br />
    <input class="cta-button" type="submit" title="Connexion à votre compte" value="Je me connecte"/>
</form>
<br />
<a href="./?action=register" class="cta-button" title="Cliquez pour créer un compte">Pas encore de compte ?</a>

<hr>

<?php require_once RACINE. '/views/footer.php'?>
