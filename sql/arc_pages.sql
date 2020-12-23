CREATE TABLE `arc_pages` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `seourl` varchar(255) NOT NULL,
  `metadescription` varchar(255) NOT NULL,
  `metakeywords` varchar(255) NOT NULL,
  `sortorder` int(11) NOT NULL,
  `iconclass` varchar(50) NOT NULL,
  `showtitle` tinyint(1) NOT NULL,
  `hideonlogin` tinyint(1) NOT NULL,
  `hidefrommenu` tinyint(1) NOT NULL,
  `theme` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `arc_pages` (`id`, `title`, `content`, `seourl`, `metadescription`, `metakeywords`, `sortorder`, `iconclass`, `showtitle`, `hideonlogin`, `hidefrommenu`, `theme`) VALUES
(1, 'Error', '{{module:arc:error}}', 'error', '', '', 1, '', 0, 0, 1, 'none'),
(2, 'Welcome to Arc', '&lt;div class=&quot;alert alert-warning&quot;&gt;Development site, no content hosted here.&lt;/div&gt;\n\n\n&lt;div&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum lobortis sit amet erat eget lacinia. Suspendisse tincidunt et orci non malesuada. Nunc rutrum ac massa vel interdum. Vestibulum purus odio, porttitor ac lorem vitae, lacinia elementum risus. Aenean et ante quis erat tempus scelerisque. Praesent consequat nunc nibh, nec semper felis iaculis sit amet. Pellentesque aliquet lobortis felis id ornare. Etiam venenatis et metus vel cursus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Ut fringilla vestibulum lorem quis aliquet. Praesent at enim ante. Mauris euismod gravida arcu sit amet bibendum. Sed ornare magna sapien, ac lobortis felis ultricies eu.&lt;/div&gt;\n\n\n\n&lt;div&gt;&lt;br&gt;&lt;/div&gt;\n\n\n\n&lt;div&gt;Aenean at nibh scelerisque, fringilla justo id, tempor felis. Curabitur gravida pellentesque ipsum et imperdiet. Proin turpis magna, pretium ac eleifend nec, molestie at nunc. Etiam in scelerisque nisl. Maecenas nec pretium arcu, sed efficitur urna. Nulla ut consequat elit. Aliquam ultricies bibendum nulla varius venenatis. Cras accumsan malesuada erat a gravida. Vivamus eu erat et odio euismod dignissim placerat eget justo. Nulla varius ante vitae aliquam porta. Donec id commodo magna.&lt;/div&gt;\n\n\n\n&lt;div&gt;&lt;br&gt;&lt;/div&gt;\n\n\n\n&lt;div&gt;Vestibulum ut diam in erat ultricies eleifend nec eget mi. Vestibulum viverra sapien ac condimentum ullamcorper. Fusce sagittis pulvinar purus in euismod. Duis mattis sem vitae venenatis posuere. Etiam ac egestas lacus, sit amet tincidunt dui. Etiam at lectus et enim tempor dignissim sit amet sed sapien. Sed sit amet ultrices dolor. Etiam vel erat felis. Donec facilisis finibus justo, tincidunt tincidunt dui molestie in. Duis metus neque, tristique at massa maximus, pellentesque suscipit ipsum. Pellentesque tellus nunc, tristique nec mi et, faucibus posuere purus. Morbi aliquet, est dapibus suscipit viverra, massa diam pretium massa, vel fermentum orci tellus venenatis velit. Aliquam vehicula consectetur nibh. Sed non auctor justo. Praesent tincidunt, justo sit amet volutpat porttitor, metus ante molestie sem, eu pellentesque turpis arcu quis ipsum. Morbi faucibus ultrices libero a faucibus.&lt;/div&gt;\n\n\n\n&lt;div&gt;&lt;br&gt;&lt;/div&gt;\n\n\n\n&lt;div&gt;Vestibulum quam felis, porta et consectetur id, ullamcorper vitae libero. Cras id enim ullamcorper, bibendum arcu efficitur, faucibus quam. Proin ut arcu quis metus consequat maximus a non massa. Sed vel finibus nibh, nec luctus lectus. Proin consequat mi quis turpis dignissim dictum. Sed ac dui vestibulum, dignissim augue ut, porttitor ipsum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Sed fermentum, dui sit amet efficitur iaculis, ante nulla ultricies arcu, fermentum condimentum ante ipsum nec dolor. Fusce rhoncus leo eu nisl consectetur, vitae dictum urna tempus. Nullam vehicula ultrices semper. Aenean nibh mauris, convallis quis condimentum at, porta molestie sapien. Aliquam erat volutpat. Pellentesque purus velit, iaculis non mollis id, finibus at sem. Proin blandit magna ut mi consectetur, porta suscipit neque elementum. Integer facilisis quam sit amet nisl laoreet, nec tempus metus fermentum.&lt;/div&gt;\n\n\n\n&lt;div&gt;&lt;br&gt;&lt;/div&gt;\n\n\n\n&lt;div&gt;Aenean ut euismod lorem. Sed tincidunt orci vitae ante placerat, in eleifend diam luctus. Sed et lectus nec elit placerat pellentesque. Mauris molestie maximus velit, at elementum risus consectetur sit amet. Aenean elit massa, mollis nec lobortis non, viverra ut lectus. Fusce accumsan libero et blandit egestas. Cras ut luctus nisi. Phasellus aliquet congue lorem porta vehicula. Curabitur vel est placerat, euismod enim porta, malesuada neque.&lt;/div&gt;', 'welcome', 'Arc open source, multi-platform MVC style application development framework.', 'arc,welcome,deltawolf7,supportone,mvc,framework,ajax', 0, '', 1, 0, 0, 'none'),
(3, 'Page Manager', '{{module:arc:pagemanager}}\n', 'administration/pagemanager', '', '', 1, '', 1, 0, 0, 'none'),
(4, 'Login', '{{module:arc:login}}', 'login', '', '', 1, '', 1, 1, 0, 'none'),
(5, 'Logout', '{{module:arc:logout}}', 'account/logout', '', '', 999, '', 1, 0, 0, 'none'),
(6, 'User Details', '{{module:arc:userdetails}}', 'account/details', '', '', 1, '', 1, 0, 0, 'none'),
(7, 'Route Manager', '{{module:arc:routermanager}}\n', 'administration/router-manager', '', '', 0, '', 1, 0, 0, 'none'),
(8, 'System Logs', '&lt;p&gt;{{module:arc:logviewer}}&lt;br&gt;&lt;/p&gt;', 'administration/logs', '', '', 0, '', 1, 0, 0, 'none'),
(9, 'System Settings', '&lt;p&gt;{{module:arc:systemsettings}}&lt;br&gt;&lt;/p&gt;', 'administration/settings', '', '', 0, '', 1, 0, 0, 'none'),
(10, 'User Management', '&lt;p&gt;{{module:arc:users}}&lt;br&gt;&lt;/p&gt;', 'administration/users', '', '', 0, '', 1, 0, 0, 'none'),
(11, 'Media Manager', '&lt;p&gt;{{module:arc:mediamanager}}&lt;br&gt;&lt;/p&gt;', 'administration/media-manager', '', '', 0, '', 1, 0, 0, 'none'),
(12, 'Group Management', '&lt;p&gt;{{module:arc:groups}}&lt;br&gt;&lt;/p&gt;', 'administration/groups', '', '', 0, '', 1, 0, 0, 'none'),
(13, 'Sitemap Generator', '&lt;p&gt;{{module:arc:sitemap}}&lt;br&gt;&lt;/p&gt;', 'administration/sitemap', '', '', 0, '', 1, 0, 0, 'none'),
(14, 'Email manager', '&lt;p&gt;{{module:arc:emailmanager}}&lt;br&gt;&lt;/p&gt;', 'administration/email-manager', '', '', 0, '', 1, 0, 0, 'none');

ALTER TABLE `arc_pages`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `arc_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;