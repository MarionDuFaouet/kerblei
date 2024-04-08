<?php

// meta description and title
$title = "Connexion Kerblei";
$description = "Mon compte Kerblei";

require_once RACINE . '/views/header.php';

?>

<!-- ------------------------------------------------------------------------ -->


<h2>Je Possède un compte</h2>
<form class="forms" action="./?action=login " method="POST">

    <label for="mail">J'entre mon identifiant (mail) *</label>
    <input type="text" name="mail" placeholder="Mon Email" 
    value="<?php echo isset($_POST['mail']) ? htmlspecialchars($_POST['mail']) : ''; ?>" /><br />
    <label for="password">J'entre mon mot de passe *</label>
    <input type="password" name="password" placeholder="Mon mot de passe" /><br />

    <input class="cta-button" type="submit" title="Connexion à votre compte" value="Je me connecte" />
    
    <!-- message -->
    <p><?php echo $msg; ?></p>
    
    <!-- to create account -->
    <a href="./?action=register" class="cta-button" title="Cliquez ici pour créer un compte">Pas encore de compte ?</a>

</form>

<?php $message; ?>


<br />


<?php require_once RACINE . '/views/footer.php' ?>