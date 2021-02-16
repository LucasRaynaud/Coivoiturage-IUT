<?php
class Etudiant{

    private $per_num;
    private $dep_num;
    private $div_num;

    public function __construct($valeurs = array()){
        if (!empty($valeurs)){
            $this->affecte($valeurs);
        }
    }

    public function affecte($donnees){
        foreach($donnees as $attribut => $valeur){
            switch($attribut){
                case 'per_num': $this->setPer_Num($valeur); break;
                case 'dep_num': $this->setDep_Num($valeur); break;
                case 'div_num': $this->setDiv_Num($valeur); break;
            }
        }
    }

    public function getDiv_Num() {
        return $this->div_num;
    }
    public function setDiv_Num($div_num) {
        $this->div_num = $div_num;
    }
    public function getPer_Num() {
        return $this->per_num;
    }
    public function setPer_Num($per_num) {
        $this->per_num = $per_num;
    }
    public function getDep_Num() {
        return $this->dep_num;
    }
    public function setDep_Num($dep_num) {
        $this->dep_num = $dep_num;
    }
}