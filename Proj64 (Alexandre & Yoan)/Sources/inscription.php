<?php 
    //Fichier gérant l'incription

    //on récupère les fonctions des autres fichiers
    require_once("affiche.php");
    require_once("erreur.php");
    require_once("connexion.php");
    $erreur=array();
    $donne=array();
    affiche_entete();
    if($_SERVER["REQUEST_METHOD"]=="POST"){ //si on a déjà envoyé un formulaire d'inscription
        $donne=$_POST;
        //on initialise le tableau $requis
        $requis["nom"]=true;
        $requis["prenom"]=true;
        $requis["adresse"]=true;
        $requis["password"]=true;
        $requis["repassword"]=true;
        $requis["pseudo"]=true;
        $erreur_requis=array();
        $okrequis=erreur_requis($donne,$erreur_requis); //on remplit $erreur_requis
        $okformat=erreur_format($donne); //on verifie le format du mdp
        $okmdp=!erreur_mdp($donne); //on verifie que les 2 mdp sont les mêmes 
        $connect=connect();
        $okpseudo=!erreur_pseudo($donne,$connect); //on vérifie que personne dans la base de données a ce pseudo
        mysqli_close($connect);
        erreur_format_pseudo($donne,$erreur);
        $okpseudo2=($erreur==array());
        if($okrequis&&$okformat&&$okmdp&&$okpseudo&&$okpseudo2){ //si tout est bon on l'enregistre
            $connect=connect();
            enregistrer($donne,$connect);
            mysqli_close($connect);
            page_succes();
        }else{ //sinon on réaffiche le formulaire d'inscription avec message d'erreur
            $erreur=erreur($donne,$erreur_requis,!$okmdp,!$okformat,!$okpseudo);
            erreur_format_pseudo($donne,$erreur);
            affiche_form_inscrip($donne,$erreur);
        }
    }else{ //si on arrive pour la premiere fois on affiche le formulaire d'inscription
        affiche_form_inscrip($donne,$erreur);
    }
    affiche_footer();
?>