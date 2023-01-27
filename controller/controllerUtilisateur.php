<?php

require('model/UtilisateurManager.php');

function getFormConnexion()
{
    require('view/loginView.php');
}

function authentifier($courriel, $motPasse) {

    require('controller/controllerAccueil.php');

    $utilisateur = verifAuthentification($courriel, $motPasse);
    
    if($utilisateur != null) {
        listProduit();

        $_SESSION['courriel'] = $utilisateur->get_courriel();
        $_SESSION['role'] = $utilisateur->get_role_utilisateur();
    }
    else {
        echo "L'authentification a échoué";
    }
}