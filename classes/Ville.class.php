<?php
class Ville{
	
    private $vil_num;
    private $vil_nom;
    
    public function __construct($valeurs = array()){
        if (!empty($valeurs)){
            $this->affecte($valeurs);
        }
    }
    
    public function affecte($donnees){
        foreach($donnees as $attribut => $valeur){
            switch($attribut){
                case 'vil_num': $this->setVil_Num($valeur); break;
                case 'vil_nom': $this->setVil_Nom($valeur); break;
            }
        }
    }
    
    public function setVil_Num($id){
        $this->vil_num = $id;
    }
    public function getVil_Num(){
        return $this->vil_num;
    }
    
    public function setVil_Nom($nom){
        $this->vil_nom=$nom;
    }
    public function getVil_Nom(){
        return $this->vil_nom;
    }
}