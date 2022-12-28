<?php
	require_once('fonc_sortie.php');

    function connexion_bd() { //fonction qui gère la connexion à la base MySQL
        $serv ="127.0.0.1";
        $username = "root";
        $pwd = "Cereale.123#E"; //Mettez votre MDP
        $bd = "base_1"; //Mettez la base de données que vous utilisez
        $connex = mysqli_connect($serv, $username, $pwd, $bd);
        if (!$connex) {
            page_erreur();
            exit;
        }
        return $connex;
    }

    
// - - - - - - - - - - Fonctions qui retournent un tableau de résultats - - - - - - - - - -

function lire_login($connex, $login, $mdp) { //fonction qui regarde s'il y a une personne avec $login et $mdp dans la base de données (renvoie les résultats)
    $login = mysqli_real_escape_string($connex, $login);
    $mdp = mysqli_real_escape_string($connex, $mdp);
    $req = "select * from bd_users where Identifiant = '$login' AND Mot_de_Passe = MD5('$mdp');";
    $resultat = mysqli_query($connex, $req);
    if (!$resultat && mysqli_num_rows($resultat) == 0) {
        page_erreur();
        mysqli_close($connex);
        exit;
    }
    return $resultat;
}

function lire_information($login) { //fonction qui renvoie les données personnelles de $login
    $connex = connexion_bd();
    $login = mysqli_real_escape_string($connex, $login);
    $req = "select * from bd_users where Identifiant = '$login'";
    $resultat = mysqli_query($connex, $req);
    if (!$resultat && mysqli_num_rows($resultat) == 0) {
        page_erreur();
        mysqli_close($connex);
        exit;
    }
    return $resultat;
}

function lire_tableau_de_questions($matiere, $categorie) { //fonction qui renvoie un tableau de toutes les questions dans $matiere et $categorie
    $connex = connexion_bd();
    $login = mysqli_real_escape_string($connex, $login);
    $login = mysqli_real_escape_string($connex, $login);
    $req = "select * from questions where Matière = '$matiere' and Catégorie = '$categorie' order by Niveau;";
    $resultat = mysqli_query($connex, $req);
    if (!$resultat) {
        page_erreur();
        mysqli_close($connex);
        exit;
    }
    return $resultat;
}

function lire_information_resultats($login) { //fonction qui renvoie le tableau des jeux faits par un joueur
    $connex = connexion_bd();
    $login = mysqli_real_escape_string($connex, $login);
    $req = "select id from bd_users where Identifiant ='$login'";
    $resultat = mysqli_query($connex, $req);
    $id = '0';

    if($resultat) {
        $ligne = mysqli_fetch_assoc($resultat);
        $id = getID($ligne);
    }

    $req = "select * from resultats where users_id = '$id' order by Matière;";
    $resultat = mysqli_query($connex, $req);
    if (!$resultat && mysqli_num_rows($resultat) == 0) {
        page_erreur();
        mysqli_close($connex);
        exit;
    }
    return $resultat;
}

function lire_classement($matiere, $categorie) { //fonction qui renvoie un classement classé
    $connex = connexion_bd();
    $matiere = mysqli_real_escape_string($connex, $matiere);
    $categorie = mysqli_real_escape_string($connex, $categorie);
    $req = "select users_id, Score from resultats where Matière='$matiere' and Catégorie='$categorie' order by Score desc;";
    $resultat = mysqli_query($connex, $req);
    if (!$resultat) {
        page_erreur();
        mysqli_close($connex);
        exit;
    }
    return $resultat;
}

function recherche_questions($login) { //renvoie toutes les questions créees fait par $login
    $connex = connexion_bd();
    $login = mysqli_real_escape_string($connex, $login);
    $req = "select * from questions where Créateur='$login'";
    $resultat = mysqli_query($connex, $req);
    if (!$resultat) {
        page_erreur();
        mysqli_close($connex);
        return;
    }
    return $resultat;
}

function recherche_infos_questions($question) { //renvoie un tableau de données où $question == Question
    $connex = connexion_bd();
    $question = mysqli_real_escape_string($connex, $question);
    $req = "select * from questions where Question='$question'";
    $resultat = mysqli_query($connex, $req);
    if (!$resultat) {
        page_erreur();
        mysqli_close($connex);
        return;
    }
    return $resultat;
}

function lire_messages() { //fonction qui lit tous les messages signalés
    $connex = connexion_bd();
    $login = mysqli_real_escape_string($connex, $login);
    $req = "select * from messages";
    $resultat = mysqli_query($connex, $req);
    if (!$resultat) {
        page_erreur();
        mysqli_close($connex);
        return;
    }
    return $resultat;
}

function lire_categorie_en_fonction_de_matiere($matiere) { //fonction qui lit les différentes catégories en fonction des matières
    $connex = connexion_bd();
    $matiere = mysqli_real_escape_string($connex, $matiere);
    $req = "select distinct Catégorie from questions where Matière='$matiere' order by Catégorie";
    $resultat = mysqli_query($connex, $req);
    if (!$resultat) {
        page_erreur();
        mysqli_close($connex);
        return;
    }
    return $resultat;
}


// - - - - - - - - - - Fonctions qui retrouvent le ID d'une personne ou le pseudo d'une personne - - - - - - - - - -

function getUsers($id){ //renvoie $login de ID
    $connex = connexion_bd();
    $id = mysqli_real_escape_string($connex, $id);
    $req = "select Identifiant from bd_users where id='$id'";
    $resultat = mysqli_query($connex, $req);
    if (!$resultat) {
        page_erreur();
        mysqli_close($connex);
        return;
    }
    return $resultat;
}

function getId($donnees) { //return le ID d'un tableau de données personnelles d'une personne
    return $donnees['id'];
}


// - - - - - - - - - - Fonctions qui enregistrent/modifient quelque chose dans la base de données - - - - - - - - - -

function enregistrer($donnees) { //fonction qui enregistre les données d'une personne qui s'inscrit
    $connex = connexion_bd();
    $nom = mysqli_real_escape_string($connex,$donnees['nom']);
    $prenom = mysqli_real_escape_string($connex,$donnees['prenom']);
    $login = mysqli_real_escape_string($connex,$donnees['login']);
    $mail = mysqli_real_escape_string($connex,$donnees['mail']);
    $sexe = mysqli_real_escape_string($connex,$donnees['gender']);
    $mdp = mysqli_real_escape_string($connex,$donnees['mdp']);
    $req = "select * from bd_users where Identifiant ='$login'";
    $resultat = mysqli_query($connex, $req);
   
    if($resultat && mysqli_num_rows($resultat) == 0) {
        mysqli_free_result($resultat);
        $req = "insert into bd_users (Prénom, Nom, Identifiant, Adresse_mail, Sexe, Mot_de_Passe) values ('$prenom', '$nom', '$login', '$mail', '$sexe', MD5('$mdp'));";
        $resultat = mysqli_query($connex, $req);
        if ($resultat) {
            mysqli_close($connex);
            return;
        }
    }

    if (!$resultat) {
        page_erreur();
    }
    
    if (mysqli_num_rows($resultat) > 0) {
        afficher_entete("Inscription");
        afficher_contenu_entete_logout();
        echo "L'identifiant a déjà été utilisé. Veuillez changer votre identifiant.<br><br>";
        afficher_contenu_inscription($donnees);
        afficher_pied_page();  
    }
    
    mysqli_close($connex);
    exit;
}

function enregistrer_pts($donnees) { //enregistre les points d'un jeu d'un joueur dans la base de données
    $connex = connexion_bd();
    $login = mysqli_real_escape_string($connex,$donnees['user']);
    $score = mysqli_real_escape_string($connex,$donnees['point']);
    $matiere = mysqli_real_escape_string($connex,$donnees['matiere']);
    $categorie = mysqli_real_escape_string($connex,$donnees['catégorie']);
    $req = "select id from bd_users where Identifiant ='$login'";
    $resultat = mysqli_query($connex, $req);
    $id = '0';

    if($resultat) {
        $ligne = mysqli_fetch_assoc ($resultat);
        $id = getID($ligne);
    }

    $req = "select * from resultats where Matière = '$matiere' and Catégorie = '$categorie' and users_id = '$id';";
    $resultat = mysqli_query($connex, $req);
   
    if($resultat && mysqli_num_rows($resultat) == 0) {
        mysqli_free_result($resultat);
        $req = "insert into resultats values ('$id', '$score', '$matiere', '$categorie');";
        $resultat = mysqli_query($connex, $req);
        if ($resultat) {
            mysqli_close($connex);
            return;
        }
    }

    if (!$resultat) {
        page_erreur();
    }
    
    elseif (mysqli_num_rows($resultat) == 1) {
        mysqli_free_result($resultat);
        $req = "update resultats set Score='$score' where Matière = '$matiere' and Catégorie = '$categorie' and users_id = '$id';";
        $resultat = mysqli_query($connex, $req);
        if ($resultat) {
            mysqli_close($connex);
            return;
        }
    }
    
    mysqli_close($connex);
    exit;
}

function enregistrer_questions($donnees, $login) { //fonction qui enregistre des questions faites par $login
    $connex = connexion_bd();
    $login = mysqli_real_escape_string($connex,$login);
    $question = mysqli_real_escape_string($connex,$donnees['question']);
    $rep_c = mysqli_real_escape_string($connex,$donnees['rep_c']);
    $rep_inc = mysqli_real_escape_string($connex,$donnees['rep_inc']);
    $niveau = mysqli_real_escape_string($connex,$donnees['niveau']);
    $matiere = mysqli_real_escape_string($connex,$donnees['matiere']);
    $cate = mysqli_real_escape_string($connex,$donnees['catégorie']);
    $req = "insert into questions (Question, Réponse_correcte, Réponse_incorrecte, Niveau, Matière, Catégorie, Créateur) values ('$question', '$rep_c', '$rep_inc', $niveau, '$matiere', '$cate', '$login');";
    $resultat = mysqli_query($connex, $req);
   
    if ($resultat) {
            mysqli_close($connex);
            return;
        }
    
    if (!$resultat) {
        page_erreur();
    }
    
    mysqli_close($connex);
    exit;
}

function enregistrer_message($donnees) { //fonction qui enregistre les messages de signalement
    $connex = connexion_bd();
    $login = mysqli_real_escape_string($connex,$donnees['identifiant']);
    $question = mysqli_real_escape_string($connex,$donnees['question']);
    $message = mysqli_real_escape_string($connex,$donnees['message']);
    $auteur = mysqli_real_escape_string($connex,$donnees['auteur']);
    $req = "insert into messages values ('$login', '$question', '$message', '$auteur');";
    $resultat = mysqli_query($connex, $req);
   
    if ($resultat) {
            mysqli_close($connex);
            return;
        }
    
    if (!$resultat) {
        page_erreur();
    }
    
    mysqli_close($connex);
    exit;
}

function modifier($donnees, $ancienlogin) { //fonction qui modifie les données personnes de $ancienlogin
    $connex = connexion_bd();
    $nom = mysqli_real_escape_string($connex,$donnees['Nom']);
    $prenom = mysqli_real_escape_string($connex,$donnees['Prénom']);
    $login = mysqli_real_escape_string($connex,$donnees['Identifiant']);
    $mail = mysqli_real_escape_string($connex,$donnees['Adresse_mail']);
    $sexe = mysqli_real_escape_string($connex,$donnees['Sexe']);
    $mdp = mysqli_real_escape_string($connex,$donnees['mdp']);
    $req = "select * from bd_users where Identifiant ='$login'";
    $resultat = mysqli_query($connex, $req);
   
    if($resultat && mysqli_num_rows($resultat) == 0) {
        mysqli_free_result($resultat);
        $req = "update bd_users set Prénom='$prenom', Nom='$nom', Identifiant='$login', Adresse_mail='$mail', Sexe='$sexe', Mot_de_Passe=MD5('$mdp') where Identifiant='$ancienlogin';";
        $resultat = mysqli_query($connex, $req);
        if ($resultat) {
            mysqli_close($connex);
            return;
        }
    }

    if (!$resultat) {
        page_erreur();
    }
    
    elseif (mysqli_num_rows($resultat) > 0) {
        afficher_entete("Modification");
        afficher_contenu_entete_log($login);
        echo "<p><span style=\"color:#45207D; font-size:20px;\"><strong>MODIFICATION DES DONNÉES:</strong></span><br><br><br></p>";
        echo "L'identifiant est déjà utilisé.<br><br>";
        afficher_modification_des_donnees($donnees, $login); 
    }
    
    mysqli_close($connex);
    exit;
}

function modifier_questions($donnees) { //fonction qui modifie des questions
    $connex = connexion_bd();
    $question = mysqli_real_escape_string($connex,$donnees['question']);
    $rep_c = mysqli_real_escape_string($connex,$donnees['rep_c']);
    $rep_inc = mysqli_real_escape_string($connex,$donnees['rep_inc']);
    $ancien = mysqli_real_escape_string($connex,$donnees['ancien']);
    $cate = mysqli_real_escape_string($connex,$donnees['catégorie']);
    $niveau = mysqli_real_escape_string($connex,$donnees['niveau']);
    $req = "update questions set Question='$question', Réponse_correcte='$rep_c', Réponse_incorrecte='$rep_inc', Catégorie='$cate', Niveau='$niveau' where Question='$ancien';";
    $resultat = mysqli_query($connex, $req);

    if ($resultat) {
        mysqli_close($connex);
        return;
    }

    mysqli_close($connex);
    exit;
}

function modifier_créateur_question($login, $ancienlogin) { //fonction qui modifie le nom du créateur des questions (fonction utilisée lorsque une personne change de login)
    $connex = connexion_bd();
    $login = mysqli_real_escape_string($connex,$login);
    $ancienlogin = mysqli_real_escape_string($connex,$ancienlogin);
    $req = "update questions set Créateur='$login' where Créateur='$ancienlogin';";
    $resultat = mysqli_query($connex, $req);

    if ($resultat) {
        mysqli_close($connex);
        return;
    }

    mysqli_close($connex);
    exit;

}


// - - - - - - - - - - Fonctions qui suppriment quelque chose dans la base de données - - - - - - - - - -

function supprimer_compte($ligne) { //fonction qui supprimer un compte
    $connex = connexion_bd();
    $login = mysqli_real_escape_string($connex, $ligne['Identifiant']);
    $req = "delete from bd_users where Identifiant = '$login';";
    $resultat = mysqli_query($connex, $req);
    if (!$resultat && mysqli_num_rows($resultat) == 0) {
        page_erreur();
		mysqli_close($connex);
		exit;
    }
}

function supp_questions($question) { //fonction qui supprime $question
    $connex = connexion_bd();
    $question = mysqli_real_escape_string($connex, $question);
    $req = "delete from questions where Question = '$question';";
    $resultat = mysqli_query($connex, $req);
    if (!$resultat && mysqli_num_rows($resultat) == 0) {
        page_erreur();
        mysqli_close($connex);
        exit;
    }
}

function supp_tt_questions($login) { //fonction qui supprime toutes les questions de $login
    $connex = connexion_bd();
    $login = mysqli_real_escape_string($connex, $login);
    $req = "delete from questions where Créateur = '$login';";
    $resultat = mysqli_query($connex, $req);
    if (!$resultat && mysqli_num_rows($resultat) == 0) {
        page_erreur();
        mysqli_close($connex);
        exit;
    }
}

// - - - - - - - - - - Fonctions qui vérifient quelque chose dans la base de données - - - - - - - - - -

function verifier_si_admin($login) { //fonction qui vérifie si une personne est admin ou pas (revoie un booléen)
    $connex = connexion_bd();
    $req = "select Rôle from bd_users where Identifiant = '".$login."'";
    $resultat = mysqli_query($connex, $req);
    if($resultat) {
        $ligne = mysqli_fetch_assoc ($resultat);
        if ($ligne['Rôle'] == "Admin") return true;
        if ($ligne['Rôle'] == "UTILISATEUR") return false;
    }
    if (!$resultat) {
        mysqli_close($connex);
        return false;
    }
}

function verifier_login($login, $mdp) { //vérifie si le $login et le $mdp sont bons
    $connex = connexion_bd();
    $user = lire_login($connex, $login, $mdp);
    $success = mysqli_num_rows($user) != 0;
    mysqli_free_result($user);
    mysqli_close($connex);
    return $success;
}

?>
