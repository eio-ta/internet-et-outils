<?php 
    require_once("fonc_authent.php");
    require_once("fonc_sortie.php");

    session_start();
    $login = $_SESSION['user'];
    $matiere = $_SESSION['matiere'];
    $_SESSION['catégorie'] = $_GET['link'];
    $categorie = $_SESSION['catégorie'];

    //Affiche le bouton 'Commencer' pour commencer le jeu choisi.
    afficher_contenu_question($matiere, $categorie, $login)
?>