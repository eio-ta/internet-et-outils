<?php

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

        if($_GET[action] == 1) {
            header('Location: inscription.php');
        }
        if($_GET[action] == 2) {
            header('Location: index.php?action=2');
        } else {
            header('Location: accueil.php');
        }
    }
?>


<!DOCTYPE html>
<html>
   <head>
      <meta charset="ISO-8859-1" />
      <link rel="stylesheet" href="style.css"/>
   </head>
   <body>
        <h3><?php echo $message ?></h3>
   </body>
</html> 