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
            <li><a href="./?action=map">Contact</a></li>
            <li><a class="cartButton"><i class="fa-solid fa-xl fa-bag-shopping icon"></i>
                <span class='badge cartBadge'>0</span>Panier</a>
            </li>
            <?php if (isset($_SESSION['mail']) &&($_SESSION['admin']==1)): ?>
                <li><a href="./?action=admin"><i class="fa-solid fa-xl fa-user icon"></i></a></li>
                <?php elseif(isset($_SESSION['mail'])&&($_SESSION['admin']==0)): ?>
                <li><a href="./?action=account"><i class="fa-solid fa-xl fa-user icon"></i></a></li>
            <?php else: ?>
                <li><a href="./?action=login"><i class="fa-solid fa-xl fa-user icon"></i></a></li>
            <?php endif; ?>
        </ul>

        <!-- UN DE MES DEUX LIENS CART NE FONCTIONNE PAS?????-->
        <!-- nav -->
        <ul>
            <li class="hideOnMobile"><a href="./?action=default">Accueil</a></li>
            <li class="hideOnMobile"><a href="./?action=products">Nos bières</a></li>
            <li class="hideOnMobile"><a href="./?action=map">Contact</a></li>
            <li class="hideOnMobile"><a class="cartButton"><i class="fa-solid fa-xl fa-bag-shopping icon"></i>
                <span class='badge cartBadge'>0</span>Panier</a>
            </li>
            <?php if (isset($_SESSION['mail']) && ($_SESSION['admin']==1)): ?>
                <li><a href="./?action=admin"><i class="fa-solid fa-xl fa-user icon"></i></a></li>
                <?php elseif (isset($_SESSION['mail'])&&($_SESSION['admin']==0)): ?>
                <li><a href="./?action=account"><i class="fa-solid fa-xl fa-user icon"></i></a></li>
            <?php else: ?>
                <li><a href="./?action=login"><i class="fa-solid fa-xl fa-user icon"></i></a></li>
            <?php endif; ?>

            <li onclick=showSidebar()><i id="navBurger" class="menuButton fa-solid fa-bars"></i></li>
        </ul>
    </nav>

    <?php require RACINE . '/views/viewCartModal.php' ?>

    <hr>
    <main>