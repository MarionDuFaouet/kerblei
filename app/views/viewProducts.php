<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    die('Erreur : '.basename(__FILE__));
}

// meta description and title
$description = "Découvrez notre gamme de bières artisanales.";
$title = "Kerblei - Nos produits";

require_once RACINE . "/views/header.php";
?>

<!-- affichage de mes produits -->

<?php require_once RACINE . "/views/footer.php";?>