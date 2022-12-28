<?php
    require_once"affichage2.php";
    
    function connexion_bd() {
        $serv ="127.0.0.1";
        $username = "root";
        $pwd = "Cereale.123#E";
        $bd ="base_1";
        
        $connex = mysqli_connect($serv, $username, $pwd, $bd);
        
        if (! $connex) {
            page_erreur(ERR_CONNEX, mysqli_error($connex));
            exit;
        }
        
        return $connex;
    }
    
    function enregistrer($donnees) {
        $connex = connexion_bd();
        $nom = mysqli_real_escape_string($connex,$donnees['prenom']);
        $prenom = mysqli_real_escape_string($connex,$donnees['nom']);
        $login = mysqli_real_escape_string($connex,$donnees['login']);
        $mdp = mysqli_real_escape_string($connex,$donnees['password']);
        $mdp = password_hash($mdp, PASSWORD_DEFAULT);
        $req = "select * from users where nickname ='$login'";
        $resultat = mysqli_query($connex, $req);
       
        if($resultat && mysqli_num_rows($resultat) == 0) {
            mysqli_free_result($resultat);
            $req = "insert into users (lastname, firstname, nickname, password) values ('$nom', '$prenom', '$login', '$mdp');";
            $resultat = mysqli_query($connex, $req);
            if ($resultat) {
                mysqli_close($connex);
                return;
            }
        }
        
        if (!$resultat) {
            page_erreur(ERR_REQUETE, mysqli_error($connex));
        }
        elseif (mysqli_num_rows($resultat) > 0) {
            echo "L'identifiant a déjà été utilisé. Veuillez changer votre identifiant.";
            page_inscription($donnees);       
        }
        
        mysqli_close($connex);
        exit;
    }

    
?>