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

<ol class="breadcrumb mb-4 mt-3">
  <li class="breadcrumb-item"><a href="<?= URL ?>accueil">Accueil</a></li>
  <li class="breadcrumb-item active">Auteurs</li>
</ol>

<a href="<?= URL ?>auteurs/ajouter/" class="btn btn-success mb-2">Nouveau Auteur</a>

<div class="d-flex d-flex flex-wrap">
<?php 
  if (count((array)$auteurs) > 0){
    for($i=0; $i < count((array)$auteurs); $i++) : ?>
    <div class="card m-2" style="width: 19rem;">
      <img src="/assets/image/auteurs/<?= $auteurs[$i]->getImage(); ?>" alt="alt_<?= $auteurs[$i]->getNomComplet(); ?>" class="card-img-top" >
      <div class="card-body">
        <h5 class="card-title"><?= strtoupper($auteurs[$i]->getNomComplet()); ?></h5>
        <p class="card-text"><?= $extrait = (substr($auteurs[$i]->getBiographie(), 0, 70))."...";?></p>
        <a href="<?= URL ?>auteurs/voire/<?= $auteurs[$i]->getId(); ?>" class="btn btn-outline-dark">En savoir +</a>
      </div>
    </div>
<?php 
    endfor; 
  }else{
?>
<tr>
    <td colspan="5" class="align-middle"><h3>Liste d'auteurs est vide !</h3></td>
</tr>
<?php 
  }
?>
</div>


<?php 
$title = "Auteurs des livres";
$content = ob_get_clean();
require "template.php";

?>