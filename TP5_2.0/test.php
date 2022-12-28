<?php
   @$civilite=$_POST["civilite"];
   @$nom=$_POST["nom"];
   @$prenom=$_POST["prenom"];
   @$email=$_POST["email"];
   @$pass=$_POST["pass"];
   @$repass=$_POST["repass"];
   @$valider=$_POST["valider"];
   
   if(isset($valider)){
      if(empty($nom))
         $message='<div class="erreur">Nom laissé vide.</div>';
      elseif(empty($prenom))
         $message='<div class="erreur">Prénom laissé vide.</div>';
      elseif(empty($email))
         $message='<div class="erreur">Email laissé vide.</div>';
      elseif(empty($pass))
         $message='<div class="erreur">Mot de passe laissé vide.</div>';
      elseif($pass!=$repass)
         $message='<div class="erreur">Les mots de passe ne sont pas identiques.</div>';
      else{
         $message='<div class="rappel"><b>Rappel:</b><br />';
         $message.=$civilite.' '.ucfirst(strtolower($prenom)).' '.strtoupper($nom).'<br />';
         $message.='Email: '.$email;
         $message.='</div>';
      }
   }
?> 
<!DOCTYPE html>
<html>
   <head>
      <meta charset="ISO-8859-1" />
      <style>
         fieldset{
            border:solid 1px #EE6600;
            border-radius:10px;
            padding:20px;
         }
         legend{
            font:bold 16pt arial;
            color:#EE6600;
         }
         input,select{
            border:solid 1px #AAAAAA;
            padding:10px;
            font:10pt verdana;
            color:#EE6600;
            outline:none;
            border-radius:6px;
         }
         input[type="submit"]{
            border:none;
            background-color:#EE6600;
            color:#FFFFFF;
            width:200px;
            cursor:pointer;
         }
         .label{
            margin-bottom:4px;
            font:10pt arial;
            color:#AAAAAA;
         }
         .champ{
            margin-bottom:20px;
         }
         .erreur{
            font:10pt arial;
            color:#DD0000;
            background-color:#EEEEEE;
            padding:10px;
            border-radius:10px;
            margin-bottom:10px;
         }
         .rappel{
            font:10pt arial;
            color:#888888;
            background-color:#EEEEEE;
            padding:10px;
            border-radius:10px;
            margin-bottom:10px;
         }
      </style>
   </head>
   <body>
   <?php echo $message ?> 
      <form name="fo" method="post" action="">
         <fieldset>
            <legend>Nouvel utilisateur</legend>
            <div class="label">Civilité</div>
            <div class="champ">
               <select name="civilite">
                  <option>Mme</option>
                  <option>Mlle</option>
                  <option>M.</option>
               </select>
            </div>
            <div class="label">Nom</div>
            <div class="champ">
               <input type="text" name="nom" />
            </div>
            <div class="label">Prénom</div>
            <div class="champ">
               <input type="text" name="prenom" />
            </div>
            <div class="label">Email</div>
            <div class="champ">
               <input type="text" name="email" />
            </div>
            <div class="label">Mot de passe</div>
            <div class="champ">
               <input type="password" name="pass" />
            </div>
            <div class="label">Confirmer le mot de passe</div>
            <div class="champ">
               <input type="password" name="repass" />
            </div>
            <div class="champ">
               <input type="submit" name="valider" value="Valider l'inscription" />
            </div>
         </fieldset>
      </form>
   </body>
</html> 