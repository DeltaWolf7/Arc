-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 27, 2015 at 10:20 AM
-- Server version: 5.5.40-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `c7arc`
--

-- --------------------------------------------------------

--
-- Table structure for table `coachman_customers`
--

CREATE TABLE IF NOT EXISTS `coachman_customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `company` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `coachman_drivers`
--

CREATE TABLE IF NOT EXISTS `coachman_drivers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `costperhour` decimal(18,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `coachman_drivers`
--

INSERT INTO `coachman_drivers` (`id`, `firstname`, `lastname`, `email`, `phone`, `mobile`, `costperhour`) VALUES
(2, 'Adam', 'Tester', 'adam@tester.com', '0800', '08088888', 10.00),
(3, 'Bob', 'Hope', 'email@address.com', '0000000000', '', 7.50);

-- --------------------------------------------------------

--
-- Table structure for table `coachman_vehicles`
--

CREATE TABLE IF NOT EXISTS `coachman_vehicles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `regno` varchar(10) NOT NULL,
  `seats` int(11) NOT NULL,
  `typeid` int(11) NOT NULL,
  `fuelcostpermile` decimal(18,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `coachman_vehicles`
--

INSERT INTO `coachman_vehicles` (`id`, `regno`, `seats`, `typeid`, `fuelcostpermile`) VALUES
(1, 'XXX 12XX', 18, 1, 0.26),
(6, 'SDFSDFSDFX', 70, 1, 8.00),
(7, 'TEST', 56, 1, 0.50);

-- --------------------------------------------------------

--
-- Table structure for table `coachman_vehicletypes`
--

CREATE TABLE IF NOT EXISTS `coachman_vehicletypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `coachman_vehicletypes`
--

INSERT INTO `coachman_vehicletypes` (`id`, `name`) VALUES
(1, 'Test');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
