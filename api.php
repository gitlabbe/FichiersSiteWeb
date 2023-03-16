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
                            listProduits(true);
                        }





                        break;
                    case 'POST':
                        echo 'METHODE POST';
                        break;
                    case 'PUT':
                        echo 'METHODE PUT';
                        break;
                    case 'DELETE':
                        echo 'METHODE DELETE';
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