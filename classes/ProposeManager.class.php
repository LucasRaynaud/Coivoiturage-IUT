<?php
class ProposeManager{

	private $dbo;

	public function __construct($db) {
		$this->db = $db;
	}

	public function add($propose) {
		$requete = $this->db->prepare('insert into propose(par_num,per_num,pro_time,pro_date,pro_place,pro_sens) values (:par_num,:per_num,:pro_time,:pro_date,:pro_place,:pro_sens);');

		$requete->bindValue(':par_num', $propose->getPar_Num());
		$requete->bindValue(':per_num', $propose->getPer_Num());
		$requete->bindValue(':pro_time', $propose->getPro_Time());
		$requete->bindValue(':pro_date', $propose->getPro_Date());
		$requete->bindValue(':pro_place',$propose->getPro_Place());
		$requete->bindValue(':pro_sens',$propose->getPro_Sens());

		$retour = $requete->execute();

		return $retour;
	}

	public function recupTrajet($precisionJour, $heureMin, $dateDepart, $vil_num_depart, $vil_num2) {
		$listeTrajet = array();

		$sql = "select vil_num1 as vil_depart, vil_num2 as vil_arrivee, pro_date, pro_time, pro_place,per_num from propose pr join parcours pa on pa.par_num=pr.par_num join ville v on v.vil_num=pa.vil_num1 where pa.vil_num1='$vil_num_depart' and pa.vil_num2='$vil_num2' and pr.pro_sens=0 and pro_time>='$heureMin:00:00' and pro_date>=date_sub('$dateDepart',INTERVAL '$precisionJour' DAY ) and pro_date<=date_add('$dateDepart',interval '$precisionJour' day) union 
select vil_num2 as vil_depart, vil_num1 as vil_arrivee, pro_date, pro_time, pro_place,per_num from propose pr join parcours pa on pa.par_num=pr.par_num join ville v on v.vil_num=pa.vil_num2 where pa.vil_num2='$vil_num_depart' and pa.vil_num1='$vil_num_depart' and pr.pro_sens=1 and pro_time>='$heureMin:00:00' and pro_date<=date_add('$dateDepart',interval '$precisionJour' day) and pro_date>=date_sub('$dateDepart',INTERVAL '$precisionJour' DAY )";

		$requete = $this->db->prepare($sql);
		$requete->execute();

		while ($trajet = $requete->fetch(PDO::FETCH_ASSOC))
			$listeTrajet[] = $trajet;

		$requete->closeCursor();
		return $listeTrajet;
	}

	public function get_Sens($vil_num_depart, $vil_num2) {
		$sql1 = "select vil_num2 as vil_depart, vil_num1 as vil_arrivee from parcours pa join ville v on v.vil_num=pa.vil_num2 where pa.vil_num1='$vil_num_depart' and pa.vil_num2='$vil_num2'";
		$sql2= "select vil_num2 as vil_depart, vil_num1 as vil_arrivee from parcours pa join ville v on v.vil_num=pa.vil_num2 where pa.vil_num1='$vil_num2' and pa.vil_num2='$vil_num_depart'";

		$requete1 = $this->db->prepare($sql1);
		$requete1->execute();

		if (!empty($requete1->fetch(PDO::FETCH_ASSOC))){
			return 0;
		}

		$requete2 = $this->db->prepare($sql2);
		$requete2->execute();

		if (!empty($requete2->fetch(PDO::FETCH_ASSOC))){
			return 1;
		}
	}


}