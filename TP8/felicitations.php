<?php
require_once ("affichage2.php");
require_once("valid.php");
require_once("connex2.php");

$donnees = array();

if ($_SERVER ["REQUEST_METHOD"]=="POST") {
    $donnees = $_POST;
    enregistrer($donnees);
    session_start();
    $_SESSION['login'] = $donnees['login'];
    page_bienvenue($donnees);
}

?>