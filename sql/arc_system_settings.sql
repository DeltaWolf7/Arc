CREATE TABLE `arc_system_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `skey` varchar(100) NOT NULL,
  `svalue` text NOT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
