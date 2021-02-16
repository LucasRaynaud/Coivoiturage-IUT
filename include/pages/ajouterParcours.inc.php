<h1>Ajouter un parcours</h1>

<?php
$pdo = new Mypdo();
$villeManager = new VilleManager($pdo);
$villes = $villeManager->getAllVilles();

if (empty($_POST["vil_num1"]) || empty($_POST["vil_num2"]) || empty($_POST["par_km"]) || $_POST["vil_num1"] == $_POST["vil_num2"] && $_POST["par_km"]>0) {
    ?>
    <form action="index.php?page=5" id="insert" method="post">
    <table>
        <td>Ville 1 :</td>
        <td><select name="vil_num1"><?php
            foreach ($villes as $villes1) {
                ?>
            <option value=<?php echo $villes1->getVil_Num() ?>>
                <?php echo $villes1->getVil_Nom(); ?>
                </option><?php
            } ?></select></td>

        <td>Ville 2 : </td>
        <td><select name="vil_num2"><?php
            foreach ($villes as $villes1) {
                ?>
            <option value=<?php echo $villes1->getVil_Num() ?>>
                <?php echo $villes1->getVil_Nom(); ?>
                </option><?php
            } ?></select></td>

        <td>Nombre de kilomètre(s) <input type="number" name="par_km"></td>
        <br>
        </table>
        <input type="submit" value="Valider"/>
    </form>
    <?php
} else {
    $parcoursManager = new ParcoursManager($pdo);
    $parcours = new Parcours($_POST);

    $retour = $parcoursManager->add($parcours);
    if ($retour != 0) {
        ?>
        <img src="image/valid.png"/>
        <?php echo "Le parcours a été ajoutée" ?>
        <?php
    } else {
        ?><img src="image/erreur.png"/><?php
        echo "Le parcours n'a pas été ajoutée";
    }
}
