-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : dim. 27 nov. 2022 à 15:10
-- Version du serveur :  5.7.34
-- Version de PHP : 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projetmcd`
--

-- --------------------------------------------------------

--
-- Structure de la table `affectation`
--

CREATE TABLE `affectation` (
  `id_projets` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `affectation`
--

INSERT INTO `affectation` (`id_projets`, `id_users`, `admin`) VALUES
(2, 1, 1),
(3, 1, 0),
(4, 1, 0),
(5, 1, 0),
(6, 1, 0),
(2, 2, 0),
(3, 2, 1),
(4, 2, 0),
(5, 2, 0),
(6, 2, 0),
(2, 3, 0),
(3, 3, 0),
(4, 3, 1),
(5, 3, 0),
(6, 3, 0),
(2, 4, 0),
(3, 4, 0),
(4, 4, 0),
(5, 4, 1),
(6, 4, 0),
(2, 5, 0),
(3, 5, 0),
(4, 5, 0),
(5, 5, 0),
(6, 5, 1),
(7, 6, 1),
(7, 4, 0),
(7, 5, 0),
(7, 1, 0),
(7, 2, 0),
(7, 3, 0);

-- --------------------------------------------------------

--
-- Structure de la table `projets`
--

CREATE TABLE `projets` (
  `id` int(11) NOT NULL,
  `libelle` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `projets`
--

INSERT INTO `projets` (`id`, `libelle`) VALUES
(2, 'Projet 1'),
(3, 'Projet 2'),
(4, 'Projet 3'),
(5, 'Projet 4'),
(6, 'Projet 5'),
(7, 'Projet 6');

-- --------------------------------------------------------

--
-- Structure de la table `taches`
--

CREATE TABLE `taches` (
  `id` int(11) NOT NULL,
  `titre` varchar(50) NOT NULL,
  `priorite` varchar(50) NOT NULL,
  `statut` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `id_users` int(11) NOT NULL,
  `id_projets` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `taches`
--

INSERT INTO `taches` (`id`, `titre`, `priorite`, `statut`, `description`, `id_users`, `id_projets`) VALUES
(1, 'Tâche 2 - 1', '3', 'Non Débuté', 'Tâche 2 - 1 Description', 1, 3),
(2, 'Tâche 2 - 2', '2', 'En Cours', 'Tâche 2 - 2 Description', 3, 3),
(3, 'Tâche 2 - 3', '1', 'Terminé', 'Tâche 2 - 3 Description', 4, 3),
(7, 'Tâche 1 - 1', '3', 'Non Débuté', 'Tâche 1 - 1 Description', 5, 2),
(8, 'Tâche 1 - 2', '2', 'En Cours', 'Tâche 1 - 2 Description', 6, 2),
(9, 'Tâche 1 - 3', '1', 'Terminé', 'Tâche 1 - 3 Description', 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `pwd` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `pseudo`, `mail`, `pwd`) VALUES
(1, 'gk', 'gk@gmail.fr', '123'),
(2, 'ks', 'ks@gmail.fr', '123'),
(3, 'ls', 'ls@gmail.fr', '123'),
(4, 'cp', 'cp@gmail.fr', '123'),
(5, 'er', 'er@gmail.fr', '123'),
(6, 'cc', 'cc@gmail.fr', '123');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `affectation`
--
ALTER TABLE `affectation`
  ADD KEY `fk_affectation_projets` (`id_projets`),
  ADD KEY `fk_affectation_users` (`id_users`);

--
-- Index pour la table `projets`
--
ALTER TABLE `projets`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `taches`
--
ALTER TABLE `taches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_taches_projets` (`id_projets`),
  ADD KEY `fk_taches_users` (`id_users`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `projets`
--
ALTER TABLE `projets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `taches`
--
ALTER TABLE `taches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `affectation`
--
ALTER TABLE `affectation`
  ADD CONSTRAINT `fk_affectation_projets` FOREIGN KEY (`id_projets`) REFERENCES `projets` (`id`),
  ADD CONSTRAINT `fk_affectation_users` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `taches`
--
ALTER TABLE `taches`
  ADD CONSTRAINT `fk_taches_projets` FOREIGN KEY (`id_projets`) REFERENCES `projets` (`id`),
  ADD CONSTRAINT `fk_taches_users` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
