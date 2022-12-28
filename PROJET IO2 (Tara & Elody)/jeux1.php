<?php 
    require_once("fonc_authent.php");
    require_once("fonc_sortie.php");

    session_start();
    $login = $_SESSION['user'];

    //Cette page affiche les sous-catégories d'un jeu.
    //Si le joueur n'est pas connecté, alors il affiche la page d'erreur.
    //Si le joueur est connecté, alors il peut voir les jeux possibles.

    if(!isset($login)) {
        affichage_de_la_page_erreur($login);
        exit;
    }

    $_SESSION['matiere'] = $_GET['link'];
    $matiere = $_SESSION['matiere'];
    afficher_contenu_accueil2($matiere, $login);
    
?>