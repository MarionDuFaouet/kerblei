<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    die('Erreur : '.basename(__FILE__));
}

// meta description and title
$description = "Découvrez notre gamme de bières artisanales.";
$title = "Kerblei - S'inscrire";

require_once RACINE . "/views/header.php";
?>
<!-- question : puis-je ajouter ce head? (pour ne pas indexer cette page) -->
<head>
    <meta name="robots" content="noindex" />
    <meta name="googlebot" content="noindex" />
</head>

<!-- formulaire de création de compte -->

<?php require_once RACINE . "/views/footer.php";?>