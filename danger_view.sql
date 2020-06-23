-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 23 juin 2020 à 05:28
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `danger_view`
--

-- --------------------------------------------------------

--
-- Structure de la table `acteurs`
--

CREATE TABLE `acteurs` (
  `id` int(11) NOT NULL,
  `intitule` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `acteurs`
--

INSERT INTO `acteurs` (`id`, `intitule`) VALUES
(4, 'enfant'),
(5, 'garçon'),
(6, 'fille'),
(7, 'fillette'),
(8, 'goupe de personne'),
(9, 'femme'),
(10, 'homme');

-- --------------------------------------------------------

--
-- Structure de la table `activites`
--

CREATE TABLE `activites` (
  `id` int(11) NOT NULL,
  `intituleActivite` varchar(255) NOT NULL,
  `periode` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `danger`
--

CREATE TABLE `danger` (
  `id` int(11) NOT NULL,
  `numeroOrdre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL,
  `source` varchar(255) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `Lieu` text NOT NULL,
  `dangerType` text NOT NULL,
  `descripendroit` text NOT NULL,
  `pays` text NOT NULL,
  `ville` text NOT NULL,
  `longitude` text NOT NULL,
  `latitude` text NOT NULL,
  `typeActeur` text NOT NULL,
  `sexeVictime` text NOT NULL,
  `sexeResponsable` text NOT NULL,
  `dateAjout` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `danger`
--

INSERT INTO `danger` (`id`, `numeroOrdre`, `description`, `date`, `source`, `idUtilisateur`, `Lieu`, `dangerType`, `descripendroit`, `pays`, `ville`, `longitude`, `latitude`, `typeActeur`, `sexeVictime`, `sexeResponsable`, `dateAjout`) VALUES
(1, '01dxdx', 'longitudelongitudelongitudelongitudelongitudelongitude', '0000-00-00', 'InfoIvoire', 33, 'fcfsfcfscfs', 'Troubles(manifestation)', 'dffffdcfdcfdcd', 'Côte d\'Ivoire', 'Abengourou', '1222', '333', 'Femme', 'Masculin', 'Masculin', '2020-06-20'),
(3, '0001IND-06-21-2021', 'pas de description', '2020-06-20', 'www.abidjan.net', 35, 'Autoroute du Nord vers atékoubé', 'Inondation', 'L\'endroit est un autoroute', 'Côte d\'Ivoire', 'Attecoube', '-4.02357', '5.36507', 'Goupe de personne', 'Masculin', 'pas de responsable', '2020-06-21'),
(4, '0002ACC-06-21-2020', 'rien', '2020-06-12', 'www.abidjant.net', 35, 'Autoroute du Nord', 'Accident', 'Autoroute du nord en quittant adjamè pour yopougon, au niveau l\'entréprise de fabrication de ciment', 'Côte d\'Ivoire', 'Abidjan, autoroute Adjamé - yopougon', '-4.04145', '5.36507', 'Goupe de personne', 'Il y avait des garçons et aussi femmes', 'les responsable ne sont pas des humains,', '2020-05-21'),
(5, '0003V2A-06-21-2020', 'ceci est un test', '2020-06-18', 'linfodrom', 35, 'Adjamé mosqué', 'Vole à l’arraché', 'Adjamé nom loin de la gare Nord', 'Côte d\'Ivoire', 'Adjame', '-4.02357', '5.36507', 'Goupe de personne', 'Feminin', 'Masculin', '2020-06-21'),
(8, '003NO-23', 'ceci est un test', '2020-06-21', 'Abidjan.net', 35, 'Commerce', 'Arnaque', 'le lieu est situé au quartier commerce de la commune du plateau à abidjan', 'Côte d\'Ivoire', 'plateau', '-4.02357', '5.32332', 'Garçon', 'Masculin', 'Masculin', '2020-06-23');

-- --------------------------------------------------------

--
-- Structure de la table `dangertype`
--

CREATE TABLE `dangertype` (
  `id` int(11) NOT NULL,
  `intitule` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `dangertype`
--

INSERT INTO `dangertype` (`id`, `intitule`) VALUES
(1, 'accident'),
(2, 'vole à l’arraché'),
(3, 'viol'),
(4, 'inondation'),
(5, 'vole à main armée(braquage,\r\nCoupeur de route)'),
(6, 'troubles(manifestation)'),
(7, 'suicide'),
(8, 'Arnaque'),
(9, 'violence conjugale'),
(10, 'crime passionnel'),
(11, 'enlèvement'),
(12, 'découverte de corps sans vie'),
(13, 'crime rituel'),
(14, 'Empoisonnement et intoxication'),
(15, 'incendie'),
(16, 'électrocution'),
(17, 'bavure policière');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `objetMessage` varchar(255) NOT NULL,
  `contenu` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `pays`
--

CREATE TABLE `pays` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `pays`
--

INSERT INTO `pays` (`id`, `nom`) VALUES
(1, 'Côte d\'Ivoire'),
(2, 'Ghana');

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `intituleRole` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `intituleRole`, `description`) VALUES
(1, 'ROLE_ADMIN', 'Super admin'),
(2, 'ROLE_OPERATEUR', 'opérateur');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `motDePasse` varchar(255) NOT NULL,
  `dateInscription` datetime NOT NULL DEFAULT current_timestamp(),
  `idRole` int(11) NOT NULL,
  `image` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom`, `prenom`, `genre`, `contact`, `adresse`, `email`, `motDePasse`, `dateInscription`, `idRole`, `image`) VALUES
(2, 'Aka', 'Anoa Sheila Melissa', 'feminin', '+22549060536', 'Abobo belleville', 'shellyaka998@gmail.com', '$2y$10$B3p5Aho8RkUkktyfepZqhuB2GZKKg8Iz8tylbjdjS3CLy7kefYZbq', '2020-06-06 13:32:35', 1, NULL),
(29, 'Abie', 'Raissa', 'Feminin', '87147883', 'Niangon, Yopougon', 'raisa0@gmail.com', '$2y$10$lNRy2fHUBBPdkh74m4YPje2gq6o9qOeYzcgmhGMQODSTXRHHohNY6', '2020-06-20 15:12:56', 2, NULL),
(30, 'Aka', 'Lory', 'Feminin', '87147883', 'Niangon, Yopougon', 'loryaka@gmail.com', '$2y$10$G30tPI7Xst/h4dzWSlYkuedoV4Fl//rreWoTtuVj.r0.5rl4JygQO', '2020-06-20 15:36:37', 2, NULL),
(32, 'Meli', 'Anoa Melissa', 'Feminin', '43009312', 'Niangon, Yopougon', 'melissa@gmail.com', '$2y$10$z9cEY5Dq4CRZ3debUiBGxeVgIr/Njilo5aJ09d7CXCEqjxgbsCYCe', '2020-06-20 15:45:32', 2, NULL),
(33, 'test2', 'Loriane', 'Feminin', '85154865', 'Niangon, Yopougon', 'teste0@gmail.com', '$2y$10$3Ax1NMsGTUIR33V.ONTLI.oAXhXrbbggFX2KOPJ6Onkv0um/JI7cO', '2020-06-20 15:58:07', 2, NULL),
(35, 'Opérateur', 'koné', 'Masculin', '05285478', 'Bouaflé, CI', 'kouame@gmail.com', '$2y$10$Ru6v/jJ6kyt8SnmXLT3P8e/GHpn05Au6ivK/v5BdySHU5Ucio/Emu', '2020-06-21 09:03:44', 2, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `ville`
--

CREATE TABLE `ville` (
  `id` int(11) NOT NULL,
  `ville` varchar(50) COLLATE utf8_estonian_ci NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `pays` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci;

--
-- Déchargement des données de la table `ville`
--

INSERT INTO `ville` (`id`, `ville`, `lat`, `lng`, `pays`) VALUES
(10, 'adjame', 5.36507, -4.02357, 1),
(11, 'attecoube', 5.33625, -4.04145, 1),
(12, 'cocody', 5.36022, -3.96744, 1),
(13, 'koumassi', 5.30298, -3.94194, 1),
(14, 'marcory', 5.30271, -3.98274, 1),
(15, 'plateau', 5.32332, -4.02357, 1),
(16, 'portbouet', 5.27725, -3.8859, 1),
(17, 'treichville', 5.29209, -4.01336, 1),
(18, 'yopougon', 5.31767, -4.08999, 1),
(19, 'abengourou', 6.7157, -3.48013, 1),
(20, 'aboisso', 5.47451, -3.20308, 1),
(21, 'adzope', 6.10715, -3.85535, 1),
(22, 'agboville', 5.9355, -4.22308, 1),
(23, 'agnibilekrou', 7.13028, -3.20308, 1),
(24, 'anyama', 5.48771, -4.05166, 1),
(26, 'beoumi', 7.67309, -5.57223, 1),
(27, 'bingerville', 5.35036, -3.87571, 1),
(28, 'bocanda', 7.06591, -4.49543, 1),
(29, 'bondoukou', 8.04788, -2.80786, 1),
(30, 'bongouanou', 6.6487, -4.20515, 1),
(31, 'bonoua', 5.27118, -3.59393, 1),
(33, 'boundiali', 9.51836, -6.48232, 1),
(34, 'dabou', 5.32621, -4.36679, 1),
(35, 'daloa', 6.88833, -6.43969, 1),
(36, 'bouaflé', 6.98274, -5.74051, 1),
(37, 'danané', 7.2676, -8.14478, 1),
(38, 'daoukro', 7.0654, -3.95724, 1),
(39, 'dimbokro', 6.65747, -4.71223, 1),
(40, 'divo', 5.84154, -5.36255, 1),
(41, 'douekoue', 6.74738, -7.36246, 1),
(42, 'ferkessedougou', 9.5842, -5.19536, 1),
(43, 'gagnoa', 6.15144, -5.95154, 1),
(44, 'gohitafla', 7.48828, -5.88024, 1),
(45, 'grandlahou', 5.13652, -5.02605, 1),
(46, 'grandbassam', 5.22594, -3.75367, 1),
(47, 'Grand-Bereby', 4.65137, -6.92205, 1),
(48, 'guiglo', 6.54906, -7.49765, 1),
(49, 'issia', 6.48761, -6.58368, 1),
(50, 'jacqueville', 5.20598, -4.42335, 1),
(52, 'katiola', 8.14023, -5.09631, 1),
(53, 'korhogo', 9.46693, -5.61426, 1),
(55, 'mbahiakro', 7.4548, -4.3411, 1),
(58, 'mankono', 8.05991, -6.18983, 1),
(59, 'odienne', 9.51888, -7.55722, 1),
(60, 'oumé', 6.37413, -5.40966, 1),
(61, 'sassandra', 4.95128, -6.09175, 1),
(62, 'seguela', 7.96018, -6.6745, 1),
(63, 'sinfra', 6.62334, -5.91456, 1),
(64, 'soubré', 5.78662, -6.58902, 1),
(65, 'tengrela', 10.482, -6.41306, 1),
(66, 'tiassale', 5.90426, -4.82614, 1),
(67, 'Toulepleu', 6.57956, -8.4102, 1),
(68, 'toumodi', 6.55603, -5.01565, 1),
(69, 'vavoua', 7.37506, -6.47699, 1),
(70, 'yamoussoukro', 6.82762, -5.28934, 1),
(71, 'zuenoula', 7.42404, -6.05204, 1),
(72, 'Bouna', 9.27166, -2.99256, 1),
(73, 'lakota', 5.85947, -5.67735, 1),
(74, 'kani', 8.47784, -6.60504, 1),
(75, 'man', 7.40643, -7.55722, 1),
(76, 'dabakala', 8.36626, -4.43364, 1),
(77, 'kong', 9.15102, -4.61018, 1),
(78, 'Touba', 8.28417, -7.68194, 1),
(79, 'bouake', 7.69047, -5.03905, 1),
(80, 'Accra', 5.5600141, -0.2057437, 2),
(81, 'Kumasi', 6.698081, -1.6230404, 2),
(82, 'Tamale', 9.4051992, -0.8423986, 2),
(83, 'Sekondi-Takoradi', 4.927456, -1.7490216, 2),
(84, 'Ashaiman', 5.694385, -0.029529, 2),
(85, 'Sunyani', 7.3384389, -2.3309226, 2);

-- --------------------------------------------------------

--
-- Structure de la table `visiteurs`
--

CREATE TABLE `visiteurs` (
  `adresseIp` varchar(30) NOT NULL,
  `dateVisite` date NOT NULL,
  `pagesVues` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `visiteurs`
--

INSERT INTO `visiteurs` (`adresseIp`, `dateVisite`, `pagesVues`) VALUES
('127.0.0.1', '2008-06-20', 2),
('::1', '2008-06-20', 6);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `acteurs`
--
ALTER TABLE `acteurs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `activites`
--
ALTER TABLE `activites`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `danger`
--
ALTER TABLE `danger`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUtilisateur` (`idUtilisateur`);

--
-- Index pour la table `dangertype`
--
ALTER TABLE `dangertype`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `pays`
--
ALTER TABLE `pays`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idRole` (`idRole`);

--
-- Index pour la table `ville`
--
ALTER TABLE `ville`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `visiteurs`
--
ALTER TABLE `visiteurs`
  ADD PRIMARY KEY (`adresseIp`,`dateVisite`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `acteurs`
--
ALTER TABLE `acteurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `activites`
--
ALTER TABLE `activites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `danger`
--
ALTER TABLE `danger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `dangertype`
--
ALTER TABLE `dangertype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pays`
--
ALTER TABLE `pays`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pour la table `ville`
--
ALTER TABLE `ville`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `danger`
--
ALTER TABLE `danger`
  ADD CONSTRAINT `danger_ibfk_1` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateurs` (`id`);

--
-- Contraintes pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD CONSTRAINT `utilisateurs_ibfk_1` FOREIGN KEY (`idRole`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
