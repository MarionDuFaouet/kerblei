<body>

    <nav id="nav">
        <a href="./?action=default" class="logo"><img src="./statics/images/zlogo1.png" alt="logo Brasserie Kerblei"></a>
        <ul>
            <li><a href="./?action=default">Accueil</a></li>
            <li><a href="./?action=products">Nos bières</a></li>
            <li><a href="./?action=map">Contact</a></li>
            <li><a id="cartButton"><i class="fa-solid fa-xl fa-bag-shopping icon"></i>
                    <span id="badge">
                    <?php echo (isset($_SESSION['cart'])? count($_SESSION['cart']) : 0) ?>
                    </span>Panier</a>
            </li>

            <?php if (isset($_SESSION['mail']) && ($_SESSION['admin'] == 1)) : ?>
                <li><a href="./?action=admin"><i class="fa-solid fa-xl fa-user icon"></i></a></li>
            <?php elseif (isset($_SESSION['mail']) && ($_SESSION['admin'] == 0)) : ?>
                <li><a href="./?action=account"><i class="fa-solid fa-xl fa-user icon"></i></a></li>
            <?php else : ?>
                <li><a href="./?action=login"><i class="fa-solid fa-xl fa-user icon"></i></a></li>
            <?php endif; ?>
        </ul>
        <div id="icons"></div>
    </nav>
    <?php require RACINE . '/views/viewCartModal.php' ?>

    <hr>
    <main>