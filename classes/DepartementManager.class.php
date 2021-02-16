<?php
class DepartementManager{

    private $dbo;

    public function __construct($db){
        $this->db = $db;
    }

    public function getAllDepartements(){
        $listeDepartements = array();

        $sql = 'select dep_num, dep_nom, vil_num FROM departement';

        $requete = $this->db->prepare($sql);
        $requete->execute();

        while ($departement = $requete->fetch(PDO::FETCH_OBJ))
            $listeDepartements[] = new Departement($departement);

        $requete->closeCursor();
        return $listeDepartements;
    }

	public function recupDepartement($dep_num) {
		$sql = 'select dep_num,dep_nom,vil_num from departement';
		$requete = $this->db->prepare($sql);
		$requete->execute();
		while($departement = $requete->fetch(PDO::FETCH_ASSOC)){
			if ($dep_num==$departement["dep_num"]){
				$requete->closeCursor();
				return $departement;
			}
		}
		$requete->closeCursor();
		return null;
	}
}