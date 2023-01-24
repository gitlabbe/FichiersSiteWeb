<?php $title = 'Categories'?>

<?php ob_start(); ?>
<h1>Les catégories</h1>

<?php foreach($categories as $categorie) { ?>
    <div>
        <h3>Catégories: <?= htmlspecialchars($categorie->get_categorie()) ?> </h3>        
        <p>Description: <?= htmlspecialchars($categorie->get_description()) ?> </p>
        <a href=<?= "produitscategorie/" . $categorie->get_id_categorie() . ""?>>Voir la catégorie</a>
    <hr>
    </div>
<?php } ?>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>