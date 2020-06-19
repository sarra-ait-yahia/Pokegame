-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le :  ven. 19 juin 2020 à 09:55
-- Version du serveur :  8.0.18
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `pokedex`
--

-- --------------------------------------------------------

--
-- Structure de la table `capture_lieu`
--

DROP TABLE IF EXISTS `capture_lieu`;
CREATE TABLE IF NOT EXISTS `capture_lieu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lieu` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `capture_lieu`
--

INSERT INTO `capture_lieu` (`id`, `lieu`) VALUES
(1, 'montagne'),
(2, 'prairie'),
(3, 'ville'),
(4, 'foret'),
(5, 'plage');

-- --------------------------------------------------------

--
-- Structure de la table `capture_lieu_elementary_type`
--

DROP TABLE IF EXISTS `capture_lieu_elementary_type`;
CREATE TABLE IF NOT EXISTS `capture_lieu_elementary_type` (
  `capture_lieu_id` int(11) NOT NULL,
  `elementary_type_id` int(11) NOT NULL,
  PRIMARY KEY (`capture_lieu_id`,`elementary_type_id`),
  KEY `IDX_4FE86E5D181FC60A` (`capture_lieu_id`),
  KEY `IDX_4FE86E5D4F1868AE` (`elementary_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `capture_lieu_elementary_type`
--

INSERT INTO `capture_lieu_elementary_type` (`capture_lieu_id`, `elementary_type_id`) VALUES
(1, 1),
(1, 3),
(1, 8),
(1, 10),
(1, 14),
(2, 6),
(2, 7),
(2, 10),
(2, 11),
(2, 15),
(2, 18),
(3, 2),
(3, 5),
(3, 10),
(3, 13),
(4, 9),
(4, 10),
(4, 16),
(4, 18),
(5, 3),
(5, 4),
(5, 10),
(5, 12);

-- --------------------------------------------------------

--
-- Structure de la table `chasse`
--

DROP TABLE IF EXISTS `chasse`;
CREATE TABLE IF NOT EXISTS `chasse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dresseur_id` int(11) DEFAULT NULL,
  `lieu_capture_id` int(11) DEFAULT NULL,
  `pokemon_id` int(11) DEFAULT NULL,
  `pokemon_chasse_id` int(11) DEFAULT NULL,
  `date_chasse` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7A071956A1A01CBE` (`dresseur_id`),
  KEY `IDX_7A0719563E5A5230` (`lieu_capture_id`),
  KEY `IDX_7A0719562FE71C3E` (`pokemon_id`),
  KEY `IDX_7A0719563AFD41D5` (`pokemon_chasse_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `chasse`
--

INSERT INTO `chasse` (`id`, `dresseur_id`, `lieu_capture_id`, `pokemon_id`, `pokemon_chasse_id`, `date_chasse`) VALUES
(17, 19, 3, 34, 35, '2020-06-19 11:48:53');

-- --------------------------------------------------------

--
-- Structure de la table `elementary_type`
--

DROP TABLE IF EXISTS `elementary_type`;
CREATE TABLE IF NOT EXISTS `elementary_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `elementary_type`
--

INSERT INTO `elementary_type` (`id`, `libelle`) VALUES
(1, 'acier'),
(2, 'combat'),
(3, 'dragon'),
(4, 'eau'),
(5, 'électrik'),
(6, 'fée'),
(7, 'feu'),
(8, 'glace'),
(9, 'insecte'),
(10, 'normal'),
(11, 'plante'),
(12, 'poison'),
(13, 'psy'),
(14, 'roche'),
(15, 'sol'),
(16, 'spectre'),
(17, 'ténèbres'),
(18, 'vol');

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20200611175120', '2020-06-11 17:51:31'),
('20200611180238', '2020-06-11 18:02:46'),
('20200611213510', '2020-06-11 21:35:17'),
('20200612183629', '2020-06-12 18:36:40'),
('20200613120127', '2020-06-13 12:01:47'),
('20200613131243', '2020-06-13 13:12:50'),
('20200613133940', '2020-06-13 13:39:56'),
('20200613144755', '2020-06-13 14:48:01');

-- --------------------------------------------------------

--
-- Structure de la table `pokemon`
--

DROP TABLE IF EXISTS `pokemon`;
CREATE TABLE IF NOT EXISTS `pokemon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_pokemon_id` int(11) DEFAULT NULL,
  `dresseur_id` int(11) DEFAULT NULL,
  `sexe` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `xp` double DEFAULT NULL,
  `niveau` int(11) DEFAULT NULL,
  `a_vendre` tinyint(1) DEFAULT NULL,
  `prix` double DEFAULT NULL,
  `date_dernier_entrainement` datetime DEFAULT NULL,
  `date_derniere_chasse` datetime DEFAULT NULL,
  `surnom` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_62DC90F332E4CA1B` (`type_pokemon_id`),
  KEY `IDX_62DC90F3A1A01CBE` (`dresseur_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `pokemon`
--

INSERT INTO `pokemon` (`id`, `type_pokemon_id`, `dresseur_id`, `sexe`, `xp`, `niveau`, `a_vendre`, `prix`, `date_dernier_entrainement`, `date_derniere_chasse`, `surnom`) VALUES
(33, 4, 18, 'Fé', 17, 2, 1, 450, '2020-06-19 11:46:05', NULL, 'piupiu'),
(34, 7, 19, 'Ma', 0, 0, 0, NULL, NULL, '2020-06-19 11:48:53', 'siroto'),
(35, 102, 19, 'Fé', 16, 2, 1, 500, '2020-06-19 11:51:44', NULL, 'parilla');

-- --------------------------------------------------------

--
-- Structure de la table `pokemon_type`
--

DROP TABLE IF EXISTS `pokemon_type`;
CREATE TABLE IF NOT EXISTS `pokemon_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type1_id` int(11) DEFAULT NULL,
  `type2_id` int(11) DEFAULT NULL,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `evolution` tinyint(1) DEFAULT NULL,
  `starter` tinyint(1) DEFAULT NULL,
  `type_courbe_niveau` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B077296ABFAFA3E1` (`type1_id`),
  KEY `IDX_B077296AAD1A0C0F` (`type2_id`)
) ENGINE=InnoDB AUTO_INCREMENT=152 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `pokemon_type`
--

INSERT INTO `pokemon_type` (`id`, `type1_id`, `type2_id`, `nom`, `evolution`, `starter`, `type_courbe_niveau`) VALUES
(1, 10, NULL, 'Bulbizare', 0, 1, 'P'),
(2, 10, 11, 'Herbizarre', 1, 0, 'P'),
(3, 10, 11, 'Florizarre', 1, 0, 'P'),
(4, 6, NULL, 'Salamèche', 0, 1, 'P'),
(5, 6, NULL, 'Reptincel', 1, 0, 'P'),
(6, 6, 16, 'Dracaufeu', 1, 0, 'P'),
(7, 4, NULL, 'Carapuce', 0, 1, 'P'),
(8, 4, NULL, 'Carabaffe', 1, 0, 'P'),
(9, 4, NULL, 'Tortank', 1, 0, 'P'),
(10, 8, NULL, 'Chenipan', 0, 0, 'M'),
(11, 8, NULL, 'Chrysacier', 1, 0, 'M'),
(12, 8, 16, 'Papilusion', 1, 0, 'M'),
(13, 8, 11, 'Aspicot', 0, 0, 'M'),
(14, 8, 11, 'Coconfort', 1, 0, 'M'),
(15, 8, 11, 'Dardargnan', 1, 0, 'M'),
(16, 9, 16, 'Roucool', 0, 0, 'P'),
(17, 9, 16, 'Roucoups', 1, 0, 'P'),
(18, 9, 16, 'Roucarnage', 1, 0, 'P'),
(19, 9, NULL, 'Rattata', 0, 0, 'M'),
(20, 9, NULL, 'Rattatac', 1, 0, 'M'),
(21, 9, 16, 'Piafabec', 0, 0, 'M'),
(22, 9, 16, 'Rapasdepic', 1, 0, 'M'),
(23, 11, NULL, 'Abo', 0, 0, 'M'),
(24, 11, NULL, 'Arbok', 1, 0, 'M'),
(25, 5, NULL, 'Pikachu', 0, 0, 'M'),
(26, 5, NULL, 'Raichu', 1, 0, 'M'),
(27, 14, NULL, 'Sabelette', 0, 0, 'M'),
(28, 14, NULL, 'Sablaireau', 1, 0, 'M'),
(29, 11, NULL, 'Nidoran ♀', 0, 0, 'P'),
(30, 11, NULL, 'Nidorina', 1, 0, 'P'),
(31, 11, 14, 'Nidoqueen', 1, 0, 'P'),
(32, 11, NULL, 'Nidoran ♂', 0, 0, 'P'),
(33, 11, NULL, 'Nidorino', 1, 0, 'P'),
(34, 11, 14, 'Nidoking', 1, 0, 'P'),
(35, 17, NULL, 'Melofée', 0, 0, 'R'),
(36, 17, NULL, 'Mélodelfe', 1, 0, 'R'),
(37, 6, NULL, 'Goupix', 0, 0, 'M'),
(38, 6, NULL, 'Feunard', 1, 0, 'M'),
(39, 9, 17, 'Rondoudou', 0, 0, 'R'),
(40, 9, 17, 'Grodoudou', 1, 0, 'R'),
(41, 11, 16, 'Nosferapti', 0, 0, 'M'),
(42, 11, 16, 'Nosferalto', 1, 0, 'M'),
(43, 10, 11, 'Mystherbe', 0, 0, 'P'),
(44, 10, 11, 'Ortide', 1, 0, 'P'),
(45, 10, 11, 'Rafflesia', 1, 0, 'P'),
(46, 8, 10, 'Paras', 0, 0, 'M'),
(47, 8, 10, 'Parasect', 1, 0, 'M'),
(48, 8, 11, 'Mimitoss', 0, 0, 'M'),
(49, 8, 11, 'Aeromite', 1, 0, 'M'),
(50, 14, NULL, 'Taupiqueur', 0, 0, 'M'),
(51, 14, NULL, 'Triopikeur', 1, 0, 'M'),
(52, 9, NULL, 'Miaouss', 0, 0, 'M'),
(53, 9, NULL, 'Persian', 1, 0, 'M'),
(54, 4, NULL, 'Psykokwak', 0, 0, 'M'),
(55, 4, NULL, 'Akwakwak', 1, 0, 'M'),
(56, 2, NULL, 'Ferosinge', 0, 0, 'M'),
(57, 2, NULL, 'Colossinge', 1, 0, 'M'),
(58, 6, NULL, 'Caninos', 0, 0, 'L'),
(59, 6, NULL, 'Arcanin', 1, 0, 'L'),
(60, 4, NULL, 'Ptitard', 0, 0, 'P'),
(61, 4, NULL, 'Tetarte', 1, 0, 'P'),
(62, 4, 2, 'Tartard', 1, 0, 'P'),
(63, 12, NULL, 'Abra', 0, 0, 'P'),
(64, 12, NULL, 'Kadabra', 1, 0, 'P'),
(65, 12, NULL, 'Alakazam', 1, 0, 'P'),
(66, 2, NULL, 'Machoc', 0, 0, 'P'),
(67, 2, NULL, 'Machopeur', 1, 0, 'P'),
(68, 2, NULL, 'Mackogneur', 1, 0, 'P'),
(69, 10, 11, 'Chetiflor', 0, 0, 'P'),
(70, 10, 11, 'Boustiflor', 1, 0, 'P'),
(71, 10, 11, 'Empiflor', 1, 0, 'P'),
(72, 4, 11, 'Tentacool', 0, 0, 'L'),
(73, 4, 11, 'Tentacruel', 1, 0, 'L'),
(74, 13, 14, 'Racaillou', 0, 0, 'P'),
(75, 13, 14, 'Gravalanch', 1, 0, 'P'),
(76, 13, 14, 'Grolem', 1, 0, 'P'),
(77, 6, NULL, 'Ponyta', 0, 0, 'M'),
(78, 6, NULL, 'Galopa', 1, 0, 'M'),
(79, 4, 12, 'Ramoloss', 0, 0, 'M'),
(80, 4, 12, 'Flagadoss', 1, 0, 'M'),
(81, 5, 1, 'Magneti', 0, 0, 'M'),
(82, 5, 1, 'Magneton', 1, 0, 'M'),
(83, 9, 16, 'Canarticho', 0, 0, 'M'),
(84, 9, 16, 'Doduo', 0, 0, 'M'),
(85, 9, 16, 'Dodrio', 1, 0, 'M'),
(86, 4, NULL, 'Otaria', 0, 0, 'M'),
(87, 4, 7, 'Lamantine', 1, 0, 'M'),
(88, 11, NULL, 'Tadmorv', 0, 0, 'M'),
(89, 11, NULL, 'Grotadmorv', 1, 0, 'M'),
(90, 4, NULL, 'Kokiyas', 0, 0, 'L'),
(91, 4, 7, 'Crustabri', 1, 0, 'L'),
(92, 15, 11, 'Fantominus', 0, 0, 'P'),
(93, 15, 11, 'Spectrum', 1, 0, 'P'),
(94, 15, 11, 'Ectoplasma', 1, 0, 'P'),
(95, 13, 14, 'Onix', 0, 0, 'M'),
(96, 12, NULL, 'Soporifik', 0, 0, 'M'),
(97, 12, NULL, 'Hypnomade', 1, 0, 'M'),
(98, 4, NULL, 'Krabby', 0, 0, 'M'),
(99, 4, NULL, 'Krabboss', 1, 0, 'M'),
(100, 5, NULL, '16torbe', 0, 0, 'M'),
(101, 5, NULL, 'Electrode', 1, 0, 'M'),
(102, 10, 12, 'Noeunoeuf', 0, 0, 'L'),
(103, 10, 12, 'Noadkoko', 1, 0, 'L'),
(104, 14, NULL, 'Osselait', 0, 0, 'M'),
(105, 14, NULL, 'Ossatueur', 1, 0, 'M'),
(106, 2, NULL, 'Kicklee', 0, 0, 'M'),
(107, 2, NULL, 'Tygnon', 0, 0, 'M'),
(108, 9, NULL, 'Excelangue', 0, 0, 'M'),
(109, 11, NULL, 'Smogo', 0, 0, 'M'),
(110, 11, NULL, 'Smogogo', 1, 0, 'M'),
(111, 14, 13, 'Rhinocorne', 0, 0, 'L'),
(112, 14, 13, 'Rhinoferos', 1, 0, 'L'),
(113, 9, NULL, 'Leveinard', 0, 0, 'R'),
(114, 10, NULL, 'Saquedeneu', 0, 0, 'M'),
(115, 9, NULL, 'Kangourex', 0, 0, 'M'),
(116, 4, NULL, 'Hypotrempe', 0, 0, 'M'),
(117, 4, NULL, 'Hypocean', 1, 0, 'M'),
(118, 4, NULL, 'Poissirene', 0, 0, 'M'),
(119, 4, NULL, 'Poissoroy', 1, 0, 'M'),
(120, 4, NULL, 'Stari', 0, 0, 'L'),
(121, 4, 12, 'Staross', 1, 0, 'L'),
(122, 12, 17, 'M. Mime', 0, 0, 'M'),
(123, 8, 16, 'Insecateur', 0, 0, 'M'),
(124, 7, 12, 'Lippoutou', 0, 0, 'M'),
(125, 5, NULL, 'Elektek', 0, 0, 'M'),
(126, 6, NULL, 'Magmar', 0, 0, 'M'),
(127, 8, NULL, 'Scarabrute', 0, 0, 'L'),
(128, 9, NULL, 'Tauros', 0, 0, 'L'),
(129, 4, NULL, 'Magicarpe', 0, 0, 'L'),
(130, 4, 16, 'Leviator', 1, 0, 'L'),
(131, 4, 7, 'Lokhlass', 0, 0, 'L'),
(132, 9, NULL, 'Metamorph', 0, 0, 'M'),
(133, 9, NULL, 'Evoli', 0, 0, 'M'),
(134, 4, NULL, 'Aquali', 1, 0, 'M'),
(135, 5, NULL, 'Voltali', 1, 0, 'M'),
(136, 6, NULL, 'Pyroli', 1, 0, 'M'),
(137, 9, NULL, 'Porygon', 0, 0, 'M'),
(138, 13, 4, 'Amonita', 0, 0, 'M'),
(139, 13, 4, 'Amonistar', 1, 0, 'M'),
(140, 13, 4, 'Kabuto', 0, 0, 'M'),
(141, 13, 4, 'Kabutops', 1, 0, 'M'),
(142, 13, 16, 'Ptera', 0, 0, 'L'),
(143, 9, NULL, 'Ronflex', 0, 0, 'L'),
(144, 7, 16, 'Artikodin', 0, 0, 'L'),
(145, 5, 16, 'Electhor', 0, 0, 'L'),
(146, 6, 16, 'Sulfura', 0, 0, 'L'),
(147, 3, NULL, 'Minidraco', 0, 0, 'L'),
(148, 3, NULL, 'Draco', 1, 0, 'L'),
(149, 3, 16, 'Dracolosse', 1, 0, 'L'),
(150, 12, NULL, 'Mewtwo', 0, 0, 'L'),
(151, 12, NULL, 'Mew', 0, 0, 'P');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nb_piece` int(11) DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL,
  `pokemon_offert` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `roles`, `password`, `mail`, `nb_piece`, `is_verified`, `pokemon_offert`) VALUES
(18, 'sarra', '[]', '$argon2id$v=19$m=65536,t=4,p=1$TVZjUWxMZWFUSHZIVkIzTQ$UuUOn0+sNN/hm+j/0on3rMHoAn+jE8MHSP9wCavqX/Q', 'sara@hotmail.fr', 5000, 0, 1),
(19, 'Nerjess', '[]', '$argon2id$v=19$m=65536,t=4,p=1$d0FLSENZbU5oSVQ0ZTNFNQ$Q2ETXTE3O8f0WnCJ7ZU9KHk+Q2eWNcLKDOmNQERGiYY', 'Nerjess@hotmail.fr', 5000, 0, 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `capture_lieu_elementary_type`
--
ALTER TABLE `capture_lieu_elementary_type`
  ADD CONSTRAINT `FK_4FE86E5D181FC60A` FOREIGN KEY (`capture_lieu_id`) REFERENCES `capture_lieu` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_4FE86E5D4F1868AE` FOREIGN KEY (`elementary_type_id`) REFERENCES `elementary_type` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `chasse`
--
ALTER TABLE `chasse`
  ADD CONSTRAINT `FK_7A0719562FE71C3E` FOREIGN KEY (`pokemon_id`) REFERENCES `pokemon` (`id`),
  ADD CONSTRAINT `FK_7A0719563AFD41D5` FOREIGN KEY (`pokemon_chasse_id`) REFERENCES `pokemon` (`id`),
  ADD CONSTRAINT `FK_7A0719563E5A5230` FOREIGN KEY (`lieu_capture_id`) REFERENCES `capture_lieu` (`id`),
  ADD CONSTRAINT `FK_7A071956A1A01CBE` FOREIGN KEY (`dresseur_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `pokemon`
--
ALTER TABLE `pokemon`
  ADD CONSTRAINT `FK_62DC90F332E4CA1B` FOREIGN KEY (`type_pokemon_id`) REFERENCES `pokemon_type` (`id`),
  ADD CONSTRAINT `FK_62DC90F3A1A01CBE` FOREIGN KEY (`dresseur_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `pokemon_type`
--
ALTER TABLE `pokemon_type`
  ADD CONSTRAINT `FK_B077296AAD1A0C0F` FOREIGN KEY (`type2_id`) REFERENCES `elementary_type` (`id`),
  ADD CONSTRAINT `FK_B077296ABFAFA3E1` FOREIGN KEY (`type1_id`) REFERENCES `elementary_type` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
