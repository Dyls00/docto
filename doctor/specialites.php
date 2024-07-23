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

?>
<div class="mb-3">
    <h2 class="text-center" style="color: #0C655A; font-size: 70px; margin-top: 1em;">spécialités</h2>
    <p class="text-center" style="margin-bottom: 3em;">
        Choisissez votre spécialité, si elle n'existe pas encore vous pouvez l'ajouter.
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
                        <form action="./specialiteeSubmit.php" method="POST">

                            <div class="mb-3 col-6; container text-center">
                                <select id="specialite" name="specialite" style="background-color: #b3b3b3; border-radius: 20px;">
                                    <option value="0" selected>~~spécialités~~</option>
                                    <?php
                                    $sql = "SELECT specialite_id, specialite_name from dl_specialities where specialite_validate = '1'";
                                    $query = $bdd->prepare($sql);
                                    $query->execute();
                                    $results = $query->fetchAll();
                                    foreach($results as $result){
                                    $idEtablissement = $result["specialite_id"];
                                    $nameEtablissement = $result["specialite_name"];
                                    ?>
                                    <option value="<?php echo($idEtablissement)?>"><?php echo($nameEtablissement)?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3 col-8; container text-center">
                                <label for="prix" class="form-label">Prix (sans devise)</label>
                                <input type="number" id="prix" name="prix" class="form-control" min="0" max="9999" required style="background-color: #b3b3b3; border-radius: 20px;">
                            </div>
                            <div class="mb-3 col-8; container text-center">
                                <label for="devise" class="form-label">Devise</label>
                                <input type="text" id="devise" name="devise" class="form-control" required style="background-color: #b3b3b3; border-radius: 20px;">
                            </div>
                            <div class="mb-3 col-6; container text-center">
                                <button type="submit" class="btn btn-primary" style="background-color: #0C655A;border:none; border-radius: 20px;"> Affecter</button>
                            </div>
                        </form>
                        <div class="mb-3 col-6; container text-center">
                            <a href="./ajoutSpecialitee.php" class="btn btn-primary" style="background-color: orange; border:none; border-radius: 20px;"> Ajouter une nouvelle spécialité</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>