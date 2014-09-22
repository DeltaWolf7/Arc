-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 22, 2014 at 02:37 PM
-- Server version: 5.5.38-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `arc`
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

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
(1, 'Welcome', '<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla volutpat blandit turpis eget efficitur. Sed tincidunt viverra rhoncus. Sed placerat ante nec lorem suscipit ultricies. Quisque molestie leo ut tortor elementum, nec volutpat ipsum laoreet. Aliquam eu quam a sem consectetur vulputate in non ex. Fusce egestas velit euismod rhoncus lobortis. Curabitur dictum facilisis hendrerit.</div><div><br></div><div>Sed malesuada ultricies ipsum, at posuere risus pretium in. Nullam sit amet odio at leo pellentesque viverra. Suspendisse potenti. Aliquam blandit luctus ex, vitae convallis elit mattis vitae. Donec mattis risus et iaculis ultrices. Vivamus a vulputate nisl, et dapibus lorem. Donec sed arcu euismod tellus feugiat fringilla scelerisque in neque. Nulla non ligula viverra, accumsan ligula at, scelerisque metus. In gravida consequat nulla ut tristique. Cras a justo eu dui vestibulum convallis vel a nunc. Phasellus faucibus id massa vitae molestie. Quisque mauris eros, volutpat vitae orci ac, suscipit vestibulum ex. Maecenas congue risus at facilisis iaculis. Nulla facilisi. Proin vitae lacus eu nisi egestas suscipit. Vestibulum sit amet lacinia magna.</div><div><br></div><div>Phasellus suscipit pharetra odio, vel malesuada arcu euismod eu. Mauris ligula enim, vehicula eu nisl non, ornare maximus nibh. Etiam lobortis purus ex, ac fringilla mauris blandit in. Interdum et malesuada fames ac ante ipsum primis in faucibus. Vivamus erat odio, accumsan at suscipit id, blandit id ex. Donec pharetra, tellus vitae efficitur porttitor, mi ipsum consectetur turpis, a maximus ipsum tortor nec nisi. Phasellus vitae magna dictum, consequat nisl quis, lobortis tortor.</div><div><br></div><div>Cras commodo justo non nisl commodo bibendum. Sed eget tellus vulputate, interdum lacus eget, molestie massa. Nulla id dignissim velit. Donec pretium dictum nisl, vel aliquam ligula maximus quis. Donec sollicitudin eleifend augue ac elementum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus nec diam non odio cursus venenatis sed sit amet eros.</div><div><br></div><div>Vivamus tempus libero rutrum felis pretium commodo. Quisque et congue augue, vel pharetra neque. Sed vel dui nunc. Nam hendrerit arcu nec nulla feugiat dapibus. Etiam placerat nulla id bibendum congue. Nam et nunc in nulla consequat suscipit id at est. Proin volutpat neque eu leo gravida congue et id tortor. Fusce ac faucibus arcu, nec facilisis nulla. Etiam quis arcu lacinia, fringilla nulla vitae, mollis massa. Nullam hendrerit justo non velit porttitor, semper finibus ex iaculis. Pellentesque enim lacus, consectetur eget felis vel, vulputate consequat dui. Donec mattis turpis id posuere auctor.</div>', 'welcome', '', '', '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `arc_user_permissions`
--

INSERT INTO `arc_user_permissions` (`id`, `groupid`, `permission`) VALUES
(1, 1, 'module/details'),
(2, 2, 'module/details'),
(5, 1, 'page/welcome'),
(6, 2, 'page/welcome'),
(7, 3, 'page/welcome'),
(8, 3, 'module/login'),
(9, 2, 'module/messages'),
(10, 1, 'module/messages'),
(11, 3, 'module/register'),
(15, 1, 'module/page'),
(17, 1, 'page/administration'),
(18, 1, 'module/installer');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `arc_user_settings`
--

INSERT INTO `arc_user_settings` (`id`, `key`, `userid`, `setting`) VALUES
(3, 'ARC_THEME', 1, 'sandstone');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
