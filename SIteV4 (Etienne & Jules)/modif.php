<?php require_once("affichage.php"); require_once("connexion.php"); session_start();?>

<?php affiche_entete("acceuil.css");
pHeader();
        if(isset($_GET['action1'])){
            echo "Bravo, les modifications ont été effecutées";
            echo "<a href=\"accueil.php\">Revenir à l'accueil</a>";
        }else{
            traiter_modif();
        }
       




affiche_bas("accueil.css");
?>