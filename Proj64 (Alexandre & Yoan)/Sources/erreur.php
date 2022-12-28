<?php 
    //fichier regroupant l'ensemble des fonctions servant au calcul des erreurs et protégeant des injections html


    function traiter (&$donne){ //fonction protégeant des injections html
        foreach($donne as $ind => $val){
            if(!is_array($donne[$ind])){
                $donne[$ind]=htmlspecialchars($val);
            }
        }
    }
    function erreur_requis ($donne,&$erreur){ //fonction permettant de remplir le tableau erreur_requis et renvoie un booléen (vrai = pas d'erreur)
        global $requis;
        $ok=true;
        foreach($requis as $ind => $val){
            if(empty($donne[$ind])){
                $ok=false;
                $erreur[$ind]=true;
            }
        }
        return $ok;
    }
    function erreur_format ($donne){ //fonction permettant de vérifier le format d'un mdp (au moins 5 caractères, une majuscule, un chiffre), renvoie un booléen (vrai = bon format)
        if(isset($donne["password"])){
            return preg_match("#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])#", $donne["password"]) && strlen($donne["password"]) >= 5;
        }
        return false;
    }
    function erreur_mdp ($donne){ //fonction qui vérifie si les 2 mdp sont les mêmes, renvoie un booléen (vrai = il y a une erreur )
        if(isset($donne["password"])&&isset($donne["repassword"])){
            return $donne["password"]!=$donne["repassword"];
        }
        return true;
    }
    function erreur_pseudo ($donne,$connect){ //fonction qui permet de savoir si le pseudo a déjà été pris, renvoie un booléen (vrai = il y a une erreur)
        if(isset($donne["pseudo"])){
            if(déja_lui($donne["pseudo"],$connect)){ //déja_lui est une fonction qui renvoie un booléen disant si le pseudo est déja dans la base de données (vrai = il est déjà dans la base de données)
                return true;
            }else{
                return false;
            }
        }
        return false;
    }
    function erreur_format_pseudo ($donne,&$erreur){ // génère un message d'erreur si les suites de caractères "|@$|" ou "|#@|" sont dans le pseudo rentré par l'utilisateur
        if(isset($donne["pseudo"])){
            for($i=0; $i<strlen($donne["pseudo"])-3; $i++){
                if(substr($donne["pseudo"],$i,4)=="|@$|" || substr($donne["pseudo"],$i,4)=="|#@|"){
                    $erreur["pseudo"]='Erreur "|@$|" et "|#@|" ne sont pas autorisés';
                }
            }
        }
    }
    function erreur_nom_paquet ($iduser, $donne, $connect){ //fonction qui permet savoir si l'utilisateur a déjà utilisé ce nom de paquet, renvoie un booléen (vrai = il y a une erreur)
        if(isset($donne["nompaquet"])){
            return paquet_existe($iduser, $donne["nompaquet"],$connect);
        }
        return false;
    }
    function erreur ($donne,$erreur_requis,$erreur_mdp,$erreur_format,$erreur_pseudo){ //fonction renvoyant un tableau $erreur contenant les messages d'erreurs (utilisée lors de l'inscription, et de la page de profil)
        if($erreur_format){
            $erreur["password"]="Il faut une majuscule, une minuscule, un chiffre et en tout au moins 5 caractères";
        }
        if($erreur_pseudo){
            $erreur["pseudo"]="Ce pseudo est déjà pris";
        }
        if($erreur_mdp){
            $erreur["repassword"]="Ce n'est pas les mêmes mot de passe";
        }
        foreach($erreur_requis as $ind => $val){
            $erreur[$ind]="Ce champs est requis";
        }
        return $erreur;
    }
    function erreur_modif_mdp ($donne,$erreur_requis,$erreur_mdp,$erreur_format,$erreur_oldmdp){ //fonction renvoyant un tableau $erreur contenant les messages d'erreurs (utilisée llors de la page de profil lors du changement de mdp)
        if($erreur_format){
            $erreur["password"]="Il faut une majuscule, une minuscule, un chiffre et en tout au moins 5 caractères";
        }
        if($erreur_oldmdp){
            $erreur["oldpassword"]="Ce n'est pas votre mot de passe";
        }
        if($erreur_mdp){
            $erreur["repassword"]="Ce n'est pas les mêmes mot de passe";
        }
        foreach($erreur_requis as $ind => $val){
            $erreur[$ind]="Ce champs est requis";
        }
        return $erreur;
    }
    function erreur_log ($donne,$erreur_requis){ //fonction renvoyant un tableau $erreur contenant les messages d'erreurs (utilisée lors du login)
        foreach($erreur_requis as $ind => $val){
            $erreur[$ind]="Ce champs est requis";
        }
        return $erreur;
    }
    function erreur_paquet (&$erreur, $erreur_requis, $oknom){ //fonction renvoyant un tableau $erreur contenant les messages d'erreurs (utilisée lors de la création d'un paquet)
        foreach($erreur_requis as $ind => $val){
            $erreur[$ind]="Ce champs est requis";
        }
        if(!$oknom){
            $erreur["nompaquet"] = "Ce paquet existe déjà";
        }
    }
    function erreur_reponse_qcm(&$erreur, $erreur_requis){ //fonction renvoyant un tableau $erreur contenant les messages d'erreurs (utilisée lors de la création de cartes de type qcm)
        foreach($erreur_requis as $ind => $val){
            $erreur[$ind]="Ce Champs est requis";
        }
    }
    
    function erreur_format_form($donne, &$erreur){ // fonction vérifiant si le format de la réponse est bon (pas de |@$| ou |#$| car peut provoquer erreur plusieurs autres de nos fonctions)
        foreach($donne as $reponse => $val){
            for($i=0; $i<strlen($donne[$reponse])-3; $i++){
                if(substr($donne[$reponse],$i,4)=="|@$|" || substr($donne[$reponse],$i,4)=="|#@|"){
                    $erreur[$reponse]='Erreur "|@$|" et "|#@|" ne sont pas autorisés';
                }
            }
        }
    }
    function erreur_reponse_normal($erreur_requis,&$erreur){ //fonction renvoyant un tableau $erreur contenant les messages d'erreurs (utilisée lors de la création de cartes de type question ouverte)
        foreach($erreur_requis as $ind => $val){
            $erreur[$ind]="Ce Champs est requis";
        }
    }

?>