<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    die('Erreur : '.basename(__FILE__));
}

include RACINE. '/views/header.php'; ?>
<!-- question : puis-je ajouter ce head? (pour ne pas indexer cette page) -->
<head>
    <meta name="robots" content="noindex" />
    <meta name="googlebot" content="noindex" />
</head>

<a href="./?action=adminOrder" title="Cliquez ici pour accéder aux commandes" class="cta-button">Gestion des commandes</a>
<a href="./?action=adminProduct" title="Cliquez ici pour gérer votre boutique" class="cta-button">Gestion des produits</a>

<!-- redirection vers adminOrder ou adminProduct -->

<?php require_once RACINE. '/views/footer.php'?>
