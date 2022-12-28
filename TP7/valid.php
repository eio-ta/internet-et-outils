<?php

$REQUIS["nom"] = true;
$REQUIS["prenom"] = true;
$REQUIS["login"] = true;
$REQUIS["passwd"] = true;

function verifierRequis (&$donnees, &$erreur) {
    global$REQUIS;
    $ok = true;
    foreach ($REQUIS as $champ => $valeur) {
        if (empty(trim($donnees[$champ]))) {
            $erreur[$champ] = true;
            $ok = false;
        }
    }
    return $ok;
}