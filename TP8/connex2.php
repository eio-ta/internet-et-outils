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

    function lire_users($connex, $real) {
        $real = mysqli_real_escape_string($connex,$real);
        $req = "select * from users where nickname = '".$real."'";
        $resultat = mysqli_query($connex, $req);
        if (!$resultat) {
            page_erreur(ERR_REQUETE, mysqli_error($connex));
            mysqli_close($connex);
            exit;
        }
        return $resultat;
    }

    function lire_ville($connex) {
        $req = "select name from cities";
        $resultat = mysqli_query($connex, $req);
        if (!$resultat) {
            page_erreur(ERR_REQUETE, mysqli_error($connex));
            mysqli_close($connex);
            exit;
        }
    return $resultat;
    }


    function lire_users_par_ville($connex, $real) {
        $real = mysqli_real_escape_string($connex,$real);
        $req = "select * from users where city = '".$real."' order by nickname";
        $resultat = mysqli_query($connex, $req);
        if (!$resultat) {
            page_erreur(ERR_REQUETE, mysqli_error($connex));
            mysqli_close($connex);
            exit;
        }
        return $resultat;
    }
    
    function enregistrer($donnees) {
        $connex = connexion_bd();
        $nom = mysqli_real_escape_string($connex,$donnees['nom']);
        $prenom = mysqli_real_escape_string($connex,$donnees['prenom']);
        $login = mysqli_real_escape_string($connex,$donnees['login']);
        $city = mysqli_real_escape_string($connex,$donnees['city']);
        $mdp = mysqli_real_escape_string($connex,$donnees['password']);
        $req = "select * from users where nickname ='$login'";
        $resultat = mysqli_query($connex, $req);
       
        if($resultat && mysqli_num_rows($resultat) == 0) {
            mysqli_free_result($resultat);
            $req = "insert into users (lastname, firstname, nickname, city, password) values ('$nom', '$prenom', '$login', '$city', '$mdp');";
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

    function verifier_si_admin($nom) {
        $connex = connexion_bd();
        $req = "select admin from users where nickname = '".$nom."'";
        $resultat = mysqli_query($connex, $req);
        if($resultat) {
            $ligne = mysqli_fetch_assoc ($resultat);
            if ($ligne['admin'] == "OUI") return true;
            if ($ligne['admin'] == "NON") return false;
        }
        if (!$resultat) {
            page_erreur(ERR_REQUETE, mysqli_error($connex));
            mysqli_close($connex);
            return;
        }
    }

    function lire_login($connex, $login, $mdp) {
        $login = mysqli_real_escape_string($connex,$login);
        $mdp = mysqli_real_escape_string($connex,$mdp);
        $req = "select * from users where nickname = '$login' AND password = '$mdp'";
        $resultat = mysqli_query($connex, $req);
        if (!$resultat) {
            page_erreur(ERR_REQUETE, mysqli_error($connex));
            mysqli_close($connex);
            exit;
        }
        return $resultat;
    }

    
?>