CREATE TABLE IF NOT EXISTS `arc_last_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `when` datetime NOT NULL,
  `browser` text NOT NULL,
  `ipaddress` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=91 ;

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

INSERT INTO `arc_pages` (`id`, `title`, `content`, `seourl`, `metatitle`, `metadescription`, `metakeywords`) VALUES
(1, 'Welcome', '<blockquote style="margin: 0 0 0 40px; border: none; padding: 0px;">Welcome to the Arc Project.</blockquote><div><br></div>Arc is a framework designed to facilitate the rapid development of web applications. This is achieved through the use of self loading modules.<div>Based on the BootStrap design framework, JQuery, Medoo, Font Awesome and Delta''s AJAX library.</div><div><br></div><div>Arc is an open source project, which can be found on <a href="https://github.com/DeltaWolf7/Arc">GitHub</a>. Arc is released under the MIT license agreement.</div><div><br></div><div><b>Arc Features</b></div><div><ul><li><span style="line-height: 1.42857143;">User management system</span><br></li><li><span style="line-height: 1.42857143;">Group based permission system for modules and pages</span><br></li><li><span style="line-height: 1.42857143;">Dynamic page creation</span><br></li><li><span style="line-height: 1.42857143;">SEO Friendly URL construction throughout</span><br></li><li><span style="line-height: 1.42857143;">Simplified AJAX commands for rapid development</span><br></li><li><span style="line-height: 1.42857143;">Support for CSS based themes</span><br></li><li><span style="line-height: 1.42857143;">Intelligent 404, 403 and 419 handling</span><br></li><li><span style="line-height: 1.42857143;">Module installer</span><br></li><li><span style="line-height: 1.42857143;">User to user messaging system </span><br></li></ul><div><br></div></div><div>Enjoy your stay, DeltaWolf7</div>', 'welcome', 'Arc Project', 'Arc Project prototype.', 'Arc, DeltaWolf7, Project, Arc Projct, Prototype');

CREATE TABLE IF NOT EXISTS `arc_system_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(100) NOT NULL,
  `setting` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

INSERT INTO `arc_system_settings` (`id`, `key`, `setting`) VALUES
(1, 'ARCTHEME', 'sandstone');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

INSERT INTO `arc_users` (`id`, `firstname`, `lastname`, `email`, `passwordhash`, `created`, `enabled`, `usergroupid`) VALUES
(1, 'Some', 'User', 'user@localhost', '$2y$10$.C5fMt8Eak7ek0GxgrdjFOEeBYLq86aak2i8lEmZaGr4smxHynAOu', '2014-08-31 08:08:06', 1, 1);

CREATE TABLE IF NOT EXISTS `arc_user_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

INSERT INTO `arc_user_groups` (`id`, `name`, `description`) VALUES
(1, 'Administrators', 'Arc System Aministrators'),
(2, 'Users', 'Arc System Users'),
(3, 'Anyone', 'Arc System Anonymous');

CREATE TABLE IF NOT EXISTS `arc_user_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groupid` int(11) NOT NULL,
  `permission` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=73 ;

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
(25, 1, 'module/installer');

CREATE TABLE IF NOT EXISTS `arc_user_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `userid` int(11) NOT NULL,
  `setting` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;