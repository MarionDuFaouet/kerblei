<?php

// meta description and title
$description = "Kerblei Admin.";
$title = "Kerblei Admin";

require_once RACINE . '/views/head.start.php';
?>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="">
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script src="./statics/js/map.js" defer></script>

<?php
require_once RACINE . '/views/head.stop.php';
require_once RACINE . '/views/menu.php';
?>
<!-- ------------------------------------------------------------------------------- -->

<aside class="container mapContent">
    <div>
        <h2>La Brasserie</h2>

        <adress>5 rue de kernavalo <br> 56870 BADEN</adress>

        <p>Retrouvez-nous sur le marché de Baden <br> tous les samedis matin</p>
        <p>01 01 01 01 01</p>
        <img src="./statics/images/marche.jpg" alt="stand marché Kerblei">
    </div>

    <div id="myMap"></div>

</aside>

<?php
require_once RACINE . '/views/footer.php';
?>