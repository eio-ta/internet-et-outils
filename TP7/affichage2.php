<?php
    define('ERR_CONNEXION', 0);
    define ('ERR_REQUETE', 1);
    define ('ERR_LOGIN', 1);
    
    function afficher_entete($titre) {
        ?> <html>
        <head>
        <title><?=$titre?></title>
        <meta charset="utf-8" >
        <link rel="stylesheet" type="text/css" href="style1.css">
        </head>
        <body>
        <?php
    }
    
    function afficher_pied_page() {
        echo"</body></html>";
    }

    function afficher_formulaire(&$donnees) {
        ?>
        <form action="felicitations.php" method="post">
        <table>
            <tr>
                <td>Prénom </td>
                <td><input type="text" name="prenom" size="16" value="<?php echo htmlspecialchars($donnees['prenom'])?>"></td>
            </tr>
            <tr>
                <td>Nom </td>
                <td><input type="text" name="nom" size="16" value="<?php echo htmlspecialchars($donnees['nom'])?>"></td>
            </tr>
            <tr>
                <td>Identifiant </td>
                <td><input type="text" name="login" size="16" value="<?php echo htmlspecialchars($donnees['login'])?>"></td>
            </tr>
            <tr>
                <td>MDP </td>
                <td><input type="password" name="password" size="16" value="<?php echo htmlspecialchars($donnees['password'])?>"></td>
            </tr>
            

                        <tr>
                            <td></td>
                            <td><input type="submit" value="Envoyer" name="go"></td>
                        </tr>
                        <tr>
                    </table>
                </form><br><br><?php
                
    }

    function afficher_page_bienvenue($donnees) {
        echo "<h1>Bienvenue ", $donnees['login'], "</h1>";
        echo "Vous avez bien grandi depuis la dernière connexion.<br> Votre inscription a été effectué.";
    }


    //LES VUES


    function page_erreur($err_code, $error) {
        afficher_entete("Erreur");
        switch ($err_code) {
            case ERR_CONNEXION: echo"<h2>Desolé, connexion impossible</h2>"; break;
            case ERR_REQUETE: echo"<h2>Erreur dans l'execution de la 73requete</h2>"; break;
        }
        echo"<p>".$error."</p>";
        afficher_pied_page();
    }

    function page_inscription(&$donnees) {
        afficher_entete("Inscription");
        echo'<h2> Incriscription : </h2>';
        afficher_formulaire($donnees);
        afficher_pied_page();
    }

    function page_bienvenue($donnees) {
        afficher_entete("Bienvenue");
        afficher_page_bienvenue($donnees);
        afficher_pied_page();
    }


?>