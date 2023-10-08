<?php
class Livre{
    private $id;
    private $titre;
    private $nbrPage;
    private $image;
    private $idAuteur;

    public function __construct($id,$titre,$nbrPage,$image,$idAuteur) {
        $this->id = $id;
        $this->titre = $titre;
        $this->nbrPage = $nbrPage;
        $this->image = $image;
        $this->idAuteur = $idAuteur;
    }

    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }

    public function getTitre(){
        return $this->titre;
    }
    public function setTitre($titre){
        $this->titre = $titre;
    }

    public function getNbrPage(){
        return $this->nbrPage;
    }
    public function setNbrPage($nbrPage){
        $this->nbrPage = $nbrPage;
    }

    public function getImage(){
        return $this->image;
    }
    public function setImage($image){
        $this->image = $image;
    }

    public function getIdAuteur(){
        return $this->idAuteur;
    }
    public function setIdAuteur($idAuteur){
        $this->idAuteur = $idAuteur;
    }
}