-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2016 at 08:06 AM
-- Server version: 10.0.17-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `srs_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `sales_record`
--

CREATE TABLE `sales_record` (
  `sale_id` varchar(255) NOT NULL,
  `sale_date` date NOT NULL,
  `amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_record`
--

INSERT INTO `sales_record` (`sale_id`, `sale_date`, `amount`) VALUES
('', '0000-00-00', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `stock_item`
--

CREATE TABLE `stock_item` (
  `stock_name` varchar(255) NOT NULL,
  `stock_code` int(4) NOT NULL,
  `description` text NOT NULL,
  `location` text NOT NULL,
  `quantity` int(4) NOT NULL,
  `costing` decimal(10,2) NOT NULL,
  `selling` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_item`
--

INSERT INTO `stock_item` (`stock_name`, `stock_code`, `description`, `location`, `quantity`, `costing`, `selling`) VALUES
('', 0, '', '', 0, '0.00', '0.00'),
('jahjkasd', 0, 'jaksbf', 'jbkjb', 7, '9.00', '15.00'),
('lsadfh', 0, 'kjsdbfkjbs', 'ksjdbvk', 9, '7.00', '10.00'),
('Panadol', 100, 'Panadol', 'B2 Area', 12, '4.00', '4.80'),
('Panadol 2', 101, 'The second generation panadol', 'B2 Area', 15, '5.00', '5.50'),
('qwe', 124, 'asfd', 'asfc', 5, '8.00', '8.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sales_record`
--
ALTER TABLE `sales_record`
  ADD UNIQUE KEY `sale_id` (`sale_id`);

--
-- Indexes for table `stock_item`
--
ALTER TABLE `stock_item`
  ADD PRIMARY KEY (`stock_name`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
