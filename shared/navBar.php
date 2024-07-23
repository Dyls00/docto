<?php
include('top.php') ?>
<nav class="navbar navbar-expand-lg navbar-dark" aria-label="Tenth navbar example" style="background-color: #0c655a;">
    <div class="container-fluid">
      <button class="navbar-toggler" style="margin: auto;" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample08" aria-controls="navbarsExample08" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample08">
        <ul class="navbar-nav">
          <li class="nav-item linkAnim">
              <a class="nav-link active" href="/index.php " style="padding-left: 50px; color:#ffffff;"><H5>Accueil</H5></a>
          </li>
          <li class="nav-item linkAnim">
              <a class="nav-link active" href="/pages/search.php" style="padding-left: 50px; color:#ffffff;"><H5>Spécialistes</H5></a>
          </li>
          
          <!--li class="nav-item linkAnim">
              <a class="nav-link active" href="/user/monCompte.php" style="padding-left: 50px; padding-top:15px; color:#ffffff;"><i class="bi bi-person"></i></i></a>
          </li-->
          <li class="nav-item linkAnim" style="position: absolute; top: 0; right: 0; padding: 15px;">
            <a class="nav-link active" href="/user/monCompte.php" style="color: #ffffff; display: flex; align-items: center;">
                <i class="bi bi-person"></i>
                <?php
                if (isset($_SESSION["connecte"]) && $_SESSION["connecte"]) {
                    echo "Mon Profil";
                } else {
                    echo "Connexion";
                }
                ?>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"></script>