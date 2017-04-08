CREATE TABLE IF NOT EXISTS `arc_router` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `route` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `groupallowed` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;


INSERT INTO `arc_router` (`id`, `route`, `destination`, `groupallowed`) VALUES
(1, 'error', '', 3),
(2, 'administration/pagemanager', '', 1),
(3, 'login', '', 3),
(4, 'account/logout', '', 2),
(5, 'account/details', '', 2),
(6, 'administration/permissions', '', 1),
(7, 'administration/logs', '', 1),
(8, 'administration/settings', '', 1),
(9, 'administration/users', '', 1),
(10, '', 'welcome', 3),
(11, 'administration/media-manager', '', 1);
