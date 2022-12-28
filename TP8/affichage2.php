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

    function afficher_formulaire(&$donnees, $villes) {
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
                <td>Lieu de résidence</td>
                <td><select name="city" size="1">
                    <?php while($ligne= mysqli_fetch_assoc($villes)) {
                        liste_deroulante($ligne);
                    } ?>
                </select></td>
            </tr>
            <tr>
                <td>MDP </td>
                <td><input type="password" name="password" size="16" value="<?php echo htmlspecialchars($donnees['password'])?>"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Envoyer" name="go"></td>
            </tr>
            
            </table>
            </form><br><br><?php
                
    }

    function afficher_page_bienvenue($donnees) {
        echo "<h1>Bienvenue ", $donnees['login'], "</h1><br><br>";
        echo "Retourner à <a href=\"Accueil.php\">l'accueil</a>.";
    }

    function afficher_ligne($ligne) {
        echo "<tr>", "<td> Login :</td>", "<td>".htmlspecialchars($ligne["nickname"])."</td>", "</tr>";
        echo "<tr>", "<td>Nom :</td>", "<td>".htmlspecialchars($ligne["lastname"])."</td>", "</tr>";
        echo "<tr>", "<td>Prénom :</td>", "<td>".htmlspecialchars($ligne["firstname"])."</td>", "</tr>";
        echo "<tr>", "<td>Lieu de résidence :</td>", "<td>".htmlspecialchars($ligne["city"])."</td>", "</tr>";
    }


    function afficher_table ($users) {
        ?>
        <table>

        <?php
        
        while($ligne = mysqli_fetch_assoc($users)) {
            afficher_ligne($ligne);
        }
        echo"</table>";
    }

    function liste_deroulante($departements) {
        echo "<option>".htmlspecialchars($departements["name"]);
    }

    function page_accueil_normal() {
        echo "<section> Lien 1 : <a href=\"recherche.php\"> Recherche d'utilisateur</a>.<br><br> Lien 2 : <a href=\"recherche_par_villes.php\"> Recherche d'utilisateurs par ville</a>.<br><br> </section>";
    }

    function page_accueil_admin() {
        echo "<h1> Bienvenue chère admin.</h1>";
        echo "<section> Lien 1 : <a href=\"recherche.php\"> Recherche d'utilisateur</a>.<br><br> Lien 2 : <a href=\"recherche_par_villes.php\"> Recherche d'utilisateurs par ville</a>.<br><br>
        </section>";

    }
    //LES VUES

    function page_accueil($admin) {
        afficher_entete("Accueil");
        if ($admin == false) {
            page_accueil_normal();
        }
        if ($admin == true) {
            page_accueil_admin();
        }
        afficher_pied_page();
    }


    function page_erreur($err_code, $error) {
        afficher_entete("Erreur");
        switch ($err_code) {
            case ERR_CONNEXION: echo"<h2>Desolé, connexion impossible</h2>"; break;
            case ERR_REQUETE: echo"<h2>Erreur dans l'execution de la requete</h2>"; break;
        }
        echo"<p>".$error."</p>";
        afficher_pied_page();
    }

    function page_inscription($donnees, $villes) {
        afficher_entete("Inscription");
        echo'<h2> Inscription : </h2><br><br>';
        afficher_formulaire($donnees, $villes);
        echo "<br><br>Pour vous connecter : <a href=\"page_connexion.php\">ici</a>.";
        afficher_pied_page();
    }

    function page_modi($donnees, $villes) {
        afficher_entete("Modification");
        echo'<h2> Modification : </h2><br><br>';
        afficher_formulaire($donnees, $villes);
        afficher_pied_page();
    }

    function page_bienvenue($donnees) {
        afficher_entete("Bienvenue");
        afficher_page_bienvenue($donnees);
        afficher_pied_page();
    }

    function page_recherche() {
        afficher_entete ("Chercher");
        echo"<h2> Choisissez un utilisateur :</h2>"; ?>
        <form action ="recherche.php" method ="post">
            Renseigner l'identifiant de l'utilisateur : <input type="text" name ="login">
            <input type="submit" value="Chercher">
        </form>
        <?php
        afficher_pied_page();
    }

    function page_recherche_par_ville() {
        afficher_entete ("Chercher");
        echo"<h2> Choisissez des utilisateurs par ville :</h2>"; ?>
        <form action ="recherche_par_villes.php" method ="post">
            Renseigner la ville de l'utilisateur : <input type="text" name ="ville">
            <input type="submit" value="Chercher">
        </form>
        <?php
        afficher_pied_page();
    }

    function page_users($donnees) {
        afficher_entete("USERS");
        echo"<h2>Résultat de la recherche :</h2>";
        afficher_table($donnees);
        echo "<form action=\"modification_des_donnees.php\" method=\"post\"><input type=\"submit\" name=\"go\" value=\"Modification\"></form><br><br>";
        echo "<br><br>Retourner à <a href=\"Accueil.php\">l'accueil</a>.";
        afficher_pied_page();
    }

    function page_login($login, $mdp) {
        afficher_entete ("Login");
        if(isset($login)) {
            echo'<h2 class = "error"> Login et mdp non reconnus! 38</h2>';
            $login = htmlspecialchars($login);
            $mdp = htmlspecialchars($mdp);
        }
        else echo"<h2> Login </h2>"; ?>
        <form action ="Accueil.php" method ="post">
            Login : <input type="text" name ="login" value ="<?php $login ?>"><br>
            Mot de passe : <input type="password" name ="password" value="<?php $mdp?>"><br>
            <input type="submit" value="OK">
        </form>
        <?php
        echo "<br><br>Pour vous inscrire : <a href=\"nouveau.php\">ici</a>.";
        afficher_pied_page();
    }

?>