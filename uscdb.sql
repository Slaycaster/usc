-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2016 at 09:29 AM
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
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `audit_trails`
--

INSERT INTO `audit_trails` (`AuditTrailID`, `Action`, `UserUnitID`, `UnitID`, `created_at`, `updated_at`) VALUES
(1, '0', 1, 1, '2016-03-15 11:36:37', '2016-03-15 11:36:37'),
(2, 'Added an objective: "Effectively and Efficiently trashtalk PABLO CANTORIA III"', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Added an objective: \\"FUCK ALEX UY\\"', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Added an objective: "FUCKALEXUY"', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Updated an Objective: "FUCK ALEX UY fucker"', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Added an objective: "Finish Unit Dashboard"', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Updated an Objective: "FUCK ALEX UY fucker"', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'Updated an Objective: "FAQ"', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'Updated an Objective: "Sing a song"', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'Updated an Objective: "Sing more song"', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'Updated an Objective: "Unit song"', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'Added an objective: "Happy Song"', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'Updated an Objective: "Happy Songs"', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 'Added an objective: "Sing a Happy Song"', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 'Updated an Objective: "Sing a Happy Song"', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 'Updated an Objective: "Sing a Happy Song"', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 'Updated an Objective: "Sing a Happy Song"', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 'Updated an Objective: "Sing a Happy Song"', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 'Updated an Objective: "Sing a Happy Song"', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 'Updated an Objective: "Sing a Happy Song"', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 'Updated an Objective: "Sing a Happy Song"', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 'Updated an Objective: "Sing a Happy Song"', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 'Updated an Objective: "Sing a Happy Song"', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 'Updated an Objective: "Sing a Happy Song"', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 'Updated an Objective: "Happy Song"', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 'Updated an Objective: "Sad SOng"', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 'Added an objective: "Print COC"', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 'Updated an Objective: "Uy"', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 'Updated an Objective: "A"', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 'Updated an Objective: "B"', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 'Updated an Objective: "FUCK ALEX"', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 'Updated an Objective: "a"', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 'Updated an Objective: "a lex"', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 'Updated an Objective: "FUCK ALEX"', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 'Updated an Objective: "A"', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 'Updated an Objective: "FUCK"', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 'Updated an Objective: "Alex"', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 'Updated an Objective: "FUCK"', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 'Updated an Objective: "A"', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 'Updated an Objective: "ALEX UY"', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 'Updated an Objective: "ytrtyr"', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 'Updated an Objective: "Ensure functional PNP scorecardsss"', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 'Updated an Objective: "Ensure that PABLO keeps quiet and not annoying anyone"', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 'Updated an Objective: "Effectively and Efficiently trashtalk PABLO CANTORIA"', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 'Updated an Objective: "FUCK ALEX UY"', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 'Updated an Objective: "sdfsafdsdfa"', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 'Updated an Objective: "FUCK"', 5, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 'Updated an Objective: "Renaming"', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 'Updated an Objective: "Fucking Dragons"', 5, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 'Updated an Objective: "Learning AngularJS"', 6, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 'Added an objective: "Getting drunk"', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(52, 'Added an objective: "CPMS Objectives"', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(53, 'Updated an Objective: "Ensure that PABLO keeps quiet and not annoy anyone"', 3, 1, '2016-04-12 05:16:06', '2016-04-12 05:16:06'),
(54, 'Added an objective: "to marry"', 1, 0, '2016-04-12 05:28:29', '2016-04-12 05:28:29'),
(55, 'Updated an Objective: "to marry you"', 13, 0, '2016-04-12 05:28:57', '2016-04-12 05:28:57'),
(56, 'Updated an Objective: "CPMS Objective"', 12, 0, '2016-04-12 05:29:31', '2016-04-12 05:29:31'),
(57, 'Added a measure: "My Measures"', 1, 1, '2016-04-27 00:26:09', '2016-04-27 00:26:09'),
(58, 'Added a measure: "My Measure"', 1, 1, '2016-04-27 00:34:21', '2016-04-27 00:34:21'),
(59, 'Added a measure: "My Measure"', 1, 1, '2016-04-27 00:42:17', '2016-04-27 00:42:17'),
(60, 'Updated a measure: "My Measure"', 1, 1, '2016-04-27 00:42:27', '2016-04-27 00:42:27'),
(61, 'Added a measure: "My Measure"', 1, 1, '2016-04-27 00:47:08', '2016-04-27 00:47:08'),
(62, 'Added a measure: "Second measure"', 1, 1, '2016-04-27 00:47:40', '2016-04-27 00:47:40'),
(63, 'Added an objective: "Chief Objective 1"', 1, 1, '2016-05-02 20:34:14', '2016-05-02 20:34:14'),
(64, 'Added an objective: "Chief Objective 1"', 1, 1, '2016-05-02 20:34:18', '2016-05-02 20:34:18'),
(65, 'Added an objective: "Chief Objective 1"', 1, 1, '2016-05-02 20:34:20', '2016-05-02 20:34:20'),
(66, 'Added an objective: "Chief Objective 1"', 1, 1, '2016-05-02 20:34:22', '2016-05-02 20:34:22'),
(67, 'Added an objective: "Chief Objective 1"', 1, 1, '2016-05-02 20:34:22', '2016-05-02 20:34:22'),
(68, 'Added an objective: "Chief Objective 1"', 1, 1, '2016-05-02 20:34:25', '2016-05-02 20:34:25'),
(69, 'Added an objective: "Chief Objective 1"', 1, 1, '2016-05-02 20:34:26', '2016-05-02 20:34:26'),
(70, 'Added an objective: "Chief Objective 1"', 1, 1, '2016-05-02 20:34:27', '2016-05-02 20:34:27'),
(71, 'Added an objective: "Chief Objective 1"', 1, 1, '2016-05-02 20:34:28', '2016-05-02 20:34:28'),
(72, 'Added an objective: "Chief Objective 1"', 1, 1, '2016-05-02 20:34:28', '2016-05-02 20:34:28'),
(73, 'Added an objective: "Chief Objective 1"', 1, 1, '2016-05-02 20:34:29', '2016-05-02 20:34:29'),
(74, 'Added an objective: "Chief Objective 1"', 1, 1, '2016-05-02 20:34:29', '2016-05-02 20:34:29'),
(75, 'Added an objective: "Chief Objective 1"', 1, 1, '2016-05-02 20:34:30', '2016-05-02 20:34:30'),
(76, 'Added an objective: "Chief Objective 1"', 1, 1, '2016-05-02 20:34:30', '2016-05-02 20:34:30'),
(77, 'Added an objective: "Chief Objective 1"', 1, 1, '2016-05-02 20:34:30', '2016-05-02 20:34:30'),
(78, 'Added an objective: "Chief Objective 1"', 1, 1, '2016-05-02 20:34:30', '2016-05-02 20:34:30'),
(79, 'Added an objective: "Chief Objective 1"', 1, 1, '2016-05-02 20:34:31', '2016-05-02 20:34:31'),
(80, 'Added an objective: "Chief Objective 1"', 1, 1, '2016-05-02 20:34:31', '2016-05-02 20:34:31'),
(81, 'Added an objective: "Chief Objective 1"', 1, 1, '2016-05-02 20:34:32', '2016-05-02 20:34:32'),
(82, 'Added an objective: "A safer place to live, work and do business"', 1, 1, '2016-05-02 05:54:30', '2016-05-02 05:54:30'),
(83, 'Added an objective: "A safer place to live, work and do business"', 1, 1, '2016-05-02 05:54:57', '2016-05-02 05:54:57'),
(84, 'Added an objective: "A safer place to live, work and do business"', 1, 1, '2016-05-02 05:55:19', '2016-05-02 05:55:19'),
(85, 'Added an objective: "A safer place to live, work and do business"', 1, 1, '2016-05-02 05:55:28', '2016-05-02 05:55:28'),
(86, 'Added an objective: "A safer place to live, work and do business"', 1, 1, '2016-05-02 05:58:40', '2016-05-02 05:58:40'),
(87, 'Added an objective: "A safer place to live, work and do business"', 1, 1, '2016-05-02 06:00:25', '2016-05-02 06:00:25'),
(88, 'Added an objective: "A safer place to live, work and do business"', 1, 1, '2016-05-02 06:01:18', '2016-05-02 06:01:18'),
(89, 'Added an objective: "A safer place to live, work and do business"', 1, 1, '2016-05-02 06:02:05', '2016-05-02 06:02:05'),
(90, 'Added an objective: "Improve crime prevention"', 1, 1, '2016-05-02 06:02:57', '2016-05-02 06:02:57'),
(91, 'Added an objective: "Improve crime solution"', 1, 1, '2016-05-02 06:03:10', '2016-05-02 06:03:10'),
(92, 'Added an objective: "Improve community safety awareness through community-oriented and human rights-based policing"', 1, 1, '2016-05-02 06:03:40', '2016-05-02 06:03:40'),
(93, 'Added an objective: "Develop Competent, Motivated, Values-oriented and Disciplined police personnel"', 1, 1, '2016-05-02 06:05:11', '2016-05-02 06:05:11'),
(94, 'Added an objective: "Develop a responsive and Highly Professional Police Organization"', 1, 1, '2016-05-02 06:06:10', '2016-05-02 06:06:10'),
(95, 'Added an objective: "Optimize use of financial and logistical resource"', 1, 1, '2016-05-02 06:06:29', '2016-05-02 06:06:29'),
(96, 'Updated an Objective: "Improve crime prevention"', 1, 1, '2016-05-02 06:07:54', '2016-05-02 06:07:54'),
(97, 'Updated an Objective: "Improve crime prevention"', 1, 1, '2016-05-02 06:08:18', '2016-05-02 06:08:18'),
(98, 'Added an objective: "Improve DICTM Crime Solution"', 0, 1, '2016-05-02 07:11:49', '2016-05-02 07:11:49'),
(99, 'Added an objective: "Improve DICTM Crime Solution"', 0, 1, '2016-05-02 07:12:01', '2016-05-02 07:12:01'),
(100, 'Added an objective: "Improve DICTM Crime Solution"', 0, 1, '2016-05-02 07:13:28', '2016-05-02 07:13:28');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chief_objectives`
--

INSERT INTO `chief_objectives` (`ChiefObjectiveID`, `ChiefObjectiveName`, `PerspectiveID`, `UserChiefID`, `ChiefID`, `created_at`, `updated_at`) VALUES
(1, 'A safer place to live, work and do business', 1, 1, 1, '2016-05-02 06:02:05', '2016-05-02 06:02:05'),
(2, 'Improve crime prevention', 3, 1, 1, '2016-05-02 06:02:57', '2016-05-02 06:08:18'),
(3, 'Improve crime solution', 3, 1, 1, '2016-05-02 06:03:10', '2016-05-02 06:03:10'),
(4, 'Improve community safety awareness through community-oriented and human rights-based policing', 3, 1, 1, '2016-05-02 06:03:41', '2016-05-02 06:03:41'),
(5, 'Develop Competent, Motivated, Values-oriented and Disciplined police personnel', 2, 1, 1, '2016-05-02 06:05:11', '2016-05-02 06:05:11'),
(6, 'Develop a responsive and Highly Professional Police Organization', 2, 1, 1, '2016-05-02 06:06:10', '2016-05-02 06:06:10'),
(7, 'Optimize use of financial and logistical resource', 4, 1, 1, '2016-05-02 06:06:29', '2016-05-02 06:06:29');

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
('2016_05_03_012025_create_staff_measures_table', 14);

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
(4, 'Resource Management', '2016-05-02 06:04:23', '2016-05-02 06:04:23');

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
(1, 'Police Director General', 'PDF', 1, '2016-03-14 23:53:37', '2016-03-14 23:53:37'),
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
  `PicturePath` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ChiefID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `staffs`
--

INSERT INTO `staffs` (`StaffID`, `StaffName`, `StaffAbbreviation`, `StaffPermission`, `PicturePath`, `ChiefID`, `created_at`, `updated_at`) VALUES
(1, 'Directorial for Information and Communication Technology Management', 'DICTM', 'none', 'wtHDmDaW3wF7JzDy0zKZwZfxlnUWPVI0.jpeg', 1, '0000-00-00 00:00:00', '2016-05-02 06:31:50'),
(2, 'Center for Police Strategy Management', 'CPSM', '', 'wO3AXldVfjOlQBJlZhpUqSchPfrzLFTX.png', 1, '2016-05-02 06:20:52', '2016-05-02 06:32:17');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `staff_objectives`
--

INSERT INTO `staff_objectives` (`StaffObjectiveID`, `StaffObjectiveName`, `PerspectiveID`, `StaffID`, `UserStaffID`, `ChiefObjectiveID`, `created_at`, `updated_at`) VALUES
(1, 'Improve DICTM Crime Solution', 3, 1, 2, 2, '2016-05-02 07:13:28', '2016-05-02 07:13:28');

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
(2, 'Information Technology Management Service', 'ITMS', 'QDVGLkNEPJwqrJ2am7PaXwYQhdnD2rCN.jpg', 1, '2016-05-02 06:15:06', '2016-05-02 06:16:12');

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
(1, 'Super Administrator', 'usc@cpsm.pnp.gov.ph', '$2y$10$zSC2JGHGr7/A4HbZI/S2mOj4gY6bXd2HkR9sf8YXkojtX4snxTjp2', 'bFROiG1xboguntsv0UBbqmINTQuZALFLjxr4mE8cZC5Qn5aHdjx0soPNdtOt', '2016-03-13 05:42:04', '2016-05-02 06:10:26');

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
(1, 'O-00000', 'Chief', '', 'PNP', '', '', 'chiefpnp', 2, 1, 1, '2016-04-29 00:54:46', '2016-04-29 00:54:46');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_logs`
--

INSERT INTO `user_logs` (`UserLogID`, `UnitUserID`, `LogDateTime`, `LogType`, `IPAddress`, `created_at`, `updated_at`) VALUES
(1, 1, '2016-05-02 14:57:02', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, '2016-05-02 14:57:17', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 0, '2016-05-02 15:08:16', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 2, '2016-05-02 15:09:36', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 0, '2016-05-02 15:20:49', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 1, '2016-05-02 15:21:34', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

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
(1, 'S-12345', 'Jose', 'J.', 'Alvarez', '', 'ridzKRbfOAEJpU0uJ9CAqs0rxwfgZH8v.jpg', 'anton123', 1, 1, 1, '0000-00-00 00:00:00', '2016-05-02 06:30:34'),
(2, 'S-12346', 'Lorenzo', 'Malasig', 'Viovicente', '', 'npddunnpRv13rPYyaozfaTCrFaNuyRbY.jpg', 'lorenzo', 4, 1, 1, '2016-05-02 06:30:20', '2016-05-02 06:30:20'),
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
(1, 'U-12345', 'Rock Well', '', 'Ramos', '', 'XEGpUuVo6IGUZou3mzlyPTynrJM4XUti.jpg', 'akwe123', 10, 2, 1, '2016-05-02 06:34:37', '2016-05-02 06:34:37');

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
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`UnitID`),
  ADD UNIQUE KEY `units_unitname_unique` (`UnitName`),
  ADD UNIQUE KEY `units_unitabbreviation_unique` (`UnitAbbreviation`);

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
  MODIFY `AuditTrailID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=101;
--
-- AUTO_INCREMENT for table `chiefs`
--
ALTER TABLE `chiefs`
  MODIFY `ChiefID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `chief_measures`
--
ALTER TABLE `chief_measures`
  MODIFY `ChiefMeasureID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `chief_objectives`
--
ALTER TABLE `chief_objectives`
  MODIFY `ChiefObjectiveID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
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
-- AUTO_INCREMENT for table `staff_measures`
--
ALTER TABLE `staff_measures`
  MODIFY `StaffMeasureID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `staff_objectives`
--
ALTER TABLE `staff_objectives`
  MODIFY `StaffObjectiveID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `UnitID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
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
  MODIFY `UserLogID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
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
