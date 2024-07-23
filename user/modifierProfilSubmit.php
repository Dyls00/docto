<?php
session_start();
require_once '../config/isConnected.php';
require_once '../config/config.php';
    $idUser = $_SESSION['idUser'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $adresse_postale = $_POST['adresse'];
    $code_postal = $_POST['codePostal'];
    $ville = $_POST['ville'];
    $telPro = $_POST["telPro"];

    $sql = "UPDATE `dl_user` SET `user_lastname`='$nom'
    ,`user_firstname`='$prenom',`user_tel`='$tel'
    ,`user_adress`='$adresse_postale',`user_adress_code`='$code_postal'
    ,`user_city`='$ville',`user_email`='$email' WHERE user_id = '$idUser'";
    $query=$bdd->prepare($sql);
    $query -> execute();

    $sql = "UPDATE `dl_doctor` SET `doctor_tel`='$telPro' WHERE user_id = '$idUser'";
    $query=$bdd->prepare($sql);
    $query -> execute();

    header("location:monProfil.php");
    exit;
    ?>