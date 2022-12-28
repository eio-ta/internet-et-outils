

DROP TABLE IF EXISTS `listepaquets`;

CREATE TABLE `listepaquets` (
  `iduser` int DEFAULT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
INSERT INTO `listepaquets` VALUES (2,'Maths (très simple)',1),(3,'Physique',2);
DROP TABLE IF EXISTS `ordre`;
CREATE TABLE `ordre` (
  `iduser` int DEFAULT NULL,
  `id` int DEFAULT NULL,
  `ordre_actuel` varchar(100) DEFAULT NULL,
  `ordre_suivant` varchar(100) DEFAULT NULL,
  `reussies` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
DROP TABLE IF EXISTS `paquet1`;
CREATE TABLE `paquet1` (
  `numero` int NOT NULL AUTO_INCREMENT,
  `question` text,
  `reponse` varchar(100) DEFAULT NULL,
  `type` bit(1) DEFAULT NULL,
  `choix` text,
  PRIMARY KEY (`numero`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
INSERT INTO `paquet1` VALUES (1,'1+1= ?','',_binary '\0','2|@$|deux'),(2,'Un carré est un rectangle.','Vrai',_binary '','Vrai|@$|Faux'),(3,'Un rectangle est carré.','Faux',_binary '','Faux|@$|Vrai'),(4,'Combien vaut x dans l\'équation 3x-2=7 ?','',_binary '\0','3|@$|trois');
DROP TABLE IF EXISTS `paquet1Perso`;
CREATE TABLE `paquet1Perso` (
  `numero` int NOT NULL AUTO_INCREMENT,
  `question` text,
  `reponse` varchar(100) DEFAULT NULL,
  `type` bit(1) DEFAULT NULL,
  `choix` text,
  PRIMARY KEY (`numero`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
INSERT INTO `paquet1Perso` VALUES (1,'1+1= ?','',_binary '\0','2|@$|deux'),(2,'Un carré est un rectangle.','Vrai',_binary '','Vrai|@$|Faux'),(3,'Un rectangle est carré.','Faux',_binary '','Faux|@$|Vrai'),(4,'Combien vaut x dans l\'équation 3x-2=7 ?','',_binary '\0','3|@$|trois');
DROP TABLE IF EXISTS `paquet2`;
CREATE TABLE `paquet2` (
  `numero` int NOT NULL AUTO_INCREMENT,
  `question` text,
  `reponse` varchar(100) DEFAULT NULL,
  `type` bit(1) DEFAULT NULL,
  `choix` text,
  PRIMARY KEY (`numero`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
INSERT INTO `paquet2` VALUES (1,'L\'accélération est la dérivée de la vitesse.','Vrai',_binary '','Vrai|@$|Faux'),(2,'Dans la formule P=mg quelles sont les unités ?','P -> kg.m/s² | m -> kg | g -> N/kg',_binary '','P -> kg.m/s² | m -> kg | g -> N/kg|@$|P -> N | m -> g | g -> m/s²|@$|P -> N | m -> g | g -> m/s '),(3,'Quelle est la valeur le l\'intensité de la pesanteur sur Terre en m/s² ? (au centième près)','',_binary '\0','9.81|@$|9,81'),(4,'Qui a trouvé la relation E=mc² ?','',_binary '\0','Albert Einstein|@$|Einstein');
DROP TABLE IF EXISTS `paquet2Perso`;
CREATE TABLE `paquet2Perso` (
  `numero` int NOT NULL AUTO_INCREMENT,
  `question` text,
  `reponse` varchar(100) DEFAULT NULL,
  `type` bit(1) DEFAULT NULL,
  `choix` text,
  PRIMARY KEY (`numero`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
INSERT INTO `paquet2Perso` VALUES (1,'L\'accélération est la dérivée de la vitesse.','Vrai',_binary '','Vrai|@$|Faux'),(2,'Dans la formule P=mg quelles sont les unités ?','P -> kg.m/s² | m -> kg | g -> N/kg',_binary '','P -> kg.m/s² | m -> kg | g -> N/kg|@$|P -> N | m -> g | g -> m/s²|@$|P -> N | m -> g | g -> m/s '),(3,'Quelle est la valeur le l\'intensité de la pesanteur sur Terre en m/s² ? (au centième près)','',_binary '\0','9.81|@$|9,81'),(4,'Qui a trouvé la relation E=mc² ?','',_binary '\0','Albert Einstein|@$|Einstein');
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `nom` varchar(100) DEFAULT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `adresse` varchar(100) DEFAULT NULL,
  `pseudo` varbinary(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(1) DEFAULT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  `message` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
INSERT INTO `users` VALUES ('Admin','Admin','admin@gmail.com',_binary 'Admin','8343da70ac1bf859d1258733f2720adb','a',1,NULL),('Leymarie','Alexandre','alexandre.j.leymarie@gmail.com',_binary 'Alex','0a60d59bcf3a9e975045313bdfc05e53','u',2,NULL),('Rougeolle','Yoan','yoyo031201@orange.fr',_binary 'YoYo','2828753707895de4f5125d0163be0272','u',3,NULL);
