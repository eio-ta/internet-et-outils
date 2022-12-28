<?php
require_once ("affichage2.php");
require_once("valid.php");
require_once("connex2.php");

session_start();
$_SESSION['login'] = $_POST['login'];
$admin = verifier_si_admin($_SESSION['login']);
page_accueil($admin);
session_destroy();

?>

