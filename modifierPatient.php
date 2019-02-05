<?php
    session_start ();
    include 'API.php';

    if(isset($_POST)){
        if(isset($_POST["submit"])){
            $id = $_SESSION['patient'] -> id;
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $dateNaissance = $_POST['dateNaissance'];
            $genre = $_POST['genre'];
            $tel = $_POST['tel'];
            $adr = $_POST['adr'];

            putPatient($id, $nom, $prenom, $dateNaissance, $genre, $tel, $adr);
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
    	<div id="formulaire">
	        <h1>Modification du patient</h1>
	        <div class="formAjout">
	            <form method="post" action="">
                <div class="ligne">
                    <div class="col-25">
                        <label for="nom">Nom</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="nom" name="nom" placeholder="nom..." value="<?php if(isset ($_SESSION['patient'])) { echo($_SESSION['patient'] -> name[0] -> family);}  ?>">
                    </div>
                </div>
                <div class="ligne">
                    <div class="col-25">
                        <label for="prenom">Prénom</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="prenom" name="prenom" placeholder="prénom..." value="<?php if(isset ($_SESSION['patient'])) { echo($_SESSION['patient'] -> name[0] -> given[0]);}  ?>">
                    </div>
                </div>
                <div class="ligne">
                    <div class="col-25">
                        <label for="dateNaissance">Date de naissance</label>
                    </div>
                    <div class="col-75">
                        <input type="date" id="dateNaissance" name="dateNaissance" value="<?php if(isset ($_SESSION['patient'])) { echo($_SESSION['patient']-> birthDate);}  ?>">
                    </div>
                </div>
                <div class="ligne">
                    <div class="col-25">
                        <label for="genre">Genre</label>
                    </div>
                    <div class="col-75">
                        <input type="radio" id="genre" name="genre" value="M" <?php
                                if(($_SESSION['patient']-> gender) == 'male') { echo 'checked="checked"' ; }
                            ?> 
                        >M
                            
                        <input type="radio" id="genre" name="genre" value="F" <?php
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
                        <input type="text" id="tel" name="tel" placeholder="téléphone..." value="<?php if(isset ($_SESSION['patient'])) { echo($_SESSION['patient'] -> telecom[0] -> value);}  ?>">
                    </div>
                </div>
                <div class="ligne">
                    <div class="col-25">
                        <label for="adr">Ville</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="adr" name="adr" placeholder="ville..." value="<?php if(isset ($_SESSION['patient'])) { echo($_SESSION['patient'] -> address[0] -> city);}  ?>">
                    </div>
                </div>
                <div class="ligne">
                    <input class="envoye" name="submit" type="submit" value="Envoyer">
                </div>
	            </form>
	        </div>
	    </div>
    </body>
    
</html>