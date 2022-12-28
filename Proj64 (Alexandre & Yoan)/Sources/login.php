<?php 
    //Fichier gérant la connexion de l'utilisateur

    //récupération des fonctions dans les autres fichiers
    require_once("affiche.php");
    require_once("connexion.php");
    require_once("erreur.php");
    session_start();
    if(isset($_SESSION["pseudo"])){ //si on est connecté, on empeche l'acces à cette page
        header('Location: accueil.php');
    }
    $donne=array();
    $erreur=array();
    if($_SERVER["REQUEST_METHOD"]=="POST"){ //si on a déjà envoyé un formulaire 
        $donne=$_POST;
        //initialisation du tableau $requis
        $requis["pseudo"]=true;
        $requis["password"]=true;
        $erreur_requis=array();
        $okrequis=erreur_requis($donne,$erreur_requis); //on remplit $erreur_requis
        if(!$okrequis){ //si tout n'est pas rempli on réaffiche le formulaire en affichant un message d'erreur correspondant
            affiche_entete();
            $erreur=erreur_log($donne,$erreur_requis);
            affiche_form_login($donne,$erreur);
            affiche_footer();
            exit;
        }
        //pas d'erreur requis
        $connect=connect();
        $okdansbase=est_dans_base($donne["pseudo"],$donne["password"],$connect);//on regarde si le couple (pseudo,mdp) est la base 
        mysqli_close($connect);
        if($okdansbase){ //si il y est on rempli le $_SESSION
            $_SESSION["pseudo"]=$donne["pseudo"];
            $_SESSION["prenom"]=get($donne["pseudo"],"prenom");
            $_SESSION["nom"]=get($donne["pseudo"],"nom");
            $_SESSION["adresse"]=get($donne["pseudo"],"adresse");
            $_SESSION["role"]=get($donne["pseudo"],"role");
            $_SESSION["id"]=get($donne["pseudo"],"id");
            header('Location: accueil.php');
        }else{ //sinon on réaffiche le formulaire avec message d'erreur correspondant
            affiche_entete();
            $erreur["pseudo"]="Pseudo ou mot de passe incorrect";
            affiche_form_login($donne,$erreur);
            affiche_footer();
        }
    }else{ //si on arrive pour la premiere fois on affiche le formulaire
        affiche_entete();
        affiche_form_login($donne,$erreur);
        affiche_footer();
    }

?>