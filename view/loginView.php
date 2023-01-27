<?php $titreH1 = "Authentification" ?>

<?php $title = 'Authentification'; ?>

<?php ob_start(); ?>
<h1><?= $titreH1; ?></h1>

    
    <form action="index.php" method="POST">
        <div>
            <label for="courriel">Courriel </label>        
            <input type="email" name="courriel" id="courriel">
            
            <label for="password">Mot de passe </label>        
            <input type="password" name="password" id="password">

            <input type="checkbox" id="remember" name="rememeber" value="remeber">
            <label for="remember">Se souvenir de moi</label><br>

            <button type="submit">Se connecter</button>

            <input type="hidden" name="action" value="authentifier">
    
        </div>

    </form>
        
        
    
        


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>