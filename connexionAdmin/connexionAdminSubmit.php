<?php
session_start();
require_once '../config/config.php';

$email = $_POST['email'];
$password = md5($_POST['password']);

$sql = "SELECT user_email, user_password, user_id FROM dl_user WHERE user_email = '$email' AND user_password = '$password'";
$query = $bdd->prepare($sql);
$query->execute();
$result = $query->fetchAll();

if (count($result) > 0) {
    $userId = $result[0]["user_id"];
    $_SESSION["idUser"] = $userId;
    $_SESSION["connecte"] = true;


    $sql2 = "SELECT * from dl_admin where user_id = '$userId'";
    $query2 = $bdd->prepare($sql2);
    $query2->execute();
    $result2 = $query2->fetchAll();
    if(count($result2) > 0){
        $_SESSION["admin"] = true;
        $_SESSION["idadmin"] = $result2[0]["user_id"];
        header("Location:../dashboard/dashboard.php");
        exit;
    }
} else {
    header("Location:connexionAdmin.php?message=Identifiants Incorrects");
    exit;
}