-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Lun 22 Mai 2017 à 12:07
-- Version du serveur :  5.7.14
-- Version de PHP :  7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projet_transversal`
--

-- --------------------------------------------------------

--
-- Structure de la table `baskets`
--

CREATE TABLE `baskets` (
  `id` int(11) NOT NULL,
  `img` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `price` float NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `category` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `category_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `baskets`
--

INSERT INTO `baskets` (`id`, `img`, `price`, `name`, `category`, `category_id`) VALUES
(1, 'assets/img/basketBGF.png', 28.5, 'Panier printanier', 'bio', 'bio'),
(2, 'assets/img/basketGF.png', 25.5, 'Panier neophyte', 'bio gluten-free', 'bio_gf'),
(3, 'assets/img/basketV.png', 42.9, 'Panier automnier', 'bio', 'vegan'),
(4, 'assets/img/basketB.png', 37.5, 'Panier Vegan Pro', 'vegan', 'bio');

-- --------------------------------------------------------

--
-- Structure de la table `favorites`
--

CREATE TABLE `favorites` (
  `id` int(11) NOT NULL,
  `id_recipe` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `favorites`
--

INSERT INTO `favorites` (`id`, `id_recipe`, `name`, `username`) VALUES
(3, 2, 'seitan faï¿½on poulet tikka massala', 'skipcat'),
(4, 1, 'gï¿½teau coco', 'clement2'),
(5, 21, 'Flocon d\'avoine CrÃ©meux aux fruits', 'clement2');

-- --------------------------------------------------------

--
-- Structure de la table `ingredients`
--

CREATE TABLE `ingredients` (
  `id` int(11) NOT NULL,
  `id_basket` varchar(255) NOT NULL,
  `img` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `ingredients`
--

INSERT INTO `ingredients` (`id`, `id_basket`, `img`, `name`, `description`) VALUES
(12, '4', 'assets/img/carot.png', 'Carotte', 'Carotte Bio'),
(11, '1', 'assets/img/carot.png', 'Carotte', 'Carotte Bio'),
(8, '4', 'assets/img/soja.png', 'Soja', 'Soja Bio'),
(9, '1', 'assets/img/soja.png', 'Soja', 'Soja Bio'),
(7, '3', 'assets/img/carot.png', 'Carotte', 'Carotte Bio'),
(5, '1', 'assets/img/soja.png', 'soja', 'Soja Bio'),
(14, '3', 'assets/img/peach.png', 'Pêche', 'Pêche Bio'),
(15, '3', 'assets/img/carot.png', 'Carotte', 'Carotte Bio'),
(6, '2', 'assets/img/peach.png', 'pêche ', 'Pêche Bio');

-- --------------------------------------------------------

--
-- Structure de la table `lists`
--

CREATE TABLE `lists` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `recipes`
--

CREATE TABLE `recipes` (
  `id` int(11) NOT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `preparation` int(11) NOT NULL,
  `baking` int(11) NOT NULL,
  `ingredients` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `recipe` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `recipes`
--

INSERT INTO `recipes` (`id`, `img`, `name`, `category`, `preparation`, `baking`, `ingredients`, `recipe`) VALUES
(20, 'assets/img/pancakes.jpg', 'Pancakes sans Gluten', 'dessert gluten-free', 10, 3, '100mL de lait d\'amande\n+ 40g de farine de sarrasin + \n1 banane +\n1 pincee de cannelle', 'Ecraser la banane a la fourchette puis melanger tous les ingredients jusqu\'a obtenir une pate homogene. Huiler ensuite une poele puis y verser une petite louche de pate.\nLaisser cuire à feu doux pendant 3 minutes environ de chaque cote.\n\n'),
(21, 'assets/img/flocon.jpg', 'Flocon d\'avoine CrÃ©meux aux fruits', 'dessert bio', 5, 5, '30g de flocons d\'avoine + 200mL de lait d\'amande ou lait de riz + 1 cas de sirop d\'agave + 50g de fruit frais', 'Commencer par verser dans une poÃªle les flocons d\'avoine et le lait vÃ©gÃ©tal puis faire cuire Ã  feux doux jusqu\'Ã  ce que le mÃ©lange devienne crÃ©meux. A servir accompagnÃ© de fruits frais'),
(22, 'assets/img/assiettemexicaine.jpg', 'Assiette Mexicaine', 'main gluten-free', 5, 15, '100g de quinoa cuit + Guacamole + 100g de haricots noirs en conserve', 'Commencer par faire cuire le quinoa en suivant les instructions indiquÃ©es sur le paquet. Rincer les haricots noirs Ã  l\'eau. Puis servir le quinoa, le guacamole et les haricots noirs dans une assiette.'),
(23, 'assets/img/burritos.jpg', 'Burritos aux lÃ©gumes et houmous', 'main gluten-free', 5, 0, '2 tortillas sans gluten + CruditÃ©s + 2 cas de Houmous + Salade', 'Tartiner la tortilla de houmous puis disposer de la salade et des cruditÃ©s ! C\'est prÃªt !'),
(24, 'assets/img/tofuherbes.jpg', 'Quinoa, Tofu aux herbes et roquette', 'starter gluten-free', 5, 10, '50g de quinoa (cru) + 100g de tofu ferme aux herbes + roquette.', 'Commencer par faire cuire le quinoa en suivant les instructions indiquÃ©es sur le paquet. Couper le tofu en dÃ©s, l\'incorporer au quinoa cuit. Pour finir, assaisonner avec la vinaigrette Ã  la moutarde Ã  l\'ancienne.'),
(25, 'assets/img/bagel.jpg', 'Bagels houmous et jeunes pousses', 'starter vegan', 5, 0, '2 bagels + 2 cas de houmous + Jeunes pousses de salade + 1 avocat', 'Ouvrir les bagels en deux, tartiner une cuillÃ¨re Ã  soupe de houmous dans chacun des pains. Ajouter ensuite l\'avocat et les jeunes pousses de salade. C\'est prÃªt !');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthdate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `address`, `birthdate`, `gender`, `admin`) VALUES
(1, 'test', 'test@supinternet.fr', '$2y$10$CzXQ08UXphRz9pWHh1asaO7xXbC5DXK.8AHI2X/z7Ifj3AxsS1ePW', 'test', '2018-02-02', 'female', NULL),
(2, 'admin', 'admin@supinternet.fr', '$2y$10$SV3Vyy042CLBZV3q.F2hU.FxP6A1Lev76G3fQ00E5tPPBTndcfwCu', 'admin', '2016-01-01', 'female', 'admin'),
(3, 'superadmin', 'superadmin@supinternet.fr', '$2y$10$wvz5ueYm16tm8wB09gYUxO/YeQHYs./r9Kd/YpOxjqgR4Z9RMN7/q', 'superadmin', '2016-01-01', 'other', 'superadmin');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `baskets`
--
ALTER TABLE `baskets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Index pour la table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Index pour la table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `lists`
--
ALTER TABLE `lists`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `baskets`
--
ALTER TABLE `baskets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT pour la table `lists`
--
ALTER TABLE `lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
