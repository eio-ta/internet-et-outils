<!DOCTYPE html>
    <html lang="fr">
        <?php
        if(!isset($_COOKIE['clé'])){
            setcookie('clé',1, time () + 3600);
        } else {
            setcookie('clé', $_COOKIE['clé']+1, time () + 3600);
        }
        ?>

        <head>
            <meta charset="utf-8">
            <title>compteur de visite</title>
        </head>
        <body>
        
            <h1>Bonjour, <br></h1>
            <h2>Vous avez visité cette page <?php echo $_COOKIE['clé'] ?> fois.</h2>

            <?php if($_COOKIE['clé'] >= 1000){
                echo "« Félicitations ! Pour vous
                remercier de votre fidélité nous vous offrons 1000 euros ! »";
            }



            ?>
        </body>
    </html> 