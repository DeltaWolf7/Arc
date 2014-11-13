--
-- Table structure for table `arc_last_access`
--

CREATE TABLE IF NOT EXISTS `arc_last_access` (
`id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `when` datetime NOT NULL,
  `browser` text NOT NULL,
  `ipaddress` varchar(15) NOT NULL,
  `url` varchar(255) NOT NULL,
  `referer` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1785 ;

--
-- Table structure for table `arc_messages`
--

CREATE TABLE IF NOT EXISTS `arc_messages` (
`id` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `date` datetime NOT NULL,
  `userid` int(11) NOT NULL,
  `read` tinyint(1) NOT NULL,
  `replied` tinyint(4) NOT NULL,
  `fromid` int(11) NOT NULL,
  `fromuser` varchar(50) NOT NULL,
  `folder` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `arc_pages`
--

CREATE TABLE IF NOT EXISTS `arc_pages` (
`id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `seourl` varchar(50) NOT NULL,
  `metatitle` varchar(55) NOT NULL,
  `metadescription` varchar(160) NOT NULL,
  `metakeywords` varchar(69) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `arc_pages`
--

INSERT INTO `arc_pages` (`id`, `title`, `content`, `seourl`, `metatitle`, `metadescription`, `metakeywords`) VALUES
(1, 'Welcome', '<blockquote style="margin: 0 0 0 40px; border: none; padding: 0px;"><br></blockquote><div class="well">This is a demonstration site. All data gets reset from time to time, back to demo data.</div>\nArc is a framework designed to facilitate the rapid development of web applications. This is achieved through the use of self loading modules.<div>Based on the BootStrap design framework, JQuery, Medoo, Font Awesome and Delta''s AJAX library.</div><div><br></div><div>Arc is an open source project, which can be found on <a href="https://github.com/DeltaWolf7/Arc">GitHub</a>. Arc is released under the MIT license agreement.</div><div><br></div><div><b>Arc Features</b></div><div><ul><li><span style="line-height: 1.42857143;">User management system</span><br></li><li><span style="line-height: 1.42857143;">Group based permission system for modules and pages</span><br></li><li><span style="line-height: 1.42857143;">Dynamic page creation</span><br></li><li><span style="line-height: 1.42857143;">SEO Friendly URL construction throughout</span><br></li><li><span style="line-height: 1.42857143;">Simplified AJAX commands for rapid development</span><br></li><li><span style="line-height: 1.42857143;">Support for CSS based themes</span><br></li><li><span style="line-height: 1.42857143;">Intelligent 404, 403 and 419 handling</span><br></li><li><span style="line-height: 1.42857143;">Module installer</span><br></li><li><span style="line-height: 1.42857143;">User to user messaging system </span><br></li></ul><div><br></div></div><div>Enjoy your stay, DeltaWolf7</div>', 'welcome', 'Arc Project', 'Arc Project prototype.', 'Arc, DeltaWolf7, Project, Arc Projct, Prototype'),
(6, 'test', 'test', 'test', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `arc_system_settings`
--

CREATE TABLE IF NOT EXISTS `arc_system_settings` (
`id` int(11) NOT NULL,
  `key` varchar(100) NOT NULL,
  `setting` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `arc_system_settings`
--

INSERT INTO `arc_system_settings` (`id`, `key`, `setting`) VALUES
(1, 'ARCTHEME', 'default'),
(6, 'ARCSMTP', 'localhost,25,username,password,from@email,From Name');

-- --------------------------------------------------------

--
-- Table structure for table `arc_users`
--

CREATE TABLE IF NOT EXISTS `arc_users` (
`id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `passwordhash` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `usergroupid` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `arc_users`
--

INSERT INTO `arc_users` (`id`, `firstname`, `lastname`, `email`, `passwordhash`, `created`, `enabled`, `usergroupid`) VALUES
(1, 'User', 'Anyone', 'user@localhost', '$2y$10$Bz/5XE2LfYBBAlP3n.dfvOFy9JaRBKZZ.KhHUw3/5y4jy9c9.yBg2', '2014-10-27 09:55:00', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `arc_user_groups`
--

CREATE TABLE IF NOT EXISTS `arc_user_groups` (
`id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `arc_user_groups`
--

INSERT INTO `arc_user_groups` (`id`, `name`, `description`) VALUES
(1, 'Administrators', 'Arc System Aministrators'),
(2, 'Users', 'Arc System Users'),
(3, 'Anyone', 'Arc System Anonymous');

-- --------------------------------------------------------

--
-- Table structure for table `arc_user_permissions`
--

CREATE TABLE IF NOT EXISTS `arc_user_permissions` (
`id` int(11) NOT NULL,
  `groupid` int(11) NOT NULL,
  `permission` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=85 ;

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
(64, 2, 'module/blog'),
(66, 3, 'module/blog'),
(68, 1, 'module/erudio'),
(71, 1, 'page/test'),
(72, 3, 'page/test'),
(74, 1, 'module/coachman'),
(81, 1, 'module/helpdesk'),
(82, 1, 'module/askquestions'),
(83, 1, 'module/pagemenu'),
(84, 1, 'module/systemsettings');

-- --------------------------------------------------------

--
-- Table structure for table `arc_user_settings`
--

CREATE TABLE IF NOT EXISTS `arc_user_settings` (
`id` int(11) NOT NULL,
  `key` varchar(255) NOT NULL,
  `userid` int(11) NOT NULL,
  `setting` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `arc_last_access`
--
ALTER TABLE `arc_last_access`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `arc_messages`
--
ALTER TABLE `arc_messages`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `arc_pages`
--
ALTER TABLE `arc_pages`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `arc_system_settings`
--
ALTER TABLE `arc_system_settings`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `arc_users`
--
ALTER TABLE `arc_users`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `arc_user_groups`
--
ALTER TABLE `arc_user_groups`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `arc_user_permissions`
--
ALTER TABLE `arc_user_permissions`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `arc_user_settings`
--
ALTER TABLE `arc_user_settings`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `arc_askquestions`
--
--
-- AUTO_INCREMENT for table `arc_last_access`
--
ALTER TABLE `arc_last_access`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1785;
--
-- AUTO_INCREMENT for table `arc_messages`
--
ALTER TABLE `arc_messages`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `arc_pages`
--
ALTER TABLE `arc_pages`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `arc_system_settings`
--
ALTER TABLE `arc_system_settings`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `arc_users`
--
ALTER TABLE `arc_users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `arc_user_groups`
--
ALTER TABLE `arc_user_groups`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `arc_user_permissions`
--
ALTER TABLE `arc_user_permissions`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=85;
--
-- AUTO_INCREMENT for table `arc_user_settings`
--
ALTER TABLE `arc_user_settings`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
