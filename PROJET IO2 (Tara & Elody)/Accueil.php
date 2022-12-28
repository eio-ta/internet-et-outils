<?php 
require_once("fonc_authent.php");
require_once("fonc_sortie.php");

session_start();
$login = $_SESSION['user'];

// Si $_SESSION['user'] n'existe pas, alors il affiche la page d'accueil pour les personnes qui ne sont pas connectées.
//Si $_SESSION['user'] existe, alors il affiche la page d'accueil pour les personnes qui sont connectées.
if(isset($_SESSION["user"])) {
    afficher_accueil_log($login);
} else {
    afficher_accueil_logout();
}

?>
