<?php
session_start();
require_once '../../config/config.php';
error_reporting(0);
if (!$_SESSION["admin"]) {
  header('location:../../connexionAdmin/connexionAdmin.php');
  die;
}

$nom = $_POST['new_lastname'];
$prenom = $_POST['new_firstname'];
$genre = $_POST['new_genre'];
$email = $_POST['new_email'];
$password = md5($_POST['new_password']);
$tel = $_POST['new_tel'];
$date_naissance = $_POST['new_birthdate'];
$pays_residence = $_POST['new_country'];
$region = $_POST['new_region'];
$adresse_postale = $_POST['new_adress'];
$code_postal = $_POST['new_adress_code'];
$ville = $_POST['new_city'];
$pays_naissance = $_POST['new_birthplace'];
$ville_naissance = $_POST['new_birthcity'];


if (strlen($_SESSION['aemail']) == 0) {
  header('location:../../index.php');
  die();
} else {
  // Création utilisateur
  if (isset($_POST['create_user']) && isset($_SESSION['aemail']) && isset($_POST['new_firstname'])  && isset($_POST['new_lastname']) && isset($_POST['new_genre'])  && isset($_POST['new_password'])  && isset($_POST['new_tel'])  && isset($_POST['new_birthdate'])  && isset($_POST['new_country'])  && isset($_POST['new_region'])  && isset($_POST['new_adress'])  && isset($_POST['new_adress_code'])  && isset($_POST['new_city'])  && isset($_POST['new_birthplace'])  && isset($_POST['new_birthcity'])) {
    if (!empty($_SESSION['aemail']) && !empty($_POST['new_firstname'])  && !empty($_POST['new_lastname']) && !empty($_POST['new_genre'])  && !empty($_POST['new_password'])  && !empty($_POST['new_tel'])  && !empty($_POST['new_birthdate'])  && !empty($_POST['new_country'])  && !empty($_POST['new_region'])  && !empty($_POST['new_adress'])  && !empty($_POST['new_adress_code'])  && !empty($_POST['new_city'])  && !empty($_POST['new_birthplace'])  && !empty($_POST['new_birthcity'])) {
      $sql = "INSERT INTO dl_user (user_id, user_lastname, user_firstname, user_sexe, user_email, user_password, user_tel, user_birth_date, user_country, user_region, user_adress, user_adress_code, user_city, user_birth_place, user_birth_name) VALUES (DEFAULT, '$nom', '$prenom', '$genre', '$email', '$password', '$tel', '$date_naissance', '$pays_residence', '$region', '$adresse_postale', '$code_postal', '$ville', '$pays_naissance', '$ville_naissance')";      
      $query = $bdd->prepare($sql);
      $query->bindParam(':lastname', $_POST['new_lastname'], PDO::PARAM_STR);
      $query->bindParam(':firstname', $_POST['new_firstname'], PDO::PARAM_STR);
      $query->bindParam(':sexe', $_POST['new_sexe'], PDO::PARAM_STR);
      $query->bindParam(':email', $_POST['new_email'], PDO::PARAM_STR);
      $query->bindParam(':password', md5($_POST['new_password']), PDO::PARAM_STR);
      $query->bindParam(':tel', $_POST['new_tel'], PDO::PARAM_STR);
      $query->bindParam(':birth_date', $_POST['new_birth_date'], PDO::PARAM_STR);
      $query->bindParam(':country', $_POST['new_country'], PDO::PARAM_STR);
      $query->bindParam(':region', $_POST['new_region'], PDO::PARAM_STR);
      $query->bindParam(':adress', $_POST['new_adress'], PDO::PARAM_STR);
      $query->bindParam(':adress_code', $_POST['new_adress_code'], PDO::PARAM_STR);
      $query->bindParam(':city', $_POST['new_city'], PDO::PARAM_STR);
      $query->bindParam(':birth_place', $_POST['new_birth_place'], PDO::PARAM_STR);
      $query->bindParam(':birth_name', $_POST['new_birth_name'], PDO::PARAM_STR);
      $query->execute();
      $lastInsertId = $bdd->lastInsertId();
      if ($lastInsertId) {
        move_uploaded_file($_FILES["new_picture"]["tmp_name"], "../img/residentimages/" . $_FILES["new_picture"]["name"]);
        header('Location:dashboardUser.php?ajout=true');
      } else {
        header('Location:dashboardUser.php?ajout=false');
      }
    } else {
      header('Location:dashboardUser.php?champs=false');
    }
  }
}
