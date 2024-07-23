<?php

session_start();

if (!isset($_SESSION["connecte"])) {
    $_SESSION["connecte"] = false;
}

include("/wamp64/doctolib/shared/header.php");
include("/wamp64/doctolib/shared/navBar.php");

?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/wamp64/doctolib/css/style.css">
    </head>
    <header>
        <div class="col-12">
            <img src="/images/kjuf.jpg" alt="Docteur-photo" width="100%">
        </div>
    </header>
    <section>

    <div class="col-12">

    <style>
        .text-center-left{
            margin:5%;
        }
    </style>

        <h1 class="text-center py-5" style="color:#007163">Oeuvrer pour une meilleur couverture santé</h1>
        <div class="text-center-left">

            <h5><span>Découvrez Doctolib : Votre Portail de Santé et de Rendez-vous Médicaux en Ligne.</sapn></h5>

            <p>Bienvenue sur <span>Doctolib</span>, votre destination en ligne pour gérer vos rendez-vous médicaux de manière efficace et pratique. Notre plateforme innovante vous permet de trouver rapidement des professionnels de la santé, de prendre rendez-vous en quelques clics et de bénéficier de consultations médicales en ligne.</p>

            <h5><span>Trouver Votre Spécialiste</span></h5>

            <p>Naviguez à travers une variété de spécialités médicales, allant des chirurgiens-dentistes aux pédiatres, en passant par les médecins généralistes, les gynécologues, les ophtalmologues et bien plus encore. Notre liste complète de spécialités vous permet de rechercher le professionnel de la santé qui répond le mieux à vos besoins.</p>

            <h5><span>Prendre Rendez-vous Simplifié.</span></h5>

            <p>Avec Doctolib, prendre rendez-vous n'a jamais été aussi simple. Parcourez les disponibilités de différents praticiens, choisissez l'heure qui vous convient et réservez instantanément votre créneau. Plus besoin d'attendre au téléphone ou de parcourir des agendas papier, tout se fait en ligne, quand vous le souhaitez.</p>

            <h5><span>Consultations en Ligne.</span></h5>

            <p>Profitez de consultations médicales à distance grâce à notre service de téléconsultation. Consultez un professionnel de la santé depuis le confort de votre domicile via une visioconférence sécurisée. Recevez des conseils, des diagnostics et des recommandations sans avoir à vous déplacer.</p>

            <h5><span>Pour les Particuliers et les Professionnels de la Santé</span></h5>

            <p>Que vous soyez un particulier à la recherche de soins médicaux ou un professionnel de la santé souhaitant gérer vos rendez-vous et vos patients, Doctolib répond à vos besoins. Inscrivez-vous en tant que particulier pour accéder à une gamme de spécialités médicales, ou inscrivez-vous en tant que professionnel pour gérer vos disponibilités, interagir avec vos patients et simplifier votre pratique médicale.</p>

            <h5><span>Une Plateforme de Confiance</span></h5>

            <p>Doctolib est une plateforme de confiance, utilisée par des millions de patients et de professionnels de la santé à travers le pays. Notre engagement envers la sécurité et la confidentialité de vos données garantit une expérience sécurisée à chaque étape.</p>

            <p>Ne laissez plus les tracas liés aux rendez-vous médicaux vous ralentir. Découvrez dès aujourd'hui la commodité et la simplicité de Doctolib et prenez le contrôle de votre santé.</p>
        </div>
    </div>

    <?php

    include("/shared/footer.php")
    ?>
</html>