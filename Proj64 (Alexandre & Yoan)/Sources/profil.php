<?php
    // récupération des fonctions dans les autres fichiers
    require_once('affiche.php');
    require_once('connexion.php');
    require_once('erreur.php');
    session_start();
    if(empty($_SESSION["pseudo"])){ //si on n'est pas connecté on ramène à l'accueil
        header('Location: accueil.php');
    }
    
    if($_GET["action"]=="pseudo"){ //si on a choisi "changer autres informations"
        affiche_entete_logged();
        $erreur=array();
        $donne=array();
        if($_SERVER["REQUEST_METHOD"]=="POST"){ //si on a déjà envoyé un formulaire
            $donne=$_POST;
            //on initialise $requis
            $requis["nom"]=true;
            $requis["prenom"]=true;
            $requis["adresse"]=true;
            $requis["pseudo"]=true;
            $erreur_requis=array();
            $okrequis=erreur_requis($donne,$erreur_requis); //on remplit $erreur_requis
            $connect=connect();
            $okpseudo2=true;
            $okpseudo=true;
            if($_POST["pseudo"]!=$_SESSION["pseudo"]){ //si on change de pseudo on vérifie que le nouveau pseudo n'est pas dans la base de données
                $okpseudo=!erreur_pseudo($donne,$connect);
                erreur_format_pseudo($donne,$erreur);
                $okpseudo2=($erreur==array());
            }
            mysqli_close($connect);
            if($okrequis&&$okpseudo&&$okpseudo2){ //si tout est bon, on actualise la base de données et $_SESSION
                $connect=connect();
                modifier($donne,$_SESSION["pseudo"],$connect);
                $_SESSION["pseudo"]=$donne["pseudo"];
                $_SESSION["prenom"]=get($donne["pseudo"],"prenom");
                $_SESSION["nom"]=get($donne["pseudo"],"nom");
                $_SESSION["adresse"]=get($donne["pseudo"],"adresse");
                mysqli_close($connect);
                page_succes_modif();
            }else{ //si il y a des erreurs on réaffiche le formulaire avec message d'erreur
                $erreur=erreur($donne,$erreur_requis,false,false,!$okpseudo);
                erreur_format_pseudo($donne,$erreur);
                affiche_form_modif($donne,$erreur);
            }
        }else{ //si on arrive pour la première fois, on affiche le formulaire
            affiche_form_modif($_SESSION,$erreur);
        }
    }else if($_GET["action"]=="mdp"){ //si on choisi "changer mot de passe" 
        affiche_entete_logged();
        $erreur=array();
        $donne=array();
        if($_SERVER["REQUEST_METHOD"]=="POST"){ //si on a déjà envoyé un formulaire
            $donne=$_POST;
            //on initialise $requis
            $requis["oldpassword"]=true;
            $requis["password"]=true;
            $requis["repassword"]=true;
            $erreur_requis=array();
            $okrequis=erreur_requis($donne,$erreur_requis); //on rempli $erreur_requis
            $okformat=erreur_format($donne); //on verifie le format du nouveau mdp
            $okmdp=!erreur_mdp($donne);// on regarde si les 2 mdp sont les mêmes
            $connect=connect();
            $okoldmdp=est_dans_base($_SESSION["pseudo"],$donne["oldpassword"],$connect); //on vérifie que son ancien mdp est le cien
            mysqli_close($connect);
            if($okrequis&&$okformat&&$okmdp&&$okoldmdp){ //si tout est bon on actualise la base de données
                $connect=connect();
                modif_mdp($_POST["password"],$_SESSION["pseudo"],$connect);
                mysqli_close($connect);
                page_succes_modif();
            }else{ //si il y a des erreurs on réaffiche le formulaire avec message d'erreur
                $erreur=erreur_modif_mdp($donne,$erreur_requis,!$okmdp,!$okformat,!$okoldmdp);
                affiche_form_modif_mdp($erreur);
            }
        }else{ //si on arrive pour la première fois on affiche le formulaire
            affiche_form_modif_mdp($erreur);
        }
    }else if($_GET["action"]=="suppr"){ //si on a choisi "supprimer votre compte"
        //on demande confirmation
        affiche_entete_logged();
        echo "<fieldset>Voulez vous vraiment supprimer votre compte ?<br>
              <a href=\"profil.php\">NON</a> <a class=\"error\" href=\"profil.php?action=supprimer\">OUI</a></fieldset>";
    }else if($_GET["action"]=="supprimer"){//si on a confirmer la suppression
        $connect=connect();
        //on le supprime de la base de données et on le déconnecte
        suppr($_SESSION["pseudo"],$connect);
        mysqli_close($connect);
        session_destroy();
        header('Location: accueil.php');
    }else{// si on arrive pour la premiere fois
        //on affiche le choix entre changer mdp, autres information ou supprimer compte
        affiche_entete_logged();
        affiche_choix();
    }
    affiche_footer();
?>