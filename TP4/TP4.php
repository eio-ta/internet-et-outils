<DOCTYPE html>
  <html>
    <?php
      $tab1[0] = "case1";
      $tab1[1] = "case2";
      $tab2=array("case1", "case2");
      $mixte=array(a, 2, "hello");
      $tableau = array (
      0 => " toto " ,
    " 0 " => " titi " ,
    " 00 " => " tutu ");

    function add($x, $y){
    return $x+$y;
    }
    
    function ligne($n, $c){
      for($i=0; $i<$n; $i++){
	echo $c;
      }
      echo "<br>";
    }

    function pyra($n){
        if($n>10){
	   echo "Message d'erreur";
	} else {
           for($i=0; $i<$n ;$i++){
               echo ligne($i+1,"*");
	   }
	}
    }
		     
    function aryp($n){
        pyra($n);
        for($i=$n-1; $i>0; $i--){
            echo ligne($i,"*");
	}
	
    }

    function fofo($n){
        pyra($n);
        foreach(range($n-1, 1) as $i){
            echo ligne($i,"*");
	}
    }

    function PHP($tab){
	return count($tab);		   
    }

    function inverse ($tab){
      for($i=0; $i<PHP($tab); $i++){
	  $newTab[$i] = $tab[PHP($tab)-1-$i];
      }
       return $newTab;	
    }

    function union($tab1, $tab2){
			       foreach($tab1 as $k => $v){
	  if(isset($tab1, $k)){
	  echo erreur 404;
	  }
	  $tab1=$v;
	  }
	  return $tab1;
	  }

				 
    function question4($tab1, $tab2){
       $newTab = $tab1;
       $compteur = 0;
       for($i=PHP($tab1); $i<PHP($tab1)+PHP($tab2); $i++){
	   $newTab[$i] = $tab2[$compteur];	    
           $compteur++;
       }			    
       return $newTab;
    }

    $pays = array("Pays-Bas" => array("Amsterdam", "17,18 M", "Europe"), "Hollande"=> array("Amsterdam", "17,18 M", "Europe"), "Allemagne"=> array("Berlin", "82,79 M", "Europe"), "Canada"=> array("Ottawa","37,59 M","Amérique"));
    ?>
    
    
    <head>
      <meta charset="utf-8">
    </head>
    
    <body>
      <pre><?php print_r($tab1);
       print_r($tab2);
       print_r($mixte);
       print_r($tableau) ?></pre>
      <?php foreach($tab1 as $index => $valeur) {
      echo "La valeur associée à ", $index, " est ", $valeur, ". ";
      }
      echo add(1,2); echo add(1, "un"); echo add("un","un");
      ligne(4, "v");
      fofo(3);
      echo count($tab1);
      print_r(inverse($tab1));
      print_r(question4($tab1, $tab2));
      ?>
      
    </body>
    
  </html>
