<!DOCTYPE html>
<html lang="fr">

<?php require RACINE . '/views/head.php' ?>

<body>
    <nav class="navbar">
        <a href="./?action=default" class="logo"><img src="./statics/images/zlogo1.png" alt="logo Brasserie Kerblei"></a>
        <!-- burgerNav -->
        <ul class="sidebar">
            <li onclick="hideSidebar()"><i id="navCross" class="fa-solid fa-xmark"></i></li>
            <li><a href="./?action=default">Accueil</a></li>
            <li><a href="./?action=products">Nos bières</a></li>
            <li><a href="./?action=login"><i class="fa-solid fa-basket-shopping"></i> Panier / Nous trouver</a></li>
            <?php if (isset($_SESSION['mail']) &&($_SESSION['admin']==1)): ?>
                <li><a href="./?action=admin"><i class="fa-solid fa-user"></i></a></li>
                <?php elseif(isset($_SESSION['mail'])&&($_SESSION['admin']==0)): ?>
                <li><a href="./?action=account"><i class="fa-solid fa-user"></i></a></li>
            <?php else: ?>
                <li><a href="./?action=login"><i class="fa-solid fa-user"></i></a></li>
            <?php endif; ?>
        </ul>

        <!-- nav -->
        <ul>
            <li class="hideOnMobile"><a href="./?action=default">Accueil</a></li>
            <li class="hideOnMobile"><a href="./?action=products">Nos bières</a></li>
            <li class="hideOnMobile"><a href="./?action=cart"><i class="fa-solid fa-basket-shopping"></i> Panier</a></li>

            <!-- A retravailler ? -->
            <?php if (isset($_SESSION['mail']) &&($_SESSION['admin']==1)): ?>
                <li><a href="./?action=admin"><i class="fa-solid fa-user"></i></a></li>
                <?php elseif(isset($_SESSION['mail'])&&($_SESSION['admin']==0)): ?>
                <li><a href="./?action=account"><i class="fa-solid fa-user"></i></a></li>
            <?php else: ?>
                <li><a href="./?action=login"><i class="fa-solid fa-user"></i></a></li>
            <?php endif; ?>

            <li onclick=showSidebar()><i id="navBurger" class=" menuButton fa-solid fa-bars"></i></li>
        </ul>
    </nav>

    <hr>
    <main>