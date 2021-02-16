<?php
class DivisionManager{

    private $dbo;

    public function __construct($db){
        $this->db = $db;
    }

    public function getAllAnnees(){
        $listeAnnees = array();

        $sql = 'select div_num, div_nom FROM division';

        $requete = $this->db->prepare($sql);
        $requete->execute();

        while ($annee = $requete->fetch(PDO::FETCH_OBJ))
            $listeAnnees[] = new Division($annee);

        $requete->closeCursor();
        return $listeAnnees;
    }

	public function recupDivision($div_num) {
		$sql = "select div_num, div_nom FROM division where div_num='$div_num'";

		$requete = $this->db->prepare($sql);
		$requete->execute();

		while ($annee = $requete->fetch(PDO::FETCH_ASSOC))
			return $annee;

	}

}