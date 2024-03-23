<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    die('Erreur : '.basename(__FILE__));
}
$description = "Trouvez notre basserie.";
$title="Micro-Brasserie Kerblei" ;

require_once RACINE. '/views/header.php';
?>

<aside id="map">
    <div id="mapLeft">
        <h2>La Brasserie</h2>
        <adress>5 rue de kernavalo <br> 56870 BADEN</adress>
    </div>
    <div id="mapRight">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2689.370957108478!2d-2.8886619240440456!3d47.618919971191005!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4810108fd9ea692d%3A0x59435d2a947e4993!2s5%20Rue%20de%20Kernavalo%20Man%C3%A9%20Bihan%2C%2056870%20Baden!5e0!3m2!1sfr!2sfr!4v1711180841533!5m2!1sfr!2sfr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</aside>

<?php require_once RACINE. '/views/footer.php'?>
<!-- ou -->
<?php include RACINE . "/views/footer.php";?>