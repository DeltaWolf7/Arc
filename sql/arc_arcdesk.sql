-- phpMyAdmin SQL Dump
-- version 4.4.13.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 20, 2016 at 05:54 PM
-- Server version: 5.6.30-0ubuntu0.15.10.1
-- PHP Version: 5.6.11-1ubuntu3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arc`
--

-- --------------------------------------------------------

--
-- Table structure for table `arcdesk_companies`
--

CREATE TABLE IF NOT EXISTS `arcdesk_companies` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `members` text NOT NULL,
  `contacts` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `arcdesk_companies`
--

-- --------------------------------------------------------

--
-- Table structure for table `arcdesk_priority`
--

CREATE TABLE IF NOT EXISTS `arcdesk_priority` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `sortorder` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `arcdesk_priority`
--

INSERT INTO `arcdesk_priority` (`id`, `name`, `sortorder`) VALUES
(1, 'High', 0),
(2, 'Medium', 0),
(3, 'Low', 0);

-- --------------------------------------------------------

--
-- Table structure for table `arcdesk_profile`
--

CREATE TABLE IF NOT EXISTS `arcdesk_profile` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `skillid` int(11) NOT NULL,
  `xp` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `jobrole` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `arcdesk_skillmatrix`
--

CREATE TABLE IF NOT EXISTS `arcdesk_skillmatrix` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `skill` varchar(50) NOT NULL,
  `level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `arcdesk_statuses`
--

CREATE TABLE IF NOT EXISTS `arcdesk_statuses` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `arcdesk_statuses`
--

INSERT INTO `arcdesk_statuses` (`id`, `name`) VALUES
(1, 'New'),
(2, 'In Progress'),
(3, 'Awaiting Customer'),
(4, 'On Hold'),
(5, 'Complete'),
(6, 'Information Only'),
(7, 'Awaiting 3rd Party');

-- --------------------------------------------------------

--
-- Table structure for table `arcdesk_tickethistory`
--

CREATE TABLE IF NOT EXISTS `arcdesk_tickethistory` (
  `id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `laststatus` int(11) NOT NULL,
  `newstatus` int(11) NOT NULL,
  `changeid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `arcdesk_ticketnotes`
--

CREATE TABLE IF NOT EXISTS `arcdesk_ticketnotes` (
  `id` int(11) NOT NULL,
  `ticketid` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `internal` tinyint(4) NOT NULL,
  `createdby` int(11) NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `arcdesk_tickets`
--

CREATE TABLE IF NOT EXISTS `arcdesk_tickets` (
  `id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `reference` varchar(50) NOT NULL,
  `subject` varchar(150) NOT NULL,
  `desciprtion` text NOT NULL,
  `requesterid` int(11) NOT NULL,
  `due` date DEFAULT NULL,
  `priorityid` int(11) NOT NULL,
  `source` varchar(50) NOT NULL,
  `type` varchar(20) NOT NULL,
  `groupid` int(11) NOT NULL,
  `agentid` int(11) NOT NULL,
  `categoryid` int(11) NOT NULL,
  `tags` text NOT NULL,
  `statusid` int(11) NOT NULL,
  `companyid` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `arcdesk_tickets`
--

INSERT INTO `arcdesk_tickets` (`id`, `created`, `reference`, `subject`, `desciprtion`, `requesterid`, `due`, `priorityid`, `source`, `type`, `groupid`, `agentid`, `categoryid`, `tags`, `statusid`, `companyid`) VALUES
(1, '2016-05-09 09:00:00', '1000', 'Sophos AV not updating', 'Sophos on my laptop is not updating any more.', 2, NULL, 1, 'Email', 'INC', 1, 0, 1, '["sophos"]', 1, 1),
(2, '2016-05-08 08:00:00', '1001', 'Windows Updates', 'Test test test', 1, NULL, 2, 'Portal', 'INC', 1, 2, 1, '["test"]', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `arcdesk_companies`
--
ALTER TABLE `arcdesk_companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `arcdesk_priority`
--
ALTER TABLE `arcdesk_priority`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `arcdesk_profile`
--
ALTER TABLE `arcdesk_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `arcdesk_skillmatrix`
--
ALTER TABLE `arcdesk_skillmatrix`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `arcdesk_statuses`
--
ALTER TABLE `arcdesk_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `arcdesk_tickethistory`
--
ALTER TABLE `arcdesk_tickethistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `arcdesk_ticketnotes`
--
ALTER TABLE `arcdesk_ticketnotes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `arcdesk_tickets`
--
ALTER TABLE `arcdesk_tickets`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `arcdesk_companies`
--
ALTER TABLE `arcdesk_companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `arcdesk_priority`
--
ALTER TABLE `arcdesk_priority`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `arcdesk_profile`
--
ALTER TABLE `arcdesk_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `arcdesk_skillmatrix`
--
ALTER TABLE `arcdesk_skillmatrix`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `arcdesk_statuses`
--
ALTER TABLE `arcdesk_statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `arcdesk_tickethistory`
--
ALTER TABLE `arcdesk_tickethistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `arcdesk_ticketnotes`
--
ALTER TABLE `arcdesk_ticketnotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `arcdesk_tickets`
--
ALTER TABLE `arcdesk_tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
