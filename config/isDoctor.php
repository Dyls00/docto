<?php

if(!isset($_SESSION["doctor"])){
    header("location:/user/monProfil.php");
    exit;
}
else{
    if(!$_SESSION["doctor"]){
        header("location:/user/monProfil.php");
        exit;
    }
}