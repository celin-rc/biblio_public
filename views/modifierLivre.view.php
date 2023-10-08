<?php 
ob_start();
?>

<form method="POST" action="<?= URL ?>/livres/validerModification" enctype="multipart/form-data">
    <div class="mb-3 form-group">
        <label for="titre" class="form-label">Titre :</label>
        <input name="titre" id="titre" class="form-control form-control-lg" type="text" value="<?= $livre->getTitre() ?>" placeholder="Entrez le titre du livre" aria-label="Le titre du livre" require>
    </div>
    <div class="mb-3 form-group">
        <label for="nbrPage" class="form-label">Nombre de page :</label>
        <input name="nbrPage" id="nbrPage" class="form-control form-control-lg" type="number" value="<?= $livre->getNbrPage() ?>" placeholder="Entrez le nombre de page du livre" aria-label="Le nombre de page du livre" require>
    </div>
    <div>
        <h3>Image de couverture :</h3>
        <img src="/assets/image/<?= $livre->getImage() ?>" class="img-fluid" alt="<?= $livre->getTitre() ?>">
    </div>
    <div class="mb-3 form-group">
        <label for="image" class="form-label">Image de couverture :</label>
        <input name="image" id="image" class="form-control form-control-lg" type="file" placeholder="Entrez l'image de couverture du livre" aria-label="L'image de couverture du livre" require>
    </div>
    <div class="mb-3 form-group">
        <label for="idAuteur" class="form-label">Auteur :</label>
        <select name="idAuteur" id="idAuteur" class="form-control form-control-lg" selected>
            <option>-- Choisissez un auteur --</option>
            <?php
            for($i=0; $i < count($auteurs); $i++) : ?>
            <option value="<?= $auteurs[$i]->getId();?>" 
            <?php 
                if($auteurs[$i]->getId() ==  $livre->getIdAuteur()) :
            ?>
            selected
            <?php 
                endif;
            ?>
            >
                <?= $auteurs[$i]->getNom()." ".$auteurs[$i]->getPrenom(); ?> 
            </option>
            <?php 
             endfor; 
            ?>
        </select>
    </div>
    <input type="hidden" name="IdLivre" value="<?= $livre->getId() ?>" >
    <button type="submit" class="btn btn-primary">Enregistrer</button>
</form>

<?php 
$title = "Modification du livre : ".$livre->getTitre();
$content = ob_get_clean();
require "template.php";

?>