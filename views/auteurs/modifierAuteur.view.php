<?php 
ob_start();
?>

<form method="POST" action="<?= URL ?>/auteurs/validerModification" enctype="multipart/form-data">
    <div class="mb-3 form-group">
        <label for="nomComplet" class="form-label">Nom :</label>
        <input name="nomComplet" id="nomComplet" class="form-control form-control-lg" value="<?= $auteur->getNomComplet() ?>" type="text" placeholder="Entrez le nom de l'auteur" aria-label="Le nom de l'auteur" required>
    </div>
    <div class="mb-3 form-group">
        <label for="biographie" class="form-label">Biographie :</label>
        <textarea name="biographie" id="biographie" class="form-control form-control-lg" placeholder="Entrez le biographie de l'auteur" aria-label="Le biographie de l'auteur" required><?= $auteur->getBiographie() ?></textarea>
    </div>
    <div>
        <h3>Photo :</h3>
        <img src="/assets/image/auteurs/<?= $auteur->getImage() ?>" class="img-fluid" alt="<?= $auteur->getNomComplet() ?>">
    </div>
    <div class="mb-3 form-group">
        <label for="image" class="form-label">Photo :</label>
        <input name="image" id="image" class="form-control form-control-lg" type="file" placeholder="Entrez l'image de couverture du livre" aria-label="L'image de couverture du livre">
    </div>
    <input type="hidden" name="IdAuteur" value="<?= $auteur->getId() ?>" >
    <button type="submit" class="btn btn-primary">Enregistrer</button>
</form>

<?php 
$title = "Modification d'auteur : ".$auteur->getNomComplet();
$content = ob_get_clean();
require "template.php";

?>