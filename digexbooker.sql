-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 25 sep. 2024 à 23:24
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `digexbooker`
--

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type_message` varchar(100) NOT NULL,
  `nom_message` varchar(100) NOT NULL,
  `email_message` varchar(100) NOT NULL,
  `surjet_message` varchar(100) NOT NULL,
  `numero_message` int(11) NOT NULL,
  `message` varchar(100) NOT NULL,
  `service_id` int(11) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `type_message`, `nom_message`, `email_message`, `surjet_message`, `numero_message`, `message`, `service_id`, `created_at`) VALUES
(1, 9, 'Message', 'ngapouche', 'ngapoucheludger@gmail.com', '', 697272270, 'hello', 1, '2024-09-21'),
(2, 9, 'Demande', 'luk bell', 'luu@lu.com', 'demande de devis', 697272270, 'bonjour je suis luke j\'ai besion du manager pour mon projet\r\n ', 2, '2024-09-21'),
(3, 8, 'Message', 'ngapouche', 'luu@lu.com', 'demande de devis', 697272270, 'hool', 4, '2024-09-25');

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `expired` enum('0','1') NOT NULL DEFAULT '0',
  `pays_service` varchar(100) NOT NULL,
  `ville_service` varchar(100) NOT NULL,
  `experience_service` varchar(100) NOT NULL,
  `description_service` varchar(255) NOT NULL,
  `salaire_service` int(11) NOT NULL,
  `skill_service` varchar(100) NOT NULL,
  `applied_service` int(11) NOT NULL DEFAULT 0,
  `view_service` int(11) NOT NULL DEFAULT 0,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `services`
--

INSERT INTO `services` (`id`, `user_id`, `title`, `expired`, `pays_service`, `ville_service`, `experience_service`, `description_service`, `salaire_service`, `skill_service`, `applied_service`, `view_service`, `created_at`, `updated_at`) VALUES
(1, 9, 'Vente en ligne', '0', 'Cameroon', 'douala', '+2 ans', 'hqwertyuios sadiyioasudoasud', 2500000, 'marketing,boostage', 0, 31, '2024-09-17', '2024-09-17'),
(2, 9, 'Plombiere', '0', 'Nigeria', 'lagos', '+3 ans', 'hqwertyuios sadiyioasudoasud', 210000, 'marketing,boostage', 1, 11, '2024-09-18', '2024-09-18'),
(3, 10, 'Boostage de compte', '0', 'Cameroon', 'yaounde', '+1 ans', 'hqwertyuios sadiyioasudoasud', 50000, 'marketing,boostage', 0, 1, '2024-09-19', '2024-09-19'),
(4, 8, 'Menager', '0', 'Cameroon', 'Bertoua', '+3 ans', 'je suis passionner par la propreté c\'est vrai c\'est pas mon première choix de travail mais j\'aime bien ca  .j\'espère qu\'on pourra s\'arranger sur les modalité de travaille', 80000, 'lavage de voiture,cuisiere,observatrice', 1, 12, '2024-09-21', '2024-09-21'),
(5, 11, 'Vente en gros', '0', 'Tchad', 'Brazzaville', 'Debutant', 'venez par curiosité et vous n\'allais pas regretter ', 40000, 'marketing digital,boostage', 0, 3, '2024-09-25', '2024-09-25');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `img` varchar(100) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` int(20) NOT NULL,
  `sexe` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `langue` varchar(100) NOT NULL,
  `skill` varchar(100) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `experience` varchar(100) DEFAULT NULL,
  `emplois` varchar(100) NOT NULL,
  `ville` varchar(100) NOT NULL,
  `pays` varchar(100) DEFAULT NULL,
  `social` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '\'{"facebook":" ","tweeter":" ","instagram":" ","linkin":" "}\'',
  `abonnement` varchar(100) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `img`, `nom`, `prenom`, `email`, `number`, `sexe`, `password`, `type`, `langue`, `skill`, `description`, `experience`, `emplois`, `ville`, `pays`, `social`, `abonnement`, `date_naissance`, `created_at`, `updated_at`) VALUES
(8, '386/digex_521.png', 'NGAPOUCHE', 'ludger', 'lngapouche@nbf-corp.com', 697668683, 'male', 'ludger', 'user', 'Anglais,Francais', NULL, ' ', '+1 an', 'Coiffeur', 'douala', 'Cameroon', '{\"facebook\":\".com\",\"tweeter\":\".l\",\"instagram\":\".n\",\"linkin\":\".cmr\"}', 'starter', '2000-09-04', '2024-09-22 20:14:38', '0000-00-00 00:00:00'),
(9, '557/digex_951.jpeg', 'LUDGER', 'lu', 'ngapoucheludger@gmail.com', 2147483647, 'male', 'ludger', 'user', 'francais', NULL, NULL, NULL, '', 'douala', 'Cameroon', '{\"facebook\":\" https://web.facebook.com/CEFPREPAS\",\"tweeter\":\" \",\"instagram\":\" \",\"linkin\":\" \"}', 'starter', NULL, '2024-09-22 14:15:04', '2024-09-22 15:15:04'),
(10, '181/digex_781.png', 'Tche', 'Davide', 'franknbf@yahoo.fr', 697272270, 'female', 'ludger', 'user', 'francais', NULL, ' ', '2', 'Youtubeur', 'douala', 'Cameroon', '{\"facebook\":\" \",\"tweeter\":\" \",\"instagram\":\" \",\"linkin\":\" \"}', 'starter', '1996-03-19', '2024-09-22 14:12:04', '2024-09-19 04:03:30'),
(11, '128/digex_786.ico', 'Madelin', 'Nou', 'ludger@gmail.com', 697668683, 'Female', 'ludger', 'user', 'francais,Anglais,Chinois', NULL, NULL, NULL, '', 'douala', 'Cameroon', '\'{\"facebook\":\" \",\"tweeter\":\" \",\"instagram\":\" \",\"linkin\":\" \"}\'', 'starter', NULL, '2024-09-25 18:03:22', '0000-00-00 00:00:00');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
