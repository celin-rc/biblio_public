<?php

require_once "models/auteurs/AuteurManager.class.php";

class AuteursController{

    private $auteurManager;
    private $livreManager;

    public function __construct()
    {
        $this->auteurManager = new AuteurManager();
        $this->auteurManager->chargementAuteurs();
        $this->livreManager = new LivreManager();
        $this->livreManager->chargementLivres();
    }

    public function afficherAuteurs()
    {   
        $auteurs = $this->auteurManager->getAuteurs();
        require "views/auteurs/auteurs.view.php";
    }

    public function afficherAuteur($id)
    {
        $auteur = $this->auteurManager->getAuteurById($id);
        $livres = $this->livreManager->getLivreByAutor($id);
        require "views/auteurs/unAuteur.view.php";
    }

    public function ajouterAuteurs()
    {
        require "views/auteurs/ajouter-auteurs.view.php";
    }

    public function validationAuteurs()
    {
        $file = $_FILES['image'];
        $repertoire = "assets/image/auteurs/";
        $nomImage = $this->ajouterImage($file, $repertoire);
        
        $this->auteurManager->ajouteAuteurBdd(trim(strtolower($_POST['nomComplet'])),$nomImage,trim($_POST['biographie']));
        
        $_SESSION['alert'] = [
            "type" => "success",
            "message" => "Ajoute reuissie"
        ];
        
        header('Location: '. URL ."auteurs");
    }  

    public function suppressionAuteurs($id)
    {
        $nomImage = $this->auteurManager->getAuteurById($id)->getImage();
        unlink("assets/image/".$nomImage);
        $this->auteurManager->supprimerAuteurBdd($id);

        $_SESSION['alert'] = [
            "type" => "success",
            "message" => "Suppression reuissie"
        ];

        header('Location: '. URL ."auteurs");
    }

    public function modificationAuteurs($id)
    {
        $auteur = $this->auteurManager->getAuteurById($id);
        require "views/auteurs/modifierAuteur.view.php";
    }

    public function validationModifierAuteur(){
        $imageActuelle = $this->auteurManager->getAuteurById($_POST['IdAuteur'])->getImage();
        $file = $_FILES['image'];

        if ($file['size'] > 0) {
            unlink("assets/image/auteurs/".$imageActuelle);
            $repertoire = "assets/image/auteurs/";
            $nomImageToEdit = $this->ajouterImage($file, $repertoire);
        }
        else
        {
            $nomImageToEdit = $imageActuelle;
        }
        $this->auteurManager->modifierAuteurBdd($_POST['IdAuteur'], trim(strtolower($_POST['nomComplet'])), $nomImageToEdit, trim($_POST['biographie']));

        $_SESSION['alert'] = [
            "type" => "success",
            "message" => "Modification reuissie"
        ];

        header('Location: '. URL ."auteurs/voire/".$_POST['IdAuteur']);
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