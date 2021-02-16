<?php

class Division {

    private $div_num;
    private $div_nom;

    public function __construct($valeurs = array()) {
        if (!empty($valeurs)) {
            $this->affecte($valeurs);
        }
    }

    public function affecte($annees) {
        foreach ($annees as $attribut => $valeurs) {
            switch ($attribut) {
                case 'div_num' :
                    $this->setDiv_Num($valeurs);
                    break;
                case 'div_nom' :
                    $this->setDiv_Nom($valeurs);
                    break;
            }
        }
    }

    public function setDiv_Num($id) {
        $this->div_num = $id;
    }

    public function getDiv_Num() {
        return $this->div_num;
    }

    public function setDiv_Nom($id) {
        $this->div_nom = $id;
    }

    public function getDiv_Nom() {
        return $this->div_nom;
    }
}