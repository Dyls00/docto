<?php
session_start();
require_once '../../config/config.php';
error_reporting(0);
if (!$_SESSION["admin"]) {
  header('location:../../connexionAdmin/connexionAdmin.php');
  die;
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
<link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  <link rel="stylesheet" href="../../css/style.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  <title>Doctolib | Administrateurs</title>
</head>
<body>
  <div class="container-fluid fixed-top bg-primary py-3 border-bottom border-light">
    <div class="row collapse show no-gutters d-flex h-100">
      <div class="col px-3 px-md-0 text-light">
        <h3 class="h2 text-center">Liste des administrateurs</h3>
      </div>
    </div>
  </div>
  <div class="container pt-5">
    <div class="row">
      <div class="col-md-3 pt-3">
        <?php include('../dashboardSidebar.php'); ?>
      </div>
      <div class="row div-list-resident" style = "margin-left: 12.8%; padding: 1em;">
        <div class="col-md-10">
          <div class="card-body">
                <?php if (isset($_GET['modification']) && $_GET['modification'] == "false") { ?>
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>ERREUR!</strong> Une erreur est survenue lors de la modification!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                <?php } else if (isset($_GET['modification']) && $_GET['modification'] == "true") { ?>
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>SUCCÈS!</strong> la modification a bien été éffectué!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                <?php } ?>
                <?php
                if (isset($_GET['ajout']) && $_GET['ajout'] == 'false') { ?>
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>ERREUR!</strong> Une erreur est survenue lors de l'ajout!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                <?php } else if (isset($_GET['ajout']) && $_GET['ajout'] == 'true') { ?>
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>SUCCÈS!</strong> l'ajout a bien été éffectué!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                <?php } else if (isset($_GET['champs']) && $_GET['champs'] == 'false') { ?>
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>ERREUR!</strong> Un des champs n'est pas rempli!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                <?php } ?>
                <div class="card mb-3 offset-md-2">
                  <table class="table table-striped table-bordered table-hover mt-1">
                    <div class="card-header">Administrateurs enregistrés</div>
                        <thead class="thead-dark">
                            <tr class="align-items-center">
                              <th class="text-center">#</th>
                              <th class="text-center">id</th>
                              <th class="text-center">Nom</th>
                              <th class="text-center">Prénom</th>
                            </tr>
                          </thead>
                      </div>
                    <tbody>
                      <?php
                      $sql ="SELECT * FROM dl_admin";
                      $query = $bdd->prepare($sql);
                      $query->execute();
                      $results = $query->fetchAll();
                      $cnt = 1;

                      if ($query->rowCount() > 0) {
                        foreach ($results as $result) {
                          $userId = $result["user_id"];
                          $sql ="SELECT * FROM dl_user where user_id = '$userId'";
                          $query = $bdd->prepare($sql);
                          $query->execute();
                          $results2 = $query->fetchAll();
                      ?>
                          <tr>
                            <td class="text-center"><?php echo($cnt); ?></td>
                            <td class="text-center"><?php echo($results2[0]['user_id']); ?></td>
                            <td class="text-center"><?php echo($results2[0]['user_lastname']); ?></td>
                            <td class="text-center"><?php echo($results2[0]['user_firstname']); ?></td>
                          </tr>
                      <?php
                          $cnt = $cnt + 1;
                        }
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>