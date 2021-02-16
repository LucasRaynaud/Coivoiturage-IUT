<?php
class Personne{

    private $per_num;
    private $per_nom;
    private $per_prenom;
    private $per_tel;
    private $per_mail;

    public function __construct($valeurs = array()){
        if (!empty($valeurs)){
            $this->affecte($valeurs);
        }
    }

    public function affecte($donnees){
        foreach ($donnees as $attribut=>$valeurs){
            switch($attribut){
                case 'per_num' : $this->setPer_Num($valeurs);break;
                case 'per_nom' : $this->setPer_Nom($valeurs);break;
                case 'per_prenom' : $this->setPer_Prenom($valeurs);break;
                case 'per_tel' : $this->setPer_Tel($valeurs);break;
                case 'per_mail': $this->setPer_Mail($valeurs);break;
                case 'per_login': $this->setPer_Login($valeurs);break;
                case 'per_pwd': $this->setPer_Pwd($valeurs);break;
            }
        }
    }

    public function setPer_Login($id){
        $this->per_login = $id;
    }

    public function setPer_Pwd($id){
        $this->per_pwd = sha1(sha1($id).SALT);
    }

    public function getPer_Num(){
        return $this->per_num;
    }

    public function setPer_Num($id){
        $this->per_num = $id;
    }

    public function getPer_Nom(){
        return $this->per_nom;
    }

    public function setPer_Nom($id){
        $this->per_nom = $id;
    }

    public function getPer_Prenom(){
        return $this->per_prenom;
    }

    public function setPer_Prenom($id){
        $this->per_prenom = $id;
    }

    public function getPer_Tel(){
        return $this->per_tel;
    }

    public function setPer_Tel($id){
        $this->per_tel = $id;
    }

    public function getPer_Mail(){
        return $this->per_mail;
    }

    public function setPer_Mail($id){
        $this->per_mail = $id;
    }

    public function getPer_Login(){
        return $this->per_login;
    }

    public function getPer_Pwd(){
        return $this->per_pwd;
    }
}