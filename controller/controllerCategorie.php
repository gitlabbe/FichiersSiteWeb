<?php

require('model/CategorieManager.php');

function listCategories($langue, bool $estAPI = false)
{
    $categorieManager = new CategorieManager();
    $categories = $categorieManager->getCategories($langue);

    //$categorieManager2 = new CategorieManager();
    //$arrayInfos = $categorieManager2->getAllIdCategories();

    //foreach($arrayInfos as $categorieID) {
    //    $arrayIdCategorie[] = $categorieID->get_id_categorie();
    //}

    if (!$estAPI) {
        require('view/categoriesView.php');
    }
    else {
        return $categories;
    }
}

function listIdCategories() {

    $categorieManager = new CategorieManager();
    $arrayInfos = $categorieManager->getAllIdCategories();

    foreach($arrayInfos as $categorieID) {
        $arrayIdCategorie[] = $categorieID->get_id_categorie();
    }

    return $arrayIdCategorie;
}