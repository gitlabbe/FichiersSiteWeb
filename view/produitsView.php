<?php $title = 'Produits'?>

<?php ob_start(); ?>

<?php     

 if (isset($categorie)) {
    $titreH1 = '<h1>Les produits de catégorie ' . $categorie . '</h1>';
 } else {
    $titreH1 = '<h1>Les produits</h1>';
 }


?>

<?php echo $titreH1;?>

<?php foreach($produits as $produit) { ?>
    <div>
        <h3>Produit: <?= htmlspecialchars($produit->get_produit()) ?> </h3>        
        <p>Description: <?= htmlspecialchars($produit->get_description()) ?> </p>        
        <hr>
    </div>
<?php } ?>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>