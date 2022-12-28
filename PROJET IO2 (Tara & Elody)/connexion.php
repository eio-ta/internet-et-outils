<?php 
    require_once("fonc_authent.php");
    require_once("fonc_sortie.php");

    //Cette page affiche le formulaire de connexion et la page de réussite en cas de connexion.
    $login = $_POST['login'];
    $mdp = $_POST['mdp'];

    
    if (isset($login)) { //Si $login n'existe pas, alors il affiche le formulaire sinon il affiche la page de réussite en cas de connexion.
        if (verifier_login($login, $mdp)) {
            session_start();
            $_SESSION['user'] = $login;
            apres_connexion($login);
            exit;
        }
    }
    afficher_connexion($login, $mdp);

?>
