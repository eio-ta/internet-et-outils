<?php 
    require_once('affichage.php');
    //connexion au serveur:
    function connexionDB(){
        $connexion=mysqli_connect("127.0.0.1","root","Cereale.123#E","base_1");

        if(!$connexion){
            echo "<div id=Error>Aucune connection établie</div>";
        }
        mysqli_set_charset($connexion, "utf8");
        return $connexion;
    } 

    //fonction permettant d'inscrire l'utilisateur dans la base de données
    function enregistrer(){
        $connex = connexionDB();

        $pseudo=mysqli_real_escape_string($connex,$_POST['pseudo']); 
        $email=mysqli_real_escape_string($connex,$_POST['email']); 
        $password=mysqli_real_escape_string($connex,$_POST['password']);
        $password=md5($password);
        
        $req="select * from users where pseudo='$pseudo'";
        $resultat=mysqli_query($connex,$req);
        if($resultat && mysqli_num_rows($resultat)==0){ //on vérifie qu'il n'y a pas 2 fois le même utilisateur
            mysqli_free_result($resultat);
            $req="insert into users (email,pseudo,password) values('$email','$pseudo','$password')";
            $resultat=mysqli_query($connex,$req);
            if($resultat){
                $_SESSION['pseudo']=$pseudo;
                $_SESSION['admin']=false;
                header('Location: logg.php');
                mysqli_close($connex); exit;
            }    
        }else if($resultat && mysqli_num_rows($resultat)>0){
            echo "<div id=Error>Le pseudo existe déjà </div>";
            formulaire_inscription("$pseudo","$email");
            mysqli_close($connex); exit;

        }else{
            mysqli_close($connex); exit;
        }
    }

    //Fonction vérifiant si l'utilisateur a saisi le bon mot de passe
    function connexion_site(){
        $connex=connexionDB();
       
        $pseudo=mysqli_real_escape_string($connex,$_REQUEST['pseudo']);
        $password=mysqli_real_escape_string($connex,$_REQUEST['password']);
        $password=md5($password);

        $req="select * from users where pseudo='$pseudo' and password='$password'";
        $resultat=mysqli_query($connex,$req);

        if($resultat && mysqli_num_rows($resultat)!=0){
            $_SESSION['pseudo']=$pseudo;
            $_SESSION['admin']=isAdmin($pseudo);
            header('Location: acceuil.php');
            mysqli_close($connex);exit;
        }else{
            echo "<div id=Error>Le mot de passe ne correspond pas au pseudo</div>";
            formulaire_connexion($pseudo);
            mysqli_close($connex);exit;
        }
    }

    //Fonction pour enregistrer les modifications d'un utilisateur
    function enregistrer_modif(){

        $connex=connexionDB();

        $pseudo=$_SESSION['pseudo'];
        $pseudo2=mysqli_real_escape_string($connex,$_POST['pseudo']);
        $password=mysqli_real_escape_string($connex,$_POST['password']);
        $password2=mysqli_real_escape_string($connex,$_POST['password2']);
 
        $password=md5($password);
        $password2=md5($password2);

        $req = "select password from users where pseudo='$pseudo'"; //on vérifie que le mot de passe entré est bien celui de l'utilisateur
        $resultat=mysqli_query($connex,$req);
        $ligne=mysqli_fetch_assoc($resultat);

        if($resultat && $ligne['password']==$password){
            mysqli_free_result($resultat);

            $req="select * from users where pseudo='$pseudo2'"; //on vérifie que le nouveau pseudo n'est pas existent
            $resultat=mysqli_query($connex,$req);            

            if($resultat && mysqli_num_rows($resultat)==0){
                mysqli_free_result($resultat);
                $req="update users set pseudo='$pseudo2', password='$password2' where pseudo='$pseudo'";
                $resultat=mysqli_query($connex,$req);
                if($resultat){
                    mysqli_close($connex);
                    unset($_SESSION['pseudo']);
                    $_SESSION['pseudo']=$pseudo2;
                    header('Location: acceuil.php');
                }
            }else{
                echo "<div id=Error>Le pseudo est déja pris</div>";
                formulaire_modification($_SESSION['pseudo']);
                mysqli_close($connex);
                exit;
            }

            
        }else{
            echo "<div id=Error>Il ne s'agit pas du bon mot de passe</div>";
            formulaire_modification($_SESSION['pseudo']);
            mysqli_close($connex);exit;
        }
    }
    
    function enregistrer_statut(){
        $connex = connexionDB();

        $user=mysqli_real_escape_string($connex,$_POST['user']);
        $statut=mysqli_real_escape_string($connex,$_POST['statut']);

        $req="select * from users where pseudo='$user'";
        $resultat=mysqli_query($connex,$req);

        if($resultat){
            if($statut=="ban"){
                if(isAdmin($user)==true){
                    echo "<div id=Error>Vous ne pouvez pas bannir un autre administrateur</div>";
                    mysqli_close($connex);
                    formulaire_admin();
                }else{
                    mysqli_free_result($resultat);
                    $req="delete from users where pseudo='$user'";
                    $resultat=mysqli_query($connex,$req);
                    if($resultat){
                        echo "<div id=Error>Vous avez banni ".$user."</div>";
                        mysqli_close($connex);
                        formulaire_admin();
                    }else{
                        echo "<div id=Error>Probleme de base de données</div>";
                        mysqli_close($connex);
                        formulaire_admin(); 
                    }        
                }                
            }else{ 
                if(isAdmin($user)==true){
                    echo "<div id=Error>Cet utilisateur est déjà admin</div>";
                    mysqli_close($connex);
                    formulaire_admin();
                }else{
                    mysqli_free_result($resultat);
                    $req="update users set admin=1 where pseudo='$user'";
                    $resultat=mysqli_query($connex,$req);
                    if($resultat){
                        echo "<div id=Error>".$user." vient de passer administrateur</div>";
                        mysqli_close($connex);
                        formulaire_admin(); 
                    }else{
                        echo "<div id=Error>Problème de base de donées</div>";
                        mysqli_close($connex);
                        formulaire_admin();
                    }
                }
            }

        }else{
            mysqli_close($connex);exit;
        }
    }


    //On vérifie que le nom du questionnaire n'existe déjà pas
    function verifier_nom_questionnaire(){
        $connex = connexionDB();

        $nom=mysqli_real_escape_string($connex,$_POST['nom']);
        $cat=mysqli_real_escape_string($connex,$_POST['categorie']);

        $req="select * from questions where nom='$nom'";
        $resultat=mysqli_query($connex,$req);

        if($resultat && mysqli_num_rows($resultat)==0){
            unset($_SESSION['erreur']);
            $_SESSION['nom']=$nom;
            $_SESSION['categorie']=$cat;
            $_SESSION['numero']=1;
            mysqli_close($connex);
            header('Location: creation.php');
            exit;
        }else{
            $_SESSION['numero']=0;
            $_SESSION['erreur']="<div id=Error>Le nom du questionnaire existe déjà</div>";
            header('Location: creation.php');
            mysqli_close($connex);
            exit;
        }


    }

    function enregistrer_questions(){
       
        $connex=connexionDB();

        $nom=mysqli_real_escape_string($connex,$_SESSION['nom']);
        $cat=mysqli_real_escape_string($connex,$_SESSION['categorie']);
        $createur=$_SESSION['pseudo'];
        $question=mysqli_real_escape_string($connex,$_POST['question']);
        $reponseA=mysqli_real_escape_string($connex,$_POST['reponseA']);
        $reponseB=mysqli_real_escape_string($connex,$_POST['reponseB']);
        $reponseC=mysqli_real_escape_string($connex,$_POST['reponseC']);
        $reponseD=mysqli_real_escape_string($connex,$_POST['reponseD']);
        $solution=mysqli_real_escape_string($connex,$_POST['solution']);

         if($_SESSION['numero']>0 && $_SESSION['numero']<5){
            $req = "insert into questions(categorie,nom,createur,question,reponseA,reponseB,reponseC,reponseD,solution) values('$cat','$nom','$createur','$question','$reponseA','$reponseB','$reponseC','$reponseD','$solution')";
            $resultat=mysqli_query($connex,$req);
            
            if($resultat){
                $_SESSION['numero']++;
                mysqli_close($connex);
                header('Location: creation.php');
                exit;
                            
            }else{
                echo "<div id=Error>La question n'a pas pu être enregistré, veuillez ressaisir les données</div>";
                mysqli_close($connex);exit;
                
            }

        }else{
            $req = "insert into questions(categorie,nom,createur,question,reponseA,reponseB,reponseC,reponseD,solution) values('$cat','$nom','$createur','$question','$reponseA','$reponseB','$reponseC','$reponseD','$solution')";   
            $resultat=mysqli_query($connex,$req);

            if($resultat){
                echo "<div id=G>Bravo, vous avez terminé la création de votre questionnaire!
                <br>Vous pouvez à présent revenir à la page principale en cliquant<a href=\"acceuil.php\"> ici</a></div>";
                unset($_SESSION['numero']);
                mysqli_close($connex);exit;
                
            }else{
                echo "<div id=Error>La question n'a pas pu être enregistré, veuillez ressaisir les données</div>";
                mysqli_close($connex);exit;
                
            }
        }
        
    }

    //fonction affichant tous les formulaires d'une catégorie
    function which_cat($cat){
        $connex = connexionDB(); 
        
        $req="select distinct nom,createur from questions where categorie='$cat'";
        $resultat=mysqli_query($connex,$req);

        if($resultat){
            echo "<fieldset><table>";
            while($ligne=mysqli_fetch_assoc($resultat)){
                echo "<tr><td><a href=\"jeu.php?action2=".$ligne['nom']."\">".$ligne['nom']."</a></td><td>de ".$ligne['createur']."</td></tr>";
            }
            echo "</table></fieldset>";
            $_SESSION['cat']=$cat;
        }else{
            echo "<div id=Error>Aucune table existente</div>";
        }
        mysqli_close($connex);exit;
    }

    function which_subcat($sub){
        $_SESSION['sub']=$sub;
        header('Location: jeu.php?questions=1');
    }

    function select_questions(){
        $connex=connexionDB();

        $cat=$_SESSION['cat'];
        $sub=$_SESSION['sub'];

        $req="select question from questions where categorie='$cat' and nom='$sub'";

        $resultat=mysqli_query($connex,$req);

        if($resultat){
            $i=1;
            while($ligne=mysqli_fetch_assoc($resultat)){
                $_SESSION['question'.$i]=$ligne['question'];  
                $i++;                    
            }
            mysqli_close($connex);
            afficher_questions(1);
            
        }else{
            echo "<div id=Error>Problème avec la base de données</div>";
            unset($_SESSION['cat']);
            unset($_SESSION['sub']);
            mysqli_close($connex);
            exit;
        }



    }

    function afficher_questions($numero){
        
        $connex=connexionDB();
        $c=$numero-1;
        $question=$_SESSION['question'.$c];
        $cat=$_SESSION['cat'];
        $sub=$_SESSION['sub'];

        $req="select * from questions where categorie='$cat' and nom='$sub' and question=\"$question\"";
        $resultat=mysqli_query($connex,$req);

        if($resultat){
            $ligne=mysqli_fetch_assoc($resultat);
            mysqli_free_result($resultat);
            if($_SERVER["REQUEST_METHOD"]=="POST"){
                if($_POST['proposition']==$ligne['solution']){
                    echo "<div id=G>Vous avez trouvé la bonne réponse</div>";
                }else{
                    echo "<div id=Error>Il s'agit de la mauvaise réponse</div>";
                }
                if($numero>5){
                    unset($_SESSION['cat']);
                    unset($_SESSION['sub']);
                    mysqli_close($connex);
                    echo "<a href=\"acceuil.php\"><div id=G>Revenir à l'acceuil</div></a>";
                    exit;
                }    
                
            }
            
            $question=$_SESSION['question'.$numero];
            $req="select * from questions where categorie='$cat' and nom='$sub' and question=\"$question\"";
            $resultat=mysqli_query($connex,$req);
            
            if(!$resultat){
                echo $question;
                echo $numero;
                mysqli_close($connex);exit;
            }
                $ligne=mysqli_fetch_assoc($resultat);
                $increment=$numero+1;               
                echo "<fieldset><table><form action=\"jeu.php?questions=$increment\" method=\"POST\">";
                echo "<tr><td>".$ligne['question']."</td></tr>";
                echo "<tr><td>".$ligne['reponseA']."<input type =\"radio\" name=\"proposition\" value=\"reponseA\" checked></td></tr>
                    <tr><td>".$ligne['reponseB']."<input type=\"radio\" name=\"proposition\" value=\"reponseB\" ></td></tr>
                    <tr><td>".$ligne['reponseC']."<input type =\"radio\" name=\"proposition\" value=\"reponseC\" ></td></tr>
                    <tr><td>".$ligne['reponseD']."<input type=\"radio\" name=\"proposition\" value=\"reponseD\" ></td></tr>";
                echo "<tr><td><input type=\"submit\" name=\"valider\" value=\"valider\"></td></tr>";
                echo "</form></table></fieldset>";
                
                
            
        }else{
            echo "<div id=Error>Problème avec la base de données</div>";
            mysqli_close($connex);
            exit;
        }

        
    }

    //Fonction qui affiche tous les noms des utilisateurs
    function liste_nom(){
        $connex=connexionDB();

        $req="Select * from users";
        $resultat=mysqli_query($connex,$req);

        if($resultat){
            while($ligne=mysqli_fetch_assoc($resultat)){
                echo "<option value=\"".$ligne['pseudo']."\">".$ligne['pseudo']."</option>";
            }
            mysqli_close($connex);

        }else{
            mysqli_close($connex);
            exit;
        }
    }

    //Permet de savoir si un utilisateur est un admin ou pas
    function isAdmin($pseudo){
        $connex=connexionDB();

        $req="select * from users where pseudo='$pseudo'";
        $resultat=mysqli_query($connex,$req);
        if($resultat){
            $ligne=mysqli_fetch_assoc($resultat);
            if($ligne['admin']=='0'){
                mysqli_close($connex); return false;
            }
            mysqli_close($connex); return true;    
        }else{
            echo mysqli_error($connex);
        }
    }



?>
