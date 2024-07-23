<?php

session_start();

if (!isset($_SESSION["connecte"])) {
    $_SESSION["connecte"] = false;
}

include("/wamp64/doctolib/shared/header.php");
include("/wamp64/doctolib/shared/navBar.php");

$doctor_id = $_POST['doctor_id'];
$user_id = $_POST['user_id'];
$etablissement_id = $_POST['etablissement_id'];

// Vous pouvez maintenant utiliser ces IDs comme vous le souhaitez dans cette page.

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
                <form id="transferForm" action="/fullcalendar/rdvSubmit.php" method="POST">
                    <div class="Questionnaire" style="margin-top:10px">
                        <div class="question" style="margin-bottom:25px">
                            <p>Etes vous suivi par ce praticien ?</p>
                            <label>
                                <input type="radio" name="reponse1" value="oui" required> Oui
                            </label>
                            <label>
                                <input type="radio" name="reponse1" value="non"> Non
                            </label>
                        </div>
                        <div class="question" style="margin-bottom:25px">
                            <p>Avez-vous déjà consulté ce praticien ?</p>
                            <label>
                                <input type="radio" name="reponse2" value="oui" required> Oui
                            </label>
                            <label>
                                <input type="radio" name="reponse2" value="non"> Non
                            </label>
                        </div>
                    </div>
                    <input type="hidden" name="doctor_id" value="<?php echo $doctor_id; ?>">
                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                    <input type="hidden" name="etablissement_id" value="<?php echo $etablissement_id; ?>">
                    <button type="submit" form="transferForm" class="btn btn-primary mt-1">Prendre rendez-vous
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
