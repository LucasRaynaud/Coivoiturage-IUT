<h1>Supprimer personne</h1>
<?php
$pdo = new Mypdo();
$personneManager = new PersonneManager($pdo);
$personnes = $personneManager->getAllPersonnes();
$salarieManager = new SalarieManager($pdo);
$etudiantManager=new EtudiantManager($pdo);
if (empty($_GET["per_num"])){
	?>
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
				<td><a href="index.php?page=4&per_num=<?php echo $personne->getPer_Num() ?>">Supprimer</a></td>
			</tr>
		<?php } ?>
	</table>
<?php } elseif($salarieManager->estPresent($_GET["per_num"])){
	$personneCible = $personneManager->recupPersonne($_GET["per_num"]);
	$salarieManager->supprimerSalarie($personneCible);
	$personneManager->supprimerPersonne($personneCible);
	header("Location: index.php");
} else{
	$personneCible = $personneManager->recupPersonne($_GET["per_num"]);
	$etudiantManager->supprimerEtudiant($personneCible);
	$personneManager->supprimerPersonne($personneCible);
	header("Location: index.php");
}
