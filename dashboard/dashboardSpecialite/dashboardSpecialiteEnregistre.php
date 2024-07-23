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
  <title>Doctolib | Spécialités</title>
</head>

<body>
  <div class="container-fluid fixed-top bg-primary py-3 border-bottom border-light">
    <div class="row collapse show no-gutters d-flex h-100">
      <div class="col px-3 px-md-0 text-light">
        <h3 class="h2 text-center">Gestion des spécialités</h3>
      </div>
    </div>
  </div>
  <div class="container pt-5">
    <div class="row">
      <div class="col-md-3 pt-3">
        <?php include('../dashboardSidebar.php'); ?>
      </div>
      <!-- Récupération de toutes les Spécialites affichés dans un tableau, option pour voir plus de détails sur un spécialiste/modifier/supprimer -->
      <div class="row div-list-specialite " style = "margin-left: 12.8%; padding: 1em;">
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
                <div class="card-header">Spécialités enregistrés</div>
                  <thead class="thead-dark">
                    <tr class="align-items-center">
                      <th class="text-center">#</th>
                      <th class="text-center">id</th>
                      <th class="text-center">Nom</th>
                      <th class="text-center">Supprimer</th>
                    </tr>
                  </thead>
                <tbody>
                  <?php

                  $sql = "select * from dl_specialities where specialite_validate = 1";
                  $query = $bdd->prepare($sql);
                  $query->execute();
                  $results = $query->fetchAll();
                  $cnt = 1;

                  if (count($results) > 0) {
                    foreach ($results as $result) {
                      $id = $result['specialite_id'];

                  ?>
                      <tr>
                        <td class="text-center"><?php echo ($cnt); ?></td>
                        <td class="text-center"><?php echo ($result['specialite_id']); ?></td>
                        <td class="text-center"><?php echo ($result['specialite_name']); ?></td>
                        <td class="text-center text-danger"><a type="button" href="dashboardSpecialiteDelete.php?id=<?php echo ($id) ?>"><i class="fas fa-trash-alt"></i></a></td>
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
    <!-- Div qui ferme celles présentes dans le fichier sidebar -->
  </div>
  </div>
  </div>
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>