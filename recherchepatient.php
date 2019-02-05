    <?php
    session_start ();
    include 'API.php';

    if(isset($_POST)){
        if(isset($_POST["submit"])){
            $id = $_POST['id'];
            getPatient($id);
        }
    }

    if(isset($_SESSION)){
        if(isset($_SESSION['patient'])){
            $patient = $_SESSION['patient'];
        }
    }
    echo $patient->id;

    if(isset($_POST)){
        if(isset($_POST["modifier"])){
            header('LOCATION:modifierPatient.php');
        }
    }

    if(isset($_POST)){
        if(isset($_POST["supprimer"])){
            deletePatient($patient->id);
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
    <form method="post" action="">
        <div class="valider">
            <input type="submit" name="modifier" value="Modifier">
        </div>
        <div class="valider">
            <input type="submit" name="supprimer" value="Supprimer"><br>
        </div>
    </form>
</body>

</html>