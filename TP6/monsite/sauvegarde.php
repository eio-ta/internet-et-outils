<?php

    if(isset($_POST["valider"])){
        if(empty($_POST[nom])){
            $message = "Le nom est vide. Vous êtes obligé de revenir au <a href=\"inscription.php\">formulaire</a>.<br>";
        } elseif(empty($_POST[prenom])){
            $message = " Le prénom est vide. Vous êtes obligé de revenir au <a href=\"inscription.php\">formulaire</a>.<br>";
        } elseif(empty($_POST[utilisateur])){
            $message = " Le nom d'utilisateur est vide. Vous êtes obligé de revenir au <a href=\"inscription.php\">formulaire</a>.<br>";
        } elseif(empty($_POST[email])){
            $message = "Le mot de passe est vide. Vous êtes obligé de revenir au <a href=\"inscription.php\">formulaire</a>.<br>";
        } elseif(empty($_POST[date])){
            $message = "La date est vide. Vous êtes obligé de revenir au <a href=\"inscription.php\">formulaire</a>.<br>";
        } else {
            if(!isset($_COOKIE['nom'])){
                setcookie('nom', $_POST[nom]);
            }
            if(!isset($_COOKIE['prénom'])){
                setcookie('prénom', $_POST[prenom]);
            }
            if(!isset($_COOKIE['utilisateur'])){
                setcookie('utilisateur', $_POST[utilisateur]);
            }
            if(!isset($_COOKIE['date'])){
                setcookie('date', $_POST[date]);
            }
            if(!isset($_COOKIE['email'])){
                setcookie('email', $_POST[email]);
            }
            $message = "Inscription réussie. <a href=\"index.php\">Revenez à l'accueil.</a>.<br>";
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