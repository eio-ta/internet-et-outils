<?php

session_start();
if(isset($_POST["valider"])){
    if(empty($_POST[nom])){
        $message = "Le nom est vide. Vous êtes obligé de revenir au <a href=\"inscription.php\">formulaire</a>.<br>";
    } elseif(empty($_POST[prenom])){
        $message = " Le prénom est vide. Vous êtes obligé de revenir au <a href=\"inscription.php\">formulaire</a>.<br>";
    } elseif(empty($_POST[utilisateur])){
        $message = " Le nom d'utilisateur est vide. Vous êtes obligé de revenir au <a href=\"inscription.php\">formulaire</a>.<br>";
    } elseif(empty($_POST[email])){
        $message = "L'email est vide. Vous êtes obligé de revenir au <a href=\"inscription.php\">formulaire</a>.<br>";
    } elseif(empty($_POST[date])){
        $message = "La date est vide. Vous êtes obligé de revenir au <a href=\"inscription.php\">formulaire</a>.<br>";
    } else {
        if(!isset($_SESSION['nom'])){
            $_SESSION['nom'] = $_POST[nom];
        }
        if(!isset($_SESSION['prénom'])){
            $_SESSION['prénom'] = $_POST[prenom];
        }
        if(!isset($_SESSION['utilisateur'])){
            $_SESSION['utilisateur'] = $_POST[utilisateur];
        }
        if(!isset($_SESSION['date'])){
            $_SESSION['date'] = $_POST[date];
        }
        if(!isset($_SESSION['email'])){
            $_SESSION['email'] = $_POST[email];
        }
        if(!isset($_GET['action'])){
            $_GET['action'] = $_POST[action];
        }
        $message = "Inscription réussie. <a href=\"index.php\">Revenez à l'accueil.</a>.<br>";
    }
}


    if(!isset($_SESSION[nom])){
        $erreur = "mauvais utilisateur";
        session_destroy();
    } elseif($_SESSION[nom] != $_SESSION[nom]){
        $erreur = "mauvais utilisateur";
        session_destroy();
    } else {
        $erreur = "bon utilisateur";
    }
?>

<!DOCTYPE html>
<html>
   <head>
      <meta charset="ISO-8859-1" />
      <link rel="stylesheet" href="style.css"/>
   </head>
   <body>
        <h3>Bienvenue.</h3>
        <p>
        <?php
            if($erreur == "bon utilisateur"){
                if(isset($_SESSION[nom])){
                    echo "Bonjour ", $_SESSION[nom], " ", $_SESSION[prénom], ".", "<br>";
                }
                if(isset($_SESSION[date])){
                    echo "Vous êtes née le ", $_SESSION[date], ".",  "<br>";
                }
                if(isset($_SESSION[email])){
                    echo "Voici votre email : " , $_SESSION[email], ".", "<br>";
                }
                if(isset($_SESSION[nom])){
                    echo "Vous êtes inscrit avec ce nom d'utilisateur : ", $_SESSION[utilisateur], ".", "<br>";
                }

                echo "<a href=\"inscription.php\">Modifier mes données</a>.<br>";
                
            } else {
                echo "Vous n'êtes pas connecté.", "<br>";
                echo "<a href=\"inscription.php\">Veuillez vous faire un compte ou vous connecter.</a>.<br>";
            }
        ?>
        </p>
   </body>
</html> 