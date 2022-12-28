<?php
    require_once"affichage2.php";
    require_once"connex2.php";

    $donnees = array();
    page_inscription($donnees);
    mysqli_free_result($donnees);
    mysqli_close($connex);
?>