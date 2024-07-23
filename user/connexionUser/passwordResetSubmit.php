<?php
session_start();
require_once '../../config/config.php';


if (isset($_POST['password']) && isset($_POST['confirmPassword']) && isset($_SESSION['email'])) {


    $password = md5($_POST['password']);
    $confirmPassword = md5($_POST['confirmPassword']);
    $email = $_SESSION['email'];

    if ($password != $confirmPassword) {

        header('Location:passwordResetPage.php?message=Saisir un mot de passe identique');
        exit;
    }


    $sql = "UPDATE dl_user SET user_password = '$password' WHERE user_email = '$email'";
    $query = $bdd->prepare($sql);
    $query->execute();

    header('Location:connexionUser.php?message=Mot de passe modifié avec succès');
    exit;
}
