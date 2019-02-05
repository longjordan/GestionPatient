<?php
session_start();
 
$user["admin1"] = "12";
$user["admin2"] = "12";
$user["admin3"] = "12";
 
if (!isset($_SESSION['logged_in']))
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        if (empty($_POST['identifiant']) || empty($_POST['mdp']))
        {
            echo 'Veulliez remplir les champs';
            include("index.html");
        }
        elseif ($user[$_POST['identifiant']] != $_POST['mdp'])
        {
            echo 'Vous identifiants ou mot de passe sont incorrecte(s)';
            include("index.html");
        }
        else
        {
            $_SESSION['ingelogd'] = true;
            header("Location:accueil.html");
        }
    }
}
?>