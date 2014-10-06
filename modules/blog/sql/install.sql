CREATE TABLE IF NOT EXISTS `arc_blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `tags` text NOT NULL,
  `posterid` int(11) NOT NULL,
  `categoryid` int(11) NOT NULL,
  `seourl` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;


CREATE TABLE IF NOT EXISTS `arc_blog_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `seourl` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
