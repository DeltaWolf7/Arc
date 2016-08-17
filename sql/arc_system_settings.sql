--
-- Table structure for table `arc_system_settings`
--

CREATE TABLE IF NOT EXISTS `arc_system_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `skey` varchar(100) NOT NULL,
  `svalue` text NOT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

