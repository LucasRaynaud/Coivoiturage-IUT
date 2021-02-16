<h1>Proposer un trajet</h1>
<?php
$pdo = new Mypdo();
$villeManager = new VilleManager($pdo);
$villes = $villeManager->getAllVillesParcours();
if ($_SESSION["connecte"]){
	if (empty($_POST["vil_num"]) && empty($_POST["vil_num2"])){?>
        <form action="index.php?page=9" id="insert" method="post">
            Ville de départ :
            <br>
            <select name="vil_num"><?php
				foreach ($villes as $villes1) {
					?>
                <option value=<?php echo $villes1->getVil_Num()?>>
					<?php echo $villes1->getVil_Nom(); ?>
                    </option><?php
				} ?></select>
            <br>
            <input type="submit" value="Valider"/>
        </form>
	<?php } elseif (!empty($_POST["vil_num"]) && empty($_POST["vil_num2"]) && empty($_POST["dateDepart"]) && empty($_POST["heureMin"]) && empty($_POST["nb_places"])){
		$_SESSION["vil_num_depart"]=$_POST["vil_num"]; ?>
        <form action="index.php?page=9" id="insert" method="post">
            Ville de départ : <?php echo $villeManager->recupVille($_SESSION["vil_num_depart"])["vil_nom"]; ?>
            Ville d'arrivée : <?php $numVilleDepart = $_SESSION["vil_num_depart"];
			$villesArrivee = $villeManager->getAllVillesArrivee($numVilleDepart);?>
            <select name="vil_num2"><?php
				foreach ($villesArrivee as $villes1) {
					?>
                <option value=<?php echo $villes1->getVil_Num()?>>
					<?php echo $villes1->getVil_Nom(); ?>
                    </option><?php
				} ?></select>
            <br>
            Date de départ : <input type="date" value="<?php echo date('Y-m-d'); ?>" name="dateDepart">
            Heure de départ : <input type="time" value="<?php echo date('Y-m-d'); ?>" name="heureMin">
            <br>
            Nombre de places : <input type="number" name="nb_places">
            <br>
            <input type="submit" value="Valider"/>
        </form>

	<?php } elseif(empty($_POST["vil_num"]) && !empty($_POST["vil_num2"]) && !empty($_POST["dateDepart"]) && !empty($_POST["heureMin"]) && !empty($_POST["nb_places"])) {
		$proposeManager = new ProposeManager($pdo);
		$parcoursManager = new ParcoursManager($pdo);
		$parcoursNum = $parcoursManager->getParcoursAvecNumVilles($_SESSION["vil_num_depart"],$_POST["vil_num2"]);
		$propose = new Propose($_POST);
		$pro_sens = $proposeManager->get_Sens($_SESSION["vil_num_depart"],$_POST["vil_num2"]);
		$propose->setProDate($_POST["dateDepart"]);
		$propose->setPro_Time($_POST["heureMin"]);
		$propose->setPro_Place($_POST["nb_places"]);
		$propose->setPar_Num($parcoursNum["par_num"]);
		$propose->setPro_Sens($pro_sens);
		$propose->setPer_Num($_SESSION["num_pers_connecte"]);
		$proposeManager->add($propose);
		header("Location: index.php");
	}
}else{
	header("Location: index.php");
}