<?php $title = _('Catégories')?>

<?php ob_start(); ?>
<h1><?=_('Les catégories')?></h1>

<?php //print_r($arrayIdCategorie);?>

<?php foreach($categories as $categorie) { ?>
    <div>
        <h3><?=_('Les catégories')?> <?= htmlspecialchars($categorie->get_categorie()) ?> </h3>        
        <p><?=_('Description:')?> <?= htmlspecialchars($categorie->get_description()) ?> </p>
        <a href=<?= "index.php?action=produitscategorie&id=" . $categorie->get_id_categorie() . ""?>><?=_('Voir la catégorie')?></a>
    <hr>
    </div>
<?php } ?>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>