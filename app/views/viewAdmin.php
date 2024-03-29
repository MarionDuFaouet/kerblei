<?php

// meta description and title
$description = "Bienvenue Kerblei Admin.";
$title="Kerblei Admin";
include RACINE. '/views/header.php' ?>

<!-- question : puis-je ajouter ce head? (pour ne pas indexer cette page) -->
<head>
    <meta name="robots" content="noindex" />
    <meta name="googlebot" content="noindex" />
</head>

<!-- redirection vers adminOrder ou adminProduct -->
<a href="./?action=adminOrder" title="Cliquez ici pour accéder aux commandes" class="cta-button">Gestion des commandes</a>
<hr>
<a href="./?action=adminProduct" title="Cliquez ici pour gérer votre boutique" class="cta-button">Gestion des produits</a>


<?php require_once RACINE. '/views/footer.php'?>
