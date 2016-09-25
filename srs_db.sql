-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2016 at 11:46 AM
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
-- Table structure for table `sales listing`
--

CREATE TABLE `sales listing` (
  `sale_no` varchar(5) NOT NULL,
  `date` date NOT NULL,
  `amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stock inquiry`
--

CREATE TABLE `stock inquiry` (
  `date` date NOT NULL,
  `stock_code` int(11) NOT NULL,
  `in` int(3) NOT NULL,
  `out` int(3) NOT NULL,
  `balance` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stock item`
--

CREATE TABLE `stock item` (
  `stock_code` int(4) NOT NULL,
  `stock_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `location` text NOT NULL,
  `costing` decimal(10,2) NOT NULL,
  `selling` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `stock item`
--
ALTER TABLE `stock item`
  ADD PRIMARY KEY (`stock_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `stock item`
--
ALTER TABLE `stock item`
  MODIFY `stock_code` int(4) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
