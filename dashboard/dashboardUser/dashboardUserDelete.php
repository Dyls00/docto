<?php
session_start();
require_once '../../config/config.php';
error_reporting(0);
if (!$_SESSION["admin"]) {
  header('location:../../connexionAdmin/connexionAdmin.php');
  die;
} else {

    $id = $_GET["id"];

    $sql = "DELETE FROM `dl_user_photo` WHERE user_id = '$id'";
    $query = $bdd->prepare($sql);
    $query->execute();

    $sql = "DELETE FROM `dl_user` WHERE user_id = '$id'";
    $query = $bdd->prepare($sql);
    $query->execute();

    header("location:./dashboardUser.php");
    exit;
}
