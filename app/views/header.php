<!DOCTYPE html>
<html lang="fr">

<?php require RACINE . '/views/head.php' ?>

<body>
    <!-- burgerNav -->
    <nav class="navbar">
        <a href="./?action=default" class="logo"><img src="./statics/images/zlogo1.png" alt="logo Brasserie Kerblei"></a>
        <ul class="sidebar">
            <li onclick=hideSidebar()><i id="navCross" class="fa-solid fa-xmark"></i></li>
            <li><a href="./?action=default">Accueil</a></li>
            <li><a href="./?action=products">Nos bières</a></li>
            <?php if (isset($_SESSION['mail'])) { ?>
                <li><a href="./?action=cart"><i class="fa-solid fa-basket-shopping"></i> Panier / Nous trouver</a></li>
                <li><a href="./?action=account"><i class="fa-solid fa-user"></i></a></li>
            <?php } else { ?>
                <li><a href="./?action=authentication"><i class="fa-solid fa-basket-shopping"></i>Panier / Nous trouver</a></li>
                <li><a href="./?action=authentication"><i class="fa-solid fa-user"></i></a></li>
            <?php } ?>
        </ul>
        <ul>
            <li class="hideOnMobile"><a href="./?action=default">Accueil</a></li>
            <li class="hideOnMobile"><a href="./?action=products">Nos bières</a></li>
            <?php if (isset($_SESSION['mail'])) { ?>
                <li class="hideOnMobile"><a href="./?action=cart"><i class="fa-solid fa-basket-shopping"></i> Panier / Nous trouver</a></li>
                <li class="hideOnMobile"><a href="./?action=account"><i class="fa-solid fa-user"></i></a></li>
            <?php } else { ?>
                <li class="hideOnMobile"><a href="./?action=authentication"><i class="fa-solid fa-basket-shopping"></i>Panier / Nous trouver</a></li>
                <li class="hideOnMobile"><a href="./?action=authentication"><i class="fa-solid fa-user"></i></a></li>
            <?php } ?>
            <li onclick=showSidebar()><i id="navBurger" class=" menuButton fa-solid fa-bars"></i></li>

        </ul>
    </nav>

    <hr>
    <main>