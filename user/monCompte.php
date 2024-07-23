<?php
session_start();
require_once '../config/isConnected.php';
require_once '../config/config.php';

// la barre de navigation 
include_once '../shared/header.php';
include_once '../shared/navBar.php';

?>

<section class="d-flex col-md-12">
    <div class="rectangle col-md-3 iconProfil">

        <img src="../images/time.png" class="img-fluid" alt="">
    </div>

    <div class="container mt-5 col-md-6">
        <div class="row d-flex flex-row align-items-center mb-4 mt-5" style="background-color: #d9d9d9; border-radius : 25px;">
            <h1 class="text-center pt-5 pb-3" style="color:#007163;font-weight:bold;">Mon Compte</h1>
            <div class="text-center pt-3">
                <a href="monProfil.php"><button class="form-control w-50 btn mb-2 align-item" style="background:#005A76;color:white;">Mon Profil</button></a>
            </div>

            <div class="text-center pt-3">
                <a href=""><button class="form-control w-50 btn mb-2 align-item" style="background:#005A76;color:white;">Mes Rendez-vous</button></a>
            </div>
            <?php
            if (@$_SESSION["doctor"]) {
                $userId = $_SESSION['idUser'];
                $sql = "select * from dl_doctor where user_id = '$userId'";
                $query = $bdd->prepare($sql);
                $query->execute();
                $result = $query->fetchAll();
                $doctorId = $result[0]["doctor_id"];
                $validate = $result[0]["doctor_validate"];
                if ($validate) {
            ?>



                    <div class="text-center pt-3">
                        <a href="../doctor/lieuExercice.php"><button class="form-control w-50 btn mb-2 align-item" style="background:#9c6c49;color:white;">Lieu d'Exercice</button></a>
                    </div>

                    <div class="text-center pt-3">
                        <a href="../doctor/specialites.php"><button class="form-control w-50 btn mb-2 align-item" style="background:#9c6c49;color:white;">Mes spécialités</button></a>
                    </div>

                    <div class="text-center pt-3">
                        <a href="../doctor/profil.php?id=<?php echo($doctorId)?>"><button class="form-control w-50 btn mb-2 align-item" style="background:#9c6c49;color:white;">Profil Public</button></a>
                    </div>




            <?php
                }
            }
            ?>
            <div class="text-center pt-4">
                <a href="deconnexion.php"><button class="btn btn-danger mb-2 align-item">Déconnexion</button></a>
            </div>
        </div>
    </div>
    <div class="rectangle col-md-3">

        <img src="../images/profil-accueil.png" class="img-fluid" alt="">
    </div>
</section>

<section>

</section>