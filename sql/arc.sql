CREATE TABLE IF NOT EXISTS `arc_askquestions` (
`id` int(11) NOT NULL,
  `groupid` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer1` text NOT NULL,
  `answer2` text NOT NULL,
  `answer3` text NOT NULL,
  `answer4` text NOT NULL,
  `answer5` text NOT NULL,
  `correctAnswer` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `arc_askquestion_groups` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `txt` text NOT NULL,
  `visible` tinyint(4) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `arc_askquestion_results` (
`id` int(11) NOT NULL,
  `groupid` int(11) NOT NULL,
  `questionid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `resultno` int(11) NOT NULL,
  `timetaken` int(11) NOT NULL,
  `questionno` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `arc_blog` (
`id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `tags` text NOT NULL,
  `poster` varchar(50) NOT NULL,
  `category` varchar(100) NOT NULL,
  `seourl` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `arc_blog_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `seourl` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `arc_pages` (
`id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `seourl` varchar(50) NOT NULL,
  `metadescription` varchar(160) NOT NULL,
  `metakeywords` varchar(69) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

INSERT INTO `arc_pages` (`id`, `title`, `content`, `seourl`, `metadescription`, `metakeywords`) VALUES
(1, 'Welcome to Arc', '&lt;div class=&quot;alert alert-warning&quot;&gt;Development site, no content hosted here.&lt;/div&gt;\n\n&lt;div&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum lobortis sit amet erat eget lacinia. Suspendisse tincidunt et orci non malesuada. Nunc rutrum ac massa vel interdum. Vestibulum purus odio, porttitor ac lorem vitae, lacinia elementum risus. Aenean et ante quis erat tempus scelerisque. Praesent consequat nunc nibh, nec semper felis iaculis sit amet. Pellentesque aliquet lobortis felis id ornare. Etiam venenatis et metus vel cursus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Ut fringilla vestibulum lorem quis aliquet. Praesent at enim ante. Mauris euismod gravida arcu sit amet bibendum. Sed ornare magna sapien, ac lobortis felis ultricies eu.&lt;/div&gt;\n\n\n&lt;div&gt;&lt;br&gt;&lt;/div&gt;\n\n\n&lt;div&gt;Aenean at nibh scelerisque, fringilla justo id, tempor felis. Curabitur gravida pellentesque ipsum et imperdiet. Proin turpis magna, pretium ac eleifend nec, molestie at nunc. Etiam in scelerisque nisl. Maecenas nec pretium arcu, sed efficitur urna. Nulla ut consequat elit. Aliquam ultricies bibendum nulla varius venenatis. Cras accumsan malesuada erat a gravida. Vivamus eu erat et odio euismod dignissim placerat eget justo. Nulla varius ante vitae aliquam porta. Donec id commodo magna.&lt;/div&gt;\n\n\n&lt;div&gt;&lt;br&gt;&lt;/div&gt;\n\n\n&lt;div&gt;Vestibulum ut diam in erat ultricies eleifend nec eget mi. Vestibulum viverra sapien ac condimentum ullamcorper. Fusce sagittis pulvinar purus in euismod. Duis mattis sem vitae venenatis posuere. Etiam ac egestas lacus, sit amet tincidunt dui. Etiam at lectus et enim tempor dignissim sit amet sed sapien. Sed sit amet ultrices dolor. Etiam vel erat felis. Donec facilisis finibus justo, tincidunt tincidunt dui molestie in. Duis metus neque, tristique at massa maximus, pellentesque suscipit ipsum. Pellentesque tellus nunc, tristique nec mi et, faucibus posuere purus. Morbi aliquet, est dapibus suscipit viverra, massa diam pretium massa, vel fermentum orci tellus venenatis velit. Aliquam vehicula consectetur nibh. Sed non auctor justo. Praesent tincidunt, justo sit amet volutpat porttitor, metus ante molestie sem, eu pellentesque turpis arcu quis ipsum. Morbi faucibus ultrices libero a faucibus.&lt;/div&gt;\n\n\n&lt;div&gt;&lt;br&gt;&lt;/div&gt;\n\n\n&lt;div&gt;Vestibulum quam felis, porta et consectetur id, ullamcorper vitae libero. Cras id enim ullamcorper, bibendum arcu efficitur, faucibus quam. Proin ut arcu quis metus consequat maximus a non massa. Sed vel finibus nibh, nec luctus lectus. Proin consequat mi quis turpis dignissim dictum. Sed ac dui vestibulum, dignissim augue ut, porttitor ipsum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Sed fermentum, dui sit amet efficitur iaculis, ante nulla ultricies arcu, fermentum condimentum ante ipsum nec dolor. Fusce rhoncus leo eu nisl consectetur, vitae dictum urna tempus. Nullam vehicula ultrices semper. Aenean nibh mauris, convallis quis condimentum at, porta molestie sapien. Aliquam erat volutpat. Pellentesque purus velit, iaculis non mollis id, finibus at sem. Proin blandit magna ut mi consectetur, porta suscipit neque elementum. Integer facilisis quam sit amet nisl laoreet, nec tempus metus fermentum.&lt;/div&gt;\n\n\n&lt;div&gt;&lt;br&gt;&lt;/div&gt;\n\n\n&lt;div&gt;Aenean ut euismod lorem. Sed tincidunt orci vitae ante placerat, in eleifend diam luctus. Sed et lectus nec elit placerat pellentesque. Mauris molestie maximus velit, at elementum risus consectetur sit amet. Aenean elit massa, mollis nec lobortis non, viverra ut lectus. Fusce accumsan libero et blandit egestas. Cras ut luctus nisi. Phasellus aliquet congue lorem porta vehicula. Curabitur vel est placerat, euismod enim porta, malesuada neque.&lt;/div&gt;', 'welcome', 'Arc open source, multi-platform MVC style application development framework.', 'arc,welcome,deltawolf7,supportone,mvc,framework,ajax');

CREATE TABLE IF NOT EXISTS `arc_system_settings` (
  `key` varchar(100) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `arc_users` (
`id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `passwordhash` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `groups` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

INSERT INTO `arc_users` (`id`, `firstname`, `lastname`, `email`, `passwordhash`, `created`, `enabled`, `groups`) VALUES
(1, 'Admin', 'Admin', 'admin@server.local', '$2y$10$Rap5PmtUUVBfYAvd2VR3ReKDP3v8TwiYUcKR8KaR63aYxZSS4aix6', '2015-03-04 07:45:04', 1, '["Users", "Administrators", "Students"]');

CREATE TABLE IF NOT EXISTS `arc_user_groups` (
`id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

INSERT INTO `arc_user_groups` (`id`, `name`, `description`) VALUES
(1, 'Administrators', 'Arc System Aministrators'),
(2, 'Users', 'Arc System Users'),
(3, 'Guests', 'Arc System Guests'),
(9, 'Students', 'Students Group');

CREATE TABLE IF NOT EXISTS `arc_user_permissions` (
`id` int(11) NOT NULL,
  `groupid` int(11) NOT NULL,
  `permission` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=117 ;

INSERT INTO `arc_user_permissions` (`id`, `groupid`, `permission`) VALUES
(86, 3, 'user'),
(87, 3, 'page'),
(88, 3, 'error'),
(89, 1, 'systemsettings'),
(92, 1, 'user'),
(93, 1, 'page'),
(94, 1, 'error'),
(95, 2, 'error'),
(96, 2, 'page'),
(97, 2, 'user'),
(98, 9, 'error'),
(100, 9, 'page'),
(101, 9, 'user'),
(105, 1, 'askquestions'),
(107, 2, 'blog'),
(110, 3, 'blog'),
(111, 9, 'askquestions'),
(113, 1, 'simplewall'),
(116, 1, 'blog');

CREATE TABLE IF NOT EXISTS `arc_user_settings` (
`id` int(11) NOT NULL,
  `key` varchar(255) NOT NULL,
  `userid` int(11) NOT NULL,
  `setting` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `arc_wall` (
`id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `userid` int(11) NOT NULL,
  `posted` datetime NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

ALTER TABLE `arc_askquestions`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `arc_askquestion_groups`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `arc_askquestion_results`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `arc_blog`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `arc_blog_categories`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `arc_logs`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `arc_pages`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `arc_system_settings`
 ADD UNIQUE KEY `key` (`key`);

ALTER TABLE `arc_users`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `arc_user_groups`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `arc_user_permissions`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `arc_user_settings`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `arc_wall`
ADD PRIMARY KEY (`id`);

ALTER TABLE `arc_askquestions`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=757;

ALTER TABLE `arc_askquestion_groups`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;

ALTER TABLE `arc_askquestion_results`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;

ALTER TABLE `arc_blog`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=612;

ALTER TABLE `arc_logs`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;

ALTER TABLE `arc_pages`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;

ALTER TABLE `arc_users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=111;

ALTER TABLE `arc_user_groups`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;

ALTER TABLE `arc_user_permissions`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=117;

ALTER TABLE `arc_user_settings`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `arc_wall`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;

ALTER TABLE `arc_users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);
ALTER TABLE `arc_users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;