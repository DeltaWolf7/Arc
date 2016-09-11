--
-- Table structure for table `arc_system_settings`
--

CREATE TABLE IF NOT EXISTS `arc_system_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `skey` varchar(100) NOT NULL,
  `svalue` text NOT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `skey` (`skey`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

INSERT INTO `arc_system_settings` (`id`, `skey`, `svalue`, `userid`) VALUES
(1, 'ARC_KEEP_LOGS', '31', 0);

