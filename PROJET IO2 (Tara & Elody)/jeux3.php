<?php 
    require_once("fonc_authent.php");
    require_once("fonc_sortie.php");

    //Cette page gère le déroulement de la page de jeux.
    //Elle se constitue de deux parties : si $donnees est null (il n'y a pas/plus de questions), alors il affiche la page des résultats avec le nombre de points.
    //Si $donnees != null, alors il affiche la question.
    //Toutes les variables sont supprimées à la fin du jeu ($_SESSION) mais elles sont enregistrées dans la base de données.
    //Seule $_SESSION['user'] est conservée.

    session_start();
    $login = $_SESSION['user'];
    $matiere = $_SESSION['matiere'];
    $categorie = $_SESSION['catégorie'];
    $donnees = lire_tableau_de_questions($matiere, $categorie); //variable qui gère les questions

    if(!isset($_SESSION['nb'])) { //Variable qui gère le nombre de questions.
        $_SESSION['nb'] = 1;
    } else {
        $_SESSION['nb'] += 1;
    }

    $nb = $_SESSION['nb'];

    while($nb != 0) { //conditions qui fait 'tourner' les questions dans le même ordre.
        $ligne = mysqli_fetch_assoc($donnees);
        $nb -= 1;
    }

    if(!isset($_POST['reponse'])) { //variable qui gère le nombre de point et le nombre de questions fausses et pas justes.
        $_SESSION['point'] = 0;
        $_SESSION['question_juste'] = 0;
        $_SESSION['question_pas_juste'] = 0;
        $reponse = 'je ne sais pas';
    } else {
        if($_POST['reponse'] == 'Correcte') {
            $reponse = "juste";
            $_SESSION['point'] += 5;
            $_SESSION['question_juste'] += 1;
        } else {
            $reponse = "pas juste";
            $_SESSION['point'] -= 2;
            $_SESSION['question_pas_juste'] += 1;
        }
    }

    if($ligne != null) { //conditions finales
        $donnees = $_SESSION;
        afficher_debut_des_questions($ligne, $login, $donnees, $reponse);
    } else {
        $donnees = $_SESSION;
        afficher_fin_des_questions($donnees, $login, $reponse);
    }
    
?>