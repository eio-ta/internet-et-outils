<?php
    if(!isset($_COOKIE[nom]) || !isset($_COOKIE[prénom]) || !isset($_COOKIE[date]) || !isset($_COOKIE[utilisateur]) || !isset($_COOKIE[email])){
        $erreur = "mauvais utilisateur";
    } elseif($_COOKIE[nom] != $_COOKIE[nom]){
        $erreur = "mauvais utilisateur";
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
                if(isset($_COOKIE[nom])){
                    echo "Bonjour ", $_COOKIE[nom], " ", $_COOKIE[prénom], ".", "<br>";
                }
                if(isset($_COOKIE[date])){
                    echo "Vous êtes née le ", $_COOKIE[date], ".",  "<br>";
                }
                if(isset($_COOKIE[email])){
                    echo "Voici votre email : " , $_COOKIE[email], ".", "<br>";
                }
                if(isset($_COOKIE[nom])){
                    echo "Vous êtes inscrit avec ce nom d'utilisateur : ", $_COOKIE[utilisateur], ".", "<br>";
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