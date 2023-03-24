-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 24 mars 2023 à 17:06
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `forum`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `category_name`) VALUES
(1, 'Chat GPT'),
(2, 'Chat Rizard'),
(3, 'Chalon principal');

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `subject_id` int NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comment` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `post_author` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_to_subject` (`subject_id`),
  KEY `post_to_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id`, `user_id`, `subject_id`, `date`, `comment`, `post_author`) VALUES
(50, 64, 16, '2023-03-24 15:14:42', 'Que pensez-vous du chat Terton?', 'Chat Pardeur'),
(51, 66, 16, '2023-03-24 15:18:55', 'Je trouve ça nul !! et COLLANT!!', 'Chat Pot'),
(52, 66, 17, '2023-03-24 15:19:41', 'Même pas peur !!', 'Chat Pot'),
(53, 66, 18, '2023-03-24 15:20:08', 'Moi je vote MIAOUSS car il a la classe', 'Chat Pot'),
(54, 68, 16, '2023-03-24 15:48:23', 'Il est bête', 'chatpi'),
(55, 68, 16, '2023-03-24 15:48:33', 'et même un peu con', 'chatpi');

-- --------------------------------------------------------

--
-- Structure de la table `subject`
--

DROP TABLE IF EXISTS `subject`;
CREATE TABLE IF NOT EXISTS `subject` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `user_id` int NOT NULL,
  `subject_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `subject_author` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `subject_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `subject_to_topic` (`category_id`),
  KEY `subject_to_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `subject`
--

INSERT INTO `subject` (`id`, `category_id`, `user_id`, `subject_name`, `subject_author`, `subject_date`) VALUES
(16, 1, 64, 'Le Chat Terton', 'Chat Pardeur', '2023-03-24 15:14:21'),
(17, 3, 64, 'La phobie des concombres', 'Chat Pardeur', '2023-03-24 15:17:27'),
(18, 2, 66, 'Le meilleur pokemon chat pour vous ?', 'Chat Pot', '2023-03-24 15:19:56');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `mail` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `avatar` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mail` (`mail`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `user_name`, `mail`, `password`, `avatar`) VALUES
(64, 'Chat Pardeur', 'chat@pardeur.fr', '$2y$10$p5IK/.c2cUecG.K2CHzT7um.Pcq6ZPs/2QZi8v9SiCQmt5.4.O4NO', ''),
(65, 'Chat Mot', 'chat@mot.fr', '$2y$10$Y4Et9XesbP2BX/4APjwB9eVQesnMD4dizScAbZYd/bpSbbtA.A3yy', ''),
(66, 'Chat Pot', 'chat@pot.fr', '$2y$10$arj/WLJINGwKuGPbPu/PpODjTKobzMYyb4HK5L2EPc9Qqoc2/BOdO', ''),
(67, 'test', 'test@test.fr', '$2y$10$lOTq71Bo/UvE48B8j.paZuvLpBogRQIfC0FT/HVnWdGZj2gPyCSYy', ''),
(68, 'chatpi', 'chat@pot.com', '$2y$10$cIrXIf2F9wxBSHokmR8/deq4UhOPxHqZRUkcBPEUThf1kQ4vZ6yBm', '');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_to_subject` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_to_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `subject_to_topic` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subject_to_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
