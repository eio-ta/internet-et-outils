<?php
    require_once"affichage2.php";
    require_once"connex2.php";

    $donnees = array();
    $connex = connexion_bd();
    $departements = lire_ville($connex);
    $donnees = 

    page_modi($donnees, $departements);
    mysqli_free_result($donnees, $departements);
    mysqli_close($connex);
?>