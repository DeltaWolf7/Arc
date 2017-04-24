CREATE TABLE `arcboard_itemsextended` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `itemid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `extended` text NOT NULL,
  `display` tinyint NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;