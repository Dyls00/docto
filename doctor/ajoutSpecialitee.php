<?php session_start() ?>

<!DOCTYPE html>
<html lang="fr">
<!-- Page consacrée au formulaire d'inscription pour un utilisakteur -->

<head>
    <?php
    include("../shared/header.php");
    include("../shared/navBar.php");
    require_once("../config/isDoctor.php");
    @$messageS = $_GET["message"];
    ?>
</head>
<form method="POST" action="ajoutSpecialiteeSubmit.php" enctype="multipart/form-data">
    <div class="mb-3">
        <h2 class="text-center" style="color: orange; font-size: 70px; margin-top: 1em;">Ajouter une spécialité</h2>
        <p class="text-center" style="margin-bottom: 3em;">
            Vous êtes un spécialiste et vous cherchez une spécialité ? Ajoutez la !
        </p>

        <body id="body-inscription">
            <div class="container container-full d-flex justify-content-center align-items-center flex-column h-100">
                <div class="div-form-inscription shadow" style="background-color: lightgray; width: 50%; border-radius: 20px; padding: 20px;">
                    <?php if (@$messageS) { ?>
                        <div class="alert alert-success alert-dismissible fade show container text-center" role="alert">
                            <div><i class="fa-solid fa-circle-check me-3"></i><?php echo $messageS ?></div>
                            <button type="button" class="btn-close container text-center" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php } else if (@$messageD) { ?>
                        <div class="alert alert-danger alert-dismissible fade show container text-center" role="alert">
                            <div><i class="fa-solid fa-circle-exclamation me-3"></i><?php echo $messageD ?></div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php } ?>
                    <div class="container" style="display:flex; flex-direction:column;">
                        <div class="mb-3 col-6; container text-center">
                            <label for="nom" class="form-label; mb-2">Nom de la spécialité</label>
                            <input type="text" id="nom" name="nom" class="form-control" minlength="2" maxlength="40" required style="background-color: #b3b3b3; border-radius: 20px;">
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                            <div class="form-outline flex-fill mb-0">
                                <textarea type="text" id="form3Example3c" name="description" class="form-control" required style="background-color: #b3b3b3; border-radius: 20px;"></textarea>
                                <label class="form-label" for="form3Example3c" style="color: black;">Description</label>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="d-flex justify-content-center mb-3">
                                <button type="submit" class="btn btn-primary" style="background-color: orange; border-radius: 20px;">Ajouter</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</form>
</div>
</div>
</body>