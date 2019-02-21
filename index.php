<?php
include("db.php");

//Ouvre une session si inexistante
if(session_status() === PHP_SESSION_NONE){
    session_start();
}

//Vide la variable : déconnexion
if(isset($_SESSION)){
    unset($_SESSION['droit']);
}

//Instanciation de la classe Mypdo
if(!isset($db)){
    $db = new Mypdo();
} 

//Connexion à l'application
if(isset($_POST)){
    if(isset($_POST["submit"])){
        $login = $_POST['identifiant'];
        $mdp = $_POST['mdp'];

        if(empty($login) || empty($mdp)){ //Si login ou mdp vide
            echo 'Veuillez remplir les champs';
        }else{
            $sql = "SELECT * FROM utilisateur WHERE login = :login AND mdp = :mdp";
            $sth = $db->prepare($sql);
            $sth->execute(array(":login"=>$login, ":mdp"=>$mdp));
            $res = $sth->fetchAll();
            if(count($res) == 1){ //Vérification login et mdp correspondent
                $_SESSION['droit'] = $res[0]["admin"];
                $_SESSION['login'] = $res[0]["login"];
                header("Location:accueil.php");
            }else{
                echo 'Votre login ou mot de passe sont incorrecte(s)';
            }
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
   <div id="connexion">
       <h1>Gestion des patients</h1>
       <div class="form">
           <form method="post" action="">
               <div class="identifiant">
                   <input class="input" type="text" id="identifiant" name="identifiant" placeholder="identifiant..." required>
               </div>
               <div class="mdp">
                   <input class="input" type="text" id="mdp" name="mdp" placeholder="mot de passe..." required>
               </div>
               <div class="valider">
                   <input class="btn" type="submit" name="submit" value="Valider">
               </div>
           </form>
       </div>
   </div>
</body>

</html>