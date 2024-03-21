<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    die('Erreur : '.basename(__FILE__));
}

// meta description and title
$title="Micro-Brasserie Kerblei - Mon compte" ;
include RACINE. '/views/header.php' ?>

<!-- question : puis-je ajouter ce head? (pour ne pas indexer cette page) -->
<head>
    <meta name="robots" content="noindex" />
    <meta name="googlebot" content="noindex" />
</head>

<!-- modif données perso utilisateur -->
<!-- vue commandes passées et en cours -->

<?php include RACINE . "/views/footer.php";?>

    