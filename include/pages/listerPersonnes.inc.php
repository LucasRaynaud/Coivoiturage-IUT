<?php
$pdo = new Mypdo();
$personneManager = new PersonneManager($pdo);
$nbPersonnes = $personneManager->getNbPersonnes();
$personnes = $personneManager->getAllPersonnes();
$salarieManager = new SalarieManager($pdo);
$fonctionManager = new FonctionManager($pdo);
$etudiantManager = new EtudiantManager($pdo);
$departementManager = new DepartementManager($pdo);
$villeManager = new VilleManager($pdo);
if (empty($_GET["per_num"])) {
	?>
    <div class="sstitre"><h2>Liste des personnes enregistrées</h2></div>
    Actuellement <?php echo $nbPersonnes ?> personne(s)
    <table>
        <tr>
            <th>Numéro</th>
            <th>Nom</th>
            <th>Prenom</th>
        </tr>
		<?php
		foreach ($personnes as $personne) { ?>
            <tr>
                <td>
                    <a href="index.php?page=2&per_num=<?php echo $personne->getPer_Num() ?>"><?php echo $personne->getPer_num(); ?></a>
                </td>
                <td><?php echo $personne->getPer_Nom(); ?></td>
                <td><?php echo $personne->getPer_Prenom(); ?></td>
            </tr>

		<?php } ?>
    </table>
<?php } elseif ($salarieManager->estPresent($_GET["per_num"])) {
	$personneCible = $personneManager->recupPersonne($_GET["per_num"]);
	$salarieCible = $salarieManager->recupSalarie($_GET["per_num"]);
	?>
    <h1>Détail sur le salarié <?php echo $personneCible["per_nom"] ?></h1>
    <table>
        <tr>
            <th>Prénom</th>
            <th>Mail</th>
            <th>Tel</th>
            <th>Tel pro</th>
            <th>Fonction</th>
        </tr>
        <tr>
            <td><?php echo $personneCible["per_prenom"] ?></td>
            <td><?php echo $personneCible["per_mail"] ?></td>
            <td><?php echo $personneCible["per_tel"] ?></td>
            <td><?php echo $salarieCible["sal_telprof"] ?></td>
            <td><?php echo $fonctionManager->recupFonctionLibelle($salarieCible["fon_num"])["fon_libelle"]; ?></td>
        </tr>
    </table>
	<?php
} else {
	$personneCible = $personneManager->recupPersonne($_GET["per_num"]);
	$etudiantCible = $etudiantManager->recupEtudiant($_GET["per_num"]);
	?>
    <h1>Détail sur l'étudiant <?php echo $personneCible["per_nom"] ?></h1>
    <table>
        <tr>
            <th>Prénom</th>
            <th>Mail</th>
            <th>Tel</th>
            <th>Département</th>
            <th>Ville</th>
        </tr>
        <tr>
            <td><?php echo $personneCible["per_prenom"] ?></td>
            <td><?php echo $personneCible["per_mail"] ?></td>
            <td><?php echo $personneCible["per_tel"] ?></td>
            <td><?php echo $departementManager->recupDepartement($etudiantCible["dep_num"])["dep_nom"] ?></td>
            <td><?php echo $villeManager->recupVille($departementManager->recupDepartement($etudiantCible["dep_num"])["vil_num"])["vil_nom"] ?></td>
        </tr>
    </table>
<?php } ?>