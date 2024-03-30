<?php

// meta description and title
$description = "Bienvenue Kerblei Admin.";
$title = "Kerblei Admin";
// view calling
include RACINE . '/views/header.php' ?>

<!-- question : puis-je ajouter ce head? (pour ne pas indexer cette page) -->
<!-- <head>
    <meta name="robots" content="noindex" />
    <meta name="googlebot" content="noindex" />
</head> -->
<!-- ---------------------------------------------------------------------- -->

<div class="tabs">
    <div class="tabsBtnContainer" role="tabList" aria-label="tab component">
        <!-- accessibility -->
        <button class="tab activeTab" role="tab" aria-controls="panel-1" id="tab-1" type="button" aria-selected="true" tabindex="0">Gestion des commandes🛒</button>
        <!-- accessibility -->
        <button class="tab" role="tab" aria-controls="panel-2" id="tab-2" type="button" aria-selected="false" tabindex="-1">Gestion des produits🧴</button>

    </div>
    <!-- accessibility -->
    <div class="tabContent activeTabContent" id="panel-1" role="tabpanel" tabindex="0" aria-labelledby="tab-1">
        <h3>Gestion des commandes🛒</h3>
        <p>contenu gestion commandes. Lorem ipsum dolor sit, amet consectetur
            adipisicing elit. Ullam natus voluptas aut aliquid tempore fugiat
            doloremque iste facilis vel illum? Iusto quos rerum deserunt et!
            Dolores molestiae asperiores aliquid deleniti?</p>
    </div>
    <!-- accessibility -->
    <div class="tabContent" id="panel-2" role="tabpanel" tabindex="0" aria-labelledby="tab-2">
        <h3>Gestion des produits🧴</h3>
        <p>contenu gestion produits. Lorem ipsum, dolor sit amet
            consectetur adipisicing elit. Rerum nam assumenda beatae.</p>
    </div>
</div>




















<!-- view calling -->
<?php require_once RACINE . '/views/footer.php' ?>