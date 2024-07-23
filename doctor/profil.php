<?php
session_start();
require_once '../config/config.php';

// la barre de navigation 
include_once '../shared/header.php';
include_once '../shared/navBar.php';

//récupérer l'id du docteur sur lequel on a cliqué
$doctor_id = $_GET['id'];

//  REQUETES

$sqlDoctor = "SELECT * FROM dl_doctor WHERE doctor_id='$doctor_id'";
$requestDoctor = $bdd->prepare($sqlDoctor);
$requestDoctor->execute();
$resultsDoctor = $requestDoctor->fetchAll();

if (!empty($resultsDoctor)) {
    $user_id = $resultsDoctor[0]['user_id'];

    $sqlUser = "SELECT user_lastname,user_firstname,user_sexe,user_city FROM dl_user WHERE user_id='$user_id'";
    $requestUser = $bdd->prepare($sqlUser);
    $requestUser->execute();
    $resultsUser = $requestUser->fetchAll();
}


$sqlSpecialiser = "SELECT * FROM dl_specialiser WHERE doctor_id='$doctor_id'";
$requestSpecialiser = $bdd->prepare($sqlSpecialiser);
$requestSpecialiser->execute();
$resultsSpecialiser = $requestSpecialiser->fetchAll();

if (!empty($resultsSpecialiser)) {
    $specialite_id = $resultsSpecialiser[0]['specialite_id'];


    $sqlSpecialities = "SELECT * FROM dl_specialities WHERE specialite_id ='$specialite_id'";
    $requestSpecialities = $bdd->prepare($sqlSpecialities);
    $requestSpecialities->execute();
    $resultsSpecialities = $requestSpecialities->fetchAll();
}


$sqlRatacher = "SELECT * FROM dl_ratacher WHERE doctor_id = '$doctor_id'";
$requestRatacher = $bdd->prepare($sqlRatacher);
$requestRatacher->execute();
$resultsRatacher = $requestRatacher->fetchAll();

if (!empty($resultsRatacher)) {
    $etablissement_id = $resultsRatacher[0]['etablissement_id'];

    $sqlEtablissement = "SELECT * FROM dl_etablissement WHERE etablissement_id ='$etablissement_id'";
    $requestEtablissement = $bdd->prepare($sqlEtablissement);
    $requestEtablissement->execute();
    $resultsEtablissement = $requestEtablissement->fetchAll();
}

?>
    <?php
    // Récupérer l'identifiant de la photo du docteur depuis la table dl_doctor
    $doctor_photo_id = $resultsDoctor[0]['doctor_photo_id'];

    // Exécuter une requête SQL pour obtenir l'URL de la photo
    $sql = "SELECT doctor_photo_url FROM dl_doctor WHERE doctor_photo_id = :doctor_photo_id";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':doctor_photo_id', $doctor_photo_id, PDO::PARAM_INT);
    $stmt->execute();

    // Récupérer l'URL de la photo du docteur
    $doctor_photo_url = $stmt->fetchColumn();

    ?>

    <header class=" py-4" style="background:#2b4660;">
        <div class="d-flex col-md-12">
            <!-- récupérer une image de la bdd et lui mettre une taille idéale -->
            <div class="photo-container col-md-3 mx-4">
                <!-- mettre le bon chemin d'image  -->
                <img src="../images/pp/ppUser/<?php echo $doctor_photo_url; ?>" class="img-fluid" alt="Docteur-photo">
        </div>
        <div class="col-6 row align-self-center">
            <?php if (!empty($resultsUser)) { ?>
                <h4 class="text-white text-left"><?php echo 'Dr' . ' ' . $resultsUser[0]['user_firstname'] . ' ' . $resultsUser[0]['user_lastname']  ?></h4>
            <?php } ?>
            <?php if (!empty($resultsSpecialities[0]['specialite_name'])) { ?>
                <h6 class="text-white text-left"><?php echo $resultsSpecialities[0]['specialite_name']   ?> </h6>
            <?php } ?>
        </div>
    </div>
</header>

<div class="d-flex col-12">


    <div class="col-6">
        <section class="px-3">

            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title mx-2">Présentation</h5>
                    <?php if (!empty($resultsSpecialities[0]['specialite_description'])) { ?>
                        <p class="card-text mx-3"><?php echo $resultsSpecialities[0]['specialite_description']  ?> </p>
                    <?php } ?>
                </div>
            </div>
        </section>

        <section class="px-3">
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">Tarifs et Durée de la consultation</h5>
                    <div class="p-2">
                        <h6 class="card-subtitle mx-3 text-muted">Tarifs</h6>
                        <?php if (!empty($resultsSpecialiser[0]['specialiser_price']) && !empty($resultsSpecialiser[0]['specialiser_devise'])) { ?>
                            <p class="card-text mx-3"> <?php echo $resultsSpecialiser[0]['specialiser_price'] . ' ' . $resultsSpecialiser[0]['specialiser_devise']; ?></p>
                        <?php } ?>
                    </div>
                    <div class="p-2">
                        <h6 class="card-subtitle mx-3 text-muted">Durée Moyenne d'une consultation</h6>
                        <?php if (!empty($resultsDoctor[0]['doctor_duree_RDV'])) { ?>
                            <p class="card-text mx-3"> <?php echo $resultsDoctor[0]['doctor_duree_RDV'] . ' ' . 'min'; ?></p>
                        <?php } else { ?>
                            <p class="card-text mx-3"> <?php echo 'Non défini'; ?></p>


                        <?php }
                        ?>
                    </div>

                </div>
            </div>
        </section>

        <section class="px-3">

            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">Horaire et Contacts</h5>
                    <div class="d-flex p-1 flex-wrap">
                        <div class="p-2">
                            <!--  récuperer une valeur de l'horaire de la bdd mais j'ai pas encore compris le fonctionnement de la valeur  -->
                            <h6 class="card-subtitle mx-3 mb-2 text-muted">Horaire d'ouverture</h6>
                            <p class="card-text mx-3">Lundi au Vendredi :</br>
                                09h00 - 12h00
                                <br>
                                13h30 - 17H00
                            </p>
                        </div>
                        <div class="p-2">

                            <h6 class="card-subtitle mx-3 mb-1 text-muted">Contact d'urgence</h6>
                            <p class="card-text mx-3">En cas d'urgence, contactez le 15 (Samu)</p>
                        </div>
                    </div>
                    <div class="p-2">

                        <h6 class="card-subtitle mx-3 mb-1 text-muted">Coordonnées</h6>
                        <?php if (!empty($resultsDoctor[0]['doctor_tel'])) { ?>
                            <p class="card-text mx-3">Tel : <?php echo $resultsDoctor[0]['doctor_tel']; ?></p>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>
        <section class="px-3 pb-3">
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">Informations Légales</h5>
                    <h6 class="card-subtitle mb-2 mx-3 text-muted">Numéro RPPS : </h6>
                    <?php

                    if (!empty($resultsDoctor[0]['doctor_code_RPPS'])) { ?>
                        <p class="card-text mx-3"> <?php echo $resultsDoctor[0]['doctor_code_RPPS']; ?></p>
                    <?php } ?>

                </div>
            </div>
        </section>
    </div>
    <div class="col-5">
        <section class="px-3 sticky-top py-5">
            <div class="card mt-3">
                <div class="card-body text-center">
                    <h5 class="card-title">Rendez-vous</h5>
                    <h6 class="card-subtitle mb-2 mx-3 text-muted">Prendre rendez-vous dès maintenant : </h6>
                    <?php if (!empty($resultsUser)) { ?>
                        <p class="card-text my-1">Dr <?php echo $resultsUser[0]['user_firstname'] . ' ' . $resultsUser[0]['user_lastname']; ?> </p>
                    <?php } ?>
                    <?php if (!empty($resultsEtablissement)) { ?>
                        <p class="card-text my-1"><?php echo $resultsEtablissement[0]['etablissement_adress'] . ', ' . $resultsEtablissement[0]['etablissement_city']; ?> </p>
                    <?php } else if (!empty($resultsUser)) { ?>
                        <p class="card-text my-1"><?php echo $resultsUser[0]['user_city']; ?> </p>

                    <?php } 

                    // Récupérez l'`user_id` de la session
                        if (isset($_SESSION["idUser"])) {
                        $user_id = $_SESSION["idUser"];
                        }
                        ?>
                    <form id="transferForm" method="POST" action="<?php
                        if (isset($_SESSION["connecte"]) && $_SESSION["connecte"]) {
                            echo "/pages/rendezVous.php"; // Redirection si l'utilisateur est connecté
                        } else {
                            echo "/user/connexionUser/connexionUser.php"; // Redirection vers la page de connexion sinon
                        }
                        ?>">
                            <input type="hidden" name="doctor_id" value="<?php echo $doctor_id; ?>">
                            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                            <input type="hidden" name="etablissement_id" value="<?php echo $etablissement_id; ?>">
                            <button type="submit" class="btn btn-primary mt-1">Prendre rendez-vous</button>
                    </form>

                </div>
            </div>
        </section>
    </div>
</div>

<?php
    include("../shared/footer.php");
?>
<?php  ?>