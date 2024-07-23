<?php


session_start();
require_once '../config/isConnected.php';
require_once '../config/config.php';

// la barre de navigation 
include_once '../shared/header.php';
include_once '../shared/navBar.php';



$idUser = $_SESSION['idUser'];

//récupération des informations de l'utilisateurs

$sql = "SELECT * FROM dl_user WHERE user_id = '$idUser'";
$request = $bdd->prepare($sql);
$request->execute();
$result = $request->fetchAll();


if (!empty($result)) {



?>

    <section class="d-flex col-md-12">
        <div class="rectangle col-md-3 iconProfil">

            <img src="../images/profil-01-particulier.png" class="img-fluid" alt="">
        </div>

        <div class="container mt-5 col-md-6">
            <div class="row d-flex flex-row align-items-center mb-4 mt-5" style="background-color: #d9d9d9; border-radius : 25px;">
                <h1 class="text-center pt-5 pb-1" style="color:#007163;font-weight:bold;">Mon Profil</h1>
                <div class="d-flex flex-column">
                    <?php 

                        $sql2 = "SELECT * FROM dl_user_photo WHERE user_id = '$idUser'";
                        $request2 = $bdd->prepare($sql2);
                        $request2->execute();
                        $result2 = $request2->fetchAll();
                        @$url = $result2[0]["user_photo_url"];

                    ?>
                    <div class="modifier-photo-container m-auto">
                        <span data-bs-toggle="tooltip" data-bs-placement="right" title="Modifier la photo">
                            <button type="button" class="btn-edit" data-bs-toggle="modal" data-bs-target="#editPictureModal">
                                <img src="../images/pp/ppUser/<?php echo($url)?>" class="photo" alt="photo">
                            </button>
                        </span>
                    </div>
                    <!-- <div class="modifier-photo-container col-md-2 m-auto mb-2"> -->


                    <!-- *****  Récupérer l'image de l'utilisateur  ****** -->


                    <!-- <img src="../images/docteur.jpg" class="img-fluid" alt="">
                    </div> -->
                    <!-- <a href="" class="col-md-4 m-auto text-center" style="font-weight:bold;text-decoration:none;color:black;">Modifier photo de profil</a> -->
                </div>

                <div class="text-center pt-3">
                    <Label for="nom">Nom :</Label>
                    <input type="text" name="nom" id="nom" class="form-control w-50 m-auto mt-1" value="<?php echo $result[0]['user_lastname']; ?>" disabled>
                </div>
                <div class="text-center pt-3">
                    <Label for="prenom">Prénom :</Label>
                    <input type="text" id="prenom" name="prenom" class="form-control w-50 m-auto mt-1" value="<?php echo $result[0]['user_firstname']; ?>" disabled>
                </div>
                <div class="text-center pt-3">
                    <Label for="email">Votre Email:</Label>
                    <input type="email" id="email" name="email" class="form-control w-50 m-auto mt-1" value="<?php echo $result[0]['user_email'];  ?>" disabled>
                </div>
                <div class="text-center pt-3">
                    <Label for="adresse">Adresse :</Label>
                    <input type="text" id="adresse" name="adresse" class="form-control w-50 m-auto mt-1" value="<?php echo $result[0]['user_adress'];  ?>" disabled>
                </div>
                <div class="text-center pt-3">
                    <Label for="codePostal">Code Postal :</Label>
                    <input type="number" id="codePostal" name="codePostal" class="form-control w-50 m-auto mt-1" value="<?php echo $result[0]['user_adress_code'];  ?>" disabled>
                </div>
                <div class="text-center pt-3">
                    <Label for="ville">Votre Ville :</Label>
                    <input type="text" id="ville" name="ville" class="form-control w-50 m-auto mt-1" value="<?php echo $result[0]['user_city']; ?>" disabled>
                </div>
                <div class="text-center pt-3">
                    <Label for="tel">Votre Numéro de Téléphone :</Label>
                    <input type="tel" id="tel" name="tel" class="form-control w-50 m-auto mt-1" value="<?php echo $result[0]['user_tel']; ?>" disabled>
                </div>
                <?php
                if (@$_SESSION['doctor']) {
                    $sql2 = "SELECT * FROM dl_doctor WHERE user_id = '$idUser'";
                    $request2 = $bdd->prepare($sql2);
                    $request2->execute();
                    $result2 = $request2->fetchAll();
                ?>
                    <div class="text-center pt-3">
                        <Label for="tel">Votre Numéro de Téléphone Professionel :</Label>
                        <input type="tel" id="tel" name="telPro" class="form-control w-50 m-auto mt-1" value="<?php echo $result2[0]['doctor_tel']; ?>" disabled>
                    </div>
                    
                <?php
                }
                ?>

                <div class="text-center pt-4">
                    <a href="modifierProfil.php"><button class="btn mb-2 align-item" style="background:#9C6C49">Modifier votre profil</button></a>
                </div>
                <!-- <div class="text-center py-2">
                    <a href=""><button class="btn mb-2 align-item" style="background:#9C6C49">Modifier votre mot de passe</button></a>
                </div> -->
            </div>
        </div>
        <div class="rectangle col-md-3">

            <img src="../images/profil-02-particulier.png" class="img-fluid" alt="">
        </div>
    </section>

    <section>

    </section>

<?php } ?>