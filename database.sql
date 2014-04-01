-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 31, 2014 at 08:17 PM
-- Server version: 5.5.36-MariaDB
-- PHP Version: 5.5.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hackaton_seguridad`
--

-- --------------------------------------------------------

--
-- Table structure for table `BroadcastNumbers`
--

CREATE TABLE IF NOT EXISTS `BroadcastNumbers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone_number` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `BroadcastNumbers`
--

INSERT INTO `BroadcastNumbers` (`id`, `phone_number`) VALUES
(1, '50497211420'),
(2, '50495936389');

-- --------------------------------------------------------

--
-- Table structure for table `case_comments`
--

CREATE TABLE IF NOT EXISTS `case_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `crime_case_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_case_comments_crime_case1_idx` (`crime_case_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `case_comments`
--

INSERT INTO `case_comments` (`id`, `comment`, `created_at`, `crime_case_id`) VALUES
(1, 'Prueba comentario 1', NULL, 15),
(2, 'Prueba 2', NULL, 15),
(3, 'Comentario 3', NULL, 15);

-- --------------------------------------------------------

--
-- Table structure for table `case_mt_responses`
--

CREATE TABLE IF NOT EXISTS `case_mt_responses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `dest_address` varchar(45) NOT NULL,
  `sent_time` datetime NOT NULL,
  `crime_cases_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_case_mt_responses_crime_cases1_idx` (`crime_cases_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `crime_cases`
--

CREATE TABLE IF NOT EXISTS `crime_cases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(45) NOT NULL,
  `description` longtext,
  `message_mo_id` int(11) DEFAULT NULL,
  `crime_category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_crime_case_message_mo1_idx` (`message_mo_id`),
  KEY `IDX_154CBB139ACF468D` (`crime_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `crime_cases`
--

INSERT INTO `crime_cases` (`id`, `status`, `description`, `message_mo_id`, `crime_category_id`) VALUES
(15, 'new', NULL, 75, 2),
(20, 'new', NULL, 101, 1),
(21, 'uncompleted', NULL, 108, NULL),
(22, 'uncompleted', NULL, 109, 2),
(23, 'uncompleted', NULL, 113, NULL),
(24, 'uncompleted', NULL, 114, NULL),
(25, 'uncompleted', NULL, 115, NULL),
(26, 'new', NULL, 116, 2);

-- --------------------------------------------------------

--
-- Table structure for table `crime_categories`
--

CREATE TABLE IF NOT EXISTS `crime_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `crime_categories`
--

INSERT INTO `crime_categories` (`id`, `name`) VALUES
(1, 'Robo de Vehiculo'),
(2, 'Venta de Drogas');

-- --------------------------------------------------------

--
-- Table structure for table `crime_questions`
--

CREATE TABLE IF NOT EXISTS `crime_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) NOT NULL,
  `question_number` int(11) NOT NULL,
  `type` varchar(45) NOT NULL,
  `crime_category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_category_question_crime_category_idx` (`crime_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `crime_questions`
--

INSERT INTO `crime_questions` (`id`, `question`, `question_number`, `type`, `crime_category_id`) VALUES
(1, 'Sector', 1, 'LIST', 2),
(2, 'Barrio o Colonia', 2, 'OPEN', 2),
(3, 'Calles y Avenidas', 3, 'OPEN', 2),
(4, 'Forma de venta', 4, 'OPEN', 2),
(5, 'Tipo de Droga', 5, 'LIST', 2),
(6, 'Lugar del robo', 1, 'OPEN', 1),
(7, 'Color del carro', 2, 'OPEN', 1),
(8, 'Marca', 3, 'OPEN', 1),
(9, 'Modelo', 4, 'OPEN', 1),
(10, 'Placa', 5, 'OPEN', 1);

-- --------------------------------------------------------

--
-- Table structure for table `crime_question_answers`
--

CREATE TABLE IF NOT EXISTS `crime_question_answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `answer` varchar(255) NOT NULL,
  `sent_questions_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_crime_question_answers_sent_questions1_idx` (`sent_questions_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `crime_question_answers`
--

INSERT INTO `crime_question_answers` (`id`, `answer`, `sent_questions_id`) VALUES
(20, '3', 22),
(21, 'lempira', 23),
(22, '10 calle 13 avenida', 24),
(23, 'puesto callejero', 25),
(24, '3', 26),
(34, 'mi casa', 35),
(35, 'gris', 36),
(36, 'ford', 37),
(37, 'ranger', 38),
(38, '980000', 39),
(39, '1', 40),
(40, 'por ahi', 41),
(41, '3', 43),
(42, 'lempira', 44),
(43, '9 ave', 45),
(44, 'drah', 46),
(45, '2', 47);

-- --------------------------------------------------------

--
-- Table structure for table `crime_question_options`
--

CREATE TABLE IF NOT EXISTS `crime_question_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option` varchar(255) NOT NULL,
  `option_number` int(11) NOT NULL,
  `crime_questions_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_question_number` (`option_number`,`crime_questions_id`),
  KEY `fk_crime_question_options_crime_questions1_idx` (`crime_questions_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `crime_question_options`
--

INSERT INTO `crime_question_options` (`id`, `option`, `option_number`, `crime_questions_id`) VALUES
(1, 'Nor Oeste', 1, 1),
(2, 'Nor Este', 2, 1),
(3, 'Sur Oeste', 3, 1),
(4, 'Sur Este', 4, 1),
(5, 'Marihuana', 1, 5),
(6, 'Cocaina', 2, 5),
(7, 'Crack', 3, 5),
(8, 'Ectasy', 4, 5),
(9, 'Otro', 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `GeneralQuestion`
--

CREATE TABLE IF NOT EXISTS `GeneralQuestion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `question_number` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `messages_mo`
--

CREATE TABLE IF NOT EXISTS `messages_mo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `source_address` varchar(45) NOT NULL,
  `received_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=123 ;

--
-- Dumping data for table `messages_mo`
--

INSERT INTO `messages_mo` (`id`, `message`, `source_address`, `received_time`) VALUES
(1, 'TestMessage', '50497033669', '2014-03-29 16:15:42'),
(2, 'TestMessage2', '50497033669', '2014-03-29 16:15:42'),
(3, 'Test altia 7', '+50494797200', '2014-03-28 09:02:59'),
(4, 'TestMessage2', '50497033669', '2014-03-29 17:27:47'),
(5, 'Test altia 8', '+50494797200', '2014-03-29 17:28:41'),
(6, 'SMS1', '50494797200', '2014-03-30 09:17:58'),
(7, 'SMS1', '50494797200', '2014-03-30 09:18:42'),
(8, 'denuncia', '50494797200', '2014-03-30 09:19:17'),
(9, 'denuncia', '50494797200', '2014-03-30 09:21:43'),
(10, 'SMS1', '50494797200', '2014-03-30 09:28:33'),
(11, 'SMS1', '50494797200', '2014-03-30 09:29:46'),
(12, 'SMS1', '50494797200', '2014-03-30 09:29:51'),
(13, 'SMS1', '50494797200', '2014-03-30 09:29:58'),
(14, 'SMS1', '50494797200', '2014-03-30 09:30:04'),
(15, 'denuncia', '50494797200', '2014-03-30 09:30:17'),
(16, 'denuncia', '50494797200', '2014-03-30 09:31:00'),
(17, 'denuncia', '50494797200', '2014-03-30 09:34:24'),
(18, 'denuncia', '50494797200', '2014-03-30 09:35:54'),
(19, 'denuncia', '50494797200', '2014-03-30 09:36:12'),
(20, 'denuncia', '50494797200', '2014-03-30 09:46:32'),
(21, 'SMS', '50494797200', '2014-03-30 09:49:05'),
(22, 'SMS', '50494797200', '2014-03-30 09:52:03'),
(23, 'SMS', '50494797200', '2014-03-30 09:52:28'),
(24, 'SMS', '50494797200', '2014-03-30 09:53:15'),
(25, 'SMS', '50494797200', '2014-03-30 09:55:22'),
(26, 'SMS', '50494797200', '2014-03-30 09:56:38'),
(27, 'SMS', '50494797200', '2014-03-30 09:58:24'),
(28, 'SMS', '50494797200', '2014-03-30 09:58:48'),
(29, 'SMS', '50494797200', '2014-03-30 09:59:10'),
(30, '1', '50494797200', '2014-03-30 10:00:45'),
(31, 'sas', '50494797200', '2014-03-30 10:33:38'),
(32, 'sas', '50494797200', '2014-03-30 10:34:21'),
(33, '1', '50494797200', '2014-03-30 10:35:18'),
(34, '1', '50494797200', '2014-03-30 10:37:36'),
(35, '1', '50494797200', '2014-03-30 10:38:49'),
(36, '1', '50494797200', '2014-03-30 10:48:19'),
(37, 'Barrio Medina', '50494797200', '2014-03-30 10:49:36'),
(38, 'Barrio Medina', '50494797200', '2014-03-30 10:50:32'),
(39, 'Barrio Medina', '50494797200', '2014-03-30 10:53:38'),
(40, 'Barrio Medina', '50494797200', '2014-03-30 10:55:15'),
(41, 'Barrio Medina', '50494797200', '2014-03-30 10:58:12'),
(42, 'Barrio Medina', '50494797200', '2014-03-30 10:58:31'),
(43, 'Barrio Medina', '50494797200', '2014-03-30 11:00:27'),
(44, 'Barrio Medina', '50494797200', '2014-03-30 11:01:35'),
(45, 'azul', '50494797200', '2014-03-30 11:02:14'),
(46, 'Ford', '50494797200', '2014-03-30 11:02:24'),
(47, 'Ranger', '50494797200', '2014-03-30 11:02:34'),
(48, 'JSHX328932SD', '50494797200', '2014-03-30 11:02:53'),
(49, 'Denuncia', '+50494797200', '2014-03-30 11:08:26'),
(50, '/$', '+50494797200', '2014-03-30 11:08:47'),
(51, '2', '+50494797200', '2014-03-30 11:08:59'),
(52, 'Nor oeste', '+50494797200', '2014-03-30 11:09:22'),
(53, '1', '+50494797200', '2014-03-30 11:09:39'),
(54, '2', '+50494797200', '2014-03-30 11:10:06'),
(55, 'Denuncia', '+50494797200', '2014-03-30 11:10:18'),
(56, '1', '+50494797200', '2014-03-30 11:10:32'),
(57, 'Barrio cabanas', '+50494797200', '2014-03-30 11:10:50'),
(58, 'Azul', '+50494797200', '2014-03-30 11:11:03'),
(59, 'Ford', '+50494797200', '2014-03-30 11:11:15'),
(60, 'Ranger', '+50494797200', '2014-03-30 11:11:30'),
(61, 'Hgffhh', '+50494797200', '2014-03-30 11:11:42'),
(62, 'denuncia', '50494797200', '2014-03-30 11:45:19'),
(63, '1', '50494797200', '2014-03-30 11:45:39'),
(64, 'barrio lempira', '50494797200', '2014-03-30 11:45:51'),
(65, 'denuncia', '50494797200', '2014-03-30 11:46:06'),
(66, '2', '50494797200', '2014-03-30 11:46:16'),
(67, '2', '50494797200', '2014-03-30 11:46:47'),
(68, '2', '50494797200', '2014-03-30 11:52:12'),
(69, 'san pedro', '50494797200', '2014-03-30 11:52:35'),
(70, 'denuncia', '50494797200', '2014-03-30 11:52:54'),
(71, '2', '+50494797200', '2014-03-30 11:53:10'),
(72, 'denuncia', '50494797200', '2014-03-30 11:57:59'),
(73, '2', '50494797200', '2014-03-30 11:58:38'),
(74, '2', '+50494797200', '2014-03-30 11:59:51'),
(75, 'Denuncia', '+50494797200', '2014-03-30 12:00:12'),
(76, '2', '+50494797200', '2014-03-30 12:01:04'),
(77, '0', '+50494797200', '2014-03-30 12:01:13'),
(78, '3', '+50494797200', '2014-03-30 12:01:26'),
(79, 'Lempira', '+50494797200', '2014-03-30 12:01:43'),
(80, '10 calle 13 avenida', '+50494797200', '2014-03-30 12:02:09'),
(81, 'Puesto callejero', '+50494797200', '2014-03-30 12:02:35'),
(82, '3', '+50494797200', '2014-03-30 12:03:32'),
(83, 'Denuncia', '+50497211420', '2014-03-30 12:43:30'),
(84, '2', '+50497211420', '2014-03-30 12:43:42'),
(85, '4', '+50497211420', '2014-03-30 12:43:52'),
(86, 'Woow fantastico MAÑANA L5MIL en efectivo te caerian como anillo al dedo! Participa envia BOLETO al 14600 busca tus boletos y participa con Centro Radial!', '+14600', '2014-03-30 12:45:15'),
(87, 'denuncia', '50494797200', '2014-03-30 13:54:51'),
(88, '1', '+50494797200', '2014-03-30 13:55:07'),
(89, 'Callejera', '+50494797200', '2014-03-30 13:56:04'),
(90, 'Callejera', '50494797200', '2014-03-30 13:56:16'),
(91, 'denuncia', '50494797200', '2014-03-30 13:56:54'),
(92, '2', '50494797200', '2014-03-30 13:57:03'),
(93, '2', '50494797200', '2014-03-30 13:58:00'),
(94, '1', '50494797200', '2014-03-30 13:58:11'),
(95, 'Lempira', '50494797200', '2014-03-30 13:58:23'),
(96, '9ave, 6 calle', '50494797200', '2014-03-30 13:58:42'),
(97, 'callejera', '50494797200', '2014-03-30 13:58:58'),
(98, '3', '50494797200', '2014-03-30 13:59:07'),
(99, '3', '50494797200', '2014-03-30 14:01:10'),
(100, 'Denuncia', '+50494797200', '2014-03-30 14:04:37'),
(101, 'Denuncia', '+50495936389', '2014-03-30 16:56:49'),
(102, '1', '+50495936389', '2014-03-30 16:57:04'),
(103, 'Mi casa', '+50495936389', '2014-03-30 16:57:25'),
(104, 'Gris', '+50495936389', '2014-03-30 16:57:38'),
(105, 'Ford', '+50495936389', '2014-03-30 16:58:07'),
(106, 'Ranger', '+50495936389', '2014-03-30 16:58:26'),
(107, '980000', '+50495936389', '2014-03-30 16:58:41'),
(108, 'Denuncia', '+50495936389', '2014-03-30 17:05:32'),
(109, 'Denuncia', '+50498814217', '2014-03-30 17:06:14'),
(110, '2', '+50498814217', '2014-03-30 17:06:27'),
(111, '1', '+50498814217', '2014-03-30 17:06:38'),
(112, 'Por ahi', '+50498814217', '2014-03-30 17:06:49'),
(113, 'Denuncia', '+50494797200', '2014-03-30 17:50:56'),
(114, 'Denuncia', '+50494797200', '2014-03-30 18:18:41'),
(115, 'Denuncia', '+50488187838', '2014-03-30 19:33:42'),
(116, 'Denuncia', '+50494797200', '2014-03-30 19:34:37'),
(117, '2', '+50494797200', '2014-03-30 19:35:13'),
(118, '3', '+50494797200', '2014-03-30 19:35:35'),
(119, 'Lempira', '+50494797200', '2014-03-30 19:36:01'),
(120, '9 ave', '+50494797200', '2014-03-30 19:36:21'),
(121, 'Drah', '+50494797200', '2014-03-30 19:36:38'),
(122, '2', '+50494797200', '2014-03-30 19:36:50');

-- --------------------------------------------------------

--
-- Table structure for table `migration_versions`
--

CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migration_versions`
--

INSERT INTO `migration_versions` (`version`) VALUES
('20140329203356'),
('20140329204905'),
('20140329215018'),
('20140329215509'),
('20140329221102'),
('20140329232346'),
('20140330133706');

-- --------------------------------------------------------

--
-- Table structure for table `sent_questions`
--

CREATE TABLE IF NOT EXISTS `sent_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dest_address` varchar(45) NOT NULL,
  `crime_questions_id` int(11) DEFAULT NULL,
  `crime_cases_id` int(11) DEFAULT NULL,
  `sent_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sent_questions_crime_questions1_idx` (`crime_questions_id`),
  KEY `fk_sent_questions_crime_cases1_idx` (`crime_cases_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `sent_questions`
--

INSERT INTO `sent_questions` (`id`, `dest_address`, `crime_questions_id`, `crime_cases_id`, `sent_time`) VALUES
(22, '+50494797200', 1, 15, '2014-03-30 12:01:04'),
(23, '+50494797200', 2, 15, '2014-03-30 12:01:26'),
(24, '+50494797200', 3, 15, '2014-03-30 12:01:43'),
(25, '+50494797200', 4, 15, '2014-03-30 12:02:09'),
(26, '+50494797200', 5, 15, '2014-03-30 12:02:35'),
(35, '+50495936389', 6, 20, '2014-03-30 16:57:04'),
(36, '+50495936389', 7, 20, '2014-03-30 16:57:25'),
(37, '+50495936389', 8, 20, '2014-03-30 16:57:38'),
(38, '+50495936389', 9, 20, '2014-03-30 16:58:07'),
(39, '+50495936389', 10, 20, '2014-03-30 16:58:26'),
(40, '+50498814217', 1, 22, '2014-03-30 17:06:27'),
(41, '+50498814217', 2, 22, '2014-03-30 17:06:38'),
(42, '+50498814217', 3, 22, '2014-03-30 17:06:49'),
(43, '+50494797200', 1, 26, '2014-03-30 19:35:13'),
(44, '+50494797200', 2, 26, '2014-03-30 19:35:35'),
(45, '+50494797200', 3, 26, '2014-03-30 19:36:01'),
(46, '+50494797200', 4, 26, '2014-03-30 19:36:21'),
(47, '+50494797200', 5, 26, '2014-03-30 19:36:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `case_comments`
--
ALTER TABLE `case_comments`
  ADD CONSTRAINT `fk_case_comments_crime_case1` FOREIGN KEY (`crime_case_id`) REFERENCES `crime_cases` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `case_mt_responses`
--
ALTER TABLE `case_mt_responses`
  ADD CONSTRAINT `fk_case_mt_responses_crime_cases1` FOREIGN KEY (`crime_cases_id`) REFERENCES `crime_cases` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `crime_cases`
--
ALTER TABLE `crime_cases`
  ADD CONSTRAINT `FK_154CBB139ACF468D` FOREIGN KEY (`crime_category_id`) REFERENCES `crime_categories` (`id`),
  ADD CONSTRAINT `fk_crime_case_message_mo1` FOREIGN KEY (`message_mo_id`) REFERENCES `messages_mo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `crime_questions`
--
ALTER TABLE `crime_questions`
  ADD CONSTRAINT `fk_category_question_crime_category` FOREIGN KEY (`crime_category_id`) REFERENCES `crime_categories` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `crime_question_answers`
--
ALTER TABLE `crime_question_answers`
  ADD CONSTRAINT `fk_crime_question_answers_sent_questions1` FOREIGN KEY (`sent_questions_id`) REFERENCES `sent_questions` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `crime_question_options`
--
ALTER TABLE `crime_question_options`
  ADD CONSTRAINT `fk_crime_question_options_crime_questions1` FOREIGN KEY (`crime_questions_id`) REFERENCES `crime_questions` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `sent_questions`
--
ALTER TABLE `sent_questions`
  ADD CONSTRAINT `fk_sent_questions_crime_cases1` FOREIGN KEY (`crime_cases_id`) REFERENCES `crime_cases` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_sent_questions_crime_questions1` FOREIGN KEY (`crime_questions_id`) REFERENCES `crime_questions` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
