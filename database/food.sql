-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 24 nov. 2020 à 14:03
-- Version du serveur :  10.4.13-MariaDB
-- Version de PHP : 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `food`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nom` varchar(200) NOT NULL,
  `prenom` varchar(200) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `telephone` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `nom`, `prenom`, `email`, `password`, `telephone`) VALUES
(1, 'ayoub', 'elbouinany', 'ayoub.elbouinany99@gmail.com', 'Ayoub123@', '0612890680');

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE `commandes` (
  `id` int(11) NOT NULL,
  `prenom` int(11) NOT NULL,
  `nom` int(11) NOT NULL,
  `numeo_telephone` varchar(50) NOT NULL,
  `prixTotal` int(11) NOT NULL,
  `adresse` text NOT NULL,
  `email` varchar(115) DEFAULT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`id`, `prenom`, `nom`, `numeo_telephone`, `prixTotal`, `adresse`, `email`, `date`) VALUES
(2, 0, 0, '0680214562', 40, '20160', 'ayoub.elbouinany99@gmail.com', '2020-11-24'),
(3, 0, 0, '0680214562', 40, '20160', 'ayoub.elbouinany99@gmail.com', '2020-11-24'),
(4, 0, 0, '0680214562', 20, '20160', 'ayoub.elbouinany99@gmail.com', '2020-11-24'),
(5, 0, 0, '0680214562', 20, '20160', 'ayoub.elbouinany99@gmail.com', '2020-11-24'),
(6, 0, 0, '0680214562', 20, '20160', 'ayoub.elbouinany99@gmail.com', '2020-11-24'),
(7, 0, 0, '0680214562', 20, '20160', 'ayoub.elbouinany99@gmail.com', '2020-11-24'),
(8, 0, 0, '0680214562', 40, '20160', 'sulttan@gmail.com', '2020-11-24'),
(9, 0, 0, '098088898', 20, 'safi  trab sini maroc', 'adam.jawhar@gmail.com', '2020-11-24');

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `id` int(11) NOT NULL,
  `idPlate` int(11) NOT NULL,
  `quantite` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `plate`
--

CREATE TABLE `plate` (
  `id` int(11) NOT NULL,
  `nom` varchar(300) NOT NULL,
  `prix` int(11) NOT NULL,
  `quantite` int(5) NOT NULL,
  `image` varchar(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `plate`
--

INSERT INTO `plate` (`id`, `nom`, `prix`, `quantite`, `image`, `description`) VALUES
(1, 'Tagliatelle au saumon', 20, 10, 'saumon.jpg', 'Tagliatelle au saumon et au parmesan'),
(2, 'Emincé de Poulet aux Champignons et Pâtes', 20, 8, 'champignons.jpg', 'Emincé de Poulet aux Champignons et Pâtes'),
(3, 'Linguine Frutti di Mare', 20, 7, 'linguine-frutti-di-mare.jpg', 'Très bon plat de Linguine aux fruits de mer.'),
(4, 'Penne pesto jalapenos\r\n(Plat épicé)', 20, 11, 'penne-pesto-jalapenos.jpg', 'Une explosion de saveur dans ce plat épicé .'),
(5, 'Tagliatelle à la crème de truffes', 20, 12, 'tagliatelle-a-la-creme-de-truffes.jpg', 'Tagliatelle parsemés de lamelles de truffe .'),
(6, 'Royal Roll', 20, 6, 'royal-roll.jpg', 'Royal Roll'),
(7, 'Pizza Japonaise(8 pièces)', 20, 10, 'pizza-japonaise.jpg', 'Pizza Japonaise'),
(8, 'Sashimi Saumon', 20, 8, 'sashimi-saumon.jpg', '4 pièces de saumon frais avec du wokami'),
(9, 'Lasagnes bolognaises', 20, 7, 'lasagnes-bolognaises.jpg', 'Merveilleux classique de la cuisine italienne : délice en toute saison.'),
(10, 'Pizza Meatball', 20, 11, 'pizza-meatball.jpg', 'Une délicieuse pizza comprenant de la viande hachée, sauce tomate et de la mozarella rapée.'),
(11, 'Pizza à la crème de truffes', 20, 12, 'pizza-a-la-creme-de-truffes.jpg', 'Une pizza originale qui sent délicieusement bon la truffe.'),
(12, 'Parmigiana', 20, 6, 'parmigiana.jpg', 'parmigiana'),
(13, 'Crevettes Pannées', 20, 6, 'crevettes-pannees.jpg', 'Crevettes Pannées'),
(14, 'Stir Fried Noodles', 20, 15, 'stir-fried-noodle.jpg', 'Très bon wok au Poulet, Crevette, Légumes, Basilic, Coriandre, Noodles'),
(15, 'Sandwich Italien', 20, 15, 'sandwich-italien.jpg', 'Sandwich poulet à l\'italienne.'),
(16, 'American burger', 20, 10, 'american-burger.jpg', 'Voilà à quoi ressemble un burger made in USA ! Régalez-vous en commandant l\'americain burger par excellence.'),
(17, 'Stir Fried Chicken', 20, 15, 'stir-fried-chicken.jpg', 'Délicieuse recette de poulet avec des légumes et du Riz'),
(18, 'Nems poulet', 20, 15, 'nems-poulet.jpg', 'Nems poulet'),
(19, 'Pizza Kebab', 20, 11, 'pizza-kebab.jpg', 'Pizza Kebab'),
(20, 'California Tiger Rolls', 20, 1, 'california-tiger-rolls.jpg', 'California Tiger Rolls.');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `plate`
--
ALTER TABLE `plate`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `plate`
--
ALTER TABLE `plate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
