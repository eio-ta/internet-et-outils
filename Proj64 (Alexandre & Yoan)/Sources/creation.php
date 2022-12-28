<?php
    //Fichier gérant la création de cartes

    //Récupèration les fonctions des autres fichiers
    require_once("affiche.php");
    require_once("erreur.php");
    require_once("connexion.php");
    //Récupèration de la session
    session_start();
    //si on n'est pas passé par "ajouter une carte" ou on n'est pas connecter, on redirige vers creer.php
    if(empty($_SESSION["paquet"])){
        header('Location: creer.php');
    }
    if($_GET["action"]=="choixNombreQCM"){ //page pour choisir le nombre de choix pour le qcm
        if($_SERVER["REQUEST_METHOD"]=="POST"){ //si on a envoyé le formulaire 
            if(!isset($_POST["nombre"])||$_POST["nombre"]==0){ //on verifie qu'il a bien rentré quelque chose sinon on reaffiche le formulaire avec message d'erreur
                affiche_entete_logged();
                //on remplie le tableau d'erreur
                $erreur["nombre"]="Ce Champs est requis";
                //on réaffiche le formulaire avec message d'erreur
                affiche_form_choixNombreQCM($erreur);
                affiche_footer();
            }else{ //si c'est bon on le redirige vers la page finQCM avec une variable $_SESSION["MDP"] indiquant la page d'ou il vient
                $_SESSION["MDP"]="NUMBERQ";
                $_SESSION["nombre"]=$_POST["nombre"];
                header('Location: creation.php?action=FinQCM');
            }
        }else{ //si on arrive sur le formulaire pour la premiere fois
            unset($_SESSION["MDP"]);
            //on affiche le formulaire 
            affiche_entete_logged();
            $erreur=array();
            affiche_form_choixNombreQCM($erreur);
            affiche_footer();
        }
    }else if($_GET["action"]=="FinQCM"){ //page pour la remplir la question et les réponses possibles pour le QCM
        if($_SERVER["REQUEST_METHOD"]=="POST"){ //si on a envoyé un formulaire
            $donne=$_POST; 
            //on initialise le tableau $requis
            $requis["Question"]=true;
            $requis["Reponse"]=true;
            $erreur=array();
            for($i=2; $i<=$_SESSION["nombre"]; $i++){
                $requis["Reponse".$i]=true;
            }
            erreur_format_form($donne, $erreur); //on remplie $erreur avec les erreur format
            $okformat=($erreur==array());
            $erreur_requis=array();
            $okrequis=erreur_requis($donne,$erreur_requis); //on $erreur avec les erreur requis
            if($okrequis&&$okformat){ //si tout est bon (format et requis) on prepare les champs pour les indérer dans la base de données
                $reponses=$donne["Reponse"];
                for($i=2; $i<=$_SESSION["nombre"]; $i++){
                    $reponses=$reponses."|@$|".$donne["Reponse".$i];
                }
                $connect=connect();
                enregistrement_carte($connect,$_SESSION["paquet"],$donne["Question"],$donne["Reponse"],1,$reponses);
                unset($_SESSION["nombre"]);
                //préparation pour la page suivante
                $_SESSION["MDP"]="FIN";
                header('Location: creation.php?action=Reussie');
            }else{ //sinon on réaffiche le formulaire avec message d'erreur
                erreur_reponse_qcm($erreur, $erreur_requis);
                affiche_entete_logged();
                affiche_form_FinQCM($donne,$erreur);
                affiche_footer();
            }
        }else{ //si on arrive sur le formulaire pour la premiere fois
            if($_SESSION["MDP"]!="NUMBERQ"){ //on verifie qu'il vient bien de la bonne page sinon on le redirige
                unset($_SESSION["MDP"]);
                unset($_SESSION["paquet"]);
                unset($_SESSION["nombre"]);
                header('Location: creation.php');
            }
            unset($_SESSION["MDP"]);
            //on affiche le formulaire
            affiche_entete_logged();
            $donne=array();
            $erreur=array();
            affiche_form_FinQCM($donne,$erreur);
            affiche_footer();
        }
    }else if($_GET["action"]=="choixNombreNormal"){ //page choix du nombre de reponses possibles pour une question ouverte
        if($_SERVER["REQUEST_METHOD"]=="POST"){ //si on a envoyé un formulaire
            if(!isset($_POST["nombre"])||$_POST["nombre"]==0){ //on vérifie qu'il a rentré quelque chose sinon on réaffiche le formulaire avec message d'erreur
                affiche_entete_logged();
                $erreur["nombre"]="Ce Champs est requis";
                affiche_form_choixNombreNormal($erreur);
                affiche_footer();
            }else{ //si c'est bon on le redirige vers la page finQCM avec une variable $_SESSION["MDP"] indiquant la page d'ou il vient
                $_SESSION["MDP"]="NUMBERN";
                $_SESSION["nombre"]=$_POST["nombre"];
                header('Location: creation.php?action=FinNormal');
            }
        }else{ //si on arrive sur le formulaire pour la premiere fois 
            //on affiche le formulaire
            affiche_entete_logged();
            $erreur=array();
            affiche_form_choixNombreNormal($erreur);
            affiche_footer();
        }
    }else if($_GET["action"]=="FinNormal"){ //page pour la remplir la question et les réponses possibles pour une question ouverte
        if($_SERVER["REQUEST_METHOD"]=="POST"){ //si on a envoyé un formulaire
            $donne=$_POST;
            //on initialise le tableau $requis
            $requis["Question"]=true;
            $erreur=array();
            for($i=1; $i<=$_SESSION["nombre"]; $i++){
                $requis["Reponse".$i]=true;
            }
            erreur_format_form($donne, $erreur); //on rempli le tableau $erreur par les erreur format
            $okformat=($erreur==array());
            $erreur_requis=array();
            $okrequis=erreur_requis($donne,$erreur_requis); //omp rempli le tableau $erreur par les erreur requis
            if($okrequis&&$okformat){ //si tout est bon (format et requis) on prépare les infos pour les insérer dans la base de données
                $reponses=$donne["Reponse1"];
                for($i=2; $i<=$_SESSION["nombre"]; $i++){
                    $reponses=$reponses."|@$|".$donne["Reponse".$i];
                }
                $connect=connect();
                enregistrement_carte($connect,$_SESSION["paquet"],$donne["Question"],"",0,$reponses);
                unset($_SESSION["nombre"]);
                //préparation pour la prochaine page
                $_SESSION["MDP"]="FIN";
                header('Location: creation.php?action=Reussie');
            }else{ //si tout n'est pas bon on réaffiche le formulaire avec message d'erreur
                erreur_reponse_normal($erreur_requis,$erreur);
                affiche_entete_logged();
                affiche_form_FinNormal($donne,$erreur);
                affiche_footer();
            }
        }else{ //si on arrive sur le formulaire pour la première fois 
            if($_SESSION["MDP"]!="NUMBERN"){ //on vérifie d'où il vient sinon on le redirige
                unset($_SESSION["MDP"]);
                unset($_SESSION["paquet"]);
                header('Location: creation.php');
            }else{
                unset($_SESSION["MDP"]);
                //on affiche le formulaire
                affiche_entete_logged();
                $donne=array();
                $erreur=array();
                affiche_form_FinNormal($donne,$erreur);
                affiche_footer();
            }
        }
    }else if ($_GET["action"]=="Reussie"){  //page invisible détrusant les variables utilisées sur cette page et redirige vers la page du paquet
        if($_SESSION["MDP"]!="FIN"){ 
            unset($_SESSION["MDP"]);
            unset($_SESSION["paquet"]);
            header('Location: creation.php');
        }
        unset($_SESSION["MDP"]);
        $paquet=$_SESSION["paquet"];
        unset($_SESSION["paquet"]);
        header('Location: creer.php?paquet='.$paquet);
    }else{ //page du choix entre QCM et QUESTION OUVERTE
        if($_SERVER["REQUEST_METHOD"]=="POST"){ //si on a envoyé un formulaire
            //on redirige vers la bonne page
            header('Location: creation.php?action=choixNombre'.$_POST["type"]);
        }else{ //si on arrive pour la premiere fois on affiche le formualire
            affiche_entete_logged();
            affiche_form_choix1();
            affiche_footer();
        }
    }
?>