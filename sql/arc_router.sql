CREATE TABLE `arc_router` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `route` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `groupallowed` int(11) NOT NULL,
  `visible` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=12;

--
-- Dumping data for table `arc_router`
--

INSERT INTO `arc_router` (`id`, `route`, `destination`, `groupallowed`, `visible`) VALUES
(1, 'error', '', 3, 1),
(2, 'administration/router-manager', '', 1, 1),
(3, 'login', '', 3, 1),
(4, 'account/logout', '', 2, 1),
(5, 'account/details', '', 2, 1),
(12, 'administration/pagemanager', '', 1, 1),
(7, 'administration/logs', '', 1, 1),
(8, 'administration/settings', '', 1, 1),
(9, 'administration/users', '', 1, 1),
(10, '', 'welcome', 3, 1),
(11, 'administration/media-manager', '', 1, 1);
