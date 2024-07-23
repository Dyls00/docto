<?php

try {
    $bdd = new PDO("mysql:host=localhost;dbname=doctolib;charset=utf8", "root", "root");
} catch (PDOException $e) {
    die('Erreur 1: ' . $e->getMessage());
}
