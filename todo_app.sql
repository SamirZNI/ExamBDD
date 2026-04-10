-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : ven. 10 avr. 2026 à 07:38
-- Version du serveur : 5.7.24
-- Version de PHP : 8.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `todo_app`
--

-- --------------------------------------------------------

--
-- Structure de la table `taches`
--

CREATE TABLE `taches` (
  `id` int(11) NOT NULL,
  `titre` varchar(150) NOT NULL,
  `description` text,
  `statut` enum('a_faire','en_cours','termine') DEFAULT 'a_faire',
  `priorite` varchar(50) DEFAULT NULL,
  `date_limite` date DEFAULT NULL,
  `date_creation` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `taches`
--

INSERT INTO `taches` (`id`, `titre`, `description`, `statut`, `priorite`, `date_limite`, `date_creation`) VALUES
(4, 'Faire la BDD', 'Créer les tables SQL', 'termine', 'haute', '2026-04-10', '2026-04-10'),
(5, 'Faire le HTML', 'Créer les formulaires', 'en_cours', 'normale', '2026-04-15', '2026-04-10'),
(6, 'Faire le CSS', 'Styliser les pages', 'a_faire', 'basse', '2026-04-20', '2026-04-10');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `taches`
--
ALTER TABLE `taches`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `taches`
--
ALTER TABLE `taches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
