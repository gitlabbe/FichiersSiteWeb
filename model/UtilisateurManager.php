<?php

require_once("model/Manager.php");
require_once("model/Utilisateur.php");

class UtilisateurManager extends Manager
{
    
    public function verifAuthentification($courriel, $motPasse) {

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

    public function getUtilisateurParCourriel($courriel) {

        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM tbl_utilisateur WHERE courriel = ?');
        $req->execute(array($courriel));

        $utilisateurTemp = $req->fetch();

        if($utilisateurTemp) {
            $utilisateur = new Utilisateur($utilisateurTemp);
            return $utilisateur;
        }
        else{
            return null;
        }

        #$db = $this->dbConnect();
        #$req = $db->prepare('SELECT * FROM tbl_utilisateur WHERE courriel = ?');
        #$req->execute(array($courriel));
#
        #$utilisateur = new Utilisateur($req->fetch());
#
        #if(isset($utilisateur)) {
        #    return $utilisateur;
        #}
        #else{
        #    return null;
        #}

        //$utilisateurInfos = $req->fetch();
        //
        //if($utilisateurInfos != NULL) {
        //    $utilisateur = new Utilisateur($utilisateurInfos);
        //    return $utilisateur;
        //}
        //else {
        //    return null;
        //}
    }

    public function addUtilisateur($infosUtilisateur) {

        print_r($infosUtilisateur);

        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO `tbl_utilisateur` (`nom`,`prenom`,`courriel`,`mdp`,`est_actif`,`role_utilisateur`,`type_utilisateur`) VALUES (:nom, :prenom, :courriel, :mdp, :est_actif, :role_utilisateur, :type_utilisateur)');
        $req->execute(array(':nom'=>$infosUtilisateur['name'],':prenom'=>$infosUtilisateur['given_name'],':courriel'=>$infosUtilisateur['email'],':mdp'=>password_hash($infosUtilisateur['sub'], PASSWORD_DEFAULT),':est_actif'=>'1',':role_utilisateur'=>'0',':type_utilisateur'=>'1'));
        
        return $utilisateur = new Utilisateur($req->fetch());

    }

    public function inscription($request) {
        if($this->getUtilisateurParCourriel($request['courriel'])==null) {

            require('model/Util.php');
            
            $utilManager = new Util();
            
            $db = $this->dbConnect();
            $req = $db->prepare('INSERT INTO `tbl_utilisateur` (`nom`,`prenom`,`courriel`,`mdp`,`est_actif`,`role_utilisateur`,`type_utilisateur`,`token`) VALUES (:nom, :prenom, :courriel, :mdp, :est_actif, :role_utilisateur, :type_utilisateur, :token)');
            $token = $utilManager->getToken(24);
            $req->execute(array(':nom'=>$request['nom'],':prenom'=>$request['prenom'],':courriel'=>$request['courriel'],':mdp'=>password_hash($request['mdp'], PASSWORD_DEFAULT),':est_actif'=>'0',':role_utilisateur'=>'0',':type_utilisateur'=>'0', ':token'=>password_hash($token,PASSWORD_DEFAULT)));
            
            $utilisateur = $this->getUtilisateurParCourriel($request['courriel']);
            
            return array($token,$utilisateur);

        }
        else {
            return null;
        }
    }

    public function verifyToken($idUtilisateur, $token) {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM `tbl_utilisateur` WHERE id_utilisateur = ?');
        $req->execute(array($idUtilisateur));
        $resultat = $req->fetchAll();
        
        foreach($resultat as $value) {
            if(password_verify($token,$value['token'])) {
                $utilisateur = new Utilisateur($value);
                return $utilisateur;
            }
        }
        return null;
    }

    public function verifyActif($utilisateur) {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE `tbl_utilisateur` SET `est_actif`=1 WHERE id_utilisateur = ?');
        $req->execute(array($utilisateur->get_id_utilisateur()));
        $utilisateur2 = $this->get_actif($utilisateur);
        
        if($utilisateur!=null) {
            return $utilisateur2;
        }
        else{
            return null;
        }
    }

    public function get_actif($utilisateur) {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM `tbl_utilisateur` WHERE id_utilisateur = ? AND est_actif = 1');
        $req->execute(array($utilisateur->get_id_utilisateur()));
        $resultat = $req->fetch();
        
        if($resultat!=null) {
            $utilisateur = new Utilisateur($resultat);
            return $utilisateur;
        }
            
        return null;
    }

}