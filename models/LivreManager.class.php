<?php
require_once "Model.class.php";
require_once "Livre.class.php";

class LivreManager extends Model{
    private $livres;
    private $search;

    public function ajouterLivres($livre)
    {
        return $this->livres[] = $livre;
    }

    public function getLivres()
    {
        return $this->livres;
    }

    public function chargementLivres()
    {
        $request = $this->getBdd()->prepare("SELECT id,titre,nbrPage,image,idAuteur FROM livres ORDER BY titre ASC");
        $request->execute();
        $mesLivres = $request->fetchAll(PDO::FETCH_ASSOC);
        /* Debug
        echo "<pre>";
        print_r($mesLivres);
        echo "</pre>";
        */
        $request->closeCursor();

        foreach($mesLivres as $livre){
            $unLivre = new Livre($livre['id'],$livre['titre'],$livre['nbrPage'],$livre['image'], $livre['idAuteur']);
            $this->ajouterLivres($unLivre);
        }
    }


    public function getLivreById($id)
    {
        for ($i=0; $i < count($this->livres); $i++) 
        { 
            if ($this->livres[$i]->getId() === $id) 
            {
                return $this->livres[$i];
            }
        }
        throw new Exception("Le livre n'existe pas");
    }

    public function getLivreByAutor($id)
    {
        $livresAutor = [];
        for ($i=0; $i < count($this->livres); $i++)
        {
            if ($this->livres[$i]->getIdAuteur() === $id)
            {
                $livresAutor[] = $this->livres[$i];
            }
        }
        return $livresAutor;
    }

    public function rechercherUnLivreBdd($search)
    {
        $livres = [];
        $request =  "SELECT livres.id AS id, titre, nbrPage, livres.image AS image ,idAuteur FROM livres, auteurs WHERE (livres.idAuteur = auteurs.id) AND (livres.titre LIKE '%$search%' OR auteurs.nomComplet LIKE '%$search%')";
        $statement = $this->getBdd()->prepare($request);
        $statement->execute();
        $livresAutorSearch = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();

        foreach($livresAutorSearch as $livre){
            $unLivre = new Livre($livre['id'],$livre['titre'],$livre['nbrPage'],$livre['image'], $livre['idAuteur']);
            $livres[] = $unLivre;
        }

       /* echo "<pre>";
        print_r($livres);
        echo "</pre>";*/

        return $livres;

    }

    public function ajouteLivreBdd($titre,$nbrPage,$image,$idAuteur)
    {
        $request = "INSERT INTO livres (titre,nbrPage,image,idAuteur) VALUES (:titre, :nbrPage, :image, :idAuteur)";
        $statement = $this->getBdd()->prepare($request);
        $statement->bindValue(":titre", $titre, PDO::PARAM_STR);
        $statement->bindValue(":nbrPage", $nbrPage, PDO::PARAM_INT);
        $statement->bindValue(":image", $image, PDO::PARAM_STR);
        $statement->bindValue(":idAuteur", $idAuteur, PDO::PARAM_INT);
        $resultat = $statement->execute();
        $statement->closeCursor();

        if ($resultat > 0) {
            $livre = new Livre($this->getBdd()->lastInsertId(),$titre,$nbrPage,$image, $idAuteur);
            $this->ajouterLivres($livre);
        }
    }

    public function supprimerLivreBdd($id)
    {
        $request = "DELETE FROM livres WHERE id = :Id";
        $statement = $this->getBdd()->prepare($request);
        $statement->bindValue("Id", $id, PDO::PARAM_INT);
        $resultat = $statement->execute();
        $statement->closeCursor();

        if ($resultat > 0) {
            $livre = $this->getLivreById($id);
            unset($livre);
        }
    }

    public function modifierLivreBdd($id, $titre, $nbrPage, $image, $idAuteur)
    {
        $request = "UPDATE livres SET titre = :titre, nbrPage = :nbrPage, image = :image, idAuteur = :idAuteur WHERE id = :Id";
        $statement = $this->getBdd()->prepare($request);
        $statement->bindValue("Id", $id, PDO::PARAM_INT);
        $statement->bindValue("titre", $titre, PDO::PARAM_STR);
        $statement->bindValue("nbrPage", $nbrPage, PDO::PARAM_INT);
        $statement->bindValue("image", $image, PDO::PARAM_STR);
        $statement->bindValue("idAuteur", $idAuteur, PDO::PARAM_INT);
        $resultat = $statement->execute();
        $statement->closeCursor();

        if ($resultat > 0) {
            $this->getLivreById($id)->setTitre($titre);
            $this->getLivreById($id)->setTitre($nbrPage);
            $this->getLivreById($id)->setTitre($image);
            $this->getLivreById($id)->setIdAuteur($idAuteur);
        }
    }
}