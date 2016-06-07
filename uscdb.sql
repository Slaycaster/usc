-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2016 at 01:07 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `audit_trails`
--

INSERT INTO `audit_trails` (`AuditTrailID`, `Action`, `UserUnitID`, `UnitID`, `created_at`, `updated_at`) VALUES
(1, 'Added an objective: "A safer place to live, work and do business"', 1, 1, '2016-06-06 07:56:20', '2016-06-06 07:56:20'),
(2, 'Added an objective: "Improve crime prevention"', 1, 1, '2016-06-06 07:56:40', '2016-06-06 07:56:40'),
(3, 'Added an objective: "Improve crime solution"', 1, 1, '2016-06-06 07:56:56', '2016-06-06 07:56:56'),
(4, 'Added an objective: "Ensure support to public safety, internal security and assistance to NGAs in the effective delivery of basic services to the citizenry"', 1, 1, '2016-06-06 07:59:03', '2016-06-06 07:59:03'),
(5, 'Added an objective: "Recruit quality applicants"', 1, 1, '2016-06-06 07:59:24', '2016-06-06 07:59:24'),
(6, 'Added an objective: "Develop competent, highly motivated, right-based and disciplined PNP Personnel"', 1, 1, '2016-06-06 08:00:24', '2016-06-06 08:00:24'),
(7, 'Added an objective: "Develop a responsive and highly professional police organization"', 1, 1, '2016-06-06 08:01:05', '2016-06-06 08:01:05'),
(8, 'Added an objective: "Optimize use of financial resources and fill-up of logistical resources"', 1, 1, '2016-06-06 08:01:44', '2016-06-06 08:01:44'),
(9, 'Added an objective: "Optimize use of financial resources and fill-up of logistical resources"', 1, 1, '2016-06-06 08:02:22', '2016-06-06 08:02:22'),
(10, 'Added an objective: "Optimize use of financial and logistical resources on EPD"', 10, 7, '2016-06-07 09:35:31', '2016-06-07 09:35:31'),
(11, 'Added an objective: "A safer place to live, work and do business"', 10, 7, '2016-06-07 09:35:47', '2016-06-07 09:35:47'),
(12, 'Updated the Objective: "Optimize use of financial and logistical resources on EPD" under "Resource Managementto: "A safer place to live, work and do business on EPD" under "Community"', 10, 7, '2016-06-07 09:36:02', '2016-06-07 09:36:02'),
(13, 'Added a measure: "EPD Safety Index"', 10, 7, '2016-06-07 09:36:33', '2016-06-07 09:36:33'),
(14, 'Added a measure: "% of transparency on audit at EPD"', 10, 7, '2016-06-07 09:37:18', '2016-06-07 09:37:18'),
(15, 'Added a measure: "SJ CPS Safety Index"', 2, 5, '2016-06-07 09:49:02', '2016-06-07 09:49:02'),
(16, 'Added a measure: "Number of criminals tracked in San Juan"', 2, 5, '2016-06-07 09:49:42', '2016-06-07 09:49:42');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chief_accomplishments`
--

INSERT INTO `chief_accomplishments` (`ChiefAccomplishmentID`, `JanuaryAccomplishment`, `FebruaryAccomplishment`, `MarchAccomplishment`, `AprilAccomplishment`, `MayAccomplishment`, `JuneAccomplishment`, `JulyAccomplishment`, `AugustAccomplishment`, `SeptemberAccomplishment`, `OctoberAccomplishment`, `NovemberAccomplishment`, `DecemberAccomplishment`, `AccomplishmentDate`, `ChiefMeasureID`, `ChiefID`, `UserChiefID`, `created_at`, `updated_at`) VALUES
(1, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00', 1, 1, 1, '2016-06-06 08:12:57', '2016-06-06 08:12:57'),
(2, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00', 2, 1, 1, '2016-06-06 08:13:40', '2016-06-06 08:13:40'),
(3, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00', 3, 1, 1, '2016-06-06 08:16:40', '2016-06-06 08:16:40'),
(4, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00', 4, 1, 1, '2016-06-06 08:17:06', '2016-06-06 08:17:06'),
(5, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00', 6, 1, 1, '2016-06-06 08:20:04', '2016-06-06 08:20:04'),
(6, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00', 7, 1, 1, '2016-06-06 08:21:13', '2016-06-06 08:21:13'),
(7, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00', 8, 1, 1, '2016-06-06 08:21:35', '2016-06-06 08:21:35'),
(8, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00', 9, 1, 1, '2016-06-06 08:22:23', '2016-06-06 08:22:23'),
(9, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00', 12, 1, 1, '2016-06-06 08:25:17', '2016-06-06 08:25:17'),
(10, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00', 13, 1, 1, '2016-06-06 08:35:38', '2016-06-06 08:35:38');

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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chief_audit_trails`
--

INSERT INTO `chief_audit_trails` (`ChiefAuditTrailID`, `Action`, `UserChiefID`, `ChiefID`, `created_at`, `updated_at`) VALUES
(1, 'Added an objective: "A safer place to live, work and do business"', 1, 1, '2016-06-06 07:56:20', '2016-06-06 07:56:20'),
(2, 'Added an objective: "Improve crime prevention"', 1, 1, '2016-06-06 07:56:40', '2016-06-06 07:56:40'),
(3, 'Added an objective: "Improve crime solution"', 1, 1, '2016-06-06 07:56:56', '2016-06-06 07:56:56'),
(4, 'Added an objective: "Ensure support to public safety, internal security and assistance to NGAs in the effective delivery of basic services to the citizenry"', 1, 1, '2016-06-06 07:59:04', '2016-06-06 07:59:04'),
(5, 'Added an objective: "Recruit quality applicants"', 1, 1, '2016-06-06 07:59:24', '2016-06-06 07:59:24'),
(6, 'Added an objective: "Develop competent, highly motivated, right-based and disciplined PNP Personnel"', 1, 1, '2016-06-06 08:00:25', '2016-06-06 08:00:25'),
(7, 'Added an objective: "Develop a responsive and highly professional police organization"', 1, 1, '2016-06-06 08:01:05', '2016-06-06 08:01:05'),
(8, 'Added an objective: "Optimize use of financial resources and fill-up of logistical resources"', 1, 1, '2016-06-06 08:01:44', '2016-06-06 08:01:44'),
(9, 'Added an objective: "Optimize use of financial resources and fill-up of logistical resources"', 1, 1, '2016-06-06 08:02:22', '2016-06-06 08:02:22'),
(10, 'Added a measure: "National Safety Index"', 1, 1, '2016-06-06 08:04:16', '2016-06-06 08:04:16'),
(11, 'Added a measure: "National Satisfaction Index on Trust Index"', 1, 1, '2016-06-06 08:04:47', '2016-06-06 08:04:47'),
(12, 'Added a measure: "National Satisfaction Index on Respect Index"', 1, 1, '2016-06-06 08:05:05', '2016-06-06 08:05:05'),
(13, 'Updated a measure: "National Satisfaction Index on Trust"', 1, 1, '2016-06-06 08:05:19', '2016-06-06 08:05:19'),
(14, 'Updated a measure: "National Satisfaction Index on Respect"', 1, 1, '2016-06-06 08:05:25', '2016-06-06 08:05:25'),
(15, 'Added a measure: "National Satisfaction Index on Satisfaction"', 1, 1, '2016-06-06 08:05:45', '2016-06-06 08:05:45'),
(16, 'Added a measure: "National Satisfaction Index on Satisfaction"', 1, 1, '2016-06-06 08:05:45', '2016-06-06 08:05:45'),
(17, 'Added a measure: "Periodic National Index Crime Rate"', 1, 1, '2016-06-06 08:06:41', '2016-06-06 08:06:41'),
(18, 'Added a measure: "Index Crime Solution Efficiency"', 1, 1, '2016-06-06 08:07:52', '2016-06-06 08:07:52'),
(19, 'Added a measure: "Index Crime Clearance Efficiency"', 1, 1, '2016-06-06 08:08:12', '2016-06-06 08:08:12'),
(20, 'Added a measure: "Reduction of incidents perpetrated by threat groups against PNP Units and personnel"', 1, 1, '2016-06-06 08:09:45', '2016-06-06 08:09:45'),
(21, 'Added a measure: "Percentage implementation of Master Training Action Plan (MTAP) and Certificaton"', 1, 1, '2016-06-06 08:10:34', '2016-06-06 08:10:34'),
(22, 'Added a measure: "Percentage of Strategic Initiatives funded from the Annual Operations Plans and Budget (AOPB) based on the GAA provisions."', 1, 1, '2016-06-06 08:11:08', '2016-06-06 08:11:08'),
(23, 'Added a measure: "Percentage of funds released in support of Strategic Initiatives"', 1, 1, '2016-06-06 08:11:23', '2016-06-06 08:11:23'),
(24, 'Added a measure: "Percentage of funds obligated  in support of Strategic Initiatives"', 1, 1, '2016-06-06 08:11:44', '2016-06-06 08:11:44');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chief_fundings`
--

INSERT INTO `chief_fundings` (`ChiefFundingID`, `ChiefFundingEstimate`, `ChiefFundingActual`, `ChiefFundingDate`, `ChiefMeasureID`, `ChiefID`, `UserChiefID`, `created_at`, `updated_at`) VALUES
(1, 0, 0, '2016-06-06', 1, 1, 1, '2016-06-06 08:12:58', '2016-06-06 12:18:23'),
(2, 0, 0, '2016-06-06', 2, 1, 1, '2016-06-06 08:13:40', '2016-06-06 12:20:15'),
(3, 0, 0, '2016-06-06', 3, 1, 1, '2016-06-06 08:16:40', '2016-06-06 12:20:19'),
(4, 0, 0, '2016-06-06', 4, 1, 1, '2016-06-06 08:17:06', '2016-06-06 12:20:23'),
(5, 0, 0, '0000-00-00', 6, 1, 1, '2016-06-06 08:20:04', '2016-06-06 08:20:04'),
(6, 0, 0, '0000-00-00', 7, 1, 1, '2016-06-06 08:21:14', '2016-06-06 08:21:14'),
(7, 0, 0, '2016-06-06', 7, 1, 1, '2016-06-06 08:21:35', '2016-06-06 12:29:47'),
(8, 0, 0, '0000-00-00', 9, 1, 1, '2016-06-06 08:22:24', '2016-06-06 08:22:24'),
(9, 1, 0, '2016-06-06', 12, 1, 1, '2016-06-06 08:25:18', '2016-06-06 12:58:52'),
(10, 0, 0, '2016-06-06', 12, 1, 1, '2016-06-06 08:35:38', '2016-06-06 12:30:17');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chief_initiatives`
--

INSERT INTO `chief_initiatives` (`ChiefInitiativeID`, `ChiefInitiativeContent`, `ChiefInitiativeDate`, `ChiefMeasureID`, `ChiefID`, `UserChiefID`, `created_at`, `updated_at`) VALUES
(1, '', '2016-06-06', 1, 1, 1, '2016-06-06 08:12:58', '2016-06-06 12:18:23'),
(2, '', '2016-06-06', 2, 1, 1, '2016-06-06 08:13:40', '2016-06-06 12:20:15'),
(3, '', '2016-06-06', 3, 1, 1, '2016-06-06 08:16:40', '2016-06-06 12:20:19'),
(4, '', '2016-06-06', 4, 1, 1, '2016-06-06 08:17:06', '2016-06-06 12:20:23'),
(5, '', '0000-00-00', 6, 1, 1, '2016-06-06 08:20:04', '2016-06-06 08:20:04'),
(6, '', '0000-00-00', 7, 1, 1, '2016-06-06 08:21:13', '2016-06-06 08:21:13'),
(7, '', '2016-06-06', 7, 1, 1, '2016-06-06 08:21:35', '2016-06-06 12:29:47'),
(8, '', '0000-00-00', 9, 1, 1, '2016-06-06 08:22:23', '2016-06-06 08:22:23'),
(9, '', '2016-06-06', 12, 1, 1, '2016-06-06 08:25:18', '2016-06-06 12:58:40'),
(10, '', '2016-06-06', 12, 1, 1, '2016-06-06 08:35:38', '2016-06-06 12:30:17');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chief_logs`
--

INSERT INTO `chief_logs` (`ChiefLogID`, `ChiefUserID`, `LogDateTime`, `LogType`, `IPAddress`, `created_at`, `updated_at`) VALUES
(1, 1, '2016-06-06 15:54:15', 'Login', '::1', '2016-06-06 07:54:15', '2016-06-06 07:54:15'),
(2, 1, '2016-06-06 16:15:28', 'Login', '::1', '2016-06-06 08:15:28', '2016-06-06 08:15:28'),
(3, 1, '2016-06-06 16:19:01', 'Login', '::1', '2016-06-06 08:19:01', '2016-06-06 08:19:01'),
(4, 1, '2016-06-06 16:33:48', 'Login', '::1', '2016-06-06 08:33:48', '2016-06-06 08:33:48'),
(5, 1, '2016-06-06 16:34:53', 'Login', '::1', '2016-06-06 08:34:53', '2016-06-06 08:34:53'),
(6, 1, '2016-06-06 20:17:30', 'Login', '::1', '2016-06-06 12:17:30', '2016-06-06 12:17:30'),
(7, 1, '2016-06-07 17:13:28', 'Login', '::1', '2016-06-07 09:13:28', '2016-06-07 09:13:28');

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chief_measures`
--

INSERT INTO `chief_measures` (`ChiefMeasureID`, `ChiefMeasureName`, `ChiefMeasureType`, `ChiefMeasureFormula`, `ChiefObjectiveID`, `ChiefID`, `UserChiefID`, `created_at`, `updated_at`) VALUES
(1, 'National Safety Index', 'LG', 'Summation', 1, 1, 1, '2016-06-06 08:04:16', '2016-06-06 08:04:16'),
(2, 'National Satisfaction Index on Trust', 'LG', 'Summation', 1, 1, 1, '2016-06-06 08:04:47', '2016-06-06 08:05:18'),
(3, 'National Satisfaction Index on Respect', 'LG', 'Summation', 1, 1, 1, '2016-06-06 08:05:05', '2016-06-06 08:05:25'),
(4, 'National Satisfaction Index on Satisfaction', 'LG', 'Summation', 1, 1, 1, '2016-06-06 08:05:45', '2016-06-06 08:05:45'),
(6, 'Periodic National Index Crime Rate', 'LG', 'Summation', 2, 1, 1, '2016-06-06 08:06:41', '2016-06-06 08:06:41'),
(7, 'Index Crime Solution Efficiency', 'LG', 'Average', 3, 1, 1, '2016-06-06 08:07:52', '2016-06-06 08:07:52'),
(8, 'Index Crime Clearance Efficiency', 'LG', 'Average', 3, 1, 1, '2016-06-06 08:08:12', '2016-06-06 08:08:12'),
(9, 'Reduction of incidents perpetrated by threat groups against PNP Units and personnel', 'LG', 'Summation', 4, 1, 1, '2016-06-06 08:09:45', '2016-06-06 08:09:45'),
(10, 'Percentage implementation of Master Training Action Plan (MTAP) and Certificaton', 'LD', 'Average', 6, 1, 1, '2016-06-06 08:10:34', '2016-06-06 08:10:34'),
(11, 'Percentage of Strategic Initiatives funded from the Annual Operations Plans and Budget (AOPB) based on the GAA provisions.', 'LD', 'Average', 8, 1, 1, '2016-06-06 08:11:08', '2016-06-06 08:11:08'),
(12, 'Percentage of funds released in support of Strategic Initiatives', 'LD', 'Average', 8, 1, 1, '2016-06-06 08:11:23', '2016-06-06 08:11:23'),
(13, 'Percentage of funds obligated  in support of Strategic Initiatives', 'LG', 'Average', 8, 1, 1, '2016-06-06 08:11:44', '2016-06-06 08:11:44');

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chief_objectives`
--

INSERT INTO `chief_objectives` (`ChiefObjectiveID`, `ChiefObjectiveName`, `PerspectiveID`, `UserChiefID`, `ChiefID`, `created_at`, `updated_at`) VALUES
(1, 'A safer place to live, work and do business', 1, 1, 1, '2016-06-06 07:56:20', '2016-06-06 07:56:20'),
(2, 'Improve crime prevention', 3, 1, 1, '2016-06-06 07:56:40', '2016-06-06 07:56:40'),
(3, 'Improve crime solution', 3, 1, 1, '2016-06-06 07:56:56', '2016-06-06 07:56:56'),
(4, 'Ensure support to public safety, internal security and assistance to NGAs in the effective delivery of basic services to the citizenry', 3, 1, 1, '2016-06-06 07:59:04', '2016-06-06 07:59:04'),
(5, 'Recruit quality applicants', 2, 1, 1, '2016-06-06 07:59:24', '2016-06-06 07:59:24'),
(6, 'Develop competent, highly motivated, right-based and disciplined PNP Personnel', 1, 1, 1, '2016-06-06 08:00:25', '2016-06-06 08:00:25'),
(7, 'Develop a responsive and highly professional police organization', 2, 1, 1, '2016-06-06 08:01:05', '2016-06-06 08:01:05'),
(8, 'Optimize use of financial resources and fill-up of logistical resources', 4, 1, 1, '2016-06-06 08:01:44', '2016-06-06 08:01:44');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chief_owners`
--

INSERT INTO `chief_owners` (`ChiefOwnerID`, `ChiefOwnerContent`, `ChiefOwnerDate`, `ChiefMeasureID`, `ChiefID`, `UserChiefID`, `created_at`, `updated_at`) VALUES
(1, 'National Safety Index Owner 1', '2016-06-06', 1, 1, 1, '2016-06-06 08:12:58', '2016-06-06 12:18:23'),
(2, '', '2016-06-06', 2, 1, 1, '2016-06-06 08:13:40', '2016-06-06 12:20:15'),
(3, '', '2016-06-06', 3, 1, 1, '2016-06-06 08:16:40', '2016-06-06 12:20:19'),
(4, '', '2016-06-06', 4, 1, 1, '2016-06-06 08:17:06', '2016-06-06 12:20:23'),
(5, '', '0000-00-00', 6, 1, 1, '2016-06-06 08:20:04', '2016-06-06 08:20:04'),
(6, '', '0000-00-00', 7, 1, 1, '2016-06-06 08:21:13', '2016-06-06 08:21:13'),
(7, '', '2016-06-06', 7, 1, 1, '2016-06-06 08:21:35', '2016-06-06 12:29:47'),
(8, '', '0000-00-00', 9, 1, 1, '2016-06-06 08:22:23', '2016-06-06 08:22:23'),
(9, 'Funds Released:\n\n1', '2016-06-06', 12, 1, 1, '2016-06-06 08:25:18', '2016-06-06 12:58:40'),
(10, '', '2016-06-06', 12, 1, 1, '2016-06-06 08:35:38', '2016-06-06 12:30:17');

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chief_targets`
--

INSERT INTO `chief_targets` (`ChiefTargetID`, `JanuaryTarget`, `FebruaryTarget`, `MarchTarget`, `AprilTarget`, `MayTarget`, `JuneTarget`, `JulyTarget`, `AugustTarget`, `SeptemberTarget`, `OctoberTarget`, `NovemberTarget`, `DecemberTarget`, `TargetDate`, `Termination`, `TargetPeriod`, `ChiefMeasureID`, `ChiefAccomplishmentID`, `ChiefOwnerID`, `ChiefInitiativeID`, `ChiefFundingID`, `ChiefID`, `UserChiefID`, `created_at`, `updated_at`) VALUES
(1, 2.66667, 2.66667, 2.66667, 3, 3, 3, 3.33333, 3.33333, 3.33333, 3.66667, 3.66667, 3.66667, '2016-06-06', NULL, 'Quarterly', 1, 1, 1, 1, 1, 1, 1, '2016-06-06 08:04:16', '2016-06-06 08:12:58'),
(2, 2.66667, 2.66667, 2.66667, 3, 3, 3, 3.33333, 3.33333, 3.33333, 3.66667, 3.66667, 3.66667, '2016-06-06', NULL, 'Quarterly', 2, 2, 2, 2, 2, 1, 1, '2016-06-06 08:04:48', '2016-06-06 08:13:40'),
(3, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, '2016-06-06', NULL, 'Monthly', 3, 3, 3, 3, 3, 1, 1, '2016-06-06 08:05:05', '2016-06-06 08:16:40'),
(4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, '2016-06-06', NULL, 'Quarterly', 4, 4, 4, 4, 4, 1, 1, '2016-06-06 08:05:45', '2016-06-06 08:17:06'),
(5, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, '2016-06-06', NULL, 'Monthly', 6, 5, 5, 5, 5, 1, 1, '2016-06-06 08:06:41', '2016-06-06 08:20:04'),
(6, 4.66667, 4.66667, 4.66667, 5, 5, 5, 5.06667, 5.06667, 5.06667, 5.33333, 5.33333, 5.33333, '2016-06-06', NULL, 'Quarterly', 7, 6, 6, 6, 6, 1, 1, '2016-06-06 08:07:52', '2016-06-06 08:21:14'),
(7, 5.33333, 5.33333, 5.33333, 6, 6, 6, 6.33333, 6.33333, 6.33333, 7.7, 7.7, 7.7, '2016-06-06', NULL, 'Quarterly', 8, 7, 7, 7, 7, 1, 1, '2016-06-06 08:08:12', '2016-06-06 08:21:36'),
(8, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, '2016-06-06', NULL, 'Monthly', 9, 8, 8, 8, 8, 1, 1, '2016-06-06 08:09:45', '2016-06-06 08:22:24'),
(9, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, '0000-00-00', NULL, 'Not Set', 10, 0, 0, 0, 0, 1, 1, '2016-06-06 08:10:34', '2016-06-06 08:10:34'),
(10, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, '0000-00-00', NULL, 'Not Set', 11, 0, 0, 0, 0, 1, 1, '2016-06-06 08:11:08', '2016-06-06 08:11:08'),
(11, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, '2016-06-06', NULL, 'Monthly', 12, 9, 9, 9, 9, 1, 1, '2016-06-06 08:11:23', '2016-06-06 08:25:18'),
(12, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, '2016-06-06', NULL, 'Monthly', 13, 10, 10, 10, 10, 1, 1, '2016-06-06 08:11:44', '2016-06-06 08:35:38');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `secondary_audit_trails`
--

INSERT INTO `secondary_audit_trails` (`SecondaryUnitAuditTrailID`, `Action`, `UserSecondaryUnitID`, `SecondaryUnitID`, `created_at`, `updated_at`) VALUES
(1, 'Added an objective: "A safer place to live, work and do business"', 2, 5, '2016-06-07 09:41:35', '2016-06-07 09:41:35'),
(2, 'Updated the Objective: "A safer place to live, work and do business" under "Community to: "A safer place to live, work and do business SJ-CPS" under "Community"', 2, 5, '2016-06-07 09:52:32', '2016-06-07 09:52:32'),
(3, 'Added an objective: "Improve Community Safety awareness through community oriented and human rights based policing SJ-CPS"', 2, 5, '2016-06-07 09:56:14', '2016-06-07 09:56:14');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `secondary_units`
--

INSERT INTO `secondary_units` (`SecondaryUnitID`, `SecondaryUnitName`, `SecondaryUnitAbbreviation`, `PicturePath`, `UnitID`, `created_at`, `updated_at`) VALUES
(1, 'Cabadbaran City Police Station', 'Cabadbaran CPS', '', 55, '2016-06-06 05:20:57', '2016-06-06 05:20:57'),
(2, 'Buenavista Municipal Police Station', 'Buenavista MPS', '', 55, '2016-06-06 05:22:43', '2016-06-06 05:22:43'),
(3, 'Carmen Municipal Police Station', 'Carmen MPS', '', 55, '2016-06-06 05:25:21', '2016-06-06 05:25:21'),
(4, 'Jabonga Municipal Police Station', 'Jabonga MPS', '', 55, '2016-06-06 05:35:27', '2016-06-06 05:35:27'),
(5, 'San Juan City Police Station', 'San Juan CPS', '', 7, '2016-06-06 05:54:15', '2016-06-06 05:54:15'),
(6, 'Marikina City Police Station', 'Marikina CPS', '', 7, '2016-06-06 05:56:43', '2016-06-06 05:56:43');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `secondary_unit_accomplishments`
--

INSERT INTO `secondary_unit_accomplishments` (`SecondaryUnitAccomplishmentID`, `JanuaryAccomplishment`, `FebruaryAccomplishment`, `MarchAccomplishment`, `AprilAccomplishment`, `MayAccomplishment`, `JuneAccomplishment`, `JulyAccomplishment`, `AugustAccomplishment`, `SeptemberAccomplishment`, `OctoberAccomplishment`, `NovemberAccomplishment`, `DecemberAccomplishment`, `AccomplishmentDate`, `SecondaryUnitMeasureID`, `SecondaryUnitID`, `UserSecondaryUnitID`, `created_at`, `updated_at`) VALUES
(1, 3.00, 3.30, 4.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2016-06-07', 1, 5, 2, '2016-06-07 09:59:33', '2016-06-07 10:35:25'),
(2, 9.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2016-06-07', 2, 5, 2, '2016-06-07 10:08:49', '2016-06-07 10:35:58');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `secondary_unit_fundings`
--

INSERT INTO `secondary_unit_fundings` (`SecondaryUnitFundingID`, `SecondaryUnitFundingEstimate`, `SecondaryUnitFundingActual`, `SecondaryUnitFundingDate`, `SecondaryUnitMeasureID`, `SecondaryUnitID`, `UserSecondaryUnitID`, `created_at`, `updated_at`) VALUES
(1, '100000', '90000', '2016-06-07', 1, 5, 2, '2016-06-07 09:59:34', '2016-06-07 10:35:25'),
(2, '1500000', '1374638', '2016-06-07', 2, 5, 2, '2016-06-07 10:08:49', '2016-06-07 10:35:58');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `secondary_unit_initiatives`
--

INSERT INTO `secondary_unit_initiatives` (`SecondaryUnitInitiativeID`, `SecondaryUnitInitiativeContent`, `SecondaryUnitInitiativeDate`, `SecondaryUnitMeasureID`, `SecondaryUnitID`, `UserSecondaryUnitID`, `created_at`, `updated_at`) VALUES
(1, 'SJ Initiative', '2016-06-07', 1, 5, 2, '2016-06-07 09:59:34', '2016-06-07 10:35:25'),
(2, '', '0000-00-00', 2, 5, 2, '2016-06-07 10:08:49', '2016-06-07 10:08:49');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `secondary_unit_measures`
--

INSERT INTO `secondary_unit_measures` (`SecondaryUnitMeasureID`, `SecondaryUnitMeasureName`, `SecondaryUnitMeasureType`, `SecondaryUnitMeasureFormula`, `SecondaryUnitObjectiveID`, `UnitMeasureID`, `SecondaryUnitID`, `UserSecondaryUnitID`, `created_at`, `updated_at`) VALUES
(1, 'SJ CPS Safety Index', 'LG', 'Summation', 1, 1, 5, 2, '2016-06-07 09:49:02', '2016-06-07 09:49:02'),
(2, 'Number of criminals tracked in San Juan', 'LD', 'Summation', 1, 0, 5, 2, '2016-06-07 09:49:42', '2016-06-07 09:49:42');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `secondary_unit_objectives`
--

INSERT INTO `secondary_unit_objectives` (`SecondaryUnitObjectiveID`, `SecondaryUnitObjectiveName`, `PerspectiveID`, `SecondaryUnitID`, `UserSecondaryUnitID`, `UnitObjectiveID`, `created_at`, `updated_at`) VALUES
(1, 'A safer place to live, work and do business SJ-CPS', 1, 5, 2, 0, '2016-06-07 09:44:53', '2016-06-07 09:45:06'),
(2, 'Improve Community Safety awareness through community oriented and human rights based policing SJ-CPS', 3, 5, 2, 0, '2016-06-07 09:46:12', '2016-06-07 09:46:12');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `secondary_unit_owners`
--

INSERT INTO `secondary_unit_owners` (`SecondaryUnitOwnerID`, `SecondaryUnitOwnerContent`, `SecondaryUnitOwnerDate`, `SecondaryUnitMeasureID`, `SecondaryUnitID`, `UserSecondaryUnitID`, `created_at`, `updated_at`) VALUES
(1, 'San Juan City Police Station\n\nOwner', '2016-06-07', 1, 5, 2, '2016-06-07 09:59:33', '2016-06-07 10:35:25'),
(2, 'Criminality Bachmanity', '2016-06-07', 2, 5, 2, '2016-06-07 10:08:49', '2016-06-07 10:35:58');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `secondary_unit_targets`
--

INSERT INTO `secondary_unit_targets` (`SecondaryUnitTargetID`, `JanuaryTarget`, `FebruaryTarget`, `MarchTarget`, `AprilTarget`, `MayTarget`, `JuneTarget`, `JulyTarget`, `AugustTarget`, `SeptemberTarget`, `OctoberTarget`, `NovemberTarget`, `DecemberTarget`, `TargetDate`, `TargetPeriod`, `Termination`, `SecondaryUnitAccomplishmentID`, `SecondaryUnitOwnerID`, `SecondaryUnitInitiativeID`, `SecondaryUnitFundingID`, `SecondaryUnitMeasureID`, `SecondaryUnitID`, `UserSecondaryUnitID`, `created_at`, `updated_at`) VALUES
(1, 3.33, 3.33, 3.33, 6.67, 6.67, 6.67, 10.00, 10.00, 10.00, 13.33, 13.33, 13.33, '2016-06-07', 'Quarterly', '', 1, 1, 1, 1, 1, 5, 2, '2016-06-07 09:49:03', '2016-06-07 09:59:33'),
(2, 10.00, 10.00, 10.00, 16.67, 16.67, 16.67, 26.67, 26.67, 26.67, 33.67, 33.67, 33.67, '2016-06-07', 'Quarterly', '', 2, 2, 2, 2, 2, 5, 2, '2016-06-07 09:49:42', '2016-06-07 10:08:49');

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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `staffs`
--

INSERT INTO `staffs` (`StaffID`, `StaffName`, `StaffAbbreviation`, `StaffPermission`, `UserStaffID`, `PicturePath`, `ChiefID`, `created_at`, `updated_at`) VALUES
(1, 'Directorial for Information and Communication Technology Management', 'DICTM', 'none', 1, 'wtHDmDaW3wF7JzDy0zKZwZfxlnUWPVI0.jpeg', 1, '0000-00-00 00:00:00', '2016-05-02 06:31:50'),
(2, 'Center for Police Strategy Management', 'CPSM', '', 3, 'wO3AXldVfjOlQBJlZhpUqSchPfrzLFTX.png', 1, '2016-05-02 06:20:52', '2016-05-02 06:32:17'),
(3, 'Police Regional Office 1', 'PRO1', '', 0, '', 1, '2016-06-06 02:16:41', '2016-06-06 02:27:11'),
(4, 'Police Regional Office 2', 'PRO2', '', 0, '', 1, '2016-06-06 02:27:54', '2016-06-06 02:27:54'),
(5, 'Police Regional Office 3', 'PRO3', '', 0, '', 1, '2016-06-06 02:28:08', '2016-06-06 02:28:08'),
(6, 'Police Regional Office 4A', 'PRO4A', '', 0, '', 1, '2016-06-06 02:28:39', '2016-06-06 02:28:39'),
(7, 'Police Regional Office 4B', 'PRO4B', '', 0, '', 1, '2016-06-06 02:28:55', '2016-06-06 02:28:55'),
(8, 'Police Regional Office 5', 'PRO5', '', 0, '', 1, '2016-06-06 02:47:53', '2016-06-06 02:47:53'),
(9, 'Police Regional Office 6', 'PRO6', '', 0, '', 1, '2016-06-06 02:49:22', '2016-06-06 02:49:22'),
(10, 'Police Regional Office 7', 'PRO7', '', 0, '', 1, '2016-06-06 02:49:39', '2016-06-06 02:49:39'),
(11, 'Police Regional Office 8', 'PRO8', '', 0, '', 1, '2016-06-06 02:49:52', '2016-06-06 02:49:52'),
(12, 'Police Regional Office 9', 'PRO9', '', 0, '', 1, '2016-06-06 02:50:06', '2016-06-06 02:50:06'),
(13, 'Police Regional Office 10', 'PRO10', '', 0, '', 1, '2016-06-06 02:50:20', '2016-06-06 02:50:20'),
(14, 'Police Regional Office 11', 'PRO11', '', 0, '', 1, '2016-06-06 02:50:34', '2016-06-06 02:50:34'),
(15, 'Police Regional Office 12', 'PRO12', '', 0, '', 1, '2016-06-06 02:50:48', '2016-06-06 02:50:48'),
(16, 'Police Regional Office 13', 'PRO13', '', 0, '', 1, '2016-06-06 02:50:59', '2016-06-06 02:50:59'),
(17, 'Police Regional Office ARMM', 'PRO ARMM', '', 0, '', 1, '2016-06-06 02:51:26', '2016-06-06 02:51:26'),
(18, 'Police Regional Office COR', 'PRO COR', '', 0, '', 1, '2016-06-06 02:51:44', '2016-06-06 02:51:44'),
(19, 'Police Regional Office 18', 'PRO18', '', 0, '', 1, '2016-06-06 02:52:38', '2016-06-06 02:52:38'),
(20, 'National Capital Regional Police Office', 'NCRPO', '', 0, 'W3lpNwSISPMa1tCKfTiY9o5RphgxQrdJ.png', 1, '2016-06-06 03:17:45', '2016-06-06 03:17:45');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `staff_accomplishments`
--

INSERT INTO `staff_accomplishments` (`StaffAccomplishmentID`, `JanuaryAccomplishment`, `FebruaryAccomplishment`, `MarchAccomplishment`, `AprilAccomplishment`, `MayAccomplishment`, `JuneAccomplishment`, `JulyAccomplishment`, `AugustAccomplishment`, `SeptemberAccomplishment`, `OctoberAccomplishment`, `NovemberAccomplishment`, `DecemberAccomplishment`, `AccomplishmentDate`, `StaffMeasureID`, `StaffID`, `UserStaffID`, `created_at`, `updated_at`) VALUES
(1, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00', 6, 20, 4, '2016-06-07 09:29:44', '2016-06-07 09:29:44'),
(2, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00', 5, 20, 4, '2016-06-07 09:30:35', '2016-06-07 09:30:35'),
(3, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00', 4, 20, 4, '2016-06-07 09:34:09', '2016-06-07 09:34:09');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `staff_audit_trails`
--

INSERT INTO `staff_audit_trails` (`StaffAuditTrailID`, `Action`, `StaffID`, `UserStaffID`, `created_at`, `updated_at`) VALUES
(1, 'Added an objective: "A safer place to live, work and do business"', 4, 6, '2016-06-06 13:10:22', '2016-06-06 13:10:22'),
(2, 'Added an objective: "Improve Community Safety awareness through community oriented and human rights based policing"', 4, 6, '2016-06-06 13:10:42', '2016-06-06 13:10:42'),
(3, 'Added an objective: "Institutionalize standard investigative system and procedures"', 4, 6, '2016-06-06 13:11:28', '2016-06-06 13:11:28'),
(4, 'Added an objective: "Modernize crime reporting and analysis and promote accountability"', 4, 6, '2016-06-06 13:12:26', '2016-06-06 13:12:26'),
(5, 'Added an objective: "Improve crime prevention and control in partnership with all stakeholders"', 4, 6, '2016-06-06 13:12:46', '2016-06-06 13:12:46'),
(6, 'Added an objective: "Develop competent motivated and values-oriented PNP personnel"', 4, 6, '2016-06-06 13:13:07', '2016-06-06 13:13:07'),
(7, 'Added an objective: "Optimize use of financial and logistical resources"', 4, 6, '2016-06-06 13:13:47', '2016-06-06 13:13:47'),
(8, 'Added an objective: "A safer place to live, work and do business"', 20, 4, '2016-06-07 09:20:17', '2016-06-07 09:20:17'),
(9, 'Added an objective: "Optimize use of financial and logistical resources"', 20, 4, '2016-06-07 09:20:41', '2016-06-07 09:20:41'),
(10, 'Made an Update to the Measure: "Safety Index" under "A safer place to live, work and do business and is contributory to Chief''s Measure: National Safety Index  with the following: Measure name "Safety Index" to "Trust Index NCRPO", Chief Measure Name to "National Satisfaction Index on Trust", Staff''s Objective "A safer place to live, work and do business" to "A safer place to live, work and do business"', 20, 4, '2016-06-07 09:27:45', '2016-06-07 09:27:45');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `staff_fundings`
--

INSERT INTO `staff_fundings` (`StaffFundingID`, `StaffFundingEstimate`, `StaffFundingActual`, `StaffFundingDate`, `StaffMeasureID`, `StaffID`, `UserStaffID`, `created_at`, `updated_at`) VALUES
(1, 0, 0, '0000-00-00', 6, 20, 4, '2016-06-07 09:29:44', '2016-06-07 09:29:44'),
(2, 0, 0, '0000-00-00', 5, 20, 4, '2016-06-07 09:30:35', '2016-06-07 09:30:35'),
(3, 0, 0, '0000-00-00', 4, 20, 4, '2016-06-07 09:34:09', '2016-06-07 09:34:09');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `staff_initiatives`
--

INSERT INTO `staff_initiatives` (`StaffInitiativeID`, `StaffInitiativeContent`, `StaffInitiativeDate`, `StaffMeasureID`, `StaffID`, `UserStaffID`, `created_at`, `updated_at`) VALUES
(1, '', '0000-00-00', 6, 20, 4, '2016-06-07 09:29:44', '2016-06-07 09:29:44'),
(2, '', '0000-00-00', 5, 20, 4, '2016-06-07 09:30:35', '2016-06-07 09:30:35'),
(3, '', '0000-00-00', 4, 20, 4, '2016-06-07 09:34:09', '2016-06-07 09:34:09');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `staff_logs`
--

INSERT INTO `staff_logs` (`StaffLogID`, `StaffUserID`, `LogDateTime`, `LogType`, `IPAddress`, `created_at`, `updated_at`) VALUES
(1, 4, '2016-06-06 15:53:50', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 4, '2016-06-06 21:00:30', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 6, '2016-06-06 21:09:34', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 4, '2016-06-07 17:19:06', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 6, '2016-06-07 17:19:42', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 4, '2016-06-07 17:31:48', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 4, '2016-06-07 17:33:23', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 4, '2016-06-07 17:33:37', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 4, '2016-06-07 18:43:25', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 4, '2016-06-07 19:01:18', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `staff_measures`
--

INSERT INTO `staff_measures` (`StaffMeasureID`, `StaffMeasureName`, `StaffMeasureType`, `StaffMeasureFormula`, `StaffObjectiveID`, `ChiefMeasureID`, `StaffID`, `UserStaffID`, `created_at`, `updated_at`) VALUES
(1, 'Safety Index', 'LG', 'Summation', 1, 1, 4, 6, '2016-06-06 13:14:28', '2016-06-06 13:14:28'),
(2, 'Respect Index', 'LG', 'Summation', 1, 3, 4, 6, '2016-06-06 13:14:44', '2016-06-06 13:14:44'),
(3, 'Trust Index', 'LG', 'Summation', 1, 2, 4, 6, '2016-06-06 13:15:00', '2016-06-06 13:15:00'),
(4, 'Safety Index', 'LG', 'Summation', 8, 1, 20, 4, '2016-06-07 09:21:11', '2016-06-07 09:21:11'),
(5, 'Respect Index', 'LG', 'Summation', 8, 3, 20, 4, '2016-06-07 09:21:30', '2016-06-07 09:21:30'),
(6, 'Trust Index NCRPO', 'LG', 'Summation', 8, 2, 20, 4, '2016-06-07 09:21:43', '2016-06-07 09:27:45');

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `staff_objectives`
--

INSERT INTO `staff_objectives` (`StaffObjectiveID`, `StaffObjectiveName`, `PerspectiveID`, `StaffID`, `UserStaffID`, `ChiefObjectiveID`, `created_at`, `updated_at`) VALUES
(1, 'A safer place to live, work and do business', 1, 4, 6, 0, '2016-06-06 13:10:22', '2016-06-06 13:10:22'),
(2, 'Improve Community Safety awareness through community oriented and human rights based policing', 3, 4, 6, 0, '2016-06-06 13:10:42', '2016-06-06 13:10:42'),
(3, 'Institutionalize standard investigative system and procedures', 3, 4, 6, 0, '2016-06-06 13:11:28', '2016-06-06 13:11:28'),
(4, 'Modernize crime reporting and analysis and promote accountability', 3, 4, 6, 0, '2016-06-06 13:12:26', '2016-06-06 13:12:26'),
(5, 'Improve crime prevention and control in partnership with all stakeholders', 3, 4, 6, 0, '2016-06-06 13:12:46', '2016-06-06 13:12:46'),
(6, 'Develop competent motivated and values-oriented PNP personnel', 2, 4, 6, 0, '2016-06-06 13:13:07', '2016-06-06 13:13:07'),
(7, 'Optimize use of financial and logistical resources', 4, 4, 6, 0, '2016-06-06 13:13:47', '2016-06-06 13:13:47'),
(8, 'A safer place to live, work and do business', 1, 20, 4, 0, '2016-06-07 09:20:17', '2016-06-07 09:20:17'),
(9, 'Optimize use of financial and logistical resources', 4, 20, 4, 0, '2016-06-07 09:20:42', '2016-06-07 09:20:42');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `staff_owners`
--

INSERT INTO `staff_owners` (`StaffOwnerID`, `StaffOwnerContent`, `StaffOwnerDate`, `StaffMeasureID`, `StaffID`, `UserStaffID`, `created_at`, `updated_at`) VALUES
(1, '', '0000-00-00', 6, 20, 4, '2016-06-07 09:29:44', '2016-06-07 09:29:44'),
(2, '', '0000-00-00', 5, 20, 4, '2016-06-07 09:30:35', '2016-06-07 09:30:35'),
(3, '', '0000-00-00', 4, 20, 4, '2016-06-07 09:34:09', '2016-06-07 09:34:09');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `staff_targets`
--

INSERT INTO `staff_targets` (`StaffTargetID`, `JanuaryTarget`, `FebruaryTarget`, `MarchTarget`, `AprilTarget`, `MayTarget`, `JuneTarget`, `JulyTarget`, `AugustTarget`, `SeptemberTarget`, `OctoberTarget`, `NovemberTarget`, `DecemberTarget`, `TargetDate`, `TargetPeriod`, `Termination`, `StaffMeasureID`, `StaffAccomplishmentID`, `StaffOwnerID`, `StaffInitiativeID`, `StaffFundingID`, `StaffID`, `UserStaffID`, `created_at`, `updated_at`) VALUES
(1, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00', 'Not Set', NULL, 1, 0, 0, 0, 0, 4, 6, '2016-06-06 13:14:28', '2016-06-06 13:14:28'),
(2, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00', 'Not Set', NULL, 2, 0, 0, 0, 0, 4, 6, '2016-06-06 13:14:45', '2016-06-06 13:14:45'),
(3, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00', 'Not Set', NULL, 3, 0, 0, 0, 0, 4, 6, '2016-06-06 13:15:00', '2016-06-06 13:15:00'),
(4, 3.57, 3.57, 3.57, 7.03, 7.03, 7.03, 12.63, 12.63, 12.63, 13.51, 13.51, 13.51, '2016-06-07', 'Quarterly', NULL, 4, 3, 3, 3, 3, 20, 4, '2016-06-07 09:21:11', '2016-06-07 09:34:09'),
(5, 3.33, 3.33, 3.33, 6.67, 6.67, 6.67, 10.00, 10.00, 10.00, 13.33, 13.33, 13.33, '2016-06-07', 'Quarterly', NULL, 5, 2, 2, 2, 2, 20, 4, '2016-06-07 09:21:30', '2016-06-07 09:30:35'),
(6, 1.00, 2.00, 3.00, 4.00, 5.00, 6.00, 7.00, 8.00, 9.00, 10.00, 11.00, 12.00, '2016-06-07', 'Monthly', NULL, 6, 1, 1, 1, 1, 20, 4, '2016-06-07 09:21:43', '2016-06-07 09:29:44');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tertiary_audit_trails`
--

INSERT INTO `tertiary_audit_trails` (`TertiaryUnitAuditTrailID`, `Action`, `UserTertiaryUnitID`, `TertiaryUnitID`, `created_at`, `updated_at`) VALUES
(1, 'Added an objective: "A safer place to live, work and do business SJ-PCP1"', 1, 1, '2016-06-07 09:41:35', '2016-06-07 09:41:35'),
(2, 'Added a measure: "SJ PCP Safety Index"', 1, 1, '2016-06-07 09:42:35', '2016-06-07 09:42:35'),
(3, 'Added a measure: "Number of criminals tracked in SJ PCP"', 1, 1, '2016-06-07 09:43:12', '2016-06-07 09:43:12');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tertiary_units`
--

INSERT INTO `tertiary_units` (`TertiaryUnitID`, `TertiaryUnitName`, `TertiaryUnitAbbreviation`, `PicturePath`, `SecondaryUnitID`, `created_at`, `updated_at`) VALUES
(1, 'San Juan Police Community Precinct 1', 'SJ-PCP1', 'OMA6qTPt7vcJp1Xv0l4HRBrGep07Hp5t.png', 5, '2016-06-06 07:48:15', '2016-06-06 07:48:15'),
(2, 'San Juan Police Community Precinct 2', 'SJ-PCP2', 'i3fJmM5dX9PhpjuK09S7URA7EsqVIBG1.png', 5, '2016-06-06 07:48:43', '2016-06-06 07:48:43');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tertiary_unit_accomplishments`
--

INSERT INTO `tertiary_unit_accomplishments` (`TertiaryUnitAccomplishmentID`, `JanuaryAccomplishment`, `FebruaryAccomplishment`, `MarchAccomplishment`, `AprilAccomplishment`, `MayAccomplishment`, `JuneAccomplishment`, `JulyAccomplishment`, `AugustAccomplishment`, `SeptemberAccomplishment`, `OctoberAccomplishment`, `NovemberAccomplishment`, `DecemberAccomplishment`, `AccomplishmentDate`, `TertiaryUnitMeasureID`, `TertiaryUnitID`, `UserTertiaryUnitID`, `created_at`, `updated_at`) VALUES
(1, 10.00, 19.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2016-06-07', 2, 1, 1, '2016-06-07 10:50:36', '2016-06-07 10:59:33'),
(2, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00', 1, 1, 1, '2016-06-07 10:50:50', '2016-06-07 10:50:50');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tertiary_unit_fundings`
--

INSERT INTO `tertiary_unit_fundings` (`TertiaryUnitFundingID`, `TertiaryUnitFundingEstimate`, `TertiaryUnitFundingActual`, `TertiaryUnitFundingDate`, `TertiaryUnitMeasureID`, `TertiaryUnitID`, `UserTertiaryUnitID`, `created_at`, `updated_at`) VALUES
(1, '', '', '0000-00-00', 2, 1, 1, '2016-06-07 10:50:36', '2016-06-07 10:50:36'),
(2, '10000', '9000', '2016-06-07', 1, 1, 1, '2016-06-07 10:50:50', '2016-06-07 10:59:45');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tertiary_unit_initiatives`
--

INSERT INTO `tertiary_unit_initiatives` (`TertiaryUnitInitiativeID`, `TertiaryUnitInitiativeContent`, `TertiaryUnitInitiativeDate`, `TertiaryUnitMeasureID`, `TertiaryUnitID`, `UserTertiaryUnitID`, `created_at`, `updated_at`) VALUES
(1, '', '0000-00-00', 2, 1, 1, '2016-06-07 10:50:36', '2016-06-07 10:50:36'),
(2, 'Initiative PCP 1', '2016-06-07', 1, 1, 1, '2016-06-07 10:50:50', '2016-06-07 10:59:45');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tertiary_unit_measures`
--

INSERT INTO `tertiary_unit_measures` (`TertiaryUnitMeasureID`, `TertiaryUnitMeasureName`, `TertiaryUnitMeasureType`, `TertiaryUnitMeasureFormula`, `TertiaryUnitObjectiveID`, `SecondaryUnitMeasureID`, `TertiaryUnitID`, `UserTertiaryUnitID`, `created_at`, `updated_at`) VALUES
(1, 'SJ PCP Safety Index', 'LG', 'Summation', 1, 1, 1, 1, '2016-06-07 10:46:54', '2016-06-07 10:46:54'),
(2, 'Number of criminals tracked in SJ PCP', 'LD', 'Summation', 1, 0, 1, 1, '2016-06-07 10:49:33', '2016-06-07 10:49:33');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tertiary_unit_objectives`
--

INSERT INTO `tertiary_unit_objectives` (`TertiaryUnitObjectiveID`, `TertiaryUnitObjectiveName`, `PerspectiveID`, `TertiaryUnitID`, `UserTertiaryUnitID`, `SecondaryUnitObjectiveID`, `created_at`, `updated_at`) VALUES
(1, 'A safer place to live, work and do business SJ-PCP1', 1, 1, 1, 0, '2016-06-07 10:46:04', '2016-06-07 10:46:04');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tertiary_unit_owners`
--

INSERT INTO `tertiary_unit_owners` (`TertiaryUnitOwnerID`, `TertiaryUnitOwnerContent`, `TertiaryUnitOwnerDate`, `TertiaryUnitMeasureID`, `TertiaryUnitID`, `UserTertiaryUnitID`, `created_at`, `updated_at`) VALUES
(1, 'Criminality Ownership', '2016-06-07', 2, 1, 1, '2016-06-07 10:50:36', '2016-06-07 10:52:29'),
(2, '', '0000-00-00', 1, 1, 1, '2016-06-07 10:50:50', '2016-06-07 10:50:50');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tertiary_unit_targets`
--

INSERT INTO `tertiary_unit_targets` (`TertiaryUnitTargetID`, `JanuaryTarget`, `FebruaryTarget`, `MarchTarget`, `AprilTarget`, `MayTarget`, `JuneTarget`, `JulyTarget`, `AugustTarget`, `SeptemberTarget`, `OctoberTarget`, `NovemberTarget`, `DecemberTarget`, `TargetDate`, `TargetPeriod`, `Termination`, `TertiaryUnitMeasureID`, `TertiaryUnitAccomplishmentID`, `TertiaryUnitOwnerID`, `TertiaryUnitFundingID`, `TertiaryUnitInitiativeID`, `TertiaryUnitID`, `UserTertiaryUnitID`, `created_at`, `updated_at`) VALUES
(1, 7.00, 7.00, 7.00, 8.00, 8.00, 8.00, 8.67, 8.67, 8.67, 9.33, 9.33, 9.33, '2016-06-07', 'Quarterly', '', 1, 2, 2, 2, 2, 1, 1, '2016-06-07 10:46:54', '2016-06-07 10:50:50'),
(2, 10.00, 20.00, 30.00, 40.00, 50.00, 60.00, 70.00, 80.00, 90.00, 100.00, 110.00, 120.00, '2016-06-07', 'Monthly', '', 2, 1, 1, 1, 1, 1, 1, '2016-06-07 10:49:34', '2016-06-07 10:50:37');

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
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`UnitID`, `UnitName`, `UnitAbbreviation`, `PicturePath`, `StaffID`, `created_at`, `updated_at`) VALUES
(2, 'Information Technology Management Service', 'ITMS', 'QDVGLkNEPJwqrJ2am7PaXwYQhdnD2rCN.jpg', 1, '2016-05-02 06:15:06', '2016-05-10 09:58:31'),
(3, 'Manila Police District', 'MPD', '', 20, '2016-06-06 03:22:12', '2016-06-06 03:22:12'),
(4, 'Quezon City Police District', 'QCPD', '', 20, '2016-06-06 03:22:23', '2016-06-06 03:22:23'),
(5, 'Northern Police District', 'NPD', '', 20, '2016-06-06 03:22:36', '2016-06-06 03:22:36'),
(6, 'Southern Police District', 'SPD', '', 20, '2016-06-06 03:22:48', '2016-06-06 03:22:48'),
(7, 'Eastern Police District', 'EPD', '', 20, '2016-06-06 03:23:04', '2016-06-06 03:23:04'),
(8, 'Ilocos Norte Provincial Police Office', 'Ilocos Norte PPO', '', 3, '2016-06-06 04:08:10', '2016-06-06 04:20:10'),
(9, 'Ilocos Sur Provincial Police Office', 'Ilocos Sur PPO', '', 3, '2016-06-06 04:08:32', '2016-06-06 04:19:54'),
(10, 'La Union Provincial Police Office', 'La Union PPO', '', 3, '2016-06-06 04:08:54', '2016-06-06 04:19:41'),
(11, 'Pangasinan Provincial Police Office', 'Pangasinan PPO', '8WQbscfU5E7223z0f2eijp60vtI0qwa3.png', 3, '2016-06-06 04:09:09', '2016-06-06 07:18:31'),
(12, 'Batanes Provincial Police Office', 'Batanes PPO', '', 4, '2016-06-06 04:13:54', '2016-06-06 04:19:18'),
(13, 'Cagayan Provincial Police Office', 'Cagayan PPO', '', 4, '2016-06-06 04:14:09', '2016-06-06 04:17:10'),
(14, 'Isabela Provincial Police Office', 'Isabela PPO', 'iwZQvsyglWdoDEyBTdZhNgdNhlMwmW00.png', 4, '2016-06-06 04:14:22', '2016-06-06 07:25:04'),
(15, 'Nueva Vizcaya Police Provincial Office', 'Nueva Vizcaya PPO', '', 4, '2016-06-06 04:14:35', '2016-06-06 04:16:51'),
(16, 'Quirino Provincial Police Office', 'Quirino PPO', '', 4, '2016-06-06 04:14:46', '2016-06-06 04:16:35'),
(17, 'Batangas Provincial Police Office', 'Batangas PPO', '', 6, '2016-06-06 04:15:43', '2016-06-06 04:15:43'),
(18, 'Cavite Provincial Police Office', 'Cavite PPO', '', 6, '2016-06-06 04:16:01', '2016-06-06 04:16:01'),
(19, 'Laguna Provincial Police Office', 'Laguna PPO', '', 6, '2016-06-06 04:16:15', '2016-06-06 04:16:15'),
(20, 'Quezon Provincial Police Office', 'Quezon PPO', '', 6, '2016-06-06 04:16:26', '2016-06-06 04:16:26'),
(21, 'Rizal Provincial Police Office', 'Rizal PPO', '', 6, '2016-06-06 04:24:57', '2016-06-06 04:24:57'),
(22, 'Marinduque Provincial Police Office', 'Marinduque PPO', '', 7, '2016-06-06 04:25:14', '2016-06-06 04:25:14'),
(23, 'Occidental Mindoro Provincial Police Office', 'Occidental Mindoro PPO', '', 7, '2016-06-06 04:25:30', '2016-06-06 04:25:30'),
(24, 'Oriental Mindoro Provincial Police Office', 'Oriental Mindoro PPO', '', 7, '2016-06-06 04:25:46', '2016-06-06 04:25:46'),
(25, 'Palawan Provincial Police Office', 'Palawan PPO', 'OxkcBueNnmC8lzYAcwV6KMn0Mg0m3FPv.png', 7, '2016-06-06 04:25:59', '2016-06-06 07:29:22'),
(26, 'Romblon Provincial Police Office', 'Romblon PPO', '', 7, '2016-06-06 04:26:30', '2016-06-06 04:26:30'),
(27, 'Albay Provincial Police Office', 'Albay PPO', '', 8, '2016-06-06 04:26:46', '2016-06-06 04:26:46'),
(28, 'Camarines Norte Provincial Police Office', 'Camarines Norte PPO', '', 8, '2016-06-06 04:27:03', '2016-06-06 04:27:03'),
(29, 'Camarines Sur Provincial Police Office', 'Camarines Sur PPO', '', 8, '2016-06-06 04:27:16', '2016-06-06 04:27:16'),
(30, 'Sorsogon Provincial Police Office', 'Sorsogon PPO', '', 8, '2016-06-06 04:27:36', '2016-06-06 04:27:36'),
(31, 'Catanduanes Provincial Police Office', 'Catanduanes PPO', '', 8, '2016-06-06 04:27:56', '2016-06-06 04:27:56'),
(32, 'Aklan Provincial Police Office', 'Aklan PPO', '', 9, '2016-06-06 04:29:53', '2016-06-06 04:29:53'),
(33, 'Antique Provincial Police Office', 'Antique PPO', '', 9, '2016-06-06 04:30:06', '2016-06-06 04:30:06'),
(34, 'Capiz Provincial Police Office', 'Capiz PPO', '', 9, '2016-06-06 04:30:28', '2016-06-06 04:30:28'),
(35, 'Iloilo Provincial Police Office', 'Iloilo PPO', '', 9, '2016-06-06 04:32:37', '2016-06-06 04:32:37'),
(36, 'Guimaras Provincial Police Office', 'Guimaras PPO', '', 9, '2016-06-06 04:32:56', '2016-06-06 04:32:56'),
(37, 'Bohol Provincial Police Office', 'Bohol PPO', '', 10, '2016-06-06 04:33:35', '2016-06-06 04:33:35'),
(38, 'Cebu Provincial Police Office', 'Cebu PPO', '', 10, '2016-06-06 04:33:50', '2016-06-06 04:33:50'),
(39, 'Siquijor Provincial Police Office', 'Siquijor PPO', '', 10, '2016-06-06 04:34:06', '2016-06-06 04:34:06'),
(40, 'Eastern Samar Provincial Police Office', 'Eastern Samar PPO', '', 11, '2016-06-06 04:34:21', '2016-06-06 04:34:21'),
(41, 'Leyte Provincial Police Office', 'Leyte PPO', '', 11, '2016-06-06 04:34:54', '2016-06-06 04:34:54'),
(42, 'Northern Samar Provincial Police Office', 'Northern Samar PPO', '', 11, '2016-06-06 04:35:15', '2016-06-06 04:35:15'),
(43, 'Samar Provincial Police Office', 'Samar PPO', '', 11, '2016-06-06 04:35:30', '2016-06-06 04:35:30'),
(44, 'Southern Leyte Provincial Police Office', 'Southern Leyte PPO', '', 11, '2016-06-06 04:35:48', '2016-06-06 04:35:48'),
(45, 'Biliran Provincial Police Office', 'Biliran PPO', '', 11, '2016-06-06 04:36:06', '2016-06-06 04:36:06'),
(46, 'Zamboanga Del Norte Provincial Police Office', 'Zamboanga Del Norte PPO', '', 12, '2016-06-06 04:38:23', '2016-06-06 04:38:23'),
(47, 'Zamboanga Del Sur Provincial Police Office', 'Zamboanga Del Sur PPO', '', 12, '2016-06-06 04:38:42', '2016-06-06 04:38:42'),
(48, 'Zamboanga Sibugay Provincial Police Office', 'Zamboanga Sibugay PPO', '', 12, '2016-06-06 04:39:12', '2016-06-06 04:39:12'),
(49, 'Misamis Occidental Provincial Police Office', 'Misamis Occidental PPO', '', 13, '2016-06-06 04:39:39', '2016-06-06 04:39:39'),
(50, 'Misamis Oriental Provincial Police Office', 'Misamis Oriental PPO', '', 13, '2016-06-06 04:40:01', '2016-06-06 04:40:01'),
(51, 'Davao Del Norte Provincial Police Office', 'Davao Del Norte PPO', '', 14, '2016-06-06 04:40:31', '2016-06-06 04:40:31'),
(52, 'Davao Del Sur Provincial Police Office', 'Davao Del Sur PPO', '', 14, '2016-06-06 04:41:26', '2016-06-06 04:41:26'),
(53, 'Davao Oriental Provincial Police Office ', 'Davao Oriental PPO', '', 14, '2016-06-06 04:41:52', '2016-06-06 04:41:52'),
(54, 'Compostela Valley Provincial Police Office', 'Compostela Valley PPO', '', 14, '2016-06-06 04:42:15', '2016-06-06 04:42:15'),
(55, 'Agusan del Norte Police Provincial Office', 'Agusan del Norte PPO', '', 16, '2016-06-06 04:42:41', '2016-06-06 04:42:41'),
(56, 'Agusan del Sur Police Provincial Office', 'Agusan del Sur PPO', '', 16, '2016-06-06 04:43:00', '2016-06-06 04:43:00'),
(57, 'Surigao del Norte Police Provincial Office', 'Surigao del Norte PPO', '', 16, '2016-06-06 04:43:21', '2016-06-06 04:43:21'),
(58, 'Surigao del Sur Police Provincial Office', 'Surigao del Sur PPO', '', 16, '2016-06-06 04:44:12', '2016-06-06 04:44:12'),
(59, 'Dinagat Islands Police Provincial Office', 'Dinagat Islands PPO', '', 16, '2016-06-06 04:45:52', '2016-06-06 04:45:52'),
(60, 'Basilan Police Provincial Office', 'Basilan PPO', '', 17, '2016-06-06 04:46:57', '2016-06-06 04:46:57'),
(61, 'Lanao Del Sur Police Provincial Office', 'Lanao Del Sur PPO', '', 17, '2016-06-06 04:47:27', '2016-06-06 04:47:27'),
(62, 'Maguindanao Police Provincial Office', 'Maguindanao PPO', '', 17, '2016-06-06 04:47:50', '2016-06-06 04:47:50'),
(63, 'Sulu Police Provincial Office', 'Sulu PPO', '', 17, '2016-06-06 04:48:40', '2016-06-06 04:48:40'),
(64, 'Butuan City Police Office', 'Butuan CPO', '', 16, '2016-06-06 04:49:19', '2016-06-06 04:49:19'),
(65, 'Abra Police Provincial Office', 'Abra PPO', '', 18, '2016-06-06 04:49:38', '2016-06-06 04:49:38'),
(66, 'Benguet Police Provincial Office', 'Benguet PPO', '', 18, '2016-06-06 04:50:01', '2016-06-06 04:50:01'),
(67, 'Ifugao Police Provincial Office', 'Ifugao PPO', '', 18, '2016-06-06 04:50:13', '2016-06-06 04:50:13'),
(68, 'Kalinga Police Provincial Office', 'Kalinga PPO', '', 18, '2016-06-06 04:50:40', '2016-06-06 04:50:40'),
(69, 'Mt. Province Police Provincial Office', 'Mt. Province PPO', '', 18, '2016-06-06 04:50:56', '2016-06-06 04:50:56'),
(70, 'Negros Occidental Provincial Police Office', 'Negros Occidental PPO', '', 19, '2016-06-06 04:51:16', '2016-06-06 04:51:16'),
(71, 'Negros Oriental Provincial Police Office', 'Negros Oriental PPO', '', 19, '2016-06-06 04:52:08', '2016-06-06 04:52:08'),
(72, 'Cotabato Provincial Police Office', 'Cotabato PPO', '', 15, '2016-06-06 04:52:25', '2016-06-06 04:52:25'),
(73, 'Sarangani Provincial Police Office', 'Sarangani PPO', '', 15, '2016-06-06 04:52:41', '2016-06-06 04:52:41'),
(74, 'South Cotabato Provincial Police Office', 'South Cotabato PPO', '', 15, '2016-06-06 04:53:06', '2016-06-06 04:53:06'),
(75, 'Sultan Kudarat Provincial Police Office', 'Sultan Kudarat PPO', '', 15, '2016-06-06 04:53:23', '2016-06-06 04:53:23'),
(76, 'General Santos City Police Office', 'General Santos CPO', '', 15, '2016-06-06 04:53:38', '2016-06-06 04:53:38'),
(77, 'Naga City Police Office', 'Naga CPO', 'EmK2Jle9XxvW4Bns2J19UG0wTaJVHf7L.png', 8, '2016-06-06 04:53:58', '2016-06-06 07:29:42'),
(78, 'Tacloban City Police Office', 'Tacloban CPO', '', 11, '2016-06-06 04:54:13', '2016-06-06 04:54:13'),
(79, 'Cebu City Police Office', 'Cebu CPO', '', 10, '2016-06-06 04:54:28', '2016-06-06 04:54:28'),
(80, 'Mandaue City Police Office', 'Mandaue CPO', '', 10, '2016-06-06 04:54:41', '2016-06-06 04:54:41'),
(81, 'Lapu-Lapu City Police Office', 'Lapu-Lapu CPO', '', 10, '2016-06-06 04:55:04', '2016-06-06 04:55:04'),
(82, 'Ormoc City Police Office', 'Ormoc CPO', '', 11, '2016-06-06 04:55:20', '2016-06-06 04:55:20'),
(83, 'Baguio City Police Office', 'Baguio CPO', '', 18, '2016-06-06 04:55:45', '2016-06-06 04:55:45'),
(84, 'Apayao Police Provincial Office', 'Apayao PPO', '', 18, '2016-06-06 04:56:11', '2016-06-06 04:56:11'),
(85, 'Iloilo City Police Office', 'Iloilo CPO', '', 9, '2016-06-06 04:59:36', '2016-06-06 04:59:36'),
(86, 'Davao City Police Office', 'Davao CPO', '', 14, '2016-06-06 05:00:06', '2016-06-06 05:00:06'),
(87, 'Zamboanga City Police Office', 'Zamboanga CPO', '', 12, '2016-06-06 05:00:27', '2016-06-06 05:00:27'),
(88, 'Tawi-Tawi Police Provincial Office', 'Tawi-Tawi PPO', '', 17, '2016-06-06 05:01:40', '2016-06-06 05:01:40'),
(89, 'Bacolod City Police Office', 'Bacolod CPO', '', 19, '2016-06-06 05:02:10', '2016-06-06 05:02:10'),
(90, 'Santiago City Police Office', 'Santiago CPO', '', 4, '2016-06-06 05:02:40', '2016-06-06 05:02:40'),
(91, 'Bukidnon Provincial Police Office ', 'Bukidnon PPO', '', 13, '2016-06-06 05:04:10', '2016-06-06 05:04:10'),
(92, 'Camiguin Provincial Police Office ', 'Camiguin PPO', '', 13, '2016-06-06 05:06:08', '2016-06-06 05:06:08'),
(93, 'Cagayan de Oro City Police Office ', 'Cagayan de Oro CPO', '', 13, '2016-06-06 05:06:29', '2016-06-06 05:06:29'),
(94, 'Lanao del Norte Provincial Police Office', 'Lanao del Norte PPO', '', 13, '2016-06-06 05:06:46', '2016-06-06 05:06:46'),
(95, 'Iligan City Police Office', 'Iligan CPO', '', 13, '2016-06-06 05:07:04', '2016-06-06 05:07:04');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `unit_accomplishments`
--

INSERT INTO `unit_accomplishments` (`UnitAccomplishmentID`, `JanuaryAccomplishment`, `FebruaryAccomplishment`, `MarchAccomplishment`, `AprilAccomplishment`, `MayAccomplishment`, `JuneAccomplishment`, `JulyAccomplishment`, `AugustAccomplishment`, `SeptemberAccomplishment`, `OctoberAccomplishment`, `NovemberAccomplishment`, `DecemberAccomplishment`, `AccomplishmentDate`, `UnitMeasureID`, `UnitID`, `UserUnitID`, `created_at`, `updated_at`) VALUES
(1, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00', 1, 7, 10, '2016-06-07 09:38:58', '2016-06-07 09:38:58'),
(2, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00', 2, 7, 10, '2016-06-07 09:39:50', '2016-06-07 09:39:50');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `unit_fundings`
--

INSERT INTO `unit_fundings` (`UnitFundingID`, `UnitFundingEstimate`, `UnitFundingActual`, `UnitFundingDate`, `UnitMeasureID`, `UnitID`, `UserUnitID`, `created_at`, `updated_at`) VALUES
(1, '', '', '0000-00-00', 1, 7, 10, '2016-06-07 09:38:59', '2016-06-07 09:38:59'),
(2, '', '', '0000-00-00', 2, 7, 10, '2016-06-07 09:39:50', '2016-06-07 09:39:50');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `unit_initiatives`
--

INSERT INTO `unit_initiatives` (`UnitInitiativeID`, `UnitInitiativeContent`, `UnitInitiativeDate`, `UnitMeasureID`, `UnitID`, `UserUnitID`, `created_at`, `updated_at`) VALUES
(1, '', '0000-00-00', 1, 7, 10, '2016-06-07 09:38:59', '2016-06-07 09:38:59'),
(2, '', '0000-00-00', 2, 7, 10, '2016-06-07 09:39:50', '2016-06-07 09:39:50');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `unit_measures`
--

INSERT INTO `unit_measures` (`UnitMeasureID`, `UnitMeasureName`, `UnitMeasureType`, `UnitMeasureFormula`, `UnitObjectiveID`, `StaffMeasureID`, `UnitID`, `UserUnitID`, `created_at`, `updated_at`) VALUES
(1, 'EPD Safety Index', 'LG', 'Summation', 2, 4, 7, 10, '2016-06-07 09:36:34', '2016-06-07 09:36:34'),
(2, '% of transparency on audit at EPD', 'LD', 'Average', 1, 0, 7, 10, '2016-06-07 09:37:18', '2016-06-07 09:37:18');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `unit_objectives`
--

INSERT INTO `unit_objectives` (`UnitObjectiveID`, `UnitObjectiveName`, `PerspectiveID`, `StaffObjectiveID`, `UnitID`, `UserUnitID`, `created_at`, `updated_at`) VALUES
(1, 'Optimize use of financial and logistical resources on EPD', 4, 0, 7, 10, '2016-06-07 09:35:31', '2016-06-07 09:35:31'),
(2, 'A safer place to live, work and do business on EPD', 1, 0, 7, 10, '2016-06-07 09:35:47', '2016-06-07 09:36:02');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `unit_owners`
--

INSERT INTO `unit_owners` (`UnitOwnerID`, `UnitOwnerContent`, `UnitOwnerDate`, `UnitMeasureID`, `UnitID`, `UserUnitID`, `created_at`, `updated_at`) VALUES
(1, '', '0000-00-00', 1, 7, 10, '2016-06-07 09:38:58', '2016-06-07 09:38:58'),
(2, '', '0000-00-00', 2, 7, 10, '2016-06-07 09:39:50', '2016-06-07 09:39:50');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `unit_targets`
--

INSERT INTO `unit_targets` (`UnitTargetID`, `JanuaryTarget`, `FebruaryTarget`, `MarchTarget`, `AprilTarget`, `MayTarget`, `JuneTarget`, `JulyTarget`, `AugustTarget`, `SeptemberTarget`, `OctoberTarget`, `NovemberTarget`, `DecemberTarget`, `TargetDate`, `TargetPeriod`, `Termination`, `UnitAccomplishmentID`, `UnitOwnerID`, `UnitInitiativeID`, `UnitFundingID`, `UnitMeasureID`, `UnitID`, `UserUnitID`, `created_at`, `updated_at`) VALUES
(1, 3.67, 3.67, 3.67, 7.33, 7.33, 7.33, 11.00, 11.00, 11.00, 14.67, 14.67, 14.67, '2016-06-07', 'Quarterly', NULL, 1, 1, 1, 1, 1, 7, 10, '2016-06-07 09:36:34', '2016-06-07 09:38:59'),
(2, 1.30, 2.11, 3.91, 4.90, 5.41, 6.00, 7.30, 8.91, 10.00, 10.71, 11.00, 12.00, '2016-06-07', 'Monthly', NULL, 2, 2, 2, 2, 2, 7, 10, '2016-06-07 09:37:18', '2016-06-07 09:39:50');

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
(1, 'Super Administrator', 'usc@cpsm.pnp.gov.ph', '$2y$10$zSC2JGHGr7/A4HbZI/S2mOj4gY6bXd2HkR9sf8YXkojtX4snxTjp2', 'UOIkg4rCD1zn3vCAlj0WgyAygBUDqjlkJywZTDavW7MQYJdbWNVDvxwEafs4', '2016-03-13 05:42:04', '2016-06-06 07:53:18');

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_logs`
--

INSERT INTO `user_logs` (`UserLogID`, `UnitUserID`, `LogDateTime`, `LogType`, `IPAddress`, `created_at`, `updated_at`) VALUES
(1, 0, '2016-06-06 15:54:03', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 0, '2016-06-06 21:00:15', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 0, '2016-06-06 21:09:26', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 0, '2016-06-07 17:17:55', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 0, '2016-06-07 17:34:39', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 10, '2016-06-07 17:35:01', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 10, '2016-06-07 17:42:03', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 0, '2016-06-07 18:36:58', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 0, '2016-06-07 18:43:16', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 0, '2016-06-07 18:59:56', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 10, '2016-06-07 19:00:05', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 0, '2016-06-07 19:01:09', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_secondary_units`
--

INSERT INTO `user_secondary_units` (`UserSecondaryUnitID`, `UserSecondaryUnitBadgeNumber`, `UserSecondaryUnitFirstName`, `UserSecondaryUnitMiddleName`, `UserSecondaryUnitLastName`, `UserSecondaryUnitQualifier`, `UserSecondaryUnitPicturePath`, `UserSecondaryUnitPassword`, `RankID`, `SecondaryUnitID`, `UserSecondaryUnitIsActive`, `created_at`, `updated_at`) VALUES
(1, 'MPS-13', 'Carmen MPS', '', 'Admin', '', 'mucyLA9nDCM6ExTRA5uylDV42LqNMM4V.jpg', 'mps13admin', 18, 3, 1, '2016-06-06 07:40:42', '2016-06-06 07:40:42'),
(2, 'CPS-001', 'San Juan CPS', '', 'Admin', '', '2ChfItaMtTwZSWz4x7kgdNRP1rmKkwu0.jpg', 'cps1admin', 9, 5, 1, '2016-06-06 07:46:13', '2016-06-06 07:46:13');

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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_staffs`
--

INSERT INTO `user_staffs` (`UserStaffID`, `UserStaffBadgeNumber`, `UserStaffFirstName`, `UserStaffMiddleName`, `UserStaffLastName`, `UserStaffQualifier`, `UserStaffPicturePath`, `UserStaffPassword`, `RankID`, `StaffID`, `UserStaffIsActive`, `created_at`, `updated_at`) VALUES
(1, 'S-12345', 'Jose', 'J.', 'Alvarez', '', 'FbyFV2zDJ1COTOXRGAGwpGZAYt77bzIm.jpg', 'anton123', 10, 1, 1, '0000-00-00 00:00:00', '2016-05-26 05:04:07'),
(2, 'S-12346', 'Lorenzo', 'Malasig', 'Viovicente', '', 'npddunnpRv13rPYyaozfaTCrFaNuyRbY.jpg', 'lorenzo', 18, 1, 1, '2016-05-02 06:30:20', '2016-05-06 01:51:56'),
(3, 'S-12347', 'Pablo', '', 'Cantoria', '', 'neg4EMfTJAnuQBpRS7oWfVnN7Y70upI6.jpg', 'pablo123', 10, 2, 1, '2016-05-02 06:35:28', '2016-05-02 06:35:28'),
(4, 'NCRPO-001', 'NCRPO', '', 'Admin 1', '', 'UodQSV9J7JfEmdc1NdNA72U5LSHUqkAg.jpg', 'ncrpoadmin', 18, 20, 1, '2016-06-06 06:33:43', '2016-06-06 06:35:15'),
(5, 'PRO-1', 'PRO 1', '', 'Admin', '', 'PLch5XqEU7Mcm5KaIaZQRJrBrjfLhbXw.jpg', 'pro1admin', 18, 3, 1, '2016-06-06 06:36:08', '2016-06-06 06:36:28'),
(6, 'PRO-2', 'PRO 2', '', 'Admin', '', 'ezf3hbRJo3DZUdeKXXxO4nsLF8oAZyax.jpg', 'pro2admin', 18, 4, 1, '2016-06-06 06:37:22', '2016-06-06 06:37:22'),
(7, 'PRO-3', 'PRO 3', '', 'Admin', '', 'rgeCO1yaS9p3qfKjnxpEHyZfqIm2SmFQ.jpg', 'pro3admin', 18, 5, 1, '2016-06-06 06:37:54', '2016-06-06 06:37:54'),
(8, 'PRO-4A', 'PRO 4A', '', 'Admin', '', 'GGEl7ftUz634V3NZexoyA0liR5UMoQI3.jpg', 'pro4aadmin', 18, 6, 1, '2016-06-06 06:48:25', '2016-06-06 06:48:25'),
(9, 'PRO-4B', 'PRO 4B', '', 'Admin', '', '5TdIiPpbua0I4AwqIeE48OwVovvKJngR.jpg', 'pro4badmin', 18, 7, 1, '2016-06-06 06:49:08', '2016-06-06 06:49:08'),
(10, 'PRO-5', 'PRO 5', '', 'Admin', '', 'RXIi9P5IaKRYQCexr9ymwqLknr8cmK6S.jpg', 'pro5admin', 18, 8, 1, '2016-06-06 06:50:26', '2016-06-06 06:50:26'),
(11, 'PRO-6', 'PRO 6', '', 'Admin', '', 'otia00xGsRyqGMtptyI8yp5ofbqVNVfC.jpg', 'pro6admin', 18, 9, 1, '2016-06-06 06:51:19', '2016-06-06 06:51:19'),
(12, 'PRO-7', 'PRO 7', '', 'Admin', '', 'r84m5t0w2VGhTOnxTrUK7IqtOO1byfOM.jpg', 'pro7admin', 18, 10, 1, '2016-06-06 06:51:52', '2016-06-06 06:51:52'),
(13, 'PRO-8', 'PRO 8', '', 'Admin', '', 'DxdAXsYnsZzqN9ja2fw04Jr9bdEebEcF.jpg', 'pro8admin', 18, 11, 1, '2016-06-06 06:52:20', '2016-06-06 06:52:53'),
(14, 'PRO-9', 'PRO 9', '', 'Admin', '', 'd32GhhilAWHQUZWZrDCpkuYCElkt4zwl.jpg', 'pro9admin', 18, 12, 1, '2016-06-06 06:53:45', '2016-06-06 06:53:45'),
(15, 'PRO-10', 'PRO 10', '', 'Admin', '', 'CG1oZrmBn00E3f455qZ4Uw5eOT7Vey6B.jpg', 'pro10admin', 18, 13, 1, '2016-06-06 06:54:30', '2016-06-06 06:54:30'),
(16, 'PRO-11', 'PRO 11', '', 'Admin', '', 'EEsdiEU0ER4fvHkuN6F7C7KlsLATz45c.jpg', 'pro11admin', 18, 14, 1, '2016-06-06 06:56:35', '2016-06-06 06:56:35'),
(17, 'PRO-12', 'PRO 12', '', 'Admin', '', 'xJepSNJJDzxR8RDbMtI1IWpoQLTh2zW9.jpg', 'pro12admin', 18, 15, 1, '2016-06-06 06:57:11', '2016-06-06 06:57:11'),
(18, 'PRO-13', 'PRO 13', '', 'Admin', '', 'suKC0ZAhgP9OSfCCZQXTXwJJiBTKNNdG.jpg', 'pro13admin', 18, 16, 1, '2016-06-06 06:57:38', '2016-06-06 06:57:38'),
(19, 'PRO-ARMM', 'PRO ARMM', '', 'Admin', '', 'IrPPSvZGYuWsJ4NIAyfiHex664woghrL.jpg', 'proarmmadmin', 18, 17, 1, '2016-06-06 06:58:10', '2016-06-06 06:58:10'),
(20, 'PRO-COR', 'PRO COR', '', 'Admin', '', 'PSHVz3EhfVCQZWIZp6su5ze61brsUsfP.jpg', 'procoradmin', 18, 18, 1, '2016-06-06 06:58:43', '2016-06-06 06:58:43'),
(21, 'PRO-18', 'PRO 18', '', 'Admin', '', 'Ny6WZkvFjGAjwGDuecnbNokuMnfW34NC.jpg', 'pro18admin', 18, 19, 1, '2016-06-06 06:59:16', '2016-06-06 06:59:16');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_tertiary_units`
--

INSERT INTO `user_tertiary_units` (`UserTertiaryUnitID`, `UserTertiaryUnitBadgeNumber`, `UserTertiaryUnitFirstName`, `UserTertiaryUnitMiddleName`, `UserTertiaryUnitLastName`, `UserTertiaryUnitQualifier`, `UserTertiaryUnitPicturePath`, `UserTertiaryUnitPassword`, `RankID`, `TertiaryUnitID`, `UserTertiaryUnitIsActive`, `created_at`, `updated_at`) VALUES
(1, 'PCP-001', 'SJ-PCP1', '', 'Admin', '', 'GYCOtkNlLdR5wcesJNi1ykNxjCOaEm5l.jpg', 'sjpcp1admin', 14, 1, 1, '2016-06-06 07:50:35', '2016-06-06 07:50:35'),
(2, 'PCP-002', 'SJ-PCP2', '', 'Admin', '', 'V4HL28U0OxzA4w5nJTRpnTls0oksUTGF.jpg', 'sjpcp2admin', 17, 2, 1, '2016-06-06 07:51:47', '2016-06-06 07:51:47');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_units`
--

INSERT INTO `user_units` (`UserUnitID`, `UserUnitBadgeNumber`, `UserUnitFirstName`, `UserUnitMiddleName`, `UserUnitLastName`, `UserUnitQualifier`, `UserUnitPicturePath`, `UserUnitPassword`, `RankID`, `UnitID`, `UserUnitIsActive`, `created_at`, `updated_at`) VALUES
(1, 'U-12345', 'Rock Well', '', 'Ramos', '', 'UF5nyn6kSBq7hSvAfAmIBXuXZLqzB0Ad.jpg', 'isha123', 10, 2, 1, '2016-05-02 06:34:37', '2016-05-26 05:04:27'),
(2, 'PPO-1', 'Pangasinan PPO', '', 'Admin', '', 'jExHyURKvmbFES2RfXiSFSvjlTXx6ZxS.jpg', 'ppo1admin', 18, 11, 1, '2016-06-06 07:23:34', '2016-06-06 07:23:34'),
(3, 'PPO-2', 'PPO Isabela', '', 'Admin', '', 'qoekZAXvqxIy8ePKu0C0n7xWGh9nnxZe.jpg', 'ppo2admin', 18, 14, 1, '2016-06-06 07:25:35', '2016-06-06 07:27:03'),
(4, 'PPO-4A', 'Rizal PPO', '', 'Admin', '', '1zam75RNDar5bQWGaio6RdKnbf4Nxwpu.jpg', 'ppo4aadmin', 18, 21, 1, '2016-06-06 07:26:44', '2016-06-06 07:26:44'),
(5, 'PPO-4B', 'Palawan PPO', '', 'Admin', '', '6aFpkMf4q8YLJvmCN1ComVkud8BUOO0C.jpg', 'ppo4badmin', 18, 25, 1, '2016-06-06 07:29:10', '2016-06-06 07:29:10'),
(6, 'CPO-5', 'Naga CPO', '', 'Admin', '', 'tJl9EEQiRr0gI2979nn2P0aXnSKJgMMt.jpg', 'cpo5admin', 18, 77, 1, '2016-06-06 07:30:58', '2016-06-06 07:30:58'),
(7, 'CPO-6', 'CPO 6', '', 'Admin', '', 's9zR4jbc3f5OPiDye1Owq6wcwIvR6aDp.jpg', 'cpo6admin', 18, 85, 1, '2016-06-06 07:32:33', '2016-06-06 07:32:33'),
(8, 'CPO-7', 'Cebu CPO', '', 'Admin', '', 'NkwFYyRZ1Lg3eS8gA6Nfod7eX9HlmS5T.jpg', 'cpo7admin', 18, 79, 1, '2016-06-06 07:34:56', '2016-06-06 07:34:56'),
(9, 'PPO-13', 'Agusan del Norte PPO', '', 'Admin', '', 'lw2rvx5aBgXfcycxmQwEbJ3WIPbNjSFy.jpg', 'ppo13admin', 18, 55, 1, '2016-06-06 07:38:51', '2016-06-06 07:38:51'),
(10, 'EPD-001', 'EPD', '', 'Admin', '', 'IGDiViM3rwqRqijceDFsaga9pD85TOR7.jpg', 'epdadmin', 4, 7, 1, '2016-06-06 07:43:40', '2016-06-06 07:43:40');

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
  MODIFY `AuditTrailID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `chiefs`
--
ALTER TABLE `chiefs`
  MODIFY `ChiefID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `chief_accomplishments`
--
ALTER TABLE `chief_accomplishments`
  MODIFY `ChiefAccomplishmentID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `chief_audit_trails`
--
ALTER TABLE `chief_audit_trails`
  MODIFY `ChiefAuditTrailID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `chief_fundings`
--
ALTER TABLE `chief_fundings`
  MODIFY `ChiefFundingID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `chief_initiatives`
--
ALTER TABLE `chief_initiatives`
  MODIFY `ChiefInitiativeID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `chief_logs`
--
ALTER TABLE `chief_logs`
  MODIFY `ChiefLogID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `chief_measures`
--
ALTER TABLE `chief_measures`
  MODIFY `ChiefMeasureID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `chief_objectives`
--
ALTER TABLE `chief_objectives`
  MODIFY `ChiefObjectiveID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `chief_owners`
--
ALTER TABLE `chief_owners`
  MODIFY `ChiefOwnerID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `chief_targets`
--
ALTER TABLE `chief_targets`
  MODIFY `ChiefTargetID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
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
  MODIFY `SecondaryUnitAuditTrailID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `secondary_units`
--
ALTER TABLE `secondary_units`
  MODIFY `SecondaryUnitID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `secondary_unit_accomplishments`
--
ALTER TABLE `secondary_unit_accomplishments`
  MODIFY `SecondaryUnitAccomplishmentID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `secondary_unit_fundings`
--
ALTER TABLE `secondary_unit_fundings`
  MODIFY `SecondaryUnitFundingID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `secondary_unit_initiatives`
--
ALTER TABLE `secondary_unit_initiatives`
  MODIFY `SecondaryUnitInitiativeID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `secondary_unit_measures`
--
ALTER TABLE `secondary_unit_measures`
  MODIFY `SecondaryUnitMeasureID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `secondary_unit_objectives`
--
ALTER TABLE `secondary_unit_objectives`
  MODIFY `SecondaryUnitObjectiveID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `secondary_unit_owners`
--
ALTER TABLE `secondary_unit_owners`
  MODIFY `SecondaryUnitOwnerID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `secondary_unit_targets`
--
ALTER TABLE `secondary_unit_targets`
  MODIFY `SecondaryUnitTargetID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `staffs`
--
ALTER TABLE `staffs`
  MODIFY `StaffID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `staff_accomplishments`
--
ALTER TABLE `staff_accomplishments`
  MODIFY `StaffAccomplishmentID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `staff_audit_trails`
--
ALTER TABLE `staff_audit_trails`
  MODIFY `StaffAuditTrailID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `staff_fundings`
--
ALTER TABLE `staff_fundings`
  MODIFY `StaffFundingID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `staff_initiatives`
--
ALTER TABLE `staff_initiatives`
  MODIFY `StaffInitiativeID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `staff_logs`
--
ALTER TABLE `staff_logs`
  MODIFY `StaffLogID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `staff_measures`
--
ALTER TABLE `staff_measures`
  MODIFY `StaffMeasureID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `staff_objectives`
--
ALTER TABLE `staff_objectives`
  MODIFY `StaffObjectiveID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `staff_owners`
--
ALTER TABLE `staff_owners`
  MODIFY `StaffOwnerID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `staff_targets`
--
ALTER TABLE `staff_targets`
  MODIFY `StaffTargetID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tertiary_audit_trails`
--
ALTER TABLE `tertiary_audit_trails`
  MODIFY `TertiaryUnitAuditTrailID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tertiary_units`
--
ALTER TABLE `tertiary_units`
  MODIFY `TertiaryUnitID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tertiary_unit_accomplishments`
--
ALTER TABLE `tertiary_unit_accomplishments`
  MODIFY `TertiaryUnitAccomplishmentID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tertiary_unit_fundings`
--
ALTER TABLE `tertiary_unit_fundings`
  MODIFY `TertiaryUnitFundingID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tertiary_unit_initiatives`
--
ALTER TABLE `tertiary_unit_initiatives`
  MODIFY `TertiaryUnitInitiativeID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tertiary_unit_measures`
--
ALTER TABLE `tertiary_unit_measures`
  MODIFY `TertiaryUnitMeasureID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tertiary_unit_objectives`
--
ALTER TABLE `tertiary_unit_objectives`
  MODIFY `TertiaryUnitObjectiveID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tertiary_unit_owners`
--
ALTER TABLE `tertiary_unit_owners`
  MODIFY `TertiaryUnitOwnerID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tertiary_unit_targets`
--
ALTER TABLE `tertiary_unit_targets`
  MODIFY `TertiaryUnitTargetID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `UnitID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=96;
--
-- AUTO_INCREMENT for table `unit_accomplishments`
--
ALTER TABLE `unit_accomplishments`
  MODIFY `UnitAccomplishmentID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `unit_fundings`
--
ALTER TABLE `unit_fundings`
  MODIFY `UnitFundingID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `unit_initiatives`
--
ALTER TABLE `unit_initiatives`
  MODIFY `UnitInitiativeID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `unit_measures`
--
ALTER TABLE `unit_measures`
  MODIFY `UnitMeasureID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `unit_objectives`
--
ALTER TABLE `unit_objectives`
  MODIFY `UnitObjectiveID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `unit_owners`
--
ALTER TABLE `unit_owners`
  MODIFY `UnitOwnerID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `unit_targets`
--
ALTER TABLE `unit_targets`
  MODIFY `UnitTargetID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
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
  MODIFY `UserLogID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `user_secondary_units`
--
ALTER TABLE `user_secondary_units`
  MODIFY `UserSecondaryUnitID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user_staffs`
--
ALTER TABLE `user_staffs`
  MODIFY `UserStaffID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `user_tertiary_units`
--
ALTER TABLE `user_tertiary_units`
  MODIFY `UserTertiaryUnitID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user_units`
--
ALTER TABLE `user_units`
  MODIFY `UserUnitID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
