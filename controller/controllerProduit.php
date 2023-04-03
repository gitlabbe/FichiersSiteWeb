<?php

require('model/ProduitManager.php');

function listProduits($langue, bool $estAPI = false)
{
    $produitManager = new ProduitManager();
    $produits = $produitManager->getProduits($langue);

    require('controller/controllerCategorie.php');  // BRISE TOUT, FAUDRAIT QUE CATEGORIE SE FASSE DIRECTEMENT DANS PRODUITMANAGER (REGARDER GITHUB)
    $categorieManager = new CategorieManager();
    $categories = $categorieManager->getCategories($langue);

    if (!$estAPI) {
        require('view/produitsView.php');
      }
      else {
          return json_encode($produits, JSON_PRETTY_PRINT);
      }
}

function produit($idProduit, $langue, bool $estAPI = false)
{
    $produitManager = new ProduitManager();
    $produit = $produitManager->getProduit($idProduit, $langue);    

    if (!$estAPI) {
      require('view/produitView.php');  
    }
    else {
        return json_encode($produit, JSON_PRETTY_PRINT);
    }
    
}

function listProduitsCategorie($idCategorie, $langue) {

    $produitManager = new ProduitManager();
    $produits = $produitManager->getProduitsCategorie($idCategorie, $langue);

    $categorie = $produits[0]->get_categorie();

    //$categoriesArray = $produitManager->getAllCategories();

    require('view/produitsView.php');
}

function ajouterProduit($request) {

    $produitManager = new ProduitManager();
    return $produitManager->addProduit($request['categorie'], $request['nomProduit'], $request['description']);

}

function supprimerProduit($request) {

    $produitManager = new ProduitManager();
    $produitManager->deleteProduit($request['idProduit']);

}

function listIdProduit() {

    $produitManager = new ProduitManager();
    $arrayInfos = $produitManager->getAllIdProduit();

    foreach($arrayInfos as $produitID) {
        $arrayIdProduit[] = $produitID->get_id_produit();
    }

    return $arrayIdProduit;
}