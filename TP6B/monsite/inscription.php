<!DOCTYPE html>
<html>
   <head>
      <meta charset="ISO-8859-1" />
      <link rel="stylesheet" href="style.css"/>
   </head>
   <body>
      <fieldset>
         <form action="sauvegarde.php" method="post">
            <legend>Nouvel utilisateur</legend>
            
            <div class="label">Nom </div>
            <div class="champ">
               <input type="text" name="nom" />
            </div>

            <div class="label">Prénom</div>
            <div class="champ">
               <input type="text" name="prenom" />
            </div>

            <div class="label">Nom d'utilisateur</div>
            <div class="champ">
               <input type="text" name="utilisateur" />
            </div>

            <div class="label">Date de naissance</div>
            <div class="champ">
               <input type="date" name="date" />
            </div>

            <div class="label">Email</div>
            <div class="champ">
               <input type="email" name="email" />
            </div>

            <div class="label">Action</div>
            <div class="champ">
               <select name="action" size="1"> 
                  <option value="1"> Inscription</option>
                  <option value="2"> Modifier</option>
                  <option value="3"> Sauvegarder</option>
               </select>
            </div>
            <div class="champ">
               <input type="submit" name="valider" value="Valider l'inscription" />
            </div>
            </form>
   </fieldset>
   </body>
</html> 