<?php
session_start();
require_once '../../config/config.php';
error_reporting(0);
if (!$_SESSION["admin"]) {
  header('location:../../connexionAdmin/connexionAdmin.php');
  die;
}

//Valider l'inscription d'un docteur
$id = $_GET["id"];
$sql = "UPDATE `dl_doctor` SET `doctor_validate`='1' WHERE doctor_id = '$id';";
$query = $bdd->prepare($sql);
$query->execute();

// Récupérer les informations du docteur et de l'utilisateur associé
$sql2 = "SELECT * FROM dl_doctor WHERE doctor_id = '$id'";
$query2 = $bdd->prepare($sql2);
$query2->execute();
$result2 = $query2->fetch();

$userId = $result2["user_id"];
$sql3 = "SELECT * FROM dl_user WHERE user_id = '$userId'";
$query3 = $bdd->prepare($sql3);
$query3->execute();
$result3 = $query3->fetch();

$email = $result3['user_email'];

// Envoyer l'email de confirmation
//Commentaires à retirer et mettre la bonne adresse mail
// $expediteur = 'ProjectLab01234@gmail.com';
// $message = 'Bonjour, votre inscription en tant que spécialiste a été validée.';
// $retour = mail($email, 'Nouvelle Inscription', $message, 'From: ' . $expediteur);

header("Location:dashboardDoctorEnAttente.php");
exit;