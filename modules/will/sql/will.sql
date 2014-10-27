-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 27, 2014 at 10:21 AM
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
-- Table structure for table `will_addresses`
--

CREATE TABLE IF NOT EXISTS `will_addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `clientid` int(11) NOT NULL,
  `address1` varchar(100) NOT NULL,
  `address2` varchar(100) NOT NULL,
  `address3` varchar(100) NOT NULL,
  `postcode` varchar(10) NOT NULL,
  `pri` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `will_addresses`
--

INSERT INTO `will_addresses` (`id`, `userid`, `clientid`, `address1`, `address2`, `address3`, `postcode`, `pri`) VALUES
(1, 4, 1, '56 Some Street', 'Some Place', 'Some More Places', 'SO1 XXX', 1),
(2, 4, 3, '78 Some F''in Rd', '', 'Any Town', 'AT6666', 1),
(3, 1, 5, '56 Some Place', '', 'Any place', 'AN66 88YT', 1);

-- --------------------------------------------------------

--
-- Table structure for table `will_clients`
--

CREATE TABLE IF NOT EXISTS `will_clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `sex` varchar(1) NOT NULL,
  `disabled` tinyint(1) NOT NULL,
  `phone` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `will_clients`
--

INSERT INTO `will_clients` (`id`, `userid`, `name`, `dob`, `sex`, `disabled`, `phone`) VALUES
(1, 4, 'Dave Butthole', '2014-09-10', 'M', 0, '0800801801'),
(2, 4, 'Choco Friend', '2014-09-12', 'F', 0, '0800202020'),
(3, 1, 'Dave Smith', '2014-10-22', 'F', 0, '08008001'),
(5, 1, 'Another Person', '2014-10-22', 'F', 0, '0800801801');

-- --------------------------------------------------------

--
-- Table structure for table `will_wills`
--

CREATE TABLE IF NOT EXISTS `will_wills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `clientid` int(11) NOT NULL,
  `partnerid` int(11) NOT NULL,
  `relationship` varchar(20) NOT NULL,
  `exe1` int(11) NOT NULL,
  `exe2` int(11) NOT NULL,
  `exe3` int(11) NOT NULL,
  `exe4` int(11) NOT NULL,
  `gua` varchar(3) NOT NULL,
  `gua1` int(11) NOT NULL,
  `gua2` int(11) NOT NULL,
  `gua3` int(11) NOT NULL,
  `gua4` int(11) NOT NULL,
  `legacies` varchar(3) NOT NULL,
  `legs` text NOT NULL,
  `charchoice` varchar(3) NOT NULL,
  `char` text NOT NULL,
  `property` varchar(3) NOT NULL,
  `prop` text NOT NULL,
  `res1` int(11) NOT NULL,
  `res2` int(11) NOT NULL,
  `res3` int(11) NOT NULL,
  `res4` int(11) NOT NULL,
  `custom` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `will_wills`
--

INSERT INTO `will_wills` (`id`, `userid`, `clientid`, `partnerid`, `relationship`, `exe1`, `exe2`, `exe3`, `exe4`, `gua`, `gua1`, `gua2`, `gua3`, `gua4`, `legacies`, `legs`, `charchoice`, `char`, `property`, `prop`, `res1`, `res2`, `res3`, `res4`, `custom`) VALUES
(3, 1, 3, 0, 'Fiancee', 5, 0, 0, 0, 'No', 0, 0, 0, 0, 'No', '                                                                                                                                    ', 'No', '                                                                                                                                    ', 'No', '                                                                                                                                    ', 0, 0, 0, 0, '                                                                        test            ');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
