<?php
session_start();
require_once '../config/config.php';
require_once "../config/isConnected.php";
require_once "../config/isDoctor.php";

    $nomSpecialitee = $_POST["nom"];
    $descriptionSpecialitee = str_replace("'", "\'", $_POST["description"]);

    $sqls = "SELECT * FROM dl_specialities WHERE specialite_name = '$nomSpecialitee'" ;
    $query=$bdd->prepare($sqls);
    $query -> execute();
    $result = $query -> fetchAll(); 

    if (count($result) > 0) {
        header("Location:ajoutSpecialitee.php?message=Cette spécialité existe déjà.");
        exit;
    } else {
    
        $sql = "INSERT INTO `dl_specialities`(`specialite_name`, `specialite_description`, `specialite_validate`) VALUES ('$nomSpecialitee','$descriptionSpecialitee','0')";
        $query=$bdd->prepare($sql);
        $query -> execute();

        header("location:ajoutSpecialitee.php?message=Votre demande a été transmise merci de patienter qu'un administrateur valide votre demande.");
        exit;
    }
