<?php
require 'database_connection.php';
$doctor_id = $_POST['doctor_id'];
$user_id = $_POST['user_id'];
$etablissement_id = $_POST['etablissement_id'];

// Vérifiez si les données ont été soumises avec succès
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérez les valeurs des champs du formulaire depuis $_POST
    $pour_qui = isset($_POST['reponse1']) ? $_POST['reponse1'] : '';
    $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
    $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : '';
    $genre = isset($_POST['genre']) ? $_POST['genre'] : '';
    $date_naissance = isset($_POST['date_naissance']) ? $_POST['date_naissance'] : '';
    $ville_naissance = isset($_POST['ville_naissance']) ? $_POST['ville_naissance'] : '';
    $pays_residence = isset($_POST['pays_residence']) ? $_POST['pays_residence'] : '';
    $region = isset($_POST['region']) ? $_POST['region'] : '';
    $adresse_postale = isset($_POST['adresse_postale']) ? $_POST['adresse_postale'] : '';
    $code_postal = isset($_POST['code_postal']) ? $_POST['code_postal'] : '';
    $ville = isset($_POST['ville']) ? $_POST['ville'] : '';
    $pays_naissance = isset($_POST['pays_naissance']) ? $_POST['pays_naissance'] : '';
    $commentaire = isset($_POST['commentaire']) ? $_POST['commentaire'] : '';

    // Effectuez l'insertion dans la base de données
    $insert_query = "INSERT INTO `dl_informations` (`user_id`, `pour_qui`, `nom`, `prenom`, `genre`, `date_naissance`, `ville_naissance`, `pays_residence`, `region`, `adresse_postale`, `code_postal`, `ville`, `pays_naissance`, `commentaire`) VALUES ('$user_id', '$pour_qui', '$nom', '$prenom', '$genre', '$date_naissance', '$ville_naissance', '$pays_residence', '$region', '$adresse_postale', '$code_postal', '$ville', '$pays_naissance', '$commentaire')";

    if (mysqli_query($con, $insert_query)) {
        header("location: /pages/Verification.php");
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
