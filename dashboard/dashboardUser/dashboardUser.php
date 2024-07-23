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
  <title>Doctolib | Utilisateurs</title>
</head>

<body>
<div class="container-fluid fixed-top bg-primary py-3 border-bottom border-light">
    <div class="row collapse show no-gutters d-flex h-100">
      <div class="col px-3 px-md-0 text-light">
        <h3 class="h2 text-center">Liste des utilisateurs</h3>
      </div>
    </div>
  </div>
  <div class="container pt-5">
    <div class="row">
      <div class="col-md-3 pt-3">
        <?php include('../dashboardSidebar.php'); ?>
      </div>
      <?php if ($_SESSION['idUser'] == 1) { ?>
        <div class="div-add-resident bg-dark">
          <div class="title-add-resident pb-3 text-center">
            <h2>Ajouter un utilisateur</h2>
          </div>
          <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#newModal">Nouvel Utilisateur</button>
          </div>
          <div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="newModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title text-dark" id="newModalCenterTitle">Ajouter un utilisateur</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form class="d-flex flex-column justify-content-center" id="userForm" action="dashboardUserCreate.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                      <input type="text" placeholder="Nom" name="new_lastname" maxlength="30" minlength="2" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <input type="text" placeholder="Prénom" name="new_firstname" maxlength="30" minlength="2" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label for="new_genre">Genre</label>
                      <select name="genre" class="form-control" required>
                        <option value="homme">Homme</option>
                        <option value="femme">Femme</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <input type="text" placeholder="Email " name="new_email" maxlength="50" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <input type="text" placeholder="Mot de passe" name="new_password" maxlength="30" minlength="2" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <input type="text" placeholder="Téléphone" name="new_tel" maxlength="30" minlength="2" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <input type="date" placeholder="Date de naissance" name="new_birthdate" maxlength="30" minlength="2" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <input type="text" placeholder="Pays de résidence" name="new_country" maxlength="30" minlength="2" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <input type="text" placeholder="Région" name="new_region" maxlength="30" minlength="2" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <input type="text" placeholder="Adresse" name="new_adress" maxlength="30" minlength="2" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <input type="text" placeholder="Code Postal" name="new_adress_code" maxlength="30" minlength="2" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <input type="text" placeholder="Ville" name="new_city" maxlength="30" minlength="2" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <input type="text" placeholder="Pays de naissance" name="new_birthplace" maxlength="30" minlength="2" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <input type="text" placeholder="Ville de naissance" name="new_birthcity" maxlength="30" minlength="2" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="create_user">Ajouter</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
      <!-- Récupération de tous les résidents affichés dans un tableau, option pour voir plus de détails sur un résident/modifier/supprimer -->
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
            <div class="card mb-3 larger-card">
              <table class="table table-striped table-bordered table-hover mt-1">
                <div class="card-header">Utilisateurs enregistrés</div>
                  <thead class="thead-dark">
                    <tr>
                      <th class="text-center">#</th>
                      <th class="text-center">Utilisateurs</th>
                      <th class="text-center">Nom</th>
                      <th class="text-center">Prénom</th>
                      <!-- De préférence affichage de l'âge -->
                      <th class="text-center">Date de naissance</th>
                      <th class="text-center">Genre</th>
                      <th class="text-center">Supprimer</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sql = "select * from dl_user";
                    $query = $bdd->prepare($sql);
                    $query->execute();
                    $results = $query->fetchAll();
                    $cnt = 1;

                    if (count($results) > 0) {
                      foreach ($results as $result) {
                    ?>
                    <tr>
                      <td class="text-center"><?php echo ($cnt); ?></td>
                      <td class="text-center"><?php echo ($result['user_id']); ?></td>
                      <td class="text-center"><?php echo ($result['user_lastname']); ?></td>
                      <td class="text-center"><?php echo ($result['user_firstname']); ?></td>
                      <td class="text-center"><?php echo ($result['user_birth_date']); ?></td>
                      <td class="text-center"><?php echo ($result['user_sexe']); ?></td>
                      <td class="text-center text-danger"><a href="../dashboardUser/dashboardUserDelete.php?id=<?php echo($result["user_id"]) ?>"><i class="fas fa-trash-alt"></i></a></td>
                    </tr>
                    <?php
                        $cnt = $cnt + 1;
                      }
                    }
                    ?>
                  </tbody>
                </div>
              </table>
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