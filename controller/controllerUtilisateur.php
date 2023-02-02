<?php

require('model/UtilisateurManager.php');

function getFormConnexion()
{
    require('view/loginView.php');
}

function authentifier($courriel, $motPasse) {

    require('controller/controllerAccueil.php');
    $utilisateurManager = new UtilisateurManager();
    $utilisateur = $utilisateurManager->verifAuthentification($courriel, $motPasse);

    if($utilisateur != null) {
        
        $_SESSION['courriel'] = $utilisateur->get_courriel();
        $_SESSION['role'] = $utilisateur->get_role_utilisateur();
        listProduits();
    }
    else {
        echo "L'authentification a échoué";
    }
}

function deconnexion() {
    $_SESSION = array();
    session_destroy();
    require('controller/controllerAccueil.php');
    listProduits();
}

function authentificationGoogle($credential) {

    require_once 'vendor/autoload.php';

    $CLIENT_ID = '783971282932-uokpn0o9fmk45h7aao4ap6d9p20brfk5.apps.googleusercontent.com';

    $client = new Google_Client(['client_id' => $CLIENT_ID]);
    $payload = $client->verifyIdToken($credential);
    // Trouve un compte google et le met dans $userid
    if ($payload) {
        $userid = $payload['sub'];

        // Vérification si compte existe dans BD
        $utilisateurManager = new UtilisateurManager();
        $utilisateur = $utilisateurManager->getUtilisateurParCourriel($payload);

        // Compte google déjà enregistré en BD
        if($utilisateur != null) {
        
            $_SESSION['courriel'] = $utilisateur->get_courriel();
            $_SESSION['role'] = $utilisateur->get_role_utilisateur();
        }
        // Création du compte
        else {
            //$utilisateur->addUtilisateur($payload);

        }


        print_r($payload);
    } else {
        // Invalid ID token
    }
    require('controller/controllerAccueil.php');
    listProduits();
}