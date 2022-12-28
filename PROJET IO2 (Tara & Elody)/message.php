<?php 
    require_once("fonc_authent.php");
    require_once("fonc_sortie.php");

    session_start();
    $login = $_SESSION['user'];

    //Cette page affiche le formulaire de signalement de questions.

    $question = $_POST['question'];
    $auteur = $_POST['auteur'];


    //Si ($_POST['go']) n'existe pas alors il affiche le formulaire.
    if(!isset($_POST['go'])) {
        afficher_entete("Signalement");
        afficher_contenu_entete_log($login);
        ?>

        <div class="titre">
            <p>Signaler une erreur</p>
        </div><br><br>

        <p>
            <form action="message.php" method="post">
                Émetteur <input type="text" name="identifiant" value="<?php echo $login?>" readonly="readonly"><br><br>
                Question concernée <input type="text" name="question" value="<?php echo $question?>" readonly="readonly"><br><br>
                Auteur  <input type="text" name="auteur" value="<?php echo $auteur?>" readonly="readonly"><br><br>
                <label>Tape ton message ici : </label><br><br>
                <textarea rows="30" cols="50" name="message"></textarea><br><br>
                <input type="submit" name="go" value="Envoyer">
            </form>
            </p>

        <?php
        afficher_pied_page();
        exit;
    } else { //Sinon il envoie le message de signalement du tableau $_POST.
        $donnees = $_POST;
        afficher_entete("Erreur");
        afficher_contenu_entete_log($login);
        enregistrer_message($donnees);
        echo "<p><span style=\"color:#45207D; font-size:20px;\"><strong>LE MESSAGE A ÉTÉ ENVOYÉ.</em></span><br><br><br></p>";
        afficher_pied_page();
    }




    
?>
