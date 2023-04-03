<?php $titreH1 = _("Les produits") ?>

<?php $title = _('Produit') . $produit->get_produit(); ?>

<?php ob_start(); ?>
<h1><?= $titreH1; ?></h1>

    <div>
        <h3><?=_('Catégorie:')?> <?= htmlspecialchars($produit->get_categorie()) ?> </h3>        
        <p><?=_('Description:')?> <?= htmlspecialchars($produit->get_description()) ?> </p>        
    </div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>