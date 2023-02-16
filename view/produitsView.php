<?php $title = 'Produits'?>

<?php ob_start(); ?>

<?php     

 if (isset($categorie)) {
    $titreH1 = '<h1>Les produits de catégorie ' . $categorie . '</h1>';
 } else {
    $titreH1 = '<h1>Les produits</h1>';
 }
 ?>

<?php echo $titreH1;
//echo ($produits[0]->get_produit());

//print_r ($categoriesArray);
//echo (sizeof($categoriesArray));
//echo ($categoriesArray['_categorie'][0]);

?>

 <!-- Petit + pour ajouter un produit -->
 <input class="littleIcon" type="image" src="./inc/img/add-icon.png" alt="Ajouter un produit" />

<!-- Formulaire caché de GESTION DE PRODUIT -->
<form action="index.php" method="post" class="ajouterProduit">
    <fieldset>
        <label for="produit">Produit : </label>        
        <input type="text" name="produit" id="produit">
        
        <select name="categorie" id="categorie">Catégorie :
            <?php 
            
                for ($i = 0; $i < sizeof($categoriesArray); $i++) {                    // sizeof de la liste
                    echo '<option value="' . $categoriesArray['produit'][$i] . '">' . '</option>'; // si marche pas , add une valeur ici
                }
            
            ?>
        </select>

        <label for="description">Description : </label>        
        <input type="text" name="description" id="description"><br>

        <input type="hidden" name="action" value="authentifier">
        <button type="submit">Se connecter</button>

    </fieldset>
</form> 



<?php foreach($produits as $produit) { ?>
    <div class="sectionProduit">
        <h3>Produit: <?= htmlspecialchars($produit->get_produit()) ?> </h3>
        <input class="littleIcon" type="image" src="./inc/img/delete-icon.png" alt="Supprimer un produit" value="<?= htmlspecialchars($produit->get_id_produit()) ?>" />
        <p>Description: <?= htmlspecialchars($produit->get_description()) ?> </p>        
        <hr>
    </div>
<?php } ?>

    <div>
        <button id='bouton_ajax'>Appuyer Ici</button>
    </div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>