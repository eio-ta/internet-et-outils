DROP TABLE IF EXISTS bd_users;
DROP TABLE IF EXISTS questions;
DROP TABLE IF EXISTS resultats;
DROP TABLE IF EXISTS messages;

CREATE TABLE IF NOT EXISTS bd_users (
	id INT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
	Prénom VARCHAR(256) NOT NULL DEFAULT '',
	Nom VARCHAR(256) NOT NULL DEFAULT '',
	Identifiant VARCHAR(256) NOT NULL DEFAULT '',
	Adresse_mail VARCHAR(256) NOT NULL DEFAULT '',
	Sexe VARCHAR(2) NOT NULL DEFAULT '',
	Rôle VARCHAR(256) DEFAULT 'UTILISATEUR',
	Mot_de_Passe VARCHAR(256) NOT NULL DEFAULT '',
	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS questions (
	id INT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
	Question VARCHAR(256) NOT NULL DEFAULT '',
	Réponse_correcte VARCHAR(256) NOT NULL DEFAULT '',
	Réponse_incorrecte VARCHAR(256) NOT NULL DEFAULT '',
	Niveau INT(8) NOT NULL DEFAULT '1',
	Matière VARCHAR(256) NOT NULL DEFAULT '',
	Catégorie VARCHAR(256) NOT NULL DEFAULT '',
	Créateur VARCHAR(256) DEFAULT 'admin-test',
	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS resultats (
	users_id INT(8) NOT NULL DEFAULT '1',
	Score INT(8) NOT NULL DEFAULT '0',
	Matière VARCHAR(256) NOT NULL DEFAULT '',
	Catégorie VARCHAR(256) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS messages (
	Identifiant VARCHAR(256) NOT NULL DEFAULT '',
	Questions VARCHAR(256) NOT NULL DEFAULT '',
	Contenu VARCHAR(256) NOT NULL DEFAULT '',
	Auteur VARCHAR(256) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO  bd_users (Prénom, Nom, Identifiant, Adresse_mail, Sexe, Rôle, Mot_de_Passe)
    VALUES  ('admin', 'test', 'admin-test', 'admin@test.fr', 'F',  'Admin',  MD5('test')),
	('utilisateur', 'test', 'utilisateur-test', 'utili@test.fr', 'M', 'UTILISATEUR', MD5('test'));

INSERT INTO resultats
	VALUES (1, 100, 'Géographie', 'Europe'),
	(1, 100, 'Géographie', 'Asie'),
	(1, 100, 'Géographie', 'Terre'),
	(1, 100, 'Géographie', 'Amérique'),
	(1, 100, 'Histoire', 'Moyen-âge/Les Temps Modernes'),
	(1, 100, 'Histoire', 'L’époque Contemporaine'),
	(1, 100, 'Histoire', 'Préhistoire/Antiquité'),
	(1, 100, 'Littérature', 'Expression'),
	(1, 100, 'Littérature', 'Auteur'),
	(1, 100, 'Sciences', 'Mathématique'),
	(1, 100, 'Sciences', 'Physique'),
	(1, 100, 'Sciences', 'Biologie'),
	(1, 100, 'Sciences', 'Anatomie'),
	(1, 100, 'Sciences', 'Géologie'),
	(2, 40, 'Géographie', 'Europe'),
	(2, 25, 'Géographie', 'Asie'),
	(2, 3, 'Géographie', 'Terre'),
	(2, 14, 'Géographie', 'Amérique'),
	(2, 30, 'Histoire', 'Moyen-âge/Les Temps Modernes'),
	(2, 25, 'Histoire', 'L’époque Contemporaine'),
	(2, 0, 'Histoire', 'Préhistoire/Antiquité'),
	(2, -30, 'Littérature', 'Expression'),
	(2, -3, 'Littérature', 'Auteur'),
	(2, -7, 'Sciences', 'Mathématique'),
	(2, 15, 'Sciences', 'Physique'),
	(2, 6, 'Sciences', 'Biologie'),
	(2, 5, 'Sciences', 'Anatomie'),
	(2, 30, 'Sciences', 'Géologie');

INSERT INTO messages
	VALUES ('utilisateur-test', 'Quel polygone a quatre côtés ?', 'Le quadrilatère et le parallèlogramme ont tous les deux 4 côtés. Il faudrait changer les propositions.', 'admin-test');

INSERT INTO questions (Question, Réponse_correcte, Réponse_incorrecte, Niveau, Matière, Catégorie)
    VALUES  ('Quelle victoire François 1er a-t-il remporté en 1515 ?',  'Marignan',  'La bataille de Verdun',  1, 'Histoire',  'Moyen-âge/Les Temps Modernes'),
    ('Quelle ville fut le siège du gouvernement français durant l’occupation ?',  'Vichy',  'Paris',  1, 'Histoire',  'L’époque Contemporaine'),
    ('De quel État le pape Jean-Paul II était-t-il souverain ?',  'Le Vatican',  'Rome',  1, 'Histoire',  'L’époque Contemporaine'),
    ('Quel président des États-Unis a été assassiné à Dallas ?', 'John Fitzgerald Kennedy',  'Barrack Obama',  1, 'Histoire',  'L’époque Contemporaine'),
    ('Quelle année retient-on comme l’année de la chute de l’empire romain d’occident ?',  '476 après JC',  '500 après JC',  1, 'Histoire',  'Préhistoire/Antiquité'),
    ('Combien d’état fédère l’Allemagne ?',  '16',  '12',  1, 'Histoire',  'L’époque Contemporaine'),
    ('Comment appelle-t-on les archéologues qui étudient la Préhistoire ?',  'Les préhistoriens',  'Les préhistologues',  1, 'Histoire',  'Préhistoire/Antiquité'),
    ('Dans quel ville la plupart des rois de France ont-il été sacrés ?',  'Reims',  'Paris',  2, 'Histoire',  'L’époque Contemporaine'),
    ('En 1914, dans quelle ville est assassiné l’archiduc d’Autriche ?',  'Sarajevo',  'Linz',  2, 'Histoire',  'L’époque Contemporaine'),
    ('En 1993, quel opposant à l’apartheid a reçu le prix Nobel de la paix ?',  'Mandela',  'Albert Einstein',  2, 'Histoire', 'L’époque Contemporaine'),
    ('Comment a-t-on appelé les guerres entre Rome et Carthage ?', 'Les guerres puniques', 'Des troubles-fêtes', 2, 'Histoire', 'L’époque Contemporaine'),
    ('À quel homme politique russe doit-on la révolution d’octobre 1917 ?', 'Lénine', 'Staline', 2, 'Histoire', 'L’époque Contemporaine'),
    ('Homo erectus signifie :', 'Un Homme debout', 'Un Homme savant', 2, 'Histoire', 'Préhistoire/Antiquité'),
    ('Le feu a vraisemblablement été maîtrisé par :', 'L’Homo erectus', 'L’Homo habilis', 2, 'Histoire', 'Préhistoire/Antiquité'),
    ('François Ier a construit un château, lequel ?', 'Le château de Chambord', 'Le château de Versailles', 2, 'Histoire', 'Moyen-âge/Les Temps Modernes'),
    ('Que s’est-il passé le 14 juillet 1789 ?', 'La prise de la Bastille', 'Ils ont assassinés Louis XIX', 2, 'Histoire', 'Moyen-âge/Les Temps Modernes'),
    ('Quel roi Francs fut sacré empereur en l’an 800 après J-C ?', 'Charlemagne', 'François 1er', 3, 'Histoire', 'Moyen-âge/Les Temps Modernes'),
    ('Quelle guerre est associée au terme « poilus » ?', '1er guerre mondiale', '2e guerre mondiale', 3, 'Histoire', 'L’époque Contemporaine'),
    ('Quel pays de l’Est s’est soulevé contre les soviétique en 1956 ?', 'La Hongrie', 'L’autriche', 3, 'Histoire', 'L’époque Contemporaine'),
    ('Pourquoi dit-on que l’Afrique est le berceau de l’humanité ?', 'Parce que les premiers hommes viennent d’Afrique', 'Parce qu’on parle du Nil comme le berceau de la vie', 3, 'Histoire', 'Préhistoire/Antiquité'),
    ('En quelle année Gutenberg a inventé l’imprimerie ?', '1450', '1492', 3, 'Histoire', 'Moyen-âge/Les Temps Modernes'),
	('Il y a combien d’océans sur la Terre ?', '5', '6', 1, 'Géographie', 'Terre'),
	('Combien y a-t-il d’hémisphères sur le globe terrestre ?', 'Deux', 'Un', 1, 'Géographie', 'Terre'),
	('Dans quel océan se trouve l’archipel des Bahamas ?', 'L’océan Atlantique', 'L’océan Pacifique', 1, 'Géographie', 'Amérique'),
	('Quelle ville d’Allemagne est la capitale du land de Bavière ?', 'Munich', 'Berlin', 1, 'Géographie', 'Europe'),
	('Quel est le plus vaste désert du  monde ?', 'Le Sahara', 'Le désert d Arabie', 1, 'Géographie', 'Terre'),
	('Comment appelle-t-on les localités situées autour d’une grande ville ?', 'Les banlieues', 'La périphérie', 1, 'Géographie', 'Terre'),
	('Quel est le canal qui permet de passer de la Méditerranée à la Mer Rouge ?', 'Le canal de suez', 'Le canal de Panama', 1, 'Géographie', 'Terre'),
	('Qu’est-ce qui sépare la France et l’Angleterre ?', ' La manche', 'La mer méditerranée', 1, 'Géographie', 'Europe'),
	('Dans quel hémisphère se situe le Tropique du Cancer ?', 'Nord', 'Sud', 1, 'Géographie', 'Terre'),
	('Quel détroit relie l’Atlantique et la mer Méditerranée ?', ' Le détroit de Gibraltar', 'Le détroit de Malacca', 2, 'Géographie', 'Terre'),
	('Quel est la capitale d’Hawaï ?', 'Honolulu', 'Hawi', 2, 'Géographie', 'Amérique'),
	('Quel tropique se situe dans l’hémisphère sud ?', 'Capricorne', 'Cancer', 2, 'Géographie', 'Terre'),
	('Dans quelle mer baigne Saint-Petersburg ?', 'Baltique', 'La mer rouge', 2, 'Géographie', 'Asie'),
	('Quelle est la capitale de la Jamaïque ?', 'Kingston', 'Port Royal', 3, 'Géographie', 'Amérique'),
	('De quel pays Skopje est la capitale ?', 'Serbie', 'Russie', 3, 'Géographie', 'Europe'),
	('Dans quel pays se trouve le port de Bassora ?', 'Irak', 'Iran', 3, 'Géographie', 'Asie'),
	('Quelle est la capitale du Tibet ?', 'Lhassa', 'Gyantsé', 3, 'Géographie', 'Asie'),
	('Quelle est la capitale de l’Uruguay ?', 'Montevideo', 'Asuncion', 3, 'Géographie', 'Amérique'),
	('Qu’est-ce qui revient au galop quand on le chasse ?', 'Le naturel', 'Le cheval', 1, 'Littérature', 'Expression'),
	('À quel genre littéraire rattache-t-on l’écrivain Steffen King ?', 'Fantastique', 'Merveilleux', 1, 'Littérature', 'Auteur'),
	('Selon le proverbe, que craint le « chat échaudé » ?', 'L’eau froide', 'L’eau chaude', 1, 'Littérature', 'Expression'),
	('Dans le roman d’Herman Melville, à quoi ressemble le Moby Dick ?', 'Une baleine', 'Un ours', 1, 'Littérature', 'Auteur'),
	('Qui a écrit le Petit Prince ?', 'Saint Exupérie', 'Albert Camus', 1, 'Littérature', 'Auteur'),
	('Qu’a-t-on dans le porte-monnaie ou dans ses poches, si on est avare ?', 'Un oursin', 'Une aiguille', 1, 'Littérature', 'Expression'),
	('Quel est l’amoureux de Juliette dans l’œuvre de Shakespeare ?', 'Roméo', 'Romain', 1, 'Littérature', 'Auteur'),
	('Quelle locution latine signifie l’aveu d’une faute ?', 'Mea culpa', 'Alea jacta est', 1, 'Littérature', 'Expression'),
    ('De quelle couleur est la colombe que le crapaud ne peut atteindre avec sa bave ?', 'Blanche', 'Grise', 1, 'Littérature', 'Expression'),
    ('Quel auteur dramatique a écrit ’Les fourberies de Scapin’ ?', 'Molière', 'Beaumarchais', 2, 'Littérature', 'Auteur'),
    ('Qui a écrit ’La cantatrice chauve’ ?', 'Eugene Ionesco', 'Samuel Beckett', 2, 'Littérature', 'Auteur'),
	('À quel mammifère fait-on référence pour parler d’une personne qui dort beaucoup ou profondément ?', 'Une marmotte', 'Un paresseux', 2, 'Littérature', 'Expression'),
	('À quel écrivain doit-on le roman d’anticipation ’1984’ ?', 'George Orwell', 'Charles Dickens', 2, 'Littérature', 'Auteur'),
	('Qui a écrit ’le Mariage de Figaro’ ?', 'Beaumarchais', 'Molière', 2, 'Littérature', 'Auteur'),
	('Quelle est la mère de tous les vices ?', 'Oisiveté', 'fainéantise', 3, 'Littérature', 'Expression'),
	('Qui est l’auteur du roman policier ’Homme à l’Envers’ ?', 'Fred Vargas', 'Marc Villemain', 3, 'Littérature', 'Auteur'),
	('Qui a écrit ’Le tour du monde en 80 jours’ ?', 'Jules Verne', 'Victor Hugo', 3, 'Littérature', 'Auteur'),
	('Quel quadrilatère à 4 côtés égaux et quatre angles droits ?', 'Le carré', 'Le rectangle', 1, 'Sciences', 'Mathématique'),
	('À quelle opération mathématique fait référence le mot « produit » ?', 'La multiplication', 'L’addition', 1, 'Sciences', 'Mathématique'),
	('Comment nomme-t-on une figure qui a 8 côtés ?', 'Un octogone', 'Un pentagone', 1, 'Sciences', 'Mathématique'),
	('Quel nom porte le côté d’un triangle rectangle opposé à l’angle droit ?', 'L’hypoténuse', 'L’adjacent', 1, 'Sciences', 'Mathématique'),
	('Quel polygone a quatre côtés ?', 'Un quadrilatère', 'Un parallélogramme', 1, 'Sciences', 'Mathématique'),
	('Quel est le nom de l’empreinte d’un animal ou d’une plante conservée dans des dépôts sédimenteux ?', 'Un fossile', 'Une faucille', 1, 'Sciences', 'Géologie'),
	('Quel reptile peut être à sonnette ?', 'Un serpent', 'Un alligator', 1, 'Sciences', 'Biologie'),
	('Comment appelle-t-on l’explosion qui serait à l’origine de l’expansion de l’univers ?', 'Le Big Bang', 'Le Big Ben', 1, 'Sciences', 'Physique'),
	('Dans quelle partie du corps se situent le tibia et le péroné ?', 'Jambe', 'Bras', 1, 'Sciences', 'Anatomie'),
	('Quelle artère véhicule le sang oxygéné dans le corps ?', 'Aorte', 'Carotide', 1, 'Sciences', 'Anatomie'),
	('Quel prix Nobel fut attribué à ’Pierre et Marie Curie’ ?', 'Physique', 'Chimie', 1, 'Sciences', 'Physique'),
	('Qui divise par 1000 ?', 'Milli', 'Micro', 1, 'Sciences', 'Physique'),
	('Quelle particule négative est présente dans un atome ?', 'Un électron', 'Un anion', 1, 'Sciences', 'Physique'),
	('Quel fruit est tombé sur la tête de Newton ?', 'Une pomme', 'Une poire', 1, 'Sciences', 'Physique'),
	('Quel planète est rouge ?', 'Mars', 'Venus', 1, 'Sciences', 'Géologie'),
	('Quel est l’organe de l’audition et de l’équilibre ?', 'L’oreille', 'Le cerveau', 1, 'Sciences', 'Biologie'),
	('Quel est le nom de la première brebis clonée ?', 'Dolly', 'Billy', 1, 'Sciences', 'Biologie'),
	('Quelle unité de mesure utilise-t-on pour une masse ?', 'Kilogramme', 'Gramme', 1, 'Sciences', 'Physique'),
	('Quel appareil enregistre les séismes ?', 'Sismographe', 'Anémomètre', 1, 'Sciences', 'Géologie'),
	('Quelle couleur est attribuée à la Terre ?', 'Bleu', 'Vert', 1, 'Sciences', 'Géologie'),
	('Quel os long constitue le squelette du bras ?', 'Humérus', 'Radius', 2, 'Sciences', 'Anatomie'),
	('Quel nom a-t-on donné au continent unique de la fin du paléozoïque ?', 'Pangée', 'Pongée', 2, 'Sciences', 'Géologie'),
	('Comment s’appelle la partie externe de la peau ?', 'Epiderme', 'Derme', 2, 'Sciences', 'Biologie'),
	('Quelle technique permet de copier un gène ?', 'Clonage', 'Duplication', 2, 'Sciences', 'Biologie'),
	('Quelle action consiste à décoder une fleur ?', 'Pollinisation', 'Polonisation', 2, 'Sciences', 'Biologie'),
	('En biologie, quelle est la technique qui permet de croiser deux cellules ?', 'Hybridation', 'Croisement', 3, 'Sciences', 'Biologie'),
	('Quel lapin domestique possède un pelage blanc et les yeux rouges ?', 'Albinos', 'Chevreuil', 3, 'Sciences', 'Biologie'),
	('À quel moment de l’année les jours sont-ils les plus longs ou les plus courts ?', 'Solstice', 'Equinoxe', 3, 'Sciences', 'Biologie');

INSERT INTO questions (Question, Réponse_correcte, Réponse_incorrecte, Niveau, Matière, Catégorie, Créateur)
    VALUES ('Combien de côtés possède un hexagone ?', '6', '5', 1, 'Sciences', 'Mathématique', 'utilisateur-test'),
	('Quel est le résultat de 652 / 2 ?', '326', '226', 1, 'Sciences', 'Mathématique', 'utilisateur-test');