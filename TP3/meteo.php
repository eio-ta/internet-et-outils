<!DOCTYPE html>
<html lang="fr">
  <?php
  $a = 0;
  $b = 14;
  $c = lancer_de($a, $b);
  $d = phrase($c);
  function lancer_de($a, $b){
      return rand($a, $b);
    }
    function phrase($c){
        if($c == 0){
            return "Jour très ensoleillé";
        }
        if($c == 1){
            return "Jour ensoleillé, avec un peu de nuages";
        }
        if($c == 2){
            return "Jour ensoleillé, avec beaucoup de nuages";
        }
        if($c == 3){
            return "Jour nuageux, avec un peu de soleil";
        }
        if($c == 4){
            return "Jour nuageux";
        }
        if($c == 5){
            return "Un peu de pluie";
        }
        if($c == 6){
            return "Beaucoup de pluie";
        }
        if($c == 7){
            return "BEAUCOUP BEAUCOUP de pluie";
        }
        if($c == 8){
            return "Petit orage";
        }
        if($c == 9){
            return "Grand orage, attention aux tonnerres";
        }
        if($c == 10){
            return "Mélange de pluie et de neige";
        }
        if($c == 11){
            return "Jour neigeux";
        }
        if($c == 12){
            return "Attention à la grêle";
        }
        if($c == 13){
            return "Jour bizarre";
        }
        if($c == 14){
            return "Vents violents";
        }
    }
  ?>

  <head>
    <meta charset="utf-8">
    <title>haha</title>
    <link rel ="stylesheet" href ="style<?php echo $n ?>.css">
  </head>
  
  <body>
    <table>
        <tr>
            <td>Temps</td>
            <td>Description</td>
        </tr>
        <tr>
            <td><img src = "meteo/meteo<?php echo $c ?>.png"></td>
            <td><?php echo $d ?></td>
        </tr>
    </table>
  </body>
</html> 