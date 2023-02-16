<?php $titreH1 = "Authentification" ?>

<?php $title = 'Authentification'; ?>


<?php ob_start(); ?>
<h1><?= $titreH1; ?></h1>

    
<form action="index.php" method="post" class="Se connecter">
    <fieldset>
        <label for="courriel">Courriel </label>        
        <input type="email" name="courriel" id="courriel">
        
        <label for="password">Mot de passe </label>        
        <input type="password" name="password" id="password">

        <input type="checkbox" id="remember" name="remember" value="remember">
        <label for="remember">Se souvenir de moi</label><br>

        <input type="hidden" name="action" value="authentifier">
        <button type="submit">Se connecter</button>

    </fieldset>

    <div id="g_id_onload"
        data-client_id="783971282932-uokpn0o9fmk45h7aao4ap6d9p20brfk5.apps.googleusercontent.com"
        data-login_uri="http://localhost/FichiersSiteWeb/"
        data-auto_prompt="false">
    </div>
    <div class="g_id_signin"
        data-type="standard"
        data-size="large"
        data-theme="outline"
        data-text="sign_in_with"
        data-shape="rectangular"
        data-logo_alignment="left">
    </div>

    
</form> 

<div class="g-signin2" data-onsuccess="onSignIn"></div>
    
        
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>