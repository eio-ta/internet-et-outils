<?php

    if(isset($_GET["valider"])){
        if(empty($_GET[nom])){
            $message = "Le nom est vide. Vous êtes obligé de revenir au <a href=\"formulaire.php\">formulaire</a>.<br>";
        } elseif(empty($_GET[prénom])){
            $message = " Le prénom est vide. Vous êtes obligé de revenir au <a href=\"formulaire.php\">formulaire</a>.<br>";
        } elseif(empty($_GET[mdp])){
            $message = "Le mot de passe est vide. Vous êtes obligé de revenir au <a href=\"formulaire.php\">formulaire</a>.<br>";
        } elseif($_GET[mdp]!=$_GET[mdp2]) {
            $message = "Les mots de passe ne sont pas identiques. Vous êtes obligé de revenir au <a href=\"formulaire.php\">formulaire</a>.<br>";
        } else {
            $message = "Tout a bien été rempli.<br>";
        }
    }
?>



<!DOCTYPE html>
    <html lang="fr">
        <head>
            <meta charset="utf-8">
            <title>Affichage</title>
            <link rel="stylesheet" href=<?php echo $_GET[style] ?>/>
        </head>
        <body>
        <?php

            echo $message, "<br>";

            echo "Bienvenue ", $_GET[prénom]," ", $_GET[nom]," ! ", femmeouhomme(),"<br>";
            echo "Ton mot de passe est... oh attention, mieux vaut ne pas le montrer à tout le monde.", "<br>";
            echo "Ton numéro d'étudiant est ", $_GET[number], ".", "<br>";
            echo "Tu suis les cours suivants : ", courssuivis(), ".";
            

            function femmeouhomme(){
                if($_GET[gender] == "f"){
                    echo "Tu es une femme.";
                }
                if($_GET[gender] == "g"){
                    echo "Tu es un homme.";
                }
            }

            function courssuivis(){
                foreach($_GET['cours'] as $valeur) { 
                    echo " ", $valeur."<br>";
                }
            }



        ?>
            
        </body>
    </html> 




