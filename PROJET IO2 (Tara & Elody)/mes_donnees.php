<?php 
    require_once("fonc_authent.php");
    require_once("fonc_sortie.php");

    session_start();
    $login = $_SESSION['user'];
    $donnees = lire_information($login);
    $ligne = mysqli_fetch_assoc($donnees);
    $resultats = lire_information_resultats($login);

    //Cette page affiche les données du joueur (ses données personnelles et ses données de jeux).
    afficher_mes_donnees($ligne, $resultats, $login);

?>