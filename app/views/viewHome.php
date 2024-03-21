<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    die('Erreur : '.basename(__FILE__));
}

// meta description and title
$description = "Découvrez notre gamme de bières artisanales.";
$title="Micro-Brasserie Kerblei Bienvenue" ;
include RACINE . "/views/header.php";
?>



<h1>Test de fonts</h1>
<p>Test de fonts</p>
<!-- icone burger -->
<i class="fa-solid fa-bars"></i>
<!-- icone user -->
<i class="fa-solid fa-user"></i>
<!-- icone panier -->
<i class="fa-solid fa-basket-shopping"></i>
<!-- icone poubelle -->
<i class="fa-solid fa-trash"></i>

<!-- nav -->
<!-- burger -->


<!-- 
Notes
HT access -->
<!-- titre, cta, image -->
<!-- section à propos, cta -->

<?php include RACINE . "/views/footer.php";?>