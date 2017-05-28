--
-- Table structure for table `arc_blog`
--

CREATE TABLE `arc_blog` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `tags` text NOT NULL,
  `poster` int(11) NOT NULL,
  `categoryid` int(11) NOT NULL,
  `seourl` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `arc_blog`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `arc_blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- Table structure for table `arc_blog_categories`
--

CREATE TABLE IF NOT EXISTS `arc_blog_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `seourl` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

