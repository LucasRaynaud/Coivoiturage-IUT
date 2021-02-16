<?php
class VilleManager{

	private $dbo;

	public function __construct($db){
		$this->db = $db;
	}

	public function add($ville){
		$requete = $this->db->prepare('insert into ville(vil_num,vil_nom) values (:vil_num,:vil_nom);');

		$requete->bindValue(':vil_num',$ville->getVil_Num());
		$requete->bindValue(':vil_nom',$ville->getVil_Nom());

		return $requete->execute();
	}

	public function getAllVilles(){
		$listeVilles = array();

		$sql = 'select vil_num, vil_nom FROM ville';

		$requete = $this->db->prepare($sql);
		$requete->execute();

		while ($ville = $requete->fetch(PDO::FETCH_OBJ))
			$listeVilles[] = new Ville($ville);

		$requete->closeCursor();
		return $listeVilles;
	}

	public function getNbVilles(){
		$compteur = 0;

		$sql = 'select vil_num as nbVilles FROM ville';

		$requete = $this->db->prepare($sql);
		$requete->execute();

		while ($ville = $requete->fetch(PDO::FETCH_OBJ))
			$compteur++;

		$requete->closeCursor();
		return $compteur;
	}

	public function recupVille($vil_num) {
		$sql = 'select vil_num,vil_nom from ville';
		$requete = $this->db->prepare($sql);
		$requete->execute();
		while($ville = $requete->fetch(PDO::FETCH_ASSOC)){
			if ($vil_num==$ville["vil_num"]){
				$requete->closeCursor();
				return $ville;
			}
		}
		$requete->closeCursor();
		return null;
	}

	public function getAllVillesDepart() {
		$listeVilles = array();

		$sql = 'select distinct vil_nom,v.vil_num from parcours pa join propose pr on pa.par_num=pr.par_num join ville v on v.vil_num=pa.vil_num1 where pro_sens = 0 UNION
select distinct vil_nom,v.vil_num from parcours pa join propose pr on pa.par_num=pr.par_num join ville v on v.vil_num=pa.vil_num2 where pro_sens = 1';

		$requete = $this->db->prepare($sql);
		$requete->execute();

		while ($ville = $requete->fetch(PDO::FETCH_OBJ))
			$listeVilles[] = new Ville($ville);

		$requete->closeCursor();
		return $listeVilles;
	}

	public function getAllVillesParcours() {
		$listeVilles = array();

		$sql = 'select distinct v.vil_num,vil_nom from parcours pa join ville v on v.vil_num=pa.vil_num1 UNION
select distinct v.vil_num,vil_nom from parcours pa join ville v on v.vil_num=pa.vil_num2';

		$requete = $this->db->prepare($sql);
		$requete->execute();

		while ($ville = $requete->fetch(PDO::FETCH_OBJ))
			$listeVilles[] = new Ville($ville);

		$requete->closeCursor();
		return $listeVilles;
	}

	public function getAllVillesArrivee($vil_num_depart) {
		$listeVilles = array();

		$sql = "select distinct vil_num1 as vil_num,v.vil_nom from parcours pa join ville v on v.vil_num=pa.vil_num1 where vil_num2='$vil_num_depart' UNION
select distinct vil_num2 as vil_num,vil_nom from parcours pa join ville v on v.vil_num=pa.vil_num2 where vil_num1='$vil_num_depart'";

		$requete = $this->db->prepare($sql);
		$requete->execute();

		while ($ville = $requete->fetch(PDO::FETCH_OBJ)) {
				$listeVilles[] = new Ville($ville);
		}
		$requete->closeCursor();
		return $listeVilles;
	}

	public function estPresente($vil_nom) {
		$sql = "select * from ville where vil_nom='$vil_nom'";
		$requete = $this->db->prepare($sql);
		$requete->execute();
		while($ville = $requete->fetch(PDO::FETCH_ASSOC)){
			return true;
		}
		return false;
	}
}