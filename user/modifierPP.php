<?php
session_start();
require_once '../config/config.php';

    if(!empty($_FILES['picture']))
    {
        $nameFile = $_FILES['picture']['name'];
        $typeFile = $_FILES['picture']['type'];
        $sizeFile = $_FILES['picture']['size'];
        $tmpFile = $_FILES['picture']['tmp_name'];
        $errFile = $_FILES['picture']['error'];
        
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
                    if (@move_uploaded_file($tmpFile, '../images/pp/ppUser/' . $idUnique . '.' . strtolower(end($extension)))) {
                        $url = $idUnique . '.' . strtolower(end($extension));
                    }
                    else{
                        $url = "anonyme.png";
                    }                    
                    
                }
                
            }
            
        }   
    }
    else 
    {
        $url = "anonyme.png";
    }
        $userId = $_SESSION["idUser"];
        

        $sqls = "SELECT * FROM dl_user_photo WHERE user_id = '$userId'";
        $query=$bdd->prepare($sqls);
        $query -> execute();
        $result = $query -> fetchAll(); 
        $ancienUrl = $result[0]["user_photo_url"];
        if($ancienUrl != "anonyme.png"){
        $images = '../images/pp/ppUser/' . $ancienUrl;
        @unlink( $images );
        }


        $sqlrequest = "UPDATE `dl_user_photo` SET `user_photo_url`='$url' WHERE user_id = '$userId'";
        $request = $bdd->prepare($sqlrequest);

        header("location:modifierProfil.php");
        exit;
