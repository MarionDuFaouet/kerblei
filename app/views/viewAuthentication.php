<?php
// meta description and title
$title = "Connexion Kerblei";
$description = "Mon compte Kerblei";

require_once RACINE . '/views/header.php';

?>

<!-- question : puis-je ajouter ici ce head? (pour ne pas indexer cette page) -->
<!-- <head>
    <meta name="robots" content="noindex" />
    <meta name="googlebot" content="noindex" />
</head> -->
<!-- ------------------------------------------------------------------------ -->


<h2>Je Possède un compte</h2>
<form action="./?action=authentication" method="POST">
    <p>
        <label for="mail">J'entre mon identifiant (mail)</label>
        <input type="text" name="mail" placeholder="Mon Email" /><br />
    </p>

    <p>
        <label for="password">J'entre mon mot de passe</label>
        <input type="password" name="password" placeholder="Mon mot de passe" /><br />
    </p>

    <input class="cta-button" type="submit" title="Connexion à votre compte" value="Je me connecte" />
    
    
    <!-- to logout -->
    <div>
        <a href="./?action=logout" class="cta-button" title="Cliquez ici pour vous déconnecter">Se déconnecter</a>
    </div>

</form>

<?php require RACINE . '/views/message.php'; ?>
<?php $message; ?>


<br />

<a href="./?action=register" class="cta-button" title="Cliquez ici pour créer un compte">Pas encore de compte ?</a>
</div>


<?php require_once RACINE . '/views/footer.php' ?>