<!DOCTYPE html>
<html lang="fr">
  <?php $prenom = "Talody";
	$nom = "Aggouang";
	$n = "1";
	$y = date("d/m/y");
	$s = date("H:i:s");
	
	function lancer_de($a, $b){
	return rand($a, $b);
  }
  ?>
  
  <head>
    <meta charset="utf-8">
    <title>haha</title>
    <link rel ="stylesheet" href ="style<?php echo $n ?>.css">
    <style>
      td.case1{ color: rgb(0, 105, 105)0, 107, 107); }
      td.case2{ color: rgb(0, 105, 105)0, 107, 107); }
      td.case3{ color: rgb(0, 105, 105)0, 107, 107); }
      table{ border = 1; width: 50%;}
    </style>
  </head>
  
  <body>
    <h1>Premier Test PHP</h1>
    <p>Bonjour ! Je m'appelle <?php echo $prenom; echo " ";  echo $nom; ?>. Bienvenue !</p>
    <?php echo "Date : $y, Heure : $s" ?>
     <p></p>
    <?php echo lancer_de(1, 6) ?>

    <table>
      <tr>
        <td class="case<?php echo lancer_de(1, 3) ?>"></td>
        <td class="case<?php echo lancer_de(1, 3) ?>"></td>
      </tr>
      <tr>
        <td class="case<?php echo lancer_de(1, 3) ?>"></td>
        <td class="case<?php echo lancer_de(1, 3) ?>"></td>
      </tr>
      </table>


  </body>
</html> 
