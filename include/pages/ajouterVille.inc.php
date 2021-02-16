<h1>Ajouter une ville</h1>

<?php
$pdo = new Mypdo();
$villeManager=new VilleManager($pdo);
if (empty($_POST["vil_nom"])){?>
    <form action="index.php?page=7" id="insert" method="post">
        <table>
            <td> Nom : </td><td><input type="text" name="vil_nom"></td>

        </table>
        <input type="submit" value="Valider"/>
    </form>
	<?php
}else {
	if (!$villeManager->estPresente($_POST["vil_nom"])){

		$ville=new Ville($_POST);

		$retour = $villeManager->add($ville);
		if ($retour != 0){
			?>
            <img src="image/valid.png"/>
			<?php echo "La ville ".$_POST["vil_nom"]." a été ajoutée" ?>
			<?php
		}else{
			?><img src="image/erreur.png"/><?php
			echo "La ville ".$_POST["vil_nom"]." n'a pas été ajoutée";
		}
	}else{ print("La ville est deja dans la base de données"); }
}
