<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    die('Erreur : '.basename(__FILE__));
}

$title="Micro-Brasserie Kerblei - S'authentifier" ;
include RACINE . "/views/header.php";
?>
<!-- question : puis-je ajouter ce head? (pour ne pas indexer cette page) -->
<head>
    <meta name="robots" content="noindex" />
    <meta name="googlebot" content="noindex" />
</head>

<!-- formulaire de connexion -->
<!-- lien vers création de compte -->

<?php include RACINE . "/views/footer.php";?>