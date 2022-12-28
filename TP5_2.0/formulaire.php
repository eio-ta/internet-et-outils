<!DOCTYPE html>
<html lang="fr">
    <?php
        include(cours.php);
        include(style.php);
    ?>
    <head>
        <meta charset="utf-8">
        <title>Formulaire</title>
        <link rel="stylesheet" href="style1.css" />
    </head>

    <body>
        <form action="affichage.php" method="get">
        <table border=3>
            <tr>
                <td>Prénom (*)</td>
                <td><input type="text" name="prénom" size="12"></td>
            </tr>

            <tr>
                <td>Nom (*)</td>
                <td><input type="text" name="nom" size="12"></td>
            </tr>

            <tr>
                <td>Date de Naissance </td>
                <td><input type="date" name="date" size="12"></td>
            </tr>

            <tr>
                <td>Numéro d'étudiant (*)</td>
                <td><input type="number" name="number" size="12"></td>
            </tr>

            <tr>
                <td>Sexe </td>
                <td>Masculin<input type="radio" name="gender" value="m"><br>Féminin<input type="radio" name="gender" value="f"></td>
            </tr>

            <tr>
                <td>Courriel </td>
                <td><input type="email" name="email" size="12"></td>
            </tr>

            <tr>
                <td>Téléphone </td>
                <td><input type="tel" name="tel" size="12"></td>
            </tr>

            <tr>
                <td>Outil préféré</td>
                <td><select name="outil" size="1">
                <option> HTML
                <option> css
                <option> PHP
                </select></td>
            </tr>

            <tr>
                <td>Vous aimez ce cours ?</td>
                <td>Oui <input type="radio" name="yesorno" value="y" checked><br> Non <input type="radio" name="yesorno" value="n"></td>
            </tr>

            <tr>
                <td>Cours Choisis </td>
                <td><?php include'cours.php'?><br></td>
            </tr>

            <tr>
                <td>Commentaires </td>
                <td><textarea name="texte" size="12" rows="10" cols="40"></textarea><br></td>
            </tr>

            <tr>
                <td>Style préféré <span style="font-size: x-small">(le 1 est le meilleur)</span></td>
                <td><?php include'style.php'?></td>
            </tr>

            <tr>
                <td>Mot de Passe (*)</td>
                <td><input type="password" name="mdp" size="12"></td>
            </tr>

            <tr>
                <td>Confirmation du mot de Passe (*)</td>
                <td><input type="password" name="mdp2" size="12"></td>
            </tr>

        </table>
        <br>
        <input type="submit" name="valider" value="Valider">
        <input type="reset" name="annuler" value="Annuler"><br><br>
        </form>

        <h5>(*) est un champ obligatoire.</h5>
    </body>

</html>