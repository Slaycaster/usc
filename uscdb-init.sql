-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2016 at 03:53 PM
-- Server version: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uscdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit_trails`
--

CREATE TABLE IF NOT EXISTS `audit_trails` (
  `AuditTrailID` int(10) unsigned NOT NULL,
  `Action` text COLLATE utf8_unicode_ci NOT NULL,
  `UserUnitID` int(11) NOT NULL,
  `UnitID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chiefs`
--

CREATE TABLE IF NOT EXISTS `chiefs` (
  `ChiefID` int(10) unsigned NOT NULL,
  `ChiefName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ChiefAbbreviation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `PicturePath` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chiefs`
--

INSERT INTO `chiefs` (`ChiefID`, `ChiefName`, `ChiefAbbreviation`, `PicturePath`, `created_at`, `updated_at`) VALUES
(1, 'Chief, PNP', 'C, PNP', '4gETN9mKU4bOjOPN43rYD1oL5KPYVGkW.png', '2016-04-29 00:53:52', '2016-05-02 06:55:47');

-- --------------------------------------------------------

--
-- Table structure for table `chief_accomplishments`
--

CREATE TABLE IF NOT EXISTS `chief_accomplishments` (
  `ChiefAccomplishmentID` int(10) unsigned NOT NULL,
  `JanuaryAccomplishment` double(8,2) NOT NULL,
  `FebruaryAccomplishment` double(8,2) NOT NULL,
  `MarchAccomplishment` double(8,2) NOT NULL,
  `AprilAccomplishment` double(8,2) NOT NULL,
  `MayAccomplishment` double(8,2) NOT NULL,
  `JuneAccomplishment` double(8,2) NOT NULL,
  `JulyAccomplishment` double(8,2) NOT NULL,
  `AugustAccomplishment` double(8,2) NOT NULL,
  `SeptemberAccomplishment` double(8,2) NOT NULL,
  `OctoberAccomplishment` double(8,2) NOT NULL,
  `NovemberAccomplishment` double(8,2) NOT NULL,
  `DecemberAccomplishment` double(8,2) NOT NULL,
  `AccomplishmentDate` date NOT NULL,
  `ChiefMeasureID` int(11) NOT NULL,
  `ChiefID` int(11) NOT NULL,
  `UserChiefID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chief_audit_trails`
--

CREATE TABLE IF NOT EXISTS `chief_audit_trails` (
  `ChiefAuditTrailID` int(10) unsigned NOT NULL,
  `Action` text COLLATE utf8_unicode_ci NOT NULL,
  `UserChiefID` int(11) NOT NULL,
  `ChiefID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chief_fundings`
--

CREATE TABLE IF NOT EXISTS `chief_fundings` (
  `ChiefFundingID` int(10) unsigned NOT NULL,
  `ChiefFundingEstimate` float NOT NULL,
  `ChiefFundingActual` float NOT NULL,
  `ChiefFundingDate` date NOT NULL,
  `ChiefMeasureID` int(11) NOT NULL,
  `ChiefID` int(11) NOT NULL,
  `UserChiefID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chief_initiatives`
--

CREATE TABLE IF NOT EXISTS `chief_initiatives` (
  `ChiefInitiativeID` int(10) unsigned NOT NULL,
  `ChiefInitiativeContent` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ChiefInitiativeDate` date NOT NULL,
  `ChiefMeasureID` int(11) NOT NULL,
  `ChiefID` int(11) NOT NULL,
  `UserChiefID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chief_logs`
--

CREATE TABLE IF NOT EXISTS `chief_logs` (
  `ChiefLogID` int(10) unsigned NOT NULL,
  `ChiefUserID` int(11) NOT NULL,
  `LogDateTime` datetime NOT NULL,
  `LogType` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `IPAddress` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chief_measures`
--

CREATE TABLE IF NOT EXISTS `chief_measures` (
  `ChiefMeasureID` int(10) unsigned NOT NULL,
  `ChiefMeasureName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ChiefMeasureType` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ChiefMeasureFormula` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ChiefObjectiveID` int(11) NOT NULL,
  `ChiefID` int(11) NOT NULL,
  `UserChiefID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chief_objectives`
--

CREATE TABLE IF NOT EXISTS `chief_objectives` (
  `ChiefObjectiveID` int(10) unsigned NOT NULL,
  `ChiefObjectiveName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `PerspectiveID` int(11) NOT NULL,
  `UserChiefID` int(11) NOT NULL,
  `ChiefID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chief_owners`
--

CREATE TABLE IF NOT EXISTS `chief_owners` (
  `ChiefOwnerID` int(10) unsigned NOT NULL,
  `ChiefOwnerContent` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ChiefOwnerDate` date NOT NULL,
  `ChiefMeasureID` int(11) NOT NULL,
  `ChiefID` int(11) NOT NULL,
  `UserChiefID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chief_targets`
--

CREATE TABLE IF NOT EXISTS `chief_targets` (
  `ChiefTargetID` int(10) unsigned NOT NULL,
  `JanuaryTarget` float NOT NULL,
  `FebruaryTarget` float NOT NULL,
  `MarchTarget` float NOT NULL,
  `AprilTarget` float NOT NULL,
  `MayTarget` float NOT NULL,
  `JuneTarget` float NOT NULL,
  `JulyTarget` float NOT NULL,
  `AugustTarget` float NOT NULL,
  `SeptemberTarget` float NOT NULL,
  `OctoberTarget` float NOT NULL,
  `NovemberTarget` float NOT NULL,
  `DecemberTarget` float NOT NULL,
  `TargetDate` date NOT NULL,
  `Termination` date DEFAULT NULL,
  `TargetPeriod` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ChiefMeasureID` int(11) NOT NULL,
  `ChiefAccomplishmentID` int(11) NOT NULL,
  `ChiefOwnerID` int(11) NOT NULL,
  `ChiefInitiativeID` int(11) NOT NULL,
  `ChiefFundingID` int(11) NOT NULL,
  `ChiefID` int(11) NOT NULL,
  `UserChiefID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_03_15_045535_create_perspectives_table', 2),
('2016_03_15_054123_create_regions_table', 3),
('2016_03_15_060501_create_units_table', 4),
('2016_03_15_072510_create_divisions_table', 5),
('2016_03_15_074053_create_ranks_table', 6),
('2016_03_15_080136_create_user_units_table', 7),
('2016_03_15_151524_create_unit_objectives_table', 8),
('2016_04_06_150225_create_unit_measures_table', 9),
('2016_04_07_071302_create_user_logs_table', 10),
('2016_04_07_084303_create_audit_trails_table', 11),
('2016_04_26_043528_create_staff_table', 12),
('2016_04_26_044546_create_chiefs_table', 12),
('2016_04_26_054235_create_chief_objectives_table', 13),
('2016_04_26_055040_create_user_staffs_table', 13),
('2016_04_26_055723_create_staff_objectives_table', 13),
('2016_04_26_071024_create_user_chiefs_table', 13),
('2016_04_28_171855_create_chief_measures_table', 13),
('2016_05_03_012025_create_staff_measures_table', 14),
('2016_05_02_093523_create_staff_logs_table', 15),
('2016_05_02_103736_create_chief_logs_table', 15),
('2016_05_02_133854_create_staff_audit_trails_table', 15),
('2016_05_02_134952_create_chief_audit_trails_table', 15),
('2016_05_03_110248_create_chief_targets_table', 16),
('2016_05_10_113640_create_staff_targets_table', 17),
('2016_05_10_134942_create_unit_targets_table', 17),
('2016_05_10_161002_create_chief_accomplishments_table', 17),
('2016_05_10_161848_create_staff_accomplishments_table', 17),
('2016_05_10_163150_create_unit_accomplishments_table', 17),
('2016_05_10_164336_create_chief_owners_table', 17),
('2016_05_11_090954_create_staff_owners_table', 17),
('2016_05_11_091909_create_unit_owners_table', 17),
('2016_05_11_092840_create_chief_initiatives_table', 17),
('2016_05_11_093745_create_staff_initiatives_table', 17),
('2016_05_11_094029_create_unit_initiatives_table', 17),
('2016_05_11_094322_create_chief_fundings_table', 17),
('2016_05_11_094335_create_staff_fundings_table', 17),
('2016_05_11_094351_create_unit_fundings_table', 17),
('2016_06_02_202936_create_secondary_units_table', 18),
('2016_06_02_204805_create_user_secondary_units_table', 18),
('2016_06_02_205840_create_secondary_unit_measures_table', 18),
('2016_06_02_210842_create_secondary_unit_objectives_table', 18),
('2016_06_02_212212_create_secondary_unit_targets_table', 18),
('2016_06_02_212838_create_secondary_unit_accomplishments_table', 18),
('2016_06_02_220322_create_secondary_unit_fundings_table', 18),
('2016_06_02_222255_create_secondary_unit_initiatives_table', 18),
('2016_06_02_224629_create_secondary_unit_owners_table', 18),
('2016_06_04_093619_create_tertiary_units_table', 18),
('2016_06_04_103309_create_tertiary_unit_objectives_table', 18),
('2016_06_04_103948_create_tertiary_unit_measures_table', 18),
('2016_06_04_104915_create_tertiary_unit_targets_table', 18),
('2016_06_03_140558_create_tertiary_audit_trails_table', 19),
('2016_06_04_093541_create_user_tertiary_units_table', 20),
('2016_06_07_101407_create_tertiary_unit_accomplishments_table', 20),
('2016_06_07_101835_create_tertiary_unit_owners_table', 20),
('2016_06_07_102236_create_tertiary_unit_fundings_table', 20),
('2016_06_07_102658_create_tertiary_unit_initiatives_table', 20),
('2016_06_07_101223_create_secondary_audit_trails_table', 21);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `perspectives`
--

CREATE TABLE IF NOT EXISTS `perspectives` (
  `PerspectiveID` int(10) unsigned NOT NULL,
  `PerspectiveName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `perspectives`
--

INSERT INTO `perspectives` (`PerspectiveID`, `PerspectiveName`, `created_at`, `updated_at`) VALUES
(1, 'Community', '2016-03-14 21:36:20', '2016-03-14 21:36:35'),
(2, 'Learning and Growth', '2016-03-14 21:38:53', '2016-03-14 21:38:53'),
(3, 'Process Excellence', '2016-04-05 00:49:03', '2016-04-05 00:49:03'),
(4, 'Resource Management', '2016-05-02 06:04:23', '2016-05-10 09:58:13');

-- --------------------------------------------------------

--
-- Table structure for table `ranks`
--

CREATE TABLE IF NOT EXISTS `ranks` (
  `RankID` int(10) unsigned NOT NULL,
  `RankName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `RankCode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Hierarchy` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ranks`
--

INSERT INTO `ranks` (`RankID`, `RankName`, `RankCode`, `Hierarchy`, `created_at`, `updated_at`) VALUES
(1, 'Police Director General', 'PDG', 1, '2016-03-14 23:53:37', '2016-05-06 07:26:22'),
(2, 'Police Deputy Director General', 'PDDG', 2, '2016-03-14 23:53:58', '2016-03-14 23:53:58'),
(3, 'Police Director', 'PDIR', 3, '2016-03-14 23:54:32', '2016-03-14 23:54:32'),
(4, 'Police Chief Superintendent', 'PCSUPT', 4, '2016-03-14 23:55:08', '2016-03-14 23:55:08'),
(5, 'Police Senior Superintendent', 'PSSUPT', 5, '2016-03-14 23:55:26', '2016-03-14 23:55:26'),
(6, 'Police Superintendent', 'PSUPT', 6, '2016-03-14 23:55:40', '2016-03-14 23:55:40'),
(7, 'Police Chief Inspector', 'PCINSP', 7, '2016-03-14 23:56:01', '2016-03-14 23:56:01'),
(8, 'Police Senior Inspector', 'PSINSP', 8, '2016-03-14 23:56:33', '2016-03-14 23:56:33'),
(9, 'Police Inspector', 'PINSP', 9, '2016-03-14 23:56:45', '2016-03-14 23:56:45'),
(10, 'Non Uniformed Personnel', 'NUP', 17, '2016-03-14 23:57:04', '2016-05-02 06:53:33'),
(11, 'Senior Police Officer 4', 'SPO4', 10, '2016-03-14 23:57:25', '2016-05-02 06:50:55'),
(12, 'Senior Police Officer 3', 'SPO3', 11, '2016-05-02 06:42:33', '2016-05-02 06:51:01'),
(13, 'Senior Police Officer 2', 'SPO2', 12, '2016-05-02 06:43:06', '2016-05-02 06:51:08'),
(14, 'Senior Police Office 1', 'SPO1', 13, '2016-05-02 06:44:42', '2016-05-02 06:51:15'),
(15, 'Police Officer 3', 'PO3', 14, '2016-05-02 06:51:46', '2016-05-02 06:51:46'),
(16, 'Police Officer 2', 'PO2', 15, '2016-05-02 06:53:01', '2016-05-02 06:53:01'),
(17, 'Police Officer 1', 'PO1', 16, '2016-05-02 06:53:20', '2016-05-02 06:53:20'),
(18, 'Civilian', 'CIV', 18, '2016-05-02 06:53:46', '2016-05-02 06:53:46');

-- --------------------------------------------------------

--
-- Table structure for table `secondary_audit_trails`
--

CREATE TABLE IF NOT EXISTS `secondary_audit_trails` (
  `SecondaryUnitAuditTrailID` int(10) unsigned NOT NULL,
  `Action` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UserSecondaryUnitID` int(11) NOT NULL,
  `SecondaryUnitID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `secondary_units`
--

CREATE TABLE IF NOT EXISTS `secondary_units` (
  `SecondaryUnitID` int(10) unsigned NOT NULL,
  `SecondaryUnitName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `SecondaryUnitAbbreviation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `PicturePath` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UnitID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `secondary_unit_accomplishments`
--

CREATE TABLE IF NOT EXISTS `secondary_unit_accomplishments` (
  `SecondaryUnitAccomplishmentID` int(10) unsigned NOT NULL,
  `JanuaryAccomplishment` double(8,2) NOT NULL,
  `FebruaryAccomplishment` double(8,2) NOT NULL,
  `MarchAccomplishment` double(8,2) NOT NULL,
  `AprilAccomplishment` double(8,2) NOT NULL,
  `MayAccomplishment` double(8,2) NOT NULL,
  `JuneAccomplishment` double(8,2) NOT NULL,
  `JulyAccomplishment` double(8,2) NOT NULL,
  `AugustAccomplishment` double(8,2) NOT NULL,
  `SeptemberAccomplishment` double(8,2) NOT NULL,
  `OctoberAccomplishment` double(8,2) NOT NULL,
  `NovemberAccomplishment` double(8,2) NOT NULL,
  `DecemberAccomplishment` double(8,2) NOT NULL,
  `AccomplishmentDate` date NOT NULL,
  `SecondaryUnitMeasureID` int(11) NOT NULL,
  `SecondaryUnitID` int(11) NOT NULL,
  `UserSecondaryUnitID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `secondary_unit_fundings`
--

CREATE TABLE IF NOT EXISTS `secondary_unit_fundings` (
  `SecondaryUnitFundingID` int(10) unsigned NOT NULL,
  `SecondaryUnitFundingEstimate` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `SecondaryUnitFundingActual` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `SecondaryUnitFundingDate` date NOT NULL,
  `SecondaryUnitMeasureID` int(11) NOT NULL,
  `SecondaryUnitID` int(11) NOT NULL,
  `UserSecondaryUnitID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `secondary_unit_initiatives`
--

CREATE TABLE IF NOT EXISTS `secondary_unit_initiatives` (
  `SecondaryUnitInitiativeID` int(10) unsigned NOT NULL,
  `SecondaryUnitInitiativeContent` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `SecondaryUnitInitiativeDate` date NOT NULL,
  `SecondaryUnitMeasureID` int(11) NOT NULL,
  `SecondaryUnitID` int(11) NOT NULL,
  `UserSecondaryUnitID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `secondary_unit_measures`
--

CREATE TABLE IF NOT EXISTS `secondary_unit_measures` (
  `SecondaryUnitMeasureID` int(10) unsigned NOT NULL,
  `SecondaryUnitMeasureName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `SecondaryUnitMeasureType` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `SecondaryUnitMeasureFormula` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `SecondaryUnitObjectiveID` int(11) NOT NULL,
  `UnitMeasureID` int(11) NOT NULL,
  `SecondaryUnitID` int(11) NOT NULL,
  `UserSecondaryUnitID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `secondary_unit_objectives`
--

CREATE TABLE IF NOT EXISTS `secondary_unit_objectives` (
  `SecondaryUnitObjectiveID` int(10) unsigned NOT NULL,
  `SecondaryUnitObjectiveName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `PerspectiveID` int(11) NOT NULL,
  `SecondaryUnitID` int(11) NOT NULL,
  `UserSecondaryUnitID` int(11) NOT NULL,
  `UnitObjectiveID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `secondary_unit_owners`
--

CREATE TABLE IF NOT EXISTS `secondary_unit_owners` (
  `SecondaryUnitOwnerID` int(10) unsigned NOT NULL,
  `SecondaryUnitOwnerContent` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `SecondaryUnitOwnerDate` date NOT NULL,
  `SecondaryUnitMeasureID` int(11) NOT NULL,
  `SecondaryUnitID` int(11) NOT NULL,
  `UserSecondaryUnitID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `secondary_unit_targets`
--

CREATE TABLE IF NOT EXISTS `secondary_unit_targets` (
  `SecondaryUnitTargetID` int(10) unsigned NOT NULL,
  `JanuaryTarget` double(8,2) NOT NULL,
  `FebruaryTarget` double(8,2) NOT NULL,
  `MarchTarget` double(8,2) NOT NULL,
  `AprilTarget` double(8,2) NOT NULL,
  `MayTarget` double(8,2) NOT NULL,
  `JuneTarget` double(8,2) NOT NULL,
  `JulyTarget` double(8,2) NOT NULL,
  `AugustTarget` double(8,2) NOT NULL,
  `SeptemberTarget` double(8,2) NOT NULL,
  `OctoberTarget` double(8,2) NOT NULL,
  `NovemberTarget` double(8,2) NOT NULL,
  `DecemberTarget` double(8,2) NOT NULL,
  `TargetDate` date NOT NULL,
  `TargetPeriod` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Termination` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `SecondaryUnitAccomplishmentID` int(11) NOT NULL,
  `SecondaryUnitOwnerID` int(11) NOT NULL,
  `SecondaryUnitInitiativeID` int(11) NOT NULL,
  `SecondaryUnitFundingID` int(11) NOT NULL,
  `SecondaryUnitMeasureID` int(11) NOT NULL,
  `SecondaryUnitID` int(11) NOT NULL,
  `UserSecondaryUnitID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staffs`
--

CREATE TABLE IF NOT EXISTS `staffs` (
  `StaffID` int(10) unsigned NOT NULL,
  `StaffName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `StaffAbbreviation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `StaffPermission` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UserStaffID` int(11) NOT NULL,
  `PicturePath` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ChiefID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff_accomplishments`
--

CREATE TABLE IF NOT EXISTS `staff_accomplishments` (
  `StaffAccomplishmentID` int(10) unsigned NOT NULL,
  `JanuaryAccomplishment` double(8,2) NOT NULL,
  `FebruaryAccomplishment` double(8,2) NOT NULL,
  `MarchAccomplishment` double(8,2) NOT NULL,
  `AprilAccomplishment` double(8,2) NOT NULL,
  `MayAccomplishment` double(8,2) NOT NULL,
  `JuneAccomplishment` double(8,2) NOT NULL,
  `JulyAccomplishment` double(8,2) NOT NULL,
  `AugustAccomplishment` double(8,2) NOT NULL,
  `SeptemberAccomplishment` double(8,2) NOT NULL,
  `OctoberAccomplishment` double(8,2) NOT NULL,
  `NovemberAccomplishment` double(8,2) NOT NULL,
  `DecemberAccomplishment` double(8,2) NOT NULL,
  `AccomplishmentDate` date NOT NULL,
  `StaffMeasureID` int(11) NOT NULL,
  `StaffID` int(11) NOT NULL,
  `UserStaffID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff_audit_trails`
--

CREATE TABLE IF NOT EXISTS `staff_audit_trails` (
  `StaffAuditTrailID` int(10) unsigned NOT NULL,
  `Action` text COLLATE utf8_unicode_ci NOT NULL,
  `StaffID` int(11) NOT NULL,
  `UserStaffID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff_fundings`
--

CREATE TABLE IF NOT EXISTS `staff_fundings` (
  `StaffFundingID` int(10) unsigned NOT NULL,
  `StaffFundingEstimate` float NOT NULL,
  `StaffFundingActual` float NOT NULL,
  `StaffFundingDate` date NOT NULL,
  `StaffMeasureID` int(11) NOT NULL,
  `StaffID` int(11) NOT NULL,
  `UserStaffID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff_initiatives`
--

CREATE TABLE IF NOT EXISTS `staff_initiatives` (
  `StaffInitiativeID` int(10) unsigned NOT NULL,
  `StaffInitiativeContent` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `StaffInitiativeDate` date NOT NULL,
  `StaffMeasureID` int(11) NOT NULL,
  `StaffID` int(11) NOT NULL,
  `UserStaffID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff_logs`
--

CREATE TABLE IF NOT EXISTS `staff_logs` (
  `StaffLogID` int(10) unsigned NOT NULL,
  `StaffUserID` int(11) NOT NULL,
  `LogDateTime` datetime NOT NULL,
  `LogType` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `IPAddress` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff_measures`
--

CREATE TABLE IF NOT EXISTS `staff_measures` (
  `StaffMeasureID` int(10) unsigned NOT NULL,
  `StaffMeasureName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `StaffMeasureType` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `StaffMeasureFormula` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `StaffObjectiveID` int(11) NOT NULL,
  `ChiefMeasureID` int(11) NOT NULL,
  `StaffID` int(11) NOT NULL,
  `UserStaffID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff_objectives`
--

CREATE TABLE IF NOT EXISTS `staff_objectives` (
  `StaffObjectiveID` int(10) unsigned NOT NULL,
  `StaffObjectiveName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `PerspectiveID` int(11) NOT NULL,
  `StaffID` int(11) NOT NULL,
  `UserStaffID` int(11) NOT NULL,
  `ChiefObjectiveID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff_owners`
--

CREATE TABLE IF NOT EXISTS `staff_owners` (
  `StaffOwnerID` int(10) unsigned NOT NULL,
  `StaffOwnerContent` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `StaffOwnerDate` date NOT NULL,
  `StaffMeasureID` int(11) NOT NULL,
  `StaffID` int(11) NOT NULL,
  `UserStaffID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff_targets`
--

CREATE TABLE IF NOT EXISTS `staff_targets` (
  `StaffTargetID` int(10) unsigned NOT NULL,
  `JanuaryTarget` double(8,2) NOT NULL,
  `FebruaryTarget` double(8,2) NOT NULL,
  `MarchTarget` double(8,2) NOT NULL,
  `AprilTarget` double(8,2) NOT NULL,
  `MayTarget` double(8,2) NOT NULL,
  `JuneTarget` double(8,2) NOT NULL,
  `JulyTarget` double(8,2) NOT NULL,
  `AugustTarget` double(8,2) NOT NULL,
  `SeptemberTarget` double(8,2) NOT NULL,
  `OctoberTarget` double(8,2) NOT NULL,
  `NovemberTarget` double(8,2) NOT NULL,
  `DecemberTarget` double(8,2) NOT NULL,
  `TargetDate` date NOT NULL,
  `TargetPeriod` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Termination` date DEFAULT NULL,
  `StaffMeasureID` int(11) NOT NULL,
  `StaffAccomplishmentID` int(11) NOT NULL,
  `StaffOwnerID` int(11) NOT NULL,
  `StaffInitiativeID` int(11) NOT NULL,
  `StaffFundingID` int(11) NOT NULL,
  `StaffID` int(11) NOT NULL,
  `UserStaffID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tertiary_audit_trails`
--

CREATE TABLE IF NOT EXISTS `tertiary_audit_trails` (
  `TertiaryUnitAuditTrailID` int(10) unsigned NOT NULL,
  `Action` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UserTertiaryUnitID` int(11) NOT NULL,
  `TertiaryUnitID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tertiary_units`
--

CREATE TABLE IF NOT EXISTS `tertiary_units` (
  `TertiaryUnitID` int(10) unsigned NOT NULL,
  `TertiaryUnitName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `TertiaryUnitAbbreviation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `PicturePath` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `SecondaryUnitID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tertiary_unit_accomplishments`
--

CREATE TABLE IF NOT EXISTS `tertiary_unit_accomplishments` (
  `TertiaryUnitAccomplishmentID` int(10) unsigned NOT NULL,
  `JanuaryAccomplishment` double(8,2) NOT NULL,
  `FebruaryAccomplishment` double(8,2) NOT NULL,
  `MarchAccomplishment` double(8,2) NOT NULL,
  `AprilAccomplishment` double(8,2) NOT NULL,
  `MayAccomplishment` double(8,2) NOT NULL,
  `JuneAccomplishment` double(8,2) NOT NULL,
  `JulyAccomplishment` double(8,2) NOT NULL,
  `AugustAccomplishment` double(8,2) NOT NULL,
  `SeptemberAccomplishment` double(8,2) NOT NULL,
  `OctoberAccomplishment` double(8,2) NOT NULL,
  `NovemberAccomplishment` double(8,2) NOT NULL,
  `DecemberAccomplishment` double(8,2) NOT NULL,
  `AccomplishmentDate` date NOT NULL,
  `TertiaryUnitMeasureID` int(11) NOT NULL,
  `TertiaryUnitID` int(11) NOT NULL,
  `UserTertiaryUnitID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tertiary_unit_fundings`
--

CREATE TABLE IF NOT EXISTS `tertiary_unit_fundings` (
  `TertiaryUnitFundingID` int(10) unsigned NOT NULL,
  `TertiaryUnitFundingEstimate` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `TertiaryUnitFundingActual` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `TertiaryUnitFundingDate` date NOT NULL,
  `TertiaryUnitMeasureID` int(11) NOT NULL,
  `TertiaryUnitID` int(11) NOT NULL,
  `UserTertiaryUnitID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tertiary_unit_initiatives`
--

CREATE TABLE IF NOT EXISTS `tertiary_unit_initiatives` (
  `TertiaryUnitInitiativeID` int(10) unsigned NOT NULL,
  `TertiaryUnitInitiativeContent` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `TertiaryUnitInitiativeDate` date NOT NULL,
  `TertiaryUnitMeasureID` int(11) NOT NULL,
  `TertiaryUnitID` int(11) NOT NULL,
  `UserTertiaryUnitID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tertiary_unit_measures`
--

CREATE TABLE IF NOT EXISTS `tertiary_unit_measures` (
  `TertiaryUnitMeasureID` int(10) unsigned NOT NULL,
  `TertiaryUnitMeasureName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `TertiaryUnitMeasureType` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `TertiaryUnitMeasureFormula` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `TertiaryUnitObjectiveID` int(11) NOT NULL,
  `SecondaryUnitMeasureID` int(11) NOT NULL,
  `TertiaryUnitID` int(11) NOT NULL,
  `UserTertiaryUnitID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tertiary_unit_objectives`
--

CREATE TABLE IF NOT EXISTS `tertiary_unit_objectives` (
  `TertiaryUnitObjectiveID` int(10) unsigned NOT NULL,
  `TertiaryUnitObjectiveName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `PerspectiveID` int(11) NOT NULL,
  `TertiaryUnitID` int(11) NOT NULL,
  `UserTertiaryUnitID` int(11) NOT NULL,
  `SecondaryUnitObjectiveID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tertiary_unit_owners`
--

CREATE TABLE IF NOT EXISTS `tertiary_unit_owners` (
  `TertiaryUnitOwnerID` int(10) unsigned NOT NULL,
  `TertiaryUnitOwnerContent` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `TertiaryUnitOwnerDate` date NOT NULL,
  `TertiaryUnitMeasureID` int(11) NOT NULL,
  `TertiaryUnitID` int(11) NOT NULL,
  `UserTertiaryUnitID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tertiary_unit_targets`
--

CREATE TABLE IF NOT EXISTS `tertiary_unit_targets` (
  `TertiaryUnitTargetID` int(10) unsigned NOT NULL,
  `JanuaryTarget` double(8,2) NOT NULL,
  `FebruaryTarget` double(8,2) NOT NULL,
  `MarchTarget` double(8,2) NOT NULL,
  `AprilTarget` double(8,2) NOT NULL,
  `MayTarget` double(8,2) NOT NULL,
  `JuneTarget` double(8,2) NOT NULL,
  `JulyTarget` double(8,2) NOT NULL,
  `AugustTarget` double(8,2) NOT NULL,
  `SeptemberTarget` double(8,2) NOT NULL,
  `OctoberTarget` double(8,2) NOT NULL,
  `NovemberTarget` double(8,2) NOT NULL,
  `DecemberTarget` double(8,2) NOT NULL,
  `TargetDate` date NOT NULL,
  `TargetPeriod` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Termination` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `TertiaryUnitMeasureID` int(11) NOT NULL,
  `TertiaryUnitAccomplishmentID` int(11) NOT NULL,
  `TertiaryUnitOwnerID` int(11) NOT NULL,
  `TertiaryUnitFundingID` int(11) NOT NULL,
  `TertiaryUnitInitiativeID` int(11) NOT NULL,
  `TertiaryUnitID` int(11) NOT NULL,
  `UserTertiaryUnitID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE IF NOT EXISTS `units` (
  `UnitID` int(10) unsigned NOT NULL,
  `UnitName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UnitAbbreviation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `PicturePath` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `StaffID` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `unit_accomplishments`
--

CREATE TABLE IF NOT EXISTS `unit_accomplishments` (
  `UnitAccomplishmentID` int(10) unsigned NOT NULL,
  `JanuaryAccomplishment` double(8,2) NOT NULL,
  `FebruaryAccomplishment` double(8,2) NOT NULL,
  `MarchAccomplishment` double(8,2) NOT NULL,
  `AprilAccomplishment` double(8,2) NOT NULL,
  `MayAccomplishment` double(8,2) NOT NULL,
  `JuneAccomplishment` double(8,2) NOT NULL,
  `JulyAccomplishment` double(8,2) NOT NULL,
  `AugustAccomplishment` double(8,2) NOT NULL,
  `SeptemberAccomplishment` double(8,2) NOT NULL,
  `OctoberAccomplishment` double(8,2) NOT NULL,
  `NovemberAccomplishment` double(8,2) NOT NULL,
  `DecemberAccomplishment` double(8,2) NOT NULL,
  `AccomplishmentDate` date NOT NULL,
  `UnitMeasureID` int(11) NOT NULL,
  `UnitID` int(11) NOT NULL,
  `UserUnitID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `unit_fundings`
--

CREATE TABLE IF NOT EXISTS `unit_fundings` (
  `UnitFundingID` int(10) unsigned NOT NULL,
  `UnitFundingEstimate` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UnitFundingActual` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UnitFundingDate` date NOT NULL,
  `UnitMeasureID` int(11) NOT NULL,
  `UnitID` int(11) NOT NULL,
  `UserUnitID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `unit_initiatives`
--

CREATE TABLE IF NOT EXISTS `unit_initiatives` (
  `UnitInitiativeID` int(10) unsigned NOT NULL,
  `UnitInitiativeContent` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UnitInitiativeDate` date NOT NULL,
  `UnitMeasureID` int(11) NOT NULL,
  `UnitID` int(11) NOT NULL,
  `UserUnitID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `unit_measures`
--

CREATE TABLE IF NOT EXISTS `unit_measures` (
  `UnitMeasureID` int(10) unsigned NOT NULL,
  `UnitMeasureName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UnitMeasureType` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UnitMeasureFormula` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UnitObjectiveID` int(11) NOT NULL,
  `StaffMeasureID` int(11) NOT NULL,
  `UnitID` int(11) NOT NULL,
  `UserUnitID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `unit_objectives`
--

CREATE TABLE IF NOT EXISTS `unit_objectives` (
  `UnitObjectiveID` int(10) unsigned NOT NULL,
  `UnitObjectiveName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `PerspectiveID` int(11) NOT NULL,
  `StaffObjectiveID` int(11) NOT NULL,
  `UnitID` int(11) NOT NULL,
  `UserUnitID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `unit_owners`
--

CREATE TABLE IF NOT EXISTS `unit_owners` (
  `UnitOwnerID` int(10) unsigned NOT NULL,
  `UnitOwnerContent` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UnitOwnerDate` date NOT NULL,
  `UnitMeasureID` int(11) NOT NULL,
  `UnitID` int(11) NOT NULL,
  `UserUnitID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `unit_targets`
--

CREATE TABLE IF NOT EXISTS `unit_targets` (
  `UnitTargetID` int(10) unsigned NOT NULL,
  `JanuaryTarget` double(8,2) NOT NULL,
  `FebruaryTarget` double(8,2) NOT NULL,
  `MarchTarget` double(8,2) NOT NULL,
  `AprilTarget` double(8,2) NOT NULL,
  `MayTarget` double(8,2) NOT NULL,
  `JuneTarget` double(8,2) NOT NULL,
  `JulyTarget` double(8,2) NOT NULL,
  `AugustTarget` double(8,2) NOT NULL,
  `SeptemberTarget` double(8,2) NOT NULL,
  `OctoberTarget` double(8,2) NOT NULL,
  `NovemberTarget` double(8,2) NOT NULL,
  `DecemberTarget` double(8,2) NOT NULL,
  `TargetDate` date NOT NULL,
  `TargetPeriod` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Termination` date DEFAULT NULL,
  `UnitAccomplishmentID` int(11) NOT NULL,
  `UnitOwnerID` int(11) NOT NULL,
  `UnitInitiativeID` int(11) NOT NULL,
  `UnitFundingID` int(11) NOT NULL,
  `UnitMeasureID` int(11) NOT NULL,
  `UnitID` int(11) NOT NULL,
  `UserUnitID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Administrator', 'usc@cpsm.pnp.gov.ph', '$2y$10$zSC2JGHGr7/A4HbZI/S2mOj4gY6bXd2HkR9sf8YXkojtX4snxTjp2', '7BHygEIOCzeyfcM7Ln5dSIzDQOA6oRq1ZUIkzTZZ7H1nuHmrvhgkcgWijx9c', '2016-03-13 05:42:04', '2016-06-07 11:43:21');

-- --------------------------------------------------------

--
-- Table structure for table `user_chiefs`
--

CREATE TABLE IF NOT EXISTS `user_chiefs` (
  `UserChiefID` int(10) unsigned NOT NULL,
  `UserChiefBadgeNumber` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UserChiefFirstName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UserChiefMiddleName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UserChiefLastName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UserChiefQualifier` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UserChiefPicturePath` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UserChiefPassword` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `RankID` int(11) NOT NULL,
  `ChiefID` int(11) NOT NULL,
  `UserChiefIsActive` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_chiefs`
--

INSERT INTO `user_chiefs` (`UserChiefID`, `UserChiefBadgeNumber`, `UserChiefFirstName`, `UserChiefMiddleName`, `UserChiefLastName`, `UserChiefQualifier`, `UserChiefPicturePath`, `UserChiefPassword`, `RankID`, `ChiefID`, `UserChiefIsActive`, `created_at`, `updated_at`) VALUES
(1, 'O-00000', 'Chief', '', 'PNP', '', 'ksNMTC23nA2xIfbPqFPkha4y0uwxq16F.png', 'chiefpnp', 1, 1, 1, '2016-04-29 00:54:46', '2016-05-26 05:03:09');

-- --------------------------------------------------------

--
-- Table structure for table `user_logs`
--

CREATE TABLE IF NOT EXISTS `user_logs` (
  `UserLogID` int(10) unsigned NOT NULL,
  `UnitUserID` int(11) NOT NULL,
  `LogDateTime` datetime NOT NULL,
  `LogType` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `IPAddress` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_secondary_units`
--

CREATE TABLE IF NOT EXISTS `user_secondary_units` (
  `UserSecondaryUnitID` int(10) unsigned NOT NULL,
  `UserSecondaryUnitBadgeNumber` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UserSecondaryUnitFirstName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UserSecondaryUnitMiddleName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UserSecondaryUnitLastName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UserSecondaryUnitQualifier` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UserSecondaryUnitPicturePath` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UserSecondaryUnitPassword` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `RankID` int(11) NOT NULL,
  `SecondaryUnitID` int(11) NOT NULL,
  `UserSecondaryUnitIsActive` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_staffs`
--

CREATE TABLE IF NOT EXISTS `user_staffs` (
  `UserStaffID` int(10) unsigned NOT NULL,
  `UserStaffBadgeNumber` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UserStaffFirstName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UserStaffMiddleName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UserStaffLastName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UserStaffQualifier` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UserStaffPicturePath` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UserStaffPassword` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `RankID` int(11) NOT NULL,
  `StaffID` int(11) NOT NULL,
  `UserStaffIsActive` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_tertiary_units`
--

CREATE TABLE IF NOT EXISTS `user_tertiary_units` (
  `UserTertiaryUnitID` int(10) unsigned NOT NULL,
  `UserTertiaryUnitBadgeNumber` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UserTertiaryUnitFirstName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UserTertiaryUnitMiddleName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UserTertiaryUnitLastName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UserTertiaryUnitQualifier` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UserTertiaryUnitPicturePath` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UserTertiaryUnitPassword` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `RankID` int(11) NOT NULL,
  `TertiaryUnitID` int(11) NOT NULL,
  `UserTertiaryUnitIsActive` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_units`
--

CREATE TABLE IF NOT EXISTS `user_units` (
  `UserUnitID` int(10) unsigned NOT NULL,
  `UserUnitBadgeNumber` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UserUnitFirstName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UserUnitMiddleName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UserUnitLastName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UserUnitQualifier` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UserUnitPicturePath` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UserUnitPassword` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `RankID` int(11) NOT NULL,
  `UnitID` int(11) NOT NULL,
  `UserUnitIsActive` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit_trails`
--
ALTER TABLE `audit_trails`
  ADD PRIMARY KEY (`AuditTrailID`);

--
-- Indexes for table `chiefs`
--
ALTER TABLE `chiefs`
  ADD PRIMARY KEY (`ChiefID`),
  ADD UNIQUE KEY `chiefs_chiefname_unique` (`ChiefName`),
  ADD UNIQUE KEY `chiefs_chiefabbreviation_unique` (`ChiefAbbreviation`);

--
-- Indexes for table `chief_accomplishments`
--
ALTER TABLE `chief_accomplishments`
  ADD PRIMARY KEY (`ChiefAccomplishmentID`);

--
-- Indexes for table `chief_audit_trails`
--
ALTER TABLE `chief_audit_trails`
  ADD PRIMARY KEY (`ChiefAuditTrailID`);

--
-- Indexes for table `chief_fundings`
--
ALTER TABLE `chief_fundings`
  ADD PRIMARY KEY (`ChiefFundingID`);

--
-- Indexes for table `chief_initiatives`
--
ALTER TABLE `chief_initiatives`
  ADD PRIMARY KEY (`ChiefInitiativeID`);

--
-- Indexes for table `chief_logs`
--
ALTER TABLE `chief_logs`
  ADD PRIMARY KEY (`ChiefLogID`);

--
-- Indexes for table `chief_measures`
--
ALTER TABLE `chief_measures`
  ADD PRIMARY KEY (`ChiefMeasureID`),
  ADD UNIQUE KEY `chief_measures_chiefmeasurename_unique` (`ChiefMeasureName`);

--
-- Indexes for table `chief_objectives`
--
ALTER TABLE `chief_objectives`
  ADD PRIMARY KEY (`ChiefObjectiveID`);

--
-- Indexes for table `chief_owners`
--
ALTER TABLE `chief_owners`
  ADD PRIMARY KEY (`ChiefOwnerID`);

--
-- Indexes for table `chief_targets`
--
ALTER TABLE `chief_targets`
  ADD PRIMARY KEY (`ChiefTargetID`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `perspectives`
--
ALTER TABLE `perspectives`
  ADD PRIMARY KEY (`PerspectiveID`),
  ADD UNIQUE KEY `perspectives_perspectivename_unique` (`PerspectiveName`);

--
-- Indexes for table `ranks`
--
ALTER TABLE `ranks`
  ADD PRIMARY KEY (`RankID`),
  ADD UNIQUE KEY `ranks_rankname_unique` (`RankName`),
  ADD UNIQUE KEY `ranks_rankcode_unique` (`RankCode`);

--
-- Indexes for table `secondary_audit_trails`
--
ALTER TABLE `secondary_audit_trails`
  ADD PRIMARY KEY (`SecondaryUnitAuditTrailID`);

--
-- Indexes for table `secondary_units`
--
ALTER TABLE `secondary_units`
  ADD PRIMARY KEY (`SecondaryUnitID`),
  ADD UNIQUE KEY `secondary_units_secondaryunitname_unique` (`SecondaryUnitName`),
  ADD UNIQUE KEY `secondary_units_secondaryunitabbreviation_unique` (`SecondaryUnitAbbreviation`);

--
-- Indexes for table `secondary_unit_accomplishments`
--
ALTER TABLE `secondary_unit_accomplishments`
  ADD PRIMARY KEY (`SecondaryUnitAccomplishmentID`);

--
-- Indexes for table `secondary_unit_fundings`
--
ALTER TABLE `secondary_unit_fundings`
  ADD PRIMARY KEY (`SecondaryUnitFundingID`);

--
-- Indexes for table `secondary_unit_initiatives`
--
ALTER TABLE `secondary_unit_initiatives`
  ADD PRIMARY KEY (`SecondaryUnitInitiativeID`);

--
-- Indexes for table `secondary_unit_measures`
--
ALTER TABLE `secondary_unit_measures`
  ADD PRIMARY KEY (`SecondaryUnitMeasureID`);

--
-- Indexes for table `secondary_unit_objectives`
--
ALTER TABLE `secondary_unit_objectives`
  ADD PRIMARY KEY (`SecondaryUnitObjectiveID`),
  ADD UNIQUE KEY `secondary_unit_objectives_secondaryunitobjectivename_unique` (`SecondaryUnitObjectiveName`);

--
-- Indexes for table `secondary_unit_owners`
--
ALTER TABLE `secondary_unit_owners`
  ADD PRIMARY KEY (`SecondaryUnitOwnerID`);

--
-- Indexes for table `secondary_unit_targets`
--
ALTER TABLE `secondary_unit_targets`
  ADD PRIMARY KEY (`SecondaryUnitTargetID`);

--
-- Indexes for table `staffs`
--
ALTER TABLE `staffs`
  ADD PRIMARY KEY (`StaffID`),
  ADD UNIQUE KEY `staffs_staffname_unique` (`StaffName`),
  ADD UNIQUE KEY `staffs_staffabbreviation_unique` (`StaffAbbreviation`);

--
-- Indexes for table `staff_accomplishments`
--
ALTER TABLE `staff_accomplishments`
  ADD PRIMARY KEY (`StaffAccomplishmentID`);

--
-- Indexes for table `staff_audit_trails`
--
ALTER TABLE `staff_audit_trails`
  ADD PRIMARY KEY (`StaffAuditTrailID`);

--
-- Indexes for table `staff_fundings`
--
ALTER TABLE `staff_fundings`
  ADD PRIMARY KEY (`StaffFundingID`);

--
-- Indexes for table `staff_initiatives`
--
ALTER TABLE `staff_initiatives`
  ADD PRIMARY KEY (`StaffInitiativeID`);

--
-- Indexes for table `staff_logs`
--
ALTER TABLE `staff_logs`
  ADD PRIMARY KEY (`StaffLogID`);

--
-- Indexes for table `staff_measures`
--
ALTER TABLE `staff_measures`
  ADD PRIMARY KEY (`StaffMeasureID`);

--
-- Indexes for table `staff_objectives`
--
ALTER TABLE `staff_objectives`
  ADD PRIMARY KEY (`StaffObjectiveID`);

--
-- Indexes for table `staff_owners`
--
ALTER TABLE `staff_owners`
  ADD PRIMARY KEY (`StaffOwnerID`);

--
-- Indexes for table `staff_targets`
--
ALTER TABLE `staff_targets`
  ADD PRIMARY KEY (`StaffTargetID`);

--
-- Indexes for table `tertiary_audit_trails`
--
ALTER TABLE `tertiary_audit_trails`
  ADD PRIMARY KEY (`TertiaryUnitAuditTrailID`);

--
-- Indexes for table `tertiary_units`
--
ALTER TABLE `tertiary_units`
  ADD PRIMARY KEY (`TertiaryUnitID`),
  ADD UNIQUE KEY `tertiary_units_tertiaryunitname_unique` (`TertiaryUnitName`),
  ADD UNIQUE KEY `tertiary_units_tertiaryunitabbreviation_unique` (`TertiaryUnitAbbreviation`);

--
-- Indexes for table `tertiary_unit_accomplishments`
--
ALTER TABLE `tertiary_unit_accomplishments`
  ADD PRIMARY KEY (`TertiaryUnitAccomplishmentID`);

--
-- Indexes for table `tertiary_unit_fundings`
--
ALTER TABLE `tertiary_unit_fundings`
  ADD PRIMARY KEY (`TertiaryUnitFundingID`);

--
-- Indexes for table `tertiary_unit_initiatives`
--
ALTER TABLE `tertiary_unit_initiatives`
  ADD PRIMARY KEY (`TertiaryUnitInitiativeID`);

--
-- Indexes for table `tertiary_unit_measures`
--
ALTER TABLE `tertiary_unit_measures`
  ADD PRIMARY KEY (`TertiaryUnitMeasureID`);

--
-- Indexes for table `tertiary_unit_objectives`
--
ALTER TABLE `tertiary_unit_objectives`
  ADD PRIMARY KEY (`TertiaryUnitObjectiveID`),
  ADD UNIQUE KEY `tertiary_unit_objectives_tertiaryunitobjectivename_unique` (`TertiaryUnitObjectiveName`);

--
-- Indexes for table `tertiary_unit_owners`
--
ALTER TABLE `tertiary_unit_owners`
  ADD PRIMARY KEY (`TertiaryUnitOwnerID`);

--
-- Indexes for table `tertiary_unit_targets`
--
ALTER TABLE `tertiary_unit_targets`
  ADD PRIMARY KEY (`TertiaryUnitTargetID`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`UnitID`),
  ADD UNIQUE KEY `units_unitname_unique` (`UnitName`),
  ADD UNIQUE KEY `units_unitabbreviation_unique` (`UnitAbbreviation`);

--
-- Indexes for table `unit_accomplishments`
--
ALTER TABLE `unit_accomplishments`
  ADD PRIMARY KEY (`UnitAccomplishmentID`);

--
-- Indexes for table `unit_fundings`
--
ALTER TABLE `unit_fundings`
  ADD PRIMARY KEY (`UnitFundingID`);

--
-- Indexes for table `unit_initiatives`
--
ALTER TABLE `unit_initiatives`
  ADD PRIMARY KEY (`UnitInitiativeID`);

--
-- Indexes for table `unit_measures`
--
ALTER TABLE `unit_measures`
  ADD PRIMARY KEY (`UnitMeasureID`),
  ADD UNIQUE KEY `unit_measures_unitmeasurename_unique` (`UnitMeasureName`);

--
-- Indexes for table `unit_objectives`
--
ALTER TABLE `unit_objectives`
  ADD PRIMARY KEY (`UnitObjectiveID`),
  ADD UNIQUE KEY `unit_objectives_unitobjectivename_unique` (`UnitObjectiveName`);

--
-- Indexes for table `unit_owners`
--
ALTER TABLE `unit_owners`
  ADD PRIMARY KEY (`UnitOwnerID`);

--
-- Indexes for table `unit_targets`
--
ALTER TABLE `unit_targets`
  ADD PRIMARY KEY (`UnitTargetID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_chiefs`
--
ALTER TABLE `user_chiefs`
  ADD PRIMARY KEY (`UserChiefID`),
  ADD UNIQUE KEY `user_chiefs_userchiefbadgenumber_unique` (`UserChiefBadgeNumber`);

--
-- Indexes for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD PRIMARY KEY (`UserLogID`);

--
-- Indexes for table `user_secondary_units`
--
ALTER TABLE `user_secondary_units`
  ADD PRIMARY KEY (`UserSecondaryUnitID`),
  ADD UNIQUE KEY `user_secondary_units_usersecondaryunitbadgenumber_unique` (`UserSecondaryUnitBadgeNumber`);

--
-- Indexes for table `user_staffs`
--
ALTER TABLE `user_staffs`
  ADD PRIMARY KEY (`UserStaffID`),
  ADD UNIQUE KEY `user_staffs_userstaffbadgenumber_unique` (`UserStaffBadgeNumber`);

--
-- Indexes for table `user_tertiary_units`
--
ALTER TABLE `user_tertiary_units`
  ADD PRIMARY KEY (`UserTertiaryUnitID`),
  ADD UNIQUE KEY `user_tertiary_units_usertertiaryunitbadgenumber_unique` (`UserTertiaryUnitBadgeNumber`);

--
-- Indexes for table `user_units`
--
ALTER TABLE `user_units`
  ADD PRIMARY KEY (`UserUnitID`),
  ADD UNIQUE KEY `user_units_userunitbadgenumber_unique` (`UserUnitBadgeNumber`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit_trails`
--
ALTER TABLE `audit_trails`
  MODIFY `AuditTrailID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `chiefs`
--
ALTER TABLE `chiefs`
  MODIFY `ChiefID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `chief_accomplishments`
--
ALTER TABLE `chief_accomplishments`
  MODIFY `ChiefAccomplishmentID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `chief_audit_trails`
--
ALTER TABLE `chief_audit_trails`
  MODIFY `ChiefAuditTrailID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `chief_fundings`
--
ALTER TABLE `chief_fundings`
  MODIFY `ChiefFundingID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `chief_initiatives`
--
ALTER TABLE `chief_initiatives`
  MODIFY `ChiefInitiativeID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `chief_logs`
--
ALTER TABLE `chief_logs`
  MODIFY `ChiefLogID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `chief_measures`
--
ALTER TABLE `chief_measures`
  MODIFY `ChiefMeasureID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `chief_objectives`
--
ALTER TABLE `chief_objectives`
  MODIFY `ChiefObjectiveID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `chief_owners`
--
ALTER TABLE `chief_owners`
  MODIFY `ChiefOwnerID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `chief_targets`
--
ALTER TABLE `chief_targets`
  MODIFY `ChiefTargetID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `perspectives`
--
ALTER TABLE `perspectives`
  MODIFY `PerspectiveID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ranks`
--
ALTER TABLE `ranks`
  MODIFY `RankID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `secondary_audit_trails`
--
ALTER TABLE `secondary_audit_trails`
  MODIFY `SecondaryUnitAuditTrailID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `secondary_units`
--
ALTER TABLE `secondary_units`
  MODIFY `SecondaryUnitID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `secondary_unit_accomplishments`
--
ALTER TABLE `secondary_unit_accomplishments`
  MODIFY `SecondaryUnitAccomplishmentID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `secondary_unit_fundings`
--
ALTER TABLE `secondary_unit_fundings`
  MODIFY `SecondaryUnitFundingID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `secondary_unit_initiatives`
--
ALTER TABLE `secondary_unit_initiatives`
  MODIFY `SecondaryUnitInitiativeID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `secondary_unit_measures`
--
ALTER TABLE `secondary_unit_measures`
  MODIFY `SecondaryUnitMeasureID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `secondary_unit_objectives`
--
ALTER TABLE `secondary_unit_objectives`
  MODIFY `SecondaryUnitObjectiveID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `secondary_unit_owners`
--
ALTER TABLE `secondary_unit_owners`
  MODIFY `SecondaryUnitOwnerID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `secondary_unit_targets`
--
ALTER TABLE `secondary_unit_targets`
  MODIFY `SecondaryUnitTargetID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `staffs`
--
ALTER TABLE `staffs`
  MODIFY `StaffID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `staff_accomplishments`
--
ALTER TABLE `staff_accomplishments`
  MODIFY `StaffAccomplishmentID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `staff_audit_trails`
--
ALTER TABLE `staff_audit_trails`
  MODIFY `StaffAuditTrailID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `staff_fundings`
--
ALTER TABLE `staff_fundings`
  MODIFY `StaffFundingID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `staff_initiatives`
--
ALTER TABLE `staff_initiatives`
  MODIFY `StaffInitiativeID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `staff_logs`
--
ALTER TABLE `staff_logs`
  MODIFY `StaffLogID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `staff_measures`
--
ALTER TABLE `staff_measures`
  MODIFY `StaffMeasureID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `staff_objectives`
--
ALTER TABLE `staff_objectives`
  MODIFY `StaffObjectiveID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `staff_owners`
--
ALTER TABLE `staff_owners`
  MODIFY `StaffOwnerID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `staff_targets`
--
ALTER TABLE `staff_targets`
  MODIFY `StaffTargetID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tertiary_audit_trails`
--
ALTER TABLE `tertiary_audit_trails`
  MODIFY `TertiaryUnitAuditTrailID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tertiary_units`
--
ALTER TABLE `tertiary_units`
  MODIFY `TertiaryUnitID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tertiary_unit_accomplishments`
--
ALTER TABLE `tertiary_unit_accomplishments`
  MODIFY `TertiaryUnitAccomplishmentID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tertiary_unit_fundings`
--
ALTER TABLE `tertiary_unit_fundings`
  MODIFY `TertiaryUnitFundingID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tertiary_unit_initiatives`
--
ALTER TABLE `tertiary_unit_initiatives`
  MODIFY `TertiaryUnitInitiativeID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tertiary_unit_measures`
--
ALTER TABLE `tertiary_unit_measures`
  MODIFY `TertiaryUnitMeasureID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tertiary_unit_objectives`
--
ALTER TABLE `tertiary_unit_objectives`
  MODIFY `TertiaryUnitObjectiveID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tertiary_unit_owners`
--
ALTER TABLE `tertiary_unit_owners`
  MODIFY `TertiaryUnitOwnerID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tertiary_unit_targets`
--
ALTER TABLE `tertiary_unit_targets`
  MODIFY `TertiaryUnitTargetID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `UnitID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `unit_accomplishments`
--
ALTER TABLE `unit_accomplishments`
  MODIFY `UnitAccomplishmentID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `unit_fundings`
--
ALTER TABLE `unit_fundings`
  MODIFY `UnitFundingID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `unit_initiatives`
--
ALTER TABLE `unit_initiatives`
  MODIFY `UnitInitiativeID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `unit_measures`
--
ALTER TABLE `unit_measures`
  MODIFY `UnitMeasureID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `unit_objectives`
--
ALTER TABLE `unit_objectives`
  MODIFY `UnitObjectiveID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `unit_owners`
--
ALTER TABLE `unit_owners`
  MODIFY `UnitOwnerID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `unit_targets`
--
ALTER TABLE `unit_targets`
  MODIFY `UnitTargetID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user_chiefs`
--
ALTER TABLE `user_chiefs`
  MODIFY `UserChiefID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user_logs`
--
ALTER TABLE `user_logs`
  MODIFY `UserLogID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_secondary_units`
--
ALTER TABLE `user_secondary_units`
  MODIFY `UserSecondaryUnitID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_staffs`
--
ALTER TABLE `user_staffs`
  MODIFY `UserStaffID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_tertiary_units`
--
ALTER TABLE `user_tertiary_units`
  MODIFY `UserTertiaryUnitID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_units`
--
ALTER TABLE `user_units`
  MODIFY `UserUnitID` int(10) unsigned NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
