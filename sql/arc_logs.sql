--
-- Table structure for table `arc_logs`
--

CREATE TABLE IF NOT EXISTS `arc_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  `module` varchar(50) NOT NULL,
  `event` datetime NOT NULL,
  `message` text NOT NULL,
  `impersonate` tinyint NOT NULL,
  `userid` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

