<?php
class Parcours{

    private $par_num;
    private $vil_num1;
    private $vil_num2;
    private $par_km;

    public function __construct($valeurs = array()){
        if (!empty($valeurs)){
            $this->affecte($valeurs);
        }
    }

    public function affecte($donnees){
        foreach ($donnees as $attribut=>$valeurs){
            switch($attribut){
                case 'par_num' : $this->setPar_Num($valeurs);break;
                case 'par_km' : $this->setPar_Km($valeurs);break;
                case 'vil_num1' : $this->setVil_Num1($valeurs);break;
                case 'vil_num2': $this->setVil_Num2($valeurs);break;
            }
        }
    }

    public function setPar_Num($id){
        $this->par_num = $id;
    }
    public function getPar_Num(){
        return $this->par_num;
    }

    public function setVil_Num1($id){
        $this->vil_num1 = $id;
    }
    public function getVil_Num1(){
        return $this->vil_num1;
    }

    public function setVil_Num2($id){
        $this->vil_num2 = $id;
    }
    public function getVil_Num2(){
        return $this->vil_num2;
    }

    public function setPar_Km($id){
        $this->par_km = $id;
    }
    public function getPar_Km(){
        return $this->par_km;
    }
}
