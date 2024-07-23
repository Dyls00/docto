<?php
session_start();
require_once '../../config/config.php';

    $rpps = $_POST['numero_rpps'];
    $phone = $_POST['tel'];
    $userid = $_SESSION['idUser'];

    $sql = "select * from dl_doctor where doctor_code_RPPS = '$rpps'";
    $query=$bdd->prepare($sql);
    $query -> execute();
    $result = $query -> fetchAll(); 

    if (count($result) > 0) {
        header("location:inscriptionDoctor.php?message=Numéro RPPS déjà existant");
        exit;
    } else {
        $sql = "INSERT INTO dl_doctor (doctor_code_RPPS, doctor_tel, user_id) VALUES ('$rpps','$phone','$userid')";
        $query=$bdd->prepare($sql);
        $query -> execute();

        $sql2 = "select doctor_id from dl_doctor where user_id='$userid'";
        $query2=$bdd->prepare($sql2);
        $query2 -> execute();
        $result2 = $query2 -> fetchAll(); 

        $doctor_id = $result2[0]["doctor_id"];

        $sql = "INSERT INTO `dl_specialiser`(`specialite_id`, `doctor_id`, `specialiser_price`, `specialiser_devise`) VALUES ('1','$doctor_id','30','€')";
        $query=$bdd->prepare($sql);
        $query -> execute();

        $_SESSION["doctor"] = true;
        $_SESSION["idDoctor"] = $doctor_id;
        $_SESSION["numero_rpps"] = $result2[0]["numero_rpps"];
        header("Location:inscriptionDoctorSubmitted.php");
        exit;
    }
    ?>