<?php
    // Ce fichier gère la page "Utilisateurs" accessible par les administrateurs, qui permet de visualiser tous les utilisateurs et changer leur rôle

    require_once('affiche.php');
    require_once("connexion.php");
    session_start();

    if($_SESSION["role"] != "a"){
        // si le rôle de l'utilisateur n'est pas administrateur, on le redirige
        header('Location: accueil.php');
    }

    if(isset($_GET["id"]) && isset($_GET["newrole"])){
        // ce if est exécuté si l'administrateur a cliqué sur un bouton pour changer le rôle d'un utilisateur
        $connect = connect();
        if(!user_existe($_GET["id"], $connect) || ($_GET["newrole"]!="a" && $_GET["newrole"]!="u" && $_GET["newrole"]!="j" && $_GET["newrole"]!="b")){
            // si l'utilisateur en question n'existe pas ou si le nouveau rôle n'est pas valide, on redirige vers users.php
            mysqli_close($connect);
            header('Location: users.php');
        }
        change_role($_GET["id"], $_GET["newrole"], $connect); // on change le rôle de l'utilisateur dans la base de données
        mysqli_close($connect);
        header('Location: users.php');
    } else {
        // on affiche la liste des utilisateurs ainsi que leurs rôles
        $connect = connect();
        $users = get_users($connect);
        mysqli_close($connect);

        affiche_entete_logged();
        echo "<fieldset>";
        echo "<h3>Gestion des utilisateurs</h3>";
        affiche_users($users);
        echo "</fieldset>";
        affiche_footer();
    }

?>