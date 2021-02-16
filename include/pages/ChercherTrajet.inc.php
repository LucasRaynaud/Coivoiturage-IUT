<h1>Rechercher un trajet</h1>
<?php
$pdo = new Mypdo();
$villeManager = new VilleManager($pdo);
$villes = $villeManager->getAllVillesDepart();
$proposeManager = new ProposeManager($pdo);
$personneManager = new PersonneManager($pdo);
if($_SESSION["connecte"]){
	if (empty($_POST["vil_num"]) && empty($_POST["vil_num2"]) && empty($_POST["precisionJour"]) && empty($_POST["heureMin"])){?>
        <form action="index.php?page=10" id="insert" method="post">
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
	<?php } elseif(!empty($_POST["vil_num"]) && empty($_POST["vil_num2"]) && empty($_POST["precisionJour"]) && empty($_POST["heureMin"])){
		$_SESSION["vil_num_depart"]=$_POST["vil_num"]; ?>
        <form action="index.php?page=10" id="insert" method="post">
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
            Précision : <select name="precisionJour">
                <option value=00>Ce jour</option>
                <option value=01>+/- 1 jour</option>
                <option value=02>+/- 2 jours</option>
                <option value=03>+/- 3 jours</option>
            </select>
            <br>
            A partir de : <select name="heureMin">
				<?php for ($i = 0;$i<=23;$i++){
					?> <option value=<?php echo "0".$i; ?>><?php echo $i."h"; ?></option>
				<?php } ?>
            </select>
            <br>
            <input type="submit" value="Valider"/>
        </form>
		<?php
	}
	if(empty($_POST["vil_num"]) && !empty($_POST["vil_num2"]) && !empty($_POST["precisionJour"]) && !empty($_POST["heureMin"])){
		$trajet = $proposeManager->recupTrajet($_POST["precisionJour"],$_POST["heureMin"],$_POST["dateDepart"],$_SESSION["vil_num_depart"],$_POST["vil_num2"]);
		if (!empty($trajet)){?>
            <table>
                <tr>
                    <th>Ville de départ</th>
                    <th>Ville d'arrivée</th>
                    <th>Date départ</th>
                    <th>Heure départ</th>
                    <th>Nombre de place(s)</th>
                    <th>Nom du covoitureur</th>
                </tr>

				<?php foreach ($trajet as $trajet2) { ?>
                    <tr>
                        <td><?php echo $villeManager->recupVille($_SESSION["vil_num_depart"])["vil_nom"];  ?> </td >
                        <td><?php echo $villeManager->recupVille($_POST["vil_num2"])["vil_nom"]; ?> </td>
                        <td><?php echo $trajet2["pro_date"]; ?> </td>
                        <td><?php echo $trajet2["pro_time"]; ?></td>
                        <td><?php echo $trajet2["pro_place"]; ?></td>
                        <td><?php echo $personneManager->recupPersonne($trajet2["per_num"])["per_prenom"]." ".$personneManager->recupPersonne($trajet2["per_num"])["per_nom"];  ?></td>
                    </tr>
				<?php } ?>
            </table>
		<?php }else{ print("Désolé, pas de trajet disponible"); }
	}
}else{
	header("Location: index.php");
}