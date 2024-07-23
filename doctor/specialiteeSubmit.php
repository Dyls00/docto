<?php
session_start();
require_once '../config/config.php';
require_once "../config/isConnected.php";
require_once "../config/isDoctor.php";

$specialiteId = $_POST["specialite"];
$doctorId = $_SESSION["idDoctor"];
$prix = $_POST["prix"];
$devise = $_POST["devise"];

$sql = "select * from `dl_specialiser` where specialite_id = '$specialiteId' and doctor_id = '$doctorId'";
        $query=$bdd->prepare($sql);
        $query -> execute();
        $results = $query->fetchAll();

if(count($results)> 0){
    header("location:./specialites.php?message=Vous êtes déjà affilié à cette spécialité.");
    exit;
}




$sql = "INSERT INTO `dl_specialiser`(`specialite_id`, `doctor_id`, `specialiser_price`, `specialiser_devise`) VALUES ('$specialiteId','$doctorId','$prix','$devise')";
        $query=$bdd->prepare($sql);
        $query -> execute();

header("location:../user/monCompte.php");
exit;