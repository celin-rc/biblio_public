<?php
ob_start();

if (!empty($_SESSION['alert'])) :
?>
    <div class="alert alert-dismissible alert-<?= $_SESSION['alert']['type'] ?>">
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      <strong><?= $_SESSION['alert']['message'] ?></strong>.
    </div>
<?php 
unset($_SESSION['alert']);
endif; ?>
    
<div class="row align-items-start">
    <div class="col-6">
        <img style="width: 100%; height: 755px; object-fit: fill;" src="/assets/image/<?= $livre->getImage(); ?>" alt="alt_<?= $livre->getTitre(); ?>">
    </div>
    <div class="col-6">
        <div class="card text-white bg-primary mb-3">
            <div class="card-header">INFORMATIONS</div>
            <div class="card-body">
                <h4 class="card-title">Titre : <?= $livre->getTitre(); ?></h4>
                <p class="card-text">Pages : <?= $livre->getNbrPage(); ?></p>
                <p class="card-text">Auteur : 
                <?php
                    for($j=0; $j < count($auteurs); $j++) :
                    if($livre->getIdAuteur() == $auteurs[$j]->getId()) : ?>
                        <a href="<?= URL ?>auteurs/voire/<?= $auteurs[$j]->getId(); ?>" class="text-reset text-decoration-none"><?= strtoupper($auteurs[$j]->getNomComplet()); ?></a>
                   <?php endif;
                    endfor;
                ?>
                </p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-6 ">
                <a href="<?= URL ?>livres/modifier/<?= $livre->getId(); ?>" class="btn btn-outline-info" style="width: 100%;">Modifier</a>
            </div>
            <form class="col-6" method="POST" action="<?= URL ?>livres/supprimer/<?= $livre->getId(); ?>" 
            onsubmit="return confirm('Vous êtes sur de vouloire supprimer ce livre ?');">
                <button type="submit" class="btn btn-outline-danger" style="width: 100%;">Supprimer</button>
            </form>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
$title = $livre->getTitre();
require "template.php";
?>
