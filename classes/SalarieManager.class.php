<?php
class SalarieManager{

    private $dbo;

    public function __construct($db){
        $this->db = $db;
    }

    public function add($etudiant){
        $requete = $this->db->prepare('insert into salarie(per_num,sal_telprof,fon_num) values (:per_num,:sal_telprof,:fon_num);');

        $requete->bindValue(':per_num',$etudiant->getPer_Num());
        $requete->bindValue(':sal_telprof',$etudiant->getSal_Telprof());
        $requete->bindValue(':fon_num',$etudiant->getFon_Num());

        return $requete->execute();
    }

    public function getAllSalarie(){
        $listeSalarie = array();

        $sql = 'select per_num,sal_telprof,fon_num from salarie';

        $requete = $this->db->prepare($sql);
        $requete->execute();

        while ($salarie = $requete->fetch(PDO::FETCH_OBJ))
            $listeSalarie[] = new Salarie($salarie);

        $requete->closeCursor();
        return $listeSalarie;   }

    public function estPresent($num_pers) {
        $sql = 'select per_num from salarie';
        $requete = $this->db->prepare($sql);
        $requete->execute();
        while($salarie = $requete->fetch(PDO::FETCH_ASSOC)){
            if ($num_pers==$salarie['per_num']){
                $requete->closeCursor();
                return true;
            }
        }
        $requete->closeCursor();
        return false;
    }

    public function recupSalarie($num_pers) {
        $sql = 'select sal_telprof,fon_num,per_num from salarie';
        $requete = $this->db->prepare($sql);
        $requete->execute();
        while($salarie = $requete->fetch(PDO::FETCH_ASSOC)){
            if ($num_pers==$salarie["per_num"]){
				$requete->closeCursor();
                return $salarie;
            }
        }
        $requete->closeCursor();
        return null;

    }

	public function supprimerSalarie($personneCible) {
    	$num_pers = $personneCible["per_num"];
		$sql = "delete from salarie where per_num='.$num_pers.'";
		$requete = $this->db->prepare($sql);
		$requete->execute();
	}

	public function update(Salarie $salarie) {
		$per_num=$salarie->getPer_Num();
		$fon_num = $salarie->getFon_Num();
		$sal_telprof = $salarie->getSal_Telprof();
		$sql = "update salarie set fon_num='$fon_num',
                    sal_telprof='$sal_telprof'
                    where per_num='$per_num'";
		$requete = $this->db->prepare($sql);
		$requete->execute();
	}
}