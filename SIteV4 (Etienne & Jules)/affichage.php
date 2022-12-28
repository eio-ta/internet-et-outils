<?php require_once('connexion.php');?>
<?php 

    //fonction pour afficher l'entete d'une page
    function affiche_entete($css){
        echo "<!DOCTYPE html>
        <html lang=\"fr\">
        <head>
        <meta charset='utf-8'>
        <link rel=\"stylesheet\" href=\"".$css."\">
        </head>
        <body>";
    }
    function pHeader(){
        if(isset($_SESSION['pseudo']) && $_SESSION['admin']==true){
            echo"        <header class=\"toolbar\">
            <a href=\"acceuil.php\">
                <div id=\"img\">La nuit de la culture</div>
            </a>
            <a href=\"Deco.php\">
                <div id=\"connexion\">Deconnexion</div>
            </a>
            <div id=\"text\">Prenez un bon bain de culture</div>
            <a href=\"admin.php\">
                <div id=\"admin\">
                    page Admin
                </div>
            </a>
    </header>";
        }else if(isset($_SESSION['pseudo'])&&$_SESSION['admin']==false){
            echo "<header class=\"toolbar\">
            <a href=\"acceuil.php\">
                <div id=\"img\">La nuit de la culture</div>
            </a>
            <a href=\"Deco.php\">
                <div id=\"connexion\">Deconnexion</div>
            </a>
            <div id=\"text\">Prenez un bon bain de culture</div>
    </header>";
        }else{
            echo "<header class=\"toolbar\">
            <a href=\"acceuil.php\">
                <div id=\"img\">La nuit de la culture</div>
            </a>
            <a href=\"logg.php\">
                <div id=\"connexion\">Connexion</div>
            </a>
            <div id=\"text\">Prenez un bon bain de culture</div>
    </header>";

        }
    }

    //fonction qui va afficher le bas de la page
    function affiche_page(){
        if($_SESSION['admin']==true){
            echo"      <div id=\"main\">
            <a href=\"jeu.php?action1=art\">
            <div id=\"art\">
                <div id=\"art2\">Art</div>
            </div>
        </a>
        <a href=\"jeu.php?action1=histoiregeo\">
            <div id=\"histoire\">
                <div id=\"histoire2\">
                    Histoire Geographie
                </div>
            </div>
        </a>
        <a href=\"jeu.php?action1=divertissement\">
            <div id=\"div\">
                <div id=\"div2\">
                Divertissement
                </div>
            </div>
        </a>
        <a href=\"jeu.php?action1=sport\">
            <div id=\"sport\">
                <div id=\"sport2\">
                Sport
                </div>
            </div>
        </a>
        </div>
        <a href=\"creation.php\">
        <div id=\"CQ\">
            Créer un questionnaire
    
        </div>
    </a>
    <a href=\"modif.php\">
        <div id=\"CD\">
            Changer vos données
        </div>
    </a>";
            }
            else if(isset($_SESSION['pseudo'])&& $_SESSION['admin']==false){
            echo"<div id=\"main\">
                <a href=\"jeu.php?action1=art\">
                <div id=\"art\">
                    <div id=\"art2\">Art</div>
                </div>
            </a>
            <a href=\"jeu.php?action1=histoiregeo\">
                <div id=\"histoire\">
                    <div id=\"histoire2\">
                        Histoire Geographie
                    </div>
                </div>
            </a>
            <a href=\"jeu.php?action1=divertissement\">
                <div id=\"div\">
                    <div id=\"div2\">
                    Divertissement
                    </div>
                </div>
            </a>
            <a href=\"jeu.php?action1=sport\">
                <div id=\"sport\">
                    <div id=\"sport2\">
                    Sport
                    </div>
                </div>
            </a>
            </div>
            <a href=\"creation.php\">
            <div id=\"CQ\">
                Créer un questionnaire
        
            </div>
        </a>
        <a href=\"modif.php\">
            <div id=\"CD\">
                Changer vos données
            </div>
        </a>";
            }
            else{
            echo"        <div id=\"main\">
            <a href=\"logg.php\">
            <div id=\"art\">
                <div id=\"art2\">Art</div>
            </div>
        </a>
        <a href=\"logg.php\">
            <div id=\"histoire\">
                <div id=\"histoire2\">
                    Histoire Geographie
                </div>
            </div>
        </a>
        <a href=\"logg.php\">
            <div id=\"div\">
                <div id=\"div2\">
                Divertissement
                </div>
            </div>
        </a>
        <a href=\"logg.php\">
            <div id=\"sport\">
                <div id=\"sport2\">
                Sport
                </div>
            </div>
        </a>
        </div>
        <a href=\"logg.php\">
        <div id=\"CQ\">
            Créer un questionnaire
    
        </div>
    </a>
    <a href=\"logg.php\">
        <div id=\"CD\">
            Changer vos données
        </div>
    </a>";
            }
    }
    function affiche_bas(){
        echo "</body></html>";
    }

    //fonction qui va afficher le formulaire de connexion
    function formulaire_connexion($pseudo){
        echo "<fieldset>";
        echo "<form action=\"logg.php\" method=\"POST\"><table>
        <tr><td>Pseudo</td><td><input type=\"text\" name=\"pseudo\" value=\"".$pseudo."\"size=\"30\"></td></tr>
        <tr><td>Mot de passe</td><td><input type=\"password\" name=\"password\" size=\"30\"></td></tr>
        <tr><td><input type=\"submit\" name=\"valider\" size=\"15\" value=\"valider\"></td></tr></form>";
        echo "<tr><td><a href=\"inscription.php\">S'inscrire</a></td></tr></table>";
        echo "</fieldset>";
    }

    //fonction qui affiche le formulaire d'inscription
    function formulaire_inscription($pseudo, $email){
        echo "<fieldset>";
        echo "<form action=\"inscription.php\" method=\"POST\"><table>
        <tr><td>Pseudo</td><td><input type=\"text\" name=\"pseudo\" value=\"".$pseudo."\"size=\"30\"></td></tr>
        <tr><td>Adresse électronique</td><td><input type=\"email\" name=\"email\" value=\"".$email."\"size=\"30\"></td></tr>
        <tr><td>Mot de passe</td><td><input type=\"password\" name=\"password\" size=\"30\"></td></tr>
        <tr><td>Confirmer mot de passe</td><td><input type=\"password\" name=\"password2\" size=\"30\"></td></tr>
        <tr><td><input type=\"submit\" name=\"valider\" size=\"15\" value=\"valider\"></td></tr>";
        echo "</table></form></fieldset>";
    }
    
    //fonction qui affiche le formulaire de modification
    function formulaire_modification($pseudo){
        echo "<fieldset><form action=\"modif.php\" method=\"POST\"><table>";
        echo "<tr><td>Pseudo</td><td><input type=\"texte\" name=\"pseudo\" value=\"".$pseudo."\" size=\"15\"></td></tr>              
              <tr><td>Ancien mot de passe</td><td><input type=\"password\" name=\"password\" size=\"15\"></td></tr>
              <tr><td>Nouveau mot de passe</td><td><input type=\"password\" name=\"password2\" size=\"15\"></td></tr>
              <tr><td><input type=\"submit\" name=\"valider\" value=\"valider\" size=\"15\"></td></tr>";
        echo "</table></form></fieldset>";       
    }

    //formulaire pour la création d'un questionnaire
    function formulaire_questionnaire($nom){
        echo "<fieldset>";
        echo "<form action=\"creation.php\" method=\"POST\"><table>
        <tr><td>Nom du questionnaire</td><td><input type=\"text\" name=\"nom\" value=\"".$nom."\"size=\"30\"></td></tr>
        <tr><td>Catégorie</td>
            <td><select name=\"categorie\" size=\"1\">
                <option value=\"art\">Art</option>
                <option value=\"histoiregeo\">Histoire-géographie</option>
                <option value=\"divertissement\">Divertissement</option>
                <option value=\"sport\">Sport</option>
                </select></td></tr>
        <tr><td><input type=\"submit\" name=\"valider\" size=\"15\" value=\"valider\"></td></tr>";
        echo "</table></form></fieldset>";
    }

    //formulaire de bannissement
    function formulaire_admin(){
        echo "<fieldset><table><form action=\"admin.php\" method=\"POST\">";
        echo "<tr><td><select name=\"user\" size=\"1\">";
        liste_nom();  
        echo "</select></td></tr>";
        echo "<tr><td>Admin</td><td><input type=\"radio\" name=\"statut\" value=\"passeAdmin\"></td>
        <td>Bannir</td><td><input type=\"radio\" name=\"statut\" value=\"ban\"></td></tr>";
        echo "<tr><td><input type=\"submit\" name=\"valider\" value=\"valider\">";
       
    }


    //fonction qui traite le formulaire de connexion
    function traiter_formulaire_connexion(){
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            preTraiterChamp($_POST['pseudo']);
            preTraiterChamp($_POST['password']);
            if(empty($_POST['pseudo'])){ //Renvoie le formulaire car il manque au moins le pseudo
                echo "<div id=Error>Tous les champs n'ont pas été renseignés</div>";
                formulaire_connexion("");
    
            }else if(!empty($_POST['pseudo'] && empty($_POST['password']) )){
                //Renvoie le formulaire avec le pseudo déja renseigné
                echo "<div id=Error>Tu n'as pas renseigné ton mot de passe</div>";
                formulaire_connexion($_POST['pseudo']);
            }else{ //le formulaire a été correctement rempli
                connexion_site();
                
            }
        }else{
            echo "<div id=Error>Veuillez vous connecter</div> ";
            formulaire_connexion(''); //Affiche le formulaire quand on arrive sur la page
        }
    }

    //fonction qui va traiter le formule d'inscription
    function traiter_formulaire_inscription(){
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            preTraiterChamp($_POST['pseudo']);
            preTraiterChamp($_POST['email']);
            preTraiterChamp($_POST['password']);
            preTraiterChamp($_POST['password2']);
            if(empty($_POST['pseudo']) && empty($_POST['email'])){
                echo "<div id=Error>Tous les champs n'ont pas été renseignés</div>";
                formulaire_inscription("","");
            }else if(!empty($_POST['pseudo']) && empty($_POST['email'])){
                echo "<div id=Error>Tous les champs n'ont pas été renseignés</div>";
                formulaire_inscription($_POST['pseudo'],"");
            }else if(empty($_POST['pseudo']) && !empty($_POST['email'])){
                echo "<div id=Error>Tous les champs n'ont pas été renseignés</div>";
                formulaire_inscription("",$_POST['email']);
            }else if(!empty($_POST['pseudo']) && !empty($_POST['email']) && empty($_POST['password'])){   
                echo "<div id=Error>Le mot de passe n'a pas été renseigné</div>";
                formulaire_inscription($_POST['pseudo'],$_POST['email']); 
            }else{ //3 champs ont au moins été remplis
                if($_POST['password']!=$_POST['password2']){
                    echo "<div id=Error>Les deux mots de passe ne sont pas identiques</div>";
                    formulaire_inscription($_POST['pseudo'],$_POST['email']);
                }else{
                    enregistrer();
                }
            }    
        }else{
            formulaire_inscription('','');
        }
    }

    //fonction qui va traiter la modidication 
    function traiter_modif(){
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            preTraiterChamp($_POST['pseudo']);
            preTraiterChamp($_POST['password']);
            preTraiterChamp($_POST['password2']);
            if(empty($_POST['pseudo'])||empty($_POST['password'])||empty($_POST['password2'])){
                echo "<div id=Error>Veuillez saisir vos données</div>";
                formulaire_modification($_SESSION['pseudo']);
            }else{
                enregistrer_modif();
            }

        }else{
            formulaire_modification($_SESSION['pseudo']);
        }

    }

    //fonction qui traite le changement de statut
    function traiter_admin(){
        if($_SERVER['REQUEST_METHOD']=="POST"){
            if(empty($_POST['statut'])){
                formulaire_admin();
            }else{
                enregistrer_statut();
            }    
        }else{
            formulaire_admin();
        }
    }


    //fonction qui traite en amont le formulaire pour la création du questionnaire
    function traiter_questionnaire(){
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            preTraiterChamp($_POST["nom"]);
            preTraiterChamp($_POST["categorie"]);
            if(empty($_POST['nom'])){
                echo "<div id=Error>Il manque le nom du questionnaire</div>";
                formulaire_questionnaire("");
            }else{
                verifier_nom_questionnaire();                                         
                }
            
        }else{
            formulaire_questionnaire("");
        }
    }

    //formulaire de création de questions
    function creation_questions($question){
        echo "<fieldset>";
        echo "<form action=\"creation.php\" method=\"POST\"><table>
            <tr><td>Nom de la question</td><td><input type=\"text\" name=\"question\" value=\"".$question."\"size=\"30\"></td></tr>
            <tr><td>Réponse A</td><td><input type=\"text\" name=\"reponseA\" size=\"30\"></td></tr>
            <tr><td>Réponse B</td><td><input type=\"text\" name=\"reponseB\" size=\"30\"></td></tr>
            <tr><td>Réponse C</td><td><input type=\"text\" name=\"reponseC\" size=\"30\"></td></tr>
            <tr><td>Réponse D</td><td><input type=\"text\" name=\"reponseD\" size=\"30\"></td></tr>
            <tr><td>Bonne réponse</td>
                <td><select name=\"solution\" size=\"1\">
                    <option value=\"reponseA\">Reponse A</option>
                    <option value=\"reponseB\">Reponse B</option>
                    <option value=\"reponseC\">Reponse C</option>
                    <option value=\"reponseD\">Reponse D</option>
                </select></td></tr>
            <tr><td><input type=\"submit\" name=\"valider\" value=\"valider\" size=\"15\">
            <tr><td><input type=\"hidden\" name=\"nom\" value=\"".$_SESSION['nom']."\">
            <input type=\"hidden\" name=\"categorie\" value=\"".$_SESSION['categorie']."\"></td></tr>";
        echo "</table></form></fieldset>";
    }

    //fonction traitant le formulaire de création de questions
    function traiter_creation_questions(){

        echo "Question n°".$_SESSION['numero']."/5";
        if($_SERVER["REQUEST_METHOD"]=="POST"){            
            preTraiterChamp($_POST['question']);
            preTraiterChamp($_POST['reponseA']);
            preTraiterChamp($_POST['reponseB']);
            preTraiterChamp($_POST['reponseC']);
            preTraiterChamp($_POST['reponseD']);
            preTraiterChamp($_POST['solution']);
            if(empty($_POST['question'])){
                echo "<div id=Error>Veuillez saisir tous les champs</div>";
                creation_questions("");
            }else if(!empty($_POST['question'])&&(empty($_POST['reponseA'])||empty($_POST['reponseB'])||empty($_POST['reponseC'])||empty($_POST['reponseD']))){
                echo "<div id=Error>Veuillez saisir tous les champs</div>";
                creation_questions($_POST['question']);
            }else{                
                enregistrer_questions();
                
            }
        }else{            
            creation_questions("");
        }
    }    




    //fonction permettant de sécuriser la page en empechant les caractères spéciaux
    function preTraiterChamp($champ){
        if(!empty($champ)){
            $champ=trim($champ);
            $champ=htmlspecialchars($champ);
        }
        return $champ;
    }


?>