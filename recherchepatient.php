<?php
session_start ();
include 'API.php';

//Vérification utilisateur connecté
if(!isset($_SESSION['droit'])){
    header('LOCATION:index.php');
}

//Envoie sur modifierPatient, si bouton modifier cliqué
if(isset($_POST)){
    if(isset($_POST["modifier"])){
        header('LOCATION:modifierPatient.php');
    }
}

//Supression du patient, si bouton supprimé cliqué
if(isset($_POST)){
    if(isset($_POST["supprimer"])){
        deletePatient($patient->id);
        header('LOCATION:accueil.php');
    }
}

?>

<!--Récupération dans value des différents champs correspondant au patient-->
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
        <h1>Patient</h1>
        <form method="post" action="">
            <div class="ligne">
                <div class="col-25">
                    <label for="nom">Nom</label>
                </div>
                <div class="col-75">
                    <input class="input" disabled type="text" id="nom" name="nom" placeholder="nom..." value="<?php if(isset ($_SESSION['patient'] -> name[0] -> family)) { 
                        echo($_SESSION['patient'] -> name[0] -> family);
                    } else {
                        echo '';
                    }  ?>">
                </div>
            </div>
            <div class="ligne">
                <div class="col-25">
                    <label for="prenom">Prénom</label>
                </div>
                <div class="col-75">
                    <input class="input" disabled type="text" id="prenom" name="prenom" placeholder="prénom..." value="<?php if(isset ($_SESSION['patient'] -> name[0] -> given[0])) { 
                        echo($_SESSION['patient'] -> name[0] -> given[0]);
                    } else {
                        echo '';                                       
                    } ?>">
                </div>
            </div>
            <div class="ligne">
                <div class="col-25">
                    <label for="dateNaissance">Date de naissance</label>
                </div>
                <div class="col-75">
                    <input class="input" disabled type="date" id="dateNaissance" name="dateNaissance" value="<?php if(isset ($_SESSION['patient']-> birthDate)) { 
                        echo(date("Y-m-d", strtotime($_SESSION['patient']-> birthDate)));
                    } else {
                        echo '';
                    }  ?>">
                </div>
            </div>
            <div class="ligne">
                <div class="col-25">
                    <label for="genre">Genre</label>
                </div>
                <div class="col-75">
                    <input disabled type="radio" id="genre" name="genre" value="M" <?php
                    if(($_SESSION['patient']-> gender) == 'male') { echo 'checked="checked"' ; }
                    ?> 
                    >M

                    <input disabled type="radio" id="genre" name="genre" value="F" <?php
                    if(($_SESSION['patient']-> gender) == 'female') { echo 'checked="checked"' ; }
                    ?> 
                    >F
                </div>
            </div>
            <div class="ligne">
                <div class="col-25">
                    <label for="tel">Telephone</label>
                </div>
                <div class="col-75">
                    <input class="input" disabled type="text" id="tel" name="tel" placeholder="téléphone..." value="<?php if(isset ($_SESSION['patient'] -> telecom[0] -> value)) { 
                        echo($_SESSION['patient'] -> telecom[0] -> value);
                    } else {
                        echo '';
                    }  ?>">
                </div>
            </div>
            <div class="ligne">
                <div class="col-25">
                    <label for="adr">Ville</label>
                </div>
                <div class="col-75">
                    <input class="input" disabled type="text" id="adr" name="adr" placeholder="ville..." value="<?php if(isset ($_SESSION['patient'] -> address[0] -> city)) { 
                        echo($_SESSION['patient'] -> address[0] -> city);
                    } else {
                        echo '';
                    }  ?>">
                </div>
            </div>
            <div class="validerRecherche">
                <input class="btn" type="submit" name="modifier" value="Modifier">
            </div>
            <div class="validerRecherche2">
                <?php 
                if($_SESSION['droit'] == 1){ ?>
                <input class="btn" type="submit" name="supprimer" value="Supprimer"><br>
                <?php
            }?>
            </div>
        </form>
    </div>
</body>

</html>