<?php
session_start();
require_once '../config/config.php';
error_reporting(0);
if (!$_SESSION["admin"]) {
  header('location:../connexionAdmin/connexionAdmin.php');
  die;
}
$sql = "SELECT COUNT(*) FROM dl_doctor WHERE doctor_validate = 0";
$query = $bdd->prepare($sql);
$query->execute();
$doctorEnAttente = $query->fetchColumn();

$sql2 = "SELECT COUNT(*) FROM dl_etablissement WHERE etablissement_validate = 0";
$query2 = $bdd->prepare($sql2);
$query2->execute();
$etablissementsEnAttente = $query2->fetchColumn();

$sql3 = "SELECT COUNT(*) FROM dl_specialities WHERE specialite_validate = 0";
$query3 = $bdd->prepare($sql3);
$query3->execute();
$specialitesEnAttente = $query3->fetchColumn();

$sql4 = "SELECT COUNT(*) FROM dl_user";
$query4 = $bdd->prepare($sql4);
$query4->execute();
$utilisateursEnregistres = $query4->fetchColumn();

$sql5 = "SELECT COUNT(*) FROM dl_admin";
$query5 = $bdd->prepare($sql5);
$query5->execute();
$adminsEnregistres = $query5->fetchColumn();

$sql5 = "SELECT COUNT(*) FROM dl_admin";
$query5 = $bdd->prepare($sql5);
$query5->execute();
$adminsEnregistres = $query5->fetchColumn();

$sql6 = "SELECT COUNT(*) FROM dl_doctor WHERE doctor_validate = 1";
$query6 = $bdd->prepare($sql6);
$query6->execute();
$doctorValides = $query6->fetchColumn();

$sql7 = "SELECT COUNT(*) FROM dl_etablissement WHERE etablissement_validate = 1";
$query7 = $bdd->prepare($sql7);
$query7->execute();
$etablissementsValides = $query7->fetchColumn();

$sql7 = "SELECT COUNT(*) FROM dl_specialities WHERE specialite_validate = 1";
$query7 = $bdd->prepare($sql7);
$query7->execute();
$specialitesValides = $query7->fetchColumn();


?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="NoS1gnal" />

  <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  <link rel="stylesheet" href="../css/style.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  <title>Doctolib | Tableau de bord</title>
</head>



<body>
  <div class="container-fluid fixed-top bg-primary py-3 border-bottom border-light">
    <div class="row collapse show no-gutters d-flex h-100">
      <div class="col px-3 px-md-0 text-light">
        <h3 class="h2 text-center">Tableau de bord</h3>
      </div>
    </div>
  </div>
  <div class="container pt-5">
    <div class="row">
      <div class="col-md-3 pt-3">
        <?php include('dashboardSidebar.php'); ?>
      </div>
      <div class="col-md-9 pt-5">
        <div class="row">
          <div class="col-md-4 mb-5">
            <div class="card">
              <div class="card-body bg-primary text-light">
                <div class="card-text text-center">
                <div class="stat-panel-number h1"><?php echo $utilisateursEnregistres; ?></div>

                  <div class="stat-panel-number h1 "></div>
                  <div class="card-title text-uppercase">Utilisateurs enregistrés</div>
                </div>
              </div>
              <div class="card-body">
                <div class="card-text"><a href="dashboardUser/dashboardUser.php" class="redirect">Détails complets <i class="fas fa-arrow-right"></i></a> </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 mb-5">
            <div class="card">
              <div class="card-body bg-primary text-light">
                <div class="card-text text-center">
                <div class="stat-panel-number h1"><?php echo $adminsEnregistres; ?></div>


                  <div class="stat-panel-number h1 "></div>
                  <div class="card-title text-uppercase">Admins enregistrés</div>
                </div>
              </div>
              <div class="card-body">
                <div class="card-text"><a href="dashboardAdmin/dashboardAdmin.php" class="redirect">Détails complets <i class="fas fa-arrow-right"></i></a> </div>
              </div>
            </div>
          </div>

          <div class="col-md-4 mb-5">
            <div class="card">
              <div class="card-body bg-primary text-light">
                <div class="card-text text-center">
                <div class="stat-panel-number h1"><?php echo $doctorValides; ?></div>


                  <div class="stat-panel-number h1 "></div>
                  <div class="card-title text-uppercase">Spécialistes enregistrés</div>
                </div>
              </div>
              <div class="card-body">
                <div class="card-text"><a href="dashboardDoctor/dashboardDoctorEnregistre.php" class="redirect">Détails complets <i class="fas fa-arrow-right"></i></a> </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 mb-5">
            <div class="card">
              <div class="card-body bg-primary text-light">
                <div class="card-text text-center">
                <div class="stat-panel-number h1"><?php echo $doctorEnAttente; ?></div>
                  <div class="stat-panel-number h1 "></div>
                  <div class="card-title text-uppercase">Spécialistes en Attente</div>
                </div>
              </div>
              <div class="card-body">
                <div class="card-text"><a href="dashboardDoctor/dashboardDoctorEnAttente.php" class="redirect">Détails complets <i class="fas fa-arrow-right"></i></a> </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 mb-5">
            <div class="card">
              <div class="card-body bg-primary text-light">
                <div class="card-text text-center">
                <div class="stat-panel-number h1"><?php echo $etablissementsValides; ?></div>


                  <div class="stat-panel-number h1 "></div>
                  <div class="card-title text-uppercase">Etablissements enregistrés</div>
                </div>
              </div>
              <div class="card-body">
                <div class="card-text"><a href="dashboardEtablissement/dashboardEtablissementEnregistre.php" class="redirect">Détails complets <i class="fas fa-arrow-right"></i></a> </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 mb-5">
            <div class="card">
              <div class="card-body bg-primary text-light">
                <div class="card-text text-center">
                <div class="stat-panel-number h1"><?php echo $etablissementsEnAttente; ?></div>
                  <div class="stat-panel-number h1 "></div>
                  <div class="card-title text-uppercase">Etablissements en attente</div>
                </div>
              </div>
              <div class="card-body">
                <div class="card-text"><a href="dashboardEtablissement/dashboardEtablissementEnAttente.php" class="redirect">Détails complets <i class="fas fa-arrow-right"></i></a> </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 mb-5">
            <div class="card">
              <div class="card-body bg-primary text-light">
                <div class="card-text text-center">
                <div class="stat-panel-number h1"><?php echo $specialitesValides; ?></div>


                  <div class="stat-panel-number h1 "></div>
                  <div class="card-title text-uppercase">Spécialités enregistrés</div>
                </div>
              </div>
              <div class="card-body">
                <div class="card-text"><a href="dashboardSpecialite/dashboardSpecialiteEnregistre.php" class="redirect">Détails complets <i class="fas fa-arrow-right"></i></a> </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 mb-5">
            <div class="card">
              <div class="card-body bg-primary text-light">
                <div class="card-text text-center">
                <div class="stat-panel-number h1"><?php echo $specialitesEnAttente; ?></div>

                  <div class="stat-panel-number h1 "></div>
                  <div class="card-title text-uppercase">Spécialités en attente</div>
                </div>
              </div>
              <div class="card-body">
                <div class="card-text"><a href="dashboardSpecialite/dashboardSpecialiteEnAttente.php" class="redirect">Détails complets <i class="fas fa-arrow-right"></i></a> </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>


</html>



</body>