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
    <input type="text" name="mail" placeholder="Mon Email"value=<?php echo $_POST["mail"] ?? ''?> /><br /></p>

    <p>
    <label for="password">J'entre mon mot de passe</label>
    <input type="password" name="password" placeholder="Mon mot de passe"value=<?php echo $_POST["password"] ?? ''?> /><br /></p>

    <input class="cta-button" type="submit" title="Connexion à votre compte" value="Je me connecte" />
</form>

<form action="?action=login" method="post">

            <p><label for="login">Login </label>
                <input type="text" name="login" 
                    placeholder="Your pseudo" value=<?php echo $_POST["login"] ?? ''?>></p>
            <p><label for="password">Password </label>
                <input type="text" name="password" 
                    placeholder="Your password" value=<?php echo $_POST["password"] ?? ''?>></p>
           
            <p><input type="submit" value="Apply"></p>
        </form>

<?php echo $msg; ?>

<?php var_dump($_POST); ?>

 

pour test : Mathilda Milsom, mathildamilsom@example.com mdp
pour test : Yoann Le Cerf, yoannlecerf@example.com mdp (isAdmin ==1)
<br />
<a href="./?action=register" class="cta-button" title="Cliquez pour créer un compte">Pas encore de compte ?</a>

<hr>

<?php require_once RACINE . '/views/footer.php' ?>