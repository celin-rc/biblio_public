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
  <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
  <li class="breadcrumb-item active">Livres</li>
</ol>
<a href="<?= URL ?>livres/ajouter/" class="btn btn-success mb-2">Nouveau Livre</a>
<table class="table table-hover text-center">
  <thead>
    <tr class="table-dark">
      <th scope="col">Image</th>
      <th scope="col">Titre</th>
      <th scope="col">Nombre de page</th>
      <th scope="col">Auteur</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php 
     if (count((array)$livres) > 0){
    for($i=0; $i < count($livres); $i++) : ?>
    <tr>
      <td class="align-middle"><img src="/assets/image/<?= $livres[$i]->getImage(); ?>" alt="alt_<?= $livres[$i]->getTitre(); ?>" width="60px"></td>
      <th scope="row" class="align-middle"><?= $livres[$i]->getTitre(); ?></th>
      <td class="align-middle"><?= $livres[$i]->getNbrPage(); ?></td>
      <td class="align-middle">
      
        <?php
        for($j=0; $j < count($auteurs); $j++) :
          if($livres[$i]->getIdAuteur() == $auteurs[$j]->getId()) : ?>
            <a href="<?= URL ?>auteurs/voire/<?= $auteurs[$j]->getId(); ?>" class="text-reset text-decoration-none"><?= strtoupper($auteurs[$j]->getNomComplet()); ?></a>
        <?php  endif;
        endfor;
       ?></td>
      <td class="align-middle">
      <a href="<?= URL ?>livres/voire/<?= $livres[$i]->getId(); ?>" class="btn btn-outline-dark">Voire +</a>
      </td>
    </tr>
    <?php 
    endfor; 
  }else{
?>
 <tr>
      <td colspan="5" class="align-middle"><h3>Liste de livres est vide !</h3></td>
 </tr>
<?php 
  }
?>
  </tbody>
  <tfoot>
    <tr class="table-dark">
      <th scope="col">Image</th>
      <th scope="col">Titre</th>
      <th scope="col">Nombre de page</th>
      <th scope="col">Auteur</th>
      <th scope="col">Action</th>
    </tr>
  </tfoot>
</table>

<?php 
$title = "Livres de la Bibliothèque PUBLIC";
$content = ob_get_clean();
require "template.php";
?>