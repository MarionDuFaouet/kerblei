<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    die('Erreur : '.basename(__FILE__));
}

require_once RACINE. '/views/head.php';
$title="Micro-Brasserie Kerblei - Panier" ; ?>
<!-- question : puis-je ajouter ce head? (pour ne pas indexer cette page) -->
<head>
    <meta name="robots" content="noindex" />
    <meta name="googlebot" content="noindex" />
</head>

<!-- vue panier, modif et validation -->

<?php include RACINE . "/views/map.php";?>
<?php include RACINE . "/views/footer.php";?>