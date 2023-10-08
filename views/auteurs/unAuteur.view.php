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
        <img style="width: 100%; height: 455px; object-fit: fill;" src="/assets/image/auteurs/<?= $auteur->getImage(); ?>" alt="alt_<?= $auteur->getNomComplet(); ?>">
    </div>
    <div class="col-6">
        <div class="card text-white bg-primary mb-3">
            <div class="card-header">INFORMATIONS</div>
            <div class="card-body">
                <h4 class="card-title">Nom et Prenom(s) : <?= strtoupper($auteur->getNomComplet()); ?></h4>
            </div>
            <div class="card-body bg-white mb-1">
                <p class="card-text text-black"><?=$auteur->getBiographie(); ?></p>
            </div>
        </div>

        <?php if (count((array)$livres) > 0) : ?>
        <div>
            <h5>Ces livres : </h5>
            <ul>
            <?php 
                for($i=0; $i < count($livres); $i++) : ?>
                    <li>
                        <a href="<?= URL ?>livres/voire/<?= $livres[$i]->getId(); ?>" class="text-reset text-decoration-none"><?= $livres[$i]->getTitre(); ?></a>
                    </li>
            <?php 
                endfor; 
                ?>
            </ul>
        </div>

        <?php endif;?>
        
        <div class="row mb-5">
            <div class="col-6 ">
                <a href="<?= URL ?>auteurs/modifier/<?= $auteur->getId(); ?>" class="btn btn-outline-info" style="width: 100%;">Modifier</a>
            </div>
            <form class="col-6" method="POST" action="<?= URL ?>auteurs/supprimer/<?= $auteur->getId(); ?>" 
            onsubmit="return confirm('Vous êtes sur de vouloire supprimer ce livre ?');">
                <button type="submit" class="btn btn-outline-danger" style="width: 100%;">Supprimer</button>
            </form>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
$title = strtoupper($auteur->getNomComplet());
require "template.php";
?>
