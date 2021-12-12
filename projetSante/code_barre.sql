-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 02 déc. 2021 à 11:25
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `code_barre`
--

-- --------------------------------------------------------

--
-- Structure de la table `maladie`
--

CREATE TABLE `maladie` (
  `idmaladie` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `maladie` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `medical`
--

CREATE TABLE `medical` (
  `idmedical` int(11) NOT NULL,
  `idutilisateur` int(11) NOT NULL,
  `idvaccin` int(11) NOT NULL,
  `idmaladie` int(11) NOT NULL,
  `idprescription` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `prescription`
--

CREATE TABLE `prescription` (
  `idprescription` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `duree` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `prescription` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `idutilisateur` int(10) NOT NULL,
  `identifiant` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `naissance` date NOT NULL,
  `sexe` varchar(11) NOT NULL,
  `mail` varchar(30) NOT NULL,
  `telephone` int(11) NOT NULL,
  `portable` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idutilisateur`, `identifiant`, `nom`, `prenom`, `naissance`, `sexe`, `mail`, `telephone`, `portable`) VALUES
(1, 108420, 'yoy', 'yiyi', '2021-11-02', 'femme', 'azert@sfer.zt', 123456789, 654789234);

-- --------------------------------------------------------

--
-- Structure de la table `vaccin`
--

CREATE TABLE `vaccin` (
  `idvaccin` int(11) NOT NULL,
  `idnom` int(11) NOT NULL,
  `date` date NOT NULL,
  `vaccin` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `vaccineur`
--

CREATE TABLE `vaccineur` (
  `idnom` int(11) NOT NULL,
  `nom` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `maladie`
--
ALTER TABLE `maladie`
  ADD PRIMARY KEY (`idmaladie`);

--
-- Index pour la table `medical`
--
ALTER TABLE `medical`
  ADD PRIMARY KEY (`idmedical`),
  ADD KEY `idutilisateur` (`idutilisateur`),
  ADD KEY `idprescription` (`idprescription`),
  ADD KEY `idmaladie` (`idmaladie`),
  ADD KEY `idvaccin` (`idvaccin`);

--
-- Index pour la table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`idprescription`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`idutilisateur`);

--
-- Index pour la table `vaccin`
--
ALTER TABLE `vaccin`
  ADD PRIMARY KEY (`idvaccin`),
  ADD KEY `idnom` (`idnom`);

--
-- Index pour la table `vaccineur`
--
ALTER TABLE `vaccineur`
  ADD PRIMARY KEY (`idnom`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `maladie`
--
ALTER TABLE `maladie`
  MODIFY `idmaladie` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `medical`
--
ALTER TABLE `medical`
  MODIFY `idmedical` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `idprescription` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `idutilisateur` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `vaccin`
--
ALTER TABLE `vaccin`
  MODIFY `idvaccin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `vaccineur`
--
ALTER TABLE `vaccineur`
  MODIFY `idnom` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `medical`
--
ALTER TABLE `medical`
  ADD CONSTRAINT `medical_ibfk_1` FOREIGN KEY (`idutilisateur`) REFERENCES `utilisateur` (`idutilisateur`),
  ADD CONSTRAINT `medical_ibfk_2` FOREIGN KEY (`idprescription`) REFERENCES `prescription` (`idprescription`),
  ADD CONSTRAINT `medical_ibfk_3` FOREIGN KEY (`idmaladie`) REFERENCES `maladie` (`idmaladie`),
  ADD CONSTRAINT `medical_ibfk_4` FOREIGN KEY (`idvaccin`) REFERENCES `vaccin` (`idvaccin`);

--
-- Contraintes pour la table `vaccin`
--
ALTER TABLE `vaccin`
  ADD CONSTRAINT `vaccin_ibfk_1` FOREIGN KEY (`idnom`) REFERENCES `vaccineur` (`idnom`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
