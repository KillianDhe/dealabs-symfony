-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql:3306
-- Généré le : Dim 27 juin 2021 à 22:12
-- Version du serveur :  5.7.32
-- Version de PHP : 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `lpa_sf4`
--

-- --------------------------------------------------------

--
-- Structure de la table `alerte`
--

CREATE TABLE `alerte` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `recherche` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `temperature_min` int(11) NOT NULL,
  `is_send_email` tinyint(1) DEFAULT NULL,
  `date_creation` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `alerte`
--

INSERT INTO `alerte` (`id`, `user_id`, `recherche`, `temperature_min`, `is_send_email`, `date_creation`) VALUES
(5, 2, 'aa', 0, 0, '2021-06-27'),
(6, 2, 'bbb', -5, 0, '2021-06-27');

-- --------------------------------------------------------

--
-- Structure de la table `badge`
--

CREATE TABLE `badge` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `badge`
--

INSERT INTO `badge` (`id`, `nom`, `description`) VALUES
(1, 'Surveillant', 'Vous avez votépour 10 deals'),
(2, 'Cobaye', 'Vous avez postéau moins 10 deals'),
(3, 'Rapport de stage', 'Vous avez postéau moins 10 commentaires ');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `id` int(11) NOT NULL,
  `auteur_id` int(11) NOT NULL,
  `deal_id` int(11) NOT NULL,
  `date_heure` date NOT NULL,
  `contenu` longtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`id`, `auteur_id`, `deal_id`, `date_heure`, `contenu`) VALUES
(1, 1, 1, '2021-06-22', 'fdp'),
(2, 1, 1, '2021-06-22', 'slt'),
(3, 1, 1, '2021-06-22', 'comment ca va?.'),
(4, 1, 1, '2021-06-22', 'efe'),
(5, 1, 1, '2021-06-22', 'zdzdz'),
(6, 1, 1, '2021-06-22', 'zeze'),
(7, 1, 1, '2021-06-22', 'zezez'),
(8, 2, 1, '2021-06-26', 'sdsd'),
(9, 2, 1, '2021-06-26', 'qdsqdqdsq'),
(10, 2, 1, '2021-06-26', 'sdqdsqdqd'),
(11, 2, 1, '2021-06-26', 'qdqsdsqdsqd'),
(12, 2, 1, '2021-06-26', 'qsdsqdqsdqsd'),
(13, 2, 1, '2021-06-26', 'qsdqsdqsd'),
(14, 2, 1, '2021-06-26', 'qdsqdqsds'),
(15, 2, 1, '2021-06-26', 'qdqsdsqdqd'),
(16, 2, 1, '2021-06-26', 'qsdsqds'),
(17, 2, 1, '2021-06-26', 'qdsqd'),
(18, 2, 1, '2021-06-26', 'qsdsqd'),
(19, 2, 1, '2021-06-26', 'sqdq'),
(20, 2, 1, '2021-06-26', 'sqdqdqsd'),
(21, 2, 1, '2021-06-26', 'sqdqdqsd'),
(22, 2, 1, '2021-06-26', 'zebii'),
(23, 2, 1, '2021-06-26', 'chanii'),
(24, 2, 1, '2021-06-26', 'chanii'),
(25, 2, 1, '2021-06-26', 'chanii'),
(26, 2, 1, '2021-06-26', 'retg'),
(27, 2, 1, '2021-06-26', 'retg');

-- --------------------------------------------------------

--
-- Structure de la table `deal`
--

CREATE TABLE `deal` (
  `id` int(11) NOT NULL,
  `description` varchar(10000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lien_du_deal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_promo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_expire` tinyint(1) NOT NULL,
  `discr` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix` double DEFAULT NULL,
  `prix_habituel` double DEFAULT NULL,
  `frais_de_port` double DEFAULT NULL,
  `is_livraison_gratuite` tinyint(1) DEFAULT NULL,
  `montant` double DEFAULT NULL,
  `date_creation` date NOT NULL,
  `type_reduction` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `deal`
--

INSERT INTO `deal` (`id`, `description`, `titre`, `lien_du_deal`, `code_promo`, `is_expire`, `discr`, `prix`, `prix_habituel`, `frais_de_port`, `is_livraison_gratuite`, `montant`, `date_creation`, `type_reduction`, `image`, `author_id`) VALUES
(1, 'sdsdsdsdsd', 'sdfdsdsdsd', 'https://www.google.fr/', 'sdsd', 0, 'bonPlan', 50, 550, 0, 0, NULL, '2021-06-22', NULL, 'Site .png', 1),
(2, 'sdfsdfsf', 'sdfsfsf', 'https://www.google.fr/', NULL, 0, 'bonPlan', 50, 50, NULL, 0, NULL, '2021-06-26', NULL, 'Site .png', 1),
(3, '<dfd<sf', '<dfd<f', 'https://www.google.fr/', NULL, 0, 'bonPlan', 50, 500, NULL, 0, NULL, '2021-06-26', NULL, 'Capture d’écran de 2020-09-17 15-35-43.png', 2),
(4, 'sfsfsfsf', 'dfsfsfd', 'https://www.google.fr/', NULL, 0, 'bonPlan', 5050, 8, NULL, 0, NULL, '2021-06-26', NULL, 'Capture d’écran de 2020-09-25 16-51-27.png', 2),
(5, 'ssdsds', '<d<sd', 'https://www.google.fr/', NULL, 0, 'bonPlan', 500, 50, NULL, 0, NULL, '2021-06-26', NULL, 'Capture d’écran de 2020-09-25 16-51-35.png', 2),
(6, 'sdsd', 'sqsqd', 'https://www.google.fr/', NULL, 0, 'bonPlan', 50, NULL, NULL, 0, NULL, '2021-06-27', NULL, NULL, 2),
(7, 'aaaa', 'aaaa', 'https://www.google.fr/', NULL, 0, 'bonPlan', 5050, 505, NULL, 0, NULL, '2021-06-27', NULL, NULL, 2),
(8, 'bbbb', 'bbbb', 'https://www.google.fr/', NULL, 0, 'codePromo', NULL, NULL, NULL, NULL, 80, '2021-06-27', 'pourcentage', NULL, 2),
(9, 'super deal juste pour test', 'sdfsdfsdfsdfsdfsdfsdf', 'https://en.wikipedia.org/wiki/Salut', NULL, 0, 'bonPlan', 800, 5000, 12, 0, NULL, '2021-06-28', NULL, NULL, 2),
(10, 'super code promo pour les maisons ??', 'un code promo car je les delaisse', 'https://en.wikipedia.org/wiki/Salut', 'EF50', 0, 'codePromo', NULL, NULL, NULL, NULL, 50, '2021-06-28', 'euros', NULL, 2),
(11, 'super', '20% chez darty', 'https://en.wikipedia.org/wiki/Salut', 'darty20', 0, 'codePromo', NULL, NULL, NULL, NULL, 20, '2021-06-28', 'pourcentage', NULL, 2);

-- --------------------------------------------------------

--
-- Structure de la table `deal_groupe`
--

CREATE TABLE `deal_groupe` (
  `deal_id` int(11) NOT NULL,
  `groupe_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `deal_groupe`
--

INSERT INTO `deal_groupe` (`deal_id`, `groupe_id`) VALUES
(9, 1),
(10, 2),
(11, 1);

-- --------------------------------------------------------

--
-- Structure de la table `deal_partenaire`
--

CREATE TABLE `deal_partenaire` (
  `deal_id` int(11) NOT NULL,
  `partenaire_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `deal_partenaire`
--

INSERT INTO `deal_partenaire` (`deal_id`, `partenaire_id`) VALUES
(9, 1),
(10, 1),
(11, 1);

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210511065511', '2021-06-21 23:59:26', 71),
('DoctrineMigrations\\Version20210511071754', '2021-06-21 23:59:27', 33),
('DoctrineMigrations\\Version20210511075633', '2021-06-21 23:59:27', 423),
('DoctrineMigrations\\Version20210519073403', '2021-06-21 23:59:27', 26),
('DoctrineMigrations\\Version20210526071040', '2021-06-21 23:59:27', 22),
('DoctrineMigrations\\Version20210531063427', '2021-06-21 23:59:27', 24),
('DoctrineMigrations\\Version20210602063201', '2021-06-21 23:59:27', 104),
('DoctrineMigrations\\Version20210609063508', '2021-06-21 23:59:27', 77),
('DoctrineMigrations\\Version20210626232842', '2021-06-27 01:28:50', 157),
('DoctrineMigrations\\Version20210627110351', '2021-06-27 13:03:58', 161),
('DoctrineMigrations\\Version20210627110808', '2021-06-27 13:08:13', 114),
('DoctrineMigrations\\Version20210627114029', '2021-06-27 13:40:34', 94),
('DoctrineMigrations\\Version20210627170657', '2021-06-27 19:07:31', 64);

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

CREATE TABLE `groupe` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `groupe`
--

INSERT INTO `groupe` (`id`, `nom`) VALUES
(1, 'Telephone'),
(2, 'Maison');

-- --------------------------------------------------------

--
-- Structure de la table `partenaire`
--

CREATE TABLE `partenaire` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `partenaire`
--

INSERT INTO `partenaire` (`id`, `nom`) VALUES
(1, 'darty');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_verified` tinyint(1) NOT NULL,
  `api_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `is_verified`, `api_token`, `is_deleted`, `description`, `avatar`) VALUES
(1, 'killian.dherment@gmail.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$dh1fxG292dIjn6J7pTH/tA$MUS7sbYRAeQrdNpVlqIKmsVgsoSTnGRdm2pLLgk1zFk', 0, 'THH9R-iauJwK_aXxcIyDh8nLmw3RdMcO2Mv0TkA13Rk', 0, NULL, NULL),
(2, 'example@mail.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$nCaZaeoWO/B/WO5Tpqt5Uw$pV14OA/1G+/IDHkS/RjYN02pLlm2sIweWo6AO05XHUc', 0, 'g2WS8lsAu0n9ELX_lcLZC15-vJGieg9Pkq0UxMIEF0M', 0, NULL, NULL),
(3, 'zebi@zebi.com', '[\"ROLE_ADMIN\"]', '$argon2id$v=19$m=65536,t=4,p=1$w4JUpvduE4l0WQorNiTouw$aAK4RQkeismtExkV8NfxS4amjEoQPNbpjFCNN9zTfvg', 0, NULL, 0, NULL, NULL),
(4, 'aaab@gmail.com', '[\"ROLE_ADMIN\"]', '$argon2id$v=19$m=65536,t=4,p=1$LpMmMJtFgmztw6eLkb3Qdw$bHQJSgP3O3yB57XTALkTRjdQcYTf+vGWi4sRFcS98F4', 0, NULL, 0, NULL, NULL),
(5, '167144373@mail.com', '[]', '636916451', 0, NULL, 1, '', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user_badge`
--

CREATE TABLE `user_badge` (
  `user_id` int(11) NOT NULL,
  `badge_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user_badge`
--

INSERT INTO `user_badge` (`user_id`, `badge_id`) VALUES
(2, 1),
(2, 3);

-- --------------------------------------------------------

--
-- Structure de la table `user_deal`
--

CREATE TABLE `user_deal` (
  `user_id` int(11) NOT NULL,
  `deal_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user_deal`
--

INSERT INTO `user_deal` (`user_id`, `deal_id`) VALUES
(1, 1),
(2, 1),
(2, 4);

-- --------------------------------------------------------

--
-- Structure de la table `vote`
--

CREATE TABLE `vote` (
  `id` int(11) NOT NULL,
  `utilisateur_id` int(11) NOT NULL,
  `deal_id` int(11) NOT NULL,
  `valeur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `vote`
--

INSERT INTO `vote` (`id`, `utilisateur_id`, `deal_id`, `valeur`) VALUES
(114, 2, 1, 150),
(115, 2, 3, -1),
(116, 2, 2, 1),
(117, 2, 5, 1),
(118, 2, 4, 500),
(119, 2, 7, 1),
(120, 2, 8, -1),
(121, 1, 2, -50);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `alerte`
--
ALTER TABLE `alerte`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_3AE753AA76ED395` (`user_id`);

--
-- Index pour la table `badge`
--
ALTER TABLE `badge`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_FEF0481D6C6E55B5` (`nom`);

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_67F068BC60BB6FE6` (`auteur_id`),
  ADD KEY `IDX_67F068BCF60E2305` (`deal_id`);

--
-- Index pour la table `deal`
--
ALTER TABLE `deal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E3FEC116F675F31B` (`author_id`);

--
-- Index pour la table `deal_groupe`
--
ALTER TABLE `deal_groupe`
  ADD PRIMARY KEY (`deal_id`,`groupe_id`),
  ADD KEY `IDX_10FE0FADF60E2305` (`deal_id`),
  ADD KEY `IDX_10FE0FAD7A45358C` (`groupe_id`);

--
-- Index pour la table `deal_partenaire`
--
ALTER TABLE `deal_partenaire`
  ADD PRIMARY KEY (`deal_id`,`partenaire_id`),
  ADD KEY `IDX_D3E10296F60E2305` (`deal_id`),
  ADD KEY `IDX_D3E1029698DE13AC` (`partenaire_id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `groupe`
--
ALTER TABLE `groupe`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `partenaire`
--
ALTER TABLE `partenaire`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`),
  ADD UNIQUE KEY `UNIQ_8D93D6497BA2F5EB` (`api_token`);

--
-- Index pour la table `user_badge`
--
ALTER TABLE `user_badge`
  ADD PRIMARY KEY (`user_id`,`badge_id`),
  ADD KEY `IDX_1C32B345A76ED395` (`user_id`),
  ADD KEY `IDX_1C32B345F7A2C2FC` (`badge_id`);

--
-- Index pour la table `user_deal`
--
ALTER TABLE `user_deal`
  ADD PRIMARY KEY (`user_id`,`deal_id`),
  ADD KEY `IDX_997F8DDFA76ED395` (`user_id`),
  ADD KEY `IDX_997F8DDFF60E2305` (`deal_id`);

--
-- Index pour la table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_5A108564FB88E14F` (`utilisateur_id`),
  ADD KEY `IDX_5A108564F60E2305` (`deal_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `alerte`
--
ALTER TABLE `alerte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `badge`
--
ALTER TABLE `badge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `deal`
--
ALTER TABLE `deal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `groupe`
--
ALTER TABLE `groupe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `partenaire`
--
ALTER TABLE `partenaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `vote`
--
ALTER TABLE `vote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `alerte`
--
ALTER TABLE `alerte`
  ADD CONSTRAINT `FK_3AE753AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `FK_67F068BC60BB6FE6` FOREIGN KEY (`auteur_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_67F068BCF60E2305` FOREIGN KEY (`deal_id`) REFERENCES `deal` (`id`);

--
-- Contraintes pour la table `deal`
--
ALTER TABLE `deal`
  ADD CONSTRAINT `FK_E3FEC116F675F31B` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `deal_groupe`
--
ALTER TABLE `deal_groupe`
  ADD CONSTRAINT `FK_10FE0FAD7A45358C` FOREIGN KEY (`groupe_id`) REFERENCES `groupe` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_10FE0FADF60E2305` FOREIGN KEY (`deal_id`) REFERENCES `deal` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `deal_partenaire`
--
ALTER TABLE `deal_partenaire`
  ADD CONSTRAINT `FK_D3E1029698DE13AC` FOREIGN KEY (`partenaire_id`) REFERENCES `partenaire` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_D3E10296F60E2305` FOREIGN KEY (`deal_id`) REFERENCES `deal` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `user_badge`
--
ALTER TABLE `user_badge`
  ADD CONSTRAINT `FK_1C32B345A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_1C32B345F7A2C2FC` FOREIGN KEY (`badge_id`) REFERENCES `badge` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `user_deal`
--
ALTER TABLE `user_deal`
  ADD CONSTRAINT `FK_997F8DDFA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_997F8DDFF60E2305` FOREIGN KEY (`deal_id`) REFERENCES `deal` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `vote`
--
ALTER TABLE `vote`
  ADD CONSTRAINT `FK_5A108564F60E2305` FOREIGN KEY (`deal_id`) REFERENCES `deal` (`id`),
  ADD CONSTRAINT `FK_5A108564FB88E14F` FOREIGN KEY (`utilisateur_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
