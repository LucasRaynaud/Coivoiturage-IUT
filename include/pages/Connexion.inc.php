<?php
$pdo=new Mypdo();
$personneManager = new PersonneManager($pdo);
if(empty($_POST["per_login"]) || empty($_POST["per_pwd"]) || empty($_POST["resultat"])){ ?>
    <h1>Pour vous connecter</h1>
    <form action="" id="insert" method="post">
        Nom d'utilisateur
        <br>
        <input type="text" name="per_login">
        <br>
        Mot de passe :
        <br>
        <input type="password" name="per_pwd">
        <br>
		<?php
		$_SESSION["random1"]=rand(1,9);
		$_SESSION["random2"]=rand(1,9);
		$_SESSION["resultat"]=$_SESSION["random1"]+$_SESSION["random2"];
		?>
        <img src="image/nb/<?php echo $_SESSION["random1"]?>.jpg" /> +
        <img src="image/nb/<?php echo $_SESSION["random2"]?>.jpg" />
        <br>
        <input type="number" name="resultat">
        <br>
        <input type="submit" value="Valider">
    </form>
<?php }

elseif ($personneManager->recupPersonneAvecLogin($_POST["per_login"])["per_pwd"] == sha1(sha1($_POST["per_pwd"]).SALT)){

    if ($personneManager->estPresent($_POST["per_login"])) {

		if ($_SESSION["resultat"] == $_POST["resultat"]){

		    if (!empty($_POST["per_login"]) && !empty($_POST["per_pwd"]) && !empty($_POST["resultat"])) {
				$_SESSION["connecte"] = true;
				$_SESSION["login"]=$_POST["per_login"];
				$_SESSION["num_pers_connecte"] = $personneManager->recupPersonneAvecLogin($_SESSION["login"])["per_num"];
				header("Location: index.php");
			}
		}
    }
} ?>