<?php 
    //Ce fichier est une bibliothèque de fonctions qui intéragit avec la base de données SQL
    
    
    function connect (){ //fonction qui connecte à la base de données
        $connect=mysqli_connect("127.0.0.1","root","Cereale.123#E","base_1");
        if(!$connect){
            echo "Connexion Echec";
            mysqli_close($connect);
            exit;
        }
        return $connect;
    }
    function enregistrer ($donne, $connect){ //fonction qui enregistre les données d'un utilisateur qui s'inscrit
        $a=mysqli_real_escape_string($connect,$donne["nom"]);
        $b=mysqli_real_escape_string($connect,$donne["prenom"]);
        $c=mysqli_real_escape_string($connect,$donne["adresse"]);
        $d=mysqli_real_escape_string($connect,$donne["pseudo"]);
        $e=mysqli_real_escape_string($connect,$donne["password"]);
        $e=md5($e);
        $req='insert into users (nom, prenom, adresse, pseudo, password, role) value("'.$a.'","'.$b.'","'.$c.'","'.$d.'","'.$e.'","u")';
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo "Echec Requete de l'enregistrement";
            mysql_close($connect);
            exit;
        }
    }
    function enregistrer_paquet ($iduser, $nom, $connect){ //fonction qui créer un nouveau paquet
        $pseudo = mysqli_real_escape_string($connect,$pseudo);
        $nom = mysqli_real_escape_string($connect,$nom);
        //on insere dans listepaquets (une table) le créateur et le nom du paquet
        $req='insert into listepaquets (iduser, nom) value("'.$iduser.'","'.$nom.'")';
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo "Echec Requete de l'enregistrement du paquet";
            mysql_close($connect);
            exit;

        }
        //on récupère l'id générer dans listepaquets
        $req='select id from listepaquets where iduser="'.$iduser.'" and nom="'.$nom.'"';
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo $req;
            echo "Echec Requete trouver id";
            mysql_close($connect);
            exit;

        }
        $ligne=mysqli_fetch_row($resultat);
        $id = $ligne[0];
        //on créé 2 tables (chaque ligne = une carte), une pour l'utilisateur (Perso) et une autre qui sera celle utilisée pour le jeu (publique), lorsque l'utilisateur créé des cartes elle s'insère dans sa table Perso, puis lorsqu'il upload ses cartes, on met à jour la table publique
        $req='CREATE TABLE paquet'.$id.' (numero INT(100) AUTO_INCREMENT , question TEXT, reponse VARCHAR(100), type BIT(1), choix TEXT, PRIMARY KEY (numero))';
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo "Echec Requete de création table";
            mysql_close($connect);
            exit;
        }
        $req='CREATE TABLE paquet'.$id.'Perso (numero INT(100) AUTO_INCREMENT , question TEXT, reponse VARCHAR(100), type BIT(1), choix TEXT, PRIMARY KEY (numero))';
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo "Echec Requete de création tablePerso";
            mysql_close($connect);
            exit;
        }
    }
    function get_paquets_de ($iduser, $connect){ //fonction qui récupère la liste des paquets d'un utilisateur donné
        $pseudo = mysqli_real_escape_string($connect,$pseudo);
        $req='select * from listepaquets where iduser="'.$iduser.'"';
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo $req;
            mysqli_close($connect);
            exit;
        }
        $tab = array();
        $i = 0;
        $ligne=mysqli_fetch_row($resultat);
        while($ligne != null){
            $tab[$i] = $ligne;
            $ligne=mysqli_fetch_row($resultat);
            $i++;
        }
        return $tab;
        
    }
    function get_paquets($connect){ //fonction qui récupère tous les paquets avec leur créateur de listepaquets
        $req='select * from listepaquets';
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo $req;
            mysqli_close($connect);
            exit;
        }
        $tab = array();
        $i = 0;
        $ligne=mysqli_fetch_row($resultat);
        while($ligne != null){
            $tab[$i] = $ligne;
            $ligne=mysqli_fetch_row($resultat);
            $i++;
        }
        return $tab;
    }
    function get_paquets_non_vides ($connect){ //fonction qui récupère que les paquets contenant des cartes
        $req='select * from listepaquets';
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo $req;
            mysqli_close($connect);
            exit;
        }
        $tab = array();
        $i = 0;
        $ligne=mysqli_fetch_row($resultat);
        while($ligne != null){
            if(count(get_cartes_public($ligne[2], $connect)) != 0){
                $tab[$i] = $ligne;
            } 
            $ligne=mysqli_fetch_row($resultat);
            $i++;
        }
        return $tab;
        
    }
    function get_cartes_de ($id, $connect){ //fonction qui récupère la liste des cartes d'un paquet (dont l'id est mis en argument) de la table Perso (celle qui n'est pas publique, accessible seulement par le créateur du paquet)
        $id = mysqli_real_escape_string($connect,$id);
        $req='select * from paquet'.$id.'Perso';
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo $req;
            echo "ERREUR requete get carte de";
            mysqli_close($connect);
            exit;
        }
        $tab = array();
        $i = 0;
        $ligne=mysqli_fetch_row($resultat);
        while($ligne != null){
            $tab[$i] = $ligne;
            $ligne=mysqli_fetch_row($resultat);
            $i++;
        }
        return $tab;
    }
    function get_cartes_public ($id, $connect){ //fonction qui récupère la liste des cartes d'un paquet (dont l'id est mis en argument) de la table publique
        $id = mysqli_real_escape_string($connect,$id);
        $req='select * from paquet'.$id;
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo $req;
            mysqli_close($connect);
            exit;
        }
        $tab = array();
        $i = 0;
        $ligne=mysqli_fetch_row($resultat);
        while($ligne != null){
            $tab[$i] = $ligne;
            $ligne=mysqli_fetch_row($resultat);
            $i++;
        }
        return $tab;
    }
    function get_contenu_carte ($connect,$id_paquet,$numero){ //fonction qui permet de récupérer toutes les informations d'une carte dont son numéro de ligne est mis en argument ainsi que l'id du paquet dont elle appartient de la table Perso (celle qui n'est pas publique, accessible seulement par le créateur du paquet)
        $numero=mysqli_real_escape_string($connect,$numero);
        $id_paquet=mysqli_real_escape_string($connect,$id_paquet);
        $req='select * from paquet'.$id_paquet.'Perso';
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo $req;
            echo "Echec requete affiche table paquet";
            mysqli_close($connect);
            exit;
        }
        $tab = array();
        $i = 1;
        $ligne=mysqli_fetch_row($resultat);
        while($ligne != null){
            $tab[$i] = $ligne;
            $ligne=mysqli_fetch_row($resultat);
            $i++;
        }
        return $tab[$numero];
    }
    function get_contenu_carte_public ($connect,$id_paquet,$numero){ ////fonction qui permet de récupérer toutes les informations d'une carte dont son numéro de ligne est mis en argument ainsi que l'id du paquet dont elle appartient de la table Publique
        $numero=mysqli_real_escape_string($connect,$numero);
        $id_paquet=mysqli_real_escape_string($connect,$id_paquet);
        $req='select * from paquet'.$id_paquet;
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo $req;
            echo "Echec requete affiche table paquet";
            mysqli_close($connect);
            exit;
        }
        $tab = array();
        $i = 1;
        $ligne=mysqli_fetch_row($resultat);
        while($ligne != null){
            $tab[$i] = $ligne;
            $ligne=mysqli_fetch_row($resultat);
            $i++;
        }
        return $tab[$numero];
    }
    function déja_lui ($pseudo,$connect){ //fonction qui regarde si le pseudo est déjà dans la base de données
        $pseudo=mysqli_real_escape_string($connect,$pseudo);
        $req='select nom from users where pseudo="'.$pseudo.'"';
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo $req;
            mysqli_close($connect);
            exit;
        }
        $ligne=mysqli_fetch_row($resultat);
        if($ligne==null){
            return false;
        }else{
            return true;
        }
    }
    function user_existe ($id,$connect){ //fontion qui vérifie si l'id de l'utilisateur existe (fonction utilisée pour vérifié des paramètre dans le $_GET)
        $id=mysqli_real_escape_string($connect,$id);
        $req='select nom from users where id="'.$id.'"';
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo $req;
            mysqli_close($connect);
            exit;
        }
        $ligne=mysqli_fetch_row($resultat);
        if($ligne==null){
            return false;
        }else{
            return true;
        }
    }
    function est_dans_base ($login,$mdp,$connect){ //fonction qui vérifie si le couple (login,mdp) est dans la base de données (utilisé lors du login)
        $login=mysqli_real_escape_string($connect,$login);
        $mdp=mysqli_real_escape_string($connect,$mdp);
        $mdp=md5($mdp);
        $req='select prenom from users where pseudo="'.$login.'" and password="'.$mdp.'"';
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo $req;
            echo "ECHEC REQUETE TROUVE";
            mysqli_close($connect);
            exit;
        }
        $ligne=mysqli_fetch_row($resultat);
        if($ligne==null){
            return false;
        }else{
            return true;
        }
    }

    function paquet_existe ($iduser,$nom,$connect){ //fonction qui vérifie si le couple (id du créateur,nom du paquet) est dans la table listepaquets (utilisé lors de la création du paquet)
        $iduser=mysqli_real_escape_string($connect,$iduser);
        $nom=mysqli_real_escape_string($connect,$nom);
        $req='select * from listepaquets where iduser="'.$iduser.'" and nom="'.$nom.'"';
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo $req;
            echo "ECHEC REQUETE TROUVE";
            mysqli_close($connect);
            exit;
        }
        $ligne=mysqli_fetch_row($resultat);
        if($ligne==null){
            return false;
        }else{
            return true;
        }
    }
    function paquet_existe_id ($iduser,$id,$connect){ //fonction qui vérifie si l'id du paquet mis en argument appartient à l'utilisateur d'id mis en argument (utilisé pour vérifier les variables dans $_GET)
        $iduser=mysqli_real_escape_string($connect,$iduser);
        $id=mysqli_real_escape_string($connect,$id);
        $req='select * from listepaquets where iduser="'.$iduser.'" and id="'.$id.'"';
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo $req;
            echo "ECHEC REQUETE TROUVE";
            mysqli_close($connect);
            exit;
        }
        $ligne=mysqli_fetch_row($resultat);
        if($ligne==null){
            return false;
        }else{
            return true;
        }
    }

    function paquet_existe_id_2 ($id,$connect){ //fonction qui vérifie si l'id du paquet mis en argument existe
        $id=mysqli_real_escape_string($connect,$id);
        $req='select * from listepaquets where id="'.$id.'"';
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo $req;
            echo "ECHEC REQUETE TROUVE";
            mysqli_close($connect);
            exit;
        }
        $ligne=mysqli_fetch_row($resultat);
        if($ligne==null){
            return false;
        }else{
            return true;
        }
    }

    function get ($pseudo, $nom){ //fonction qui permet d'obtenir une donnée ($nom) sur un utilisateur ($pseudo)
        $connect=connect();
        $pseudo=mysqli_real_escape_string($connect,$pseudo);
        $nom=mysqli_real_escape_string($connect,$nom);
        $req='select '.$nom.' from users where pseudo="'.$pseudo.'"';
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo $req;
            echo "ECHEC SESSION";
            mysqli_close($connect);
            exit;
        }
        $ligne=mysqli_fetch_row($resultat);
        mysqli_close($connect);
        return $ligne[0];
    }
    function suppr ($pseudo, $connect){ // fonction qui supprime l'utilisateur de la base de données (les paquets qu'il a créé existe toujours)
        $pseudo=mysqli_real_escape_string($connect,$pseudo);
        $req='delete from users where pseudo="'.$pseudo.'"';
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo "Probleme requete supression";
            mysqli_close($connect);
            exit;
        }
    }
    function modifier($donne,$pseudo,$connect){  //fonction qui permet de modifier les infos d'un utilisateur (hormis le mdp)
        $pseudo = mysqli_real_escape_string($connect, $pseudo);
        $a=mysqli_real_escape_string($connect,$donne["nom"]);
        $b=mysqli_real_escape_string($connect,$donne["prenom"]);
        $c=mysqli_real_escape_string($connect,$donne["adresse"]);
        $d=mysqli_real_escape_string($connect,$donne["pseudo"]);
        $req='update users set nom="'.$a.'", prenom="'.$b.'", adresse="'.$c.'", pseudo="'.$d.'" where pseudo="'.$pseudo.'"';
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo "test";
            echo $req;
            echo "erreur requete modifier";
            mysqli_close($connect);
            exit;
        }
    }
    function modif_mdp ($newmdp,$pseudo, $connect){ //fonction qui permet de modifier le mdp d'un utilisateur
        $newmdp=mysqli_real_escape_string($connect,$newmdp);
        $newmdp=md5($newmdp);
        $req='update users set password="'.$newmdp.'" where pseudo="'.$pseudo.'"';
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo $req;
            echo "Erreur requete modifier mdp";
            mysqli_close($connect);
            exit;
        }
    }
    function enregistrement_carte ($connect, $id, $question, $reponse, $type, $reponses){ //fonction utilisé pour insérer une ligne dans le paquet (Perso) dont l'id est mis en argument, a ligne contient les infos de la carte
        $question=mysqli_real_escape_string($connect,$question);
        $reponse=mysqli_real_escape_string($connect,$reponse);
        $type=mysqli_real_escape_string($connect,$type);
        $reponses=mysqli_real_escape_string($connect,$reponses);
        $req='insert into paquet'.$id.'Perso (question,reponse,type,choix) values ("'.$question.'","'.$reponse.'",'.$type.',"'.$reponses.'")';
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo $req;
            mysqli_close($connect);
            echo "Erreur requete enregistrement carte";
            exit;
        }
    }
    function modifier_carte ($connect, $id, $question, $reponse, $reponses, $carte){ //fonction qui permet de modifier les infos d'une carte dans la table du paquet Perso
        $question=mysqli_real_escape_string($connect,$question);
        $reponse=mysqli_real_escape_string($connect,$reponse);
        $reponses=mysqli_real_escape_string($connect,$reponses);
        $id=mysqli_real_escape_string($connect,$id);
        $cartes = get_cartes_de($id, $connect);
        $numero = $cartes[$carte-1][0];
        $req='update paquet'.$id.'Perso set question="'.$question.'", reponse="'.$reponse.'", choix="'.$reponses.'" where numero="'.$numero.'"';
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo $req;
            echo "ECHEC REQUETE modifier carte";
            mysqli_close($connect);
            exit;
        }
    }
    
    //La table ordre contient principalement 2 colonnes, une représentant l'ordre des cartes non jouées, et l'autre représentant l'ordre des cartes auxquels le joueur a répondu et il jouera cet ordre lorqu'il aura fini le paquet (cet ordre dépend des bonnes ou mauvaises réponses) 
    function ordre_existe($paquet, $iduser, $connect){ //fonction qui regarde si un utilisateur a déjà joué au paquet
        $iduser=mysqli_real_escape_string($connect,$iduser);
        $paquet=mysqli_real_escape_string($connect,$paquet);
        $req='select * from ordre where iduser="'.$iduser.'" and id="'.$paquet.'"';
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo $req;
            echo "ECHEC REQUETE ordre existe";
            mysqli_close($connect);
            exit;
        }
        $ligne=mysqli_fetch_row($resultat);
        return $ligne != null;
    }
    function new_ordre($paquet, $iduser, $connect){ //fonction qui initialise l'ordre des cartes de ce paquet ($paquet) pour l'utilisateur ($iduser)
        
        $iduser=mysqli_real_escape_string($connect,$iduser);
        $paquet=mysqli_real_escape_string($connect,$paquet);
        //on récupère tous les numéro des cartes
        $req='select numero from paquet'.$paquet;
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo $req;
            echo "ECHEC REQUETE new paquet select";
            mysqli_close($connect);
            exit;
        }
        
        $ligne=mysqli_fetch_row($resultat);
        //on créé un string avec tous les numéros séparés par "|"
        $ordre = $ligne[0];
        while($ligne != null){
            $ligne=mysqli_fetch_row($resultat);
            if($ligne != null ) $ordre = $ordre."|".$ligne[0];
        }
        //et on insère ce string dans la table ordre dans la colonne ordre actuel
        $ordre=mysqli_real_escape_string($connect,$ordre);
        $req='insert into ordre values ("'.$iduser.'",'.$paquet.',"'.$ordre.'","", 0)';
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo $req;
            echo "ECHEC REQUETE new paquet insert";
            mysqli_close($connect);
            exit;
        }
    }
    function get_prochaine_carte($paquet, $iduser, $connect){ //fonction qui récupère tout le contenu de la prochaine carte à jouer
        $iduser=mysqli_real_escape_string($connect,$iduser);
        $paquet=mysqli_real_escape_string($connect,$paquet);
        //on récupère le numéro de la carte
        $req='select ordre_actuel from ordre where iduser="'.$iduser.'" and id="'.$paquet.'"';
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo $req;
            echo "ECHEC REQUETE next carte 1";
            mysqli_close($connect);
            exit;
        }
        $ordre = mysqli_fetch_row($resultat)[0];
        $numero = explode("|",$ordre)[0];
        if($numero == null) return false;
        //on récupère le contenu de la carte qui à ce numéro
        $req='select * from paquet'.$paquet.' where numero='.$numero;
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo $req;
            echo "ECHEC REQUETE next carte 2";
            mysqli_close($connect);
            exit;
        }
        return mysqli_fetch_row($resultat);
    }
    function repondu($paquet, $iduser, $reponse, $connect){ // fonction qui vérifie la réponse et gère l'ordre des cartes après que le joueur ait répondu à une carte
        $iduser=mysqli_real_escape_string($connect,$iduser);
        $paquet=mysqli_real_escape_string($connect,$paquet);
        //on récupère les ordres correspondant au paquet $paquet et à l'utilisateur $user
        $req='select * from ordre where iduser="'.$iduser.'" and id="'.$paquet.'"';
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo $req;
            echo "ECHEC REQUETE repondu 1";
            mysqli_close($connect);
            exit;
        }
        $ordres = mysqli_fetch_row($resultat);

        // on récupère la 1ère carte de l'ordre (celle sur le dessus du paquet)
        $numero = explode("|",$ordres[2])[0];
        $req='select * from paquet'.$paquet.' where numero='.$numero;
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo $req;
            echo "ECHEC REQUETE repondu 2";
            mysqli_close($connect);
            exit;
        }

        // on compare la réponse du joueur avec la/les bonnes réponses
        $carte = mysqli_fetch_row($resultat);
        $reponses = explode("|@$|",$carte[4]);
        $reussi = (strcasecmp(trim($reponse, " "), trim($reponses[0], " ")) == 0);// on compare la réponse en ignorant la casse et les espaces au début/à la fin
        if($carte[3] == 0 && !$reussi){ // si le type de la carte est une question ouverte, on vérifie si la réponse du joueur est une des réponses possibles
            for($i = 1; $i < count($reponses); $i++){
                if(strcasecmp(trim($reponse, " "), trim($reponses[$i], " ")) == 0){
                    $reussi = true;
                }
            }
        }

        // on retire la 1ère carte des cartes pas encore jouées(car elle vient d'être jouée)
        $ordre = explode("|",$ordres[2]);
        $nouvel_ordre = "";
        for($i = 1; $i < count($ordre); $i++){
            if($i == 1){
                $nouvel_ordre = $ordre[$i];
            } else {
                $nouvel_ordre = $nouvel_ordre."|".$ordre[$i];
            }
        }
        // on ajoute la carte qu'on vient de retirer soit à la fin soit au début des cartes déjà jouées, selon si la réponse est bonne ou non
        $nouvel_ordre2 = $ordres[3];
        if(strlen($ordres[3]) == 0){
            $nouvel_ordre2 = $ordre[0];
        } else {
            if($reussi){
                $nouvel_ordre2 = $nouvel_ordre2."|".$ordre[0];
            } else {
                $nouvel_ordre2 = $ordre[0]."|".$nouvel_ordre2;
            }
        }

        if($reussi) $ordres[4]++; // si la réponse est bonne, on incrémente le compteur de cartes réussies

        //puis on insère ces nouvelles données dans la table ordre
        $req='update ordre set ordre_actuel="'.$nouvel_ordre.'", ordre_suivant="'.$nouvel_ordre2.'", reussies="'.$ordres[4].'" where iduser="'.$iduser.'" and id="'.$paquet.'"';
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo $req;
            echo "ECHEC REQUETE repondu 3";
            mysqli_close($connect);
            exit;
        }
        return array("reussi" => $reussi, "carte" => $carte);
    }
    function get_reussies($paquet, $iduser, $connect){ // fonction qui renvoie le nombre de cartes réussies par l'utilisateur $iduser sur le paquet $paquet
        $iduser=mysqli_real_escape_string($connect,$iduser);
        $paquet=mysqli_real_escape_string($connect,$paquet);
        $req='select reussies from ordre where iduser="'.$iduser.'" and id="'.$paquet.'"';
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo $req;
            echo "ECHEC REQUETE get reussies";
            mysqli_close($connect);
            exit;
        }
        return mysqli_fetch_row($resultat)[0];
    }
    function recommencer($paquet, $iduser, $connect){ // fonction exécutée quand un joueur a répondu à toutes les cartes d'un paquet et recommence ce paquet
        $iduser=mysqli_real_escape_string($connect,$iduser);
        $paquet=mysqli_real_escape_string($connect,$paquet);
        //on récupère l'ordre des cartes déjà jouées
        $req='select ordre_suivant from ordre where iduser="'.$iduser.'" and id="'.$paquet.'"';
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo $req;
            echo "ECHEC REQUETE recommencer 1";
            mysqli_close($connect);
            exit;
        }
        $ordre_suivant = mysqli_fetch_row($resultat)[0];
        // puis on insère cet ordre dans la table ordre dans la colonne des cartes pas encore jouées, et on initialise à la chaine vide les cartes déjà jouées. On initialise aussi à 0 le nombre de cartes réussies
        $req='update ordre set ordre_actuel="'.$ordre_suivant.'", ordre_suivant="", reussies="0" where iduser="'.$iduser.'" and id="'.$paquet.'"';
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo $req;
            echo "ECHEC REQUETE recommencer 2";
            mysqli_close($connect);
            exit;
        }
    }
    function nombre_cartes_restantes ($connect, $paquet, $iduser){ // fonction qui renvoie le nombre de cartes restantes pas encore jouées par un utilisateur $iduser dans le paquet $paquet
        $iduser=mysqli_real_escape_string($connect,$iduser);
        $paquet=mysqli_real_escape_string($connect,$paquet);
        $req='select ordre_actuel from ordre where iduser="'.$iduser.'" and id="'.$paquet.'"';
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo $req;
            echo "ECHEC REQUETE cartes restantes";
            mysqli_close($connect);
            exit;
        }
        $ligne=mysqli_fetch_row($resultat);
        $questions=explode("|",$ligne[0]);
        return count($questions);
    }
    function different($paquet, $iduser, $connect){ // fonction qui détermine si des cartes ont été ajoutées ou supprimées d'un paquet $paquet depuis la dernière fois qu'un joueur $iduser y a joué
        $iduser=mysqli_real_escape_string($connect,$iduser);
        $paquet=mysqli_real_escape_string($connect,$paquet);
        // on récupère l'ordre des cartes déjà jouées et pas encore jouées par $user dans $paquet
        $req='select ordre_actuel, ordre_suivant from ordre where iduser="'.$iduser.'" and id="'.$paquet.'"';
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo $req;
            echo "ECHEC REQUETE different 1";
            mysqli_close($connect);
            exit;
        }
        $ordres = mysqli_fetch_row($resultat);

        // on rassemble ces ordres dans 1 tableau contenant la liste des numéros de cartes qui se trouvaient dans ces ordres, c'est à dire la liste des numéros de cartes qui étaient dans $paquet la dernière fois que $user y a joué
        if($ordres[0] == ""){
            $cartes_ordre = explode("|",$ordres[1]);
        } else if($ordres[1] == ""){
            $cartes_ordre = explode("|",$ordres[0]);
        } else {
            $cartes_ordre = array_merge(explode("|",$ordres[0]), explode("|",$ordres[1]));
        }
        
        // on récupère la liste des numéros de cartes qu'il y a actuellement dans le paquet
        $req='select numero from paquet'.$paquet;
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo $req;
            echo "ECHEC REQUETE different 2";
            mysqli_close($connect);
            exit;
        }
        
        // on les met dans un tableau
        $cartes_paquet = array();
        $i = 0;
        while($ligne=mysqli_fetch_row($resultat)){
            $cartes_paquet[$i] = $ligne[0];
            $i++;
        }

        // on se retrouve alors avec 2 tableaux:
        //cartes_ordres = numéros des cartes qui étaient dans le paquet la derniere fois que le joueur y a joué
        //cartes_paquet = numéros des cartes qu'il y a actuellement dans le paquet
        //on compare donc ces deux tableaux pour déterminer quelles cartes ont été supprimées et/ou ajoutées

        
        $copy = $cartes_ordre;// on copie carte_ordres pour y ajouter/retirer les cartes qui ont été ajoutées/retirées du paquet

        // on regarde quelles cartes existent dans carte_ordre mais n'existent plus dans carte_paquet
        $different = false;
        $supprimees = 0;
        for($i = 0; $i < count($cartes_ordre); $i++){
            $existe = array_search($cartes_ordre[$i], $cartes_paquet);
            if($existe === false){
                $supprimees++; // on incrémente un compteur pour pouvoir informer le joueur du nombre de modifications
                $different = true;
                array_splice($copy, array_search($cartes_ordre[$i], $copy), 1);// si la carte a été supprimée, on la retire de l'ordre
            }
        }
        
        // on regarde quelles cartes ont été ajoutées dans cartes_paquet et n'existent alors pas dans carte_ordre
        $ajoutees = 0;
        for($i = 0; $i < count($cartes_paquet); $i++){
            $existe = array_search($cartes_paquet[$i], $cartes_ordre);
            if($existe === false){
                $ajoutees++; // on incrémente un compteur pour pouvoir informer le joueur du nombre de modifications
                $different = true;
                array_unshift($copy, $cartes_paquet[$i]);// si la carte a été ajoutée au paquet, on l'ajoute à l'ordre
            }
        }
        $cartes_ordre = $copy;

        if($different){ // si des cartes ont été ajoutées et/ou supprimées
            // on forme une chaine de caractères avec le tableau cartes_ordre
            $ordre = "";
            foreach($cartes_ordre as $c){
                $ordre = $ordre.$c."|";
            }
            $ordre = rtrim($ordre, "|");
            // puis on l'insère dans la base de données, ainsi $user pourra jouer aux nouvelles cartes et les cartes supprimées ne seront plus comptées dans l'ordre des cartes
            $req='update ordre set ordre_actuel="'.$ordre.'", ordre_suivant="", reussies="0" where iduser="'.$iduser.'" and id="'.$paquet.'"';
            $resultat=mysqli_query($connect,$req);
            if(!$resultat){
                echo $req;
                echo "ECHEC REQUETE different 3";
                mysqli_close($connect);
                exit;
            }
        }

        // on retourne si le paquet a été modifié ou non, en précisant quelles modifications
        return array("different"=>$different, "ajoutees"=>$ajoutees, "supprimees"=>$supprimees);
    }
    function supprimer_carte($paquet, $carte, $iduser, $connect){ // fonction qui supprime la n-ème avec n = $carte carte du paquet(personnel, c'est à dire que seul lui peut voir) $paquet appartenant à l'utilisateur $iduser 
        //$carte représente le numéro de la ligne désignant la carte dans la table du paquet, mais son vrai numéro peut être différent(par exemple si on supprime des cartes, certaines cartes vont changer de ligne, mais vont garder le même numéro)
        $iduser=mysqli_real_escape_string($connect,$iduser);
        $paquet=mysqli_real_escape_string($connect,$paquet);
        if(paquet_existe_id ($iduser,$paquet,$connect)){ // on vérifie que le paquet appartient bien à $iduser
            // on récupère le numero de la $n-ème carte (la carte qui se trouve à la $n-ème ligne de la table "paquet".$paquet."Perso")
            $cartes = get_cartes_de($paquet, $connect);
            $numero = $cartes[$carte-1][0];
            //on supprime cette carte
            $req = 'delete from paquet'.$paquet.'Perso where numero='.$numero;
            $resultat=mysqli_query($connect,$req);
            if(!$resultat){
                error_log("non");
                echo $req;
                echo "ECHEC REQUETE supprimer carte";
                mysqli_close($connect);
                exit;
            }
        }
    }
    // chaque paquet est stocké dans 2 tables: 1 publique et 1 personnelle. Quand une modification est effectuée sur un paquet, seule la table personnelle est modifiée
    // la fonction uploader permet de copier le contenu de la table perso vers la table publique, permettant à tous les utilisateurs de voir les modifiactions effectuées
    function uploader ($connect,$paquet){
        $paquet=mysqli_real_escape_string($connect,$paquet);
        // on supprime la table publique
        $req='drop table paquet'.$paquet;
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo $req;
            echo "ERREUR requete uploader 1";
            mysqli_close($connect);
            exit;
        }
        // on crée une nouvelle table publique avec les mêmes colonnes que la table perso
        $req='create table paquet'.$paquet.' like paquet'.$paquet.'Perso';
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo $req;
            echo "ERREUR requete uploader 2";
            mysqli_close($connect);
            exit;
        }
        // on copie le contenu de la table perso dans la table publique
        $req='insert into paquet'.$paquet.' select * from paquet'.$paquet.'Perso';
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo $req;
            echo "ERREUR requete uploader 3";
            mysqli_close($connect);
            exit;
        }
    }
    function supprimer_carte_admin($paquet, $carte, $connect){ // fonction qui permet à un administrateur de supprimer la carte $carte du paquet(public) $paquet
        // cette fonction envoie aussi un message au créateur de la carte pour l'avertir de sa suppression, le message sera visible sur la page d'accueil du créateur de la carte
        
        //$carte représente le numéro de la ligne désignant la carte dans la table du paquet, mais son vrai numéro peut être différent(par exemple si on supprime des cartes, certaines cartes vont changer de ligne, mais vont garder le même numéro)
        //c'est pour cela qu'on récupère le numéro de la carte
        $cartes = get_cartes_public($paquet, $connect);
        $numero = $cartes[$carte-1][0];

        // on récupère le contenu de la carte pour le mettre dans le message
        $contenu = get_contenu_carte_public($connect, $paquet, $carte);
        $q = $contenu[3].'|@$|'.$contenu[1].'|@$|'.$contenu[4];


        $numero=mysqli_real_escape_string($connect,$numero);
        $paquet=mysqli_real_escape_string($connect,$paquet);
        // on supprime la carte
        $req = 'delete from paquet'.$paquet.' where numero='.$numero;
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo $req;
            echo "ECHEC REQUETE supprimer carte admin";
            mysqli_close($connect);
            exit;
        }

        // on récupère l'id du créateur de la carte
        $req = 'select iduser from listepaquets where id='.$paquet;
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo $req;
            echo "ECHEC REQUETE supprimer carte admin 2";
            mysqli_close($connect);
            exit;
        }
        $iduser = mysqli_fetch_row($resultat)[0];

        $iduser=mysqli_real_escape_string($connect,$iduser);
        //on récupère la liste des messages envoyés au créateur de la carte
        $req = 'select message from users where id="'.$iduser.'"';
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo $req;
            echo "ECHEC REQUETE supprimer carte admin 3";
            mysqli_close($connect);
            exit;
        }
        $message = mysqli_fetch_row($resultat)[0];

        //on ajoute le nouveau message à cette liste de messages
        if(!$message){
            $message = $q;
        } else {
            $message = $message.'|#@|'.$q;
        }
        
        //on update la liste des messages envoyés au créateur de la carte avec le nouveau message ajouté à cette liste
        $message=mysqli_real_escape_string($connect,$message);
        $req = 'update users set message="'.$message.'" where id="'.$iduser.'"';
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo $req;
            echo "ECHEC REQUETE supprimer carte admin 4";
            mysqli_close($connect);
            exit;
        }
    }
    function supprimer_paquet($paquet, $connect){ // fonction qui supprime le paquet $paquet
        $paquet=mysqli_real_escape_string($connect,$paquet);
        $req = 'drop table paquet'.$paquet;
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo $req;
            echo "ECHEC REQUETE supprimer paquet admin";
            mysqli_close($connect);
            exit;
        }
        // on supprime la table perso
        $req = 'drop table paquet'.$paquet.'Perso';
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo $req;
            echo "ECHEC REQUETE supprimer paquet admin 2";
            mysqli_close($connect);
            exit;
        }
        // on supprime la table publique
        $req = 'delete from listepaquets where id='.$paquet;
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo $req;
            echo "ECHEC REQUETE supprimer paquet admin 3";
            mysqli_close($connect);
            exit;
        }
    }
    function supprimer_paquet_admin($paquet, $connect){ // fonction qui permet à un administrateur de supprimer un paquet(public), et envoie un message au créateur du paquet supprimé
        // on supprime la table publique correspondant au paquet
        $paquet=mysqli_real_escape_string($connect,$paquet);
        $req = 'drop table paquet'.$paquet;
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo $req;
            echo "ECHEC REQUETE supprimer paquet admin";
            mysqli_close($connect);
            exit;
        }
        // on recrée une table publique vide correspondant à ce paquet pour éviter des erreurs avec d'autres fonctions
        $req='create table paquet'.$paquet.' like paquet'.$paquet.'Perso';
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo $req;
            echo "ERREUR requete supprimer paquet admin 2";
            mysqli_close($connect);
            exit;
        }

        /*$req = 'drop table paquet'.$paquet.'Perso';
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo $req;
            echo "ECHEC REQUETE supprimer paquet admin 2";
            mysqli_close($connect);
            exit;
        }*/

        //on récupère le nom du paquet et l'id de son créateur
        $req = 'select * from listepaquets where id='.$paquet;
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo $req;
            echo "ECHEC REQUETE supprimer paquet admin 3";
            mysqli_close($connect);
            exit;
        }
        $ligne = mysqli_fetch_row($resultat);
        $nom = $ligne[1];
        $iduser = $ligne[0];

        /*$req = 'delete from listepaquets where id='.$paquet;
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo $req;
            echo "ECHEC REQUETE supprimer paquet admin 4";
            mysqli_close($connect);
            exit;
        }*/

        // on récupère la liste des messages envoyés au créateur du paquet
        $iduser=mysqli_real_escape_string($connect,$iduser);
        $req = 'select message from users where id="'.$iduser.'"';
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo $req;
            echo "ECHEC REQUETE supprimer paquet admin 5";
            mysqli_close($connect);
            exit;
        }

        // on y ajoute le nom du paquet supprimé
        $message = mysqli_fetch_row($resultat)[0];
        if(!$message){
            $message = $nom;
        } else {
            $message = $message.'|#@|'.$nom;
        }

        // on insère le résultat dans la base de données
        $message=mysqli_real_escape_string($connect,$message);
        $req = 'update users set message="'.$message.'" where id="'.$iduser.'"';
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo $req;
            echo "ECHEC REQUETE supprimer paquet admin 6";
            mysqli_close($connect);
            exit;
        }
    }
    function get_users($connect){ // fonction qui renvoie un tableau contenant l'information de tous les utilisateurs
        $req = 'select * from users';
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo $req;
            echo "ECHEC REQUETE get users";
            mysqli_close($connect);
            exit;
        }
        $tab = array();
        $i = 0;
        $ligne=mysqli_fetch_assoc($resultat);
        while($ligne != null){
            $tab[$i] = $ligne;
            $ligne=mysqli_fetch_assoc($resultat);
            $i++;
        }
        return $tab;
    }
    function change_role($id, $newrole, $connect){ // fonction qui change le rôle de l'utilisateur d'id $id en le nouveau rôle $newrole
        $id=mysqli_real_escape_string($connect,$id);
        $newrole=mysqli_real_escape_string($connect,$newrole);
        $req = 'update users set role="'.$newrole.'" where id="'.$id.'"';
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo $req;
            echo "ECHEC REQUETE change role";
            mysqli_close($connect);
            exit;
        }
    }
    function message_lu($numero, $pseudo, $connect){ // fonction qui retire de la liste des messages envoyés à l'utilisateur $pseudo le message numéro $numero
        // on récupère la liste des messages sous forme de string
        $pseudo = mysqli_escape_string($connect, $pseudo);
        $req = 'select message from users where pseudo="'.$pseudo.'"';
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo $req;
            echo "ECHEC REQUETE message lu 1";
            mysqli_close($connect);
            exit;
        }
        //on la transforme en tableau
        $messages = explode("|#@|", mysqli_fetch_row($resultat)[0]);
        
        //on retire le message $numero
        array_splice($messages, $numero, 1);

        //on transforme le résultat en string
        $messages = implode("|#@|", $messages);
        error_log($messages);

        //et on le réinsère dans la base de données
        $messages=mysqli_real_escape_string($connect,$messages);
        $req = 'update users set message="'.$messages.'" where pseudo="'.$pseudo.'"';
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo $req;
            echo "ECHEC REQUETE supprimer message lu 2";
            mysqli_close($connect);
            exit;
        }
    }
    function signaler($paquet, $carte, $idsender, $connect){ // fonction qui envoie un message à tous les administrateurs disant que la carte $carte du paquet $paquet a été signalée par l'utilisateur d'id $idsender
        // on récupère le nom du paquet et de son créateur
        $paquet=mysqli_real_escape_string($connect,$paquet);
        $req = 'select * from listepaquets where id='.$paquet;
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo $req;
            echo "ECHEC REQUETE signaler 1";
            mysqli_close($connect);
            exit;
        }
        $ligne = mysqli_fetch_row($resultat);
        
        // on constitue le message à envoyer
        $s = "|@$|";
        $message = "2".$s.$ligne[1].$s.$carte[3].$s.$carte[1].$s.$carte[4].$s.$idsender.$s.$ligne[0];

        // on récupère les listes des messages de tous les administrateurs
        $req = 'select message, pseudo from users where role="a"';
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo $req;
            echo "ECHEC REQUETE signaler 2";
            mysqli_close($connect);
            exit;
        }
        
        
        while($ligne = mysqli_fetch_row($resultat)){
            // pour chaque administrateur
            // on ajoute le message à sa liste
            $messages = $ligne[0];
            if(!$messages){
                $messages = $message;
            } else {
                $messages = $messages.'|#@|'.$message;
            }
            $messages = mysqli_real_escape_string($connect, $messages);
            // et on insère le tout dans sa ligne de la table users
            $req = 'update users set message="'.$messages.'" where pseudo="'.$ligne[1].'"';
            $resultat2=mysqli_query($connect,$req);
            if(!$resultat2){
                echo $req;
                echo "ECHEC REQUETE signaler 3";
                mysqli_close($connect);
                exit;
            }
        }
    }
    function is_diff($tab1, $tab2){ // fonction qui renvoie si 2 tableaux à 2 dimensions ont le même contenu
        foreach($tab1 as $k => $t1){
            foreach($t1 as $ind => $v){
                if($tab2[$k][$ind] != $v){
                    return true;
                }
            }
        }
        return false;
    }
    function is_uploaded($paquet, $connect){ // fonction qui renvoie si les dernières modifications du paquet $paquet on été uploadées
        $prive = get_cartes_de($paquet, $connect);
        $public = get_cartes_public($paquet, $connect);
        return !is_diff($prive, $public);
    }
    function get_nom_paquet($id_paquet, $connect){ // fonction qui renvoie le nom du paquet d'id $id_paquet
        $id_paquet=mysqli_real_escape_string($connect,$id_paquet);
        $req = 'select nom from listepaquets where id='.$id_paquet;
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo $req;
            echo "ECHEC REQUETE get nom paquet";
            mysqli_close($connect);
            exit;
        }
        return mysqli_fetch_row($resultat)[0];
    }
    function get_pseudo($iduser){ // fonction qui renvoie le pseudo de l'utilisateur qui a pour id $iduser
        $connect = connect();
        $iduser=mysqli_real_escape_string($connect,$iduser);
        $req = "select pseudo from users where id=".$iduser;
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo $req;
            echo "ECHEC REQUETE get pseudo";
            mysqli_close($connect);
            exit;
        }
        mysqli_close($connect);
        return mysqli_fetch_row($resultat)[0];
    }
    function renommer_paquet($iduser, $id, $nom, $connect){
        $iduser=mysqli_real_escape_string($connect,$iduser);
        $id=mysqli_real_escape_string($connect,$id);
        $nom=mysqli_real_escape_string($connect,$nom);
        $req = 'update listepaquets set nom="'.$nom.'" where iduser='.$iduser.' and id='.$id;
        $resultat=mysqli_query($connect,$req);
        if(!$resultat){
            echo $req;
            echo "ECHEC REQUETE renommer paquet";
            mysqli_close($connect);
            exit;
        }
    }
?>
