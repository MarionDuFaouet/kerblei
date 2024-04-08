<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="UTF-8" />
    <!--noindex-->
    <?php
    // verify actual page
    $currentPage = basename($_SERVER['PHP_SELF']);
    // list pages where no index must be
    $noIndexPages = array('login.php', 'logout.php', 'cart.php', 'account.php', 'admin.php', 'register.php', 'legalNotice.php');
    // verifiy if actual page is in this list
    if (in_array($currentPage, $noIndexPages)) {
        echo '<meta name="robots" content="noindex" />';
        echo '<meta name="googlebot" content="noindex" />';
    }
    ?>
    <meta name="description" content="<?php echo $description; ?>" />
    <meta name="author" content="Marion Lozach" />
    <title><?php echo $title; ?></title>
    <!-- CSS/JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link rel="stylesheet" href="./statics/styles/style.css"> 
    <link rel="stylesheet" href="./statics/styles/cart.css">  

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="./statics/js/headerScript.js" defer></script>
    <script src="./statics/js/backoffice.js" defer></script>
    <script src="./statics/js/account.js" defer></script>
    <script src="./statics/js/cart.js" defer></script>
    <script src="./statics/js/map.js" defer></script>

</head>