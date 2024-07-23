<?php
session_start();
require_once '../../config/config.php';
error_reporting(0);
if (!$_SESSION["admin"]) {
  header('location:../../connexionAdmin/connexionAdmin.php');
  die;
}

//Retirer le statut de spécialiste
$id = $_GET["id"];
$sql = "DELETE FROM dl_doctor WHERE doctor_id = '$id';";
$query = $bdd->prepare($sql);
$query->execute();


header("Location:dashboardDoctorEnregistre.php");
exit;
