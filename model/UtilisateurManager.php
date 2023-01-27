<?php

require_once("model/Manager.php");
require_once("model/Utilisateur.php");

class UtilisateurManager extends Manager
{
    
    function verifAuthentification($courriel, $motPasse) {

        $utilisateur = getUtilisateurParCourriel($courriel);

        if($utilisateur != null) {
            if(password_verify($utilisateur->get_mdp(), $motPasse)) {
                return $utilisateur;
            }
            else {
                return null;
            }
        }

    }

    function getUtilisateurParCourriel($courriel) {

        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM tbl_produit WHERE courriel = ?');
        $req->execute(array($courriel));
        $utilisateur = new Utilisateur($req->fetch());

        if(isset($utilisateur)) {
            return $utilisateur;
        }
        else {
            return null;
        }
    }

}