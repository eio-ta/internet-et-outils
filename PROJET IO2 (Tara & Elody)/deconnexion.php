<?php 
require_once("fonc_authent.php");
require_once("fonc_sortie.php");
	

//Ce fichier gère la déconnection.
session_start();
$login = $_SESSION["user"];
if (isset($login)) {
	$_SESSION = array();
	session_destroy();
}

afficher_deconnection($login);
?>