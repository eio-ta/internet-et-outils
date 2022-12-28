<?php 
    require_once("fonc_authent.php");
    require_once("fonc_sortie.php");

    session_start();
    $login = $_SESSION['user'];

    //Cette page sert à modifier toutes les données que l'utilisateur et l'administrateur peuvent effectuer.


    //Partie pour supprimer une question de l'utilisateur (C'est l'administrateur qui peut faire ça.)
    if($_POST['go'] == "Supprimer une question de cet utilisateur") {
        $login_2 = $_POST['login'];
        afficher_entete("Supprimer des questions");
	    afficher_contenu_entete_log($login);
        echo "<div class=\"titre\"><p>Questions créées par cet utilisateur :</p></div><br><br>";
        $questions = recherche_questions($login_2);
        echo "<table><tr><td id=\"donnees_1\"><strong>ID</strong></td><td id=\"donnees_1\"><strong>Matière</strong></td><td id=\"donnees_1\"><strong>Catégorie</strong></td><td id=\"donnees_1\"><strong>Niveau</strong></td><td id=\"donnees_1\"><strong>Question</strong></td><td id=\"donnees_1\"><strong>Réponse correcte</strong></td><td id=\"donnees_1\"><strong>Réponse incorrecte</strong></td></tr>";

        while($ligne2 = mysqli_fetch_assoc($questions)) {
            echo "<tr><td id=\"donnees_1\">", $ligne2['id'], "</td><td id=\"donnees_1\">", $ligne2['Matière'], "</td><td id=\"donnees_1\">", $ligne2['Catégorie'], "</td><td id=\"donnees_1\">", $ligne2['Niveau'], "</td><td id=\"donnees_1\">", $ligne2['Question'], "</td><td id=\"donnees_1\">", $ligne2['Réponse_correcte'], "</td><td id=\"donnees_1\">", $ligne2['Réponse_incorrecte'], "</td></tr>";
        }
        echo "</table></section><br><br>";

        echo "<section>
        <div class=\"titre\">
            <p>Supprimer une question de cet utilisateur</p>
        </div><br><br>
        <p><strong>Vous voulez supprimer quelle question ?</strong><br><br></p>

        <form action=\"modification.php\" method=\"post\">
            <table>
                <tr>
                    <td><select name=\"id\">";
                    $id_questions = recherche_questions($login_2);
                    while($ligne = mysqli_fetch_assoc($id_questions)) {
                        echo "<option value=\"", $ligne['Question'], "\">", $ligne['Question'], "</option>";
                    }
            
                echo "</select>";

            echo "</tr><tr><td><input type=\"submit\" name=\"go\" value=\"Supprimer !!!!\"></td></tr></table></section><br><br>";
            afficher_pied_page();
        exit;
    }

    if($_POST['go'] == "Supprimer !!!!") {
        $question = $_POST['id'];
        afficher_entete("Suppression");
        afficher_contenu_entete_log($login);
        supp_questions($question);
        echo "<p><span style=\"color:#45207D; font-size:20px;\"><strong>VOUS AVEZ SUPPRIMÉ LA QUESTION.</em></span><br><br><br></p>";
        afficher_pied_page();
        exit;
    }

    //Partie pour supprimer un compte (le sien ou celui d'un autre.)

    if($_POST['go'] == "Supprimer") { //tout le monde peut supprimer son compte à lui.
        $donnees = lire_information($login);
        $ligne = mysqli_fetch_assoc($donnees);
        supprimer_compte($ligne);
        supp_tt_questions($login);
        afficher_supprimer($login);
        session_destroy();
        exit;
    }

    if($_POST['go'] == "Supprimer ce compte") { //conditions : l'administrateur supprime le compte de qqn d'autre.
        $login_supp = $_POST['login'];
        $donnees = lire_information($login_supp);
        $ligne = mysqli_fetch_assoc($donnees);
        supprimer_compte($ligne);
        supp_tt_questions($login_supp); //Si l'administrateur supprime le compte de quelqu'un alors toutes les questions que cette personne a crées sont supprimées.
        afficher_entete("Supprimer un compte !");
	    afficher_contenu_entete_log($login);
	    echo "<p><span style=\"color:#45207D; font-size:20px;\"><strong>VOUS VOUS AVEZ SUPPRIMÉ LE COMPTE DE $login_supp </em></span><br><br><br></p>";
	    afficher_pied_page();
        exit;
    }

    //Partie pour modifier ses données personnelles 
    if($_POST['go'] == "Modification") { 
        $donnees = lire_information($login);
        $ligne = mysqli_fetch_assoc($donnees);
        afficher_entete("Modification");
        afficher_contenu_entete_log($login);
        echo "<p><span style=\"color:#45207D; font-size:20px;\"><strong>MODIFICATION DES DONNÉES:</strong></span><br><br><br></p>";
        afficher_modification_des_donnees($ligne, $login);
        exit;
    }

    if($_POST['go'] == "Valider") {
        $login = $_POST['Identifiant'];
        $ancienlogin = $_POST['ancienlogin'];
        $mdp_vieux = $_POST['mdp_vieux'];
        $mdp = $_POST['mdp'];
        $donnees = $_POST;
        if (verifier_login($ancienlogin, $mdp_vieux)) {
            modifier($donnees, $ancienlogin);
            modifier_créateur_question($login, $ancienlogin);
            afficher_apres_modification($login);
            session_start();
            $_SESSION['user'] = $login;
            exit;
        }
        afficher_entete("Modification");
        afficher_contenu_entete_log($login);
        echo "<p><span style=\"color:#45207D; font-size:20px;\"><strong>MODIFICATION DES DONNÉES:</strong></span><br><br><br></p>";
        echo "Votre mot de passe est incorrect.";
        afficher_modification_des_donnees($ligne, $login);
        exit;
    }

?>