<?php

require_once("model/Manager.php");
require_once("model/Utilisateur.php");

class UtilisateurManager extends Manager
{
    
    function verifAuthentification($courriel, $motPasse) {

        $utilisateur = $this->getUtilisateurParCourriel($courriel);

        if($utilisateur != null) {
            if(password_verify($motPasse, $utilisateur->get_mdp())) {
                return $utilisateur;
            }
            else {
                return null;
            }
        }

        return null;

    }

    function getUtilisateurParCourriel($courriel) {

        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM tbl_utilisateur WHERE courriel = ?');
        $req->execute(array($courriel));
        $utilisateurInfos = $req->fetch();
        
        if($utilisateurInfos != NULL) {
            $utilisateur = new Utilisateur($utilisateurInfos);
            return $utilisateur;
        }
        else {
            return null;
        }
    }

    function addUtilisateur($infosUtilisateur) {

        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM tbl_utilisateur WHERE courriel = ?');
        $req->execute(array($courriel));
        $utilisateurInfos = $req->fetch();

    }

}