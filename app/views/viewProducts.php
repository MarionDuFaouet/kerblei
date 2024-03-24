<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    die('Erreur : '.basename(__FILE__));
}

// meta description and title
$description = "Découvrez notre gamme de bières artisanales.";
$title = "Kerblei - Nos produits";



require_once RACINE . "/views/header.php";
?>

<!-- affichage de mes produits -->
<ul>
<?php foreach ($products as $product): ?>
        <li>
            <img src="./statics/images/<?php echo $product['pictureRef']; ?>" alt="Bières Kerblei">
            <p><?php echo $product['name']; ?></p>
            <p><?php echo $product['designation']; ?></p>
            <p><?php echo $product['unitPrice']; ?> &#x20AC</p>
        </li>
    <?php endforeach; ?>
</ul>

<?php require_once RACINE . "/views/footer.php";?>