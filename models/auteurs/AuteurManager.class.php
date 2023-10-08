<?php

require_once "./models/Model.class.php";
require_once "Auteur.class.php";

class AuteurManager extends Model{

    private $auteurs;

    public function ajouterAuteurs($auteur)
    {
        return $this->auteurs[] = $auteur;
    }

    public function getAuteurs()
    {
        return $this->auteurs;
    }

    public function chargementAuteurs()
    {
        $request = $this->getBdd()->prepare("SELECT id,nomComplet,image,biographie FROM auteurs ORDER BY nomComplet ASC");
        $request->execute();
        $mesAuteurs = $request->fetchAll(PDO::FETCH_ASSOC);
        $request->closeCursor();

        foreach($mesAuteurs as $auteur){
            $unAuteur = new Auteur($auteur['id'],$auteur['nomComplet'],$auteur['image'],$auteur['biographie']);
            $this->ajouterAuteurs($unAuteur);
        }
        
    }

    public function getAuteurById($id)
    {
        for ($i=0; $i < count($this->auteurs); $i++) { 
            if ($this->auteurs[$i]->getId() === $id) {
                return $this->auteurs[$i];
            }
        }
        throw new Exception("L'auteur n'existe pas");
    }

    public function ajouteAuteurBdd($nomComplet, $image, $biographie)
    {
        $request = "INSERT INTO auteurs (nomComplet,image,biographie) VALUES (:nomComplet,:image,:biographie)";
        $statement = $this->getBdd()->prepare($request);
        $statement->bindValue("nomComplet",$nomComplet,PDO::PARAM_STR);
        $statement->bindValue("image",$image,PDO::PARAM_STR);
        $statement->bindValue("biographie",$biographie,PDO::PARAM_STR_CHAR);
        $resultat = $statement->execute();
        $statement->closeCursor();

        if ($resultat > 0) {
            $auteur = new Auteur($this->getBdd()->lastInsertId(),$nomComplet,$image,$biographie);
            $this->ajouterAuteurs($auteur);
        }
    }

    public function supprimerAuteurBdd($id)
    {
        $request = "DELETE FROM auteurs WHERE id = :Id";
        $statement = $this->getBdd()->prepare($request);
        $statement->bindValue("Id", $id, PDO::PARAM_INT);
        $resultat = $statement->execute();
        $statement->closeCursor();

        if ($resultat > 0) {
            $auteur = $this->getAuteurById($id);
            unset($auteur);
        }
    }

    public function modifierAuteurBdd($id, $nomComplet, $image, $biographie){
        $request = "UPDATE auteurs SET nomComplet = :nomComplet, image = :image, biographie = :biographie WHERE id = :Id";
        $statement = $this->getBdd()->prepare($request);
        $statement->bindValue("Id", $id, PDO::PARAM_INT);
        $statement->bindValue("nomComplet", $nomComplet, PDO::PARAM_STR);
        $statement->bindValue("image", $image, PDO::PARAM_STR);
        $statement->bindValue("biographie", $biographie,PDO::PARAM_STR_CHAR);
        $resultat = $statement->execute();
        $statement->closeCursor();

        if ($resultat > 0) {
            $this->getAuteurById($id)->setNomComplet($nomComplet);
            $this->getAuteurById($id)->setImage($image);
            $this->getAuteurById($id)->setBiographie($biographie);
        }
    }


}