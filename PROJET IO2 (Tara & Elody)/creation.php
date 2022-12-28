<?php 
    require_once("fonc_authent.php");
    require_once("fonc_sortie.php");

    session_start();
    $login = $_SESSION['user'];

    //Cette page gère le mode de création de questions.
    //Ici, le joueur peut créer ses propres questions, les modifier ou les supprimer.

    //Partie pour créer une question
    if($_POST['go'] == "Créer") {
        $matiere = $_POST['matiere'];
        afficher_entete("Création");
        afficher_contenu_entete_log($login);
        $matiere = $_POST['matiere'];
        formu_creer($matiere);        
        afficher_pied_page();
        exit;
    }

    if($_POST['go'] == "Créer cette question") {
        afficher_entete("Création");
        afficher_contenu_entete_log($login);
        if($_POST['question'] != null && $_POST['rep_c'] != null && $_POST['rep_inc'] != null && $_POST['catégorie'] != null && $_POST['autres'] != null) {
            if($_POST['catégorie'] == 'Autres') {
                $_POST['catégorie'] = $_POST['autres'];
            }
            $donnees = $_POST;
            enregistrer_questions($donnees, $login);
            echo "<p><span style=\"color:#45207D; font-size:20px;\"><strong>VOUS AVEZ CRÉE UNE QUESTION.</em></span><br><br><br></p>";
            afficher_pied_page();
            exit;
        } else {
            $matiere = $_POST['matiere'];
            echo "Les champs ne sont pas tous remplis.";
            formu_creer($matiere);        
            afficher_pied_page();
            exit;
        }
        
    }

    //Partie pour modifier une question
    if($_POST['go'] == "Modifier") {
        $donnees = recherche_infos_questions($_POST['id']);
        $ligne = mysqli_fetch_assoc($donnees);
        afficher_entete("Création");
        afficher_contenu_entete_log($login);
        formu_modifier($ligne);
        afficher_pied_page();
        exit;
    }

    if($_POST['go'] == "Modifier cette question") {
        afficher_entete("Modification");
        afficher_contenu_entete_log($login);

        if($_POST['question'] != null && $_POST['rep_c'] != null && $_POST['rep_inc'] != null && $_POST['catégorie'] != null && $_POST['autres'] != null) {
            if($_POST['catégorie'] == 'Autres') {
                $_POST['catégorie'] = $_POST['autres'];
            }
            $donnees = $_POST;
            modifier_questions($donnees);
            echo "<p><span style=\"color:#45207D; font-size:20px;\"><strong>VOUS AVEZ MODIFIÉ LA QUESTION.</em></span><br><br><br></p>";
            afficher_pied_page();
            exit;
        } else {
            $matiere = $_POST['matiere'];
            echo "Les champs ne sont pas tous remplis.";
            formu_modifier($matiere);        
            afficher_pied_page();
            exit;
        }
    }

    //Partie pour supprimer une question
    if($_POST['go'] == "Supprimer cette question") {
        $question = $_POST['id'];
        afficher_entete("Suppression");
        afficher_contenu_entete_log($login);
        supp_questions($question);
        echo "<p><span style=\"color:#45207D; font-size:20px;\"><strong>VOUS AVEZ SUPPRIMÉ LA QUESTION.</em></span><br><br><br></p>";
        afficher_pied_page();
        exit;
    }

    //fonction qui affiche la page normale si on ne choisit aucune fonctionnalité
    afficher_page_creation($login);

?>