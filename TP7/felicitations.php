<?php
require_once ("affichage2.php");
require_once("valid.php");
require_once("connex2.php");

$erreurs_requis = array();
$erreurs_format = array();
$donnees = array();

if ($_SERVER ["REQUEST_METHOD"]=="POST") {
    $donnees = $_POST;
    enregistrer($donnees);
    page_bienvenue($donnees);
}

?>