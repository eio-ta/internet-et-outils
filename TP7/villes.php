<!DOCTYPE html>
<head>
  <title> Villes et villages des Vosges </title>
  <meta charset ="utf-8" />
  </head>
<body>


<?php
  //connexion au serveur:
  $connexion = mysqli_connect ("127.0.0.1","root","Cereale.123#E","base_1") ;
     
  if (!$connexion) {
    echo "Pas de connexion au serveur " ; exit ;
  }
  
  echo "Connexion réussie! <br/> " ;
  mysqli_set_charset($connexion, "utf8"); //pour que les caractères reçus soient codés en utf-8.
     
  //requête:
  $req = 'SELECT id, name FROM departements;' ; /* A COMPLÉTER */
  $resultat = mysqli_query ($connexion, $req ) ;
     
  if(!$resultat){ 
    echo "requête incorrecte";
    echo mysqli_error($connexion);
  }
  else {
    echo "<table><tr><td>ID</td><td>Nom</td><tr>";
  	function afficher_ligne($ligne) {
      echo "<tr>", "<td>".htmlspecialchars($ligne["id"])."</td>", "<td>".htmlspecialchars($ligne["name"])."</td>", "</tr>";
    }
    
    while ($ligne=mysqli_fetch_assoc( $resultat)) {
      afficher_ligne($ligne);
    }

    echo "</table>";
  };
  mysqli_close($connexion);
?>

</body >
</html >
