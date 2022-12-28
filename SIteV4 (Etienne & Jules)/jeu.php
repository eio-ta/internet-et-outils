<?php require_once("affichage.php"); require_once("connexion.php"); session_start(); ?>
<?php affiche_entete("acceuil.css");
pHeader();

    if(isset($_GET['action1'])){
        which_cat($_GET['action1']);
    }else if(isset($_GET['action2'])){
        which_subcat($_GET['action2']);
    }else if($_GET['questions']==1){
        select_questions();
    }else{
        afficher_questions($_GET['questions']);
    }
    


affiche_bas();
?>