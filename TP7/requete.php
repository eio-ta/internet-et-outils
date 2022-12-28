<?php
require_once"affichage.php";
require_once"connex.php";

$departement_id = substr($_POST["nom"], -3, 2);
$connex = connexion_bd();
$villes = lire_villes_du_departement_choisi($connex, $departement_id);
$departements = lire_departement($connex);
page2($_POST["nom"], $villes, $departements);
mysqli_free_result($villes);
mysqli_close($connex);

?>
