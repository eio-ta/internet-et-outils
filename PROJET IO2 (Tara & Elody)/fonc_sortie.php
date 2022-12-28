<?php 

function afficher_entete($titre) { //fonction qui affiche l'en-tête d'un fichier HTML
    ?>
	<!DOCTYPE html>
	<html>
	<head>
	<meta charset="utf-8">
	<title><?php echo $titre ?> </title>
	<link rel = "stylesheet" href = "style1.css">
	</head>
	<body>

    <?php 
}

function afficher_pied_page () { //fonction qui affiche le pied de page d'un fichier HTML et la partie "footer"
	echo "</section><br><br>
	<section>
                <p align=left><strong>Vous voulez améliorer votre culture générale ? Vous êtes au bon endroit ! Notre site vous permet de réfléchir sur les meilleurs jeux Questions/Réponses de tout âge. Vous allez adorer notre collection de jeux qui propose des questions classiques et des nouveautés que les joueurs, grands et petits, adoreront à coup sûr. Maintenant, c'est à votre tour de jouer !</strong></p>
            </section>

            <br><br>

            <footer>
                <div id=\"bas_de_la_page\">
                    <ul>
                        <li><h4><a id=\"link1\" href=\"Accueil.php\">Accueil</a></h4></li>
                        <li><h4><a id=\"link1\" href=\"bas_de_la_page.php?link=information\">Informations</a></h4></li>
                        <li><h4><a id=\"link1\" href=\"bas_de_la_page.php?link=contact\">Contact</a></h4></li>
                        <li><h4><a id=\"link1\" href=\"bas_de_la_page.php?link=remerciement\">Remerciement</a></h4></li>
                    </ul>
                </div>
            </footer>

        </body>
    </html>";
}

function page_erreur() { //fonction qui affiche une page d'erreur
    afficher_entete("Erreur");
    echo"<div class=\"br\"></div><div class=\"pas_espace\"></div><section><h1>Il y a eu une erreur dans la requête. Veuillez nous excuser...</h1>";
    afficher_pied_page();
}

// - - - - - - - - - - Fonctions utilisées pour la page d'Accueil - - - - - - - - - -
function afficher_contenu_entete_logout() { //fonction qui affiche l'en tête lorsque la personne n'est pas connectée
    echo "<header class=\"wid pad-right\">
    <div class=\"navbar wid pad-right\">
            <ul class=\"text-right wid pad-right\">
                <li class=\"d-inline\"><a class=\"text-style pad-right\" href=\"connexion.php\">Connecte-toi !</a></li>
                <li class=\"d-inline\"><a class=\"text-style pad-right\" href=\"inscription.php\">Inscris-toi !</a></li>
            </ul>
    </div>
    </header>
    <div class=\"br\"></div>
    <div class=\"br\"></div>
    <div class=\"br\"></div>
            
	<section>";
}

function afficher_contenu_accueil() { //fonction qui affiche le contenu de la page d'acceuil
    ?>
    
    <div class="titre">
        <p>Bienvenue !</p>
    </div>
    <p align=left><br><br>Selon Internet, <span style="color:#45207D;">personne ne quitte un site sans avoir compris à quoi celui-ci servait.</span> Le temps où vous changiez tout le temps de site est révolu : désormais, <span style="color:#45207D;">nous vous mettons au défi de rester plus de 30 minutes sur notre site</span>. Bien sûr ce site est unique, nous y avons passé beaucoup trop de temps pour le faire et malgré ça, il renferme des souvenirs qui nous sont précieux. Nous avons rencontré grâce à lui de merveilleuses personnes qui ont illuminées notre quotidien.<br>Alors j'espère que notre site vous plaira et qu'il vous amusera tout autant qu'il nous a amusées à le créer.<br><span style="color:#45207D;">Voilà, nous avons dit tout ce que nous avions à dire. Nous vous souhaitons donc une bonne continuation et un bon jeu !</span><br><br>Au plaisir de vous croiser sur d'autres plateformes !<br><br><br></p><p><em><strong>Pour ceux qui souhaiteraient <span style="color:#45207D;">nous contacter</span>, cliquez <a href="bas_de_la_page.php?link=contact">ici</a>.</strong></em><br></p>
    </section>

    <br><br>

    <section>
        <div class="pas_espace"></div>
        <div class="pas_espace"></div>

        <div>
            <a href= "jeux1.php?link=Géographie">
                <div class="catégorie1">
                    <img src="Style/géo2.png" alt="" class="img"/>
                </div>
            </a>
            <div class="catégorie2">
                <p>Géographie</p>
            </div>
            <div class="br"></div>
            <em>G É O G R A P H I E   |   Connaissez-vous tous les pays ? Toutes les villes ? Devenez incollable !</em>
        </div>

        <div class="pas_espace"></div>

        <div>
            <a href= "jeux1.php?link=Histoire">
                <div class="catégorie1">
                    <img src="Style/histoire2.png" alt="" class="img"/>
                </div>
            </a>
            <div class="catégorie2">
                <p>Histoire</p>
            </div>
            <div class="br"></div>
            <em> H I S T O I R E   |   Venez travailler et comprendre l'histoire du monde !</em>
        </div>

        <div class="pas_espace"></div>
        
        <div>
            <a href= "jeux1.php?link=Littérature">
                <div class="catégorie1">
                    <img src="Style/littérature2.png" alt="" class="img"/>
                </div>
            </a>
            <div class="catégorie2">
                <p>Littérature</p>
            </div>
            <div class="br"></div>
            <em>L I T T É R A T U R E   |   Venez découvrir Voltaire, Molière, Flaubert ou encore pleins d'autres auteurs !</em>
        </div>

        <div class="pas_espace"></div>
        
        <div>
            <a href= "jeux1.php?link=Sciences">
                <div class="catégorie1">
                    <img src="Style/sciences2.png" alt="" class="img"/>
                </div>
            </a>
            <div class="catégorie2">
                <p>Sciences</p>
            </div><div class="br"></div>
            <em> S C I E N C E S   |   Vous êtes plutôt biologie, physique ou chimie ? </em>
        </div>

        <div class="br"></div>

        <?php
}

function afficher_contenu_entete_log($login) { //fonction qui affiche l'en tête lorsque la personne est connectée
	echo "<header class=\"wid pad-right\">
    <div class=\"navbar wid pad-right\" id=\"haut\">
    <div>
            <ul class=\"text-right wid pad-right\">";
            $bool = verifier_si_admin($login);
            if($bool) {
                echo "<li class=\"d-inline\"><a class=\"text-style pad-right\" href=\"messages_reçus.php\">Messages reçus</a></li>";
            }
            echo "<li class=\"d-inline\"><a class=\"text-style pad-right\" href=\"recherche.php?link=utilisateurs\">Recherche d'utilisateur</a></li>
            <li class=\"d-inline\"><a class=\"text-style pad-right\" href=\"recherche.php?link=classement\">Classement</a></li>
            <li class=\"d-inline\"><a class=\"text-style pad-right\" href=\"creation.php?link=utilisateurs\">Création</a></li>
            <li class=\"d-inline\"><a class=\"text-style pad-right\" href=\"mes_donnees.php\">Mes données</a></li>
            <li class=\"d-inline\"><a class=\"text-style pad-right\" href=\"deconnexion.php\">Déconnexion</a></li>
            </ul>
    </div>
    </div>
    </header>
    <div class=\"br\"></div>
    <div class=\"br\"></div>
    <div class=\"br\"></div>
            
	<section>";

}

function afficher_accueil_logout() { //fonction qui affiche l'accueil d'une personne pas connectée
    afficher_entete("Accueil");
    afficher_contenu_entete_logout();
    afficher_contenu_accueil();
    afficher_pied_page();
}

function afficher_accueil_log($login) { //fonction qui affiche l'accueil d'une personne connectée
	afficher_entete("Accueil");
    afficher_contenu_entete_log($login);
    afficher_contenu_accueil();
    afficher_pied_page();
}

// - - - - - - - - - - Fonctions utilisées pour des pages du bas - - - - - - - - - -
function afficher_contenu_contact() { //fonction qui affiche la page des contacts

    ?>
    <img src="Style/contact.png" alt="" width=400 align=left><br>
    <div class="titre">
        <p>Pour nous contacter :</p>
    </div>
    <p align=left><br>Si vous rencontrez un problème, vous pouvez le signaler à ces adresses mails :<br><br><strong><u><em>Tara AGGOUN (Mathématique/Informatique, GROUPE 1)</em></u></strong><br><em>taraggoun@gmail.com</em><br><br><strong><u><em>Elody TANG (Mathématique/Informatique, GROUPE 1)</em></u></strong><br><em>elodytang@hotmail.fr</em><br><br><br><br></p>

    <?php
}

function afficher_contenu_information() { //fonction qui affiche la page d'information
    ?>
    <div class="titre">
        <p>Informations pour les utilisateurs</p>
    </div>
    <br><br><p align=left>Pour nous, la sécurité sur Internet est un problème très important. Vous devez pouvoir vous amusez dans un environnement sûr.<br><br><br><span style="font-size:18px;"><strong>QU'EST-CE QUE NOTRE SITE ?</strong></span><br>Notre site est un projet d'université. Il propose une vaste gamme de questions sur beaucoup de sujets différents. Principalement, vous pourrez améliorer vos connaissances en littérature, en mathématique, en géographie ou en histoire.<br> Les utilisateurs peuvent jouer de façon interactive avec des amis. Ils n'auront pas le temps de s'ennuyer !<br><br><br><strong>Cher utilisateur,</strong> pour votre sécurité, il est important que vous ne donniez jamais votre mot de passe à quiconque.<br><br><br><span style="font-size:18px;"><strong>QUI PEUT CRÉER UN COMPTE ?</strong></span><br>Tous ceux qui veulent jouer et répondre à nos questions. Tous ceux qui aimeront nos jeux de cartes. Et tous ceux qui veulent apprendre de nouvelles choses.<br><br><br><span style="font-size:18px;"><strong>EST-CE PAYANT POUR SE FAIRE UN COMPTE ?</strong></span><br> Non ! Nous offrons des jeux gratuits sur notre site. (Et il n'y a aucune publicité !)<br><br><br><span style="font-size:18px;"><strong>OÙ AVEZ-VOUS TROUVÉ L'INSPIRATION POUR VOS JEUX ?</strong></span><br> Les catégories principales et les différents jeux de cartes viennent de notre imagination. Quant aux questions des différents jeux, certaines peuvent venir de notre imagination, certaines peuvent être des questions que nos amis nous ont faites, et d'autres peuvent être prises de nos cahiers de cours. Vous pouvez aussi trouver des questions que nous avons eues pendant des contrôles de cours, pendant des quizz, ou encore pendant des jeux de société comme <em>Trivial Pursuit</em>.<br><br></p>

    <?php
}

function afficher_contenu_remerciement() { //fonction qui affiche la page de remerciement
    ?>
    <div class="titre">
        <p>Remerciement</p>
    </div>
    <br><br><p><em><strong>"Trois, s’aidant l’un l’autre, sont suffisants pour faire le travail de six."</strong> (Proverbe espagnol)</em><br><br><br></p><p align=left>Nous voudrions remercier, dans un premier temps, tous nos professeurs qui nous ont aidées à réaliser ce site. Tout particulièrement, <strong>notre professeur de TD</strong> qui a nous conseillées tout au long du confinement, et notre professeur de CM, <strong>Cristina SIRANGELO</strong> qui nous a apprises à manier les différents languages de programmation (HTML, CSS, PHP et MySQL) et qui a pris le temps de nous expliquer à quoi servait toutes les fonctionnalités de ces languages.<br><br></p><strong>Mille fois Merci.</strong><br>

    <?php
}

// - - - - - - - - - - Fonctions utilisées pour la page de connexion et de déconnection - - - - - - - - - -
function afficher_contenu_deconnection() { //fonction qui affiche une déconnection
	echo "<p><span style=\"color:#45207D; font-size:20px;\"><strong>VOUS VOUS ÊTES DÉCONNECTÉ.</em></span><br><br><br></p>";
}

function formulaire($login, $mdp) { //fonction qui affiche le formulaire de connexion
    echo "<p><span style=\"color:#45207D; font-size:20px;\"><strong>CONNEXION :</em></span><br><br><br></p>"; ?>
        <form action="connexion.php" method="post">
		<table>
			<tr>
				<td>Identifiant : </td>
				<td><input type="text" name="login" size="16" value ="<?php $login ?>"></td>
			</tr>
			<tr>
				<td>Mot de Passe : </td>
				<td><input type="password" name="mdp" size="16" value="<?php $mdp?>"></td>
			</tr>
			<tr>
                <td></td>
				<td id="ok"><input type="submit" value="Valider"></td>
			</tr>
		</table>
        </form>
        <?php
    echo "<br><p><strong>Si vous n'avez pas de compte, c'est par <a href=\"inscription.php\">ici</a>.</strong><br></p>";
}

function afficher_connexion($login, $mdp) { //fonction qui affiche la page de connexion (formulaire)
	afficher_entete("Page de connexion");
    afficher_contenu_entete_logout();
    if(isset($login)) echo "<p><strong>L'identifiant et le mot de passe sont incorrects.</strong></p><br><br>";
    formulaire($login, $mdp);
    afficher_pied_page();
}

function apres_connexion($login) { //fonction qui affiche la page de connexion si une personne s'est connectée
    afficher_entete("Félicitations !");
	afficher_contenu_entete_log($login);
    echo "<p><span style=\"color:#45207D; font-size:20px;\"><strong>Bienvenue ", $login, ".</em></span><br></p>";
    echo "<p>Revenir à la page <a href=\"Accueil.php\">d'accueil</a>.</p>";
	afficher_pied_page();
}

function afficher_deconnection($login) { //fonction qui affiche la page de déconnexion
	afficher_entete("Déconnection");
	afficher_contenu_entete_logout();
	afficher_contenu_deconnection();
	afficher_pied_page();
}

// - - - - - - - - - - Fonctions utilisées pour la page d'inscription,  du récapitulatif des données et de la page de modification des données perso - - - - - - - - - -
function afficher_contenu_inscription($donnees) { //fonction qui affiche le formulaire de déconnexion
    ?>
	<p><span style="color:#45207D; font-size:20px;"><strong>INSCRIPTION :</strong></span><br><br><br></p>
                    <form action="inscription.php" method="POST">
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
                            <td>Adresse email</td>
                            <td><input type="email" name="mail" size="16" value="<?php echo htmlspecialchars($donnees['mail'])?>"></td>
                        </tr>
                        <tr>
                            <td>Sexe </td>
                            <td>Masculin <input type="radio" name="gender" size="16" value="M">
                            Féminin <input type="radio" name="gender" size="16" value="F"></td>
                        </tr>
                        <tr>
                            <td>Mot De Passe </td>
                            <td><input type="password" name="mdp" size="16"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="submit" value="Valider"></td>
                        </tr>
                        <tr>
                    </table>
                </form><br><p><strong>Si vous avez déjà un compte, c'est par <a href="connexion.php">ici</a> !</strong><br></p>
            </table>
            </form><br><br><?php
}

function afficher_contenu_donnees($donnees) { //fonction qui affiche la page de récupitulatif des données après une inscription
    ?>
    <p><span style="color:#45207D; font-size:20px;"><strong>RÉCUPITULATIF DES DONNÉES PERSONNELLES</em></span><br><br><br></p>
    <table>
        <tr>
            <td id="donnees_1">Prénom </td>
            <td id="donnees_1"><strong><?php echo $donnees['prenom'] ?></strong></td>
        </tr>
        <tr>
            <td id="donnees_1">Nom </td>
            <td id="donnees_1"><strong><?php echo $donnees['nom'] ?></strong></td>
        </tr>
        <tr>
            <td id="donnees_1">Identifiant </td>
            <td id="donnees_1"><strong><?php echo $donnees['login'] ?></strong></td>
        </tr>
        <tr>
            <td id="donnees_1">Adresse Mail </td>
            <td id="donnees_1"><strong><?php echo $donnees['mail'] ?></strong></td>
        </tr>
        <tr>
            <td id="donnees_1">Sexe </td>
            <td id="donnees_1"><strong>
            <?php
        if ($donnees['gender'] == "M") echo "Masculin";
        if ($donnees['gender'] == "F") echo "Féminin";?>
        </strong></td>
        </tr>
        <tr>
            <td id="donnees_1">Mot de Passe</td>
            <td id="donnees_1"><strong>
            <?php
            $taille = strlen($donnees['mdp']);
            for($i = 0; $i<$taille; $i++) {
                echo "*";
            }
            ?>
            </strong></td>
        </tr>
        <tr>
            <form action="inscription.php" method="post">
            <input type="hidden" name="prenom" value="<?php echo htmlspecialchars($donnees['prenom'])?>">
            <input type="hidden" name="nom" value="<?php echo htmlspecialchars($donnees['nom'])?>">
            <input type="hidden" name="login" value="<?php echo htmlspecialchars($donnees['login'])?>">
            <input type="hidden" name="mail" value="<?php echo htmlspecialchars($donnees['mail'])?>">
            <input type="hidden" name="gender" value="<?php echo htmlspecialchars($donnees['gender'])?>">
            <input type="hidden" name="mdp" value="<?php echo htmlspecialchars($donnees['mdp'])?>">
            <td><a href="inscription.php"><input type="button" value="Annuler"></td>
            <td><input type="submit" name="go" value="Valider"></td>
            </form>
        </tr>
    </table><br>

    <?php
}

function afficher_inscription($donnees) { //fonction qui affiche la page d'inscription (formulaire)
    afficher_entete("Inscription");
    afficher_contenu_entete_logout();
    afficher_contenu_inscription($donnees);
    afficher_pied_page(); 
}

function afficher_recupitulatif($donnees) { //fonction qui affiche le récupitulatif des données et qui laisse le choix au joueur de valider son inscription ou pas
    afficher_entete("Récupitulatif des données");
    afficher_contenu_entete_logout();
    afficher_contenu_donnees($donnees);
    afficher_pied_page();
}

function afficher_tableau($donnees) { //fonction qui affiche le tableau de récupitulatif des données sur la page de compte du joueur, il peut choisir de modifier son compte ou de supprimer son compte
    ?>
    <p><span style="color:#45207D; font-size:20px;"><strong>RÉCUPITULATIF DES DONNÉES PERSONNELLES</em></span><br><br><br></p>
    <table>
        <tr>
            <td id="donnees_1">Prénom </td>
            <td id="donnees_1"><strong><?php echo $donnees['Prénom'] ?></strong></td>
        </tr>
        <tr>
            <td id="donnees_1">Nom </td>
            <td id="donnees_1"><strong><?php echo $donnees['Nom'] ?></strong></td>
        </tr>
        <tr>
            <td id="donnees_1">Identifiant </td>
            <td id="donnees_1"><strong><?php echo $donnees['Identifiant'] ?></strong></td>
        </tr>
        <tr>
            <td id="donnees_1">Adresse Mail </td>
            <td id="donnees_1"><strong><?php echo $donnees['Adresse_mail'] ?></strong></td>
        </tr>
        <tr>
            <td id="donnees_1">Sexe </td>
            <td id="donnees_1"><strong>
            <?php
        if ($donnees['Sexe'] == "M") echo "Masculin";
        if ($donnees['Sexe'] == "F") echo "Féminin";?>
        </strong></td>
        </tr>
        </table>
        <br><br><br>
        <table>
        <form action="modification.php" method="post">
            <input type="hidden" name="prenom" value="<?php echo htmlspecialchars($donnees['Prénom'])?>">
            <input type="hidden" name="nom" value="<?php echo htmlspecialchars($donnees['Nom'])?>">
            <input type="hidden" name="login" value="<?php echo htmlspecialchars($donnees['Identification'])?>">
            <input type="hidden" name="mail" value="<?php echo htmlspecialchars($donnees['Adresse_mail'])?>">
            <input type="hidden" name="gender" value="<?php echo htmlspecialchars($donnees['Sexe'])?>">
            <input type="hidden" name="mdp" value="<?php echo htmlspecialchars($donnees['Mot_de_Passe'])?>">
            <td id="donnees_1"><input type="submit" name="go" value="Supprimer"><td>
            <td id="donnees_1"><input type="submit" name="go" value="Modification"></td>
        </form>

        </table><br><br>

        <?php
        $bool = verifier_si_admin($donnees['Identifiant']);
        if($bool) {
            echo "<span class=\"textemulticolore\">", $donnees['Identifiant'], " est un administrateur.</span><div class=\"br\"></div>";
        } else {
            echo $donnees['Identifiant'], " est un utilisateur.<div class=\"br\"></div>";
        }
        ?>
        </section><br><br>

        <?php

}

function afficher_ligne($ligne) { //affiche les lignes du tableau de scores du joueur
    if($ligne['Matière'] != null) {
        echo "<tr>", "<td id=\"donnees_1\">".htmlspecialchars($ligne["Matière"])."</td>", "<td id=\"donnees_1\">".htmlspecialchars($ligne["Catégorie"])."</td>", "<td id=\"donnees_1\">".htmlspecialchars($ligne["Score"])."</td>","</tr>";
    }
}

function afficher_tableau2($resultats) { //affiche le tableau des scores du joueur (scores de la matière et de la catégorie faites)
    ?>
        <table>
        <tr>
        <td id="donnees_1">Matière</td>
        <td id="donnees_1">Catégorie</td>
        <td id="donnees_1">Score le plus récent</td>
        </tr>

        <?php
        
        while($ligne = mysqli_fetch_assoc($resultats)) {
            afficher_ligne($ligne);
        }
        echo"</table>";
        ?>

    <?php

}

function afficher_mes_donnees($donnees, $resultats, $login) { //fonction qui affiche la page des données de la personne (tableau de données personnelles et données de jeu)
    afficher_entete("Récupitulatif des données");
    afficher_contenu_entete_log($login);
    afficher_tableau($donnees);
    
    ?>
    <section><p><span style="color:#45207D; font-size:20px;"><strong>HISTORIQUE DE JEUX</em></span><br><br><br></p>
    <?php
    afficher_tableau2($resultats);
    afficher_pied_page();
}

function afficher_modification_des_donnees($ligne, $login) { //affiche le formulaire de modification de données personnelles
    ?>
    <form action="modification.php" method="POST">
        <table>
            <tr>
                <td>Prénom </td>
                <td><input type="text" name="Prénom" size="16" value="<?php echo htmlspecialchars($ligne['Prénom'])?>"></td>
            </tr>
            <tr>
                <td>Nom </td>
                <td><input type="text" name="Nom" size="16" value="<?php echo htmlspecialchars($ligne['Nom'])?>"></td>
            </tr>
            <tr>
                <td>Identifiant </td>
                <td><input type="text" name="Identifiant" size="16" value="<?php echo htmlspecialchars($ligne['Identifiant'])?>"></td>
            </tr>
            <tr>
                <td>Adresse mail</td>
                <td><input type="email" name="Adresse_mail" size="16" value="<?php echo htmlspecialchars($ligne['Adresse_mail'])?>"></td>
            </tr>
            <tr>
                <td>Sexe </td>
                <td>
                    
                <?php
                if($donnees['Sexe'] == "M") {
                    echo "Masculin <input type=\"radio\" name=\"Sexe\" size=\"16\" value=\"M\" checked>
                    Féminin <input type=\"radio\" name=\"Sexe\" size=\"16\" value=\"F\"></td>";
                } else {
                    echo "Masculin <input type=\"radio\" name=\"Sexe\" size=\"16\" value=\"M\">
                    Féminin <input type=\"radio\" name=\"Sexe\" size=\"16\" value=\"F\" checked></td>";
                }
                ?>
            </tr>
            <tr>
                <td>Nouveau mot De Passe </td>
                <td><input type="password" name="mdp" size="16"></td>
            </tr>
            <tr>
                <td>Mot De Passe actuel</td>
                <td><input type="password" name="mdp_vieux" size="16"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="ancienlogin" value="<?php echo $ligne['Identifiant'] ?>"></td>
                <td><input type="submit" name="go" value="Valider"></td>
            </tr>
            <tr>
            </table>
    </form>

    <?php
    afficher_pied_page(); 
}

function afficher_apres_modification($login) { //affiche la page après une modification de données ('vous avez modifié vos données, bravo !)
    afficher_entete("Félicitations !");
	afficher_contenu_entete_log($login);
    echo "<p><span style=\"color:#45207D; font-size:20px;\"><strong>Vos modifications ont été modifiées.</em></span><br></p>";
    echo "<p>Revenir à la page <a href=\"Accueil.php\">d'accueil</a>.</p>";
	afficher_pied_page();
}

function afficher_supprimer() { //affiche la page après une suppression de compte ('vous avez supprimé votre compte, bravo !)
    afficher_entete("Supprimer son compte !");
	afficher_contenu_entete_logout();
	echo "<p><span style=\"color:#45207D; font-size:20px;\"><strong>VOUS VOUS AVEZ SUPPRIMÉ VOTRE COMPTE.</em></span><br><br><br></p>";
	afficher_pied_page();
}

// - - - - - - - - - - Fonctions utilisées pour les pages de jeux - - - - - - - - - -
function affichage_de_la_page_erreur() { //affiche la page qui oblige les joueurs à se connecter pour jouer (jeux1)
    afficher_entete("Connection obligatoire !");
    afficher_contenu_entete_logout();
    ?>
    <p><span style="color:#45207D; font-size:20px;"><strong>CONNEXION OBLIGATOIRE !!!</strong></span><br><br><br><strong>Vous devez vous connecter pour accéder à nos jeux.</strong></p><br><p><strong>Veuillez vous connecter <a href="connexion.php">ici</a> !</strong><br></p>

    <?php
    afficher_pied_page(); 
}

function afficher_contenu_geo() { //Affiche les sous-catégories de la catégorie 'Géographie' (jeux1)
    ?>

    <div class="pas_espace"></div>
        <div>
            <a href= "jeux2.php?link=Europe"><div class="catégorie1"><img src="Style/géo2.png" alt="" class="img"/></div></a>
            <div class="catégorie1"></div>
            <div class="catégorie2">
                <p>Europe</p>
            </div>
            <em>E U R O P E   |   Des questions sur l'Europe ? C'est par ici !</em>
        </div>
        <div class="pas_espace"></div>
        <div>
        <a href= "jeux2.php?link=Asie"><div class="catégorie1"><img src="Style/géo2.png" alt="" class="img"/></div></a>
            <div class="catégorie1"></div>
            <div class="catégorie2">
                <p>Asie</p>
            </div>
            <em> A S I E   |   Des questions sur l'Asie ? C'est par ici !</em>
        </div>
        <div class="pas_espace"></div>
        <div>
            <a href= "jeux2.php?link=Amérique"><div class="catégorie1"><img src="Style/géo2.png" alt="" class="img"/></div></a>
            <div class="catégorie1"></div>
            <div class="catégorie2">
                <p>Amérique</p>
            </div>
            <em> A M É R I Q U E   |   Des questions sur l'Amérique ? C'est par ici !</em>
        </div>
        <div class="pas_espace"></div>
        <div>
            <a href= "jeux2.php?link=Terre"><div class="catégorie1"><img src="Style/géo2.png" alt="" class="img"/></div></a>
            <div class="catégorie1"></div>
            <div class="catégorie2">
                <p>Terre entière</p>
            </div>
            <em> T E R R E   |   Des questions sur la Terre en général ? C'est par ici ! </em>
        </div><br>

    <?php
}

function afficher_contenu_histoire() { //Affiche les sous-catégories de la catégorie 'Histoire' (jeux1)
    ?>

    <div class="pas_espace"></div>
        <div>
            <a href= "jeux2.php?link=Préhistoire/Antiquité"><div class="catégorie1"><img src="Style/histoire2.png" alt="" class="img"/></div></a>
            <div class="catégorie1"></div>
            <div class="catégorie2">
                <p>Préhistoire / Antiquité</p>
            </div>
            <em>P R É H I S T O I R E  /  A N T I Q U I T É   |   Des questions sur la Préhistoire / l'Antiquité ? C'est par ici !</em>
        </div>
        <div class="pas_espace"></div>
        <div>
        <a href= "jeux2.php?link=Moyen-âge/Les Temps Modernes"><div class="catégorie1"><img src="Style/histoire2.png" alt="" class="img"/></div></a>
            <div class="catégorie1"></div>
            <div class="catégorie2">
                <p>Moyen-Âge / Les Temps Modernes</p>
            </div>
            <em> M O Y E N - Â G E  / L E S  T E M P S  M O D E R N E S   |   Des questions sur le Moyen-Âge / Les Temps Modernes ? C'est par ici !</em>
        </div>
        <div class="pas_espace"></div>
        <div>
            <a href= "jeux2.php?link=L’époque Contemporaine"><div class="catégorie1"><img src="Style/histoire2.png" alt="" class="img"/></div></a>
            <div class="catégorie1"></div>
            <div class="catégorie2">
                <p>L'époque Contemporaine</p>
            </div>
            <em> L'ÉPOQUE CONTEMPORAINE   |   Des questions sur l'Époque Contemporaine ? C'est par ici !</em>
        </div><br>

    <?php

}

function afficher_contenu_littérature() { //Affiche les sous-catégories de la catégorie 'Littérature' (jeux1)
    ?>
    <div class="pas_espace"></div>
        <div>
            <a href= "jeux2.php?link=Expression"><div class="catégorie1"><img src="Style/littérature2.png" alt="" class="img"/></div></a>
            <div class="catégorie1"></div>
            <div class="catégorie2">
                <p>Expression</p>
            </div>
            <em>E X P R E S S I O N   |   Des questions sur l'Expression Française ? C'est par ici !</em>
        </div>
        <div class="pas_espace"></div>
        <div>
        <a href= "jeux2.php?link=Auteur"><div class="catégorie1"><img src="Style/littérature2.png" alt="" class="img"/></div></a>
            <div class="catégorie1"></div>
            <div class="catégorie2">
                <p>Auteur</p>
            </div>
            <em> A U T E U R   |   Des questions sur des auteurs ? C'est par ici !</em>
        </div><br>

    <?php

}

function afficher_contenu_sciences() { //Affiche les sous-catégories de la catégorie 'Sciences' (jeux1)
    ?>

    <div class="pas_espace"></div>
        <div>
            <a href= "jeux2.php?link=Mathématique"><div class="catégorie1"><img src="Style/sciences2.png" alt="" class="img"/></div></a>
            <div class="catégorie1"></div>
            <div class="catégorie2">
                <p>Mathématique</p>
            </div>
            <em>M A T H É M A T I Q U E   |   Des questions en Mathématique ? C'est par ici !</em>
        </div>
        <div class="pas_espace"></div>
        <div>
        <a href= "jeux2.php?link=Physique"><div class="catégorie1"><img src="Style/sciences2.png" alt="" class="img"/></div></a>
            <div class="catégorie1"></div>
            <div class="catégorie2">
                <p>Physique</p>
            </div>
            <em> P H Y S I Q U E   |   Des questions en Physique ? C'est par ici !</em>
        </div>
        <div class="pas_espace"></div>
        <div>
            <a href= "jeux2.php?link=Biologie"><div class="catégorie1"><img src="Style/sciences2.png" alt="" class="img"/></div></a>
            <div class="catégorie1"></div>
            <div class="catégorie2">
                <p>Biologie</p>
            </div>
            <em> B I O L O G I E   |   Des questions en Biologie ? C'est par ici !</em>
        </div>
        <div class="pas_espace"></div>
        <div>
            <a href= "jeux2.php?link=Anatomie"><div class="catégorie1"><img src="Style/sciences2.png" alt="" class="img"/></div></a>
            <div class="catégorie1"></div>
            <div class="catégorie2">
                <p>Anatomie</p>
            </div>
            <em> A N A T O M I E   |   Des questions sur l'Anatomie ? C'est par ici ! </em>
        </div>
        <div class="pas_espace"></div>
        <div>
            <a href= "jeux2.php?link=Géologie"><div class="catégorie1"><img src="Style/sciences2.png" alt="" class="img"/></div></a>
            <div class="catégorie1"></div>
            <div class="catégorie2">
                <p>Géologie</p>
            </div>
            <em> G É O L O G I E   |   Des questions en Géologie ? C'est par ici ! </em>
        </div><br>
    <?php

}

function afficher_contenu_accueil2($matiere, $login) { //Affiche les sous-catégories (jeux1)
    afficher_entete("Catégorie");
    afficher_contenu_entete_log($login);

    ?>
    <p align=left><strong>Vous avez cliqué sur la catégorie <?php echo $matiere, "."; ?></strong><br><br> En venant ici, vous avez choisi de tester vos connaissances dans cette matière. Maintenant, cliquez sur l'une des sous-catégories ci-dessous pour continuer. <span style="color:#45207D;"> Les administrateurs ont créer des questions de tout type ! J'espère que vous serez à la hauteur.</span> <strong>Une bonne réponse vaut cinq points et une mauvaise réponse vous enlèvera deux points.</strong> J'espère aussi que vous vous êtes préparé, haha !<br><span style="color:#45207D;">Allez, c'est à vous de jouer !</span><br><br>Bonne chance !<br></p>
    </section><br><br>

    <section>
    <div class="pas_espace"></div>
    <div class="pas_espace"></div>

    <?php

    $categories = lire_categorie_en_fonction_de_matiere($matiere);
    while($ligne = mysqli_fetch_assoc($categories)) {
    echo "<div>
        <a href= \"jeux2.php?link=", $ligne['Catégorie'],"\">
            <div class=\"catégorie1\">";
                if($matiere == 'Géographie') echo "<img src=\"Style/géo2.png\" alt=\"\" class=\"img\"/>";
                if($matiere == 'Histoire') echo "<img src=\"Style/histoire2.png\" alt=\"\" class=\"img\"/>";
                if($matiere == 'Littérature') echo "<img src=\"Style/littérature2.png\" alt=\"\" class=\"img\"/>";
                if($matiere == 'Sciences') echo "<img src=\"Style/sciences2.png\" alt=\"\" class=\"img\"/>";
            echo "</div>
        </a>
        <div class=\"catégorie2\">
            <p>", $ligne['Catégorie'], "</p>
        </div>
        <div class=\"br\"></div>
        <em><span class=\"textmaj\">", $ligne['Catégorie'],"</span>  | Des questions sur ce thème-là ? C'est par ici !</em>
    </div>
    <div class=\"pas_espace\"></div>";
    }
    echo "<div class=\"br\"></div>";
    afficher_pied_page();
}

function afficher_debut_des_questions($ligne, $login, $donnees, $reponse) { //affiche les questions de jeux (jeux3)
    afficher_entete("Questions");
    afficher_contenu_entete_log($login);
    $aleatoire = rand(1, 2);

    if($reponse == 'juste') {
        echo "<span class=\"textemulticolore textmaj\"> Bravo !</span><br><br>";
        echo "<p><strong>Vous avez gagné 5 points.</strong></p><br><br>";
        echo "<p><strong>Nombre de questions faites :  </strong>", $donnees['nb']-1, "</p><br>
        <p><strong>Nombre de points obtenus :  </strong>", $donnees['point'], "</p><br></section><br><br><section>";
    }
    
    if($reponse == "pas juste") {
        echo "<span class=\"textemulticolore textmaj\"> Oh non !</span><br><br>";
        echo "<p><strong>Vous avez perdu 2 points.</strong></p><br><br>";
        echo "<p><strong>Nombre de questions faites :  </strong>", $donnees['nb']-1, "</p><br>
        <p><strong>Nombre de points obtenus :  </strong>", $donnees['point'], "</p><br></section><br><br><section>";
    }

    ?>
    
    
    <p><strong>Niveau de difficulté : <?php echo $ligne['Niveau']?></strong><br><strong>Auteur : <?php echo $ligne['Créateur']?></strong><br><br></p>
    <form action='jeux3.php' method='post'>
    
    <p ><strong>Voici votre question :</strong><br><br><?php echo $ligne['Question']?><br><br>
   

    <?php
    $reponse1 = $ligne['Réponse_correcte'];
    $reponse2 = $ligne['Réponse_incorrecte'];
    if($aleatoire == 1) {
        echo "$reponse1 <input type=\"radio\" name='reponse' value='Correcte'><br>
         $reponse2 <input type=\"radio\" name='reponse' value='Incorrecte'>";
    } else {
        echo "$reponse2 <input type=\"radio\" name='reponse' value='Incorrecte'><br>
        $reponse1 <input type=\"radio\" name='reponse' value='Correcte'>";
    }
    ?>

    <br><br></p>
    <p ><input type='submit' name='go' value='Continuer'></p>
    </form><br><br>

    </section><br><br>
    <section><p>
        <form action="message.php" method="post"  target="_blank">
            <input type="hidden" name="question" value="<?php echo $ligne['Question']?>">
            <input type="hidden" name="auteur" value="<?php echo $ligne['Créateur']?>">
            <input type="submit" value="Signaler cette question à l'administrateur">
        </form>
        </p>
    
    <?php
    afficher_pied_page();

}

function afficher_contenu_question($matiere, $categorie, $login) { //affiche le bouton 'Commencer' pour commencer le jeu (jeux2)
    afficher_entete("Questions");
    afficher_contenu_entete_log($login);
    ?>
    <p align=left><strong>Vous avez cliqué sur la matière <?php echo $matiere ?> et sur la catégorie <?php echo $categorie, "."; ?></strong><br><br> Votre jeu va bientôt commencer. Cliquez sur "Continuer" pour voir les questions défiler. N'oubliez pas, votre score changera en fonction de vos réponses, il augmentera quand vous aurez des bonnes réponses et diminuera lorsque vous aurez des réponses incorrectes. <span style="color:#45207D;"> Vous pourrez aussi voir le nom du créateur de la question qui s'affichera et le niveau de difficulté de cette question. J'espère que vous serez à la hauteur.</span><br><br><strong>Bonne chance.</strong>
    </section><br><br>

    <section>
    <table>
        <form action='jeux3.php' method='post'>
        <tr>
        <td><input type='submit' name='go' value='Commencer'></td>
        </tr>
    </form>
    </table>
    <?php
    afficher_pied_page();
}

function afficher_fin_des_questions($tableau, $login, $reponse) { //affiche le tableau des résultats à la fin du jeu (jeux2)
    afficher_entete("Résultat !");
    afficher_contenu_entete_log($login);
    enregistrer_pts($tableau);
    session_destroy();
    session_start();
    $_SESSION['user'] = $tableau['user'];
    if($reponse == 'juste') {
        echo "<span class=\"textemulticolore textmaj\"> Bravo !</span><br><br>";
        echo "<p><strong>Vous avez gagné 5 points.</strong></p><br></section><br><br><section>";
    }
    
    if($reponse == "pas juste") {
        echo "<span class=\"textemulticolore textmaj\"> Oh non !</span><br><br>";
        echo "<p><strong>Vous avez perdu 2 points.</strong></p><br></section><br><br><section>";
    }
    ?>
    <p ><span style="color:#45207D; font-size:20px;"><strong>RÉSULTATS !!</strong></span><br><br> Vous avez déjà terminé nos questions ? Ah, c'est l'heure des résultats. Alors...<br><br></p>

    <table>
        <tr>
            <td id="donnees_1">Matière :</td>
            <td  id="donnees_1"><?php echo $tableau['matiere']?></td>
        </tr>
        <tr>
            <td  id="donnees_1">Catégorie :</td>
            <td  id="donnees_1"><?php echo $tableau['catégorie']?></td>
        </tr>
        <tr>
            <td id="donnees_1">Nombre de questions :</td>
            <td id="donnees_1"><?php echo ($tableau['nb']-1)?></td>
        </tr>
        <tr>
            <td id="donnees_1">Nombre de questions justes :</td>
            <td id="donnees_1"><?php echo $tableau['question_juste']?></td>
        </tr>
        <tr>
            <td id="donnees_1">Nombre de questions fausses</td>
            <td id="donnees_1"><?php echo $tableau['question_pas_juste']?></td>
        </tr>
        <tr>
            <td id="donnees_1">Points totaux :</td>
            <td id="donnees_1"><?php echo $tableau['point']?></td>
        </tr>
    </table>
    <br><br>
    <p >Revenir à la page <a href="Accueil.php">d'accueil</a>.</p>

    <?php
    
    afficher_pied_page(); 
}

// - - - - - - - - - - Fonctions pour la recherche d'utilisateur et du classement - - - - - - - - - -
function afficher_formulaire_recherche($login) { //affiche le formulaire de recherche d'utilisateur
    afficher_entete("Recherche");
    afficher_contenu_entete_log($login);
    ?>
    <div class="titre">
        <p>Vous recherchez un utilisateur ?</p>
    </div><br><br>
    <table>
        <form action="recherche.php?link=utilisateurs" method='post'>
        <tr>
            <td><strong>Identifiant de la personne recherchée :</strong></td>
        </tr>
        <tr>
            <td><input type="text" name ="login"><td>
        </tr>
        <tr>
            <td><input type="submit" name="go" value="Chercher"></td>
        </tr>
        </form>
    </table>

    <?php

    afficher_pied_page();
}

function afficher_res($donnees, $login) { //affiche les résultats de la recherche d'utilisateur
    afficher_entete("Recherche");
    afficher_contenu_entete_log($login);
    echo "<div class=\"titre\">
    <p>Résultat de la recherche :</p>
    </div>";
    $ligne = mysqli_fetch_assoc($donnees);

    if($ligne == null) {
        echo "<br><br><h3>Aucun résultat.</h3>";
    } else {
        echo "<br><strong>Il n'y a qu'un résultat : </strong>", $ligne['Identifiant'], "<br><br>";
        $bool = verifier_si_admin($ligne['Identifiant']);
        if($bool) {
            echo "<span class=\"textemulticolore\">", $ligne['Identifiant'], " est un administrateur.</span><div class=\"br\"></div>";
        } else {
            echo $ligne['Identifiant'], " est un utilisateur.<div class=\"br\"></div>";
        }
        echo "<div class=\"titre\">
        <p>Profil de l'identifiant :</p>
        </div><br><br>";
        $resultats = lire_information_resultats($ligne['Identifiant']);
        afficher_tableau2($resultats);
        echo "<br><br><br><br><br>";
        echo "<div class=\"titre\">
    <p>Questions créées par cet utilisateur :</p>
    </div><br><br>";
        $questions = recherche_questions($ligne['Identifiant']);
        echo "<table><tr><td id=\"donnees_1\"><strong>ID</strong></td><td id=\"donnees_1\"><strong>Matière</strong></td><td id=\"donnees_1\"><strong>Catégorie</strong></td><td id=\"donnees_1\"><strong>Niveau</strong></td><td id=\"donnees_1\"><strong>Question</strong></td></tr>";

        while($ligne2 = mysqli_fetch_assoc($questions)) {
            echo "<tr><td id=\"donnees_1\">", $ligne2['id'], "</td><td id=\"donnees_1\">", $ligne2['Matière'], "</td><td id=\"donnees_1\">", $ligne2['Catégorie'], "</td><td id=\"donnees_1\">", $ligne2['Niveau'], "</td><td id=\"donnees_1\">", $ligne2['Question'], "</td></tr>";
        }
        echo "</table>";

        $bool = verifier_si_admin($login);
        if($bool) {
            echo 
            "<br><br>Vous êtes administrateur. <br> Mais il serait injuste de modifier les données personnelles et les données du jeu. <br> <strong>Alors que voulez-vous faire ?</strong><br><br><br>";
            ?>
                <form action="modification.php" method="post">
                    <input type="hidden" name="login" value="<?php echo $ligne['Identifiant']?>">
                    <input type="submit" name="go" value="Supprimer ce compte"><br>
                </form><br><br>
                <form action="modification.php" method="post">
                    <input type="hidden" name="login" value="<?php echo $ligne['Identifiant']?>">
                    <input type="submit" name="go" value="Supprimer une question de cet utilisateur"><br>
                </form>
            <?php
        } else {
            echo "<br><br>Vous n'êtes pas administrateur. Vous ne pouvez rien faire de plus.";
        }

    }
    
    afficher_pied_page();
}

function afficher_questionnaire1($login) { //affiche le formulaire de recherche de classement (on renseigne la matière)
    afficher_entete("Classement");
    afficher_contenu_entete_log($login);
    ?>
    <div class="titre">
        <p>Vous voulez le classement de :</p>
    </div><br><br>
    <table>
        <form action="recherche.php?link=classement" method='post'>
        <tr>
            <td><strong>Matière :</strong></td>
        </tr>
        <tr>
            <td><select name="matière">
            <option value="Géographie">Géographie</option>
            <option value="Histoire">Histoire</option>
            <option value="Littérature">Littérature</option>
            <option value="Sciences">Sciences</option>
            </select><td>
        </tr>
        <tr>
            <td><input type="submit" name="go" value="Continuer"><td>
        </tr>
        </form>
    </table>

    <?php
    afficher_pied_page();
}

function afficher_questionnaire2($matiere, $login) { //affiche le formulaire de recherche de classement (on renseigne la catégorie)
    afficher_entete("Classement");
    afficher_contenu_entete_log($login);
    $categories = lire_categorie_en_fonction_de_matiere($matiere);
    ?>
    <div class="titre">
        <p>Vous voulez le classement de <?php echo $matiere ?> de la catégorie :</p>
    </div><br><br>

    <table>
        <form action="recherche.php?link=classement" method='post'>
        <tr>
            <td><strong>Catégorie :</strong></td>
        </tr>
        <tr>

        <?php
        echo "<td><select name=\"catégorie\">";
        while($ligne = mysqli_fetch_assoc($categories)) {
            echo "<option value=\"", $ligne['Catégorie'], "\">", $ligne['Catégorie'], "</option>";
        }
        echo "</select><td>";
        ?>

        </tr>
        <tr>
            <td><input type="hidden" name="matière" value="<?php echo $matiere?>"><td>
        </tr>
        <tr>
            <td><input type="hidden" name="go" value="<?php echo $matiere?>"><td>
        </tr>
        <tr>
            <td><input type="submit" name="rego" value="Continuer"><td>
        </tr>
        </form>
    </table>

    <?php
    afficher_pied_page();
}

function afficher_classement($donnees, $matiere, $catégorie, $login) { //on affiche les résutats de la recherche de classement (avec les scores des joueurs)
    afficher_entete("Classement");
    afficher_contenu_entete_log($login);
    ?>
    <div class="titre">
        <p>Vous voulez le classement de '<?php echo $matiere ?>' de la catégorie '<?php echo $catégorie ?>'</p>
    </div><br><br>
    <table>
        <tr><td id="donnees_1">Numéro</td><td id="donnees_1">Identifiant</td><td id="donnees_1">Score</td></tr>
        <?php
        $number = 0;
        while($ligne = mysqli_fetch_assoc($donnees)) {
            $nom = getUsers($ligne['users_id']);
            $nom = mysqli_fetch_assoc($nom);
            echo "<tr>", "<td id=\"donnees_1\">", $number+1, "</td><td id=\"donnees_1\">", $nom['Identifiant'] ,"</td><td id=\"donnees_1\">", $ligne['Score'], "</td></tr>";
            $number += 1;
        }
        ?>
    </table>

    <?php
    afficher_pied_page();
}

// - - - - - - - - - - Fonctions pour les modifications de questions - - - - - - - - - -
function afficher_page_creation($login) { //affiche la page du 'mode de création' (la page d'accueil qui gère la modification des questions)
    afficher_entete("Création");
    afficher_contenu_entete_log($login);

    ?>
    <div class="titre">
        <p>Mode de création</p>
    </div><br><br>
    <p align=left>Voici le mode "Création". Ici, vous avez la <span style="color:#45207D;"><strong>possibilité de créer des questions, de modifier celles que vous avez déjà crées et d'en supprimer</strong></span>. <br><br>Vous pouvez choisir la matière, la catégorie et le niveau de difficulté de la question que vous voulez créer. Elle sera automatiquement enregistrée et sera affichée dans les questionnaires. <br><br>J'espère que ce mode de personnalisation pourra vous amuser, haha !<br><span style="color:#45207D;"><strong>Amusez-vous bien !</strong></span><br><br></p>
    </section><br><br>

    <section>
    <div class="titre">
        <p>Créer une question</p>
    </div><br><br>
    <p>Veuillez choisir une matière dans laquelle vous voulez ajouter une question.</p><br><br>
    <form action="creation.php" method="post">
        <table>
            <tr>
                <td><select name="matiere">
                    <option value="Géographie">Géographie</option>
                    <option value="Histoire">Histoire</option>
                    <option value="Littérature">Littérature</option>
                    <option value="Sciences">Sciences</option>
                </select>
            </tr>

            <tr>
                <td><input type="submit" name="go" value="Créer"></td>
            </tr>
        </table>

    </section><br><br>

    <section>
    <div class="titre">
        <p>Modifier une question</p>
    </div><br><br>

    <p><strong>Vous voulez modifier quelle question ?</strong><br><br></p>


    <form action="creation.php" method="post">
        <table>
            <tr>
                <td><select name="id">
            
                <?php
                    $id_questions = recherche_questions($login);
                    while($ligne = mysqli_fetch_assoc($id_questions)) {
                        echo "<option value=\"", $ligne['Question'], "\">", $ligne['Question'], "</option>";
                    }
                ?>
                
                </select></td>
            </tr>

            <tr>
                <td><input type="submit" name="go" value="Modifier"></td>
            </tr>
        </table>
    </form>


    </section><br><br>

    <section>
    <div class="titre">
        <p>Supprimer une question</p>
    </div><br><br>
    <p><strong>Vous voulez supprimer quelle question ?</strong><br><br></p>

    <form action="creation.php" method="post">
        <table>
            <tr>
                <td><select name="id">"
                    <?php
                    $id_questions = recherche_questions($login);
                    while($ligne = mysqli_fetch_assoc($id_questions)) {
                        echo "<option value=\"", $ligne['Question'], "\">", $ligne['Question'], "</option>";
                    }
            
                echo "</select>";
                
                ?>

            </tr>

            <tr>
                <td><input type="submit" name="go" value="Supprimer cette question"></td>
            </tr>
        </table>

    </section><br><br>


    <section>
    <div class="titre">
        <p>Vos questions :</p>
    </div><br><br>
    <?php
        $donnees = recherche_questions($login);
        echo "<table><tr><td id=\"donnees_1\"><strong>ID</strong></td><td id=\"donnees_1\"><strong>Matière</strong></td><td id=\"donnees_1\"><strong>Catégorie</strong></td><td id=\"donnees_1\"><strong>Niveau</strong></td><td id=\"donnees_1\"><strong>Question</strong></td><td id=\"donnees_1\"><strong>Réponse correcte</strong></td><td id=\"donnees_1\"><strong>Réponse incorrecte</strong></td></tr>";

        while($ligne = mysqli_fetch_assoc($donnees)) {
            echo "<tr><td id=\"donnees_1\">", $ligne['id'], "</td><td id=\"donnees_1\">", $ligne['Matière'], "</td><td id=\"donnees_1\">", $ligne['Catégorie'], "</td><td id=\"donnees_1\">", $ligne['Niveau'], "</td><td id=\"donnees_1\">", $ligne['Question'], "</td><td id=\"donnees_1\">", $ligne['Réponse_correcte'], "</td><td id=\"donnees_1\">", $ligne['Réponse_incorrecte'], "</td></tr>";
        }
        echo "</table>";

    ?>

    <?php
    afficher_pied_page();
}

function formu_modifier($donnees) { //affiche le formulaire d'une modification de questions
    ?>
    <div class="titre">
        <p>Modifier une question</p>
    </div><br><br>

    <form action="creation.php" method="post">

        <table>
            <tr>
                <td>Nouvelle question :</td>
                <td><input type="text" name="question" size="16" value="<?php echo $donnees['Question'] ?>"></td>
            <tr>
            <tr>
                <td>Réponse correcte :</td>
                <td><input type="text" name="rep_c" size="16" value="<?php echo $donnees['Réponse_correcte'] ?>"></td>
            <tr>
            <tr>
                <td>Réponse incorrecte :</td>
                <td><input type="text" name="rep_inc" size="16" value="<?php echo $donnees['Réponse_incorrecte'] ?>"></td>
            <tr>
            <tr>
                <td>Niveau</td>
                <td><select name="niveau">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select></td>
            <tr>
            <tr>
                <td>Matière, Catégorie</td>

                <?php
                $categories = lire_categorie_en_fonction_de_matiere($donnees['Matière']);
                
                echo "<td><select name=\"catégorie\"><optgroup label=\"", $donnees['Matière'], "\">";
                while($ligne = mysqli_fetch_assoc($categories)) {
                    echo "<option value=\"", $ligne['Catégorie'], "\">", $ligne['Catégorie'], "</option>";
                }
                echo "</optgroup><option value=\"Autres\">Autres</option>";
    
                ?>
                </select></td>
            <tr>
            <tr>
            <td>Si Autre Catégorie</td>
            <td><input type="text" name="autres" size="16" value=" "></td>
            </select></td>
            <tr>
            <tr>
                <td><input type="hidden" name="ancien" value="<?php echo $donnees['Question'] ?>"></td>
                <td><input type="submit" name="go" value="Modifier cette question"></td>
            </tr>
        </form>
        </table>

    <?php
}

function formu_creer($matiere) { //affiche le formulaire d'une création de questions
    ?>
    <div class="titre">
    <p>Créer une question</p>
    </div><br><br>

    <form action="creation.php" method="post">

    <table>
        <tr>
            <td>Nouvelle question :</td>
            <td><input type="text" name="question" size="16"></td>
        <tr>
        <tr>
            <td>Réponse correcte :</td>
            <td><input type="text" name="rep_c" size="16"></td>
        <tr>
        <tr>
            <td>Réponse incorrecte :</td>
            <td><input type="text" name="rep_inc" size="16"></td>
        <tr>
        <tr>
            <td>Niveau</td>
            <td><select name="niveau">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select></td>
        <tr>
        <tr>
            <td>Catégorie</td>

            <?php
            $categories = lire_categorie_en_fonction_de_matiere($matiere);
            
            echo "<td><select name=\"catégorie\">";
            while($ligne = mysqli_fetch_assoc($categories)) {
                echo "<option value=\"", $ligne['Catégorie'], "\">", $ligne['Catégorie'], "</option>";
            }
            echo "<option value=\"Autres\">Autres </option>";

            ?>
            </select></td>
        <tr>
        <tr>
            <td>Si Autre Catégorie</td>
            <td><input type="text" name="autres" size="16" value=" "></td>
            </select></td>
        <tr>

        <tr>
            <td><input type="hidden" name="matiere" value="<?php echo $matiere ?>"></td>
            <td><input type="submit" name="go" value="Créer cette question"></td>
        </tr>
    </form>
    </table>

    <?php








}

// - - - - - - - - - - Fonctions pour les signalements des questions - - - - - - - - - -
function afficher_messages($login, $donnees) { //affiche les messages reçus (les messages de signalement) des joueurs (admin seulement)
    afficher_entete("Erreur");
    afficher_contenu_entete_log($login);

    echo "<table><tr><td id=\"donnees_1\"><strong>Émetteur</strong></td><td id=\"donnees_1\"><strong>Question concernée</strong></td><td id=\"donnees_1\"><strong>Contenu du message</strong></td><td id=\"donnees_1\"><strong>Auteur de la question</strong></td></tr>";

    while($ligne = mysqli_fetch_assoc($donnees)) {
        echo "<tr><td id=\"donnees_1\">", $ligne['Identifiant'], "</td><td id=\"donnees_1\">", $ligne['Questions'], "</td><td id=\"donnees_1\">", $ligne['Contenu'], "</td><td id=\"donnees_1\">", $ligne['Auteur'], "</td></tr>";
    }
    
    echo "</table>";

    
    afficher_pied_page();
}

?>
