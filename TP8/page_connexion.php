<?php
require_once"affichage2.php";
require_once"valid.php";

$login = $_POST['login'];
$mdp = $_POST['mdp'];

page_login($login, $mdp);

?>