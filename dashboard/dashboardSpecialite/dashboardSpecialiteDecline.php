<?php
session_start();
require_once '../../config/config.php';
error_reporting(0);
if (!$_SESSION["admin"]) {
  header('location:../../connexionAdmin/connexionAdmin.php');
  die;
}

//Refuser l'insertion d'une spécialité
$id = $_GET["id"];
$sql = "DELETE FROM `dl_specialities` WHERE specialite_id = '$id';";
$query = $bdd->prepare($sql);
$query->execute();


header("Location:dashboardSpecialiteEnAttente.php");
exit;