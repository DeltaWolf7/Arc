-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 17, 2014 at 04:19 PM
-- Server version: 5.5.38-0ubuntu0.14.04.1
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
-- Table structure for table `arc_last_access`
--

CREATE TABLE IF NOT EXISTS `arc_last_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `when` datetime NOT NULL,
  `browser` text NOT NULL,
  `ipaddress` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `arc_last_access`
--

INSERT INTO `arc_last_access` (`id`, `userid`, `when`, `browser`, `ipaddress`) VALUES
(1, 1, '2014-09-12 11:09:41', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36', '87.115.250.102'),
(2, 1, '2014-09-12 12:09:54', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36', '87.115.250.102'),
(3, 1, '2014-09-12 01:09:43', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36', '87.115.250.102'),
(4, 1, '2014-09-12 01:09:51', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36', '87.115.250.102'),
(5, 1, '2014-09-12 02:09:32', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36', '87.115.250.102'),
(6, 1, '2014-09-12 03:09:17', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36', '87.115.250.102'),
(7, 1, '2014-09-13 02:09:54', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36', '::1'),
(8, 1, '2014-09-15 07:09:25', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36', '77.97.169.91'),
(9, 1, '2014-09-15 10:09:52', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36', '87.115.250.102'),
(10, 1, '2014-09-15 02:09:53', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36', '87.114.183.78'),
(11, 1, '2014-09-15 10:09:20', 'Mozilla/5.0 (Linux; Android 4.4.4; Nexus 7 Build/KTU84P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.117 Safari/537.36', '77.97.169.91'),
(12, 1, '2014-09-17 04:09:54', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36', '87.114.183.78'),
(13, 1, '2014-09-17 04:09:38', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36', '87.114.183.78');

-- --------------------------------------------------------

--
-- Table structure for table `arc_messages`
--

CREATE TABLE IF NOT EXISTS `arc_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `date` datetime NOT NULL,
  `userid` int(11) NOT NULL,
  `read` tinyint(1) NOT NULL,
  `replied` tinyint(4) NOT NULL,
  `fromid` int(11) NOT NULL,
  `fromuser` varchar(50) NOT NULL,
  `folder` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `arc_messages`
--

INSERT INTO `arc_messages` (`id`, `subject`, `content`, `date`, `userid`, `read`, `replied`, `fromid`, `fromuser`, `folder`) VALUES
(42, '', '', '2014-09-15 12:09:05', 0, 0, 0, 0, '', 'Trash'),
(43, '', '', '2014-09-15 12:09:05', 0, 0, 0, 0, '', 'Trash');

-- --------------------------------------------------------

--
-- Table structure for table `arc_pages`
--

CREATE TABLE IF NOT EXISTS `arc_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `seourl` varchar(50) NOT NULL,
  `metatitle` varchar(55) NOT NULL,
  `metadescription` varchar(160) NOT NULL,
  `metakeywords` varchar(69) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `arc_pages`
--

INSERT INTO `arc_pages` (`id`, `title`, `content`, `seourl`, `metatitle`, `metadescription`, `metakeywords`) VALUES
(1, 'Test Page', 'This is a test page.', 'test', 'test', 'test page', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `arc_users`
--

CREATE TABLE IF NOT EXISTS `arc_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `passwordhash` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `usergroupid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `arc_users`
--

INSERT INTO `arc_users` (`id`, `firstname`, `lastname`, `email`, `passwordhash`, `created`, `enabled`, `usergroupid`) VALUES
(1, 'Some', 'User', 'user@localhost', '$2y$10$.C5fMt8Eak7ek0GxgrdjFOEeBYLq86aak2i8lEmZaGr4smxHynAOu', '2014-08-31 08:08:06', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `arc_user_groups`
--

CREATE TABLE IF NOT EXISTS `arc_user_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `arc_user_groups`
--

INSERT INTO `arc_user_groups` (`id`, `name`) VALUES
(1, 'Administrators'),
(2, 'Users'),
(3, 'Anyone');

-- --------------------------------------------------------

--
-- Table structure for table `arc_user_permissions`
--

CREATE TABLE IF NOT EXISTS `arc_user_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groupid` int(11) NOT NULL,
  `permission` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `arc_user_permissions`
--

INSERT INTO `arc_user_permissions` (`id`, `groupid`, `permission`) VALUES
(1, 1, 'module/theme'),
(2, 2, 'module/theme'),
(3, 1, 'module/info'),
(5, 1, 'page/test'),
(6, 2, 'page/test'),
(7, 3, 'page/test'),
(8, 3, 'module/login'),
(9, 2, 'module/messages'),
(10, 1, 'module/messages'),
(11, 3, 'modules/register');

-- --------------------------------------------------------

--
-- Table structure for table `arc_user_settings`
--

CREATE TABLE IF NOT EXISTS `arc_user_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `userid` int(11) NOT NULL,
  `setting` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `arc_user_settings`
--

INSERT INTO `arc_user_settings` (`id`, `key`, `userid`, `setting`) VALUES
(3, 'ARC_THEME', 1, 'sandstone');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
