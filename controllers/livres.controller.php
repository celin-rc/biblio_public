<?php

require_once "models/LivreManager.class.php";
require_once "models/auteurs/AuteurManager.class.php";

class LivresController
{
    private $livreManager;
    private $auteurManager;

    public function __construct()
    {
        $this->livreManager = new LivreManager();
        $this->livreManager->chargementLivres();
        $this->auteurManager = new AuteurManager();
        $this->auteurManager->chargementAuteurs();
    }

    public function afficherLivres()
    {
        $livres = $this->livreManager->getLivres();
        $auteurs = $this->auteurManager->getAuteurs();
        require "views/livres.view.php";
    }

    public function afficherLivre($id)
    {
        $livre = $this->livreManager->getLivreById($id);
        $auteurs = $this->auteurManager->getAuteurs();
        require "views/unLivre.view.php";
    }

    public function ajouterLivre()
    {
        $auteurs = $this->auteurManager->getAuteurs();
        require "views/ajouterLivre.view.php";
    }

    public function validationPostLivre()
    {
        $file = $_FILES['image'];
        $repertoire = "assets/image/";
        $nomImage = $this->ajouterImage($file, $repertoire);
        /*echo "<pre>";
        print_r($file);
        echo "</pre>";*/
        $this->livreManager->ajouteLivreBdd(trim($_POST['titre']),trim($_POST['nbrPage']),$nomImage,$_POST['idAuteur']);

        $_SESSION['alert'] = [
            "type" => "success",
            "message" => "Ajoute reuissie"
        ];

        header('Location: '. URL ."livres");
    }

    public function supprimerLivre($id)
    {
        $nomImage = $this->livreManager->getLivreById($id)->getImage();
        unlink("assets/image/".$nomImage);
        $this->livreManager->supprimerLivreBdd($id);

        $_SESSION['alert'] = [
            "type" => "success",
            "message" => "Suppression reuissie"
        ];
        header('Location: '. URL ."livres");
    }

    public function modifierLivre($id)
    {
        $livre = $this->livreManager->getLivreById($id);
        $auteurs = $this->auteurManager->getAuteurs();
        require "views/modifierLivre.view.php";
    }

    public function validationModifierLivre()
    {
        $imageActuelle = $this->livreManager->getLivreById($_POST['IdLivre'])->getImage();
        $file = $_FILES['image'];

        if ($file['size'] > 0) {
            unlink("assets/image/".$imageActuelle);
            $repertoire = "assets/image/";
            $nomImageToEdit = $this->ajouterImage($file, $repertoire);
        }
        else
        {
            $nomImageToEdit = $imageActuelle;
        }
        $this->livreManager->modifierLivreBdd($_POST['IdLivre'],trim($_POST['titre']),trim($_POST['nbrPage']),$nomImageToEdit,$_POST['idAuteur']);

        $_SESSION['alert'] = [
            "type" => "success",
            "message" => "Modification reuissie"
        ];
        header('Location: '. URL ."livres/voire/".$_POST['IdLivre']);
    }

    public function rechercherUnLivre()
    {
        if (trim($_POST['search']) === "")
            throw new Exception("Le champs de recherche est doit ếtre remplie");
        
        $livres = $this->livreManager->rechercherUnLivreBdd(trim(strtolower($_POST['search'])));
        $auteurs = $this->auteurManager->getAuteurs();

        require "views/livres.view.php";
    }


    private function ajouterImage($file, $dir)
    {
        if (!isset($file['name']) || empty($file['name']))
             throw new Exception("Indiquez un image");

        if (!file_exists($dir)) mkdir($dir, 0777);

        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $random = rand(0,99999);
        $target_info = $dir.$random."_".$file['name'];

        if (!getimagesize($file['tmp_name']))
             throw new Exception("Le fichier n'est pas une image");
        
        if ($extension !== "jpg" && $extension !== "png" && $extension !== "jepg" && $extension !== "gif" && $extension !== "webp")
             throw new Exception("L'extention de l'image n'est pas reconnu");
    
        if (file_exists($target_info))
            throw new Exception("Le fichier existe déja");
        
        if ($file['size'] > 500000)
            throw new Exception("Le fichier est trop volumieux");
        
        if (!move_uploaded_file($file['tmp_name'], $target_info))
            throw new Exception("L'ajoute de l'image n'a pas fonctionné");
        else return ($random."_".$file['name']);
    }

   

}