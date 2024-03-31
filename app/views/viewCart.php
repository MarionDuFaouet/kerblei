<?php

// meta description and title
$description = "Découvrez notre gamme de bières artisanales.";
$title = "Micro-Brasserie Kerblei - Panier";

require_once RACINE . '/views/header.php';
?>

<!-- question : puis-je ajouter ce head? (pour ne pas indexer cette page) -->
<!-- <head>
    <meta name="robots" content="noindex" />
    <meta name="googlebot" content="noindex" />
</head> -->

<!-- -------------------------------------------------------------------------- -->
<section class="container">
    <p><?php echo $msg; ?></p>
</section>

<!-- vue panier, modif et validation -->

<!-- icone poubelle! -->
<!-- <i class="fa-solid fa-trash"></i> -->


<?php
include RACINE . "/views/viewMap.php";
include RACINE . "/views/footer.php"; 
?>