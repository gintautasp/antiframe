-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 06, 2020 at 01:15 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webtools_buhalt`
--

-- --------------------------------------------------------

--
-- Table structure for table `dat_params`
--

CREATE TABLE `dat_params` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(64) COLLATE utf8_lithuanian_ci NOT NULL,
  `www_lt_name` varchar(254) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(253) COLLATE utf8_lithuanian_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Dumping data for table `dat_params`
--

INSERT INTO `dat_params` (`id`, `name`, `www_lt_name`, `value`) VALUES
(1, 'jsValidate', 'js duomenų kontrolė', '1');

-- --------------------------------------------------------

--
-- Table structure for table `log_sent_emails`
--

CREATE TABLE `log_sent_emails` (
  `id` int(11) NOT NULL,
  `to` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_body` text COLLATE utf8_unicode_ci NOT NULL,
  `header` varchar(1023) COLLATE utf8_unicode_ci NOT NULL,
  `sent_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sent_status` tinyint(3) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `log_sent_emails`
--

-- --------------------------------------------------------

--
-- Table structure for table `sys_groups`
--

CREATE TABLE `sys_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(63) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `sys_groups`
--

INSERT INTO `sys_groups` (`id`, `name`) VALUES
(1, 'registration_questions'),
(2, 'visitors');

-- --------------------------------------------------------

--
-- Table structure for table `usr_possibilities`
--

CREATE TABLE `usr_possibilities` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usr_possibilities`
--

INSERT INTO `usr_possibilities` (`id`, `name`) VALUES
(4, 'login'),
(5, 'admin'),
(6, 'add_company'),
(7, 'modify_company'),
(8, 'delete_company'),
(9, 'confirm_account'),
(10, 'all'),
(11, 'part'),
(12, 'min');

-- --------------------------------------------------------

--
-- Table structure for table `usr_users`
--

CREATE TABLE `usr_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(63) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `password_strength` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `real_name` varchar(31) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(63) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `position` varchar(127) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `question` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `answer` varchar(127) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(31) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `email` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `other` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `send_news` tinyint(1) NOT NULL DEFAULT '0',
  `confirm_link` varchar(60) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `user_lang` char(2) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `register_time` datetime DEFAULT NULL,
  `confirmation_time` datetime DEFAULT NULL,
  `last_profile_update_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Table structure for table `usr_users_possibilities`
--

CREATE TABLE `usr_users_possibilities` (
  `id_possibility` int(10) UNSIGNED NOT NULL,
  `id_user` int(10) UNSIGNED NOT NULL,
  `can` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usr_users_possibilities`
--

-- --------------------------------------------------------

--
-- Table structure for table `usr_users_visits`
--

CREATE TABLE `usr_users_visits` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_user` int(10) UNSIGNED NOT NULL,
  `id_visits` int(10) UNSIGNED NOT NULL,
  `user_status` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `recognition_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `www_selectors`
--

CREATE TABLE `www_selectors` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_group` int(10) UNSIGNED NOT NULL,
  `num_on_group` int(11) NOT NULL,
  `name_en` varchar(254) COLLATE utf8_unicode_ci NOT NULL,
  `name_lt` varchar(254) COLLATE utf8_unicode_ci NOT NULL,
  `name_ru` varchar(254) COLLATE utf8_unicode_ci NOT NULL,
  `name_de` varchar(254) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `www_selectors`
--

INSERT INTO `www_selectors` (`id`, `id_group`, `num_on_group`, `name_en`, `name_lt`, `name_ru`, `name_de`) VALUES
(3, 1, 1, 'Your best childhood friend', 'Jūsų geriausias vaikystės draugas(ė)', 'Ваш лучший друг детства', ''),
(4, 1, 2, 'Your favorite food', 'Jūsų mėgstamiausias valgis', 'Ваше любимое блюдо', ''),
(5, 1, 3, 'Your favorite services company', 'Jums labiausiai patinkanti paslaugų kompanija', 'Ваша любимая Компания Услуг', ''),
(6, 1, 4, 'The happiest event in your life', 'Džiaugsmingiausias įvykis Jūsų gyvenime', 'Самое счастливое событие в вашей жизни', ''),
(7, 2, 1, 'own', 'nuosavi', 'sobstvennyje', ''),
(8, 2, 2, 'aquitance', 'artimieji', 'blizkije', ''),
(9, 2, 3, 'crawlers', 'robotai', 'roboty', ''),
(10, 2, 4, 'other', 'kiti', 'drugije', '');

-- --------------------------------------------------------

--
-- Table structure for table `www_visits`
--

CREATE TABLE `www_visits` (
  `id` int(11) NOT NULL,
  `client_software` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `ip_address` varchar(127) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `session_id` varchar(32) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `clicks` int(11) NOT NULL DEFAULT '1',
  `time_finish` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `time_start` datetime NOT NULL,
  `id_user` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `user_status` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `country_code` varchar(2) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `location_obj` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `js_enabled_on_start` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `navigator_info` varchar(510) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `jtm` bigint(20) UNSIGNED NOT NULL DEFAULT '1351720800000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;


-- Indexes for dumped tables
--

--
-- Indexes for table `dat_params`
--
ALTER TABLE `dat_params`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unii` (`name`);

--
-- Indexes for table `log_sent_emails`
--
ALTER TABLE `log_sent_emails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `to` (`to`,`sent_date`),
  ADD KEY `sent_staus` (`sent_status`);

--
-- Indexes for table `sys_groups`
--
ALTER TABLE `sys_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usr_possibilities`
--
ALTER TABLE `usr_possibilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usr_users`
--
ALTER TABLE `usr_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`,`send_news`,`active`);

--
-- Indexes for table `usr_users_possibilities`
--
ALTER TABLE `usr_users_possibilities`
  ADD KEY `id_possibility` (`id_possibility`,`id_user`);

--
-- Indexes for table `usr_users_visits`
--
ALTER TABLE `usr_users_visits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `user_status` (`user_status`,`recognition_time`);

--
-- Indexes for table `www_selectors`
--
ALTER TABLE `www_selectors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `group` (`id_group`,`num_on_group`),
  ADD KEY `id_group` (`id_group`,`num_on_group`);

--
-- Indexes for table `www_visits`
--
ALTER TABLE `www_visits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `country_code` (`country_code`),
  ADD KEY `user` (`id_user`),
  ADD KEY `ip` (`ip_address`),
  ADD KEY `visits_main` (`client_software`,`ip_address`),
  ADD KEY `js_enabled_on_start` (`js_enabled_on_start`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dat_params`
--
ALTER TABLE `dat_params`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `log_sent_emails`
--
ALTER TABLE `log_sent_emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `sys_groups`
--
ALTER TABLE `sys_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `usr_possibilities`
--
ALTER TABLE `usr_possibilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `usr_users`
--
ALTER TABLE `usr_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `usr_users_visits`
--
ALTER TABLE `usr_users_visits`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2107;

--
-- AUTO_INCREMENT for table `www_selectors`
--
ALTER TABLE `www_selectors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `www_visits`
--
ALTER TABLE `www_visits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3962;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
