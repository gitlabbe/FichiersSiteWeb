<?php $baseURL = "/FichiersSiteWeb/"

    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="referrer" content="no-referrer-when-downgrade" />
        <title><?= $title ?></title>
        <link href="<?= $baseURL;?>inc/css/style.css" rel="stylesheet" /> 
        <script src="https://accounts.google.com/gsi/client" async defer></script>
        <script src="./inc/js/script.js"></script>
    </head>

    <body>

        <?php

            require_once('model/AutologManager.php');

            echo '----------------------------<br />
                Paramètres reçus :<br />
                $_REQUEST :<br />
                <pre>';

            print_r($_REQUEST);
            print_r($_SESSION);

            echo '</pre>
                $_COOKIE :<br />
                <pre>';

            print_r($_COOKIE);

            echo '</pre>----------------------------<br />';
        ?>

        <?php
            if(isset($_SESSION['courriel'])) {
                echo '<h2>' . _('Bienvenue') . $_SESSION['courriel'] . '</h2>';
            }
        ?>
        <nav>
            <ul>
                <li><a href="<?= $baseURL;?>index.php"><?=_('Accueil')?></a></li>
                <li><a href="<?= $baseURL;?>produits"><?=_('Les produits')?></a></li>
                <li><a href="<?= $baseURL;?>categories"><?=_('Les catégories')?></a></li>
                <?php

                    $am = new AutologManager();

                    if(isset($_SESSION['courriel']) && $_SESSION['courriel'] != null) { //  || isset($_COOKIE['g_csrf_token'])
                        echo '<li><a href="' . $baseURL . 'deconnexion">' . _('Se déconnecter') . '</a></li>';
                    }
                    else {
                        echo '<li><a href="' . $baseURL . 'connexion">' . _('Se connecter') . '</a></li>';
                        echo '<li><a href="' . $baseURL . 'inscrire">' . _("S'inscrire") . '</a></li>';
                    }

                    if(isset($_COOKIE['rememberMe']) && $am->verifyToken(json_decode($_COOKIE['rememberMe'])->user_id,json_decode($_COOKIE['rememberMe'])->token)!=null) {
                        echo "<li><a href=".$baseURL."delete>" . _('Se déconnecter') . "</a></li>";
                    }

                    echo '<li><a href="index.php?action=changerLangue&langue=en_ca">' . _('Anglais') . '</a></li>';

                    echo '<li><a href="index.php?action=changerLangue&langue=fr_ca">' . _('Français') . '</a></li>';

                    echo '<li><a href="index.php?action=changerLangue&langue=pt_br">' . _('Portugais') . '</a></li>';
                ?>
                
            </ul>
        </nav>
        <?= $content ?>
    </body>
</html>