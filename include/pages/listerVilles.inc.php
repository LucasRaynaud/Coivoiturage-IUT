
<?php
$pdo=new Mypdo();
$villeManager = new VilleManager($pdo);
$villes=$villeManager->getAllVilles();
$nbVilles = $villeManager->getNbVilles();
?>
<div class="sstitre"><h2>Liste des villes</h2></div>
Actuellement <?php echo $nbVilles?> ville(s)
<table>
    <tr><th>Numéro</th><th>Nom</th></tr>
	<?php
	foreach ($villes as $ville){ ?>
        <tr><td><?php echo $ville->getVil_Num();?>
            </td><td><?php echo $ville->getVil_nom();?>
            </td></tr>
	<?php } ?>
</table>
<br>