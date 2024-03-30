<!DOCTYPE html>
<html lang="fr">

<?php require RACINE . '/views/head.php' ?>

<body>
        <!-- burgerNav -->
        <nav class="navbar">
            <a href="./?action=default" class="logo">
                <img src="./statics/images/zlogo1.png" alt="logo Brasserie Kerblei">
            </a>
            <div class="navLinks">
                <ul>
                    <li class="active"><a href="./?action=default">Accueil</a></li>
                    <li><a href="./?action=products">Nos bières</a></li>
            
                    <!-- ---------------------------------------- -->
                    <?php if (isset($_SESSION ['mail'])) { ?>
                        <li><a href="./?action=cart"><i class="fa-solid fa-basket-shopping"></i> Panier / Nous trouver</a></li>
                        <li><a href="./?action=account"><i class="fa-solid fa-user"></i></a></li>
                    <?php } else { ?>
                        <li><a href="./?action=authentication"><i class="fa-solid fa-basket-shopping"></i>Panier / Nous trouver</a></li>
                        <li><a href="./?action=authentication"><i class="fa-solid fa-user"></i></a></li>
                    <?php } ?>
                    <!-- ?  --------------------------------------------- -->
                </ul>
            </div>
            <!-- retirer l'image si je ne l'utilise pas -->
            <!-- <img src="./statics/images/menu-btn.png" alt="menu déroulant" class="burgerMenu"> -->
            <i class="fa-solid fa-bars burgerMenu"></i>
        </nav>
        <header></header>

        <hr id="down">
    <main>