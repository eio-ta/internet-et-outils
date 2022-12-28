<?php

require_once"affichage2.php";
require_once"connex2.php";


$real = $_POST['login'];
if (! isset($real)) {
    page_recherche();
    exit;
}

$connex = connexion_bd();
$users = lire_users($connex, $real);

if (mysqli_num_rows($users) == 0) echo "<!DOCTYPE html>
<html lang=\"fr\">
    <head>
        <meta charset=\"utf-8\">
        <title>Accueil</title>
        <link rel = \"stylesheet\" href = \"style1.css\">
    </head>

    <body><h1>Personne ne s'appelle comme ça.</h1><br><br>Retourner à <a href=\"Accueil.php\">l'accueil</a>.</body></html>";
else page_users($users);
mysqli_free_result($users);
mysqli_close($connex);

?>