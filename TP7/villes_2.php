<?php
    require_once"affichage.php";
    require_once"connex.php";

    $connex = connexion_bd();
    $departements = lire_departement($connex);
    page($departements);
    mysqli_free_result($departements);
    mysqli_close($connex);
?>