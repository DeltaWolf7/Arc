CREATE TABLE `arc_system_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `skey` varchar(100) NOT NULL,
  `svalue` text NOT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=19;

INSERT INTO `arc_system_settings` (`id`, `skey`, `svalue`, `userid`) VALUES
(1, 'ARC_KEEP_LOGS', '31', 0),
(2, 'ARC_ISINIT', '1', 0),
(3, 'ARC_MAIL', '{"smtp":"false", "server":"localhost", "username":"", "password":"HE19nGbVr+UH35gdSBGu9A==", "port":"25", "sender":"Admin <admin@server.local>"}', 0),
(4, 'ARC_LOGIN_URL', '', 0),
(5, 'ARC_FILE_UPLOAD_SIZE_BYTES', '2000000', 0),
(6, 'ARC_THUMB_WIDTH', '80', 0),
(7, 'ARC_THEME', 'default', 0),
(8, 'ARC_DEFAULT_PAGE', 'welcome', 0),
(9, 'ARC_LDAP', '{"ldap":"false", "server":"localhost", "domain":"mydomain", "base":"dc=mydomain,dc=local"}', 0),
(10, 'ARC_PASSWORD_RESET_MESSAGE', 'You or someone else has requested a password reset.&lt;br /&gt;Your new password is \'{password}\'.', 0),
(11, 'ARC_ALLOWREG', 'false', 0),
(12, 'ARC_LOGO_PATH', 'assets/logo-200x48-dark.png', 0),
(13, 'ARC_DATEFORMAT', 'd-m-Y', 0),
(14, 'ARC_TIMEFORMAT', 'H:i:s', 0),
(15, 'ARC_REQUIRECOMPANY', 'false', 0),
(16, 'ARC_SITETITLE', 'Arc Project', 0),
(17, 'ARC_MEDIAMANAGERURL', 'administration/media-manager', 0),
(18, 'ARC_USER_IMAGE', '58f0990fef058.jpg', 2);