<?php $title = 'Produits'?>

<?php ob_start(); ?>

<?php     

 if (isset($categorie)) {
    $titreH1 = '<h1 id="titreProduit">Les produits de catégorie ' . $categorie . '</h1>';
 } else {
    $titreH1 = '<h1 id="titreProduit">Les produits</h1>';
 }
 ?>

<?php echo $titreH1;

?>

 <!-- Petit + pour ajouter un produit -->
 <input id="boutonAjouterProduit" class="littleIcon" type="image" src="./inc/img/add-icon.png" alt="Ajouter un produit" />

<!-- Formulaire caché de GESTION DE PRODUIT -->
<form action="index.php" method="post" id="formAjouterProduit" class="hidden">
    <fieldset>
        <legend>
            Gestion d'un produit
        </legend>

        <label for="produit">Produit : </label>     
        <input type="text" name="produit" id="produit"><br/> 
        
        <label for="categorie">Catégorie :</label>
        <select name="categorie" id="categorie">
            <?php 
            
                for ($i = 0; $i < sizeof($categories); $i++) {
                    echo '<option value="' . $categories[$i]->get_id_categorie() . '">' . $categories[$i]->get_categorie() . '</option>'; // si marche pas , add une valeur ici
                }
            
            ?>
        </select><br/> 

        <label for="description">Description : </label>        
        <input type="text" name="description" id="description"><br>

        <input type="hidden" name="action" value="ajouterProduit">
        <button type="submit">Envoyer</button>

    </fieldset>
</form> 



<?php foreach($produits as $produit) { ?>
    <div class="sectionProduit">
        <h3>Produit: <?= htmlspecialchars($produit->get_produit()) ?> </h3>
        <input class="littleIcon boutonSupprimerProduit" type="image" src="./inc/img/delete-icon.png" alt="Supprimer un produit" value="<?= htmlspecialchars($produit->get_id_produit()) ?>" />
        <p>Description: <?= htmlspecialchars($produit->get_description()) ?> </p>        
        <hr>
    </div>
<?php } ?>

    <div>
        <button id='bouton_ajax'>Appuyer Ici</button>
    </div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>