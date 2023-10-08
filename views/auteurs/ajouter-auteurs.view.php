<?php 
ob_start()
?>

<form method="POST" action="<?= URL ?>/auteurs/post-auteur" enctype="multipart/form-data">
    <div class="mb-3 form-group">
        <label for="nomComplet" class="form-label">Nom et Prénom(s) :</label>
        <input name="nomComplet" id="nomComplet" class="form-control form-control-lg" type="text" placeholder="Entrez le nom de l'auteur" aria-label="Le nom de l'auteur" required>
    </div>
    <div class="mb-3 form-group">
        <label for="biographie" class="form-label">Biographie :</label>
        <textarea name="biographie" id="biographie" class="form-control form-control-lg" placeholder="Entrez le biographie de l'auteur" aria-label="Le biographie de l'auteur" required></textarea>
    </div>
    <div class="mb-3 form-group">
        <label for="image" class="form-label">Photo :</label>
        <input name="image" id="image" class="form-control form-control-lg" type="file" placeholder="Entrez l'image de couverture du livre" aria-label="L'image de couverture du livre" required>
    </div>
    <button type="submit" class="btn btn-primary">Enregistrer</button>
</form>

<?php
$content = ob_get_clean();
$title = "Ajouter un nouveau auteur";
require "template.php";
?>