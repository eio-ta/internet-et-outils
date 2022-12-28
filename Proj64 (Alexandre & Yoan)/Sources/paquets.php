<?php
    //fichier gérant la page pour gérer les paquets des autres utilisateurs par les administrateurs

    //récupération des fonctions des autres fichiers
    require_once("affiche.php");
    require_once("connexion.php");
    session_start();

    //si on n'est pas connecté ou que nous ne sommes pas administrateurs, on nous redirige à l'accueil
    if(empty($_SESSION["pseudo"]) || $_SESSION["role"] != "a"){
        header('Location: accueil.php');
    }

    if(isset($_GET["paquet"])){ //page affichant les cartes du paquet dont l'identifiant est dans $_GET["paquet"] ou affichant le contenu d'une carte dont l'id est dans $_GET["carte"]
        $_SESSION["paquet"] = $_GET["paquet"];
        $connect=connect();
        if(!paquet_existe_id_2($_GET["paquet"],$connect)){ //si l'id du paquet n'xiste pas on nous redirige vers la page avec la liste des paquets
            mysqli_close($connect);
            header('Location: paquets.php');
        }
        mysqli_close($connect);
        if($_GET["carte"]){ //page affichant le contenue d'une carte dont l'id est dans $_GET["carte"]
            $connect=connect();
            //on verifie que la carte existe 
            $carte=get_contenu_carte_public($connect,$_GET["paquet"],$_GET["carte"]);
            if($carte==array()){ //si elle n'existe pas on redirige
                header('Location: paquets.php');
            }
            if($_GET["action"] == "suppr"){ //si l'administrateur a demandé la suppression de la carte, on envoie une demande de confirmation
                affiche_entete_logged();
                echo "<fieldset>Voulez vous vraiment supprimer cette carte ?<br>
                      <a href=\"paquets.php?paquet=",$_GET["paquet"],"&carte=",$_GET["carte"],"\">NON</a> <a class=\"error\" href=\"paquets.php?paquet=",$_GET["paquet"],"&carte=",$_GET["carte"],"&action=supprimer\">OUI</a></fieldset>";
                affiche_footer();
            } else if($_GET["action"] == "supprimer"){ //si il a confirmé on supprime la carte et envoie un message à l'utilisateur dont la carte à été supprimé
                $connect = connect();
                supprimer_carte_admin($_GET["paquet"], $_GET["carte"], $connect);
                mysqli_close($connect);
                header('Location: paquets.php?paquet='.$_GET["paquet"]);
            }else {//si on a choisi aucune action alors on affiche le contenue de la carte
                mysqli_close($connect);
                affiche_entete_logged();
                echo "<fieldset>";
                affiche_contenu_carte($carte);
                echo "<hr><a href=\"paquets.php?paquet=",$_GET["paquet"],"\">Retour</a>";
                echo "<br><a class=\"error\" href=\"paquets.php?paquet=",$_GET["paquet"],"&carte=",$_GET["carte"],"&action=suppr\">Supprimer</a>";
                echo "</fieldset>";
                affiche_footer();
            }
        } else { //page affichant le contenue du paquet dont l'id est dans $_GET["paquet"]
            if($_GET["action"] == "supprPaquet"){ //si on a choisi supprimé on envoie une demande de confirmation
                affiche_entete_logged();
                echo "<fieldset>Voulez vous vraiment supprimer ce paquet?<br>
                      <a href=\"paquets.php?paquet=",$_GET["paquet"],"\">NON</a> <a class=\"error\" href=\"paquets.php?paquet=",$_GET["paquet"],"&action=supprimerPaquet\">OUI</a></fieldset>";
                affiche_footer();
            } else if($_GET["action"] == "supprimerPaquet"){ //si il a accepté la confrmation on supprime le paquet et on envoie un message à l'utilisateur dont la paquet à été supprimé
                $connect = connect();
                supprimer_paquet_admin($_GET["paquet"], $connect);
                mysqli_close($connect);
                header('Location: paquets.php');
            } else { //si aucune action a été choisi alors on affiche la liste des cartes 
                $connect = connect();
                $cartes = get_cartes_public($_GET["paquet"], $connect);
                $nom_paquet = get_nom_paquet($_GET["paquet"], $connect);
                mysqli_close($connect);
                affiche_entete_logged();
                echo "<fieldset>";
                echo "<h3>",htmlspecialchars($nom_paquet),"</h3>";
                affiche_cartes_admin($cartes);
                echo "<hr><a href=\"paquets.php\">Retour</a>";
                echo "<br><a class=\"error\" href=\"paquets.php?paquet=",$_GET["paquet"],"&action=supprPaquet\">Supprimer</a>";
                echo "</fieldset>";
                affiche_footer();
            }
        }
    } else { //page affichant la liste des paquets non vides des utilisateurs 
        $connect = connect();
        $paquets = get_paquets_non_vides($connect);
        mysqli_close($connect);
        affiche_entete_logged();
        echo "<fieldset>";
        echo "<h3>Gestion des paquets des utilisateurs</h3>";
        affiche_paquets_admin($paquets);
        echo "</fieldset>";
        affiche_footer();
    }
?>