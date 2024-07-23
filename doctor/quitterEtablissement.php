<?php
session_start();
require_once '../config/config.php';
require_once "../config/isConnected.php";
require_once "../config/isDoctor.php";

$doctorId = $_SESSION["idDoctor"];


$sql = "DELETE FROM `dl_ratacher` WHERE doctor_id = '$doctorId'";
        $query=$bdd->prepare($sql);
        $query -> execute();

header("location:./lieuExercice.php?message=Vous avez quitté votre établissement");
exit;