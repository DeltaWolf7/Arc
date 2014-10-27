-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 27, 2014 at 11:29 AM
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
-- Table structure for table `arc_blog`
--

CREATE TABLE IF NOT EXISTS `arc_blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `tags` text NOT NULL,
  `posterid` int(11) NOT NULL,
  `categoryid` int(11) NOT NULL,
  `seourl` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `arc_blog`
--

INSERT INTO `arc_blog` (`id`, `date`, `title`, `content`, `image`, `tags`, `posterid`, `categoryid`, `seourl`) VALUES
(1, '2014-10-06 00:00:00', 'First blog post', 'This is an example blog post.', 'images/placeholder300.png', 'example', 1, 1, 'example'),
(2, '2014-10-06 12:00:00', 'Another post', 'Test', '', 'test', 1, 2, 'test'),
(3, '2014-10-06 22:41:00', 'Place holder', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eget turpis sed metus sodales finibus. Donec nec massa sollicitudin, placerat odio ut, mollis purus. Vivamus gravida laoreet tristique. Vivamus at magna in dui egestas dictum. Maecenas a leo lacinia, efficitur velit finibus, ultricies risus. Etiam faucibus mattis ante, porttitor vehicula ipsum sodales et. Nunc lorem tortor, aliquet id nulla sed, euismod scelerisque enim. Proin ullamcorper dolor velit, a gravida odio tincidunt vel. Sed faucibus purus at metus venenatis elementum. Nulla quis nisl dignissim, blandit turpis ut, hendrerit lorem. Pellentesque a facilisis mauris, in viverra tellus.\r\n\r\nNam sollicitudin, nulla ut dapibus vulputate, elit purus bibendum arcu, ut elementum nisi diam ut lectus. In vel sapien tempor, consectetur erat non, tincidunt tortor. Nunc eget laoreet arcu, vitae venenatis mi. In erat nisl, facilisis quis dui a, sagittis feugiat nisl. Nulla in leo vel nunc laoreet fringilla. Aenean vitae lacus mi. Praesent convallis eros quis tellus eleifend dictum. Phasellus bibendum magna vitae ex ullamcorper eleifend. Phasellus tincidunt mauris erat, eget maximus tortor tristique in.\r\n\r\nVestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Praesent at eros ac augue imperdiet dignissim. Integer augue neque, auctor eget neque a, feugiat pellentesque urna. Vivamus consequat quam eu lacus feugiat, nec malesuada felis egestas. Maecenas lobortis enim sem. Aenean ornare facilisis augue, vitae maximus augue aliquet vitae. Nam dignissim congue mi, vel consequat augue elementum sit amet. Nulla dapibus sollicitudin risus, nec pharetra nunc accumsan eu. Cras nunc ipsum, commodo sit amet elit non, tempus dignissim enim. Mauris ornare gravida risus, id pulvinar mauris porta non.\r\n\r\nCras consectetur libero a sem bibendum, vitae viverra arcu rhoncus. Phasellus auctor velit eu felis gravida feugiat. Quisque placerat dui in lacus sodales, vitae lacinia massa ullamcorper. Nulla id venenatis velit, ut lobortis sapien. Praesent lacinia vehicula nunc, in lobortis massa luctus id. Fusce pharetra fringilla massa sed malesuada. Nulla vel urna at dui consectetur dictum sit amet at nulla. Etiam vitae nibh sollicitudin, rhoncus metus non, vehicula magna. Nam consequat diam quis neque rutrum, quis tristique eros malesuada. Maecenas sit amet enim hendrerit, finibus ex at, suscipit ligula. Nam congue auctor mollis. Integer convallis, ligula eget maximus consequat, lectus dui pellentesque ante, sed ullamcorper metus velit tristique neque.\r\n\r\nSuspendisse malesuada velit quis condimentum varius. Vestibulum id cursus lectus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aenean et commodo massa. Suspendisse eget erat fringilla, tempus ipsum sed, rhoncus enim. Suspendisse consectetur condimentum quam, sit amet rutrum enim interdum vitae. Vivamus leo lorem, imperdiet rhoncus facilisis ut, pretium eget quam. Donec et ex at elit tristique fermentum. Fusce consequat mauris eu ultrices iaculis. Nullam eleifend sodales orci, sit amet accumsan massa porta in. Maecenas at dui et nisl euismod interdum. Phasellus fermentum iaculis nunc, nec cursus erat sollicitudin ac.', 'images/placeholder300.png', '', 1, 1, 'placeholder');

-- --------------------------------------------------------

--
-- Table structure for table `arc_blog_categories`
--

CREATE TABLE IF NOT EXISTS `arc_blog_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `seourl` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `arc_blog_categories`
--

INSERT INTO `arc_blog_categories` (`id`, `name`, `seourl`) VALUES
(1, 'News', 'news'),
(2, 'Test', 'test');

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
  `url` varchar(255) NOT NULL,
  `referer` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=182 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `arc_pages`
--

INSERT INTO `arc_pages` (`id`, `title`, `content`, `seourl`, `metatitle`, `metadescription`, `metakeywords`) VALUES
(1, 'Welcome', '<h2>Welcome to the Arc Project.</h2><blockquote style="margin: 0 0 0 40px; border: none; padding: 0px;"><br></blockquote><div class="well">This is a demonstration site. All data get reset from time to time beck to demo data. No actual data is kept.</div>\nArc is a framework designed to facilitate the rapid development of web applications. This is achieved through the use of self loading modules.<div>Based on the BootStrap design framework, JQuery, Medoo, Font Awesome and Delta''s AJAX library.</div><div><br></div><div>Arc is an open source project, which can be found on <a href="https://github.com/DeltaWolf7/Arc">GitHub</a>. Arc is released under the MIT license agreement.</div><div><br></div><div><b>Arc Features</b></div><div><ul><li><span style="line-height: 1.42857143;">User management system</span><br></li><li><span style="line-height: 1.42857143;">Group based permission system for modules and pages</span><br></li><li><span style="line-height: 1.42857143;">Dynamic page creation</span><br></li><li><span style="line-height: 1.42857143;">SEO Friendly URL construction throughout</span><br></li><li><span style="line-height: 1.42857143;">Simplified AJAX commands for rapid development</span><br></li><li><span style="line-height: 1.42857143;">Support for CSS based themes</span><br></li><li><span style="line-height: 1.42857143;">Intelligent 404, 403 and 419 handling</span><br></li><li><span style="line-height: 1.42857143;">Module installer</span><br></li><li><span style="line-height: 1.42857143;">User to user messaging system </span><br></li></ul><div><br></div></div><div>Enjoy your stay, DeltaWolf7</div>', 'welcome', 'Arc Project', 'Arc Project prototype.', 'Arc, DeltaWolf7, Project, Arc Projct, Prototype'),
(6, 'test', 'test', 'test', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `arc_system_settings`
--

CREATE TABLE IF NOT EXISTS `arc_system_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(100) NOT NULL,
  `setting` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `arc_users`
--

INSERT INTO `arc_users` (`id`, `firstname`, `lastname`, `email`, `passwordhash`, `created`, `enabled`, `usergroupid`) VALUES
(1, 'User', 'Anyone', 'user@localhost', '$2y$10$JTW/7ai7iDjLb3RmSBBuJ.tdrUZw3BeNvTFUMdXqhmlQixP5GHDL6', '2014-10-27 09:55:00', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `arc_user_groups`
--

CREATE TABLE IF NOT EXISTS `arc_user_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `arc_user_groups`
--

INSERT INTO `arc_user_groups` (`id`, `name`, `description`) VALUES
(1, 'Administrators', 'Arc System Aministrators'),
(2, 'Users', 'Arc System Users'),
(3, 'Anyone', 'Arc System Anonymous'),
(6, 'Erudio', 'Erudio User Group'),
(7, 'Wills', 'Wills User Group'),
(8, 'Rigby', 'Rigby Transport');

-- --------------------------------------------------------

--
-- Table structure for table `arc_user_permissions`
--

CREATE TABLE IF NOT EXISTS `arc_user_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groupid` int(11) NOT NULL,
  `permission` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=82 ;

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
(25, 1, 'module/installer'),
(26, 1, 'module/will'),
(30, 1, 'module/blog'),
(34, 6, 'page/welcome'),
(36, 6, 'module/details'),
(38, 6, 'module/error'),
(40, 6, 'module/erudio'),
(44, 6, 'module/messages'),
(45, 6, 'module/page'),
(51, 7, 'page/welcome'),
(52, 7, 'module/details'),
(54, 7, 'module/error'),
(56, 7, 'module/messages'),
(58, 7, 'module/page'),
(60, 7, 'module/will'),
(64, 2, 'module/blog'),
(66, 3, 'module/blog'),
(68, 1, 'module/erudio'),
(71, 1, 'page/test'),
(72, 3, 'page/test'),
(74, 1, 'module/coachman'),
(75, 8, 'page/welcome'),
(76, 8, 'module/coachman'),
(77, 8, 'module/details'),
(78, 8, 'module/error'),
(79, 8, 'module/messages'),
(81, 1, 'module/helpdesk');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
