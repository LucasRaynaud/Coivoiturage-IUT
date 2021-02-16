<?php
$pdo = new Mypdo();
$divisionManager = new DivisionManager($pdo);
$annees = $divisionManager->getAllAnnees();
$departementManager = new DepartementManager($pdo);
$departements = $departementManager->getAllDepartements();
$fonctionManager = new FonctionManager($pdo);
$fonctions = $fonctionManager->getAllFonctions();
$villeManager = new VilleManager($pdo);

if (empty($_POST["per_login"]) && empty($_POST["per_nom"]) && empty($_POST["per_prenom"]) && empty($_POST["per_tel"])
	&& empty($_POST["per_mail"]) && empty($_POST["per_pwd"]) && empty($_POST["dep_num"]) && empty($_POST["div_num"])
	&& empty($_POST["sal_telprof"]) && empty($_POST["fon_num"])) {
	?>
    <h1>Ajouter une personne</h1>
    <form action="index.php?page=1" id="insert" method="POST">
        <table>
            <tr>
                <td> Nom : </td> <td> <input type="text" name="per_nom"> </td>
                <td> Prénom : </td> <td><input type="text" name="per_prenom"> </td>
            </tr>
            <tr>
                <td> Téléphone : </td><td><input type="text" name="per_tel"> </td>
                <td> Mail : </td><td><input type="text" name="per_mail"> </td>
            </tr>
            <tr>
                <td> Login : </td><td><input type="text" name="per_login"> </td>
                <td> Mot de passe : </td><td><input type="password" name="per_pwd"> </td>
            </tr>
            <br>
        </table>
        Catégorie : <input type="radio" checked name="categorie" value="etudiant"> Etudiant
        <input type="radio" name="categorie" value="personnel"> Personnel
        <br>
        <input type="submit" value="Valider"/>
    </form><?php
} else {
	if (empty($_POST["div_num"]) && empty($_POST["dep_num"]) && empty($_POST["fon_num"]) && empty($_POST["sal_telprof"])) {
		if ($_POST["categorie"] == "etudiant") {
			$_SESSION["personne"] = serialize(new Personne($_POST));
			?>
            <form action="index.php?page=1" id="insert" method="post">
                <h1>Ajouter un étudiant</h1>
                Année : <select name="div_num"><?php
					foreach ($annees as $annee) {
						?>
                    <option value=<?php echo $annee->getDiv_num() ?>>
						<?php echo $annee->getDiv_Nom(); ?>
                        </option><?php
					} ?></select>
                <br>
                Département : <select name="dep_num"><?php
					foreach ($departements as $departement) {
						?>
                    <option value=<?php echo $departement->getDep_Num() ?>>
						<?php echo $departement->getDep_Nom() . " - " . $villeManager->recupVille($departementManager->recupDepartement($departement->getDep_Num())["vil_num"])["vil_nom"]; ?>
                        </option><?php
					} ?></select>
                <br>
                <input type="submit" value="Valider"/>
            </form>
			<?php
		} elseif ($_POST["categorie"] == "personnel") {
			$_SESSION["personne"] = serialize(new Personne($_POST)); ?>
            <form action="index.php?page=1" id="insert" method="post">
            <h1>Ajouter un salarié</h1>
            Téléphone professionnel : <input type="text" name="sal_telprof">
            <br>
            Fonction : <select name="fon_num"><?php
				foreach ($fonctions as $fonction) {
					?>
                    <option value=<?php echo $fonction->getFon_Num() ?>>
						<?php echo $fonction->getFon_Libelle(); ?>
                    </option>
					<?php
				} ?>
            </select>
            <br>
            <input type="submit" value="Valider"/>
            </form><?php
		}
	} elseif ((!empty($_POST["div_num"]) && !empty($_POST["dep_num"])) || (!empty($_POST["fon_num"]) && !empty($_POST["sal_telprof"]))) {
		$personne = unserialize($_SESSION["personne"]);
		$personneManager = new PersonneManager($pdo);
		$num_pers = $personneManager->add($personne);
		if (!empty($_POST["div_num"]) && !empty($_POST["dep_num"])) {
			$etudiantManager = new EtudiantManager($pdo);
			$etudiant = new Etudiant($_POST);
			$etudiant->setPer_Num($num_pers);
			$etudiant->setDiv_Num($_POST["div_num"]);
			$etudiant->setDep_Num($_POST["dep_num"]);
			$retour = $etudiantManager->add($etudiant);
			if ($retour != 0) {
				?>
                <img src="image/valid.png"/>
				<?php echo "L'étudiant' a été ajouté" ?>
				<?php
			} else {
				?><img src="image/erreur.png"/><?php
				echo "L'étudiant' n'a pas été ajouté";
			}
		}
		if (!empty($_POST["fon_num"]) && !empty($_POST["sal_telprof"])) {
			$salarieManager = new SalarieManager($pdo);
			$salarie = new Salarie($_POST);
			$salarie->setPer_Num($num_pers);
			$salarie->setSal_Telprof($_POST["sal_telprof"]);
			$salarie->setFon_num($_POST["fon_num"]);
			$retour = $salarieManager->add($salarie);
			if ($retour != 0) {
				?>
                <img src="image/valid.png"/>
				<?php echo "Le salarié a été ajouté";
			} else {
				?><img src="image/erreur.png"/>
				<?php echo "Le salarié n'a pas été ajouté";
			}
		}
	}
}