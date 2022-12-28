<?php
    // Ce fichier gère la création de paquets, la visualisation de la liste des paquets ainsi que des cartes et leur modification. La création de cartes est en revanche gérée par creation.php

    require_once('affiche.php');
    require_once("erreur.php");
    require_once("connexion.php");
    session_start();


    if(empty($_SESSION["pseudo"]) || $_SESSION["role"] == "b" || $_SESSION["role"] == "j"){
        // si l'utilisateur n'est pas connecté ou son rôle ne l'autorise pas à créer des paquets (simple joueur ou banni), il est redirigé vers la page d'accueil
        header('Location: accueil.php');
    }

    if(isset($_GET["paquet"]) && $_GET["action"]=="renommer"){ // si on a cliqué sur le lien pour renommer un paquet
        $connect = connect();
        if(!paquet_existe_id($_SESSION["id"],$_GET["paquet"],$connect)){
            // si le paquet indiqué dans le $_GET n'existe pas (ou bien n'appartient pas à l'utilisateur), on redirige vers creer.php
            mysqli_close($connect);
            header('Location: creer.php');
        }
        mysqli_close($connect);
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            //ce if est exécuté quand l'utilisateur a terminé le formulaire pour changer le nom du paquet
            $donne = $_POST;
            $requis["nompaquet"]=true;
            $erreur_requis=array();
            $okrequis=erreur_requis($donne,$erreur_requis);
            $connect=connect();
            $oknom=!erreur_nom_paquet($_SESSION["id"], $donne, $connect) || ($donne["nompaquet"] == get_nom_paquet($_GET["paquet"], $connect));
            $erreur = array();
            erreur_format_form($donne, $erreur);
            $okformat = $erreur==array();
            mysqli_close($connect);
            if($okrequis&&$oknom&&$okformat){
                // on modifie la base de donnée pour changer le nom du paquet si le formulaire est rempli correctement
                $connect=connect();
                renommer_paquet($_SESSION["id"], $_GET["paquet"], $donne["nompaquet"], $connect);
                mysqli_close($connect);
                header('Location: creer.php?paquet='.$_GET["paquet"]); // puis on redirige vers creer.php
            }else{
                //sinon, on affiche le formulaire avec les messages d'erreur
                affiche_entete_logged();
                erreur_paquet($erreur, $erreur_requis, $oknom);
                affiche_form_renommer_paquet($_GET["paquet"], $donne, $erreur);
                affiche_footer();
            }
        } else {
            // le formulaire n'a pas encore été envoyé, on affiche donc le formulaire pour renommer un paquet
            $donne = array();
            $erreur = array();
            $connect = connect();
            $donne["nompaquet"] = get_nom_paquet($_GET["paquet"], $connect);
            affiche_entete_logged();
            affiche_form_renommer_paquet($_GET["paquet"], $donne, $erreur);
            affiche_footer();
        }
    } else if(isset($_GET["paquet"]) && $_GET["action"]=="supprimer" && !isset($_GET["carte"])){
        // ce if est exécuté si l'utilisateur a confirmé la qu'il voulait supprimer un paquet

        $connect = connect();
        if(!paquet_existe_id($_SESSION["id"],$_GET["paquet"],$connect)){
            // si le paquet indiqué dans le $_GET n'existe pas (ou bien n'appartient pas à l'utilisateur), on redirige vers creer.php
            mysqli_close($connect);
            header('Location: creer.php');
        }
        supprimer_paquet($_GET["paquet"], $connect);
        mysqli_close($connect);
        header('Location: creer.php');
    } else if(isset($_GET["paquet"]) && $_GET["action"]=="suppr" && !isset($_GET["carte"])){
        // ce if est exécuté quand l'utilisateur clique sur le lien pour supprimer un paquet. Un avertissement est affiché
        affiche_entete_logged();
        echo "<fieldset>Voulez vous vraiment supprimer ce paquet ?<br>
              <a href=\"creer.php?paquet=",$_GET["paquet"],"\">NON</a> <a class=\"error\" href=\"creer.php?paquet=",$_GET["paquet"],"&action=supprimer\">OUI</a></fieldset>";
        affiche_footer();
    } else if($_GET["action"]=="modifier" && isset($_GET["paquet"]) && isset($_GET["carte"])){
        // ce if est exécuté quand l'utilisateur clique sur le lien pour modifier une carte
        
        $connect=connect();
        if(!paquet_existe_id($_SESSION["id"],$_GET["paquet"],$connect)){
            // si le paquet indiqué dans le $_GET n'existe pas (ou bien n'appartient pas à l'utilisateur), on redirige vers creer.php
            mysqli_close($connect);
            header('Location: creer.php');
        }

        $carte=get_contenu_carte($connect,$_GET["paquet"],$_GET["carte"]);
        if($carte==array()){
            // si la carte indiquée dans le $_GET n'existe pas, on redirige vers creer.php
            mysqli_close($connect);
            header('Location: creer.php');
        }
        mysqli_close($connect);

        if($_SERVER["REQUEST_METHOD"]=="POST"){
            // ce if est exécuté quand l'utilisateur a terminé le formulaire de modification de carte
            // on modifie donc la base de donnée avec les nouvelles données

            $donne=explode("|@$|",$carte[4]); // les bonnes réponses/choix sont stoquées dans une seule colonne de la table du paquet et elles sont séparées par les caractères "|@$|"
            $_SESSION["nombre"]=count($donne);
            $donne=$_POST;
            $requis["Question"]=true;
            if($carte[3]==1){ // si le type de la question est QCM
                $requis["Reponse"]=true;
                for($i=2; $i<=$_SESSION["nombre"]; $i++){
                    $requis["Reponse".$i]=true;
                }
            }else{ // sinon le c'est une question ouverte
                for($i=1; $i<=$_SESSION["nombre"]; $i++){
                    $requis["Reponse".$i]=true;
                }
            }
            $erreur = array();
            erreur_format_form($donne, $erreur);
            $okformat=($erreur==array());
            $erreur_requis=array();
            $okrequis=erreur_requis($donne,$erreur_requis);
            if($okrequis&&$okformat){ // si les données sont valides, on prépare les données que nous mettrons dans la colonne "choix" en créant la variable $reponses et on met à jour la base de données
                if($carte[3]==1){    
                    $reponses=$donne["Reponse"];
                }else{
                    $reponses=$donne["Reponse1"];
                }
                for($i=2; $i<=$_SESSION["nombre"]; $i++){
                    $reponses=$reponses."|@$|".$donne["Reponse".$i];
                }
                $connect=connect();
                modifier_carte($connect,$_GET["paquet"],$donne["Question"],$donne["Reponse"],$reponses,$_GET["carte"]);
                mysqli_close($connect);
                unset($_SESSION["nombre"]);
                header('Location: creer.php?paquet='.$_GET["paquet"].'&carte='.$_GET["carte"]); // une fois la carte modifiée dans la base de données, on redirige vers la page de la carte
            }else{
                // si les nouvelles données ne sont pas valide, on affiche le formulaire avec des messages d'erreurs

                erreur_reponse_qcm($erreur, $erreur_requis);
                $donne=explode("|@$|",$carte[4]);
                $donne["Question"]=$carte[1];
                affiche_entete_logged();
                if($carte[3]==1){
                    affiche_form_FinQCM_modif($donne,$erreur);
                }else{
                    affiche_form_FinNormal_modif($donne,$erreur);
                }
                affiche_footer();
                unset($_SESSION["nombre"]);
            }
        }else{
            // on affiche le formulaire de modification de carte
            $donne=explode("|@$|",$carte[4]);
            $_SESSION["nombre"]=count($donne);
            $donne["Question"]=$carte[1];
            $erreur=array();
            affiche_entete_logged();
            if($carte[3]==1){ // si le type de la carte est QCM, on affiche le formulaire de modification de QCM
                affiche_form_FinQCM_modif($donne,$erreur);
            }else{ // sinon on affiche le formulaire de modification de question ouverte
                affiche_form_FinNormal_modif($donne,$erreur);
            }
            affiche_footer();
            unset($_SESSION["nombre"]);
        } 
    }else if($_GET["action"]=="uploader" && isset($_GET["paquet"])){
        //ce if est exécuté quand l'utilisateur a cliqué sur le lien pour uploader un paquet
        $connect=connect();
        if(!paquet_existe_id($_SESSION["id"],$_GET["paquet"],$connect)){
            //si le paquet n'existe pas, on redirige vers creer.php
            mysqli_close($connect);
            header('Location: creer.php');
        }
        uploader($connect,$_GET["paquet"]);
        header('Location: creer.php?paquet='.$_GET["paquet"]);

    }else if($_GET["action"] == "supprimer" && isset($_GET["paquet"]) && isset($_GET["carte"])){
        // ce if est exécuté quand l'utilisateur a confirmé qu'il voulait supprimer une carte
        $connect = connect();
        supprimer_carte($_GET["paquet"], $_GET["carte"], $_SESSION["id"], $connect);
        mysqli_close($connect);
        header('Location: creer.php?paquet='.$_GET["paquet"]);
    }else if($_GET["action"] == "suppr" && isset($_GET["paquet"])&& isset($_GET["carte"])){
        // ce if est exécuté quand l'utilisateur a cliqué sur le lien pour supprimer une carte. un avertissement est affiché
        affiche_entete_logged();
        echo "<fieldset>Voulez vous vraiment supprimer cette carte ?<br>
              <a href=\"creer.php?paquet=",$_GET["paquet"],"&carte=",$_GET["carte"],"\">NON</a> <a class=\"error\" href=\"creer.php?paquet=",$_GET["paquet"],"&carte=",$_GET["carte"],"&action=supprimer\">OUI</a></fieldset>";
        affiche_footer();
    } else if($_GET["action"] == "creer"){
        // ce if est exécuté quand l'utilisateur crée un nouveau paquet
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            //ce if est exécuté quand l'utilisateur a terminé le formulaire pour créer un nouveau paquet
            $donne = $_POST;
            $requis["nompaquet"]=true;
            $erreur_requis=array();
            $okrequis=erreur_requis($donne,$erreur_requis);
            $connect=connect();
            $oknom=!erreur_nom_paquet($_SESSION["id"], $donne, $connect);
            $erreur = array();
            erreur_format_form($donne, $erreur);
            $okformat = $erreur==array();
            mysqli_close($connect);
            if($okrequis&&$oknom&&$okformat){
                // on modifie la base de donnée pour ajouter le nouveau paquet si le formulaire est rempli correctement
                $connect=connect();
                enregistrer_paquet($_SESSION["id"], $donne["nompaquet"], $connect);
                mysqli_close($connect);
                header('Location: creer.php'); // puis on redirige vers creer.php
            }else{
                //sinon, on affiche le formulaire avec les messages d'erreur
                affiche_entete_logged();
                erreur_paquet($erreur, $erreur_requis, $oknom);
                affiche_form_creer_paquet($donne,$erreur);
                affiche_footer();
            }
        } else {
            // le formulaire n'a pas encore été envoyé, on affiche donc le formulaire pour créer un nouveau paquet
            $donne = array();
            $erreur = array();
            affiche_entete_logged();
            affiche_form_creer_paquet($donne, $erreur);
            affiche_footer();
        }
    } else if(isset($_GET["paquet"])&&isset($_GET["carte"])){
        // ce if est exécuté quand l'utilisateur est sur la page d'une carte
        $connect=connect();
        if(!paquet_existe_id($_SESSION["id"],$_GET["paquet"],$connect)){
            // si la carte n'existe pas, on redirige l'utilisateur vers creer.php
            mysqli_close($connect);
            header('Location: creer.php');
        }else{
            // sinon on affiche le contenu de la carte
            $carte=get_contenu_carte($connect,$_GET["paquet"],$_GET["carte"]);
            if($carte==array()){
                header('Location: creer.php');
            }
            mysqli_close($connect);
            affiche_entete_logged();
            echo "<fieldset>";
            affiche_contenu_carte($carte);
            echo "<hr><a href=\"creer.php?paquet=",$_GET["paquet"],"\">Retour</a>";
            echo "<br><a href=\"creer.php?action=modifier&paquet=",$_GET["paquet"],"&carte=",$_GET["carte"],"\">Modifier</a>";
            echo "<br><a class=\"error\" href=\"creer.php?paquet=",$_GET["paquet"],"&carte=",$_GET["carte"],"&action=suppr\">Supprimer</a>";
            echo "</fieldset>";
            affiche_footer();
        }
    }else if(isset($_GET["paquet"])){
        // ce if est exécuté si l'utilisateur est sur la page d'un paquet, contenant la liste des cartes qu'il contient
        $connect=connect();
        if(!paquet_existe_id($_SESSION["id"],$_GET["paquet"],$connect)){
            // si le paquet n'existe pas ou ne lui appartient pas, on redirige
            mysqli_close($connect);
            header('Location: creer.php');
        }else{
            //sinon on affiche son contenu
            $_SESSION["paquet"]=$_GET["paquet"];
            $paquets=get_cartes_de($_GET["paquet"],$connect);
            $message = !is_uploaded($_GET["paquet"], $connect);
            $nom_paquet = get_nom_paquet($_GET["paquet"], $connect);
            mysqli_close($connect);

            affiche_entete_logged();
            echo "<fieldset>";
            echo "<h3>",htmlspecialchars($nom_paquet),"</h3>";

            affiche_cartes($paquets);
            echo "<a class=\"creer\" href=creation.php>Ajouter une carte</a><br><hr>","<a href=\"creer.php?action=uploader&paquet=",$_GET["paquet"],"\">Uploader</a>";
            if($message){
                echo "<span class=\"error\"> Vos modifications n'ont pas été uploadées</span>";
            }
            echo '<br><a href="creer.php?paquet=',$_GET["paquet"],'&action=renommer">Renommer le paquet</a>';
            echo "<br>","<a href=\"creer.php\">Retour</a>";
            echo '<br><a class="error" href="creer.php?paquet=',$_GET["paquet"],'&action=suppr">Supprimer</a>';
            echo "</fieldset>";
            affiche_footer();
        }
    } else {
        // on affiche la liste des paquets
        affiche_entete_logged();
        $connect=connect();
        $paquets = get_paquets_de($_SESSION["id"], $connect);
        mysqli_close($connect);
        echo "<fieldset>";
        echo "<h3>Gestion de vos paquets</h3>";
        affiche_paquets($paquets);
        echo "<a class=\"creer\" href=\"creer.php?action=creer\">Créer un nouveau paquet</a>";
        echo "</fieldset>";
        affiche_footer();
    }

?>