<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require('model/UtilisateurManager.php');

function getFormConnexion()
{
    require('view/loginView.php');
}

function authentifier($request, $langue) {

    require('controller/controllerAccueil.php');
    require('model/Util.php');
    require('model/AutologManager.php');

    $utilisateurManager = new UtilisateurManager();
    $am = new AutologManager();

    $utilisateur = $utilisateurManager->verifAuthentification($request['courriel'], $request['password']);

    if($utilisateur != null) {
        
        $_SESSION['courriel'] = $utilisateur->get_courriel();
        $_SESSION['role'] = $utilisateur->get_role_utilisateur();
        echo ("utilisateur existe");
        # Se souvenir de moi
        if(isset($request['remember'])) { //  && $request['remember'] == 'on'
            echo ("Se souvenir de moi est activé");
            $randomToken = $am->addAutolog($utilisateur);
            $cookieValues = array('user_id' => $utilisateur->get_id_utilisateur(), 'token' => $randomToken);
            setcookie('rememberMe', json_encode($cookieValues), time()+60);
        }
        #header("Refresh:0");

        listProduits($langue);
    }
    else {
        echo "L'authentification a échoué";
    }
}

function deconnexion() {
    #$_SESSION = array();
    unset($_SESSION['email']);
    session_destroy();
    header('Refresh:0; url=index.php');
    #require('controller/controllerAccueil.php');
    #listProduits();
}

function authentificationGoogle($credential, $langue) {

    require_once 'vendor/autoload.php';

    $CLIENT_ID = '783971282932-uokpn0o9fmk45h7aao4ap6d9p20brfk5.apps.googleusercontent.com';
    #print_r($credential);
    $client = new Google_Client(['client_id' => $CLIENT_ID]);
    $payload = $client->verifyIdToken($credential);

    // Trouve un compte google et le met dans $userid
    if ($payload) {

        // Vérification si compte existe dans BD
        $utilisateurManager = new UtilisateurManager();

        $utilisateur = $utilisateurManager->getUtilisateurParCourriel($payload['email']);
        print_r ($utilisateur);
        // Compte google n'existe pas en BD, création du compte
        if($utilisateur == null) {
        
            $utilisateur = $utilisateurManager->addUtilisateur($payload);
            $_SESSION['courriel'] = $utilisateur->get_courriel();
            $_SESSION['role'] = $utilisateur->get_role_utilisateur();
        }
        // Compte existe, utilisateur mis en session
        else {

            $_SESSION['courriel'] = $utilisateur->get_courriel();
            $_SESSION['role'] = $utilisateur->get_role_utilisateur();

        }

    } else {
        // Invalid ID token
    }
    require('controller/controllerAccueil.php');
    listProduits($langue);
}

function deleteAutoLogin() {
    require('model/AutologManager.php');
    $am = new AutologManager();
    if(isset($_COOKIE['rememberMe'])) {
        $am->removeValide($am->verifyToken(json_decode($_COOKIE['rememberMe'])->user_id,json_decode($_COOKIE['rememberMe'])->token));
        setcookie('rememberMe', "", time()+1);
        //session_destroy();
    }
    
    header("Refresh:0; url=index.php");
}

function inscription($result, $langue) {
    $um = new UtilisateurManager();
    if(isset($result)) {
        $resultat = $um->inscription($result);
        
        if($resultat!=null) {
            require('controller/controllerAccueil.php');
            
            require 'vendor/autoload.php';
            
            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->Host = 'localhost';
            $mail->Port = 1025;
            $mail->SMTPAuth = true;
            $mail->From = "jflabbepro@gmail.com";
            $mail->addReplyTo('moi@monCourriel.com', 'Votre nom');
            $mail->addAddress($result['courriel'], $result['prenom']);
            $mail->Subject = "Validation compte";
            $id = $resultat[1]->get_id_utilisateur();
            $token = $resultat[0];
            $mail->msgHTML('<a href="http://localhost/FichiersSiteWeb/index.php?action=validation&id=' . $id . '&token=' . $token . '">Cliquer ici pour activer votre compte</a>');
            echo '<a href="http://localhost/FichiersSiteWeb/index.php?action=validation&id=' . $id . '&token=' . $token . '">Cliquer ici pour activer votre compte</a>';


            if (!$mail->send())
                echo 'Erreur de Mailer : ' . $mail->ErrorInfo;
            else
                echo 'Le message a été envoyé.';

            listProduits($langue);
        }
        else {
            echo 'L\'utilisateur existe déjà';
            require('view/inscriptionView.php');
        }
    }
    else {
        echo 'L\'utilisateur existe déjà';
        require('view/inscriptionView.php');
    }
}

function checkTokenInscription($request, $langue) {
    $um = new UtilisateurManager();
    $utilisateur = $um->verifyToken($request['id'],$request['token']);
    
    if(isset($utilisateur)) {
        $um->verifyActif($utilisateur);
        require('controller/controllerAccueil.php');
    
        listProduits($langue);
    }
    else {
        echo 'Le token est invalide';
    }
}

