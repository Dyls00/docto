<?php

if(!isset($_SESSION["connecte"])){
    header("location:/index.php");
    exit;
}
else{
    if(!$_SESSION["connecte"]){
        header("location:/user/connexionUser/connexionUser.php");
        exit;
    }
}