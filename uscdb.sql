-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 12, 2016 at 01:42 PM
-- Server version: 10.0.17-MariaDB
-- PHP Version: 5.6.14

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

CREATE TABLE `audit_trails` (
  `AuditTrailID` int(10) UNSIGNED NOT NULL,
  `Action` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UserUnitID` int(11) NOT NULL,
  `UnitID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(56, 'Updated an Objective: "CPMS Objective"', 12, 0, '2016-04-12 05:29:31', '2016-04-12 05:29:31');

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `DivisionID` int(10) UNSIGNED NOT NULL,
  `DivisionName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `DivisionAbbreviation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `DivisionPicturePath` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UnitID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`DivisionID`, `DivisionName`, `DivisionAbbreviation`, `DivisionPicturePath`, `UnitID`, `created_at`, `updated_at`) VALUES
(1, 'Organizational Alignment Division', 'OAD', '', 1, '2016-03-14 23:34:56', '2016-03-14 23:34:56');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
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
('2016_04_07_084303_create_audit_trails_table', 11);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `perspectives`
--

CREATE TABLE `perspectives` (
  `PerspectiveID` int(10) UNSIGNED NOT NULL,
  `PerspectiveName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `perspectives`
--

INSERT INTO `perspectives` (`PerspectiveID`, `PerspectiveName`, `created_at`, `updated_at`) VALUES
(1, 'Community', '2016-03-14 21:36:20', '2016-03-14 21:36:35'),
(2, 'Learning and Growth', '2016-03-14 21:38:53', '2016-03-14 21:38:53'),
(3, 'Process Excellence', '2016-04-05 00:49:03', '2016-04-05 00:49:03');

-- --------------------------------------------------------

--
-- Table structure for table `ranks`
--

CREATE TABLE `ranks` (
  `RankID` int(10) UNSIGNED NOT NULL,
  `RankName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `RankCode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Hierarchy` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(10, 'Non Uniformed Personnel', 'NUP', 10, '2016-03-14 23:57:04', '2016-03-14 23:57:04'),
(11, 'Senior Police Officer 4', 'SPO4', 11, '2016-03-14 23:57:25', '2016-03-14 23:57:25');

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `RegionID` int(10) UNSIGNED NOT NULL,
  `RegionName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `RegionAbbreviation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`RegionID`, `RegionName`, `RegionAbbreviation`, `created_at`, `updated_at`) VALUES
(1, 'National Capital Region', 'NCR', '2016-03-14 21:56:53', '2016-03-14 21:56:53');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `UnitID` int(10) UNSIGNED NOT NULL,
  `UnitName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UnitAbbreviation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `PicturePath` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `RegionID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`UnitID`, `UnitName`, `UnitAbbreviation`, `PicturePath`, `RegionID`, `created_at`, `updated_at`) VALUES
(1, 'Center for Police Strategic Management', 'CPSM', 'J2L1NQVJteQmEqfY3ny5qQ1Mw7y66mqF.png', 1, '2016-03-14 23:07:40', '2016-04-05 01:07:35');

-- --------------------------------------------------------

--
-- Table structure for table `unit_measures`
--

CREATE TABLE `unit_measures` (
  `UnitMeasureID` int(10) UNSIGNED NOT NULL,
  `UnitMeasureName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UnitMeasureType` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UnitID` int(11) NOT NULL,
  `UserUnitID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `unit_measures`
--

INSERT INTO `unit_measures` (`UnitMeasureID`, `UnitMeasureName`, `UnitMeasureType`, `UnitID`, `UserUnitID`, `created_at`, `updated_at`) VALUES
(1, 'No of handsome guys', 'LD', 1, 1, '0000-00-00 00:00:00', '2016-04-08 20:23:12'),
(2, 'No. of Hot Guys', 'LG', 1, 1, '0000-00-00 00:00:00', '2016-04-08 20:22:21'),
(5, 'No. of Handsome in Quezon City', 'LD', 1, 1, '2016-04-07 22:54:44', '2016-04-08 01:21:12'),
(6, 'No of weeds', 'LG', 1, 1, '2016-04-07 23:44:20', '2016-04-07 23:44:20'),
(7, 'No. of girls', 'LG', 1, 1, '2016-04-08 01:11:37', '2016-04-08 20:22:33'),
(8, 'No. of weeks present', 'LG', 1, 1, '2016-04-08 20:22:52', '2016-04-08 20:22:52'),
(9, 'No. of horses', 'LD', 1, 1, '2016-04-09 04:19:24', '2016-04-10 21:45:56'),
(10, 'No. of Bounties', 'LD', 1, 1, '2016-04-09 05:35:58', '2016-04-10 22:29:25'),
(11, 'Pixel per inch', 'LD', 1, 1, '2016-04-10 22:30:07', '2016-04-10 22:30:23'),
(12, 'dummy', 'LD', 1, 1, '2016-04-11 21:26:47', '2016-04-11 21:26:47');

-- --------------------------------------------------------

--
-- Table structure for table `unit_objectives`
--

CREATE TABLE `unit_objectives` (
  `UnitObjectiveID` int(10) UNSIGNED NOT NULL,
  `UnitObjectiveName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `PerspectiveID` int(11) NOT NULL,
  `UnitID` int(11) NOT NULL,
  `UserUnitID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `unit_objectives`
--

INSERT INTO `unit_objectives` (`UnitObjectiveID`, `UnitObjectiveName`, `PerspectiveID`, `UnitID`, `UserUnitID`, `created_at`, `updated_at`) VALUES
(1, 'Renaming', 1, 1, 1, '2016-03-15 11:36:37', '2016-04-10 22:28:49'),
(2, 'Ensure functional PNP scorecard', 2, 1, 1, '2016-04-05 00:46:32', '2016-04-05 00:46:32'),
(3, 'Ensure that PABLO keeps quiet and not annoy anyone', 1, 1, 1, '2016-04-07 01:06:15', '2016-04-11 21:16:06'),
(4, 'Effectively and Efficiently trashtalk PABLO CANTORIA III', 3, 1, 1, '2016-04-07 01:09:30', '2016-04-07 01:09:30'),
(5, 'Fucking Dragons', 2, 1, 1, '2016-04-07 01:10:57', '2016-04-10 22:28:59'),
(6, 'Learning AngularJS', 3, 1, 1, '2016-04-07 01:11:43', '2016-04-10 22:29:12'),
(7, 'Finish Unit Dashboard', 2, 1, 1, '2016-04-07 23:54:05', '2016-04-07 23:54:05'),
(8, 'Happy Song', 3, 1, 1, '2016-04-08 19:46:30', '2016-04-08 19:46:30'),
(9, 'Sing a Happy Song', 1, 1, 1, '2016-04-09 04:25:39', '2016-04-09 04:25:39'),
(10, 'Print COC', 2, 1, 1, '2016-04-10 21:24:12', '2016-04-10 21:24:12'),
(11, 'Getting drunk', 1, 1, 1, '2016-04-10 22:29:43', '2016-04-10 22:29:43'),
(12, 'CPMS Objective', 3, 1, 1, '2016-04-10 22:39:52', '2016-04-11 21:29:31'),
(13, 'to marry you', 2, 1, 1, '2016-04-11 21:28:29', '2016-04-11 21:28:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Administrator', 'usc@cpsm.pnp.gov.ph', '$2y$10$zSC2JGHGr7/A4HbZI/S2mOj4gY6bXd2HkR9sf8YXkojtX4snxTjp2', 'zyLyAmbbDmaUbQ5PciI6sTOZxB0JD6tBknDRWY0TCpngyC60YoPfSqRjhpc1', '2016-03-13 05:42:04', '2016-04-05 01:48:05');

-- --------------------------------------------------------

--
-- Table structure for table `user_logs`
--

CREATE TABLE `user_logs` (
  `UserLogID` int(10) UNSIGNED NOT NULL,
  `UnitUserID` int(11) NOT NULL,
  `LogDateTime` datetime NOT NULL,
  `LogType` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `IPAddress` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_logs`
--

INSERT INTO `user_logs` (`UserLogID`, `UnitUserID`, `LogDateTime`, `LogType`, `IPAddress`, `created_at`, `updated_at`) VALUES
(1, 1, '2016-04-07 08:29:11', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, '2016-04-07 08:32:22', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 1, '2016-04-07 08:33:30', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 1, '2016-04-07 08:34:40', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 1, '2016-04-07 08:38:43', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 1, '2016-04-07 08:38:59', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 1, '2016-04-08 05:34:34', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 1, '2016-04-08 07:08:22', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 1, '2016-04-08 07:10:34', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 1, '2016-04-08 07:17:01', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 1, '2016-04-08 07:17:16', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 1, '2016-04-08 07:17:19', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 1, '2016-04-08 07:18:24', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 1, '2016-04-08 07:18:27', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 1, '2016-04-08 07:21:09', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 1, '2016-04-08 07:23:52', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 1, '2016-04-08 07:43:49', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 1, '2016-04-08 07:49:55', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 1, '2016-04-08 07:51:01', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 1, '2016-04-08 07:56:56', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 1, '2016-04-08 08:12:24', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 1, '2016-04-08 08:13:38', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 1, '2016-04-08 08:36:05', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 1, '2016-04-08 08:36:16', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 1, '2016-04-08 08:37:05', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 1, '2016-04-08 08:38:06', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 1, '2016-04-08 08:41:02', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 1, '2016-04-08 09:31:27', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 1, '2016-04-08 09:31:36', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 1, '2016-04-08 09:45:59', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 1, '2016-04-08 09:49:36', 'Login', '192.168.33.119', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 1, '2016-04-08 09:52:43', 'Logout', '192.168.33.119', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 1, '2016-04-09 03:38:04', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 1, '2016-04-09 04:05:06', 'Login', '192.168.1.136', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 1, '2016-04-09 04:45:27', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 0, '2016-04-09 04:47:20', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 1, '2016-04-09 04:51:27', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 1, '2016-04-09 04:51:39', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 1, '2016-04-09 04:53:17', 'Logout', '192.168.1.136', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 1, '2016-04-09 04:57:53', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 1, '2016-04-09 04:58:18', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 1, '2016-04-09 04:58:46', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 1, '2016-04-09 06:23:11', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 1, '2016-04-09 07:05:23', 'Login', '192.168.1.136', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 1, '2016-04-09 07:09:36', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 1, '2016-04-09 07:10:16', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 1, '2016-04-09 07:22:06', 'Logout', '192.168.1.136', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 1, '2016-04-09 07:22:50', 'Login', '192.168.1.136', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 1, '2016-04-09 10:36:00', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 1, '2016-04-09 11:13:02', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 1, '2016-04-09 11:14:28', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(52, 1, '2016-04-09 11:14:44', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(53, 1, '2016-04-09 11:18:03', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(54, 1, '2016-04-09 11:36:03', 'Login', '192.168.1.136', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(55, 1, '2016-04-09 13:05:14', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(56, 1, '2016-04-09 13:05:29', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(57, 1, '2016-04-09 13:34:12', 'Logout', '127.0.0.1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(58, 1, '2016-04-09 13:34:44', 'Login', '127.0.0.1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(59, 1, '2016-04-09 13:35:31', 'Login', '127.0.0.1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(60, 1, '2016-04-09 13:36:38', 'Logout', '127.0.0.1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(61, 1, '2016-04-09 13:38:51', 'Login', '127.0.0.1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(62, 1, '2016-04-09 13:42:28', 'Login', '192.168.1.136', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(63, 1, '2016-04-09 13:44:57', 'Logout', '192.168.1.136', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(64, 1, '2016-04-09 13:47:15', 'Login', '192.168.1.136', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(65, 1, '2016-04-09 13:53:15', 'Logout', '192.168.1.136', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(66, 1, '2016-04-09 13:53:40', 'Login', '192.168.1.136', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(67, 1, '2016-04-09 14:14:27', 'Logout', '127.0.0.1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(68, 1, '2016-04-09 14:16:57', 'Login', '127.0.0.1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(69, 1, '2016-04-11 01:46:11', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(70, 1, '2016-04-11 05:14:30', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(71, 1, '2016-04-12 01:41:16', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_units`
--

CREATE TABLE `user_units` (
  `UserUnitID` int(10) UNSIGNED NOT NULL,
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
-- Dumping data for table `user_units`
--

INSERT INTO `user_units` (`UserUnitID`, `UserUnitBadgeNumber`, `UserUnitFirstName`, `UserUnitMiddleName`, `UserUnitLastName`, `UserUnitQualifier`, `UserUnitPicturePath`, `UserUnitPassword`, `RankID`, `UnitID`, `UserUnitIsActive`, `created_at`, `updated_at`) VALUES
(1, 'P-12345', 'Ador', '', 'de Leon', '', 'u9s2HpG9U4UKVUFylFqyUhg79AfdcdrA.jpg', 'cardo008', 8, 1, 1, '2016-03-15 05:17:36', '2016-03-15 05:24:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit_trails`
--
ALTER TABLE `audit_trails`
  ADD PRIMARY KEY (`AuditTrailID`);

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`DivisionID`),
  ADD UNIQUE KEY `divisions_divisionname_unique` (`DivisionName`),
  ADD UNIQUE KEY `divisions_divisionabbreviation_unique` (`DivisionAbbreviation`);

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
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`RegionID`),
  ADD UNIQUE KEY `regions_regionname_unique` (`RegionName`),
  ADD UNIQUE KEY `regions_regionabbreviation_unique` (`RegionAbbreviation`);

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
-- Indexes for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD PRIMARY KEY (`UserLogID`);

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
  MODIFY `AuditTrailID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `DivisionID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `perspectives`
--
ALTER TABLE `perspectives`
  MODIFY `PerspectiveID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ranks`
--
ALTER TABLE `ranks`
  MODIFY `RankID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `RegionID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `UnitID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `unit_measures`
--
ALTER TABLE `unit_measures`
  MODIFY `UnitMeasureID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `unit_objectives`
--
ALTER TABLE `unit_objectives`
  MODIFY `UnitObjectiveID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user_logs`
--
ALTER TABLE `user_logs`
  MODIFY `UserLogID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT for table `user_units`
--
ALTER TABLE `user_units`
  MODIFY `UserUnitID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
