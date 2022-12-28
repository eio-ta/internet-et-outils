<?php session_start(); ?>
<?php require_once('affichage.php');?>
<?php require_once('connexion.php'); ?>

<?php  
    affiche_entete("acceuil.css");
    pHeader();
    traiter_formulaire_connexion();
    

?>



<?php affiche_bas(); ?>