<?php

$REQUIS["nom"] = true;
$REQUIS["prenom"] = true;
$REQUIS["login"] = true;
$REQUIS["city"] = true;
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

function verifier_login($login, $mdp) {
    $connex = connexion_bd();
    $user = lire_login($connex, $login, $mdp);
    $success = mysqli_num_rows($user) != 0;
    mysqli_free_result($user);
    mysqli_close($connex);
    return $success;
}


?>