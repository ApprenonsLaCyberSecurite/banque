-- Structure de la table `utilisateurs`

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int NOT NULL,
  `identifiant` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `motDePasse` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dateDeNaissance` date DEFAULT NULL,
  `mail` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profil` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Déchargement des données de la table `utilisateurs`

INSERT INTO `utilisateurs` (`id`, `identifiant`, `motDePasse`, `nom`, `prenom`, `dateDeNaissance`, `mail`, `profil`) VALUES
(1, 'IDF0001897', 'superSecret', 'MARTIN', 'Pierre', NULL, 'pmartin@gmail.com', 'CLIENT'),
(2, 'IDF0004095', 'azerty1234', 'DURAND', 'Kevin', '2007-03-07', 'kevkev@hotmail.com', 'CLIENT'),
(3, 'IDF0011336', 'password', 'TRANTO', 'Julie', NULL, 'juju48@hotmail.com', 'CLIENT'),
(4, 'IDF0000145', 'a_56!dEkx897', 'ASSOUAN', 'Pierrick', '2003-02-18', NULL, 'CLIENT'),
(5, 'IDF0924081', '123456', 'DUBRUEIL', 'Jacques', '1983-05-20', NULL, 'CLIENT'),
(6, 'IDF0003797', 'momo45', 'MAHFOUD', 'Mohamed', '2001-04-27', NULL, 'CLIENT'),
(7, 'IDF0057198', 'arcEnCiel_2008', 'FLATRI', 'Nathalie', '2008-12-25', 'arcEnCiel@yahoo.fr', 'CLIENT'),
(8, 'IDF0008821', '0437945285', 'RICHTER', 'Peter', '1973-08-01', 'peter@hotmail.com', 'CLIENT'),
(9, 'IDF0000093', 'DEADBEEF_', 'WAKED', 'Nachos', '1998-07-13', 'xy_yt@hotmail.com', 'CLIENT'),
(10, 'IDF0009674', 'hello', 'PUEBLO', 'Manolo', '2009-01-29', 'mano@gmail.com', 'CLIENT'),
(11, 'john', 'john', 'HOMMAND', 'John', '2000-01-01', 'john@hommand.com', 'CLIENT'),
(12, 'julien', 'julien', 'NEWBIE', 'Julien', '2004-05-27', NULL, 'CLIENT'),
(13, 'conseiller', 'conseiller', 'GURLANE', 'Tristan', NULL, NULL, 'CONSEILLER');
COMMIT;



-- Structure de la table `comptes`

DROP TABLE IF EXISTS `comptes`;
CREATE TABLE IF NOT EXISTS `comptes` (
  `id` int NOT NULL,
  `numeroCompte` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `solde` float NOT NULL,
  `devise` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `idUtilisateur` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- Déchargement des données de la table `comptes`

INSERT INTO `comptes` (`id`, `numeroCompte`, `type`, `solde`, `devise`, `idUtilisateur`) VALUES
(1, 'FR000145', 'COURANT', 627, 'EUR', 1),
(2, 'FR000022', 'EPARGNE', 1248, 'EUR', 1),
(3, 'FR009003', 'EPARGNE', 4726, 'EUR', 1),
(4, 'FR000441', 'COURANT', 99874, 'EUR', 2),
(5, 'FR000605', 'COURANT', 3357.5, 'EUR', 3),
(6, 'FR000320', 'COURANT', -145, 'EUR', 4),
(7, 'FR007701', 'COURANT', 0, 'EUR', 5),
(8, 'FR007789', 'COURANT', 10247, 'EUR', 6),
(9, 'FR011222', 'EPARGNE', 750, 'EUR', 6),
(10, 'FR000441', 'COURANT', 11207, 'EUR', 7),
(11, 'FR000605', 'COURANT', 12, 'EUR', 8),
(12, 'FR000320', 'COURANT', 4299, 'EUR', 9),
(13, 'FR007701', 'COURANT', 643.75, 'EUR', 10),
(14, 'FR010203', 'COURANT', 9999, 'EUR', 11),
(15, 'FR010204', 'EPARGNE', 25000, 'EUR', 11),
(16, 'FR223344', 'COURANT', 101.25, 'EUR', 12),
(17, 'FR223345', 'EPARGNE', 3500, 'EUR', 12);
COMMIT;


-- Structure de la table `sessions`

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sessionID` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `idUtilisateur` int NOT NULL,
  `dateExpiration` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=76613 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- Structure de la table `messages`

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idUtilisateur` int NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `theme` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `objet` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dateEnvoi` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
