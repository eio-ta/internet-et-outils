<?php

require_once"affichage2.php";
require_once"connex2.php";


$ville = $_POST['ville'];
if (! isset($ville)) {
    page_recherche_par_ville();
    exit;
}

$connex = connexion_bd();
$users = lire_users_par_ville($connex, $ville);

if (mysqli_num_rows($users) == 0) page_erreur(ERR_VIDE, '');
else page_users($users);
mysqli_free_result($users);
mysqli_close($connex);

?>