<?php

session_start();

if (!isset($_SESSION["connecte"])) {
    header("location:../../index.php");
    exit;
} else {
    if (!$_SESSION["connecte"]) {
        header("location:../../user/connexionUser/connexionUser.php");
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
    <!-- Page consacrée au formulaire d'inscription pour un docteur -->
<head>
    <?php
    require_once '../../config/config.php';
    include("../../shared/header.php");
    include("../../shared/navBar.php");
    @$messageS = $_GET["message"];
    ?>
</head>

<form method="POST" action="inscriptionDoctorSubmit.php">
    <div class="mb-3">
        <h2 class="text-center" style="color: #0C655A; font-size: 70px; margin-top: 1em;">INSCRIVEZ-VOUS</h2>
        <p class="text-center" style="margin-bottom: 3em;">
            Vous êtes un spécialiste ? Génial ! Inscrivez-vous !
        </p>

<body id="body-inscription">
    <div class="container container-full d-flex justify-content-center align-items-center flex-column h-100">
        <div class="div-form-login shadow" style="background-color: lightgray; width: 80%; border-radius: 20px; padding: 20px;">
            <div class="container justify-content-center align-items-center flex-column" style="display:flex; flex-direction:row;">
            <?php if (@$messageS) { ?>
                    <div class="alert alert-success alert-dismissible fade show container text-center" role="alert">
                        <div><i class="fa-solid fa-circle-check me-3"></i><?php echo $messageS ?></div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
            <?php } else if (@$messageD) { ?>
                <div class="alert alert-danger alert-dismissible fade show container text-center" role="alert">
                    <div><i class="fa-solid fa-circle-exclamation me-3"></i><?php echo $messageD ?></div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>
            <div class="mb-3 col-md-4 container text-center">
                <label for="tel" class="form-label">Téléphone professionnel <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                </svg></label>
                <input type="tel" id="tel" name="tel" class="form-control" minlength="0" maxlength="20" required style="background-color: #b3b3b3; border-radius: 20px;">
            </div>
            <div class="mb-3 col-md-4 container text-center">
                <label for="numero_rpps" class="form-label">Numéro RPPS <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-123" viewBox="0 0 16 16">
                <path d="M2.873 11.297V4.142H1.699L0 5.379v1.137l1.64-1.18h.06v5.961h1.174Zm3.213-5.09v-.063c0-.618.44-1.169 1.196-1.169.676 0 1.174.44 1.174 1.106 0 .624-.42 1.101-.807 1.526L4.99 10.553v.744h4.78v-.99H6.643v-.069L8.41 8.252c.65-.724 1.237-1.332 1.237-2.27C9.646 4.849 8.723 4 7.308 4c-1.573 0-2.36 1.064-2.36 2.15v.057h1.138Zm6.559 1.883h.786c.823 0 1.374.481 1.379 1.179.01.707-.55 1.216-1.421 1.21-.77-.005-1.326-.419-1.379-.953h-1.095c.042 1.053.938 1.918 2.464 1.918 1.478 0 2.642-.839 2.62-2.144-.02-1.143-.922-1.651-1.551-1.714v-.063c.535-.09 1.347-.66 1.326-1.678-.026-1.053-.933-1.855-2.359-1.845-1.5.005-2.317.88-2.348 1.898h1.116c.032-.498.498-.944 1.206-.944.703 0 1.206.435 1.206 1.07.005.64-.504 1.106-1.2 1.106h-.75v.96Z" />
                </svg></label>
                <input type="text" id="numero_rpps" name="numero_rpps" class="form-control" required style="background-color: #b3b3b3; border-radius: 20px;">
            </div>
            <div class="d-flex justify-content-center">
                <div class="d-flex justify-content-center mb-3">
                    <button type="submit" class="btn btn-primary" style="background-color: #0C655A; border-radius: 20px;">S'INSCRIRE</button>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <?php
    include("../../shared/footer.php");
    ?>
</body>
</html>