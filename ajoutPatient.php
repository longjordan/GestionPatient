<?php
session_start ();
include 'API.php';

//Vérification utilisateur connecté
if(!isset($_SESSION['droit'])){
    header('LOCATION:index.php');
}

//Récupération des champs du formulaire et ajout du patient
if(isset($_POST)){
    if(isset($_POST["submit"])){
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $dateNaissance = $_POST['dateNaissance'];
        $genre = $_POST['genre'];
        $tel = $_POST['tel'];
        $adr = $_POST['adr'];

        addPatient($nom, $prenom, $dateNaissance, $genre, $tel, $adr);
        header('LOCATION:recherchepatient.php');
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
    <div id="formulaire">
       <h1>Ajout des patients</h1>
       <div class="formAjout">
           <form method="post" action="">
            <div class="ligne">
                <div class="col-25">
                    <label for="nom">Nom</label>
                </div>
                <div class="col-75">
                    <input class="input" type="text" id="nom" name="nom" placeholder="nom..." >
                </div>
            </div>
            <div class="ligne">
                <div class="col-25">
                    <label for="prenom">Prénom</label>
                </div>
                <div class="col-75">
                    <input class="input" type="text" id="prenom" name="prenom" placeholder="prénom..." >
                </div>
            </div>
            <div class="ligne">
                <div class="col-25">
                    <label for="dateNaissance">Date de naissance</label>
                </div>
                <div class="col-75">
                    <input class="input" type="date" id="dateNaissance" name="dateNaissance">
                </div>
            </div>
            <div class="ligne">
                <div class="col-25">
                    <label for="genre">Genre</label>
                </div>
                <div class="col-75">
                    <input type="radio" id="genre" name="genre" value="M">M
                    <input type="radio" id="genre" name="genre" value="F">F
                </div>
            </div>
            <div class="ligne">
                <div class="col-25">
                    <label for="tel">Telephone</label>
                </div>
                <div class="col-75">
                    <input class="input" type="text" id="tel" name="tel" placeholder="téléphone...">
                </div>
            </div>
            <div class="ligne">
                <div class="col-25">
                    <label for="adr">Ville</label>
                </div>
                <div class="col-75">
                    <input class="input" type="text" id="adr" name="adr" placeholder="ville...">
                </div>
            </div>
            <div class="ligne">
                <input class="btn" name="submit" type="submit" value="Envoyer">
            </div>
            </form>
        </div>
    </div>
</body>
</html>