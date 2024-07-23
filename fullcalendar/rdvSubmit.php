<?php
require 'database_connection.php';

$doctor_id = $_POST['doctor_id'];
$user_id = $_POST['user_id'];
$etablissement_id = $_POST['etablissement_id'];

// Vérifiez si les données ont été soumises avec succès
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérez les valeurs des champs du formulaire depuis $_POST
    $reponse1 = isset($_POST['reponse1']) ? $_POST['reponse1'] : '';
    $reponse2 = isset($_POST['reponse2']) ? $_POST['reponse2'] : '';

    // Effectuez l'insertion dans la base de données
    $insert_query = "INSERT INTO `dl_rdv_doctor` (`user_id`,`reponse1`, `reponse2`) VALUES ('$user_id', '$reponse1', '$reponse2')";

    if (mysqli_query($con, $insert_query)) {
        // Redirigez en incluant les paramètres de requête
        header("location: calendar.php?doctor_id=$doctor_id&user_id=$user_id&etablissement_id=$etablissement_id");
        exit;
    } else {
        $data = array(
            'status' => false,
            'msg' => 'Désolé, les informations n\'ont pas été ajoutées.'
        );
        echo json_encode($data);
    }
}
?>
