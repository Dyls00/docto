<?php
session_start();
require_once '../config/config.php';
error_reporting(0);
if (strlen($_SESSION['aemail']) == 0 && $_SESSION['admin_id'] == 1) {
  header('location:index.php');
  die();
} else {
  // Suppression admin
  if (isset($_POST['delete']) && isset($_POST['delete_admin']) && isset($_POST['id'])) {
    $id = intval($_POST['id']);

    $sql = "DELETE FROM hh_admin WHERE id = :id";
    $query = $bdd->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    if ($query->execute()) {
      header('Location:../registeredAdmins.php?modification=true');
    } else {
      header('Location:../registeredAdmins.php?modification=false');
    }
  }
}
