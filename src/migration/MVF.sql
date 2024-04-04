-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 27 mars 2024 à 09:55
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `festivalv2`
--

-- --------------------------------------------------------

--
-- Structure de la table `mvf_avoir`
--

DROP TABLE IF EXISTS `mvf_avoir`;
CREATE TABLE IF NOT EXISTS `mvf_avoir` (
  `Id_nuit` int NOT NULL,
  `Id_reservation` int NOT NULL,
  `Date` date NOT NULL,
  PRIMARY KEY (`Id_nuit`,`Id_reservation`),
  KEY `MVF_Avoir_MVF_Reservation0_FK` (`Id_reservation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `mvf_contenir`
--

DROP TABLE IF EXISTS `mvf_contenir`;
CREATE TABLE IF NOT EXISTS `mvf_contenir` (
  `Id_Place` int NOT NULL,
  `Id_reservation` int NOT NULL,
  PRIMARY KEY (`Id_Place`,`Id_reservation`),
  KEY `MVF_Contenir_MVF_Reservation0_FK` (`Id_reservation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `mvf_nuit`
--

DROP TABLE IF EXISTS `mvf_nuit`;
CREATE TABLE IF NOT EXISTS `mvf_nuit` (
  `Id_nuit` int NOT NULL AUTO_INCREMENT,
  `Name_nuit` varchar(80) NOT NULL,
  `Prix_nuit` float NOT NULL,
  PRIMARY KEY (`Id_nuit`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `mvf_nuit`
--

INSERT INTO `mvf_nuit` (`Id_nuit`, `Name_nuit`, `Prix_nuit`) VALUES
(1, 'Pour une nuit', 5),
(4, 'Pour les 3 nuits', 12);

-- --------------------------------------------------------

--
-- Structure de la table `mvf_place`
--

DROP TABLE IF EXISTS `mvf_place`;
CREATE TABLE IF NOT EXISTS `mvf_place` (
  `Id_Place` int NOT NULL AUTO_INCREMENT,
  `Nom_place` varchar(255) NOT NULL,
  `Tarif_place` float NOT NULL,
  `Date_place` date NOT NULL,
  `Tarif_Reduit` tinyint(1) NOT NULL,
  PRIMARY KEY (`Id_Place`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `mvf_place`
--

INSERT INTO `mvf_place` (`Id_Place`, `Nom_place`, `Tarif_place`, `Date_place`, `Tarif_Reduit`) VALUES
(1, 'Pass 1 jour', 25, '2024-07-01', 1),
(2, 'Pass 1 jour', 25, '2024-07-02', 1),
(3, 'Pass 1 jour', 25, '2024-07-03', 1),
(4, 'Pass 2 jours', 50, '2024-07-01', 1),
(5, 'Pass 2 jours', 50, '2024-07-02', 1),
(6, 'Pass 2 jours', 65, '2024-07-01', 1),
(7, 'Pass 1 jour', 40, '2024-07-01', 0),
(8, 'Pass 1 jour', 40, '2024-07-02', 0),
(9, 'Pass 1 jour', 40, '2024-07-03', 0),
(10, 'Pass 2 jours', 70, '2024-07-01', 0),
(11, 'Pass 2 jours', 70, '2024-07-02', 0),
(12, 'Pass 3 jours', 100, '2024-07-01', 0);

-- --------------------------------------------------------

--
-- Structure de la table `mvf_reservation`
--

DROP TABLE IF EXISTS `mvf_reservation`;
CREATE TABLE IF NOT EXISTS `mvf_reservation` (
  `Id_reservation` int NOT NULL AUTO_INCREMENT,
  `Nombre_reservation` int NOT NULL,
  `Enfant_reservation` tinyint(1) NOT NULL,
  `Luge_reservation` int NOT NULL,
  `Casque_reservation` int NOT NULL,
  `Id_User` int NOT NULL,
  PRIMARY KEY (`Id_reservation`),
  KEY `MVF_Reservation_MVF_User_FK` (`Id_User`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `mvf_user`
--

DROP TABLE IF EXISTS `mvf_user`;
CREATE TABLE IF NOT EXISTS `mvf_user` (
  `Id_User` int NOT NULL AUTO_INCREMENT,
  `Nom` varchar(50) NOT NULL,
  `Prenom` varchar(50) NOT NULL,
  `Adresse` varchar(80) NOT NULL,
  `Mdp` varchar(255) NOT NULL,
  `Role` tinyint(1) NOT NULL,
  `RGPD` date NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Tel` int NOT NULL,
  PRIMARY KEY (`Id_User`),
  UNIQUE KEY `MVF_User_AK` (`Email`,`Tel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `mvf_avoir`
--
ALTER TABLE `mvf_avoir`
  ADD CONSTRAINT `MVF_Avoir_MVF_Nuit_FK` FOREIGN KEY (`Id_nuit`) REFERENCES `mvf_nuit` (`Id_nuit`),
  ADD CONSTRAINT `MVF_Avoir_MVF_Reservation0_FK` FOREIGN KEY (`Id_reservation`) REFERENCES `mvf_reservation` (`Id_reservation`);

--
-- Contraintes pour la table `mvf_contenir`
--
ALTER TABLE `mvf_contenir`
  ADD CONSTRAINT `MVF_Contenir_MVF_Place_FK` FOREIGN KEY (`Id_Place`) REFERENCES `mvf_place` (`Id_Place`),
  ADD CONSTRAINT `MVF_Contenir_MVF_Reservation0_FK` FOREIGN KEY (`Id_reservation`) REFERENCES `mvf_reservation` (`Id_reservation`);

--
-- Contraintes pour la table `mvf_reservation`
--
ALTER TABLE `mvf_reservation`
  ADD CONSTRAINT `MVF_Reservation_MVF_User_FK` FOREIGN KEY (`Id_User`) REFERENCES `mvf_user` (`Id_User`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
