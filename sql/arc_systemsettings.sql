-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 09, 2015 at 08:11 AM
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
-- Table structure for table `arc_system_settings`
--

CREATE TABLE IF NOT EXISTS `arc_system_settings` (
  `key` varchar(100) NOT NULL,
  `value` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `userid` int(11) NOT NULL,
  UNIQUE KEY `key` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `arc_system_settings`
--

INSERT INTO `arc_system_settings` (`key`, `value`, `group`, `userid`) VALUES
('', '{"smtp":"false", "server":"localhost", "username":"", "password":"", "port":"25", "sender":"admin@server.local"}', 'Mail', 0),
('ARC_ADMIN_THEME', 'ace', 'Theme', 0),
('ARC_BLOG_CHAR_LIMIT', '600', 'Blog', 0),
('ARC_BLOG_ENTRIES_PER_PAGE', '10', 'Blog', 0),
('ARC_BLOG_MENU_TITLE', 'Blog', 'Blog', 0),
('ARC_BLOG_NOLATEST', '10', 'Blog', 0),
('ARC_BLOG_TITLE', 'Latest News', 'Blog', 0),
('ARC_DEFAULT_PAGE', 'Welcome', 'System', 0),
('ARC_FILE_UPLOAD_SIZE_BYTES', '2000000', 'System', 0),
('ARC_KEEP_LOGS', '30', 'System', 0),
('ARC_MAIL_FROM', 'admin@server.local', 'Mail', 0),
('ARC_MAIL_SMTP_PASSWORD', 'password', 'Mail', 0),
('ARC_MAIL_SMTP_PORT', '25', 'Mail', 0),
('ARC_MAIL_SMTP_SERVER', 'localhost', 'Mail', 0),
('ARC_MAIL_SMTP_USERNAME', 'admin@server.local', 'Mail', 0),
('ARC_MAIL_USE_SMTP', '0', 'Mail', 0),
('ARC_PAGE_MENU_NAME', 'Pages', 'System', 0),
('ARC_THEME', 'default', 'Theme', 0),
('ARC_THUMB_WIDTH', '80', 'System', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
