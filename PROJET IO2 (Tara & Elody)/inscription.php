<?php 
    require_once("fonc_authent.php");
    require_once("fonc_sortie.php");

    $donnees = array();
    
    //Cette page affiche dans un premier temps le formulaire d'inscription.

    if(isset($_POST['login']) && !isset($_POST['go'])) {
        if($_POST['prenom'] != '' && $_POST['nom'] != '' && $_POST['mail'] != '' && $_POST['gender'] != '' && $_POST['mdp'] != '') { //Il a rempli tous les champs et est redirigé vers une page de récupitulatif. Il peut alors soit accepter son enregistrement, soit annuler.
            $donnees = $_POST;
            afficher_recupitulatif($donnees); 
            unset($_POST);
            exit;
        } else { //Il n'a pas rempli tous les champs, alors ça crée une page formulaire avec une phrase supplémentaire
            afficher_entete("Inscription");
            afficher_contenu_entete_logout();
            echo "Vous devez remplir tous les champs.<br><br>";
            afficher_contenu_inscription($donnees);
            afficher_pied_page(); 
        }
        
    }

    
    elseif($_POST['go'] == 'Valider') { //S'il remplit cette condition, alors le joueur a réussi à se faire un compte et à se connecter.
        $login = $_POST['login'];
        $donnees = $_POST;
        enregistrer($donnees);
        apres_connexion($login);
        session_start();
        $_SESSION['user'] = $login;
        unset($_POST);
        exit;
    }

    else afficher_inscription($donnees);

?>