<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    die('Erreur : '.basename(__FILE__));
}
?>


<?php require_once RACINE. '/app/views/header.php'?>

<div id="headerMain">
    <div id="headerMainLeft">
        <p>MICRO-BRASSERIE</p>
        <h1>KERBLEI</h1>
        <p>Une dégustation? <br> Venez visiter la brasserie</p>
        <a href="./?action=products" title="Cliquez ici pour nous trouver" class="cta-button">Nous rencontrer</a>
    </div>
    <div id="headerMainRight">
    <img src="/app/statics/images/tonneau.png" alt="Tonneaux de bières Brasserie Kerblei">
    </div>
</div>

<?php require_once RACINE. '/app/views/footer.php'?>