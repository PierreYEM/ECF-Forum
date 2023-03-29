-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 30 mars 2023 à 01:20
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
(1, 'Chalon Principal'),
(2, 'Chat Rizard'),
(3, 'ChaParencouille');

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `subject_id` int NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comment` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `post_author` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `parent_post_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_to_subject` (`subject_id`),
  KEY `post_to_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `subject_id`, `date`, `comment`, `post_author`, `parent_post_id`) VALUES
(57, 64, 2, '2023-03-25 21:51:26', 'C&#39;est normal', 'Chat Pardeur', 0),
(58, 69, 2, '2023-03-25 22:50:02', 'Il est doubleface??', 'Chat Ringan', 0),
(59, 66, 2, '2023-03-25 23:31:16', 'Je vais demander à Chat GPT', 'Chat Pot', 0),
(65, 69, 2, '2023-03-26 00:42:25', 'Demande à Google BARD', 'Chat Ringan', 59),
(101, 64, 2, '2023-03-29 22:40:40', 'az', 'Chat Pardeur', 0),
(102, 64, 2, '2023-03-29 22:42:23', 'test', 'Chat Pardeur', 0),
(103, 64, 2, '2023-03-29 22:43:45', 'afaz', 'Chat Pardeur', 0);

-- --------------------------------------------------------

--
-- Structure de la table `subjects`
--

DROP TABLE IF EXISTS `subjects`;
CREATE TABLE IF NOT EXISTS `subjects` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `topic_id` int NOT NULL,
  `subject_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `subject_author` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `subject_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `subject_to_user` (`user_id`),
  KEY `subject_to_topic` (`topic_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `subjects`
--

INSERT INTO `subjects` (`id`, `user_id`, `topic_id`, `subject_name`, `subject_author`, `subject_date`) VALUES
(2, 64, 16, 'Pourquoi est-il si collant ?', 'Chat Pardeur', '2023-03-25 20:50:06'),
(3, 69, 18, 'Comment Miaouss arrive -t&#39;il a parler l&#39;humain??', 'Chat Ringan', '2023-03-25 23:06:52'),
(4, 66, 19, 'Vous préférez Cha-Cha?', 'Chat Pot', '2023-03-25 23:35:02'),
(9, 64, 16, 'tjrtj', 'Chat Pardeur', '2023-03-28 13:25:54'),
(12, 64, 16, 'qsd', 'Chat Pardeur', '2023-03-29 13:52:58'),
(13, 64, 20, 'test', 'Chat Pardeur', '2023-03-29 14:17:26');

-- --------------------------------------------------------

--
-- Structure de la table `topics`
--

DROP TABLE IF EXISTS `topics`;
CREATE TABLE IF NOT EXISTS `topics` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `user_id` int NOT NULL,
  `topic_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `topic_author` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `topic_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `subject_to_user` (`user_id`),
  KEY `topic_to_category` (`category_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `topics`
--

INSERT INTO `topics` (`id`, `category_id`, `user_id`, `topic_name`, `topic_author`, `topic_date`) VALUES
(16, 1, 64, 'Le Chat Terton', 'Chat Pardeur', '2023-03-24 15:14:21'),
(17, 3, 64, 'La phobie des concombres', 'Chat Pardeur', '2023-03-24 15:17:27'),
(18, 2, 66, 'Le meilleur pokemon chat pour vous ?', 'Chat Pot', '2023-03-24 15:19:56'),
(19, 3, 64, 'Cha-Cha ou la mort ?', 'Chat Pardeur', '2023-03-24 22:28:35'),
(20, 1, 69, 'La puissance du Chat Ringan', 'Chat Ringan', '2023-03-26 01:24:29'),
(34, 1, 64, 'test', 'Chat Pardeur', '2023-03-29 10:03:04');

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
  `avatar` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT './src/images/avatar/avatar.png',
  PRIMARY KEY (`id`),
  UNIQUE KEY `mail` (`mail`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `user_name`, `mail`, `password`, `avatar`) VALUES
(64, 'Chat Pardeur', 'chat@pardeur.fr', '$2y$10$7aJlmEX0pnlctXlbSA8VEegr7tYPxaNyrjvfbdkXMI447lqZ.RnzO', './src/images/avatar/Moto-Kawasaki-ZX-10R.jpg'),
(65, 'Chat Mot', 'chat@mot.fr', '$2y$10$0XKy2jamE8dTd07HriC6KuDaZ8obkbiePyWhVI4o9PuOV6TKVMFTO', './src/images/avatar/ben-kolde-FaPxZ88yZrw-unsplash.jpg'),
(66, 'Chat Pot', 'chat@pot.fr', '$2y$10$2iDzKqQ4qBWTBfr40laU1uJq1chUh/S.Fg0u6pBaDzlfT9hpjA8R6', './src/images/avatar/mewtrwo.jpg'),
(67, 'test', 'test@test.fr', '$2y$10$lOTq71Bo/UvE48B8j.paZuvLpBogRQIfC0FT/HVnWdGZj2gPyCSYy', './src/images/avatar/avatar.png'),
(68, 'chatpi', 'chat@pot.com', '$2y$10$cIrXIf2F9wxBSHokmR8/deq4UhOPxHqZRUkcBPEUThf1kQ4vZ6yBm', './src/images/avatar/avatar.png'),
(69, 'Chat Ringan', 'chat@ringan.fr', '$2y$10$6IXlKG82k1pVKIKxizCFuORXJxAehtKexV4kw33ipOh1Ac8Dl8zQC', './src/images/avatar/red.png');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `post_to_subject` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_to_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `subject_to_topic` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subject_to_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `topic_to_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `topic_to_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
