-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 05 mai 2022 à 12:14
-- Version du serveur : 5.7.36
-- Version de PHP : 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `quizschool`
--

-- --------------------------------------------------------

--
-- Structure de la table `choix_question`
--

DROP TABLE IF EXISTS `choix_question`;
CREATE TABLE IF NOT EXISTS `choix_question` (
  `id_questionnaire` int(11) NOT NULL,
  `quest_number` int(11) NOT NULL,
  `quest_option` text COLLATE utf8_bin NOT NULL,
  `correct` tinyint(1) NOT NULL DEFAULT '0',
  `id_from_user` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `ip-bloc`
--

DROP TABLE IF EXISTS `ip-bloc`;
CREATE TABLE IF NOT EXISTS `ip-bloc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_adresse` varchar(45) COLLATE utf8_bin NOT NULL,
  `banned` int(11) DEFAULT NULL,
  `login_count` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ip_addresse` (`ip_adresse`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `ip-bloc`
--

INSERT INTO `ip-bloc` (`id`, `ip_adresse`, `banned`, `login_count`) VALUES
(4, '::1', 1651751672, 0);

-- --------------------------------------------------------

--
-- Structure de la table `questionnaire`
--

DROP TABLE IF EXISTS `questionnaire`;
CREATE TABLE IF NOT EXISTS `questionnaire` (
  `id_unik` int(11) NOT NULL AUTO_INCREMENT,
  `id_of_questionnaire` int(11) DEFAULT NULL,
  `id_quest` int(11) NOT NULL,
  `question` text COLLATE utf8_bin NOT NULL,
  `id_from_user` int(11) NOT NULL,
  PRIMARY KEY (`id_unik`)
) ENGINE=MyISAM AUTO_INCREMENT=91 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `theme_quest`
--

DROP TABLE IF EXISTS `theme_quest`;
CREATE TABLE IF NOT EXISTS `theme_quest` (
  `theme` varchar(300) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `id_from_of_questionnaire` int(11) NOT NULL,
  `id_from_user` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `prenom` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `pseudo` varchar(100) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `password_user` text COLLATE utf8_bin NOT NULL,
  `profil_img` text COLLATE utf8_bin,
  `biography` text COLLATE utf8_bin,
  `statut_user` tinyint(1) NOT NULL DEFAULT '0',
  `creat_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `nom`, `prenom`, `pseudo`, `email`, `password_user`, `profil_img`, `biography`, `statut_user`, `creat_date`) VALUES
(1, 'Lod', 'Kod', 'Boum', 'boum@gmail.com', 'azerty', '', 'Lorem, bio iptsum, noum boum loum hum koum', 0, '2022-04-25 11:56:30'),
(4, 'Toum', 'Rooter', 'Room', 'room@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$WFQ4eUZtSkdRRDRWblhXYQ$KIVD6cCqR8RhgnjUIOAu/aR9T0fBSNOg8dbb4CHqxGA', './uploader/Room/4602f0619046925b9880cff0eb5ea58e4.png', 'Ici c\'est la FG !', 0, '2022-04-25 13:54:20'),
(5, NULL, NULL, 'Root', 'root@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$WXo4UHJqcDFlWXA1bHpUSA$TDVhHVi0LKok+f6O+vlCKliOXDCsca+jmZ5tccI6Y2c', NULL, NULL, 0, '2022-04-25 13:56:14'),
(6, 'Roo', 'Roo', 'Niseth', 'nisethscary@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$RWpIWTBKVGRjckN6RElrMw$o6fz13D5BIex1yyhXrSzu73Df8AgmODyMVNKusLbOD4', './uploader/Niseth/c3ca33666435d01abfd688b3436856296.png', 'Ici c\'est la room !', 0, '2022-04-26 08:32:07');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
