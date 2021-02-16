<?php

class ParcoursManager {

    private $dbo;

    public function __construct($db) {
        $this->db = $db;
    }

    public function add($parcours) {
        $requete = $this->db->prepare('insert into parcours(par_num,par_km,vil_num1,vil_num2) values (:par_num,:par_km,:vil_num1,:vil_num2);');

        $requete->bindValue(':par_num', $parcours->getPar_Num());
        $requete->bindValue(':vil_num1', $parcours->getVil_Num1());
        $requete->bindValue(':vil_num2', $parcours->getVil_Num2());
        $requete->bindValue(':par_km', $parcours->getPar_Km());

        $retour = $requete->execute();

        return $retour;
    }

    public function getAllParcours() {
        $listeParcours = array();

        $sql = 'select p.par_num, v1.vil_nom as vil_nom1, p.vil_num1 as vil_num1, v2.vil_nom as vil_nom2, p.vil_num2 as vil_num2, par_km FROM parcours p join ville v1 on p.vil_num1=v1.vil_num join ville v2 on p.vil_num2=v2.vil_num';

        $requete = $this->db->prepare($sql);
        $requete->execute();

        while ($parcours = $requete->fetch(PDO::FETCH_OBJ))
            $listeParcours[] = $parcours;

        $requete->closeCursor();
        return $listeParcours;
    }

    public function getNbParcours() {
        $compteur = 0;

        $sql = 'select par_num FROM parcours';

        $requete = $this->db->prepare($sql);
        $requete->execute();

        while ($parcours = $requete->fetch(PDO::FETCH_OBJ))
            $compteur++;

        $requete->closeCursor();
        return $compteur;
    }

	public function getParcoursAvecNumVilles($vil_num_depart, $vil_num2) {
		$sql = "select pa.par_num as par_num from parcours pa join ville v on v.vil_num=pa.vil_num1 where pa.vil_num1='$vil_num_depart' and pa.vil_num2='$vil_num2' union 
select pa.par_num as par_num from parcours pa join ville v on v.vil_num=pa.vil_num2 where pa.vil_num2='$vil_num_depart' and pa.vil_num1='$vil_num2'";

		$requete = $this->db->prepare($sql);
		$requete->execute();

		while($parcours = $requete->fetch(PDO::FETCH_ASSOC))
			return $parcours;

	}
}
