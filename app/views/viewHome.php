<?php

// meta description and title
$description = "Kerblei Admin.";
$title = "Kerblei Admin";

require_once RACINE . '/views/head.start.php';
require_once RACINE . '/views/head.stop.php';
require_once RACINE . '/views/menu.php';
?>
<!-- --------------------------------------------------------------------- -->

<div id="headerMain" class="container">
    <div>
        <p id="subTitle">"MICRO-BRASSERIE"</p>
        <p id="firstTitle">KERBLEI</p>
        <p id="headerMainText">Une dégustation? <br> Venez visiter la brasserie !</p>
        <a href="./?action=map" title="Cliquez ici pour nous trouver" class="cta-button">Nous rencontrer</a>
    </div>
    <img src="./statics/images/tonneau.jpg" alt="Tonneaux de bières Brasserie Kerblei">
</div>

<section class="container" id="about">
    <h2>DEGEMER MAT</h2>
    <div id="about1">
        <img src="./statics/images/livraisons.jpg" alt="Caisses de bières Brasserie Kerblei">
        <p> Lien abred argoat banniel pesketa daoudroad ennoc’h fazi
            peogwir, da gorre komz hervez bern c’houevr bagad
            c’hoarvezout loa, c’hraou c’havr Montroulez a kibellañ ar
            chapel. Amann señin taer paot Kemper c’haier genver te nijal,
            seitek a kaout soudard kalet merkañ enni lizher degemer,
            hiziv roud mat hir bruched tiegezh c’hann. Ganin skañv
            beaj ennout merc’hed ler bleud butuniñ Gerveur, keniterv pemzek
            bern lemm ac’hanout sankañ kleiz pep a, bodañ marennañ stad .
        </p>
    </div>
    <div id="about2">
        <video controls="controls">
            <source src="./statics/video/houblon.mp4" type="video/mp4">
            <source src="./statics/video/houblon.webm" type="video/webm">
            <source src="./statics/video/houblon.ogg" type="video/ogg">
            Culture du houblon
        </video>
        <p>E gwelloc’h amañ distagañ metrad war start e genou, waz roched
            kreñv livañ speredekañ dad kenetre ar drezo, niz daouzek a bodet
            e bag vandenn. An c’haol linenn pepr penn lammat tresañ beajiñ
            gwaskañ, neuiñ start eor Abbarez seizhvet Entraven porzh war brumenn,
            vandenn paotred pla’hig digant gontell izel kemener.Kregiñ
            ar pri d’a c’hotoñs dec’h plij Pempont te, kontell santout
            stank pal ar sivi kazetenn druez amann, koumoul boutañ
            roc’h penaos trouz pepr pounner.
        </p>
    </div>
    <a href="./?action=products" title="Cliquez ici pour découvrir notre gamme de bières" class="cta-button button">Découvrez la gamme</a>
</section>

<?php require_once RACINE . '/views/footer.php' ?>