-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Jun 05, 2021 at 10:32 AM
-- Server version: 5.7.28
-- PHP Version: 7.3.12

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sc`
--
CREATE DATABASE IF NOT EXISTS `sc` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `sc`;

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

DROP TABLE IF EXISTS `facilities`;
CREATE TABLE IF NOT EXISTS `facilities` (
  `fac_id` int(11) NOT NULL AUTO_INCREMENT,
  `fac_name` varchar(50) NOT NULL,
  `fac_type` enum('TEST','ISSUE') NOT NULL,
  `fac_location` varchar(50) NOT NULL,
  PRIMARY KEY (`fac_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`fac_id`, `fac_name`, `fac_type`, `fac_location`) VALUES
(1, 'Testing Facillity 1', 'TEST', 'Nairobi,CBD'),
(2, 'Testing Facility 2', 'TEST', 'Thika Town'),
(5, 'Testing Facillity 3', 'TEST', 'Kiambu'),
(6, 'Testing Facility 4', 'TEST', 'Machakos'),
(7, 'Issuing Facilty 1', 'ISSUE', 'Nairobi,CBD'),
(8, 'Issuing Facility 2', 'ISSUE', 'Thika Town'),
(9, 'Issuing Facilty 3', 'ISSUE', 'Machakos'),
(10, 'Issuing Facility 4', 'ISSUE', 'Thika Town');

-- --------------------------------------------------------

--
-- Table structure for table `pickup_requests`
--

DROP TABLE IF EXISTS `pickup_requests`;
CREATE TABLE IF NOT EXISTS `pickup_requests` (
  `request_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `manifest_id` varchar(11) NOT NULL,
  `destination_facility` varchar(50) NOT NULL,
  `pickup_facility` varchar(50) NOT NULL,
  `pickup_date_time` datetime NOT NULL,
  PRIMARY KEY (`request_id`),
  KEY `request-userid` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pickup_requests`
--

INSERT INTO `pickup_requests` (`request_id`, `user_id`, `manifest_id`, `destination_facility`, `pickup_facility`, `pickup_date_time`) VALUES
(30, 7, 'IkQ7J', '5', '9', '2021-06-04 16:19:00'),
(31, 7, 'dLmeC', '6', '7', '2021-06-04 16:39:00'),
(32, 7, 'ugBcs', '2', '8', '2021-06-04 16:45:00');

-- --------------------------------------------------------

--
-- Table structure for table `specimens`
--

DROP TABLE IF EXISTS `specimens`;
CREATE TABLE IF NOT EXISTS `specimens` (
  `specimen_id` varchar(11) NOT NULL,
  `manifest_id` varchar(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `patient_number` varchar(30) NOT NULL,
  `transport_condition` text,
  `file` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Pending Transit',
  PRIMARY KEY (`specimen_id`),
  KEY `request_id` (`manifest_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `specimens`
--

INSERT INTO `specimens` (`specimen_id`, `manifest_id`, `name`, `patient_number`, `transport_condition`, `file`, `status`) VALUES
('ASDF', 'ugBcs', 'Jonathan Mburu Githumbi', '4563', '', 'resources/media/qrcode/41534446.png', 'pending_delivery'),
('QWERTY', 'IkQ7J', 'Human Beean', '1234', '', 'resources/media/qrcode/515745525459.png', 'in_transit'),
('UIOP', 'dLmeC', 'Hue Man Bean', '5678', 'Special Condition', 'resources/media/qrcode/55494f50.png', 'pending_delivery');
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
