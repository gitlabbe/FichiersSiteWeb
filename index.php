<?php
if(!isset($_SESSION)) {
    session_start();
}
//Est-ce qu'un paramètre action est présent
if (isset($_REQUEST['action'])) {

    //Est-ce que l'action demandée est la liste des produits
    if ($_REQUEST['action'] == 'produits') {
        //Ajoute le controleur de Produit
        require('controller/controllerProduit.php');
        //Appel la fonction listProduits contenu dans le controleur de Produit
        listProduits();
    }
    // Sinon est-ce que l'action demandée est la description d'un produit
    elseif ($_REQUEST['action'] == 'produit') {
        
        // Est-ce qu'il y a un id en paramètre
        if (isset($_REQUEST['id']) && $_REQUEST['id'] > 0) {
            //Ajoute le controleur de Produit
            require('controller/controllerProduit.php');
            //Appel la fonction produit contenu dans le controleur de Produit
            produit($_REQUEST['id']);
        }
        else {
            //Si on n'a pas reçu de paramètre id, mais que la page produit a été appelé
            echo 'Erreur : aucun identifiant de produit envoyé';
        }
    }
    elseif ($_REQUEST['action'] == 'categories') {

        require('controller/controllerCategorie.php');
        listCategories();
    }
    elseif ($_REQUEST['action'] == 'produitscategorie'){

        if (isset($_REQUEST['id']) && $_REQUEST['id'] > 0) {
            //Ajoute le controleur de Produit
            require('controller/controllerProduit.php');

            listProduitsCategorie($_REQUEST['id']);
        }
    }
    elseif ($_REQUEST['action'] == 'connexion') {

        require('controller/controllerUtilisateur.php');
        
        getFormConnexion();
    }
    elseif ($_REQUEST['action'] == 'authentifier') {
        if (isset($_REQUEST['courriel']) && isset($_REQUEST['password'])) {
            require('controller/controllerUtilisateur.php');
            authentifier($_REQUEST);
        }
        
    }
    elseif ($_REQUEST['action'] == 'deconnexion') {

        require('controller/controllerUtilisateur.php');
        deconnexion();
    }
    elseif ($_REQUEST['action'] == 'delete') {

        require('controller/controllerUtilisateur.php');
        deleteAutoLogin();
    }
    elseif ($_REQUEST['action'] == 'inscrire') {

        require('view/inscriptionView.php');
    }
    elseif ($_REQUEST['action'] == 'inscription') {

        require('controller/controllerUtilisateur.php');
        inscription($_REQUEST);
    }
    elseif ($_REQUEST['action'] == 'validation') {

        require('controller/controllerUtilisateur.php');
        checkTokenInscription($_REQUEST);
    }
    elseif ($_REQUEST['action'] === 'ajouterProduit') {

        require('controller/controllerProduit.php');
        ajouterProduit($_REQUEST);
    }
    elseif ($_REQUEST['action'] === 'supprimerProduit') {
        
        require('controller/controllerProduit.php');
        supprimerProduit($_REQUEST);
    }
    elseif ($_REQUEST['action'] === 'testAjax') {
        
        print_r($_REQUEST);

        #if (isset($_REQUEST['nom'])) {
		#	http_response_code(200);
		#	echo 'Succès : Bien reçu ' . htmlspecialchars($_REQUEST['nom']) . ' !';
		#	exit;
		#}
		#
		#else {
		#	http_response_code(400);
		#	echo 'Erreur : Votre nom n\'a pas été reçu !';
		#	exit;
		#}
    }

}
elseif (isset($_REQUEST['credential'])) {
    
    require('controller/controllerUtilisateur.php');
    
    authentificationGoogle($_REQUEST['credential']);
}
// Si pas de paramètre charge l'accueil
else {
    //Ajoute le controleur de Produit
    require('controller/controllerAccueil.php');
    //Appel la fonction listProduits contenu dans le controleur de Produit
    listProduits();
}