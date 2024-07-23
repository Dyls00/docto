<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
    include("../../shared/header.php");
    include("../../shared/navBar.php");
    @$messageS = $_GET["message"];
    ?>
</head>
<div class="mb-3">
    <h2 class="text-center" style="color: #0C655A; font-size: 70px; margin-top: 1em;">Mot de passe oublié ?</h2>
    <p class="text-center" style="margin-bottom: 3em;">
        Saississez votre email .
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
                        <form action="insertCodePasswordReset.php" method="POST">
                            <div class="mb-3 col-6; container text-center">
                                <label for="email-input" class="form-label">Adresse email de récupération : <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z" />
                                    </svg></label>
                                <input type="email" class="form-control" id="email-input" name="email" style="background-color: #b3b3b3; border-radius: 20px;" required>
                            </div>

                            <div class="mb-3 col-6; container text-center">
                                <button type="submit" name="submit" class="btn btn-primary" style="background-color: #0C655A; border-radius: 20px;">Envoyer le code</button>
                            </div>
                        </form>
                        <div class="mb-3 col-6; container text-center">
                            <a href="./connexionUser.php" class="btn btn-primary" style="background-color: #0C655A; border-radius: 20px;"> Se connecter</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
</div>
</body>