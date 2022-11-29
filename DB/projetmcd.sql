-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 29, 2022 at 11:17 AM
-- Server version: 5.7.24
-- PHP Version: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projetmcd`
--

-- --------------------------------------------------------

--
-- Table structure for table `affectation`
--

CREATE TABLE `affectation` (
  `id_projets` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `affectation`
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
-- Table structure for table `projets`
--

CREATE TABLE `projets` (
  `id` int(11) NOT NULL,
  `libelle` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projets`
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
-- Table structure for table `taches`
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
-- Dumping data for table `taches`
--

INSERT INTO `taches` (`id`, `titre`, `priorite`, `statut`, `description`, `id_users`, `id_projets`) VALUES
(1, 'Tâche 2 - 1', '3', 'Non Débuté', 'Tâche 2 - 1 Description', 1, 3),
(2, 'Tâche 2 - 2', '2', 'En Cours', 'Tâche 2 - 2 Description', 3, 3),
(3, 'Tâche 2 - 3', '1', 'Terminé', 'Tâche 2 - 3 Description', 4, 3),
(7, 'Tâche 1 - 1', '3', 'Non Débuté', 'Tâche 1 - 1 Description', 5, 2),
(8, 'Tâche 1 - 2', '2', 'En Cours', 'Tâche 1 - 2 Description', 6, 2),
(9, 'Tâche 1 - 3', '1', 'Terminé', 'Tâche 1 - 3 Description', 2, 2),
(10, 'Tâche 3 - 1', '3', 'Non Débuté', 'Tâche 3 - 1 Description', 1, 4),
(11, 'Tâche 3 - 2', '2', 'En Cours', 'Tâche 3 - 2 Description', 2, 4),
(12, 'Tâche 3 - 3', '1', 'Terminé', 'Tâche 3 - 3 Description', 4, 4),
(13, 'Tâche 4 - 1', '3', 'Non Débuté', 'Tâche 4 - 1 Description', 5, 5),
(14, 'Tâche 4 - 2', '2', 'En cours', 'Tâche 4 - 2 Description', 6, 5),
(15, 'Tâche 4 - 3', '1', 'Terminé', 'Tâche 4 - 3 Description', 1, 5),
(16, 'Tâche 5 - 1', '3', 'Non Débuté', 'Tâche 5 - 1 Description', 2, 6),
(17, 'Tâche 5 - 2', '2', 'En Cours', 'Tâche 5 - 2 Description', 3, 6),
(18, 'Tâche 5 - 3', '1', 'Terminé', 'Tâche 5 - 3', 6, 6),
(19, 'Tâche 6 - 1', '3', 'Non Débuté', 'Tâche 6 - 1 Description', 4, 7),
(20, 'Tâche 6 - 2', '2', 'En cours', 'Tâche 6 - 2 Description', 5, 7),
(21, 'Tâche 6 - 3', '1', 'Terminé', 'Tâche 6 - 3 Description', 3, 7);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `pwd` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `pseudo`, `mail`, `pwd`) VALUES
(1, 'gk', 'gk@gmail.fr', '$2y$10$e2IwcYkzcsqE2cLjXshvheoA7gfy.n3V.InOPAwG7ScAc1x.9XN1a'),
(2, 'ks', 'ks@gmail.fr', '$2y$10$O2aA3KTQDcQyh7kKwaGQBOxdQ.DLMvMR.SLZn9G/LjzAfcTga1pe2'),
(3, 'ls', 'ls@gmail.fr', '$2y$10$vdptW6lxHk5yfAz79E4a6.VG1/WT5WX/EWCog5I2qJ0yxmCxDmdim'),
(4, 'cp', 'cp@gmail.fr', '$2y$10$19xDuNVQT8MhjDE7MAlGr.IdXTnsSXGxmOygnTmHeF4945/ZKjqJq'),
(5, 'er', 'er@gmail.fr', '$2y$10$TiSIrtE3S4G6BhWJsdrsVe94JFDbEfIjrkSQPMxqjMSpm9uuMKbPS'),
(6, 'cc', 'cc@gmail.fr', '$2y$10$jHc0dA0uIb9hQddf30vQLOclmMlRn2snKSTTP19FsYBPYRuuAWGym');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `affectation`
--
ALTER TABLE `affectation`
  ADD KEY `fk_affectation_projets` (`id_projets`),
  ADD KEY `fk_affectation_users` (`id_users`);

--
-- Indexes for table `projets`
--
ALTER TABLE `projets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taches`
--
ALTER TABLE `taches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_taches_projets` (`id_projets`),
  ADD KEY `fk_taches_users` (`id_users`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `projets`
--
ALTER TABLE `projets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `taches`
--
ALTER TABLE `taches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `affectation`
--
ALTER TABLE `affectation`
  ADD CONSTRAINT `fk_affectation_projets` FOREIGN KEY (`id_projets`) REFERENCES `projets` (`id`),
  ADD CONSTRAINT `fk_affectation_users` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`);

--
-- Constraints for table `taches`
--
ALTER TABLE `taches`
  ADD CONSTRAINT `fk_taches_projets` FOREIGN KEY (`id_projets`) REFERENCES `projets` (`id`),
  ADD CONSTRAINT `fk_taches_users` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
