-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Feb 26, 2016 at 09:03 AM
-- Server version: 5.6.26-cll-lve
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `deltasbl_arc`
--

-- --------------------------------------------------------

--
-- Table structure for table `conc_caf`
--

CREATE TABLE IF NOT EXISTS `conc_caf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customerLegalName` varchar(100) NOT NULL,
  `customerAddress` text NOT NULL,
  `customerStatus` varchar(100) NOT NULL,
  `invoiceAddress` text NOT NULL,
  `orderDate` date NOT NULL,
  `contractReference` varchar(100) NOT NULL,
  `requestedServiceDate` date NOT NULL,
  `gpDebtorID` varchar(100) NOT NULL,
  `gpContractReference` varchar(100) NOT NULL,
  `serviceInformationJSON` text NOT NULL,
  `commercialJSON` text NOT NULL,
  `additionalNotes` text NOT NULL,
  `onboardingJSON` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `conc_caf`
--

INSERT INTO `conc_caf` (`id`, `customerLegalName`, `customerAddress`, `customerStatus`, `invoiceAddress`, `orderDate`, `contractReference`, `requestedServiceDate`, `gpDebtorID`, `gpContractReference`, `serviceInformationJSON`, `commercialJSON`, `additionalNotes`, `onboardingJSON`) VALUES
(1, 'Test Customer', 'Test', 'Test', 'Test', '2016-02-26', 'Test', '2016-02-27', 'test', 'test', '{}', '{}', 'test', '{}');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
