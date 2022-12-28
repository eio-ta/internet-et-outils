<?php

include(outils.php);

$mot = htmlspecialchars($_GET["mot"]);
$lettres = htmlspecialchars($_GET["lettres"]);

function afficher($mot, $lettres){
    $taille = strlen($mot);
    for($i=0; $i<$taille; $i++){
        $a = substr($mot, $i, 1);
        if(contient($a, $lettres)){
            echo $a;
        } else {
            echo " _ ";
        }
    }
}

afficher($mot, $lettres);

?>