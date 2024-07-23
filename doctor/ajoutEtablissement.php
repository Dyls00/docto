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
<form method="POST" action="ajoutEtablissementSubmit.php" enctype="multipart/form-data">
    <div class="mb-3">
        <h2 class="text-center" style="color: orange; font-size: 70px; margin-top: 1em;">Ajouter un établissement</h2>
        <p class="text-center" style="margin-bottom: 3em;">
            Vous êtes un spécialiste et vous cherchez un établissement ? Ajoutez le !
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
                    <div class="container" style="display:flex; flex-direction:row;">
                        <div class="gauche col-6 container text-center ">
                            <div class="mb-3 col-6; container text-center">
                                <label for="nom" class="form-label; mb-2">Nom <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z" />
                                    </svg></label>
                                <input type="text" id="nom" name="nom" class="form-control" minlength="2" maxlength="40" required style="background-color: #b3b3b3; border-radius: 20px;">
                            </div>
                            <div class="mb-3 col-8; container text-center">
                                <label for="tel" class="form-label">Numéro de téléphone <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                                        <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                                    </svg></label>
                                <input type="tel" id="tel" name="tel" class="form-control" minlength="0" maxlength="20" style="background-color: #b3b3b3; border-radius: 20px;">
                            </div>
                            <div class="mb-3 col-8; container text-center">
                                <label for="capacity" class="form-label">Capacité d'accueil</label>
                                <input type="number" id="capacity" name="capacity" class="form-control" min="0" max="120" required style="background-color: #b3b3b3; border-radius: 20px;">
                            </div>

                            <div class="mb-3 col-6; container text-center">
                                <label class="form-label; container text-center; mb-2">Parking Gratuit</label>
                                <div class="form-check; container text-center; mt-2">
                                    <input class="form-check-input" type="radio" name="free" id="oui" value="1" checked>
                                    <label class="form-check-label" for="oui">Oui</label>
                                    <input class="form-check-input" type="radio" name="free" id="non" value="0">
                                    <label class="form-check-label" for="non">Non </label>
                                </div>
                            </div>

                            <div class="mb-3 col-6; container text-center">
                                <label class="form-label; container text-center; mb-2">Accès handicapé</label>
                                <div class="form-check; container text-center; mt-2">
                                    <input class="form-check-input" type="radio" name="handicape" id="oui2" value="1" checked>
                                    <label class="form-check-label" for="oui2">Oui</label>
                                    <input class="form-check-input" type="radio" name="handicape" id="non2" value="0">
                                    <label class="form-check-label" for="non2">Non </label>
                                </div>
                            </div>


                        </div>
                        <div class="droite col-6 container text-center">
                            <div class="mb-3 col-6; container text-center">
                                <label for="region" class="form-label">Région <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                                        <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z" />
                                        <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                    </svg></label>
                                <input type="text" id="region" name="region" class="form-control" required style="background-color: #b3b3b3; border-radius: 20px;">
                            </div>
                            <div class="mb-3 col-8; container text-center">
                                <label for="adresse_postale" class="form-label">Adresse postale <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                                        <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z" />
                                        <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                    </svg></label>
                                <input type="text" id="adresse_postale" name="adresse_postale" class="form-control" required style="background-color: #b3b3b3; border-radius: 20px;">
                            </div>
                            <div class="mb-3 col-4; container text-center">
                                <label for="code_postal" class="form-label">Code Postal <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                                        <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z" />
                                        <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                    </svg></label>
                                <input type="text" id="code_postal" name="code_postal" class="form-control" required style="background-color: #b3b3b3; border-radius: 20px;">
                            </div>
                            <div class="mb-3 col-6; container text-center">
                                <label for="ville" class="form-label">Ville <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                                        <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z" />
                                        <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                    </svg></label>
                                <input type="text" id="ville" name="ville" class="form-control" required style="background-color: #b3b3b3; border-radius: 20px;">
                            </div>
                            <div class="mb-3 col-6; container text-center">
                                <label for="pays" class="form-label">Pays <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                                        <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z" />
                                        <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                    </svg></label>
                                <input type="text" id="pays" name="pays" class="form-control" required style="background-color: #b3b3b3; border-radius: 20px;">
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="d-flex flex-row align-items-center mb-4">
                            <div class="form-outline flex-fill mb-0">
                                <textarea type="text" id="form3Example3c" name="description" class="form-control" required style="background-color: #b3b3b3; border-radius: 20px;"></textarea>
                                <label class="form-label" for="form3Example3c" style="color: black;">Description</label>
                            </div>
                        </div>
                        <div class="d-grid gap-2 col-8 mx-auto mt-5 text-center">
                            <input type="file" class="form-control" name="avatar" id="" placeholder="Images">
                            <label class="form-label" for="">Logo de l'établissement .png (Facultatif) </label>
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