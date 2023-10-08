<?php 
ob_start()
?>

<form method="POST" action="<?= URL ?>/livres/post-livre" enctype="multipart/form-data">
    <div class="mb-3 form-group">
        <label for="titre" class="form-label">Titre :</label>
        <input name="titre" id="titre" class="form-control form-control-lg" type="text" placeholder="Entrez le titre du livre" aria-label="Le titre du livre" required>
    </div>
    <div class="mb-3 form-group">
        <label for="nbrPage" class="form-label">Nombre de page :</label>
        <input name="nbrPage" id="nbrPage" class="form-control form-control-lg" type="number" placeholder="Entrez le nombre de page du livre" aria-label="Le nombre de page du livre" required>
    </div>
    <div class="mb-3 form-group">
        <label for="image" class="form-label">Image de couverture :</label>
        <input name="image" id="image" class="form-control form-control-lg" type="file" placeholder="Entrez l'image de couverture du livre" aria-label="L'image de couverture du livre" required>
    </div>
    <div class="mb-3 form-group">
        <label for="idAuteur" class="form-label">Auteur :</label>
        <select name="idAuteur" id="idAuteur" class="form-control form-control-lg" selected>
            <option>-- Choisissez un auteur --</option>
            <?php
            for($i=0; $i < count($auteurs); $i++) : ?>
            <option value="<?= $auteurs[$i]->getId();?>"><?= $auteurs[$i]->getNomComplet(); ?> </option>
            <?php 
             endfor; 
            ?>
        </select>
    </div>
    
    <button type="submit" class="btn btn-primary">Enregistrer</button>
</form>

<?php
$content = ob_get_clean();
$title = "Ajouter un nouveau livre";
require "template.php";
?>