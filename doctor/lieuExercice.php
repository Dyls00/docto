<?php
session_start();
require_once("../config/isConnected.php");
require_once("../config/isDoctor.php");
require_once("../config/config.php");
require_once("../shared/header.php");
require_once("../shared/navBar.php");

@$messageS = $_GET["message"];
$userId = $_SESSION["idUser"];
$doctorId = $_SESSION["idDoctor"];

$sql = "SELECT * from dl_ratacher where doctor_id = '$doctorId'";
$query = $bdd->prepare($sql);
$query->execute();
$results = $query->fetchAll();
if(count($results)> 0){
    $messageD = "Vous êtes déjà affecter à un établissement";
    $affecte = 1;
}
else{
    $affecte = 0;
}

?>
<div class="mb-3">
    <h2 class="text-center" style="color: #0C655A; font-size: 70px; margin-top: 1em;">Lieu d'Exercice</h2>
    <p class="text-center" style="margin-bottom: 3em;">
        Choisissez votre établissement, s'il n'existe pas encore vous pouvez l'ajouter.
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
                        <?php
                        if($affecte){
                            ?>
                            <div class="mb-3 col-6; container text-center">
                            <a href="./quitterEtablissement.php" class="btn btn-primary" style="background-color: orange;border:none; border-radius: 20px;"> Quitter votre établissement</button></a>
                        </div>
                        <?php
                        }
                        else{
                        ?>
                        <form action="./lieuExerciceSubmit.php" method="POST">

                            <div class="mb-3 col-6; container text-center">
                                <select id="etablissement" name="etablissement">
                                    <option value="0" selected>~~établissement~~</option>
                                    <?php
                                    $sql = "SELECT etablissement_id, etablissement_name etablissement_city from dl_etablissement where etablissement_validate = '1'";
                                    $query = $bdd->prepare($sql);
                                    $query->execute();
                                    $results = $query->fetchAll();
                                    foreach($results as $result){
                                    $idEtablissement = $result["etablissement_id"];
                                    $nameEtablissement = $result["etablissement_name"];
                                    $cityEtablissement = $result["etablissement_city"];
                                    $etablissement = $nameEtablissement." ".$cityEtablissement;
                                    ?>
                                    <option value="<?php echo($idEtablissement)?>"><?php echo($etablissement)?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>


                            <div class="mb-3 col-6; container text-center">
                                <button type="submit" class="btn btn-primary" style="background-color: #0C655A;border:none; border-radius: 20px;"> Rejoindre</button>
                            </div>
                        </form>
                        <div class="mb-3 col-6; container text-center">
                            <a href="./ajoutEtablissement.php" class="btn btn-primary" style="background-color: orange;border:none; border-radius: 20px;"> Ajouter un nouvel établissement</button></a>
                        </div>
                        <?php 
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
</div>