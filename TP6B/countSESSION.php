<!DOCTYPE html>
    <html lang="fr">

    <?php
    session_start();
    if (!isset($_SESSION[visites])) {
        $_SESSION[visites] = 0;
    } else {
        $_SESSION[visites]++;
    }
    ?>

        <head>
            <meta charset="utf-8">
            <title>compteur de visite</title>
        </head>
        <body>
            <h1>Bonjour, <br></h1>
            <h2>Vous avez visité cette page <?php echo $_SESSION[visites] ?> fois</h2>
            <h3><a href="countSESSION.php">Visitez à nouveau cette page !</a></h3><br><br>

            <?php if($_SESSION[visites] >= 1000){
                echo "« Félicitations ! Pour vous
                remercier de votre fidélité nous vous offrons 1000 euros ! »";
            } ?>


        </body>
    </html> 