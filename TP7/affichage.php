<?php
    define('ERR_CONNEXION', 0);
    define ('ERR_REQUETE', 1);
    
    function afficher_entete($titre) {
        ?> <html>
        <head>
        <title><?=$titre?></title>
        <meta charset="utf-8" >
        <link rel="stylesheet" type="text/css" href="style1.css">
        </head>
        <body>
        <?php
    }
    
    function afficher_pied_page() {
        echo"</body></html>";
    }

    function afficher_ligne($ligne) {
        echo "<tr>", "<td>".htmlspecialchars($ligne["id"])."</td>", "<td>".htmlspecialchars($ligne["name"])."</td>", "</tr>";
    }

    function afficher_table ($villes) {
        ?>
        <table>
        <tr><th>ID</th>
        <th>Nom de la ville</th>
        <th></th></tr>

        <?php
        
        while($ligne = mysqli_fetch_assoc($villes)) {
            afficher_ligne($ligne);
        }
        echo"</table>";
    }

    function liste_deroulante($departements) {
        echo "<option>".htmlspecialchars($departements["name"])," (",htmlspecialchars($departements["id"]),") ";
    }
    
    function formulaire($departements) {
        ?>
       <form action="requete.php" method="post">
       <select name="nom" size="1">
        <?php
        while($ligne= mysqli_fetch_assoc($departements)) {
            liste_deroulante($ligne);
        }
        echo "</select>";
        echo "<input type=\"submit\"></form>";
    
    }

    //LES VUES

    function page($departements) {
        afficher_entete("Départements");
        echo "<h1>Requête :</h1><h3>Veuillez sélectionner un département.</h3>";
        formulaire($departements);
        afficher_pied_page();
    }

    function page2($nom, $departement_choisi, $departements) {
        afficher_entete("Villes");
        echo "<h1>Villes du département de ", $nom, " :</h1>";
        echo "<br><br>";
        afficher_table($departement_choisi);
        echo "<br><br>";
        echo "<h1>Autre requête :</h1><h3>Veuillez sélectionner un département.</h3>";
        formulaire($departements);
        echo "<br><br><br><br>";
        afficher_pied_page();
    }
    
    function page_erreur($err_code, $error) {
        afficher_entete("Erreur");
        switch ($err_code) {
            case ERR_CONNEXION: echo"<h2>Desolé, connexion impossible</h2>"; break;
            case ERR_REQUETE: echo"<h2>Erreur dans l'execution de la 73requete</h2>"; break;
        }
        echo"<p>".$error."</p>";
        afficher_pied_page();
    }

?>