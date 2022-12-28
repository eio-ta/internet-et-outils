<?php 
    require_once("fonc_authent.php");
    require_once("fonc_sortie.php");

    session_start();
    $login = $_SESSION['user'];
    $donnees = lire_messages();

    //Cette page est réservée spécialement à l'administrateur. Il peut voir les messages signalés.

    afficher_messages($login, $donnees);

?>