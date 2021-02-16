<?php

class EtudiantManager {

	private $dbo;

	public function __construct($db) {
		$this->db = $db;
	}

	public function add($etudiant) {
		$requete = $this->db->prepare('INSERT INTO etudiant(per_num,dep_num,div_num) VALUES (:per_num,:dep_num,:div_num);');

		$requete->bindValue(':per_num', $etudiant->getPer_Num());
		$requete->bindValue(':dep_num', $etudiant->getDep_Num());
		$requete->bindValue(':div_num', $etudiant->getDiv_Num());

		return $requete->execute();
	}

	public function recupEtudiant($per_num) {
		$sql = 'select per_num,dep_num,div_num from etudiant';
		$requete = $this->db->prepare($sql);
		$requete->execute();
		while ($etudiant = $requete->fetch(PDO::FETCH_ASSOC)) {
			if ($per_num == $etudiant["per_num"]) {
				$requete->closeCursor();
				return $etudiant;
			}
		}
		$requete->closeCursor();
		return null;
	}

	public function supprimerEtudiant($personneCible) {
		$num_pers = $personneCible["per_num"];
		$sql = "delete from etudiant where per_num='$num_pers'";
		$requete = $this->db->prepare($sql);
		$requete->execute();
	}

	public function estPresent($per_num) {
		$sql = 'select per_num from etudiant';
		$requete = $this->db->prepare($sql);
		$requete->execute();
		while ($etudiant = $requete->fetch(PDO::FETCH_ASSOC)) {
			if ($per_num == $etudiant['per_num']) {
				$requete->closeCursor();
				return true;
			}
		}
		$requete->closeCursor();
		return false;
	}

	public function update(Etudiant $etudiantUpdate){
		$per_num=$etudiantUpdate->getPer_Num();
		$dep_num = $etudiantUpdate->getDep_Num();
		$div_num = $etudiantUpdate->getDiv_Num();
		$sql = "update etudiant set dep_num='$dep_num',
                    div_num='$div_num'
                    where per_num='$per_num'";
		$requete = $this->db->prepare($sql);
		$requete->execute();
	}
}