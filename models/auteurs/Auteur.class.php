<?php

class Auteur{
    private $id;
    private $nomComplet;
    private $image;
    private $biographie;

    public function __construct($id,$nomComplet,$image,$biographie)
    {
        $this->id = $id;
        $this->nomComplet = $nomComplet;
        $this->image = $image;
        $this->biographie = $biographie;
    }

    public function getId(){return $this->id;}
    public function setId($id){$this->id = $id;}

    public function getNomComplet(){return $this->nomComplet;}
    public function setNomComplet($nomComplet){$this->nomComplet = $nomComplet;}

    public function getImage(){return $this->image;}
    public function setImage($image){$this->image = $image;}

    public function getBiographie(){return $this->biographie;}
    public function setBiographie($biographie){$this->biographie = $biographie;}
}