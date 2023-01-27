<?php $baseURL = "/FichiersSiteWeb/"?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link href="<?= $baseURL;?>inc/css/style.css" rel="stylesheet" /> 
    </head>
    <?php
        //Débogage afficher ce qui est reçu en paramètres
        echo "----------------------------<br/>";
        echo "Paramètres reçus:<br/><pre>";
        print_r($_REQUEST);
        echo "</pre>----------------------------<br/>";
    ?>
    <body>

        <?php
            if(isset($_SESSION['courriel'])) {
                echo '<h2>Bienvenue' . $_SESSION['courriel'] . '</h2>';
            }
        ?>
        <nav>
            <ul>
                <li><a href="<?= $baseURL;?>index.php">Accueil</a></li>
                <li><a href="<?= $baseURL;?>produits">Les produits</a></li>
                <li><a href="<?= $baseURL;?>categories">Les catégories</a></li>
                <?php
                    if(isset($_SESSION['courriel'])) {
                        echo '<li><a href="' . $baseURL . 'deconnexion">Se déconnecter</a></li>';
                    }
                    else {
                        echo '<li><a href="' . $baseURL . 'connexion">Se connecter</a></li>';
                    }
                ?>
                
            </ul>
        </nav>
        <?= $content ?>
    </body>
</html>