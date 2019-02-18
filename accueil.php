<?php 
session_start ();

    include 'API.php';

    if(!isset($_SESSION['droit'])){
        header('LOCATION:index.php');
    }

    if(isset($_POST)){
        if(isset($_POST["submit"])){
            $id = $_POST['id'];
            getPatient($id);
            if(!isset($_SESSION['erreur'])){
                header('LOCATION:recherchepatient.php');
            }
        }
    }

    if(isset($_SESSION)){
        if(isset($_SESSION['patient'])){
            $patient = $_SESSION['patient'];
        }
    }
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Présentation </title>
        <link rel="stylesheet" media="screen" type="text/css" title="index" href="mep.css" />
        <link rel="shortcut icon" href="icone.png"/>
    </head>
    <body>
        <?php include("menu.php"); ?>
        <div>
            <?php 
                if(isset($_SESSION['erreur'])){
                    echo $_SESSION['erreur'];
                    unset($_SESSION['erreur']);
                }
            ?>
        </div>
        <div id="formulaire">
            <h1>Recherche d'un patient</h1>
            <div class="formAjout">
            	<form method="post" action="">
                    <div>
                        <div class="col-25">
                            <label for="id">Rentrer l'ID du patient</label>
                        </div>
                        <div class="col-75">
                            <input class="input" type="text" id="id" name="id" placeholder="ID du patient..." required>
                        </div>
                    </div>

                    <div>
                        <input class="btn" name="submit" type="submit" value="Rechercher">
                    </div>
	            </form>
            </div>
        </div>
    </body>
    
</html>