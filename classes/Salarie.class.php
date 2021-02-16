<?php
class Salarie{

    private $per_num;
    private $sal_telprof;
    private $fon_num;

    public function __construct($valeurs = array()){
        if (!empty($valeurs)){
            $this->affecte($valeurs);
        }
    }

    public function affecte($donnees){
        foreach($donnees as $attribut => $valeur){
            switch($attribut){
                case 'per_num': $this->setPer_Num($valeur); break;
                case 'sal_telprof': $this->setSal_Telprof($valeur); break;
                case 'fon_num': $this->setFon_Num($valeur); break;
            }
        }
    }

    public function getPer_Num() {
        return $this->per_num;
    }
    public function setPer_Num($per_num) {
        $this->per_num = $per_num;
    }
    public function getSal_Telprof() {
        return $this->sal_telprof;
    }
    public function setSal_Telprof($sal_telprof) {
        $this->sal_telprof = $sal_telprof;
    }
    public function getFon_Num() {
        return $this->fon_num;
    }
    public function setFon_Num($fon_num) {
        $this->fon_num = $fon_num;
    }
}