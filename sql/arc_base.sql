--
-- Table structure for table `arc_logs`
--

CREATE TABLE IF NOT EXISTS `arc_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  `module` varchar(50) NOT NULL,
  `when` datetime NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Table structure for table `arc_pages`
--

CREATE TABLE IF NOT EXISTS `arc_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `seourl` varchar(50) NOT NULL,
  `metadescription` varchar(160) NOT NULL,
  `metakeywords` varchar(69) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `arc_pages`
--

INSERT INTO `arc_pages` (`id`, `title`, `content`, `seourl`, `metadescription`, `metakeywords`) VALUES
(1, 'Welcome to Arc', '&lt;div class=&quot;alert alert-warning&quot;&gt;Development site, no content hosted here.&lt;/div&gt;\n\n&lt;div&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum lobortis sit amet erat eget lacinia. Suspendisse tincidunt et orci non malesuada. Nunc rutrum ac massa vel interdum. Vestibulum purus odio, porttitor ac lorem vitae, lacinia elementum risus. Aenean et ante quis erat tempus scelerisque. Praesent consequat nunc nibh, nec semper felis iaculis sit amet. Pellentesque aliquet lobortis felis id ornare. Etiam venenatis et metus vel cursus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Ut fringilla vestibulum lorem quis aliquet. Praesent at enim ante. Mauris euismod gravida arcu sit amet bibendum. Sed ornare magna sapien, ac lobortis felis ultricies eu.&lt;/div&gt;\n\n\n&lt;div&gt;&lt;br&gt;&lt;/div&gt;\n\n\n&lt;div&gt;Aenean at nibh scelerisque, fringilla justo id, tempor felis. Curabitur gravida pellentesque ipsum et imperdiet. Proin turpis magna, pretium ac eleifend nec, molestie at nunc. Etiam in scelerisque nisl. Maecenas nec pretium arcu, sed efficitur urna. Nulla ut consequat elit. Aliquam ultricies bibendum nulla varius venenatis. Cras accumsan malesuada erat a gravida. Vivamus eu erat et odio euismod dignissim placerat eget justo. Nulla varius ante vitae aliquam porta. Donec id commodo magna.&lt;/div&gt;\n\n\n&lt;div&gt;&lt;br&gt;&lt;/div&gt;\n\n\n&lt;div&gt;Vestibulum ut diam in erat ultricies eleifend nec eget mi. Vestibulum viverra sapien ac condimentum ullamcorper. Fusce sagittis pulvinar purus in euismod. Duis mattis sem vitae venenatis posuere. Etiam ac egestas lacus, sit amet tincidunt dui. Etiam at lectus et enim tempor dignissim sit amet sed sapien. Sed sit amet ultrices dolor. Etiam vel erat felis. Donec facilisis finibus justo, tincidunt tincidunt dui molestie in. Duis metus neque, tristique at massa maximus, pellentesque suscipit ipsum. Pellentesque tellus nunc, tristique nec mi et, faucibus posuere purus. Morbi aliquet, est dapibus suscipit viverra, massa diam pretium massa, vel fermentum orci tellus venenatis velit. Aliquam vehicula consectetur nibh. Sed non auctor justo. Praesent tincidunt, justo sit amet volutpat porttitor, metus ante molestie sem, eu pellentesque turpis arcu quis ipsum. Morbi faucibus ultrices libero a faucibus.&lt;/div&gt;\n\n\n&lt;div&gt;&lt;br&gt;&lt;/div&gt;\n\n\n&lt;div&gt;Vestibulum quam felis, porta et consectetur id, ullamcorper vitae libero. Cras id enim ullamcorper, bibendum arcu efficitur, faucibus quam. Proin ut arcu quis metus consequat maximus a non massa. Sed vel finibus nibh, nec luctus lectus. Proin consequat mi quis turpis dignissim dictum. Sed ac dui vestibulum, dignissim augue ut, porttitor ipsum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Sed fermentum, dui sit amet efficitur iaculis, ante nulla ultricies arcu, fermentum condimentum ante ipsum nec dolor. Fusce rhoncus leo eu nisl consectetur, vitae dictum urna tempus. Nullam vehicula ultrices semper. Aenean nibh mauris, convallis quis condimentum at, porta molestie sapien. Aliquam erat volutpat. Pellentesque purus velit, iaculis non mollis id, finibus at sem. Proin blandit magna ut mi consectetur, porta suscipit neque elementum. Integer facilisis quam sit amet nisl laoreet, nec tempus metus fermentum.&lt;/div&gt;\n\n\n&lt;div&gt;&lt;br&gt;&lt;/div&gt;\n\n\n&lt;div&gt;Aenean ut euismod lorem. Sed tincidunt orci vitae ante placerat, in eleifend diam luctus. Sed et lectus nec elit placerat pellentesque. Mauris molestie maximus velit, at elementum risus consectetur sit amet. Aenean elit massa, mollis nec lobortis non, viverra ut lectus. Fusce accumsan libero et blandit egestas. Cras ut luctus nisi. Phasellus aliquet congue lorem porta vehicula. Curabitur vel est placerat, euismod enim porta, malesuada neque.&lt;/div&gt;', 'welcome', 'Arc open source, multi-platform MVC style application development framework.', 'arc,welcome,deltawolf7,supportone,mvc,framework,ajax');

--
-- Table structure for table `arc_system_settings`
--

CREATE TABLE IF NOT EXISTS `arc_system_settings` (
  `key` varchar(100) NOT NULL,
  `value` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  UNIQUE KEY `key` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure for table `arc_users`
--

CREATE TABLE IF NOT EXISTS `arc_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `passwordhash` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `groups` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `arc_users`
--

INSERT INTO `arc_users` (`id`, `firstname`, `lastname`, `email`, `passwordhash`, `created`, `enabled`, `groups`) VALUES
(112, 'Admin', 'Admin', 'admin@server.local', '$2y$10$1FyocTra9kRlftMfhYLCmuWelXppE0iSuVS/KpZM/ElFWy5AF9AK6', '2015-03-15 10:07:37', 1, '["Users","Administrators"]');

-- --------------------------------------------------------

--
-- Table structure for table `arc_user_groups`
--

CREATE TABLE IF NOT EXISTS `arc_user_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `arc_user_groups`
--

INSERT INTO `arc_user_groups` (`id`, `name`, `description`) VALUES
(1, 'Administrators', 'Arc System Aministrators'),
(2, 'Users', 'Arc System Users'),
(3, 'Guests', 'Arc System Guests');

-- --------------------------------------------------------

--
-- Table structure for table `arc_user_permissions`
--

CREATE TABLE IF NOT EXISTS `arc_user_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groupid` int(11) NOT NULL,
  `permission` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `arc_user_permissions`
--

INSERT INTO `arc_user_permissions` (`id`, `groupid`, `permission`) VALUES
(1, 3, 'user'),
(2, 3, 'page'),
(3, 3, 'error'),
(4, 1, 'systemsettings'),
(5, 1, 'user'),
(6, 1, 'page'),
(7, 1, 'error'),
(8, 2, 'error'),
(9, 2, 'page'),
(10, 2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `arc_user_settings`
--

CREATE TABLE IF NOT EXISTS `arc_user_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `userid` int(11) NOT NULL,
  `setting` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

