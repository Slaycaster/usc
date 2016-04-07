-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2016 at 11:17 AM
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
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `audit_trails`
--

INSERT INTO `audit_trails` (`AuditTrailID`, `Action`, `UserUnitID`, `created_at`, `updated_at`) VALUES
(1, '0', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Added an objective: "Effectively and Efficiently trashtalk PABLO CANTORIA III"', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Added an objective: \\"FUCK ALEX UY\\"', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Added an objective: "FUCKALEXUY"', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Updated an Objective: "FUCK ALEX UY fucker"', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE IF NOT EXISTS `divisions` (
  `DivisionID` int(10) unsigned NOT NULL,
  `DivisionName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `DivisionAbbreviation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `DivisionPicturePath` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UnitID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`DivisionID`, `DivisionName`, `DivisionAbbreviation`, `DivisionPicturePath`, `UnitID`, `created_at`, `updated_at`) VALUES
(1, 'Organizational Alignment Division', 'OAD', '', 1, '2016-03-14 23:34:56', '2016-03-14 23:34:56');

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
('2016_04_07_084303_create_audit_trails_table', 11);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

CREATE TABLE IF NOT EXISTS `ranks` (
  `RankID` int(10) unsigned NOT NULL,
  `RankName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `RankCode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Hierarchy` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

CREATE TABLE IF NOT EXISTS `regions` (
  `RegionID` int(10) unsigned NOT NULL,
  `RegionName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `RegionAbbreviation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`RegionID`, `RegionName`, `RegionAbbreviation`, `created_at`, `updated_at`) VALUES
(1, 'National Capital Region', 'NCR', '2016-03-14 21:56:53', '2016-03-14 21:56:53');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE IF NOT EXISTS `units` (
  `UnitID` int(10) unsigned NOT NULL,
  `UnitName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UnitAbbreviation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `PicturePath` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `RegionID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`UnitID`, `UnitName`, `UnitAbbreviation`, `PicturePath`, `RegionID`, `created_at`, `updated_at`) VALUES
(1, 'Center for Police Strategic Management', 'CPSM', 'J2L1NQVJteQmEqfY3ny5qQ1Mw7y66mqF.png', 1, '2016-03-14 23:07:40', '2016-04-05 01:07:35');

-- --------------------------------------------------------

--
-- Table structure for table `unit_measures`
--

CREATE TABLE IF NOT EXISTS `unit_measures` (
  `UnitMeasureID` int(10) unsigned NOT NULL,
  `UnitMeasureName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UnitID` int(11) NOT NULL,
  `UserUnitID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `unit_measures`
--

INSERT INTO `unit_measures` (`UnitMeasureID`, `UnitMeasureName`, `UnitID`, `UserUnitID`, `created_at`, `updated_at`) VALUES
(1, 'No of pretty girls', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'No. of Hot Girls', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `unit_objectives`
--

INSERT INTO `unit_objectives` (`UnitObjectiveID`, `UnitObjectiveName`, `PerspectiveID`, `UnitID`, `UserUnitID`, `created_at`, `updated_at`) VALUES
(1, 'FUCK ALEX UY fucker', 1, 1, 1, '2016-03-15 11:36:37', '2016-04-07 01:13:39'),
(2, 'Ensure functional PNP scorecard', 2, 1, 1, '2016-04-05 00:46:32', '2016-04-05 00:46:32'),
(3, 'Ensure that PABLO keeps quiet and not annoying anyone', 2, 1, 1, '2016-04-07 01:06:15', '2016-04-07 01:06:15'),
(4, 'Effectively and Efficiently trashtalk PABLO CANTORIA III', 3, 1, 1, '2016-04-07 01:09:30', '2016-04-07 01:09:30'),
(5, 'FUCK ALEX UY', 3, 1, 1, '2016-04-07 01:10:57', '2016-04-07 01:10:57'),
(6, 'FUCKALEXUY', 3, 1, 1, '2016-04-07 01:11:43', '2016-04-07 01:11:43');

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
(1, 'Super Administrator', 'usc@cpsm.pnp.gov.ph', '$2y$10$zSC2JGHGr7/A4HbZI/S2mOj4gY6bXd2HkR9sf8YXkojtX4snxTjp2', 'zyLyAmbbDmaUbQ5PciI6sTOZxB0JD6tBknDRWY0TCpngyC60YoPfSqRjhpc1', '2016-03-13 05:42:04', '2016-04-05 01:48:05');

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
(1, 1, '2016-04-07 08:29:11', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, '2016-04-07 08:32:22', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 1, '2016-04-07 08:33:30', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 1, '2016-04-07 08:34:40', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 1, '2016-04-07 08:38:43', 'Logout', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 1, '2016-04-07 08:38:59', 'Login', '::1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

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
  MODIFY `AuditTrailID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `DivisionID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `perspectives`
--
ALTER TABLE `perspectives`
  MODIFY `PerspectiveID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ranks`
--
ALTER TABLE `ranks`
  MODIFY `RankID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `RegionID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `UnitID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `unit_measures`
--
ALTER TABLE `unit_measures`
  MODIFY `UnitMeasureID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `unit_objectives`
--
ALTER TABLE `unit_objectives`
  MODIFY `UnitObjectiveID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user_logs`
--
ALTER TABLE `user_logs`
  MODIFY `UserLogID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `user_units`
--
ALTER TABLE `user_units`
  MODIFY `UserUnitID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
