<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
    session_start();
    include("../../shared/header.php");
    include("../../shared/navBar.php");
    @$messageS = $_GET["message"];
    //****************** envoie du code de reinstialisation ************************
    if (isset($_POST['submit'])) {

        //récupération de l'email où on envoie le code
        if (isset($_POST['email'])) {

            $email = $_POST['email'];
            // création d'un code random à 6 chiffre qui servira pour la vérification 
            function generateUniqueToken()
            {
                $min = 100000;
                $max = 999999;
                $random = random_int($min, $max);
                return $random;
            }
            $random = generateUniqueToken();
            $_SESSION['tokenReset'] = $random;
            $_SESSION['email'] = $email;
            $resetMessage = "Bonjour,\n\nVeuillez copier le code suivant pour réinitialiser votre mot de passe : '$random'";

            //vérification sur les instructions qu'il faut pour envoyer le mail 

            mail($email, 'Réinitialisation de mot de passe', $resetMessage);
        }


    ?>
</head>
<div class="mb-3">
    <h2 class="text-center" style="color: #0C655A; font-size: 70px; margin-top: 1em;">Mot de passe oublié ?</h2>
    <p class="text-center" style="margin-bottom: 3em;">
        Saississez le code de réinitialisation .
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
                        <form action="passwordResetPage.php" method="POST">
                            <div class="mb-3 col-6; container text-center">
                                <label for="codeEmail" class="form-label">Tapez le code reçu : </label>
                                <input type="number" class="form-control" id="codeEmail" name="codeEmail" style="background-color: #b3b3b3; border-radius: 20px;" required>
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

<?php } ?>