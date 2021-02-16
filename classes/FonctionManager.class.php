<?php
class FonctionManager{

    private $dbo;

    public function __construct($db){
        $this->db = $db;
    }

    public function getAllFonctions(){
        $listeFonctions = array();

        $sql = 'select fon_num, fon_libelle FROM fonction';

        $requete = $this->db->prepare($sql);
        $requete->execute();

        while ($fonction = $requete->fetch(PDO::FETCH_OBJ))
            $listeFonctions[] = new Fonction($fonction);

        $requete->closeCursor();
        return $listeFonctions;
    }

    public function recupFonctionLibelle($fon_num) {
        $sql = 'select fon_num,fon_libelle from fonction';
        $requete = $this->db->prepare($sql);
        $requete->execute();
        while($fonction = $requete->fetch(PDO::FETCH_ASSOC)){
            if ($fon_num==$fonction["fon_num"]){
                $requete->closeCursor();
                return $fonction;
            }
        }
        $requete->closeCursor();
        return null;
    }

}