<?php 
    require_once("fonc_authent.php");
    require_once("fonc_sortie.php");

    session_start();
    $login = $_SESSION['user'];

    //Cette page a deux fonctionnalités : elle recherche l'utilisateur ($_GET['utilisateur']) ou elle recherche le classement de la catégorie que vous voulez ($_GET['classement']).

    //Fonctions qui gèrent la recherche d'utilisateurs
    if($_GET['link'] == 'utilisateurs') {
        if(!isset($_POST['go'])) {
            afficher_formulaire_recherche($login); //affiche le formulaire de recherche
            exit;
        } else {
            $login_recher = $_POST['login'];
            $donnees = lire_information($login_recher);
            afficher_res($donnees, $login); //affiche les résultats
            exit;
        }
    }

    //Fonctions qui gèrent la recherche de classement
    if($_GET['link'] == 'classement') {
        if(!isset($_POST['go'])) {
            afficher_questionnaire1($login); //affiche le quetsionnaire pour savoir la matière
            exit;
        } else {
            $_SESSION['matiere'] = $_POST['matière'];
            $matiere = $_SESSION['matiere'];
            if(!isset($_POST['rego'])) {
                afficher_questionnaire2($matiere, $login); //affiche le questionnaire pour savoir la catégorie
                exit;
            } else {
                $_SESSION['categorie'] = $_POST['catégorie'];
                $catégorie = $_SESSION['categorie'];
                $donnees = lire_classement($matiere, $catégorie);
                afficher_classement($donnees, $matiere, $catégorie, $login); // affiche le classement
            exit;
            }
        }
    }

?>