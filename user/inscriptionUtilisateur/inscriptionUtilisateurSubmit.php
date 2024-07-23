<?php
session_start();
require_once '../../config/config.php';

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $genre = $_POST['genre'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $tel = $_POST['tel'];
    $date_naissance = $_POST['date_naissance'];
    $pays_residence = $_POST['pays_residence'];
    $region = $_POST['region'];
    $adresse_postale = $_POST['adresse_postale'];
    $code_postal = $_POST['code_postal'];
    $ville = $_POST['ville'];
    $pays_naissance = $_POST['pays_naissance'];
    $ville_naissance = $_POST['ville_naissance'];

    $sqls = "SELECT * FROM dl_user WHERE user_email = '$email'";
    $query=$bdd->prepare($sqls);
    $query -> execute();
    $result = $query -> fetchAll(); 

    if (count($result) > 0) {
        header("Location:inscriptionUtilisateur.php?message=Cette adresse mail est déjà utilisée");
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
                    if (@move_uploaded_file($tmpFile, '../../images/pp/ppUser/' . $idUnique . '.' . strtolower(end($extension)))) {
                        $url = $idUnique . '.' . strtolower(end($extension));
                    }                    
                    else{ 
                        header("Location:inscriptionUtilisateur.php?message=Erreur !");
                        exit;
                    }
                }
                else 
                {
                    header("Location:inscriptionUtilisateur.php?message=Fichier Trop lourd ou format Incorrect");
                    exit;
                }
            }
            else 
            {
                header("Location:inscriptionUtilisateur.php?message=Problème d'extension");
                exit;
            }
        }   
        else 
        {
            header("Location:inscriptionUtilisateur.php?message=Type du fichier non conforme");
            exit;
        }
    }
    else 
    {
        $url = "anonyme.png";
    }



        $sql = "INSERT INTO dl_user (user_lastname, user_firstname, user_sexe, user_email, user_password, user_tel, user_birth_date, user_country, user_region, user_adress, user_adress_code, user_city, user_birth_place, user_birth_name) VALUES ('$nom', '$prenom', '$genre', '$email', '$password', '$tel', '$date_naissance', '$pays_residence', '$region', '$adresse_postale', '$code_postal', '$ville', '$pays_naissance', '$ville_naissance')";
        $query=$bdd->prepare($sql);
        $query -> execute();
        $_SESSION["email"] = $email;

        $sqls = "SELECT * FROM dl_user WHERE user_email = '$email'";
        $query=$bdd->prepare($sqls);
        $query -> execute();
        $result = $query -> fetchAll(); 

        $userId = $result[0]["user_id"];

        $sqlrequest = "INSERT INTO `dl_user_photo`(`user_id`, `user_photo_url`) VALUES ('$userId','$url')";
        $request = $bdd->prepare($sqlrequest);
        $request->execute();

        header("location:inscriptionUtilisateurSubmitted.php");
        exit;
    }
