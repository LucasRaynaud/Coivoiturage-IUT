<?php

class PersonneManager {

	private $dbo;

	public function __construct($db) {
		$this->db = $db;
	}

	public function add($personne) {
		$requete = $this->db->prepare('insert into personne(per_num,per_nom,per_prenom,per_tel,per_mail,per_login,per_pwd) values (:per_num,:per_nom,:per_prenom,:per_tel,:per_mail,:per_login,:per_pwd);');

		$requete->bindValue(':per_num', $personne->getPer_Num());
		$requete->bindValue(':per_nom', $personne->getPer_Nom());
		$requete->bindValue(':per_prenom', $personne->getPer_Prenom());
		$requete->bindValue(':per_tel', $personne->getPer_Tel());
		$requete->bindValue(':per_mail', $personne->getPer_Mail());
		$requete->bindValue(':per_login', $personne->getPer_Login());
		$requete->bindValue(':per_pwd', $personne->getPer_Pwd());

		$requete->execute();
		$num = $this->db->lastInsertID();
		return $num;
	}

	public function getAllPersonnes(){
		$listePersonnes = array();

		$sql = 'select per_num,per_nom,per_prenom FROM personne';

		$requete = $this->db->prepare($sql);
		$requete->execute();

		while ($personne = $requete->fetch(PDO::FETCH_OBJ))
			$listePersonnes[] = new Personne($personne);

		$requete->closeCursor();
		return $listePersonnes;
	}

	public function getNbPersonnes(){
		$compteur = 0;

		$sql = 'select per_num as nbPersonnes FROM personne';

		$requete = $this->db->prepare($sql);
		$requete->execute();

		while ($personne = $requete->fetch(PDO::FETCH_OBJ))
			$compteur++;

		$requete->closeCursor();
		return $compteur;
	}

	public function recupPersonne($num_pers) {
		$sql = 'select per_nom,per_prenom,per_mail,per_tel,per_num,per_login,per_pwd from personne';
		$requete = $this->db->prepare($sql);
		$requete->execute();
		while($personne = $requete->fetch(PDO::FETCH_ASSOC)){
			if ($num_pers==$personne["per_num"]){
				$requete->closeCursor();
				return $personne;
			}
		}
		$requete->closeCursor();
		return null;
	}

	public function estPresent($per_login){
		$sql = "select per_num from personne where per_login='$per_login'";
		$requete = $this->db->prepare($sql);
		$requete->execute();
		while($personne = $requete->fetch(PDO::FETCH_ASSOC)){
			return true;
		}
		return false;
	}

	public function recupPersonneAvecLogin($per_login){
		$sql = "select per_num,per_pwd from personne where per_login='$per_login'";
		$requete = $this->db->prepare($sql);
		$requete->execute();
		while($personne = $requete->fetch(PDO::FETCH_ASSOC)){
			return $personne;
		}
		return null;
	}

	public function supprimerPersonne($personneCible) {
		$num_pers = $personneCible["per_num"];
		$sql="delete from propose where per_num='$num_pers'";
		$requete = $this->db->prepare($sql);
		$requete->execute();
		$sql="delete from avis where per_num='$num_pers'";
		$requete = $this->db->prepare($sql);
		$requete->execute();
		$sql="delete from avis where per_per_num='$num_pers'";
		$requete = $this->db->prepare($sql);
		$requete->execute();
		$sql = "delete from personne where per_num='$num_pers'";
		$requete = $this->db->prepare($sql);
		$requete->execute();
	}

	public function update(Personne $personneUpdate) {
		$per_num=$personneUpdate->getPer_Num();
		$per_nom=$personneUpdate->getPer_Nom();
		$per_prenom=$personneUpdate->getPer_Prenom();
		$per_tel=$personneUpdate->getPer_Tel();
		$per_mail=$personneUpdate->getPer_Mail();
		$per_login=$personneUpdate->getPer_Login();
		$sql="update personne set per_nom='$per_nom',
			per_prenom='$per_prenom',
			per_tel='$per_tel',
			per_mail='$per_mail',
			per_login='$per_login'
			where per_num='$per_num'";
		$requete = $this->db->prepare($sql);
		$requete->execute();
	}
}
