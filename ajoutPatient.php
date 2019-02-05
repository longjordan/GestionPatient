<?php
    include 'API.php';

    if(isset($_POST)){
        if(isset($_POST["submit"])){
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $dateNaissance = $_POST['dateNaissance'];
            $nom = $_POST['nom'];
            $genre = $_POST['genre'];
            $tel = $_POST['tel'];
            $adr = $_POST['adr'];

            addPatient($nom, $prenom, $dateNaissance, $genre, $tel, $adr);
        }
    }
?>