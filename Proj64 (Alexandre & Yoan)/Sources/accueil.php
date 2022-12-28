<?php
    /* Ce fichier gère la page d'accueil,
    et l'affiche différemment selon si l'utilisateur est connecté ou non ainsi que selon son rôle, qui peut être parmi:
    -administrateur
    -utilisateur/rédacteur
    -joueur simple
    -banni */

    require_once("affiche.php");
    require_once("connexion.php");
    session_start();


    if(isset($_SESSION["pseudo"])){
        // Ce if est exécuté si un utilisateur est connecté, la page adéquate est donc affichée

        if(isset($_GET["action"])){
            // Si le $_GET["action"] est défini dans l'url, cela veut dire que l'utilisateur a cliqué sur le bouton "lu" d'un des messages d'avertissement

            $connect = connect();
            message_lu($_GET["action"], $_SESSION["pseudo"], $connect); // on supprime le message avec cette fonction (disponible dans connexion.php)
            mysqli_close($connect);
            header('Location: accueil.php'); // puis on redirige vers accueil.php pour afficher la page avec le message retiré
        } else {
            // $_GET["action"] n'est pas défini, on affiche donc la page d'accueil de l'utilisateur connecté
            affiche_entete_logged();
            echo "<fieldset>";
            echo "<h1>Page d'accueil</h1>";
            echo "Bienvenue à vous ",htmlspecialchars($_SESSION["pseudo"]);
            echo "<br>";
            if($_SESSION["role"] == "b"){ // pour chaque rôle, un texte différent est affiché
                echo "Vous avez été banni par un administrateur, vous ne pouvez donc ni jouer ni créer de paquets.";
            } else if($_SESSION["role"] == "j"){
                echo "Vous avez été réduit au rang de Simple Joueur, vous ne pouvez donc plus créer de paquets.";
            } else if ($_SESSION["role"] == "a"){
                echo 'Vous êtes un <span class="multicolor">administrateur</span>, vous pouvez donc supprimer le contenu créé par les utilisateurs ainsi que changer le rôle de ceux-ci.';
            } else {
                echo "Vous pouvez créer des paquets et jouer à ceux des autres utilisateurs.";
            }
            echo "</fieldset>";
            
            // on affiche ensuite tous les messages que l'utilisateur a pu recevoir
            $messages = get($_SESSION["pseudo"], "message");
            if($messages != null){
                affiche_messages($messages);
            }
        }
    }else{
        // Dans ce cas, l'utilisateur n'est pas connecté
        //On affiche une description du site, on peut aussi s'inscrire ou se connecter grâce aux lien dans la barre de navigation affichée par affiche_entete()

        affiche_entete();
        echo "<fieldset><h1>Bienvenue sur notre site de flashcards</h1>";
        echo "Sur ce site, vous pourrez jouer à des paquets de flashcards (ou cartes mémoires) ainsi qu'en créer et les partager aux autres utilisateurs.";
        echo "</fieldset>";

    }

    // affiche_footer() ferme les balises <body> et <html> ouvertes par affiche_entete() ou affiche_entete_logged()
    affiche_footer();
?>