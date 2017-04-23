CREATE TABLE `arcboard_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) NOT NULL,
  `title` varchar(100) NOT NULL,
  `subtitle` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `links` varchar(255) NOT NULL,
  `lifespan` int(11) NOT NULL,
  `extended` text NOT NULL,
  `created` datetime NOT NULL,
  `expired` tinyint(4) NOT NULL,
  `groupname` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;