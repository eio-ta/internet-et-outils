<?php require_once("affichage.php"); require_once("connexion.php"); session_start(); ?>

<?php affiche_entete("acceuil.css");
        pHeader();
        traiter_admin();
affiche_bas();
?>