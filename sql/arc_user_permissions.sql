--
-- Table structure for table `arc_user_permissions`
--

CREATE TABLE IF NOT EXISTS `arc_user_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groupid` int(11) NOT NULL,
  `permission` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `arc_user_permissions`
--

INSERT INTO `arc_user_permissions` (`id`, `groupid`, `permission`) VALUES
(1, 3, 'welcome'),
(2, 3, 'error'),
(4, 1, 'administration/pagemanager'),
(5, 3, 'login'),
(6, 2, 'account/logout'),
(7, 2, 'account/details'),
(8, 1, 'administration/permissions'),
(9, 1, 'administration/logs'),
(10, 1, 'administration/settings'),
(11, 1, 'administration/users'),
(12, 1, 'administration/media-manager');
