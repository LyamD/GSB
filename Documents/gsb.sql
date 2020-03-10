-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 05 mars 2020 à 21:06
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gsb`
--

DELIMITER $$
--
-- Procédures
--
DROP PROCEDURE IF EXISTS `generer_matricule`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `generer_matricule` (IN `id` INT, IN `dateEmbauche` DATETIME)  BEGIN
    
    SELECT @varNom := nom FROM utilisateurs WHERE utilisateurs.id = id;
    SELECT @varPrenom := prenom FROM utilisateurs WHERE utilisateurs.id = id;
    SELECT @varDate := dateNaissance FROM utilisateurs WHERE utilisateurs.id = id;
    
    UPDATE utilisateurs
    SET utilisateurs.matricule = UPPER(CONCAT(LEFT(@varNom, 2), LEFT(@varPrenom,2), CONCAT(RIGHT(YEAR(@varDate), 2))) )
    WHERE utilisateurs.id = id;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `activitescomplementaires`
--

DROP TABLE IF EXISTS `activitescomplementaires`;
CREATE TABLE IF NOT EXISTS `activitescomplementaires` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numeroOrdre` varchar(50) DEFAULT NULL,
  `themeActivite` varchar(50) DEFAULT NULL,
  `compteRendu` text DEFAULT NULL,
  `dateHeureActivité` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `responsables_id` int(11) NOT NULL,
  `visiteurmedicaux_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `responsables_id` (`responsables_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `composants`
--

DROP TABLE IF EXISTS `composants`;
CREATE TABLE IF NOT EXISTS `composants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomComposant` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `contient`
--

DROP TABLE IF EXISTS `contient`;
CREATE TABLE IF NOT EXISTS `contient` (
  `numeroProduit` varchar(10) NOT NULL,
  `composants_id` int(11) NOT NULL,
  `quantite` double DEFAULT NULL,
  PRIMARY KEY (`numeroProduit`,`composants_id`),
  KEY `composants_id` (`composants_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `convier`
--

DROP TABLE IF EXISTS `convier`;
CREATE TABLE IF NOT EXISTS `convier` (
  `utilisateurs_id` int(11) NOT NULL,
  `activitesComplementaires_id` int(11) NOT NULL,
  PRIMARY KEY (`utilisateurs_id`,`activitesComplementaires_id`),
  KEY `activitesComplementaires_id` (`activitesComplementaires_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `estpasser`
--

DROP TABLE IF EXISTS `estpasser`;
CREATE TABLE IF NOT EXISTS `estpasser` (
  `utilisateurs_id` int(11) NOT NULL,
  `regions_id` int(11) NOT NULL,
  `dateDebut` date DEFAULT NULL,
  `dateFin` date DEFAULT NULL,
  PRIMARY KEY (`utilisateurs_id`,`regions_id`),
  KEY `regions_id` (`regions_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `estpasser`
--

INSERT INTO `estpasser` (`utilisateurs_id`, `regions_id`, `dateDebut`, `dateFin`) VALUES
(2, 1, '2020-02-01', '2020-02-23'),
(2, 2, '2020-02-02', '2020-02-09'),
(3, 1, '2020-03-01', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `estpresente`
--

DROP TABLE IF EXISTS `estpresente`;
CREATE TABLE IF NOT EXISTS `estpresente` (
  `numeroProduit` varchar(10) NOT NULL,
  `visite_id` int(11) NOT NULL,
  `offert` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`numeroProduit`,`visite_id`),
  KEY `visite_id` (`visite_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `famillemedicament`
--

DROP TABLE IF EXISTS `famillemedicament`;
CREATE TABLE IF NOT EXISTS `famillemedicament` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomFamille` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `medicaments`
--

DROP TABLE IF EXISTS `medicaments`;
CREATE TABLE IF NOT EXISTS `medicaments` (
  `numeroProduit` varchar(10) NOT NULL,
  `nomCommercial` varchar(50) DEFAULT NULL,
  `effets` text DEFAULT NULL,
  `contreIndications` text DEFAULT NULL,
  `prixEchantillon` decimal(13,2) DEFAULT NULL,
  `created_at` varchar(50) DEFAULT NULL,
  `updated_at` varchar(50) DEFAULT NULL,
  `familleMedicament_id` int(11) NOT NULL,
  PRIMARY KEY (`numeroProduit`),
  KEY `familleMedicament_id` (`familleMedicament_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `melange`
--

DROP TABLE IF EXISTS `melange`;
CREATE TABLE IF NOT EXISTS `melange` (
  `numeroProduit` varchar(10) NOT NULL,
  `numeroProduit_1` varchar(10) NOT NULL,
  `interaction` text DEFAULT NULL,
  PRIMARY KEY (`numeroProduit`,`numeroProduit_1`),
  KEY `numeroProduit_1` (`numeroProduit_1`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(8, '2014_10_12_100000_create_password_resets_table', 2),
(9, '2019_08_19_000000_create_failed_jobs_table', 2),
(10, '2020_02_18_003634_create_permission_tables', 2),
(11, '2020_02_23_203935_create_users_table', 3);

-- --------------------------------------------------------

--
-- Structure de la table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(7, 'App\\User', 1),
(8, 'App\\User', 2),
(8, 'App\\User', 3),
(9, 'App\\User', 2),
(10, 'App\\User', 5),
(11, 'App\\User', 1);

-- --------------------------------------------------------

--
-- Structure de la table `participe`
--

DROP TABLE IF EXISTS `participe`;
CREATE TABLE IF NOT EXISTS `participe` (
  `utilisateurs_id` int(11) NOT NULL,
  `activitesComplementaires_id` int(11) NOT NULL,
  PRIMARY KEY (`utilisateurs_id`,`activitesComplementaires_id`),
  KEY `activitesComplementaires_id` (`activitesComplementaires_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `permissions`
--


-- --------------------------------------------------------

--
-- Structure de la table `regions`
--

DROP TABLE IF EXISTS `regions`;
CREATE TABLE IF NOT EXISTS `regions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomRegion` varchar(50) NOT NULL,
  `budgetGlobalAnnuel` decimal(13,2) NOT NULL DEFAULT 0.00,
  `utilisateurs_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `utilisateurs_id` (`utilisateurs_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `regions`
--

INSERT INTO `regions` (`id`, `nomRegion`, `budgetGlobalAnnuel`, `utilisateurs_id`) VALUES
(1, 'Languedoc', '1600.00', 3),
(2, 'Occitanie', '1500.00', 2);

-- --------------------------------------------------------

--
-- Structure de la table `responsables`
--

DROP TABLE IF EXISTS `responsables`;
CREATE TABLE IF NOT EXISTS `responsables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `roles`
--


-- --------------------------------------------------------

--
-- Structure de la table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `role_has_permissions`
--


-- --------------------------------------------------------

--
-- Structure de la table `specialise`
--

DROP TABLE IF EXISTS `specialise`;
CREATE TABLE IF NOT EXISTS `specialise` (
  `utilisateurs_id` int(11) NOT NULL,
  `specialites_id` int(11) NOT NULL,
  `diplome` varchar(50) DEFAULT NULL,
  `coefPrescription` double DEFAULT NULL,
  PRIMARY KEY (`utilisateurs_id`,`specialites_id`),
  KEY `specialites_id` (`specialites_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `specialites`
--

DROP TABLE IF EXISTS `specialites`;
CREATE TABLE IF NOT EXISTS `specialites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomSpecialite` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `matricule` char(6) DEFAULT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `dateNaissance` date NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `adresse2` varchar(50) DEFAULT NULL,
  `CP` char(5) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `dateEmbauche` datetime DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `email`, `email_verified_at`, `password`, `matricule`, `nom`, `prenom`, `dateNaissance`, `adresse`, `adresse2`, `CP`, `ville`, `dateEmbauche`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'lyam_durand@outlook.fr', NULL, '$2y$10$2ORaUk9Axkosp1nSgnz.puoGWln8AJF.urdXCM1NouIoyeeUymXz.', NULL, 'Lyam', 'Durand', '2000-08-03', '84 Rue du moinas', NULL, '30960', 'Les Mages', NULL, 'LUuOlF91TOohjzJUN4gHCx7gk5Z4kzNnIAu8EWn5BvawlkwaWKiLpDq5Opb9', '2020-02-18 01:39:01', '2020-02-18 01:39:01'),
(2, 'jean_dupont@hotmail.fr', NULL, '$2y$10$MRiZYgX9sM47m5pGeCYBMuQCW1uizX1t1RNGzlmHbdxc/TbYeUqDC', 'DUJE80', 'Dupont', 'Jean', '1980-04-08', '80 Rue des avenues', 'Chemin des D', '42666', 'Paris', NULL, NULL, '2020-02-21 01:34:33', '2020-02-21 01:34:33'),
(3, 'gerard_buisson@hotmail.fr', NULL, '$2y$10$aw8UG8B0gh6pxIgMA1S6d.jLKK.xz1iD/4uMXYoj/xC/MM6hcTKIa', 'BUGE88', 'Buisson', 'Gerard', '1988-04-06', 'Adresse de vrai bogoss', NULL, '42069', 'BogossCity', NULL, NULL, '2020-02-21 03:41:33', '2020-02-21 03:41:33');

--
-- Déclencheurs `utilisateurs`
--
DROP TRIGGER IF EXISTS `setUpperCase`;
DELIMITER $$
CREATE TRIGGER `setUpperCase` BEFORE INSERT ON `utilisateurs` FOR EACH ROW SET 
NEW.prenom = CONCAT(UPPER(LEFT(NEW.prenom, 1)), SUBSTRING(NEW.prenom, 2)), 
NEW.nom = UPPER(NEW.prenom)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `visite`
--

DROP TABLE IF EXISTS `visite`;
CREATE TABLE IF NOT EXISTS `visite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateMission` date DEFAULT NULL,
  `motif` text DEFAULT NULL,
  `bilan` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `visiteurMedicaux_id` int(11) NOT NULL,
  `utilisateurs_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `visiteurMedicaux_id` (`visiteurMedicaux_id`),
  KEY `utilisateurs_id` (`utilisateurs_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `visiteurbudgethisto`
--

DROP TABLE IF EXISTS `visiteurbudgethisto`;
CREATE TABLE IF NOT EXISTS `visiteurbudgethisto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `budget` decimal(13,2) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `visiteurMedicaux_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `visiteurMedicaux_id` (`visiteurMedicaux_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `visiteurmedicaux`
--

DROP TABLE IF EXISTS `visiteurmedicaux`;
CREATE TABLE IF NOT EXISTS `visiteurmedicaux` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `objectif` text DEFAULT NULL,
  `prime` decimal(13,2) DEFAULT NULL,
  `avantages` text DEFAULT NULL,
  `budget` decimal(13,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déclencheurs `visiteurmedicaux`
--
DROP TRIGGER IF EXISTS `budgetVisiteurHistorisation`;
DELIMITER $$
CREATE TRIGGER `budgetVisiteurHistorisation` AFTER UPDATE ON `visiteurmedicaux` FOR EACH ROW INSERT INTO visiteurbudgethisto(budget, created_at, visiteurMedicaux_id)
VALUES (NEW.budget, NOW(), NEW.id)
$$
DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
