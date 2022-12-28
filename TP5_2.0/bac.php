<?php

$t = $_GET['notes'];

$tab = array("Français" => $t[0], "Math" => $t[1], "Histoire-géo" => $t[2], "Anglais" => $t[3], "EPS" => $t[4]);

afficher($tab);
isNumeric($tab);
$m = moyenne($tab);
echo mention($m);

function afficher($tab){
    echo "Notes au dessus de 10 :", "<ul>";
    foreach($tab as $index => $valeur) {
        if($valeur >= 10){
            echo "<li>", $index, " : ", $valeur,"</li>";
        }
    }
    echo "</ul>";

    echo "Rattrapage :", "<ul>";
    foreach($tab as $index => $valeur) {
        if($valeur > 7 && $valeur < 10){
            echo "<li>", $index, " : ", $valeur,"</li>";
        }
    }
    echo "</ul>";

    echo "Notes éliminatoires", "<ul>";
    foreach($tab as $index => $valeur) {
        if($valeur < 7){
            echo "<li>", $index, " : ", $valeur,"</li>";
        }
    }
    echo "</ul>";

    echo "Demandes d'entretien", "<ul>";
    foreach($tab as $index => $valeur) {
        if($valeur < 2){
            echo "<li>", $index, " : ", $valeur,"</li>";
        }
    }
    echo "</ul>";
}

function isNumeric($tab){
    echo "Erreur de saisie, la valeur n'est pas comprise entre 0 et 20", "<ul>";
    foreach($tab as $index => $valeur){
        if(!($valeur > 0 && $valeur < 20)){
            echo "<li>", $index, " : ", $valeur,"</li>";
        }
    }
    echo "</ul>";
}

function moyenne($tab){
    echo "Moyenne : ";
    $res = 0;
    foreach($tab as $index => $valeur){
        $res = $valeur;
    }
    echo $res/5, "<br>";
    return $res/5;
}

function mention($moyenne){
    if($moyenne < 7){
        return "Recalé.";
    } elseif ($moyenne > 7 && $moyenne < 10){
        return "Rattrapage.";
    } elseif ($moyenne >= 10 && $moyenne < 12){
        return "Passable.";
    } elseif ($moyenne >= 12 && $moyenne < 14){
        return "Assez bien.";
    } elseif ($moyenne >= 14 && $moyenne < 16){
        return "Bien.";
    } else {
        return "Très bien.";
    }
}


?>