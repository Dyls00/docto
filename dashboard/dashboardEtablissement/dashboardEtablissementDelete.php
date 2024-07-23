<?php
session_start();
require_once '../../config/config.php';
error_reporting(0);
if (!$_SESSION["admin"]) {
  header('location:../../connexionAdmin/connexionAdmin.php');
  die;
}

//Supprimer un établissement
$id = $_GET["id"];
$sql = "DELETE FROM `dl_ratacher` WHERE etablissement_id = '$id';";
$query = $bdd->prepare($sql);
$query->execute();

$sql = "DELETE FROM `dl_etablissement_photo` WHERE etablissement_id = '$id';";
$query = $bdd->prepare($sql);
$query->execute();

$sql = "DELETE FROM dl_etablissement WHERE etablissement_id = '$id';";
$query = $bdd->prepare($sql);
$query->execute();


header("Location:dashboardEtablissementEnregistre.php");
exit;
