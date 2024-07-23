<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
    session_start();
    include("../../shared/header.php");
    include("../../shared/navBar.php");
    @$messageS = $_GET["message"];

    ?>

</head>
<?php
if (isset($_POST['codeEmail'])) {

    if ($_POST['codeEmail'] != $_SESSION['tokenReset']) {
        header('Location:emailPasswordReset.php?message=Code erroné');
        exit;
    }
}
?>

<div class="mb-3">
    <h2 class="text-center" style="color: #0C655A; font-size: 70px; margin-top: 1em;">Mot de passe oublié ?</h2>
    <p class="text-center" style="margin-bottom: 3em;">
        Saississez votre nouveau mot de passe .
    </p>

    <body id="body-login">
        <div class="container container-full d-flex justify-content-center align-items-center flex-column h-100">
            <div class="div-form-login shadow" style="background-color: lightgray; width: 40%; border-radius: 20px; padding: 20px;">
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
                    <div class="container text-center">
                        <form action="passwordResetSubmit.php" method="POST">
                            <div class="mb-3 col-6; container text-center">
                                <label for="password" class="form-label">Nouveau Mot de passe : </label>
                                <input type="password" class="form-control" id="password" name="password" style="background-color: #b3b3b3; border-radius: 20px;" required>
                            </div>
                            <div class="mb-3 col-6; container text-center">
                                <label for="confirmPassword" class="form-label">Confirmer le nouveau Mot de passe : </label>
                                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" style="background-color: #b3b3b3; border-radius: 20px;" required>
                            </div>

                            <div class="mb-3 col-6; container text-center">
                                <button type="submit" class="btn btn-primary" style="background-color: #0C655A; border-radius: 20px;">Valider</button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
</div>
</body>