-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 18 avr. 2024 à 14:31
-- Version du serveur :  10.6.17-MariaDB
-- Version de PHP : 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
  `orderDate` date DEFAULT current_timestamp(),
  `deliveryDate` date DEFAULT NULL,
  `statement` enum('déposée','validée','livrée','suspendue','orpheline') DEFAULT NULL,
  `accountId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `cart`
--

INSERT INTO `cart` (`cartId`, `orderDate`, `deliveryDate`, `statement`, `accountId`) VALUES
(2, '2024-04-08', '2024-04-09', 'validée', 32),
(3, '2024-04-10', '2024-04-15', 'livrée', 32),
(4, '2024-04-10', '2024-06-10', 'livrée', 32),
(10, '2024-04-16', '2024-04-27', 'déposée', 36),
(11, '2024-04-16', '2024-05-01', 'déposée', 36),
(12, '2024-04-17', '2024-05-02', 'livrée', 38),
(13, '2024-04-18', '2024-04-20', 'déposée', 37),
(14, '2024-04-18', '2024-05-01', 'déposée', 37);

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
  `password` varchar(100) NOT NULL,
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
(31, 'yohann@free.bzh', '$2y$10$1eulDMefMz/09t4UlzSRne8NbVTWFPuLlal7DEg0IrVYk5uLPOwvq', 1, 'Lecerf', 'Yohann', NULL),
(32, 'mathilda@free.bzh', '$2y$10$92Jb1yGWA8NsftURWoJtL.pq3pXytLXFYTQRfS3ygm8xu23aiQkzi', 0, 'Milsom', 'Mathilda', '02 02 02 02 02'),
(33, 'jj@heaven.bzh', '$2y$10$2cW/q7EB/QESV4kt5dpniOTd9O4lu/RjwY3LJkkhBkEJmX8HUAjtW', 0, 'Murat', 'Jean-Louis', '03 03 03 03 03'),
(34, 'georges@heaven.bzh', '$2y$10$EAAOlQh5QcFLAKYea8da0uc5Y1WaGhyL4Kmui.urPjL75HThaLACe', 0, 'Brassens', 'Georges', '02 02 02 02 02'),
(36, 'thierry.bouedo@free.bzh', '$2y$10$ofEay5UORmpe5V5jerdHWOf.u6W/4Bk18zc6ECQxddE0uY.jUjCkC', 0, 'Bouedo', 'Thierry', '0101010101'),
(37, 'titi@free.bzh', '$2y$10$1eulDMefMz/09t4UlzSRne8NbVTWFPuLlal7DEg0IrVYk5uLPOwvq', 0, 'Titi', 'Titi', '02 02 02 02 02'),
(38, 'admin@free.bzh', '$2y$10$ZmNK.R7rAAr/3r/VGG0oeOPjUunlpQMjumc2dTcE3zftX6vz8tahK', 1, 'Admin', 'Admin', NULL),
(39, 'fifi@heaven.bzh', '$2y$10$z9xQbhKIPQ.eBkswrLkFe..o6QUY/jwD044hPKvnDXGX0.UpkN/9.', 0, 'Léotard', 'Phillippe', NULL),
(40, 'toto@free.bzh', '$2y$10$nby2TMpwZQHn2Ct/txtnwuRuTq7iCO55lrTl70BT0MlDSQXp9EqIK', 0, 'Toto', 'Toto', NULL),
(41, 'gus@free.bzh', '$2y$10$1eulDMefMz/09t4UlzSRne8NbVTWFPuLlal7DEg0IrVYk5uLPOwvq', 0, 'Gus', 'Emile', NULL);

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
(1, 12, 3),
(2, 2, 2),
(3, 14, 1),
(4, 3, 1),
(4, 4, 1),
(4, 10, 2),
(8, 13, 2),
(11, 3, 2),
(13, 10, 3),
(13, 11, 9),
(13, 13, 3);

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
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `kerbleiuser`
--
ALTER TABLE `kerbleiuser`
  MODIFY `accountId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT pour la table `product`
--
ALTER TABLE `product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_cart_accountId` FOREIGN KEY (`accountId`) REFERENCES `kerbleiuser` (`accountId`) ON DELETE SET NULL;

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
