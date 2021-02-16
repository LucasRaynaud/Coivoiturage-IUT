<?php
class Fonction{

    private $fon_num;
    private $fon_libelle;

    public function __construct($valeurs = array()){
        if (!empty($valeurs)){
            $this->affecte($valeurs);
        }
    }

    public function affecte($donnees){
        foreach($donnees as $attribut => $valeur){
            switch($attribut){
                case 'fon_num': $this->setFon_Num($valeur); break;
                case 'fon_libelle': $this->setFon_Libelle($valeur); break;
            }
        }
    }

    public function getFon_Num() {
        return $this->fon_num;
    }
    public function setFon_Num($fon_num) {
        $this->fon_num = $fon_num;
    }
    public function getFon_Libelle() {
        return $this->fon_libelle;
    }
    public function setFon_Libelle($fon_libelle) {
        $this->fon_libelle = $fon_libelle;
    }


}