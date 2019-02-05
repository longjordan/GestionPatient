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

?>