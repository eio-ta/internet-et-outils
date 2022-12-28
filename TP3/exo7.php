<?php
$booleen=true; // un booleen
$nbr_i= 10; //un nombre entier
$nbr_r= 3.141; //un nombre reel
$str="hello"; //une chaine de caractere string
echo "Quelques variables affiches avec var_dump() :<br />";
echo "<pre>"; var_dump($booleen); var_dump($nbr_i);
var_dump($nbr_r); var_dump($str);
echo "</pre>";echo "<br />";

$jour=array( dimanche , lundi , mardi , mercredi , jeudi , vendredi ); // dimanche est l index 0 de ce tableau
$jour[6]="samedi";// j avais oublie samedi !
echo "Un tableau avec print_r() :<br />";
echo "<pre>";print_r($jour);
echo "</pre>";print_r($jour);
echo "<br /><br />";
echo "Un tableau avec var_dump() :<br />";
echo "<pre>";var_dump($jour); echo "</pre>";
var_dump($jour);
?>