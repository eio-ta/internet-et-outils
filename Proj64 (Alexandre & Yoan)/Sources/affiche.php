<?php //Bibliothèque de fonctions gérant l'affichage


    function affiche_entete(){//fonction qui affiche l'entête lorsque l'on est pas connecté
        ?> 
        <!DOCTYPE HTML>
        <html lang="fr">
            <head>
                <title>Projet</title>
                <meta charset="utf-8">
                <link rel="stylesheet" href="style.css">
            </head>
            <body>
            <nav><a class="navA" href="accueil.php">Accueil</a><a class="nav" href="inscription.php">S'inscrire</a><a class="nav" href="login.php">Se Connecter</a></nav>
    <?php }
    function affiche_entete_logged(){ //affiche l'entête lorque l'on est connecté, varie selon notre role (admin, utilisateur, simple joueur, banni)
        ?>
        <!DOCTYPE HTML>
        <html lang="fr">
            <head>
                <title>Projet</title>
                <meta charset="utf-8">
                <link rel="stylesheet" href="style.css">
            </head>
            <body>
            <nav><a class="navA" href="accueil.php">Accueil</a><?php
                if($_SESSION["role"] != "b") {
                    echo '<a class="nav" href="jeu.php">Jeu</a>';
                }
                if($_SESSION["role"] != "b" && $_SESSION["role"] != "j") {
                    echo '<a class="nav" href="creer.php">Créer</a>';
                }
            ?><?php if($_SESSION["role"] == "a") echo '<a class="nav" href="paquets.php"><span class="multicolor">Paquets</span></a><a class="nav" href="users.php"><span class="multicolor">Utilisateurs</span></a>';?><a class="nav" href="profil.php">Page De Profil</a><a class="nav" href="deconnexion.php">Se Déconnecter</a></nav>
    <?php }
    function affiche_footer(){ //fonction qui ferme les balises body et html
        ?> 
        </body>
        </html>
    <?php }
    function affiche_form_inscrip ($donne,$erreur){ //fonction qui d'abord traite les données mis en argument (protège des injections html) et affiche le formulaire d'incription 
        traiter($donne);?>
        <fieldset>
            <form action="inscription.php" method="post">  
                <table>
                    <tr><td>Prénom</td><td colspan="2"><input type="text" name="prenom" placeholder="Prénom" value="<?php echo $donne["prenom"] ?>"><br><span class="error"><?php echo $erreur["prenom"] ?></span></td></tr>
                    <tr><td>Nom</td><td colspan="2"><input type="text" name="nom" placeholder="Nom" value="<?php echo $donne["nom"] ?>"><br><span class="error"><?php echo $erreur["nom"] ?></span></td></tr>
                    <tr><td>Adresse email</td><td colspan="2"><input type="email" name="adresse" placeholder="Adresse Email" value="<?php echo $donne["adresse"] ?>"><br><span class="error"><?php echo $erreur["adresse"] ?></span></td></tr>
                    <tr><td>Pseudo</td><td colspan="2"><input type="text" name="pseudo" placeholder="Pseudo" value="<?php echo $donne["pseudo"] ?>"><br><span class="error"><?php echo $erreur["pseudo"] ?></span></td></tr>
                    <tr><td>Mot De Passe</td><td colspan="2"><input type="password" name="password" placeholder="Mot De Passe" ><br><span class="error"><?php echo $erreur["password"] ?></span></td></tr>
                    <tr><td>Confirmer Mot De Passe</td><td colspan="2"><input type="password" name="repassword" placeholder="Confirmer Mot De Passe"><br><span class="error"><?php echo $erreur["repassword"] ?></span></td></tr>
                    <tr><td><input type="button" onclick='window.location.href="accueil.php"' value="retour"></td><td><input type="submit" value="accepter"></td><td><input type="reset" value="annuler"></td></tr>
                </table>
            </form>
        </fieldset>
    <?php }
    function affiche_form_login($donne,$erreur){ //fonction qui d'abord traite les données mis en argument (protège des injections html) et affiche le formulaire pour se connecter
        traiter($donne);?>
        <fieldset>
            <form action="login.php" method="post">
                <table>
                    <tr><td class="droite">Pseudo</td><td colspan="2"><input type="text" name="pseudo" placeholder="Pseudo" value="<?php echo $donne["pseudo"] ?>"><br><span class="error"><?php echo $erreur["pseudo"] ?></span></td></tr>
                    <tr><td class="droite">Mot De Passe</td><td colspan="2"><input type="password" name="password" placeholder="Mot De Passe" ><br><span class="error"><?php echo $erreur["password"] ?></span></td></tr>
                    <tr><td><input type="button" onclick='window.location.href="accueil.php"' value="retour"></td><td><input type="submit" value="accepter"></td><td><input type="reset" value="annuler"></td></tr>
                </table>
            </form>
        </fieldset>
   <?php }
    function page_succes (){ //fonction qui affiche une page disant que l'enregistrement de données est réussie 
        echo "<fieldset><h1>Enregistrement Réussi</h1>";
        echo "Allez vous connecter</fieldset>";
    }
    function page_succes_modif (){ //fonction qui affiche une page disant que les modifications sont réussies
        echo "<fieldset><h1>Modification Réussie</h1>";
        echo "</fieldset>";
    }
    function affiche_choix (){ //fonction qui affiche le choix entre modifier son mdp, changer autres infos et supprimer son compte (sur la page de profil)
        ?> 
        <fieldset>
            <a href="profil.php?action=mdp">Changer Mot De Passe</a><br>
            <a href="profil.php?action=pseudo">Changer Autres Informations</a><br>
            <a class="error" href="profil.php?action=suppr">Supprimer Votre Compte</a>
        </fieldset>
    <?php }
    function affiche_form_modif ($donne,$erreur){ // fonction qui d'abord traite les données mis en argument (protège des injections html) et affiche le formulaire pour modifier ses infos
        traiter($donne);?>
        <fieldset>
            <form action="profil.php?action=pseudo" method="post">
                <table>
                    <tr><td>Prénom</td><td colspan="2"><input type="text" name="prenom" placeholder="Prénom" value="<?php echo $donne["prenom"] ?>"><br><span class="error"><?php echo $erreur["prenom"] ?></span></td></tr>
                    <tr><td>Nom</td><td colspan="2"><input type="text" name="nom" placeholder="Nom" value="<?php echo $donne["nom"] ?>"><br><span class="error"><?php echo $erreur["nom"] ?></span></td></tr>
                    <tr><td>Adresse email</td><td colspan="2"><input type="email" name="adresse" placeholder="Adresse Email" value="<?php echo $donne["adresse"] ?>"><br><span class="error"><?php echo $erreur["adresse"] ?></span></td></tr>
                    <tr><td>Pseudo</td><td colspan="2"><input type="text" name="pseudo" placeholder="Pseudo" value="<?php echo $donne["pseudo"] ?>"><br><span class="error"><?php echo $erreur["pseudo"] ?></span></td></tr>
                    <tr><td><input type="button" onclick='window.location.href="profil.php"' value="retour"></td><td><input type="submit" value="accepter"></td><td><input type="reset" value="reset"></td></tr>
                </table>
            </form>
        </fieldset>
    <?php }
    function affiche_form_modif_mdp ($erreur){ //fonction qui affiche un formulaire pour modifier son mdp
        ?>
        <fieldset>
            <form action="profil.php?action=mdp" method="post">
                  <table>
                    <tr><td>Ancien Mot De Passe</td><td colspan="2"><input type="password" name="oldpassword" placeholder="Ancien Mot De Passe" ><br><span class="error"><?php echo $erreur["oldpassword"] ?></span></td></tr>
                    <tr><td>Nouveau Mot De Passe</td><td colspan="2"><input type="password" name="password" placeholder="Nouveau Mot De Passe"><br><span class="error"><?php echo $erreur["password"] ?></span></td></tr>
                    <tr><td>Confirmer Mot De Passe</td><td colspan="2"><input type="password" name="repassword" placeholder="Confirmer Mot De Passe"><br><span class="error"><?php echo $erreur["repassword"] ?></span></td></tr>
                    <tr><td><input type="button" onclick='window.location.href="profil.php"' value="retour"></td><td><input type="submit" value="accepter"></td><td><input type="reset" value="effacer"></td></tr>
                </table> 
            </form>
        </fieldset>
    <?php }
    function affiche_form_creer_paquet ($donne, $erreur){ //fonction qui d'abord traite les données mis en argument (protège des injections html) et affiche un formulaire pour créer un paquet
        traiter($donne);?>
        <fieldset>
            <form action="creer.php?action=creer" method="post">
                <table>
                    <tr><td>Nom du paquet</td><td colspan="2"><input type="text" name="nompaquet" placeholder="Nom du paquet" ><br><span class="error"><?php echo $erreur["nompaquet"] ?></span></td></tr>
                    <tr><td><input type="button" onclick='window.location.href="creer.php"' value="retour"></td><td><input type="submit" value="accepter"></td><td><input type="reset" value="effacer"></td></tr>
                </table>   
            </form>
        </fieldset>
    <?php }
    function affiche_form_renommer_paquet ($paquet, $donne, $erreur){ //fonction qui d'abord traite les données mis en argument (protège des injections html) et affiche un formulaire pour renommer un paquet
        traiter($donne);?>
        <fieldset>
            <form action="creer.php?paquet=<?php echo $paquet?>&action=renommer" method="post">
                <table>
                    <tr><td>Nom du paquet</td><td colspan="2"><input type="text" name="nompaquet" placeholder="Nom du paquet" value="<?php echo $donne["nompaquet"]?>"><br><span class="error"><?php echo $erreur["nompaquet"] ?></span></td></tr>
                    <tr><td><input type="button" onclick='window.location.href="creer.php?paquet=<?php echo $paquet?>"' value="retour"></td><td><input type="submit" value="accepter"></td><td><input type="reset" value="reset"></td></tr>
                </table>
            </form>
        </fieldset>
    <?php }
    function affiche_paquets ($paquets){ //fonction qui permet d'afficher la liste des paquets (p[0]=le créateur du paquet, p[1]=le nom du paquet, p[2]=l'id du paquet) pour la page créer
        echo "<table>";
        foreach($paquets as $p){
            echo "<tr><td><a href=\"creer.php?paquet=",$p[2],"\">",htmlspecialchars($p[1]),"</a></td><td> de ", htmlspecialchars(get_pseudo($p[0])),"</td></tr>";
        }
        echo "</table>";
    }
    function affiche_paquets_admin ($paquets){ //fonction qui affiche la liste de tous les paquets (p[0]=le créateur du paquet, p[1]=le nom du paquet, p[2]=l'id du paquet) pour la page Paquets de l'administrateur
        echo "<table>";
        foreach($paquets as $p){
            echo "<tr><td><a href=\"paquets.php?paquet=",$p[2],"\">",htmlspecialchars($p[1]),"</a></td><td> de ", htmlspecialchars(get_pseudo($p[0])),"</td></tr>";
        }
        echo "</table>";
    }
    function affiche_paquets_jeu ($paquets){ //fonction qui affiche la liste de tous les paquets (p[0]=le créateur du paquet, p[1]=le nom du paquet, p[2]=l'id du paquet) pour la page jeu
        echo "<table>";
        foreach($paquets as $p){
            echo "<tr><td><a href=\"jeu.php?paquet=",$p[2],"\">",htmlspecialchars($p[1]),"</a></td><td> de ", htmlspecialchars(get_pseudo($p[0])),"</td></tr>";
        }
        echo "</table>";
    }
    function affiche_cartes ($paquets){ //fonction qui affiche la liste des cartes contenu dans un paquets pour la page créer
        echo "<table>";
        $i=1;
        foreach($paquets as $cartes){
            echo "<tr><td><a href=\"creer.php?paquet=".$_SESSION["paquet"]."&carte=".$i."\">carte n°",$i,"</a></td></tr>";
            $i++;
        }
        echo "</table>";
    }
    function affiche_cartes_admin ($paquet){ //fonction qui affiche la liste des cartes contenu dans un paquets pour la page Paquets de l'administrateur
        echo "<table>";
        $i=1;
        foreach($paquet as $cartes){
            echo "<tr><td><a href=\"paquets.php?paquet=".$_SESSION["paquet"]."&carte=".$i."\">carte n°",$i,"</a></td></tr>";
            $i++;
        }
        echo "</table>";
    }
    function affiche_contenu_carte ($carte){ //fonction qui affiche le contenu d'une carte (carte[1]=quesiton,carte[4]=les choix, carte[3]=type 1 pour QCM et 0 pour question ouvertes)
        echo "<table>";
        echo "<tr><td>Question:</td><td>",htmlspecialchars($carte[1]),"</td></tr>";
        $reponses=explode("|@$|",$carte[4]);
        if($carte[3]==0){
            $i=1;
            foreach($reponses as $ind => $val){
                echo "<tr><td>Réponse ",$i,": </td><td class=\"droite\">",htmlspecialchars($val),"</td></tr>";
                $i++;
            }
        }else{
            echo "<tr><td>Réponse (Vrai): </td><td>",htmlspecialchars($reponses[0]),"</td></tr>";
            for($i=1; $i<count($reponses); $i++){
                echo "<tr><td>Réponse ",$i+1,": </td><td>",htmlspecialchars($reponses[$i]),"</td></tr>";
            }
        }   
        echo "</table>";
    }
    function affiche_form_choix1 (){  //fonction qui affiche le premier formulaire lors de la création de cartes (choix entre QCM et Question ouvertes)
        $paquet=$_SESSION["paquet"]?>
        <fieldset>
            <form action="creation.php" method="post">
                <table>
                    <tr><td colspan="2">Quel type de carte choisissez-vous ?</td></tr>
                    <tr><td>QCM<input type="radio" name="type" value="QCM" checked></td><td>Question Ouverte<input type="radio" name="type" value="Normal"></td></tr>
                    <tr><td><input type="button" onclick='window.location.href="creer.php?paquet=<?php echo $paquet?>"' value="retour"><td><input type="submit" value="accepter"></td></tr>
                </table>
            </form>
        </fieldset>
    <?php }
    function affiche_form_choixNombreQCM ($erreur){ //fonction qui affiche le formuaire lors de la création de cartes qui demande le nombre de choix pour le qcm
        ?>
        <fieldset>
            <form action="creation.php?action=choixNombreQCM" method="post"> 
                <table>
                    <tr><td colspan="2">Combien de Choix Possibles ?</td></tr>
                    <tr><td colspan="2"><input type="number" size="10" style="width: 200px; height: 20px;" min="2" max="6" placeholder="un nombre entre 2 et 6" name="nombre"></td></tr>
                    <tr><td colspan="2"><span class="error"><?php echo $erreur["nombre"] ?></span></td></tr>
                    <tr><td><input type="button" onclick='window.location.href="creation.php"' value="retour"></td><td><input type="submit" value="accepter"></td></tr>
                </table>
            </form>
        </fieldset>
   <?php }
   function affiche_form_choixNombreNormal ($erreur){ //fonction qui affiche le formuaire lors de la création de cartes qui demande le nombre de réponses possibles pour la question ouvertes
       ?>
       <fieldset>
            <form action="creation.php?action=choixNombreNormal" method="post">
                <table>
                    <tr><td colspan="2">Combien de Réponses Possibles ?</td></tr>
                    <tr><td colspan="2"><input type="number" style="width: 200px; height: 20px;" min="1" max="10" placeholder="un nombre entre 1 et 10" name="nombre"></td></tr>
                    <tr><td colspan="2"><span class="error"><?php echo $erreur["nombre"] ?></span></td></tr>
                    <tr><td><input type="button" onclick='window.location.href="creation.php"' value="retour"></td><td><input type="submit" value="accepter"></td></tr>
                </table>
            </form>
        </fieldset>
    <?php }
    function affiche_form_FinQCM($donne,$erreur){ // fonction qui affiche le dernier formulaire lors de la création de cartes demandant la question et les réponses, pour le qcm
        traiter($donne);?>
        <fieldset>
            <form action="creation.php?action=FinQCM" method="post"> 
                <table>
                    <tr><td>Question</td><td><input type="text" name="Question" value="<?php echo $donne["Question"] ?>"><span class="error"><?php echo $erreur["Question"] ?></span></td></tr>
                    <tr><td>Réponse (Vraie)</td><td><input type="text" name="Reponse" value="<?php echo $donne["Reponse"] ?>"><span class="error"><?php echo $erreur["Reponse"] ?></span></td></tr>
                    <?php 
                        for($i=2; $i<=$_SESSION["nombre"]; $i++){
                            echo "<tr><td>Réponse ",$i,"</td><td><input type=\"text\" name=\"Reponse",$i,"\" value=\"",$donne["Reponse".$i],"\"><span class=\"error\">",$erreur["Reponse".$i],"</span></td></tr>";
                        }
                    ?>
                    <tr><td><input type="button" onclick='window.location.href="creation.php?action=choixNombreQCM"' value="retour"></td><td><input type="submit" value="accepter"></td></tr>
                </table>
            </form>
        </fieldset>
   <?php }
   function affiche_form_FinQCM_modif($donne,$erreur){ // fonction qui affiche le formulaire pour modifier une carte de type qcm
       traiter($donne);?>
       <fieldset>
            <form action="creer.php?action=modifier&<?php echo "paquet=",$_GET["paquet"],"&carte=",$_GET["carte"]?>" method="post">
                <table>
                    <tr><td>Question</td><td colspan="2"><input type="text" name="Question" value="<?php echo $donne["Question"] ?>"><span class="error"><?php echo $erreur["Question"] ?></span></td></tr>
                    <tr><td>Réponse (Vraie)</td><td colspan="2"><input type="text" name="Reponse" value="<?php echo $donne[0] ?>"><span class="error"><?php echo $erreur["Reponse"] ?></span></td></tr>
                    <?php 
                        for($i=2; $i<=$_SESSION["nombre"]; $i++){
                            echo "<tr><td>Réponse ",$i,"</td><td colspan=\"2\"><input type=\"text\" name=\"Reponse",$i,"\" value=\"",$donne[$i-1],"\"><span class=\"error\">",$erreur["Reponse".$i],"</span></td></tr>";
                        }
                    ?>
                    <tr><td><input type="button" onclick='window.location.href="creer.php?paquet=<?php echo $_GET["paquet"] ?>&carte=<?php echo $_GET["carte"] ?>"' value="retour"></td><td><input type="submit" value="accepter"></td><td><input type="reset" value="reset"></td></tr>
                </table>
            </form>
        </fieldset>
<?php }
   function affiche_form_FinNormal($donne,$erreur){ // fonction qui affiche le dernier formulaire lors de la création de cartes demandant la question et les réponses, pour la question ouvertes
       traiter($donne);?>
        <fieldset>
            <form action="creation.php?action=FinNormal" method="post">
                <table>
                    <tr><td>Question</td><td><input type="text" name="Question" value="<?php echo $donne["Question"] ?>"><span class="error"><?php echo $erreur["Question"] ?></span></td></tr>
                    <?php 
                        for($i=1; $i<=$_SESSION["nombre"]; $i++){
                            echo "<tr><td>Réponse ",$i,"</td><td><input type=\"text\" name=\"Reponse",$i,"\" value=\"",$donne["Reponse".$i],"\"><br><span class=\"error\">",$erreur["Reponse".$i],"</span></td></tr>";
                        }
                    ?>
                    <tr><td><input type="button" onclick='window.location.href="creation.php?action=choixNombreNormal"' value="retour"></td><td><input type="submit" value="accepter"></td></tr>
                </table>
            </form>
        </fieldset>
<?php }
function affiche_form_FinNormal_modif($donne,$erreur){ // fonction qui affiche le formulaire pour modifier une carte de type question ouverte
    traiter($donne);?>
    <fieldset>
        <form action="creer.php?action=modifier&<?php echo "paquet=",$_GET["paquet"],"&carte=",$_GET["carte"]?>" method="post">
        
            <table>
                <tr><td>Question</td><td colspan="2"><input type="text" name="Question" value="<?php echo $donne["Question"] ?>"><span class="error"><?php echo $erreur["Question"] ?></span></td></tr>
                <?php 
                    for($i=1; $i<=$_SESSION["nombre"]; $i++){
                        echo "<tr><td>Réponse ",$i,"</td><td colspan=\"2\"><input type=\"text\" name=\"Reponse",$i,"\" value=\"",$donne[$i-1],"\"><br><span class=\"error\">",$erreur["Reponse".$i],"</span></td></tr>";
                    }
                ?>
                <tr><td><input type="button" onclick='window.location.href="creer.php?paquet=<?php echo $_GET["paquet"] ?>&carte=<?php echo $_GET["carte"] ?>"' value="retour"></td><td><input type="submit" value="accepter"></td><td><input type="reset" value="reset"></td></tr>
            </table> 
        </form>
    </fieldset>
<?php }
    function melanger($tab){ //fonction qui permet de mélanger le contenu d'un tableau, utiliée pour mélanger l'ordre des choix d'un qcm
        $tab2 = array();
        $n = count($tab);
        for($i = 0; $i < $n; $i++){
            $r = random_int(0, count($tab)-1);
            $tab2[$i] = $tab[$r];
            array_splice($tab, $r, 1);
        }
        return $tab2;
    }
    function affiche_form_jeu($carte, $paquet, $connect){ //fonction affiche lo formulaire pour jouer un paquet, varie selon le type de la carte ((carte[3]==0)=question ouverte (carte[3]==1)=QCM)
        if($carte[3] == 1){
            $choix=melanger(explode("|@$|",$carte[4]));
        }
        $cartes = get_cartes_public($paquet, $connect);
        echo "Carte : ",count($cartes)-nombre_cartes_restantes($connect,$paquet,$_SESSION["id"])+1,"/",count($cartes),"<br>";
        echo "<hr>";
        echo '<form autocomplete="off" action="jeu.php?paquet='.$paquet.'" method="post">';
        echo "<table>";
        echo "<tr><td class=\"gauche\">Question:</td><td class=\"centre\">",htmlspecialchars($carte[1]),"</td></tr></table><hr><table>";
        if($carte[3]==0){
            echo '<tr><td colspan="2"><input type="text" name="reponse"></td></tr>';
        }else{
            for($i=0; $i<count($choix); $i++){
                echo "<tr><td colspan=\"2\"><input type=\"radio\" name=\"reponse\" value=\"".htmlspecialchars($choix[$i])."\">: <label>".htmlspecialchars($choix[$i])."</label></td></tr>";
            }
        }
        echo '<tr><td><input type="submit" value="accepter"></td><td><input type="button" onclick=\'window.location.href="jeu.php"\' value="arrêter"></td></tr>';
        echo "</table>";
        echo '</form>';
    }
    function affiche_users($users){ //fonction qui affiche les utilisateurs avec leur role et des bouton pour changer leur role
        echo "<table>";
        foreach($users as $user){
            echo "<tr><td>",htmlspecialchars($user["pseudo"]),"</td>";
            if($user["role"] == "a"){
                echo "<td class=\"multicolor\">Administrateur</td>";
            } else {
                echo "<td></td>";
                if($user["role"] == "u"){
                    echo "<td>Utilisateur</td>";
                } else {
                    echo '<td><input type="button" onclick=\'window.location.href="users.php?id='.$user["id"].'&newrole=u"\' value="Utilisateur"></td>';
                }
                if($user["role"] == "j"){
                    echo "<td>Simple Joueur</td>";
                } else {
                    echo '<td><input type="button" onclick=\'window.location.href="users.php?id='.$user["id"].'&newrole=j"\' value="Simple Joueur"></td>';
                }
                if($user["role"] == "b"){
                    echo "<td>Banni</td>";
                } else {
                    echo '<td><input type="button" onclick=\'window.location.href="users.php?id='.$user["id"].'&newrole=b"\' value="Banni"></td>';
                }
            }
        }
        echo "</table>";
    }
    function affiche_messages($messages){ //fonction qui affiche les message 
        $messages = explode("|#@|",$messages);
        $num = 0;
        foreach($messages as $message){
            $message = explode("|@$|", $message);
            echo "<fieldset>";
            if(count($message) == 1){ //si c'est une suppression de paquet
                echo 'Votre paquet "'.htmlspecialchars($message[0]).'" a été <span class="error">supprimé</span> par un administrateur pour du contenu inapproprié ou erroné';
            } else if($message[0] == 2){// si c'est un signalement d'une carte
                echo "Cette carte du paquet \"",htmlspecialchars($message[1]),"\" de l'utilisateur \"", htmlspecialchars(get_pseudo($message[count($message)-1])),"\" a été signalée par l'utilisateur \"",htmlspecialchars(get_pseudo($message[count($message)-2])),"\":<br>";
                echo "<table>";
                echo "<tr><td>Question:</td><td>",htmlspecialchars($message[3]),"</td></tr>";
                if($message[2]==0){ //si c'est un signalement d'une carte de type question ouverte
                    for($i = 4; $i < count($message)-2; $i++){
                        echo "<tr><td>Réponse ",$i-3,": </td><td class=\"droite\">",htmlspecialchars($message[$i]),"</td></tr>";
                    }
                }else{ //si c'est un signalement d'une carte de type QCM
                    echo "<tr><td>Réponse (Vrai): </td><td>",htmlspecialchars($message[4]),"</td></tr>";
                    for($i=5; $i<count($message)-2; $i++){
                        echo "<tr><td>Réponse ",$i-3,": </td><td>",htmlspecialchars($message[$i]),"</td></tr>";
                    }
                }
                echo "</table>";
            } else { //si c'est une suppression d'une carte
                echo "Votre carte:<br>";
                echo "<table>";
                echo "<tr><td>Question:</td><td>",htmlspecialchars($message[1]),"</td></tr>";
                if($message[0]==0){ //si c'est une suppression d'une carte de type question ouverte
                    for($i = 2; $i < count($message); $i++){
                        echo "<tr><td>Réponse ",$i-1,": </td><td class=\"droite\">",htmlspecialchars($message[$i]),"</td></tr>";
                    }
                }else{ //si c'est une suppression d'une carte de type QCM
                    echo "<tr><td>Réponse (Vrai): </td><td>",htmlspecialchars($message[2]),"</td></tr>";
                    for($i=3; $i<count($message); $i++){
                        echo "<tr><td>Réponse ",$i-1,": </td><td>",htmlspecialchars($message[$i]),"</td></tr>";
                    }
                }
                echo "</table>";
                echo "a été <span class=\"error\">supprimée</span> par un administrateur pour du contenu inapproprié ou erroné";
            }
            echo '<br><input type="button" onclick=\'window.location.href="accueil.php?action='.$num.'"\' value="Lu">';
            echo "</fieldset>";
            $num++;
        }
    }
    function affiche_repondu($carte, $reussi){ //fonction qui affiche si on a eu une bonne réponse ou non et si on a eu une mauvaises réponses on affiche la bonne réponse
        if($reussi){
            echo "<h1><span class=\"multicolor\">Bravo!</span></h1>";
        } else {
            echo "<h3>Mauvaise réponse!</h3>";
            $choix = explode("|@$|", $carte[4]);
            if($carte[3] == 1 || count($choix) == 1){
                echo "La bonne réponse était: <a id=\"spoiler\" href=\"#spoiler\">", htmlspecialchars($choix[0]),'</a><br>';
            } else {
                echo "Les réponses acceptées étaient:<br>";
                echo "<a id=\"spoiler\" href=\"#spoiler\">";
                echo "<ul class=\"spoiler\">";
                
                
                foreach($choix as $c){
                    echo "<li>",htmlspecialchars($c),"</li>";
                }
                echo "</ul></a>";
            }
            echo "<em>Cliquez sur la surface grise pour révéler la solution</em>";
        }
    }
?>