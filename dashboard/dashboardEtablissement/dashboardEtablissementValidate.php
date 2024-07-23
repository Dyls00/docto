<?php
session_start();
require_once '../../config/config.php';
error_reporting(0);
if (!$_SESSION["admin"]) {
  header('location:../../connexionAdmin/connexionAdmin.php');
  die;
}

//Valider l'insertion d'un établissement
$id = $_GET["id"];
$sql = "UPDATE `dl_etablissement` SET `etablissement_validate`='1' WHERE etablissement_id = '$id';";
$query = $bdd->prepare($sql);
$query->execute();


header("Location:dashboardetablissementEnAttente.php");
exit;