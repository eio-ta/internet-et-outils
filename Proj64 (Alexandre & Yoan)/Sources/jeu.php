<?php
    // ce fichier gère la page "jeu" qui permet de jouer aux différents paquets uploadés par les utilisateurs

    require_once('affiche.php');
    require_once('connexion.php');
    session_start();

    if(empty($_SESSION["pseudo"]) || $_SESSION["role"] == "b"){
        // si l'utilisateur n'est pas connecté ou si son rôle est "banni", on le redirige vers la page d'accueil
        header('Location: accueil.php');
    }
    
    if($_GET["action"] == "signaler" && isset( $_SESSION["paquetS"]) && isset( $_SESSION["carteS"])){
        // ce if est exécuté quand l'utilisateur clique sur le lien pour signaler une carte
        $paquetS = $_SESSION["paquetS"]; // on récupère le paquet et le numéro de carte qui sont stockés dans la session
        $carteS = $_SESSION["carteS"];
        unset($_SESSION["paquetS"]);
        unset($_SESSION["carteS"]);
        $connect = connect();
        signaler($paquetS, $carteS, $_SESSION["id"], $connect); // on envoie un message aux administrateurs pour signaler la carte
        mysqli_close($connect);
        // on affiche la page de "signalement réussi"
        affiche_entete_logged();
        echo "<fieldset>";
        echo "<h2>Signalement réussi</h2><br>";
        echo "Attention, une utilisation abusive des signalements peut être punie par un bannissement";
        echo "<table><tr><td>",'<a href="jeu.php?paquet='.$paquetS.'">Continuer ce paquet</a>',"</td><td class=\"espace\">",'<a href="jeu.php">Quitter ce paquet</a>',"</td></tr></table>";
        echo "</fieldset>";
    } else if(isset($_GET["paquet"])){
        // ce if est exécuté quand l'utilisateur est en train de jouer à un paquet
        $connect = connect();
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            // si le formulaire de réponse a été envoyé, on affiche la page disant si la réponse était bonne

            if(!isset($_SESSION["repondu"])){// on vérifie que l'utilisateur est bien passé par le formulaire de réponse à la question
                mysqli_close($connect);
                header('Location: jeu.php?paquet='.$_GET["paquet"]);
            }
            unset($_SESSION["repondu"]);
            $repondu = repondu($_GET["paquet"], $_SESSION["id"], $_POST["reponse"], $connect);

            affiche_entete_logged();
            echo "<fieldset>";
            affiche_repondu($repondu["carte"], $repondu["reussi"]);
            $_SESSION["paquetS"] = $_GET["paquet"];
            $_SESSION["carteS"] = $repondu["carte"];
            echo "<table><tr><td>",'<a href="jeu.php?paquet='.$_GET["paquet"].'">Continuer</a>',"</td><td class=\"espace\">",'<a href="jeu.php">Arrêter</a>',"</td><td><a class=\"error\" href=\"jeu.php?action=signaler\">Signaler cette carte</a></td></tr></table>";
            echo "</fieldset>";
            affiche_footer();
        } else {
            // sinon on affiche le formulaire correspondant à la carte sur le dessus du paquet:

            $_SESSION["repondu"] = true;

            $pexiste = paquet_existe_id_2($_GET["paquet"], $connect);
            if(!$pexiste){ // si le paquet dans le $_GET n'existe pas parmi les paquets publics, on redirige
                mysqli_close($connect);
                header('Location: jeu.php');
            }
            
            $existe = ordre_existe($_GET["paquet"], $_SESSION["id"], $connect);
            if(!$existe){ // on vérifie si l'utilisateur a déjà joué à ce paquet, sinon on crée une nouvelle ligne dans la table "ordre" pour pouvoir enregistrer l'ordre dans lequel l'utilisateur va jouer les cartes (cet ordre dépendra ensuite de ses bonnes et mauvaises réponses)
                new_ordre($_GET["paquet"], $_SESSION["id"], $connect);
            }

            $modifs = different($_GET["paquet"], $_SESSION["id"], $connect); // on regarde si le paquet a été modifié depuis la dernière fois que l'utilisateur y a joué

            $carte = get_prochaine_carte($_GET["paquet"], $_SESSION["id"], $connect);
            if(!$carte){ // si l'utilisateur a fini toutes les cartes du paquet
                $reussies = get_reussies($_GET["paquet"], $_SESSION["id"], $connect); //on récupère le nombre de cartes réussies
                $n = count(get_cartes_public($_GET["paquet"], $connect)); //et le nombre de cartes en tout dans le paquet
                recommencer($_GET["paquet"], $_SESSION["id"], $connect); //puis on réinitialise le paquet en prenant compte des cartes réussies et ratées
            }
            mysqli_close($connect);

            affiche_entete_logged();
            echo "<fieldset>";
            if($carte){ // si le paquet n'est pas terminé
                if($modifs["different"]){ // si le paquet a été modifié depuis que l'utilisateur y a joué, on affiche les modifications
                    echo "<span class=\"error\">Le paquet a été modifié: ";
                    if($modifs["ajoutees"] > 0){
                        echo $modifs["ajoutees"], " carte";
                        if($modifs["ajoutees"] > 1)echo "s ont été ajoutées"; else echo " a été ajoutée";
                    }
                    if($modifs["supprimees"] > 0){
                        if($modifs["ajoutees"] > 0) echo " et ";
                        echo $modifs["supprimees"], " carte";
                        if($modifs["supprimees"] > 1)echo "s ont été supprimées"; else echo " a été supprimée";
                    }
                    echo "</span><br>";
                }
                $connect=connect();
                affiche_form_jeu($carte, $_GET["paquet"],$connect); // on affiche ensuite le formulaire correspondant à la carte
            } else { // si le paquet est terminé, on affiche le nombre de bonnes réponses
                echo "<h2>Paquet terminé</h2><br>";
                echo $reussies,"/",$n," cartes réussies<br>";
                echo "<table><tr><td>",'<a href="jeu.php?paquet='.$_GET["paquet"].'">Recommencer</a>',"</td><td class=\"espace\">",'<a href="jeu.php">Arrêter</a>',"</td></tr></table>";
            }
            echo "</fieldset>";
            affiche_footer();
        }
    } else {
        // si l'utilisateur n'est pas en train de jouer à un paquet, on affiche la liste des paquets
        $connect = connect();
        $paquets = get_paquets_non_vides($connect);
        mysqli_close($connect);

        affiche_entete_logged();
        echo "<fieldset>";
        echo "<h3>A quel paquet voulez-vous jouer?</h3>";
        affiche_paquets_jeu($paquets);
        echo "</fieldset>";
        affiche_footer();
    }
?>