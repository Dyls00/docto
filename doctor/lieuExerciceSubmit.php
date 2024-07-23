<?php
session_start();
require_once '../config/config.php';
require_once "../config/isConnected.php";
require_once "../config/isDoctor.php";

$etablissementId = $_POST["etablissement"];
$doctorId = $_SESSION["idDoctor"];


$sql = "INSERT INTO `dl_ratacher`( `doctor_id`, `etablissement_id`) VALUES ('$doctorId','$etablissementId')";
        $query=$bdd->prepare($sql);
        $query -> execute();

header("location:../user/monProfil.php");
exit;