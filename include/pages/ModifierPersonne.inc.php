<h1>Modifier personne</h1>
<?php
$pdo = new Mypdo();
$personneManager = new PersonneManager($pdo);
$personnes = $personneManager->getAllPersonnes();
$salarieManager = new SalarieManager($pdo);
$etudiantManager = new EtudiantManager($pdo);
$fonctionManager = new FonctionManager($pdo);
$fonctions = $fonctionManager->getAllFonctions();
$villeManager = new VilleManager($pdo);
$departementManager = new DepartementManager($pdo);
$departements = $departementManager->getAllDepartements();
$divisionManager = new DivisionManager($pdo);
$annees = $divisionManager->getAllAnnees();
if (empty($_POST["per_nom"])){
	if (empty($_GET["per_num"])) { ?>
        <table>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th></th>
            </tr>
			<?php
			foreach ($personnes as $personne) { ?>
                <tr>
                    <td><?php echo $personne->getPer_Nom(); ?></td>
                    <td><?php echo $personne->getPer_Prenom(); ?></td>
                    <td><a href="index.php?page=3&per_num=<?php echo $personne->getPer_Num() ?>">Modifier</a></td>
                </tr>
			<?php } ?>
        </table>
	<?php }
    elseif ($salarieManager->estPresent($_GET["per_num"])) {
		$_SESSION["personneCible"] = $personneManager->recupPersonne($_GET["per_num"]);
		$personneCible = $_SESSION["personneCible"];
		$_SESSION["salarieCible"] = $salarieManager->recupSalarie($_GET["per_num"]);
		$salarieCible=$_SESSION["salarieCible"];
		$_SESSION["per_num"] = $_GET["per_num"];
		?>
        <form action="index.php?page=3" id="insert" method="POST">
            <table>
                <tr>
                    <td> Nom : </td><td><input type="text" name="per_nom" value=<?php echo $personneCible["per_nom"] ?>></td>
                    <td> Prénom : </td><td><input type="text" name="per_prenom" value=<?php echo $personneCible["per_prenom"] ?>></td>
                </tr>
                <tr>
                    <td> Téléphone : </td><td><input type="tel" name="per_tel" value=<?php echo $personneCible["per_tel"] ?>></td>
                    <td> Mail : </td><td><input type="email" name="per_mail" value=<?php echo $personneCible["per_mail"] ?>></td>
                </tr>
                <tr>
                    <td> Login : </td><td><input type="text" name="per_login" value=<?php echo $personneCible["per_login"] ?>></td>
                </tr>
                <tr>
                    <td> Fonction : </td><td><select name="fon_num">
                            <option value=<?php echo $salarieCible["fon_num"]; ?>>
								<?php echo $fonctionManager->recupFonctionLibelle($salarieCible["fon_num"])["fon_libelle"]; ?>
                            </option><?php
							foreach ($fonctions as $fonction) {
								if ($fonction->getFon_Libelle() != $fonctionManager->recupFonctionLibelle($salarieCible["fon_num"])["fon_libelle"]) {
									?>
                                    <option value=<?php echo $fonction->getFon_Num() ?>>
										<?php echo $fonction->getFon_Libelle(); ?>
                                    </option>
								<?php }
							} ?>
                        </select></td>
                    <td> Téléphone professionnel : </td><td><input type="tel" name="sal_telprof" value=<?php echo $salarieCible["sal_telprof"]; ?>></td>
                </tr>
            </table>
            <input type="submit" value="Valider"/>
        </form>
		<?php
	} elseif ($etudiantManager->estPresent($_GET["per_num"])) {
		$_SESSION["personneCible"] = $personneManager->recupPersonne($_GET["per_num"]);
		$personneCible = $_SESSION["personneCible"];
		$_SESSION["etudiantCible"] = $etudiantManager->recupEtudiant($_GET["per_num"]);
		$etudiantCible=$_SESSION["etudiantCible"];
		$_SESSION["per_num"] = $_GET["per_num"];
		?>
        <form action="index.php?page=3" id="insert" method="POST">
            <table>
                <tr>
                    <td> Nom : </td><td><input type="text" name="per_nom" value=<?php echo $personneCible["per_nom"] ?>></td>
                    <td>Prénom : </td><td><input type="text" name="per_prenom" value=<?php echo $personneCible["per_prenom"] ?>></td>
                </tr>
                <tr>
                    <td>Téléphone : </td><td><input type="tel" name="per_tel" value=<?php echo $personneCible["per_tel"] ?>></td>
                    <td>Mail : </td><td><input type="email" name="per_mail" value=<?php echo $personneCible["per_mail"] ?>></td>
                </tr>
                <td>Login : </td><td><input type="text" name="per_login" value=<?php echo $personneCible["per_login"] ?>></td>
                </tr>
                <tr>
                <td>Année : </td><td><select name="div_num">
                        <option value=<?php echo $etudiantCible["div_num"]; ?>>
							<?php echo $divisionManager->recupDivision($etudiantCible["div_num"])["div_nom"]; ?>
							<?php
							foreach ($annees as $annee) {
							if ($annee->getDiv_num() != $etudiantCible["div_num"]) { ?>
                        <option value=<?php echo $annee->getDiv_num() ?>>
							<?php echo $annee->getDiv_Nom(); ?>
                        </option>
						<?php }
						} ?></select></td>
                <td>Département : </td><td><select name="dep_num">
                    <option value= <?php echo $etudiantCible["dep_num"]; ?>>
						<?php echo $departementManager->recupDepartement($etudiantCible["dep_num"])["dep_nom"] . " - " . $villeManager->recupVille($departementManager->recupDepartement($etudiantCible["dep_num"])["vil_num"])["vil_nom"];
						foreach ($departements as $departement) {
						if ($departement->getDep_Num() != $etudiantCible["dep_num"]){ ?>
                    <option value=<?php echo $departement->getDep_Num() ?>>
						<?php echo $departement->getDep_Nom() . " - " . $villeManager->recupVille($departementManager->recupDepartement($departement->getDep_Num())["vil_num"])["vil_nom"]; ?>
                    </option><?php
					}
					} ?>
                </select></td>
                </tr>
            </table>
            <input type="submit" value="Valider"/>
        </form>
	<?php }
} elseif (!empty($_POST["per_nom"])) {
	$personneUpdate=$_SESSION["personneCible"];

	if (!empty($_POST["per_nom"])) {
		$personneUpdate["per_nom"]=$_POST["per_nom"];
	}
	if (!empty($_POST["per_prenom"])) {
		$personneUpdate["per_prenom"] = $_POST["per_prenom"];
	}
	if (!empty($_POST["per_tel"])) {
		$personneUpdate["per_tel"] = $_POST["per_tel"];
	}
	if (!empty($_POST["per_mail"])) {
		$personneUpdate["per_mail"] = $_POST["per_mail"];
	}
	if (!empty($_POST["per_login"])) {
		$personneUpdate["per_login"] = $_POST["per_login"];
		$modifLogin = true;
	} else {
		$modifLogin=false;
	}
	if ($etudiantManager->estPresent($_SESSION["per_num"])) {
		$etudiantUpdate=$_SESSION["etudiantCible"];

		if (!empty($_POST["div_num"])) {
			$etudiantUpdate["div_num"] = $_POST["div_num"];
		}
		if (!empty($_POST["dep_num"])) {
			$etudiantUpdate["dep_num"] = $_POST["dep_num"];
		}
		$etudiant = new Etudiant($etudiantUpdate);
		$etudiant->setPer_Num($_SESSION["per_num"]);
		$etudiantManager->update($etudiant);
	}else{
		$salarieUpdate = $_SESSION["salarieCible"];

		if (!empty($_POST["fon_num"])){
			$salarieUpdate["fon_num"]=$_POST["fon_num"];
		}
		if (!empty($_POST["sal_telprof"])){
			$salarieUpdate["sal_telprof"]=$_POST["sal_telprof"];
		}

		$salarie = new Salarie($salarieUpdate);
		$salarie->setPer_Num($_SESSION["per_num"]);
		$salarieManager->update($salarie);
	}

	$personne = new Personne($personneUpdate);
	$personne->setPer_Num($_SESSION["per_num"]);
	$personneManager->update($personne);
	if ($modifLogin) {
		$_SESSION["connecte"] = false;
		$_SESSION["login"] = "";
	}
	header("Location: index.php");
}
