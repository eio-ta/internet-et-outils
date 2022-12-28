<?php
    require_once("fonc_authent.php");
    require_once("fonc_sortie.php");
    session_start();

    //Ce fichier gère les pages supplémentaires de la bas de la page (Informations, Contact, Remerciement)
    afficher_entete("Bas de la page");
    session_start();
    $login = $_SESSION["user"];
    if(isset($_SESSION["user"])) {
        afficher_contenu_entete_log($login);
    } else {
        afficher_contenu_entete_logout();
    }

    if ($_GET['link'] == "information"){
        afficher_contenu_information();
    }
    if ($_GET['link'] == "contact"){
        afficher_contenu_contact();
    }
    if ($_GET['link'] == "remerciement"){
        afficher_contenu_remerciement();
    }

    afficher_pied_page ();
?>
