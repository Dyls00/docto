<?php

session_start();

if (!isset($_SESSION["connecte"])) {
    $_SESSION["connecte"] = false;
}

include("/wamp64/doctolib/shared/header.php");
include("/wamp64/doctolib/shared/navBar.php");

$doctor_id = isset($_GET['doctor_id']) ? $_GET['doctor_id'] : '';
$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : '';
$etablissement_id = isset($_GET['etablissement_id']) ? $_GET['etablissement_id'] : '';  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/styles.css"></link>
    <title>Prise de Rendez-vous</title>
</head>
<body id="rendezVous">
    <div class="container container-full d-flex justify-content-center align-items-center flex-column h-100">
        <h1>Prenez rendez-vous en ligne</h1>
        <div class="div-form shadow">
            <div class="container justify-content-center align-items-center flex-column" style="display:flex; flex-direction:row;">
                <?php if (@$messageS) { ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <div><i class="fa-solid fa-circle-check me-3"></i><?php echo $messageS ?></div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php } else if (@$messageD) { ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <div><i class="fa-solid fa-circle-exclamation me-3"></i><?php echo $messageD ?></div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php } ?>
                <h6>Renseignez les informations suivantes</h6>
                <form action="/fullcalendar/infoSubmit.php" method="POST">
                    <div class="question">
                        <p>Pour qui prenez vous ce rendez vous ?</p>
                        <label>
                            <input type="radio" name="reponse1" value="moi" required> Moi
                        </label>
                        <label>
                            <input type="radio" name="reponse1" value="un proche"> Un proche
                        </label>
                    </div>
                    <div class="container" style="display:flex; flex-direction:row;">
                        <div class="gauche col-6 container text-center ">
                            <div class="mb-3 col-6; container text-center">
                                <label for="nom" class="form-label; mb-2">Nom <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                </svg></label>
                                <input type="text" id="nom" name="nom" class="form-control" minlength="2" maxlength="40" style="background-color: white; border-radius: 10px;" required>
                            </div>
                            <div class="mb-3 col-6; container text-center">
                                <label for="prenom" class="form-label mb-2">Prénom <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                </svg></label>
                                <input type="text" id="prenom" name="prenom" class="form-control" minlength="2" maxlength="40" required style="background-color: white; border-radius: 10px;" required>
                            </div>
                            <div class="mb-3 col-6; container text-center">
                                <div class="question1">
                                    <label for="Motifs">Genre :</label>
                                    <select id="genre" name="genre" required>
                                        <option value=""></option>
                                        <option value="homme">Homme</option>
                                        <option value="femme">Femme</option>
                                        <option value="autre">Autre</option>
                                    </select><br><br><br>
                                </div>
                            </div>
                            <div class="mb-3 col-6; container text-center">
                                <label for="date_naissance" class="form-label">Date de naissance <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                                </svg></label>
                                <input type="date" id="date_naissance" name="date_naissance" class="form-control" required style="background-color: white; border-radius: 10px;" required>
                            </div>
                            <div class="mb-3 col-6; container text-center">
                                <label for="ville_naissance" class="form-label">Ville de naissance 
                                <input type="text" id="ville_naissance" name="ville_naissance" class="form-control" minlength="2" maxlength="40" required style="background-color: white; border-radius: 10px;" required>
                            </div>
                        </div>
                        <div class="droite col-6 container text-center">
                            <div class="mb-3 col-8; container text-center">
                                <label for="pays_residence" class="form-label">Pays de résidence <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                                    </svg></label>
                                <input type="text" id="pays_residence" name="pays_residence" class="form-control" style="background-color: white; border-radius: 10px;">
                            </div>
                            <div class="mb-3 col-6; container text-center">
                                <label for="region" class="form-label">Région <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                                    </svg></label>
                                <input type="text" id="region" name="region" class="form-control" required style="background-color: white; border-radius: 10px;">
                            </div>
                            <div class="mb-3 col-8; container text-center">
                                <label for="adresse_postale" class="form-label">Adresse postale <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                                    </svg></label>
                                <input type="text" id="adresse_postale" name="adresse_postale" class="form-control" required style="background-color: white; border-radius: 10px;">
                            </div>
                            <div class="mb-3 col-4; container text-center">
                                <label for="code_postal" class="form-label">Code Postal <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                                </svg></label>
                                <input type="text" id="code_postal" name="code_postal" class="form-control" required style="background-color: white; border-radius: 10px;">
                            </div>
                            <div class="mb-3 col-6; container text-center">
                                <label for="ville" class="form-label">Ville <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                                    </svg></label>
                                <input type="text" id="ville" name="ville" class="form-control" style="background-color: white; border-radius: 10px;" required>
                            </div>
                            <div class="mb-3 col-6; container text-center">
                                <label for="pays_naissance" class="form-label">Pays de naissance <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                                </svg></label>
                                <input type="text" id="pays_naissance" name="pays_naissance" class="form-control" minlength="2" maxlength="40" required style="background-color: white; border-radius: 10px;" required>
                            </div>
                        </div>
                    </div>
                    <div class="question">
                        <label for="commentaire">Commentaires :</label><br>
                        <textarea id="commentaire" name="commentaire" rows="4" cols="50"></textarea><br><br>
                    </div>
                    <input type="hidden" name="doctor_id" value="<?php echo $doctor_id; ?>">
                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                    <input type="hidden" name="etablissement_id" value="<?php echo $etablissement_id; ?>">
                    <div class="container container-full d-flex justify-content-center align-items-center flex-column h-100">
                        <button class="Tappable-inactive dl-button-tertiary-danger dl-button dl-button-block dl-button-size-medium" style="width:45%">Prendre rendez-vous
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</html>
