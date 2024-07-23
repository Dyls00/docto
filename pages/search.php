<script>
document.addEventListener('DOMContentLoaded', function () {
    // Vérifiez si la variable de session existe
    <?php
    session_start();
    if (isset($_SESSION['success_message'])) {
        // Affichez une alerte avec le message
        echo "alert('" . $_SESSION['success_message'] . "');";
        // Effacez la variable de session pour qu'elle ne s'affiche qu'une seule fois
        unset($_SESSION['success_message']);
    }
    ?>
});
</script>

<?php

require_once '../config/config.php';

// la barre de navigation 
include_once '../shared/header.php';
include_once '../shared/navBar.php';



//Formulaire de recherche par Nom , ville ou spécialité
?>
<div class="container d-flex flex-column col-md-10 mt-4 text-center">
    <form id="searchForm" action="search.php" method="GET">
        <h1 class="mt-5 mb-3" style="color:#FF7E20; font-weight:bold;">PROFESSIONNELS DE SANTÉ</h1>

        <h5>Recherchez un spécialiste de santé : </h5>

        <div class="d-flex justify-content-center">

            <div class="inputWithIcon col-4 mx-1">
                <!--  input pour nom ou nom de spécialité  -->
                <input type="text" class="form-control my-2 searchBar" style="border-radius:10px;background:#D9D9D9;" id="specialite" name="specialite" placeholder="Rechercher un(e) chirurgien , cardiologue, etc...">
                <i class="fa fa-search fa-lg fa-fw" aria-hidden="true"> </i>
            </div>
            <div class="inputWithIcon col-3 mx-1">
                <input type="text" class="form-control my-2 searchBar" style="border-radius:10px;background:#D9D9D9;" id="codePostal" name="codePostal" placeholder="Paris, Rouen, Nantes, etc...">
                <i class="fas fa-map-marker-alt fa-lg fa-fw" aria-hidden="true"> </i>
            </div>
            <button type="submit" name="submit" class="btn btn-secondary mx-1 my-2 " style="width:60px;border-radius:10px 30px 30px 10px; background-color:#FF7E20;border:#FF7E20"><i class="fas fa-search fa-lg fa-fw"></i></button>

        </div>



    </form>
</div>

<?php

if (isset($_GET['submit'])) {


    if (isset($_GET['specialite']) && $_GET['specialite'] != '' && isset($_GET['codePostal']) && $_GET['codePostal'] != '') {


        $ville = $_GET['codePostal'];
        $specialite = $_GET['specialite'];




        //requete de la recherche avec toutes les possibilités de recherche

        $sqlSearch = "SELECT d.doctor_id,d.doctor_tel,e.etablissement_name,e.etablissement_city ,u.user_lastname ,u.user_sexe, u.user_firstname, s.specialite_name 
        AS specialite
    FROM dl_doctor d
    JOIN dl_user u ON d.user_id = u.user_id
    JOIN dl_specialiser ds ON d.doctor_id = ds.doctor_id
    JOIN dl_specialities s ON ds.specialite_id = s.specialite_id
    JOIN dl_ratacher r ON d.doctor_id = r.doctor_id
    JOIN dl_etablissement e ON r.etablissement_id = e.etablissement_id
    WHERE (u.user_firstname LIKE '%$specialite%' OR u.user_lastname LIKE '%$specialite%' OR e.etablissement_name LIKE '%$specialite%' OR s.specialite_name LIKE '%$specialite%') AND (e.etablissement_country LIKE '%$ville%' OR e.etablissement_region LIKE '%$ville%' 
    OR e.etablissement_city LIKE '%$ville%' OR e.etablissement_adress LIKE '%$ville%')
    UNION SELECT d.doctor_id,d.doctor_tel, '' AS etablissement_name,u.user_city AS etablissement_city,u.user_lastname ,u.user_sexe, u.user_firstname, s.specialite_name 
        AS specialite
    FROM dl_doctor d
    JOIN dl_user u ON d.user_id = u.user_id
    JOIN dl_specialiser ds ON d.doctor_id = ds.doctor_id
    JOIN dl_specialities s ON ds.specialite_id = s.specialite_id
    WHERE d.doctor_id NOT IN(SELECT r.doctor_id FROM dl_ratacher r)
    ";
        $requestSearch = $bdd->prepare($sqlSearch);
        $requestSearch->execute();
        $resultsSearch = $requestSearch->fetchAll();
    } elseif (isset($_GET['codePostal']) && $_GET['codePostal'] != '') {


        $ville = $_GET['codePostal'];


        //requete de la recherche 

        $sqlSearch = "SELECT d.doctor_id, d.doctor_tel,e.etablissement_name,e.etablissement_city ,u.user_lastname ,u.user_sexe, u.user_firstname, s.specialite_name 
        AS specialite
    FROM dl_doctor d
    JOIN dl_user u ON d.user_id = u.user_id
    JOIN dl_specialiser ds ON d.doctor_id = ds.doctor_id
    JOIN dl_specialities s ON ds.specialite_id = s.specialite_id
    JOIN dl_ratacher r ON d.doctor_id = r.doctor_id
    JOIN dl_etablissement e ON r.etablissement_id = e.etablissement_id
    WHERE (e.etablissement_country LIKE '%$ville%' OR e.etablissement_region LIKE '%$ville%' 
    OR e.etablissement_city LIKE '%$ville%' OR e.etablissement_adress LIKE '%$ville%')
    UNION SELECT d.doctor_id,d.doctor_tel,'' AS etablissement_name,u.user_city AS etablissement_city,u.user_lastname ,u.user_sexe, u.user_firstname, s.specialite_name 
        AS specialite
    FROM dl_doctor d
    JOIN dl_user u ON d.user_id = u.user_id
    JOIN dl_specialiser ds ON d.doctor_id = ds.doctor_id
    JOIN dl_specialities s ON ds.specialite_id = s.specialite_id
    WHERE (u.user_city LIKE '%$ville%' OR u.user_region LIKE '%$ville%' OR u.user_adress LIKE '%$ville%') 
    AND d.doctor_id NOT IN(SELECT r.doctor_id FROM dl_ratacher r)";
        $requestSearch = $bdd->prepare($sqlSearch);
        $requestSearch->execute();
        $resultsSearch = $requestSearch->fetchAll();
    } elseif (isset($_GET['specialite']) && $_GET['specialite'] != '') {


        $specialite = $_GET['specialite'];

        //requete de la recherche 

        $sqlSearch = "SELECT d.doctor_id,d.doctor_tel, e.etablissement_name,e.etablissement_city, u.user_lastname ,u.user_sexe, u.user_firstname, s.specialite_name 
        AS specialite
    FROM dl_doctor d
    JOIN dl_user u ON d.user_id = u.user_id
    JOIN dl_specialiser ds ON d.doctor_id = ds.doctor_id
    JOIN dl_specialities s ON ds.specialite_id = s.specialite_id
    JOIN dl_ratacher r ON d.doctor_id = r.doctor_id
    JOIN dl_etablissement e ON r.etablissement_id = e.etablissement_id
    WHERE (u.user_firstname LIKE '%$specialite%' OR u.user_lastname LIKE '%$specialite%' OR e.etablissement_name LIKE '%$specialite%' OR s.specialite_name LIKE '%$specialite%')
    UNION SELECT d.doctor_id,d.doctor_tel,'' AS etablissement_name,u.user_city AS etablissement_city,u.user_lastname ,u.user_sexe, u.user_firstname, s.specialite_name 
        AS specialite
    FROM dl_doctor d
    JOIN dl_user u ON d.user_id = u.user_id
    JOIN dl_specialiser ds ON d.doctor_id = ds.doctor_id
    JOIN dl_specialities s ON ds.specialite_id = s.specialite_id
    WHERE (u.user_firstname LIKE '%$specialite%' OR u.user_lastname LIKE '%$specialite%' OR s.specialite_name LIKE '%$specialite%' ) AND d.doctor_id NOT IN(SELECT r.doctor_id FROM dl_ratacher r)
    ";
        $requestSearch = $bdd->prepare($sqlSearch);
        $requestSearch->execute();
        $resultsSearch = $requestSearch->fetchAll();
    } else {


        //la requete d'affichage quand le user clique sur rechercher sans préciser le nom ni le lieu 


        $sqlSearch = "SELECT d.doctor_id,d.doctor_tel,e.etablissement_name,e.etablissement_city ,u.user_lastname ,u.user_sexe, u.user_firstname, s.specialite_name 
AS specialite
FROM dl_doctor d
JOIN dl_user u ON d.user_id = u.user_id
JOIN dl_specialiser ds ON d.doctor_id = ds.doctor_id
JOIN dl_specialities s ON ds.specialite_id = s.specialite_id
JOIN dl_ratacher r ON d.doctor_id = r.doctor_id
JOIN dl_etablissement e ON r.etablissement_id = e.etablissement_id
UNION SELECT d.doctor_id,d.doctor_tel,'' AS etablissement_name,u.user_city AS etablissement_city,u.user_lastname ,u.user_sexe, u.user_firstname, s.specialite_name 
        AS specialite
    FROM dl_doctor d
    JOIN dl_user u ON d.user_id = u.user_id
    JOIN dl_specialiser ds ON d.doctor_id = ds.doctor_id
    JOIN dl_specialities s ON ds.specialite_id = s.specialite_id
    WHERE d.doctor_id
    NOT IN(SELECT r.doctor_id FROM dl_ratacher r)";
        $requestSearch = $bdd->prepare($sqlSearch);
        $requestSearch->execute();
        $resultsSearch = $requestSearch->fetchAll();
    }
} else {

    //la requete d'affichage avant de faire la recherche 
    $sqlSearch = "SELECT d.doctor_id,d.doctor_tel,e.etablissement_name,e.etablissement_city ,u.user_lastname ,u.user_sexe, u.user_firstname, s.specialite_name 
        AS specialite
    FROM dl_doctor d
    JOIN dl_user u ON d.user_id = u.user_id
    JOIN dl_specialiser ds ON d.doctor_id = ds.doctor_id
    JOIN dl_specialities s ON ds.specialite_id = s.specialite_id
    JOIN dl_ratacher r ON d.doctor_id = r.doctor_id
    JOIN dl_etablissement e ON r.etablissement_id = e.etablissement_id
    UNION SELECT d.doctor_id,d.doctor_tel,'' AS etablissement_name,u.user_city AS etablissement_city,u.user_lastname ,u.user_sexe, u.user_firstname, s.specialite_name 
        AS specialite
    FROM dl_doctor d
    JOIN dl_user u ON d.user_id = u.user_id
    JOIN dl_specialiser ds ON d.doctor_id = ds.doctor_id
    JOIN dl_specialities s ON ds.specialite_id = s.specialite_id
    WHERE d.doctor_id
    NOT IN(SELECT r.doctor_id FROM dl_ratacher r)";
    $requestSearch = $bdd->prepare($sqlSearch);
    $requestSearch->execute();
    $resultsSearch = $requestSearch->fetchAll();
}
//Affichage des résultats de la recherche 
?>


<div class="col-md-10 text-center mt-5 mb-3 mx-auto">
    <?php if (!empty($requestSearch)) { ?>
        <p style="font-weight:bold;"><?php echo $requestSearch->rowCount();  ?> Résultats</p>
    <?php  } ?>
    <!--  boucler sur les résultats  -->

    <?php
    if (!empty($resultsSearch)) { ?>
        <div class="col-md-12 d-flex flex-wrap justify-content-center">
            <?php
            foreach ($resultsSearch as $result) { ?>
                <div class="card m-3 col-md-3 card-box">
                    <div class="card-body m-2">
                        <div class="photo-container m-auto">
                            <!-- *****  mettre le src de l'image au bon endroit ****** -->
                            <?php
                            $doctor_id= $result["doctor_id"];

                            $sql = "Select * from dl_doctor where doctor_id = '$doctor_id'";
                            $request = $bdd->prepare($sql);
                            $request->execute();
                            $results2 = $request->fetchAll(); 

                            $user_id = $results2[0]["user_id"];
                            $sql = "Select * from dl_user_photo where user_id = '$user_id'";
                            $request = $bdd->prepare($sql);
                            $request->execute();
                            $results3 = $request->fetchAll();  
                            ?>
                            <img src="../images/pp/ppUser/<?php echo($results3[0]['user_photo_url']) ?>" class="img-fluid" alt="">
                        </div>


                        <h5 class="card-title mt-2">Dr <?php echo $result['user_firstname'] . ' ' . $result['user_lastname']; ?> </h5>
                        <h6 class="text-center" style="font-weight:bold;"> Spécialité: <?php echo $result['specialite'] ?> </h6>


                        <!--  si il est rattacher à un établissement  -->

                        <?php if ($result['etablissement_name']) {
                            $nomEtablissement = $result['etablissement_name'];
                        } else {
                            $nomEtablissement = 'Sans établissement';
                        } ?>
                        <p class="my-1"><?php echo $nomEtablissement ?></p>
                        <p class="my-1"><?php echo $result['etablissement_city'];  ?></p>
                        <p class="my-1"><?php echo 'Tel : ' . $result['doctor_tel'] ?></p>
                        <div class="d-flex flex-column">

                            <a href="../doctor/profil.php?id=<?php echo $result['doctor_id']; ?>" class="btn my-1" style="border-radius:20px;background:#4E8780;color:white;">En savoir plus </a>
                            <a href="" class="btn my-1" style="border-radius:20px;background:#9C6C49;color:white;">Contacter</a>
                            <a class="btn my-1" style="border-radius:20px;background:#005A76;color:white;" href="/doctor/profil.php?id=<?php echo $result['doctor_id']; ?>">Prendre rendez vous</a>
                        </div>
                    </div>
                </div>
                <!-- fin boucle  -->
            <?php } ?>

        </div>
    <?php } else { ?>

        <!--  le résultat est null  -->
        <p class="text-center">Pas de résultat pour le moment...</p>
    <?php } ?>
</div>