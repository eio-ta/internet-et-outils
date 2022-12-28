<?php
    require_once"affichage.php";
    
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
    
    function lire_ville($connex) {
        $req = "select id, name from cities";
        $resultat = mysqli_query($connex, $req);
        if (!$resultat) {
            page_erreur(ERR_REQUETE, mysqli_error($connex));
            mysqli_close($connex);
            exit;
        }
    return $resultat;
    }

    function lire_departement($connex) {
        $req = "select id, name from departements";
        $resultat = mysqli_query($connex, $req);
        if(!$resultat) {
            page_erreur(ERR_REQUETE, mysqli_error($connex));
            mysqli_close($connex);
            exit;
        }
        return $resultat;
    }

    function lire_villes_du_departement_choisi($connex, $departement_id) {
        $req = "select id, name from cities where departement_id=\"$departement_id\"";
        $resultat = mysqli_query($connex, $req);
        if(!$resultat) {
            page_erreur(ERR_REQUETE, mysqli_error($connex));
            mysqli_close($connex);
            exit;
        }
        return $resultat;
    }
    
    ?>