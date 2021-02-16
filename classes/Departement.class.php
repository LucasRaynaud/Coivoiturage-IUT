<?php
class Departement{

    private $dep_nom;
    private $dep_num;

    public function __construct($valeurs = array()){
        if (!empty($valeurs)){
            $this->affecte($valeurs);
        }
    }

    public function affecte($formations){
        foreach ($formations as $attribut=>$valeurs) {
            switch ($attribut) {
                case 'dep_num' :
                    $this->setDep_Num ($valeurs);
                    break;
                case 'dep_nom' :
                    $this->setDep_Nom ($valeurs);
                    break;
                case 'vil_num' :
                    $this->setVil_Num ($valeurs);
                    break;
            }
        }
    }

    public function setDep_Num($id){
        $this->dep_num = $id;
    }
    public function getDep_Num(){
        return $this->dep_num;
    }
    public function setDep_Nom($id){
        $this->dep_nom = $id;
    }
    public function getDep_Nom(){
        return $this->dep_nom;
    }
    public function setVil_Num($id){
        $this->vil_num = $id;
    }
    public function getVil_Num(){
        return $this->vil_num;
    }
}