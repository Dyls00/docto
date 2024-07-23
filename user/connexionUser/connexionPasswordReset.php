<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
    include("../../shared/header.php");
    include("../../shared/navBar.php");





    ?>
</head>

<body id="body-login">
    <div class="container container-full d-flex justify-content-around align-items-center flex-column h-100">
        <div class="div-form-login shadow">
            <form action="index.php?action=20&auth=28" method="POST">
                <div class="mb-3">
                    <H2 class="text-center">Réinitialisation mot de passe</H2>
                </div>
                <div class="mb-3">
                    <p>Pour l'adresse email <?php ?></p>
                </div>
                <div class="mb-3">
                    <label for="password-input" class="form-label">Nouveau mot de passe</label>
                    <input type="password" class="form-control" id="password-input" name="password" required>
                </div>
                <input type="hidden" name="token" value="<?php  ?>">
                <input type="hidden" name="email" value="<?php  ?>">
                <div class="d-flex justify-content-center mb-3">
                    <button type="submit" class="btn btn-primary">Réinitialiser</button>
                </div>
                <div class="d-flex justify-content-center">
                    <a href="index.php?action=20">Se connecter</a>
                </div>
            </form>
        </div>
    </div>
</body>