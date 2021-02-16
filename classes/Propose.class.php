<?php
class Propose {
	private $pro_sens;
	private $pro_place;
	private $par_num;
	private $per_num;
	private $pro_time;
	private $pro_date;

	public function __construct($valeurs = array()) {
		if (!empty($valeurs)) {
			$this->affecte($valeurs);
		}
	}

	public function affecte($donnees) {
		foreach ($donnees as $attribut => $valeurs) {
			switch ($attribut) {
				case 'par_num' :
					$this->setPar_Num($valeurs);
					break;
				case 'per_num' :
					$this->setPer_Num($valeurs);
					break;
				case 'pro_date' :
					$this->setPro_Date($valeurs);
					break;
				case 'pro_time':
					$this->setPro_Time($valeurs);
					break;
				case 'pro_place' :
					$this->setPro_Place($valeurs);
					break;
				case 'pro_sens' :
					$this->setPro_Sens($valeurs);
					break;
			}
		}
	}

	private function setPro_Date($valeurs) {
		$this->pro_date=$valeurs;
	}

	/**
	 * @return mixed
	 */
	public function getPro_Sens() {
		return $this->pro_sens;
	}

	/**
	 * @param mixed $pro_sens
	 */
	public function setPro_Sens($pro_sens) {
		$this->pro_sens = $pro_sens;
	}

	/**
	 * @return mixed
	 */
	public function getPro_Place() {
		return $this->pro_place;
	}

	/**
	 * @param mixed $pro_place
	 */
	public function setPro_Place($pro_place) {
		$this->pro_place = $pro_place;
	}

	/**
	 * @return mixed
	 */
	public function getPar_Num() {
		return $this->par_num;
	}

	public function setPar_Num($valeurs) {
		$this->par_num=$valeurs;
	}

	/**
	 * @return mixed
	 */
	public function getPer_Num() {
		return $this->per_num;
	}

	public function setPer_Num($valeurs) {
		$this->per_num=$valeurs;
	}

	/**
	 * @return mixed
	 */
	public function getPro_Time() {
		return $this->pro_time;
	}

	/**
	 * @param mixed $pro_time
	 */
	public function setPro_Time($pro_time) {
		$this->pro_time = $pro_time;
	}

	/**
	 * @return mixed
	 */
	public function getPro_Date() {
		return $this->pro_date;
	}

	/**
	 * @param mixed $pro_date
	 */
	public function setProDate($pro_date) {
		$this->pro_date = $pro_date;
	}
}