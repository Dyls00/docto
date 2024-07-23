<?php
session_start();
require_once '../config/config.php';
error_reporting(0);
if ($_SESSION['admin_id'] == 1) {
  header('location:index.php');
  die();
} else {
  // Création admin
  if (isset($_POST['create_admin']) && isset($_SESSION['apseudo']) && isset($_POST['new_email']) && isset($_POST['new_password']) && isset($_POST['new_pseudo']) && isset($_POST['new_retirementHouse'])) {
    if (!empty($_SESSION['apseudo']) && !empty($_POST['new_email']) && !empty($_POST['new_password']) && !empty($_POST['new_pseudo']) && !empty($_POST['new_retirementHouse'])) {
      $sql = "INSERT INTO dl_admin(admin_id, user_id) VALUES(DEFAULT, user_id)";
      $query = $bdd->prepare($sql);

      $query->bindParam(':user_id', $_POST['new_user'], PDO::PARAM_STR);
      $query->execute();
      $lastInsertId = $bdd->lastInsertId();
      if ($lastInsertId) {
        header('Location:../dashboardAdmin.php?ajout=true');
      } else {
        header('Location:../dashboardAdmin.php?ajout=false');
      }
    } else {
      header('Location:../dashboardAdmin.php?champs=false');
    }
  }
}
