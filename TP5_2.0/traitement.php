<?php
    $t = array("prénom"=>"Bob", "nom"=>"Leponge", "gender"=>"homme", "password"=>"patrick");
    $a = "affichage.php";
    $b = "Clique ici pour continuer !";
    $t1 = array("prénom"=>$_GET[prénom], "nom"=>$_GET[nom], "gender"=>$_GET[gender]);

    function passeTabPage($uri, $tab){
        $b = $b.$uri."?";
        foreach($tab as $index => $val){
            $b = $b.$index."=".$val."&";
        }
        $b = substr($b,0, strlen($b)-1);
        return $b;
    }

    function lien($text, $uri){
        echo "<a href=$uri>$text</a>";
    }

    //echo passeTabPage($a, $t), "<br>";
    echo "Récupitulatif des données :  ";
    print_r($t1);
    echo "<br>";
    echo lien("Revenir en Arrière", passeTabPage("formulaire.html", $_POST)), "<br>";
    echo lien("Continuer", passeTabPage("affichage.php", $_POST)), "<br>";




?>