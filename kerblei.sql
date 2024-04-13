-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 12 avr. 2024 à 12:48
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
-- Base de données : `gretaxao_lozachma`
--

-- --------------------------------------------------------

--
-- Structure de la table `cart`
--

CREATE TABLE `cart` (
  `cartId` int(11) NOT NULL,
  `orderDate` date DEFAULT NULL,
  `deliveryDate` date DEFAULT NULL,
  `statement` enum('en gestation','validée','terminée') DEFAULT NULL,
  `accountId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `cart`
--

INSERT INTO `cart` (`cartId`, `orderDate`, `deliveryDate`, `statement`, `accountId`) VALUES
(2, '2024-04-08', '2024-04-09', 'terminée', 32),
(3, '2024-04-10', '2024-04-15', 'terminée', 32),
(4, '2024-04-10', '2024-06-10', 'validée', 32);

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
  `password` varchar(100) DEFAULT NULL,
  `isAdmin` tinyint(1) DEFAULT 0,
  `name` varchar(20) DEFAULT NULL,
  `firstname` varchar(20) DEFAULT NULL,
  `phone` varchar(14) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `kerbleiuser`
--

INSERT INTO `kerbleiuser` (`accountId`, `mail`, `password`, `isAdmin`, `name`, `firstname`, `phone`) VALUES
(30, 'charles@heaven.bzh', '$2y$10$nWLIjsbLV/zEkUMr7qydYehRn9uRk4PMYhkHZVBJ9/zNqNN6.2Yt.', 0, 'Trénet', 'Charles', '06 06 06 06 06'),
(31, 'yohann@free.bzh', '$2y$10$97ycUKu9C.jbGEIY7dAWleejlG7yfxltS4O0Fp0k9Dj93sbLsExXC', 1, 'Lecerf', 'Yohann', NULL),
(32, 'mathilda@free.bzh', '$2y$10$GokuR5fgmJPcHdplWcU1FOTTk4UMSflHLqldm22kfEaDeV7JLI1G2', 0, 'Milsom', 'Mathilda', '08 08 08 08 08'),
(33, 'jj@heaven.bzh', '$2y$10$2cW/q7EB/QESV4kt5dpniOTd9O4lu/RjwY3LJkkhBkEJmX8HUAjtW', 0, 'Murat', 'Jean-Louis', '03 03 03 03 03');

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
(1, 2, 3),
(2, 2, 2),
(4, 3, 1),
(4, 4, 1),
(11, 3, 2);

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE `product` (
  `productId` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `designation` varchar(70) DEFAULT NULL,
  `unitPrice` decimal(4,2) DEFAULT NULL,
  `pictureRef` varchar(50) DEFAULT NULL,
  `degree` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`productId`, `name`, `designation`, `unitPrice`, `pictureRef`, `degree`) VALUES
(1, 'Ambrée ', 'Saveur affirmée, profil malté, onctueuse', 5.00, 'bAmbree.jpg', '6,1'),
(2, 'I.P.A', '  Blonde Ale , houblonnage aromatique ++++', 5.00, 'bIpa.jpg', '5,5'),
(3, 'Blonde', 'Légère amertume, reflets dorés, saveur fruitée', 5.00, 'blonde.jpg', '5'),
(4, 'Blonde d \'été', 'Corps léger, notes d\'agrumes, rafraichissante', 5.00, 'blondeEte.jpg', '5,5'),
(8, 'Blonde des sept Iles', 'Lager, à base de 3 céréales (blé, orge et seigle),', 5.00, 'blonde7iles.jpg', '5'),
(11, 'Brune', 'Houblon floral, notes de café et chocolat', 5.00, 'brune.jpg', '6,3'),
(13, 'Rigad\'elle', 'Ambrée au miel de Baden', 5.00, 'bRigadElle.jpg', '7'),
(14, 'Rousse', 'Caractère fleuri, robe rougeoyante, houblon plus aromatique', 5.00, 'bRousse.jpg', '5,4'),
(15, 'Triple', 'Blonde de triple fermentation, aromatisée à la fleur de sureau', 6.00, 'bTriple.jpg', '7,5');

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
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `kerbleiuser`
--
ALTER TABLE `kerbleiuser`
  MODIFY `accountId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pour la table `product`
--
ALTER TABLE `product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

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
