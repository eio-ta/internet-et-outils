<!DOCTYPE html>
    <html lang="fr">

        <?php
        if(!isset($_POST['valider'])){
            $_POST['clé'] = 1;
        } else {
            $_POST['clé'] = $_POST['clé'] + 1;
        }

        ?>

        <head>
            <meta charset="utf-8">
            <title>compteur de visite</title>
        </head>
        <body>
        
            <h1>Bonjour, <br></h1>
            <h2>Vous avez visité cette page <?php echo $_POST['clé'] ?> fois.</h2>

            <form action="countPOST.php" method="post">
            <input type="submit" name="valider" value="Visitez à nouveau ce site !">
            <input type="hidden" name="clé" value="valeur">
            </form>

            <?php if($_POST['clé'] >= 1000){
                echo "« Félicitations ! Pour vous
                remercier de votre fidélité nous vous offrons 1000 euros ! »";
            }



            ?>
        </body>
    </html> 