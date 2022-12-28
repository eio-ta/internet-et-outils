<!DOCTYPE html>
    <html lang="fr">

        <?php
        if (!isset($_GET[visites])) {
            $_GET[visites] = 1;
        } else {
            $_GET[visites]++;
        }
        ?>

        <head>
            <meta charset="utf-8">
            <title>compteur de visite</title>
        </head>
        <body>
            <h1>Bonjour, <br></h1>
            <h2>Vous avez visité cette page <?php echo $_GET[visites] ?> fois.</h2>
            <h3><a href="countGET.php?visites=<?php echo $_GET[visites]?>">Visitez à nouveau cette page !</a></h3><br><br>

            <?php if($_GET[visites] >= 1000){
                echo "« Félicitations ! Pour vous
                remercier de votre fidélité nous vous offrons 1000 euros ! »";
            } ?>


        </body>
    </html> 
