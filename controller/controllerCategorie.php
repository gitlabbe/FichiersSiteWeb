<?php

require('model/CategorieManager.php');

function listCategories()
{
    $categorieManager = new CategorieManager();
    $categories = $categorieManager->getCategories();

    require('view/categoriesView.php');
}

//function produit($idProduit)
//{
//    $produitManager = new ProduitManager();
//    $produit = $produitManager->getProduit($idProduit);    
//
//    require('view/produitView.php');
//}