<?php

require('model/ProduitManager.php');

function listProduits()
{
    $produitManager = new ProduitManager();
    $produits = $produitManager->getProduits();

    require('controller/controllerCategorie.php');
    $categorieManager = new CategorieManager();
    $categories = $categorieManager->getCategories();

    require('view/produitsView.php');
}

function produit($idProduit)
{
    $produitManager = new ProduitManager();
    $produit = $produitManager->getProduit($idProduit);    

    require('view/produitView.php');
}

function listProduitsCategorie($idCategorie) {

    $produitManager = new ProduitManager();
    $produits = $produitManager->getProduitsCategorie($idCategorie);

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