<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    die('Erreur : '.basename(__FILE__));
}
?>

<!DOCTYPE html>
<html lang="fr">

<?php require_once RACINE. '/app/views/head.php'?>

    <body>
        <header>
            <a href="./?action=home"><img src="/app/statics/images/zlogo1.png" alt="logo Brasserie Kerblei"></a>

            <nav>
                <ul id="mainMenu">
                    <li><a href="./?action=home">Accueil</a></li> 
                    <li><a href="./?action=products">Nos bières</a></li>
                    <?php if(isLoggedOn()){ ?>
                    <li><a href="./?action=cart"><i class="fa-solid fa-basket-shopping"></i>Panier / Nous trouver</a></li>
                    <li><a href="./?action=account"><i class="fa-solid fa-user"></i></a></li>
                    <?php 
                    } else{ ?>
                            <li><a href="./?action=authentication"><i class="fa-solid fa-basket-shopping"></i>Panier / Nous trouver</a></li>
                            <li><a href="./?action=authentication"><i class="fa-solid fa-user"></i></a></li>                
                    <?php } ?>
                </ul>
            </nav>
        </header>

        <main>
        




