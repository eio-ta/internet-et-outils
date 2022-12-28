<?php session_start(); require_once("affichage.php");?>
<?php
    affiche_entete("acceuil.css");
    pHeader();
    
    if(!isset($_SESSION['numero']) || $_SESSION['numero']==0){
        traiter_questionnaire();
        echo $_SESSION['erreur'];
        
    }
    if(!(!isset($_SESSION['numero']) || $_SESSION['numero']==0)){      
        traiter_creation_questions();
    }    
    

    

    
    affiche_bas();
?>