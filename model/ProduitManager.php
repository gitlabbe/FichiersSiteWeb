<?php

// Ce fichier sert à communiquer avec la BD et construire les objets pour les retourner au controleur.
// Ces fonctions sont généralement appelé par le routeur (index.php) ou d'autres contrôleurs.

require_once("model/Manager.php");
require_once("model/Produit.php");

class ProduitManager extends Manager
{
    public function getProduits($langue)
    {
        $db = $this->dbConnect();
        $req = $db->query(str_replace(':lang', $langue, 'SELECT id_produit, id_categorie, produit_:lang AS produit, description_:lang AS description FROM tbl_produit'));

        $produits = array();

        while($data = $req->fetch()){
            array_push($produits, new Produit($data));
        }

        $req->closeCursor();
        return $produits;
    }

    public function getProduit($produitId, $langue)
    {
        $db = $this->dbConnect();
        $req = $db->prepare(str_replace(':lang', $langue, 'SELECT p.id_produit, p.id_categorie AS categorie, p.produit_:lang AS produit, p.description_:lang AS description FROM tbl_produit AS p INNER JOIN tbl_categorie AS c ON p.id_categorie = c.id_categorie WHERE id_produit = ?')); 
        $req->execute(array($produitId));
        
        $produit = new Produit($req->fetch());

        print_r($produit);

        return $produit;
    }

    public function getProduitsCategorie($categorieId, $langue)
    {
        $db = $this->dbConnect();
        $req = $db->prepare(str_replace(':lang', $langue, 'SELECT p.id_produit, p.id_categorie, p.produit_:lang AS produit, p.description_:lang AS description FROM tbl_produit AS p INNER JOIN tbl_categorie AS c ON p.id_categorie = c.id_categorie WHERE p.id_categorie = ?'));
        $req->execute(array($categorieId));
        $produitsArray = array();
        
        foreach ($req->fetchAll() as $produit) {
            array_push($produitsArray, new Produit($produit));
        }

        return $produitsArray;
    }

    public function addProduit($categorie, $produit, $description) {

        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO `tbl_produit` (`id_categorie`,`produit`,`description`) VALUES (:id_categorie, :produit, :description)');
        $req->execute(array(':id_categorie'=>$categorie, 'produit'=>$produit, ':description'=>$description));
        
        return $db->lastInsertId();

    }

    public function deleteProduit($idProduit) {

        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM `tbl_produit` WHERE `id_produit` = ?');
        $req->execute(array($idProduit));

    }

    public function getAllIdProduit() {

        $db = $this->dbConnect();
        $req = $db->query('SELECT id_produit FROM `tbl_produit`');

        $produitsId = array();

        while($data = $req->fetch()){
            array_push($produitsId, new Produit($data));
        }

        $req->closeCursor();
        return $produitsId;

    }
    
}