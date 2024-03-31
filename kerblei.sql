-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 31 mars 2024 à 23:08
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `kerblei`
--

-- --------------------------------------------------------

--
-- Structure de la table `cart`
--

CREATE TABLE `cart` (
  `cartId` int(11) NOT NULL,
  `orderDate` date DEFAULT NULL,
  `deliveryDate` date DEFAULT NULL,
  `statement` enum('pending','completed','cancelled') DEFAULT NULL,
  `accountId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `cart`
--

INSERT INTO `cart` (`cartId`, `orderDate`, `deliveryDate`, `statement`, `accountId`) VALUES
(1, '2024-03-01', '2024-03-02', 'pending', 1);

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `type` enum('blanche','brune','rousse','ambree','whisky') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `kerbleiuser`
--

CREATE TABLE `kerbleiuser` (
  `accountId` int(11) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  `isAdmin` tinyint(1) DEFAULT 0,
  `name` varchar(20) DEFAULT NULL,
  `firstname` varchar(20) DEFAULT NULL,
  `phone` varchar(14) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `kerbleiuser`
--

INSERT INTO `kerbleiuser` (`accountId`, `mail`, `password`, `isAdmin`, `name`, `firstname`, `phone`) VALUES
(1, 'mathildamilsom@example.com', 'mdp', 0, 'Milsom', 'Mathilda', '02 02 02 02 02'),
(2, 'yoannlecerf@example.com', 'mdp', 1, NULL, NULL, NULL),
(15, 'georges@heaven.bzh', '$2y$10$wDJ02a9SVah1HnjUAJE7/ekVgnkqBKbz.g/hHXsFQsA', 0, 'Brassens', 'Georges', '01 01 01 01 01'),
(16, 'bob@heaven.bzh', '$2y$10$ND1TwYG6i05M/8XDVSpq5u0ZvKuHJShHz.RK9jsJ6fD', 0, 'Marley', 'Bob', '02 02 02 02 02'),
(17, 'jl@heaven.bzh', '$2y$10$GA3zUlOPERUyDhtgH.tZOeWUDPuZr2OS5p5jj/9hkTd', 0, 'Murat', 'Jean-Louis', '03 03 03 03 03'),
(18, 'ct@heaven.com', '$2y$10$EYlxzuOil9JslvdhYtLTb.w0HMk5VALKqSf4rj/.nTe', 0, 'Trénet', 'Charles', '04 04 04 04 04'),
(19, 'nina@heaven.bzh', '$2y$10$XzaslvgCzKzJaLGcJRYNF.ulBDNtJeLOx5687YIMhXm', 0, 'Simone', 'Nina', '05 05 05 05 05');

-- --------------------------------------------------------

--
-- Structure de la table `orderproduct`
--

CREATE TABLE `orderproduct` (
  `productId` int(11) NOT NULL,
  `cartId` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `orderproduct`
--

INSERT INTO `orderproduct` (`productId`, `cartId`, `quantity`) VALUES
(1, 1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE `product` (
  `productId` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `designation` varchar(50) DEFAULT NULL,
  `unitPrice` decimal(4,2) DEFAULT NULL,
  `pictureRef` varchar(50) DEFAULT NULL,
  `degree` varchar(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`productId`, `name`, `designation`, `unitPrice`, `pictureRef`, `degree`) VALUES
(1, 'Ambrée ', 'Saveur affirmée, profil malté, onctueuse', 5.00, 'bAmbree.jpg', '6,1 %.vol'),
(2, 'I.P.A', '  Blonde Ale , houblonnage aromatique ++++', 5.00, 'bIpa.jpg', '5,5 %,vol'),
(3, 'Blonde', 'Légère amertume, reflets dorés, saveur fruitée', 5.00, 'blonde.jpg', '5% vol'),
(4, 'Blonde d \'été', 'Corps léger, notes d\'agrumes, rafraichissante', 5.00, 'blondeEte.jpg', '5,5 % vol');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartId`),
  ADD KEY `accountId` (`accountId`);

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`type`);

--
-- Index pour la table `kerbleiuser`
--
ALTER TABLE `kerbleiuser`
  ADD PRIMARY KEY (`accountId`),
  ADD UNIQUE KEY `mail` (`mail`);

--
-- Index pour la table `orderproduct`
--
ALTER TABLE `orderproduct`
  ADD PRIMARY KEY (`productId`,`cartId`),
  ADD KEY `cartId` (`cartId`);

--
-- Index pour la table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productId`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `kerbleiuser`
--
ALTER TABLE `kerbleiuser`
  MODIFY `accountId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `product`
--
ALTER TABLE `product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`accountId`) REFERENCES `kerbleiuser` (`accountId`);

--
-- Contraintes pour la table `orderproduct`
--
ALTER TABLE `orderproduct`
  ADD CONSTRAINT `orderproduct_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`),
  ADD CONSTRAINT `orderproduct_ibfk_2` FOREIGN KEY (`cartId`) REFERENCES `cart` (`cartId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
