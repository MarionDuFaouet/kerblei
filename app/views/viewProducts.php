<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    die('Erreur : '.basename(__FILE__));
}

// meta description and title
$description = "Découvrez notre gamme de bières artisanales.";
$title = "Kerblei - Nos produits.";

include RACINE . "/views/header.php";
?>

<!-- titre, cta, image -->
<!-- section à propos, cta -->

<?php include RACINE . "/views/footer.php";?>