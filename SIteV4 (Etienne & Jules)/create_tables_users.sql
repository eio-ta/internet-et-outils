DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS questions;

CREATE TABLE IF NOT EXISTS users (
  id INT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  email VARCHAR(256) NOT NULL DEFAULT '',
  admin tinyint(1) NOT NULL DEFAULT '0',
  pseudo VARCHAR(256) NOT NULL DEFAULT '', -- login
  password CHAR(255) NOT NULL DEFAULT '', -- crypté
  PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS questions(
  id INT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  categorie VARCHAR(256) NOT NULL DEFAULT '',
  nom VARCHAR(256) NOT NULL DEFAULT '',
  createur VARCHAR(256) NOT NULL DEFAULT '',
  question VARCHAR(256) NOT NULL DEFAULT '',
  reponseA VARCHAR(256) NOT NULL DEFAULT '',
  reponseB VARCHAR(256) NOT NULL DEFAULT '',
  reponseC VARCHAR(256) NOT NULL DEFAULT '',
  reponseD VARCHAR(256) NOT NULL DEFAULT '',
  solution VARCHAR(256) NOT NULL DEFAULT '', 
  PRIMARY KEY (id) 
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO users values("1","admin@gmail.com",'1',"Admin",md5("admin")); -- compte admin

INSERT INTO questions values("1","art","Impressionisme","Admin","Qui était Claude Monet?","Un architect","Un peintre","Un sculpteur","Un dramaturge","reponseB");
INSERT INTO questions values("2","art","Impressionisme","Admin","En quelle année est apparu l'impressionisme?","1924","2004","1860","1773","reponseC");
INSERT INTO questions values("3","art","Impressionisme","Admin","A quelle dérivée de l'impressionnisme appartenait Matisse?","Au fauvisme","A l'art abstrait","Au romantisme","Au dadaïsme","reponseA");
INSERT INTO questions values("4","art","Impressionisme","Admin","Quel peintre n'était pas impressioniste?","Claude Monnet","Marie Laurencin","Auguste Renoir","Edouard Mannet","reponseB");
INSERT INTO questions values("5","art","Impressionisme","Admin","Quelle oeuvre était de Claude Monet?","Le déjeuner sur l'herbe","La grenouillère","L'absinthe","Les nymphéas","reponseD");

INSERT INTO questions values("6","histoiregeo","La Chine","Admin","En quelle année Mao est arrivé au pouvoir?","1936","1917","1949","1956","reponseC");
INSERT INTO questions values("7","histoiregeo","La Chine","Admin","Quel était l'ancien nom de Taïwan?","Pékin","Taïwan","Paris","Formose","reponseD");
INSERT INTO questions values("8","histoiregeo","La Chine","Admin","Quel pays ne partage pas de frontières avec la Chine?","Le Bangladesh","La Mongolie","Le Kazakhstan","Le Laos","reponseA");
INSERT INTO questions values("9","histoiregeo","La Chine","Admin","En quelle année a eu la première guerre de l'opium?","2017","1695","1839","1904","reponseC");
INSERT INTO questions values("10","histoiregeo","La Chine","Admin","Quel problème rencontre aujourd'hui les garçons chinois?","Un fort taux de chômage","Un fort taux de célibat","Une augmentation de l'obésité","Une augmentation de la délinquence","reponseB");

INSERT INTO questions values("11","divertissement","La musique des années 2000","Admin","Quel style de musique est apparu notamment avec le groupe Green Day au début des années 2000?","La Hip-hop","L'électro jazz","Le hard rock","La pop punk","reponseD");
INSERT INTO questions values("12","divertissement","La musique des années 2000","Admin","Quel groupe allemand a connu une forte popularité dans les années 2000","Die Woodys","Tokio Hotel","Nena","Zodiac","reponseB");
INSERT INTO questions values("13","divertissement","La musique des années 2000","Admin","Quel boys band n'a pas existé?","2be3","Naughty boys","Blue","G squad","reponseB");
INSERT INTO questions values("14","divertissement","La musique des années 2000","Admin","Qui chanta dernière danse?","Sexion d'assault","Indochine","Jena Lee","Kyo","reponseD");
INSERT INTO questions values("15","divertissement","La musique des années 2000","Admin","Qui remporta la première édition de la Star Academdy?","Jennifer","Kendji Girac","Jean Pascal","Loana","reponseA");

INSERT INTO questions values("16","sport","Le Tennis","Admin","Lequel de ses tournois ne fait pas parti du grand Chelem?","L'open d'Australie","Roland-Garros","Wimbledon","L'Indian Wells","reponseD");
INSERT INTO questions values("17","sport","Le Tennis","Admin","Combien de grands Chelem a gagné Roger Federer?","12","20","17","14","reponseB");
INSERT INTO questions values("18","sport","Le Tennis","Admin","Quelle est l'origine du compte des points au tennis?","Les Bourbons","Le jeu de paume","Une tradition anglaise","C'était juste original à l'époque","reponseB");
INSERT INTO questions values("19","sport","Le Tennis","Admin","Combien de temps a duré le plus long match de tennis?","6h45","14h30","11h05","5h20","reponseC");
INSERT INTO questions values("20","sport","Le Tennis","Admin","Qu'est-ce qu'un passing shot?","Une balle envoyée au fond lorsque le joueur adverse est au filet","La célébration d'un joueur apres un match","Un coup droit amorti","Un tir que se prend un ramasseur de balles","reponseA");