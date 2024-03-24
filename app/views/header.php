<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    die('Erreur : '.basename(__FILE__));
}
?>

<!DOCTYPE html>
<html lang="fr">

<?php require_once RACINE. '/views/head.php'?>

    <body>
        <header>
            <nav id="nav" class="active">
            <a href="./?action=home"><img id="logo" src="./statics/images/zlogo1.png" alt="logo Brasserie Kerblei"></a>
                <ul id="mainMenu">
                    <li><a href="./?action=default">Accueil</a></li> 
                    <li><a href="./?action=products">Nos bières</a></li>
                    <?php if(isLoggedOn()){ ?>
                    <li><a href="./?action=cart"><i class="fa-solid fa-basket-shopping"></i> Panier / Nous trouver</a></li>
                    <li><a href="./?action=account"><i class="fa-solid fa-user"></i></a></li>
                    <?php 
                    } else{ ?>
                            <li><a href="./?action=authentication"><i class="fa-solid fa-basket-shopping"></i>Panier / Nous trouver</a></li>
                            <li><a href="./?action=authentication"><i class="fa-solid fa-user"></i></a></li>                
                    <?php } ?>
                </ul>
                <!-- burgerNav -->
                <div id="icons"></div>
            </nav>
        </header>

        <main>


<script>

    //burgerNav
    const links = document.querySelectorAll('nav li');
    icons.addEvensListener("click", () => {
        nav.classList.toggle("active");
    });
    // mes liens ferment la nav au clic
    links forEach((link) =>{
        link.addEvensListener('click', () => {
            nav.classList.remove("active");
        });
    });

</script>
        




