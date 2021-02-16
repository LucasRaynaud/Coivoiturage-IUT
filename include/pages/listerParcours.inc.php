<?php
$pdo = new Mypdo();
$parcoursManager = new ParcoursManager($pdo);
$parcours = $parcoursManager->getAllParcours();
$nbParcours = $parcoursManager->getNbParcours();
?>
<div class="sstitre"><h2>Liste des parcours</h2></div>
Actuellement <?php echo $nbParcours ?> parcours
<table>
    <tr>
        <th>Numéro</th>
        <th>Nom ville</th>
        <th>Nom ville</th>
        <th>Nombre de Km</th>
    </tr>
    <?php
    foreach ($parcours as $parcours1) { ?>
        <tr>
            <td><?php echo $parcours1->par_num; ?>
            </td>
            <td><?php echo $parcours1->vil_nom1; ?>
            </td>
            <td><?php echo $parcours1->vil_nom2; ?>
            </td>
            <td><?php echo $parcours1->par_km; ?>
            </td>
        </tr>
    <?php } ?>
</table>
<br>
