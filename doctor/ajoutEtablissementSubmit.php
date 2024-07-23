<?php
session_start();
require_once '../config/config.php';
require_once "../config/isConnected.php";
require_once "../config/isDoctor.php";

    $nomEtablissement = $_POST["nom"];
    $telEtablissement = $_POST["tel"];
    $capacityEtablissement = $_POST["capacity"];
    $free = $_POST["free"];
    $handicape = $_POST["handicape"];
    $regionEtablissement = $_POST["region"];
    $adresseEtablissement = $_POST["adresse_postale"];
    $codeEtablissement = $_POST["code_postal"];
    $villeEtablissement = $_POST["ville"];
    $paysEtablissement = $_POST["pays"];
    $descriptionEtablissement = str_replace("'", "\'", $_POST["description"]);

    $sqls = "SELECT * FROM dl_etablissement WHERE etablissement_name = '$nomEtablissement' and etablissement_tel = '$telEtablissement' and etablissement_adress = '$adresseEtablissement'" ;
    $query=$bdd->prepare($sqls);
    $query -> execute();
    $result = $query -> fetchAll(); 

    if (count($result) > 0) {
        header("Location:ajoutEtablissement.php?message=Ce nom et cette adresse sont déjà utilisé");
        exit;
    } else {
    if(!empty($_FILES['avatar']))
    {
        $nameFile = $_FILES['avatar']['name'];
        $typeFile = $_FILES['avatar']['type'];
        $sizeFile = $_FILES['avatar']['size'];
        $tmpFile = $_FILES['avatar']['tmp_name'];
        $errFile = $_FILES['avatar']['error'];
        
        // Extensions
        $extensions = ['png', 'jpg', 'jpeg', 'gif'];
        // Type d'image
        $type = ['image/png', 'image/jpg', 'image/jpeg', 'image/gif'];
        // On récupère
        $extension = explode('.', $nameFile);
        // Max size
        $max_size = 10000000;


        // On vérifie que le type est autorisés
        if(@in_array($typeFile, $type))
        {
            // On vérifie que il n'y a que deux extensions
            if(@count($extension) <= 2 && @in_array(strtolower(end($extension)), $extensions))
            {
                // On vérifie le poids de l'image
                if(@$sizeFile <= $max_size && $errFile == 0)
                {
                    // On bouge l'image uploadé dans le dossier upload
                    $idUnique = uniqid();
                    if (@move_uploaded_file($tmpFile, '../../images/logoEtablissement/' . $idUnique . '.' . strtolower(end($extension)))) {
                        $url = $idUnique . '.' . strtolower(end($extension));
                    }                    
                    else{ 
                        header("Location:ajoutEtablissement.php?message=Erreur !");
                        exit;
                    }
                }
                else 
                {
                    header("Location:ajoutEtablissement.php?message=Fichier Trop lourd ou format Incorrect");
                    exit;
                }
            }
            else 
            {
                header("Location:ajoutEtablissement.php?message=Problème d'extension");
                exit;
            }
        }   
        else 
        {
            $url = "anonyme.png";
        }
    }
    else 
    {
        $url = "anonyme.png";
    }



        $sql = "INSERT INTO `dl_etablissement`(`etablissement_name`, `etablissement_adress`, 
        `etablissement_city`, `etablissement_code`, `etablissement_region`, 
        `etablissement_country`, `etablissement_tel`, `etablissement_capacity`, 
        `etablissement_description`, `etablissement_free_parking`, `etablissement_acces_handicape`, 
        `etablissement_logo_url`, `etablissement_validate`) VALUES ('$nomEtablissement','$adresseEtablissement','$villeEtablissement',
        '$codeEtablissement','$regionEtablissement','$paysEtablissement','$telEtablissement','$capacityEtablissement',
        '$descriptionEtablissement','$free','$handicape',
        '$url','0')";
        $query=$bdd->prepare($sql);
        $query -> execute();

        header("location:ajoutEtablissement.php?message=Votre demande a été transmise merci de patienter qu'un administrateur valide votre demande.");
        exit;
    }
