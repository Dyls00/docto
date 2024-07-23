<?php
require 'database_connection.php';

$doctor_id = $_POST['doctor_id'];
$user_id = $_POST['user_id'];
$etablissement_id = $_POST['etablissement_id'];

// Vérifiez si les données ont été soumises avec succès
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérez les valeurs des champs du formulaire depuis $_POST
    $doctor_id = isset($_POST['doctor_id']) ? $_POST['doctor_id'] : '';
    $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : '';
    $etablissement_id = isset($_POST['etablissement_id']) ? $_POST['etablissement_id'] : '';
    $rdv_start = isset($_POST['rdv_start']) ? $_POST['rdv_start'] : '';
    $rdv_end = isset($_POST['rdv_end']) ? $_POST['rdv_end'] : '';
    $rdv_type = isset($_POST['rdv_type']) ? $_POST['rdv_type'] : '';
    $rdv_motif = isset($_POST['rdv_motif']) ? $_POST['rdv_motif'] : '';
}
    // Effectuez l'insertion dans la base de données
    $insert_query = "INSERT INTO `dl_rdv` (`rdv_id`, `user_id`, `etablissement_id`, `doctor_id`, `rdv_start`, `rdv_end`, `rdv_type`, `rdv_motif`) VALUES (NULL, '$user_id', '$etablissement_id', '$doctor_id', '$rdv_start', '$rdv_end', '$rdv_type', '$rdv_motif')";

    if (mysqli_query($con, $insert_query)) {
        // Redirigez en incluant les paramètres de requête
        header("location: /pages/formulaire.php?doctor_id=$doctor_id&user_id=$user_id&etablissement_id=$etablissement_id");
        exit;
    } else {
        $data = array(
            'status' => false,
            'msg' => 'Désolé, l\'événement n\'a pas été ajouté.'
        );
        echo json_encode($data);
    }
?>