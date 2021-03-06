-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2016 at 09:48 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

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
  `sale_id` int(4) NOT NULL,
  `sale_date` date NOT NULL,
  `stock_code` int(8) NOT NULL,
  `stock_name` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `quantity` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_record`
--

INSERT INTO `sales_record` (`sale_id`, `sale_date`, `stock_code`, `stock_name`, `amount`, `quantity`) VALUES
(1001, '2016-11-03', 1, '123', '5.00', 5),
(1002, '2016-11-03', 1, '123', '3.00', 3),
(1003, '2016-11-03', 123, 'zxc', '4.00', 4),
(1004, '2016-11-02', 12, 'qwe', '2.00', 2),
(1005, '2016-11-02', 1, '246', '2.00', 2);

-- --------------------------------------------------------

--
-- Table structure for table `stock_item`
--

CREATE TABLE `stock_item` (
  `stock_code` int(8) NOT NULL,
  `stock_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `location` text NOT NULL,
  `quantity` int(4) NOT NULL,
  `costing` decimal(10,2) NOT NULL,
  `selling` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_item`
--

INSERT INTO `stock_item` (`stock_code`, `stock_name`, `description`, `location`, `quantity`, `costing`, `selling`) VALUES
(1, '123', '', '', 330, '2.00', '4.00'),
(12, 'qwe', 'we', 'weq', 121, '2.00', '4.00'),
(123, 'zxc', '', '', 94, '0.00', '0.00'),
(1234, 'asd', '', '', 5, '0.00', '0.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sales_record`
--
ALTER TABLE `sales_record`
  ADD PRIMARY KEY (`sale_id`);

--
-- Indexes for table `stock_item`
--
ALTER TABLE `stock_item`
  ADD PRIMARY KEY (`stock_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sales_record`
--
ALTER TABLE `sales_record`
  MODIFY `sale_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1006;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
