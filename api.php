<?php
    header('Content-Type: application/json');

    if (isset($_REQUEST['objet'])) {
        switch ($_REQUEST['objet']) {
            case 'produit':
                switch ($_SERVER["REQUEST_METHOD"]) {
                    case 'GET':

                        require('controller/controllerProduit.php');

                        if(isset($_REQUEST['id'])) {

                            $json_produit = produit($_REQUEST['id'], true);
                            $json_produit_decode = json_decode($json_produit, true); // A DEMANDER AU PROF
                            
                            if(intval($_REQUEST['id']) > 0 && $json_produit_decode['id_produit'] !== null) {
                                http_response_code(200);
                                echo produit($_REQUEST['id'], true);
                            }
                            else {
                                http_response_code(400);
                                echo '{"ÉCHEC" : "Aucun produit ne correspond à votre requête."}';
                            }
                        }
                        else {

                            http_response_code(200);
                            echo listProduits(true);
                        }

                        break;

                    case 'POST':

                        $infosNouveauProduit = json_decode(file_get_contents('php://input'), true);

                        if ($infosNouveauProduit['nomProduit'] !== null && $infosNouveauProduit['categorie'] !== null && $infosNouveauProduit['description'] !== null) {
                            
                            if(is_numeric($infosNouveauProduit['categorie'])) {

                                require('controller/controllerCategorie.php');
                                $categorieArray = listIdCategories();

                                if(in_array($infosNouveauProduit['categorie'], $categorieArray)) {

                                    require('controller/controllerProduit.php');
                                    ajouterProduit($infosNouveauProduit);

                                    http_response_code(200);
                                    echo '{"SUCCÈS" : "L\'ajout du produit a fonctionné."}';
                                }
                                else {
                                    http_response_code(400);
                                    echo '{"ÉCHEC" : "L\'ajout du produit a échoué. L\'id de la catégorie n\'existe pas en BD."}';
                                }

                            }
                            else {
                                http_response_code(400);
                                echo '{"ÉCHEC" : "L\'ajout du produit a échoué. L\'id de la catégorie n\'est pas un nombre."}';
                            }

                        }
                        else {
                            http_response_code(400);
                            echo '{"ÉCHEC" : "L\'ajout du produit a échoué. Un des champs est manquant."}';
                        }

                        break;

                    case 'PUT':
                        echo 'METHODE PUT';
                        break;


                    case 'DELETE':
                        
                        require('controller/controllerProduit.php');
                        $produitArray = listIdProduit();

                        if(isset($_REQUEST['idProduit']) && intval($_REQUEST['idProduit']) > 0 && in_array($_REQUEST['idProduit'], $produitArray)) {

                            supprimerProduit($_REQUEST);

                            http_response_code(200);
                            echo '{"SUCCÈS" : "La suppression du produit a fonctionné."}';
                            
                        }
                        else {
                            http_response_code(400);
                            echo '{"ÉCHEC" : "Aucun produit ne correspond à votre requête. L\'ID du produit est erroné"}';
                        }
                        
                        break;

                    default:
                        http_response_code(400);
                        echo '{"ÉCHEC" : "Seuls GET, POST, PUT ou DELETE sont permis."}';
                }
                break;
            default:
                http_response_code(400);
                echo '{"ÉCHEC" : "Seuls les produits peuvent être traités."}';
        }
    }
?>