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
                <h1 class="text-center pt-5 pb-1" style="color:#007163;font-weight:bold;">Modifier mon Profil</h1>




                <form method="post" action="modifierProfilSubmit.php">

                    <!--   ***** à faire :   Gérer la modification d'image   *****       -->

                    <?php 

                        $sql2 = "SELECT * FROM dl_user_photo WHERE user_id = '$idUser'";
                        $request2 = $bdd->prepare($sql2);
                        $request2->execute();
                        $result2 = $request2->fetchAll();
                        $url = $result2[0]["user_photo_url"];

                    ?>
                    <div class="modifier-photo-container m-auto">
                        <span data-bs-toggle="tooltip" data-bs-placement="right" title="Modifier la photo">
                            <button type="button" class="btn-edit" data-bs-toggle="modal" data-bs-target="#editPictureModal">
                                <img src="../images/pp/ppUser/<?php echo($url)?>" class="photo" alt="photo">
                            </button>
                        </span>
                    </div>
                    <div class="text-center pt-3">
                        <Label for="nom">Nom :</Label>
                        <input type="text" name="nom" id="nom" class="form-control w-50 m-auto mt-1" value="<?php echo $result[0]['user_lastname']; ?>">
                    </div>
                    <div class="text-center pt-3">
                        <Label for="prenom">Prénom :</Label>
                        <input type="text" id="prenom" name="prenom" class="form-control w-50 m-auto mt-1" value="<?php echo $result[0]['user_firstname']; ?>">
                    </div>
                    <div class="text-center pt-3">
                        <Label for="email">Votre Email:</Label>
                        <input type="email" id="email" name="email" class="form-control w-50 m-auto mt-1" value="<?php echo $result[0]['user_email'];  ?>">
                    </div>
                    <div class="text-center pt-3">
                        <Label for="adresse">Adresse :</Label>
                        <input type="text" id="adresse" name="adresse" class="form-control w-50 m-auto mt-1" value="<?php echo $result[0]['user_adress'];  ?>">
                    </div>
                    <div class="text-center pt-3">
                        <Label for="codePostal">Code Postal :</Label>
                        <input type="number" id="codePostal" name="codePostal" class="form-control w-50 m-auto mt-1" value="<?php echo $result[0]['user_adress_code'];  ?>">
                    </div>
                    <div class="text-center pt-3">
                        <Label for="ville">Votre Ville :</Label>
                        <input type="text" id="ville" name="ville" class="form-control w-50 m-auto mt-1" value="<?php echo $result[0]['user_city']; ?>">
                    </div>
                    <div class="text-center pt-3">
                        <Label for="tel">Votre Numéro de Téléphone :</Label>
                        <input type="tel" id="tel" name="tel" class="form-control w-50 m-auto mt-1" value="<?php echo $result[0]['user_tel']; ?>">
                    </div>

                    <?php 
                    if(@$_SESSION['doctor']){
                        $sql2 = "SELECT * FROM dl_doctor WHERE user_id = '$idUser'";
                        $request2 = $bdd->prepare($sql2);
                        $request2->execute();
                        $result2 = $request2->fetchAll();
                    ?>
                        <div class="text-center pt-3">
                            <Label for="tel">Votre Numéro de Téléphone Professionel :</Label>
                            <input type="tel" id="tel" name="telPro" class="form-control w-50 m-auto mt-1" value="<?php echo $result2[0]['doctor_tel']; ?>">
                        </div>
                    <?php
                    }
                    ?>

                    <div class="text-center pt-4">
                        <button class="btn mb-2 align-item" type="submit" style="background:#9C6C49">Modifier votre profil</button>
                    </div>
                </form>
                <!-- <div class="text-center py-2">
                    <a href=""><button class="btn mb-2 align-item" style="background:#9C6C49">Modifier votre mot de passe</button></a>
                </div> -->
            </div>
        </div>
        <div class="rectangle col-md-3">

            <img src="../images/profil-02-particulier.png" class="img-fluid" alt="">
        </div>
    </section>


    <div class="modal fade" id="editPictureModal" tabindex="-1" role="dialog" aria-labelledby="editPictureModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="editPictureModalCenterTitle">Modifier Photo de Profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editPictureForm" action="modifierPP.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" id="idResidentEPicture" name="residentId">
                        <div class="form-group">
                            <label class="control-label">Photo</label>
                            <input type="file" id="inputPicture" name="picture">
                        </div>
                        <div class="form-group d-flex justify-content-center flex-column">
                            <label class="control-label text-center">Photo actuelle</label>
                            <div class="div-photo-resident d-flex justify-content-center">
                                <img id="imgPicture" src="../images/pp/ppUser/<?php echo($url)?>" class="photo-resident" alt="photo du profil" width="120px" height="80px">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Modifier</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php } ?>