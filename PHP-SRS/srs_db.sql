-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 30, 2016 at 03:07 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `srs_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `stock_item`
--

CREATE TABLE IF NOT EXISTS `stock_item` (
  `stock_name` varchar(255) NOT NULL,
  `stock_code` int(4) NOT NULL,
  `description` text NOT NULL,
  `location` text NOT NULL,
  `quantity` int(4) NOT NULL,
  `costing` decimal(10,2) NOT NULL,
  `selling` decimal(10,2) NOT NULL,
  PRIMARY KEY (`stock_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_item`
--

INSERT INTO `stock_item` (`stock_name`, `stock_code`, `description`, `location`, `quantity`, `costing`, `selling`) VALUES
('', 0, '', '', 0, 0.00, 0.00),
('Panadol', 100, 'Panadol', 'B2 Area', 12, 4.00, 4.80),
('Panadol 2', 101, 'The second generation panadol', 'B2 Area', 15, 5.00, 5.50),
('qwe', 124, 'asfd', 'asfc', 5, 8.00, 8.00);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
