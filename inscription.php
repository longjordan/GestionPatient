<?php

include("db.php");

//Instanciation de la classe Mypdo
if(!isset($db)){
	$db = new Mypdo();
} 

//Inscription d'un utilisateur
if(isset($_POST)){
	if(isset($_POST["submit"])){
		$login = $_POST['login'];
		$mdp = $_POST['mdp'];
		$admin = $_POST['admin'];

		$sql = "INSERT INTO utilisateur (login, mdp, admin) VALUES (:login, :mdp, :admin)";
		$sth = $db->prepare($sql);
		

		try{
			$sth->execute(array(":login"=>$login, ":mdp"=>$mdp, ":admin"=>$admin));
			header('LOCATION:accueil.php');
		}
		catch(PDOException $err)
		{	
			echo "Erreur SQL : ".$sth->errorInfo()[2];
		}
	}
}
?>

<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Présentation </title>
	<link rel="stylesheet" media="screen" type="text/css" title="index" href="mep.css" />
</head>
<body>
	<?php include("menu.php"); ?>
	<div id="inscription">
		<h1>Inscription</h1>
		<div class="form">
			<form method="post" action="">
				<div class="ligne">
					<div class="col-25">
						<label for="login">login</label>
					</div>
					<div class="col-75">
						<input class="input" type="text" id="login" name="login" placeholder="login..." required>
					</div>
				</div>
				<div class="ligne">
					<div class="col-25">
						<label for="mdp">Mot de passe</label>
					</div>
					<div class="col-75">
						<input class="input" type="text" id="mdp" name="mdp" placeholder="mot de passe..." required>
					</div>
				</div>
				<div class="ligne">
					<div class="col-25">
						<label for="admin">Admin</label>
					</div>
					<div class="col-75">
						<input type="radio" id="admin" name="admin" value="1">Oui
						<input type="radio" id="admin" name="admin" value="0" checked>Non
					</div>
				</div>
				<div class="valider">
					<input  class="btn" type="submit" name="submit" value="Valider">
				</div>
			</form>
		</div>
	</div>
</body>
</html>