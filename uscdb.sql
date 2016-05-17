-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2016 at 04:54 PM
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
  `Action` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UserUnitID` int(11) NOT NULL,
  `UnitID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `audit_trails`
--

INSERT INTO `audit_trails` (`AuditTrailID`, `Action`, `UserUnitID`, `UnitID`, `created_at`, `updated_at`) VALUES
(1, 'Updated an Objective: "Improve crime preventions"', 1, 1, '2016-05-06 01:27:08', '2016-05-06 01:27:08'),
(2, 'Updated an Objective: "Optimize use of financial and logistical resource"', 1, 1, '2016-05-06 07:02:42', '2016-05-06 07:02:42'),
(3, 'Updated an Objective: "Optimize use of financial and logistical resource"', 1, 1, '2016-05-06 07:02:48', '2016-05-06 07:02:48'),
(4, 'Added an objective: "Develop a fully-responsive and Highly Professional Police Organization"', 0, 1, '2016-05-06 07:45:24', '2016-05-06 07:45:24'),
(5, 'Added an objective: "Develop a fully-responsive and Highly Professional Police Organization"', 0, 1, '2016-05-06 07:45:27', '2016-05-06 07:45:27'),
(6, 'Added an objective: "Develop a fully-responsive and Highly Professional Police Organization"', 0, 1, '2016-05-06 08:14:17', '2016-05-06 08:14:17'),
(7, 'Added an objective: "Develop a fully-responsive and Highly Professional Police Organization"', 0, 1, '2016-05-06 08:14:29', '2016-05-06 08:14:29'),
(8, 'Added an objective: "Develop a fully-responsive and Highly Professional Police Organization"', 0, 1, '2016-05-06 08:16:04', '2016-05-06 08:16:04'),
(9, 'Added an objective: "Sample objective for development purpose only version 1"', 1, 2, '2016-05-10 03:15:44', '2016-05-10 03:15:44'),
(10, 'Added an objective: "Sample objective for development purpose only version 1"', 1, 2, '2016-05-10 03:15:56', '2016-05-10 03:15:56'),
(11, 'Added an objective: "Obj1"', 1, 2, '2016-05-10 03:16:58', '2016-05-10 03:16:58'),
(12, 'Added an objective: "Obj1"', 1, 2, '2016-05-10 03:18:16', '2016-05-10 03:18:16'),
(13, 'Added an objective: "Development objective purpose only version 1"', 1, 2, '2016-05-10 03:21:48', '2016-05-10 03:21:48'),
(14, 'Updated an Objective: "Development objective purpose only version 2"', 1, 2, '2016-05-10 03:35:04', '2016-05-10 03:35:04'),
(15, 'Added an objective: "Development objective 3"', 1, 2, '2016-05-10 03:35:52', '2016-05-10 03:35:52'),
(16, 'Added a measure: "Development Measures"', 1, 2, '2016-05-10 04:05:11', '2016-05-10 04:05:11'),
(17, 'Added an objective: "Development objective 3"', 1, 2, '2016-05-10 04:58:59', '2016-05-10 04:58:59'),
(18, 'Added an objective: "Development objective 3"', 1, 2, '2016-05-10 04:59:03', '2016-05-10 04:59:03'),
(19, 'Added an objective: "Development objective 3"', 1, 2, '2016-05-10 04:59:06', '2016-05-10 04:59:06'),
(20, 'Added an objective: "Development objective 3"', 1, 2, '2016-05-10 04:59:06', '2016-05-10 04:59:06'),
(21, 'Added an objective: "Development objective 3"', 1, 2, '2016-05-10 04:59:06', '2016-05-10 04:59:06'),
(22, 'Added an objective: "Development objective 4"', 1, 2, '2016-05-10 04:59:48', '2016-05-10 04:59:48'),
(23, 'Added an objective: "Sample Staff Objectives 1"', 0, 1, '2016-05-10 05:46:32', '2016-05-10 05:46:32'),
(24, 'Updated a measure: "Development Measures"', 1, 2, '2016-05-10 06:38:50', '2016-05-10 06:38:50'),
(25, 'Updated an Objective: "Sample Staff Objectives 2"', 0, 1, '2016-05-10 06:45:27', '2016-05-10 06:45:27'),
(26, 'Updated an Objective: "updated new staff number v2"', 2, 1, '2016-05-10 07:21:05', '2016-05-10 07:21:05'),
(27, 'Added an objective: "Untouchable"', 1, 2, '2016-05-12 04:42:01', '2016-05-12 04:42:01'),
(28, 'Updated an Objective: "Untouchable"', 1, 2, '2016-05-12 04:42:13', '2016-05-12 04:42:13'),
(29, 'Updated an Objective: "Untouchable"', 1, 2, '2016-05-12 04:42:22', '2016-05-12 04:42:22'),
(30, 'Updated the Objective: "Development objective purpose only version 2" under "Learning and Growth and is contributory to Staff''s: "Develop a fully-responsive and Highly Professional Police Organization" to: "ITMS Objective 1" under "Community"and is contri', 1, 2, '2016-05-17 04:59:56', '2016-05-17 04:59:56'),
(31, 'Updated the Objective: "ITMS Objective 1" under "Learning and Growth and is contributory to Staff''s: "Develop a fully-responsive and Highly Professional Police Organization" to: "ITMS Objective 2" under "Community"and is contributory to Staff''s: "Improve ', 1, 2, '2016-05-17 05:00:05', '2016-05-17 05:00:05'),
(32, 'Updated the Objective: "ITMS Objective 1" under "Learning and Growth and is contributory to Staff''s: "Develop a fully-responsive and Highly Professional Police Organization" to: "ITMS Objective 2" under "Community"', 1, 2, '2016-05-17 05:01:45', '2016-05-17 05:01:45'),
(33, 'Updated the Objective: "ITMS Objective 1" under "Learning and Growth and is contributory to Staff''s: "Develop a fully-responsive and Highly Professional Police Organization" to: "ITMS Objective 3" under "Community"and is contributory to Staff''s: "Improve ', 1, 2, '2016-05-17 05:01:56', '2016-05-17 05:01:56'),
(34, 'Updated the Objective: "ITMS Objective 1" under "Learning and Growth and is contributory to Staff''s: "Develop a fully-responsive and Highly Professional Police Organization" to: "ITMS Objective 4" under "Community"and is contributory to Staff''s: "Improve ', 1, 2, '2016-05-17 05:02:05', '2016-05-17 05:02:05'),
(35, 'Added a measure: "DICTM Summation Measure 1 Non-contributory"', 1, 2, '2016-05-17 05:13:45', '2016-05-17 05:13:45'),
(36, 'Added a measure: "DICTM Summation Measure 2 Contributory"', 1, 2, '2016-05-17 05:14:21', '2016-05-17 05:14:21'),
(37, 'Added a measure: "DICTM Measure 3 Average Contributory"', 1, 2, '2016-05-17 05:14:47', '2016-05-17 05:14:47'),
(38, 'Made an Update to the Measure: "DICTM Summation Measure 1 Non-contributory" under "ITMS Objective 1 with the following: Measure name "DICTM Summation Measure 1 Non-contributory" to "ITMS Summation Measure 1 Non-contributory", ', 1, 2, '2016-05-17 05:15:03', '2016-05-17 05:15:03'),
(39, 'Made an Update to the Measure: "ITMS Summation Measure 1 Non-contributory" under "ITMS Objective 1 with the following: Measure name "ITMS Summation Measure 1 Non-contributory" to "ITMS Summation Measure 2 Contributory", Staff Measure Name to "DICTM Summat', 1, 2, '2016-05-17 05:15:09', '2016-05-17 05:15:09'),
(40, 'Made an Update to the Measure: "ITMS Summation Measure 1 Non-contributory" under "ITMS Objective 1 with the following: Measure name "ITMS Summation Measure 1 Non-contributory" to "ITMS Average Measure 3 Contributory", Measure type "LD" to "LG", Measure Fo', 1, 2, '2016-05-17 05:15:21', '2016-05-17 05:15:21'),
(41, 'Added a measure: "ITMS Summation Measure 1 Non-contributory"', 1, 2, '2016-05-17 05:32:14', '2016-05-17 05:32:14'),
(42, 'Added a measure: "ITMS Summation Measure 2 Contributory"', 1, 2, '2016-05-17 05:32:49', '2016-05-17 05:32:49'),
(43, 'Added a measure: "ITMS Average Measure 3 Contributory"', 1, 2, '2016-05-17 05:33:10', '2016-05-17 05:33:10'),
(44, 'Made an Update to the Measure: "ITMS Summation Measure 1 Non-contributory" under "ITMS Objective 1 with the following: Measure name "ITMS Summation Measure 1 Non-contributory" to "ITMS Summation Measure 2 Contributory", Staff Measure Name to "DICTM Summat', 1, 2, '2016-05-17 05:33:19', '2016-05-17 05:33:19'),
(45, 'Added a measure: "ITMS Summation Measure 1 Non-contributory"', 1, 2, '2016-05-17 05:37:51', '2016-05-17 05:37:51'),
(46, 'Added a measure: "ITMS Summation Measure 2 Contributory"', 1, 2, '2016-05-17 05:38:09', '2016-05-17 05:38:09'),
(47, 'Added a measure: "ITMS Average Measure 3 Contributory"', 1, 2, '2016-05-17 05:38:25', '2016-05-17 05:38:25');

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chief_accomplishments`
--

INSERT INTO `chief_accomplishments` (`ChiefAccomplishmentID`, `JanuaryAccomplishment`, `FebruaryAccomplishment`, `MarchAccomplishment`, `AprilAccomplishment`, `MayAccomplishment`, `JuneAccomplishment`, `JulyAccomplishment`, `AugustAccomplishment`, `SeptemberAccomplishment`, `OctoberAccomplishment`, `NovemberAccomplishment`, `DecemberAccomplishment`, `AccomplishmentDate`, `ChiefMeasureID`, `ChiefID`, `UserChiefID`, `created_at`, `updated_at`) VALUES
(1, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00', 0, 1, 1, '2016-05-17 03:16:26', '2016-05-17 03:16:26'),
(2, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00', 0, 1, 1, '2016-05-17 03:16:50', '2016-05-17 03:16:50'),
(3, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00', 0, 1, 1, '2016-05-17 03:16:50', '2016-05-17 03:16:50'),
(4, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00', 0, 1, 1, '2016-05-17 03:16:51', '2016-05-17 03:16:51'),
(5, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00', 0, 1, 1, '2016-05-17 03:16:51', '2016-05-17 03:16:51'),
(6, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00', 0, 1, 1, '2016-05-17 03:20:34', '2016-05-17 03:20:34'),
(7, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00', 0, 1, 1, '2016-05-17 03:20:45', '2016-05-17 03:20:45'),
(8, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00', 0, 1, 1, '2016-05-17 03:21:31', '2016-05-17 03:21:31'),
(9, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00', 0, 1, 1, '2016-05-17 03:27:39', '2016-05-17 03:27:39'),
(10, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00', 0, 1, 1, '2016-05-17 03:27:53', '2016-05-17 03:27:53'),
(11, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00', 0, 1, 1, '2016-05-17 03:28:41', '2016-05-17 03:28:41');

-- --------------------------------------------------------

--
-- Table structure for table `chief_audit_trails`
--

CREATE TABLE IF NOT EXISTS `chief_audit_trails` (
  `ChiefAuditTrailID` int(10) unsigned NOT NULL,
  `Action` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UserChiefID` int(11) NOT NULL,
  `ChiefID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chief_audit_trails`
--

INSERT INTO `chief_audit_trails` (`ChiefAuditTrailID`, `Action`, `UserChiefID`, `ChiefID`, `created_at`, `updated_at`) VALUES
(1, 'Added a measure: "National Safety Index"', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Added a measure: "Index Crime Solution Efficiency"', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Added a measure: "Index Crime Clearance Efficiency"', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Added a measure: "Percentage of Strategic Initiatives funded from the Annual Operations Plans and Budget (AOPB) based on the GAA provisions"', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Added a measure: "Percentage of funds released in support of Strategic Initiatives"', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Added a measure: "Percentage of funds obligated in support of Strategic Initiatives"', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Updated an Objective: "Improve crime preventions"', 1, 1, '2016-05-06 01:27:08', '2016-05-06 01:27:08'),
(8, 'Updated an Objective: "Optimize use of financial and logistical resource"', 1, 1, '2016-05-06 07:02:42', '2016-05-06 07:02:42'),
(9, 'Updated an Objective: "Optimize use of financial and logistical resource"', 1, 1, '2016-05-06 07:02:48', '2016-05-06 07:02:48'),
(10, 'Added a measure: "National Safety Index"', 1, 1, '2016-05-17 03:14:27', '2016-05-17 03:14:27'),
(11, 'Added a measure: "Index Crime Solution Efficiency"', 1, 1, '2016-05-17 03:14:50', '2016-05-17 03:14:50'),
(12, 'Added a measure: "Index Crime Clearance Efficiency"', 1, 1, '2016-05-17 03:15:03', '2016-05-17 03:15:03'),
(13, 'Added a measure: "Percentage of Strategic Initiatives funded from the Annual Operations Plans and Budget (AOPB) based on the GAA provisions"', 1, 1, '2016-05-17 03:15:20', '2016-05-17 03:15:20'),
(14, 'Added a measure: "Percentage of funds released in support of Strategic Initiatives"', 1, 1, '2016-05-17 03:15:36', '2016-05-17 03:15:36'),
(15, 'Added a measure: "Percentage of funds obligated in support of Strategic Initiatives"', 1, 1, '2016-05-17 03:15:51', '2016-05-17 03:15:51'),
(16, 'Added a measure: "National Safety Index"', 1, 1, '2016-05-17 03:17:54', '2016-05-17 03:17:54'),
(17, 'Added a measure: "Index Crime Solution Efficiency"', 1, 1, '2016-05-17 03:18:09', '2016-05-17 03:18:09'),
(18, 'Added a measure: "Index Crime Clearance Efficiency"', 1, 1, '2016-05-17 03:18:22', '2016-05-17 03:18:22'),
(19, 'Added a measure: "Percentage of Strategic Initiatives funded from the Annual Operations Plans and Budget (AOPB) based on the GAA provisions"', 1, 1, '2016-05-17 03:18:33', '2016-05-17 03:18:33'),
(20, 'Added a measure: "Percentage of Strategic Initiatives funded from the Annual Operations Plans and Budget (AOPB) based on the GAA provisions"', 1, 1, '2016-05-17 03:18:46', '2016-05-17 03:18:46'),
(21, 'Added a measure: "Percentage of funds released in support of Strategic Initiatives"', 1, 1, '2016-05-17 03:18:53', '2016-05-17 03:18:53'),
(22, 'Updated a measure: "Percentage of funds released in support of Strategic Initiatives"', 1, 1, '2016-05-17 03:19:01', '2016-05-17 03:19:01'),
(23, 'Added a measure: "Percentage of funds obligated in support of Strategic Initiatives"', 1, 1, '2016-05-17 03:19:16', '2016-05-17 03:19:16'),
(24, 'Added a measure: "National Safety Index"', 1, 1, '2016-05-17 03:25:05', '2016-05-17 03:25:05'),
(25, 'Added a measure: "Index Crime Solution Efficiency"', 1, 1, '2016-05-17 03:25:18', '2016-05-17 03:25:18'),
(26, 'Added a measure: "Index Crime Clearance Efficiency"', 1, 1, '2016-05-17 03:25:27', '2016-05-17 03:25:27'),
(27, 'Added a measure: "Percentage of Strategic Initiatives funded from the Annual Operations Plans and Budget (AOPB) based on the GAA provisions"', 1, 1, '2016-05-17 03:25:35', '2016-05-17 03:25:35'),
(28, 'Added a measure: "Percentage of funds released in support of Strategic Initiatives"', 1, 1, '2016-05-17 03:25:49', '2016-05-17 03:25:49'),
(29, 'Added a measure: "Percentage of funds obligated in support of Strategic Initiatives"', 1, 1, '2016-05-17 03:26:00', '2016-05-17 03:26:00');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chief_fundings`
--

INSERT INTO `chief_fundings` (`ChiefFundingID`, `ChiefFundingEstimate`, `ChiefFundingActual`, `ChiefFundingDate`, `ChiefMeasureID`, `ChiefID`, `UserChiefID`, `created_at`, `updated_at`) VALUES
(1, 20, 10, '2016-05-17', 6, 1, 1, '2016-05-17 03:27:39', '2016-05-17 03:48:51'),
(2, 30000, 28057, '2016-05-17', 5, 1, 1, '2016-05-17 03:27:54', '2016-05-17 09:14:48'),
(3, 30, 28, '2016-05-17', 4, 1, 1, '2016-05-17 03:28:41', '2016-05-17 03:51:04');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chief_initiatives`
--

INSERT INTO `chief_initiatives` (`ChiefInitiativeID`, `ChiefInitiativeContent`, `ChiefInitiativeDate`, `ChiefMeasureID`, `ChiefID`, `UserChiefID`, `created_at`, `updated_at`) VALUES
(1, 'Chief Initiative 3', '2016-05-17', 6, 1, 1, '2016-05-17 03:27:39', '2016-05-17 03:48:51'),
(2, 'Chief Initiative 2', '2016-05-17', 5, 1, 1, '2016-05-17 03:27:54', '2016-05-17 03:47:45'),
(3, 'Chief Initiative 1', '2016-05-17', 4, 1, 1, '2016-05-17 03:28:41', '2016-05-17 03:36:51');

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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chief_logs`
--

INSERT INTO `chief_logs` (`ChiefLogID`, `ChiefUserID`, `LogDateTime`, `LogType`, `IPAddress`, `created_at`, `updated_at`) VALUES
(1, 1, '2016-05-02 20:37:17', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, '2016-05-03 08:54:21', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 1, '2016-05-03 14:30:28', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 1, '2016-05-06 08:28:17', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 1, '2016-05-06 09:26:56', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 1, '2016-05-06 11:18:22', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 1, '2016-05-06 14:59:57', 'Login', '::1', '2016-05-06 06:59:57', '2016-05-06 06:59:57'),
(8, 1, '2016-05-06 15:21:33', 'Login', '::1', '2016-05-06 07:21:33', '2016-05-06 07:21:33'),
(9, 1, '2016-05-06 15:49:20', 'Login', '::1', '2016-05-06 07:49:20', '2016-05-06 07:49:20'),
(10, 1, '2016-05-10 09:58:26', 'Login', '::1', '2016-05-10 01:58:26', '2016-05-10 01:58:26'),
(11, 1, '2016-05-10 13:44:45', 'Login', '192.168.33.231', '2016-05-10 05:44:45', '2016-05-10 05:44:45'),
(12, 1, '2016-05-11 10:02:20', 'Login', '::1', '2016-05-11 02:02:20', '2016-05-11 02:02:20'),
(13, 1, '2016-05-11 11:10:22', 'Login', '::1', '2016-05-11 03:10:22', '2016-05-11 03:10:22'),
(14, 1, '2016-05-12 09:01:49', 'Login', '::1', '2016-05-12 01:01:49', '2016-05-12 01:01:49'),
(15, 1, '2016-05-13 08:47:30', 'Login', '::1', '2016-05-13 00:47:30', '2016-05-13 00:47:30'),
(16, 1, '2016-05-13 09:03:48', 'Login', '::1', '2016-05-13 01:03:48', '2016-05-13 01:03:48'),
(17, 1, '2016-05-13 10:03:40', 'Login', '::1', '2016-05-13 02:03:40', '2016-05-13 02:03:40'),
(18, 1, '2016-05-16 08:30:37', 'Login', '::1', '2016-05-16 00:30:37', '2016-05-16 00:30:37'),
(19, 1, '2016-05-16 13:18:44', 'Login', '::1', '2016-05-16 05:18:44', '2016-05-16 05:18:44'),
(20, 1, '2016-05-16 13:54:43', 'Login', '::1', '2016-05-16 05:54:43', '2016-05-16 05:54:43'),
(21, 1, '2016-05-16 13:58:00', 'Login', '::1', '2016-05-16 05:58:00', '2016-05-16 05:58:00'),
(22, 1, '2016-05-17 10:06:42', 'Login', '::1', '2016-05-17 02:06:42', '2016-05-17 02:06:42'),
(23, 1, '2016-05-17 14:38:19', 'Login', '::1', '2016-05-17 06:38:19', '2016-05-17 06:38:19'),
(24, 1, '2016-05-17 15:05:38', 'Login', '::1', '2016-05-17 07:05:38', '2016-05-17 07:05:38'),
(25, 1, '2016-05-17 18:48:09', 'Login', '::1', '2016-05-17 10:48:09', '2016-05-17 10:48:09'),
(26, 1, '2016-05-17 20:04:51', 'Login', '::1', '2016-05-17 12:04:51', '2016-05-17 12:04:51'),
(27, 1, '2016-05-17 21:36:43', 'Login', '::1', '2016-05-17 13:36:43', '2016-05-17 13:36:43');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chief_measures`
--

INSERT INTO `chief_measures` (`ChiefMeasureID`, `ChiefMeasureName`, `ChiefMeasureType`, `ChiefMeasureFormula`, `ChiefObjectiveID`, `ChiefID`, `UserChiefID`, `created_at`, `updated_at`) VALUES
(1, 'National Safety Index', 'LG', 'Summation', 1, 1, 1, '2016-05-17 03:25:06', '2016-05-17 03:25:06'),
(2, 'Index Crime Solution Efficiency', 'LG', 'Average', 3, 1, 1, '2016-05-17 03:25:18', '2016-05-17 03:25:18'),
(3, 'Index Crime Clearance Efficiency', 'LG', 'Average', 3, 1, 1, '2016-05-17 03:25:27', '2016-05-17 03:25:27'),
(4, 'Percentage of Strategic Initiatives funded from the Annual Operations Plans and Budget (AOPB) based on the GAA provisions', 'LG', 'Average', 7, 1, 1, '2016-05-17 03:25:36', '2016-05-17 03:25:36'),
(5, 'Percentage of funds released in support of Strategic Initiatives', 'LD', 'Average', 7, 1, 1, '2016-05-17 03:25:49', '2016-05-17 03:25:49'),
(6, 'Percentage of funds obligated in support of Strategic Initiatives', 'LG', 'Average', 7, 1, 1, '2016-05-17 03:26:00', '2016-05-17 03:26:00');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chief_objectives`
--

INSERT INTO `chief_objectives` (`ChiefObjectiveID`, `ChiefObjectiveName`, `PerspectiveID`, `UserChiefID`, `ChiefID`, `created_at`, `updated_at`) VALUES
(1, 'A safer place to live, work and do business', 1, 1, 1, '2016-05-02 06:02:05', '2016-05-02 06:02:05'),
(2, 'Improve crime preventions', 3, 1, 1, '2016-05-02 06:02:57', '2016-05-06 01:27:08'),
(3, 'Improve crime solution', 3, 1, 1, '2016-05-02 06:03:10', '2016-05-02 06:03:10'),
(4, 'Improve community safety awareness through community-oriented and human rights-based policing', 3, 1, 1, '2016-05-02 06:03:41', '2016-05-02 06:03:41'),
(5, 'Develop Competent, Motivated, Values-oriented and Disciplined police personnel', 2, 1, 1, '2016-05-02 06:05:11', '2016-05-02 06:05:11'),
(6, 'Develop a responsive and Highly Professional Police Organization', 2, 1, 1, '2016-05-02 06:06:10', '2016-05-02 06:06:10'),
(7, 'Optimize use of financial and logistical resource', 4, 1, 1, '2016-05-02 06:06:29', '2016-05-06 07:02:47');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chief_owners`
--

INSERT INTO `chief_owners` (`ChiefOwnerID`, `ChiefOwnerContent`, `ChiefOwnerDate`, `ChiefMeasureID`, `ChiefID`, `UserChiefID`, `created_at`, `updated_at`) VALUES
(1, 'Chief Owner 3', '2016-05-17', 6, 1, 1, '2016-05-17 03:27:39', '2016-05-17 03:48:51'),
(2, 'Chief Owner 2', '2016-05-17', 5, 1, 1, '2016-05-17 03:27:54', '2016-05-17 03:47:45'),
(3, 'Chief Owner 1', '2016-05-17', 4, 1, 1, '2016-05-17 03:28:41', '2016-05-17 09:13:49');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chief_targets`
--

INSERT INTO `chief_targets` (`ChiefTargetID`, `JanuaryTarget`, `FebruaryTarget`, `MarchTarget`, `AprilTarget`, `MayTarget`, `JuneTarget`, `JulyTarget`, `AugustTarget`, `SeptemberTarget`, `OctoberTarget`, `NovemberTarget`, `DecemberTarget`, `TargetDate`, `Termination`, `TargetPeriod`, `ChiefMeasureID`, `ChiefAccomplishmentID`, `ChiefOwnerID`, `ChiefInitiativeID`, `ChiefFundingID`, `ChiefID`, `UserChiefID`, `created_at`, `updated_at`) VALUES
(1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00', NULL, 'Not Set', 1, 0, 0, 0, 0, 1, 1, '2016-05-17 03:25:06', '2016-05-17 03:25:06'),
(2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00', NULL, 'Not Set', 2, 0, 0, 0, 0, 1, 1, '2016-05-17 03:25:18', '2016-05-17 03:25:18'),
(3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00', NULL, 'Not Set', 3, 0, 0, 0, 0, 1, 1, '2016-05-17 03:25:27', '2016-05-17 03:25:27'),
(4, 1.2, 2.2, 3.2, 4.3, 5.3, 6.3, 7.3, 8.3, 9.3, 10.4, 11.4, 12.4, '2016-05-17', NULL, 'Monthly', 4, 11, 3, 3, 3, 1, 1, '2016-05-17 03:25:36', '2016-05-17 03:28:41'),
(5, 10, 10, 10, 16.6667, 16.6667, 16.6667, 23.3333, 23.3333, 23.3333, 30, 30, 30, '2016-05-17', NULL, 'Quarterly', 5, 10, 2, 2, 2, 1, 1, '2016-05-17 03:25:49', '2016-05-17 03:27:54'),
(6, 6.66667, 6.66667, 6.66667, 13.3333, 13.3333, 13.3333, 20, 20, 20, 26.6667, 26.6667, 26.6667, '2016-05-17', NULL, 'Quarterly', 6, 9, 1, 1, 1, 1, 1, '2016-05-17 03:26:00', '2016-05-17 03:27:39');

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
('2016_05_11_094351_create_unit_fundings_table', 17);

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `staffs`
--

INSERT INTO `staffs` (`StaffID`, `StaffName`, `StaffAbbreviation`, `StaffPermission`, `UserStaffID`, `PicturePath`, `ChiefID`, `created_at`, `updated_at`) VALUES
(1, 'Directorial for Information and Communication Technology Management', 'DICTM', 'none', 1, 'wtHDmDaW3wF7JzDy0zKZwZfxlnUWPVI0.jpeg', 1, '0000-00-00 00:00:00', '2016-05-02 06:31:50'),
(2, 'Center for Police Strategy Management', 'CPSM', '', 3, 'wO3AXldVfjOlQBJlZhpUqSchPfrzLFTX.png', 1, '2016-05-02 06:20:52', '2016-05-02 06:32:17');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `staff_accomplishments`
--

INSERT INTO `staff_accomplishments` (`StaffAccomplishmentID`, `JanuaryAccomplishment`, `FebruaryAccomplishment`, `MarchAccomplishment`, `AprilAccomplishment`, `MayAccomplishment`, `JuneAccomplishment`, `JulyAccomplishment`, `AugustAccomplishment`, `SeptemberAccomplishment`, `OctoberAccomplishment`, `NovemberAccomplishment`, `DecemberAccomplishment`, `AccomplishmentDate`, `StaffMeasureID`, `StaffID`, `UserStaffID`, `created_at`, `updated_at`) VALUES
(1, 3.31, 3.36, 3.00, 4.00, 0.00, 1.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2016-05-17', 1, 1, 1, '2016-05-17 03:59:02', '2016-05-17 11:58:26'),
(2, 0.20, 0.30, 0.40, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2016-05-17', 0, 1, 1, '2016-05-17 03:59:59', '2016-05-17 04:53:21'),
(3, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00', 0, 1, 1, '2016-05-17 04:00:33', '2016-05-17 04:00:33'),
(4, 6.00, 6.30, 6.50, 10.00, 11.00, 12.00, 19.00, 20.00, 21.00, 25.00, 24.49, 26.00, '2016-05-17', 4, 2, 3, '2016-05-17 12:05:52', '2016-05-17 12:06:40');

-- --------------------------------------------------------

--
-- Table structure for table `staff_audit_trails`
--

CREATE TABLE IF NOT EXISTS `staff_audit_trails` (
  `StaffAuditTrailID` int(10) unsigned NOT NULL,
  `Action` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `StaffID` int(11) NOT NULL,
  `UserStaffID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `staff_audit_trails`
--

INSERT INTO `staff_audit_trails` (`StaffAuditTrailID`, `Action`, `StaffID`, `UserStaffID`, `created_at`, `updated_at`) VALUES
(1, 'Added an objective: "Develop a fully-responsive and Highly Professional Police Organization"', 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Added an objective: "Sample Staff Objectives 1"', 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Updated an Objective: "Sample Staff Objectives 2"', 1, 0, '2016-05-10 06:45:27', '2016-05-10 06:45:27'),
(4, 'Added an objective: "sample objective 3"', 1, 0, '2016-05-10 06:49:40', '2016-05-10 06:49:40'),
(5, 'Added an objective: "sample objective 4"', 0, 1, '2016-05-10 06:51:33', '2016-05-10 06:51:33'),
(6, 'Added an objective: "sample objective 5"', 2, 1, '2016-05-10 06:52:22', '2016-05-10 06:52:22'),
(7, 'Updated an Objective: "sample objective 4.1"', 2, 1, '2016-05-10 06:56:40', '2016-05-10 06:56:40'),
(8, 'Added an objective: "added new staff number 1"', 2, 1, '2016-05-10 07:20:29', '2016-05-10 07:20:29'),
(9, 'Updated an Objective: "updated new staff number v2"', 2, 1, '2016-05-10 07:21:05', '2016-05-10 07:21:05'),
(10, 'Updated the Objective: "Improve DICTM Crime Solution" under "Process Excellence and is contributory to Chief''s: "Improve crime preventions" to: "sample objective 4.1" under "Community"', 1, 1, '2016-05-13 01:36:31', '2016-05-13 01:36:31'),
(11, 'Made an Update to the Measure: "Sample Measure for Development 1" under "Develop a fully-responsive and Highly Professional Police Organization and is contributory to Chief''s Measure: Percentage of Strategic Initiatives funded from the Annual Operations P', 1, 1, '2016-05-13 01:47:19', '2016-05-13 01:47:19'),
(12, 'Updated the Objective: "Improve DICTM Crime Solution" under "Process Excellence and is contributory to Chief''s: "Improve crime preventions" to: "Improve DICTM IT Solutions" under "Community"', 1, 1, '2016-05-16 01:14:46', '2016-05-16 01:14:46'),
(13, 'Updated the Objective: "Improve DICTM IT Solutions" under "Process Excellenceto: "Sample DICTM Objectives 2" under "Community"and is contributory to Chief''s: "A safer place to live, work and do business" ', 1, 1, '2016-05-16 01:15:06', '2016-05-16 01:15:06'),
(14, 'Updated the Objective: "Improve DICTM IT Solutions" under "Process Excellenceto: "Sample Objective 3" under "Community"', 1, 1, '2016-05-16 01:16:22', '2016-05-16 01:16:22'),
(15, 'Updated the Objective: "Improve DICTM IT Solutions" under "Process Excellenceto: "Sample Objective 4" under "Community"', 1, 1, '2016-05-16 01:16:40', '2016-05-16 01:16:40'),
(16, 'Updated the Objective: "Improve DICTM IT Solutions" under "Process Excellenceto: "Sample DICTM Objective 5" under "Community"and is contributory to Chief''s: "A safer place to live, work and do business" ', 1, 1, '2016-05-16 01:16:57', '2016-05-16 01:16:57'),
(17, 'Made an Update to the Measure: "DICTM Measure 1" under "Sample Objective 4 and is contributory to Chief''s Measure: Percentage of funds released in support of Strategic Initiatives  with the following: Measure name "DICTM Measure 1" to "DICTM Measure 1 Con', 1, 1, '2016-05-16 01:23:02', '2016-05-16 01:23:02'),
(18, 'Made an Update to the Measure: "DICTM Measure 1 Contributory" under "Sample Objective 4 and is contributory to Chief''s Measure: Percentage of funds released in support of Strategic Initiatives  with the following: Measure name "DICTM Measure 1 Contributor', 1, 1, '2016-05-16 01:23:17', '2016-05-16 01:23:17'),
(19, 'Updated the Objective: "Improve DICTM IT Solutions" under "Process Excellenceto: "CPSM Objective 1 Non-contributory" under "Community"', 2, 3, '2016-05-17 12:04:02', '2016-05-17 12:04:02'),
(20, 'Added an objective: "CPSM Objective 2 Contributory"', 2, 3, '2016-05-17 12:04:31', '2016-05-17 12:04:31');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `staff_fundings`
--

INSERT INTO `staff_fundings` (`StaffFundingID`, `StaffFundingEstimate`, `StaffFundingActual`, `StaffFundingDate`, `StaffMeasureID`, `StaffID`, `UserStaffID`, `created_at`, `updated_at`) VALUES
(1, 0, 0, '2016-05-17', 1, 1, 1, '2016-05-17 03:59:03', '2016-05-17 04:43:53'),
(2, 1.2, 2.3, '2016-05-17', 2, 1, 1, '2016-05-17 03:59:59', '2016-05-17 04:38:59'),
(3, 0, 0, '0000-00-00', 0, 1, 1, '2016-05-17 04:00:33', '2016-05-17 04:00:33'),
(4, 2000, 2012, '2016-05-17', 4, 2, 3, '2016-05-17 12:05:52', '2016-05-17 12:06:40');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `staff_initiatives`
--

INSERT INTO `staff_initiatives` (`StaffInitiativeID`, `StaffInitiativeContent`, `StaffInitiativeDate`, `StaffMeasureID`, `StaffID`, `UserStaffID`, `created_at`, `updated_at`) VALUES
(1, 'DICTM Initiative 1', '2016-05-17', 1, 1, 1, '2016-05-17 03:59:02', '2016-05-17 11:16:24'),
(2, 'DICTM Initiative 2', '2016-05-17', 2, 1, 1, '2016-05-17 03:59:59', '2016-05-17 04:38:59'),
(3, '', '0000-00-00', 0, 1, 1, '2016-05-17 04:00:33', '2016-05-17 04:00:33'),
(4, 'CPSM Initiative 1', '2016-05-17', 4, 2, 3, '2016-05-17 12:05:52', '2016-05-17 12:06:40');

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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `staff_logs`
--

INSERT INTO `staff_logs` (`StaffLogID`, `StaffUserID`, `LogDateTime`, `LogType`, `IPAddress`, `created_at`, `updated_at`) VALUES
(1, 1, '2016-05-03 14:04:15', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, '2016-05-06 09:49:24', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 1, '2016-05-06 09:52:22', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 1, '2016-05-06 15:10:54', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 1, '2016-05-06 15:42:20', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 1, '2016-05-06 16:13:36', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 2, '2016-05-10 13:38:39', 'Login', '127.0.0.1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 2, '2016-05-12 11:53:14', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 1, '2016-05-13 09:35:29', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 1, '2016-05-13 09:39:33', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 1, '2016-05-13 09:50:55', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 1, '2016-05-16 09:12:09', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 2, '2016-05-16 10:46:08', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 2, '2016-05-16 10:47:36', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 1, '2016-05-16 11:00:25', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 2, '2016-05-16 11:02:42', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 2, '2016-05-16 13:33:51', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 2, '2016-05-16 13:55:27', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 2, '2016-05-16 14:32:39', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 1, '2016-05-17 11:54:56', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 1, '2016-05-17 15:04:51', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 1, '2016-05-17 18:36:21', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 1, '2016-05-17 18:45:39', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 1, '2016-05-17 18:46:37', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 1, '2016-05-17 19:15:37', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 1, '2016-05-17 19:58:14', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 3, '2016-05-17 20:03:41', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 2, '2016-05-17 21:05:22', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 2, '2016-05-17 21:06:00', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 1, '2016-05-17 22:42:58', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `staff_measures`
--

INSERT INTO `staff_measures` (`StaffMeasureID`, `StaffMeasureName`, `StaffMeasureType`, `StaffMeasureFormula`, `StaffObjectiveID`, `ChiefMeasureID`, `StaffID`, `UserStaffID`, `created_at`, `updated_at`) VALUES
(1, 'DICTM Summation 1 Contributory', 'LG', 'Summation', 1, 5, 1, 1, '2016-05-17 03:57:45', '2016-05-17 03:57:45'),
(2, 'DICTM Summation 2 Non-contributory', 'LD', 'Summation', 1, 0, 1, 1, '2016-05-17 03:58:12', '2016-05-17 03:58:12'),
(3, 'DICTM Average 3 Contributory', 'LD', 'Average', 3, 2, 1, 1, '2016-05-17 03:58:34', '2016-05-17 03:58:34'),
(4, 'CPSM Staff Measure 1 Contributory', 'LD', 'Summation', 8, 5, 2, 3, '2016-05-17 12:05:38', '2016-05-17 12:05:38');

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `staff_objectives`
--

INSERT INTO `staff_objectives` (`StaffObjectiveID`, `StaffObjectiveName`, `PerspectiveID`, `StaffID`, `UserStaffID`, `ChiefObjectiveID`, `created_at`, `updated_at`) VALUES
(1, 'Improve DICTM IT Solutions', 3, 1, 1, 0, '2016-05-02 07:13:28', '2016-05-16 01:14:47'),
(2, 'Develop a fully-responsive and Highly Professional Police Organization', 2, 1, 1, 6, '2016-05-06 08:16:04', '2016-05-06 08:16:04'),
(3, 'Sample DICTM Objectives 2', 3, 1, 1, 1, '2016-05-10 05:46:33', '2016-05-16 01:15:06'),
(4, 'Sample Objective 4', 1, 1, 1, 0, '2016-05-10 06:49:40', '2016-05-16 01:16:40'),
(5, 'Sample Objective 3', 3, 1, 1, 0, '2016-05-10 06:51:34', '2016-05-16 01:16:23'),
(6, 'Sample DICTM Objective 5', 4, 1, 1, 4, '2016-05-10 06:52:23', '2016-05-16 01:16:57'),
(7, 'CPSM Objective 1 Non-contributory', 4, 2, 3, 0, '2016-05-10 07:20:29', '2016-05-17 12:04:02'),
(8, 'CPSM Objective 2 Contributory', 1, 2, 3, 1, '2016-05-17 12:04:31', '2016-05-17 12:04:31');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `staff_owners`
--

INSERT INTO `staff_owners` (`StaffOwnerID`, `StaffOwnerContent`, `StaffOwnerDate`, `StaffMeasureID`, `StaffID`, `UserStaffID`, `created_at`, `updated_at`) VALUES
(1, 'DICTM Owner 1', '2016-05-17', 1, 1, 1, '2016-05-17 03:59:02', '2016-05-17 11:16:24'),
(2, 'DICTM Owner 2', '2016-05-17', 2, 1, 1, '2016-05-17 03:59:59', '2016-05-17 04:38:59'),
(3, '', '0000-00-00', 0, 1, 1, '2016-05-17 04:00:33', '2016-05-17 04:00:33'),
(4, 'CPSM Owner 1', '2016-05-17', 4, 2, 3, '2016-05-17 12:05:52', '2016-05-17 12:06:40');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `staff_targets`
--

INSERT INTO `staff_targets` (`StaffTargetID`, `JanuaryTarget`, `FebruaryTarget`, `MarchTarget`, `AprilTarget`, `MayTarget`, `JuneTarget`, `JulyTarget`, `AugustTarget`, `SeptemberTarget`, `OctoberTarget`, `NovemberTarget`, `DecemberTarget`, `TargetDate`, `TargetPeriod`, `Termination`, `StaffMeasureID`, `StaffAccomplishmentID`, `StaffOwnerID`, `StaffInitiativeID`, `StaffFundingID`, `StaffID`, `UserStaffID`, `created_at`, `updated_at`) VALUES
(1, 3.37, 3.37, 3.37, 6.73, 6.73, 6.73, 10.10, 10.10, 10.10, 13.47, 13.47, 13.47, '2016-05-17', 'Quarterly', NULL, 1, 1, 1, 1, 1, 1, 1, '2016-05-17 03:57:45', '2016-05-17 03:59:03'),
(2, 1.00, 2.00, 3.00, 4.00, 5.00, 6.00, 7.00, 8.00, 9.00, 10.00, 11.00, 12.00, '2016-05-17', 'Monthly', NULL, 2, 2, 2, 2, 2, 1, 1, '2016-05-17 03:58:12', '2016-05-17 03:59:59'),
(3, 1.10, 1.20, 1.30, 1.40, 1.50, 1.60, 1.70, 1.80, 1.90, 2.00, 2.10, 2.10, '2016-05-17', 'Monthly', NULL, 3, 3, 3, 3, 3, 1, 1, '2016-05-17 03:58:34', '2016-05-17 04:00:33'),
(4, 6.67, 6.67, 6.67, 13.33, 13.33, 13.33, 20.00, 20.00, 20.00, 26.67, 26.67, 26.67, '2016-05-17', 'Quarterly', NULL, 4, 4, 4, 4, 4, 2, 3, '2016-05-17 12:05:38', '2016-05-17 12:05:53');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE IF NOT EXISTS `units` (
  `UnitID` int(10) unsigned NOT NULL,
  `UnitName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UnitAbbreviation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `PicturePath` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `StaffID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`UnitID`, `UnitName`, `UnitAbbreviation`, `PicturePath`, `StaffID`, `created_at`, `updated_at`) VALUES
(2, 'Information Technology Management Service', 'ITMS', 'QDVGLkNEPJwqrJ2am7PaXwYQhdnD2rCN.jpg', 1, '2016-05-02 06:15:06', '2016-05-10 09:58:31');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `unit_accomplishments`
--

INSERT INTO `unit_accomplishments` (`UnitAccomplishmentID`, `JanuaryAccomplishment`, `FebruaryAccomplishment`, `MarchAccomplishment`, `AprilAccomplishment`, `MayAccomplishment`, `JuneAccomplishment`, `JulyAccomplishment`, `AugustAccomplishment`, `SeptemberAccomplishment`, `OctoberAccomplishment`, `NovemberAccomplishment`, `DecemberAccomplishment`, `AccomplishmentDate`, `UnitMeasureID`, `UnitID`, `UserUnitID`, `created_at`, `updated_at`) VALUES
(1, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00', 0, 2, 1, '2016-05-17 05:38:37', '2016-05-17 05:38:37'),
(2, 3.00, 4.00, 5.00, 10.00, 9.50, 10.00, 17.18, 0.00, 0.00, 1.00, 0.00, 0.00, '2016-05-17', 2, 2, 1, '2016-05-17 05:39:23', '2016-05-17 14:42:24'),
(3, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00', 0, 2, 1, '2016-05-17 05:39:53', '2016-05-17 05:39:53');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `unit_fundings`
--

INSERT INTO `unit_fundings` (`UnitFundingID`, `UnitFundingEstimate`, `UnitFundingActual`, `UnitFundingDate`, `UnitMeasureID`, `UnitID`, `UserUnitID`, `created_at`, `updated_at`) VALUES
(1, '', '', '0000-00-00', 0, 2, 1, '2016-05-17 05:38:37', '2016-05-17 05:38:37'),
(2, '1', '2', '2016-05-17', 2, 2, 1, '2016-05-17 05:39:23', '2016-05-17 06:16:43'),
(3, '', '', '0000-00-00', 0, 2, 1, '2016-05-17 05:39:53', '2016-05-17 05:39:53');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `unit_initiatives`
--

INSERT INTO `unit_initiatives` (`UnitInitiativeID`, `UnitInitiativeContent`, `UnitInitiativeDate`, `UnitMeasureID`, `UnitID`, `UserUnitID`, `created_at`, `updated_at`) VALUES
(1, '', '0000-00-00', 0, 2, 1, '2016-05-17 05:38:37', '2016-05-17 05:38:37'),
(2, 'Unit Initiative 2', '2016-05-17', 2, 2, 1, '2016-05-17 05:39:23', '2016-05-17 06:16:43'),
(3, '', '0000-00-00', 0, 2, 1, '2016-05-17 05:39:53', '2016-05-17 05:39:53');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `unit_measures`
--

INSERT INTO `unit_measures` (`UnitMeasureID`, `UnitMeasureName`, `UnitMeasureType`, `UnitMeasureFormula`, `UnitObjectiveID`, `StaffMeasureID`, `UnitID`, `UserUnitID`, `created_at`, `updated_at`) VALUES
(1, 'ITMS Summation Measure 1 Non-contributory', 'LD', 'Summation', 2, 0, 2, 1, '2016-05-17 05:37:51', '2016-05-17 05:37:51'),
(2, 'ITMS Summation Measure 2 Contributory', 'LD', 'Summation', 2, 1, 2, 1, '2016-05-17 05:38:09', '2016-05-17 05:38:09'),
(3, 'ITMS Average Measure 3 Contributory', 'LG', 'Average', 10, 3, 2, 1, '2016-05-17 05:38:25', '2016-05-17 05:38:25');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `unit_objectives`
--

INSERT INTO `unit_objectives` (`UnitObjectiveID`, `UnitObjectiveName`, `PerspectiveID`, `StaffObjectiveID`, `UnitID`, `UserUnitID`, `created_at`, `updated_at`) VALUES
(2, 'ITMS Objective 1', 2, 2, 2, 1, '2016-05-10 03:21:48', '2016-05-17 04:59:56'),
(3, 'ITMS Objective 3', 4, 1, 2, 1, '2016-05-10 03:35:52', '2016-05-17 05:01:56'),
(9, 'ITMS Objective 4', 3, 2, 2, 1, '2016-05-10 04:59:48', '2016-05-17 05:02:05'),
(10, 'ITMS Objective 2', 2, 0, 2, 1, '2016-05-12 04:42:01', '2016-05-17 05:01:45');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `unit_owners`
--

INSERT INTO `unit_owners` (`UnitOwnerID`, `UnitOwnerContent`, `UnitOwnerDate`, `UnitMeasureID`, `UnitID`, `UserUnitID`, `created_at`, `updated_at`) VALUES
(1, '', '0000-00-00', 0, 2, 1, '2016-05-17 05:38:37', '2016-05-17 05:38:37'),
(2, 'Unit Owner 2', '2016-05-17', 2, 2, 1, '2016-05-17 05:39:23', '2016-05-17 06:16:42'),
(3, '', '0000-00-00', 0, 2, 1, '2016-05-17 05:39:53', '2016-05-17 05:39:53');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `unit_targets`
--

INSERT INTO `unit_targets` (`UnitTargetID`, `JanuaryTarget`, `FebruaryTarget`, `MarchTarget`, `AprilTarget`, `MayTarget`, `JuneTarget`, `JulyTarget`, `AugustTarget`, `SeptemberTarget`, `OctoberTarget`, `NovemberTarget`, `DecemberTarget`, `TargetDate`, `TargetPeriod`, `Termination`, `UnitAccomplishmentID`, `UnitOwnerID`, `UnitInitiativeID`, `UnitFundingID`, `UnitMeasureID`, `UnitID`, `UserUnitID`, `created_at`, `updated_at`) VALUES
(1, 6.67, 6.67, 6.67, 10.00, 10.00, 10.00, 13.33, 13.33, 13.33, 16.67, 16.67, 16.67, '2016-05-17', 'Quarterly', NULL, 1, 1, 1, 1, 1, 2, 1, '2016-05-17 05:37:51', '2016-05-17 05:38:37'),
(2, 3.20, 4.10, 5.00, 9.00, 10.00, 11.00, 20.00, 21.00, 23.00, 30.00, 35.00, 37.00, '2016-05-17', 'Monthly', NULL, 2, 2, 2, 2, 2, 2, 1, '2016-05-17 05:38:09', '2016-05-17 05:39:24'),
(3, 33.33, 33.33, 33.33, 49.00, 49.00, 49.00, 53.33, 53.33, 53.33, 66.00, 66.00, 66.00, '2016-05-17', 'Quarterly', NULL, 3, 3, 3, 3, 3, 2, 1, '2016-05-17 05:38:25', '2016-05-17 05:39:53');

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
(1, 'Super Administrator', 'usc@cpsm.pnp.gov.ph', '$2y$10$zSC2JGHGr7/A4HbZI/S2mOj4gY6bXd2HkR9sf8YXkojtX4snxTjp2', 'nYxKETT7CxqxMRXYrNp6qXznynVJq7mMJvWZaZqb9iIOdqYrrdPXctMevYR5', '2016-03-13 05:42:04', '2016-05-06 07:29:13');

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
(1, 'O-00000', 'Chief', '', 'PNP', '', '', 'chiefpnp', 1, 1, 1, '2016-04-29 00:54:46', '2016-05-06 07:29:08');

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
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_logs`
--

INSERT INTO `user_logs` (`UserLogID`, `UnitUserID`, `LogDateTime`, `LogType`, `IPAddress`, `created_at`, `updated_at`) VALUES
(1, 1, '2016-05-02 14:57:02', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, '2016-05-02 14:57:17', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 0, '2016-05-02 15:08:16', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 2, '2016-05-02 15:09:36', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 0, '2016-05-02 15:20:49', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 1, '2016-05-02 15:21:34', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 1, '2016-05-02 15:34:16', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 0, '2016-05-03 12:49:02', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 1, '2016-05-03 12:49:22', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 1, '2016-05-03 14:04:05', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 0, '2016-05-03 14:04:28', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 0, '2016-05-03 14:32:13', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 0, '2016-05-06 08:51:08', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 0, '2016-05-06 09:46:54', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 0, '2016-05-06 09:49:31', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 0, '2016-05-06 10:01:09', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 1, '2016-05-06 10:03:27', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 1, '2016-05-06 11:18:10', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 0, '2016-05-06 14:03:50', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 0, '2016-05-06 15:10:27', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 0, '2016-05-06 15:21:24', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 0, '2016-05-06 15:47:01', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 1, '2016-05-06 15:47:09', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 1, '2016-05-06 15:49:10', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 0, '2016-05-10 10:28:27', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 1, '2016-05-10 10:28:55', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 1, '2016-05-10 13:04:40', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 0, '2016-05-11 11:25:58', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 0, '2016-05-12 11:52:56', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 0, '2016-05-12 11:53:41', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 1, '2016-05-12 11:54:37', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 0, '2016-05-12 13:47:32', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 0, '2016-05-13 09:03:38', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 0, '2016-05-13 09:34:38', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 0, '2016-05-13 09:51:29', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 1, '2016-05-13 09:51:40', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 0, '2016-05-16 09:11:57', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 0, '2016-05-16 11:00:08', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 0, '2016-05-16 11:02:22', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 0, '2016-05-16 13:18:32', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 0, '2016-05-16 13:33:41', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 0, '2016-05-16 13:54:28', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 0, '2016-05-16 13:55:10', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 0, '2016-05-16 13:57:51', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 0, '2016-05-16 14:32:31', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 0, '2016-05-17 11:54:46', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 0, '2016-05-17 12:59:04', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 1, '2016-05-17 12:59:14', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 0, '2016-05-17 15:04:44', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 0, '2016-05-17 15:05:29', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 0, '2016-05-17 18:39:54', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(52, 0, '2016-05-17 18:46:29', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(53, 0, '2016-05-17 18:47:58', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(54, 0, '2016-05-17 20:03:04', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(55, 0, '2016-05-17 20:04:45', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(56, 0, '2016-05-17 21:04:08', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(57, 1, '2016-05-17 21:04:15', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(58, 1, '2016-05-17 21:05:01', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(59, 0, '2016-05-17 21:05:48', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(60, 0, '2016-05-17 21:05:51', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(61, 1, '2016-05-17 21:06:11', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(62, 1, '2016-05-17 21:36:37', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(63, 1, '2016-05-17 22:41:06', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(64, 1, '2016-05-17 22:42:50', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(65, 0, '2016-05-17 22:49:32', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(66, 1, '2016-05-17 22:49:40', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(67, 1, '2016-05-17 22:52:35', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_staffs`
--

INSERT INTO `user_staffs` (`UserStaffID`, `UserStaffBadgeNumber`, `UserStaffFirstName`, `UserStaffMiddleName`, `UserStaffLastName`, `UserStaffQualifier`, `UserStaffPicturePath`, `UserStaffPassword`, `RankID`, `StaffID`, `UserStaffIsActive`, `created_at`, `updated_at`) VALUES
(1, 'S-12345', 'Jose', 'J.', 'Alvarez', '', 'ridzKRbfOAEJpU0uJ9CAqs0rxwfgZH8v.jpg', 'anton123', 10, 1, 1, '0000-00-00 00:00:00', '2016-05-06 01:51:38'),
(2, 'S-12346', 'Lorenzo', 'Malasig', 'Viovicente', '', 'npddunnpRv13rPYyaozfaTCrFaNuyRbY.jpg', 'lorenzo', 18, 1, 1, '2016-05-02 06:30:20', '2016-05-06 01:51:56'),
(3, 'S-12347', 'Pablo', '', 'Cantoria', '', 'neg4EMfTJAnuQBpRS7oWfVnN7Y70upI6.jpg', 'pablo123', 10, 2, 1, '2016-05-02 06:35:28', '2016-05-02 06:35:28');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_units`
--

INSERT INTO `user_units` (`UserUnitID`, `UserUnitBadgeNumber`, `UserUnitFirstName`, `UserUnitMiddleName`, `UserUnitLastName`, `UserUnitQualifier`, `UserUnitPicturePath`, `UserUnitPassword`, `RankID`, `UnitID`, `UserUnitIsActive`, `created_at`, `updated_at`) VALUES
(1, 'U-12345', 'Rock Well', '', 'Ramos', '', 'XEGpUuVo6IGUZou3mzlyPTynrJM4XUti.jpg', 'isha123', 10, 2, 1, '2016-05-02 06:34:37', '2016-05-06 02:02:49');

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
-- Indexes for table `user_staffs`
--
ALTER TABLE `user_staffs`
  ADD PRIMARY KEY (`UserStaffID`),
  ADD UNIQUE KEY `user_staffs_userstaffbadgenumber_unique` (`UserStaffBadgeNumber`);

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
  MODIFY `AuditTrailID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `chiefs`
--
ALTER TABLE `chiefs`
  MODIFY `ChiefID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `chief_accomplishments`
--
ALTER TABLE `chief_accomplishments`
  MODIFY `ChiefAccomplishmentID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `chief_audit_trails`
--
ALTER TABLE `chief_audit_trails`
  MODIFY `ChiefAuditTrailID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `chief_fundings`
--
ALTER TABLE `chief_fundings`
  MODIFY `ChiefFundingID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `chief_initiatives`
--
ALTER TABLE `chief_initiatives`
  MODIFY `ChiefInitiativeID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `chief_logs`
--
ALTER TABLE `chief_logs`
  MODIFY `ChiefLogID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `chief_measures`
--
ALTER TABLE `chief_measures`
  MODIFY `ChiefMeasureID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `chief_objectives`
--
ALTER TABLE `chief_objectives`
  MODIFY `ChiefObjectiveID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `chief_owners`
--
ALTER TABLE `chief_owners`
  MODIFY `ChiefOwnerID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `chief_targets`
--
ALTER TABLE `chief_targets`
  MODIFY `ChiefTargetID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
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
-- AUTO_INCREMENT for table `staffs`
--
ALTER TABLE `staffs`
  MODIFY `StaffID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `staff_accomplishments`
--
ALTER TABLE `staff_accomplishments`
  MODIFY `StaffAccomplishmentID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `staff_audit_trails`
--
ALTER TABLE `staff_audit_trails`
  MODIFY `StaffAuditTrailID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `staff_fundings`
--
ALTER TABLE `staff_fundings`
  MODIFY `StaffFundingID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `staff_initiatives`
--
ALTER TABLE `staff_initiatives`
  MODIFY `StaffInitiativeID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `staff_logs`
--
ALTER TABLE `staff_logs`
  MODIFY `StaffLogID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `staff_measures`
--
ALTER TABLE `staff_measures`
  MODIFY `StaffMeasureID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `staff_objectives`
--
ALTER TABLE `staff_objectives`
  MODIFY `StaffObjectiveID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `staff_owners`
--
ALTER TABLE `staff_owners`
  MODIFY `StaffOwnerID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `staff_targets`
--
ALTER TABLE `staff_targets`
  MODIFY `StaffTargetID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `UnitID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `unit_accomplishments`
--
ALTER TABLE `unit_accomplishments`
  MODIFY `UnitAccomplishmentID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `unit_fundings`
--
ALTER TABLE `unit_fundings`
  MODIFY `UnitFundingID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `unit_initiatives`
--
ALTER TABLE `unit_initiatives`
  MODIFY `UnitInitiativeID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `unit_measures`
--
ALTER TABLE `unit_measures`
  MODIFY `UnitMeasureID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `unit_objectives`
--
ALTER TABLE `unit_objectives`
  MODIFY `UnitObjectiveID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `unit_owners`
--
ALTER TABLE `unit_owners`
  MODIFY `UnitOwnerID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `unit_targets`
--
ALTER TABLE `unit_targets`
  MODIFY `UnitTargetID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
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
  MODIFY `UserLogID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT for table `user_staffs`
--
ALTER TABLE `user_staffs`
  MODIFY `UserStaffID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user_units`
--
ALTER TABLE `user_units`
  MODIFY `UserUnitID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
