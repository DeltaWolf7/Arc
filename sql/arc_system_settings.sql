CREATE TABLE `arc_system_settings` (
  `id` int(11) NOT NULL,
  `skey` varchar(100) NOT NULL,
  `svalue` text NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `arc_system_settings` (`id`, `skey`, `svalue`, `userid`) VALUES
(1, 'ARC_KEEP_LOGS', '30', 0),
(2, 'ARC_MAIL_USESMTP', '0', 0),
(3, 'ARC_MAIL_SERVER', 'localhost', 0),
(4, 'ARC_MAIL_USERNAME', '', 0),
(5, 'ARC_MAIL_PASSWORD', '', 0),
(6, 'ARC_MAIL_PORT', '25', 0),
(7, 'ARC_MAIL_SENDER', 'admin@server.local', 0),
(8, 'ARC_LOGIN_URL', '', 0),
(9, 'ARC_FILE_UPLOAD_SIZE_BYTES', '2000000', 0),
(10, 'ARC_THEME', 'ace', 0),
(11, 'ARC_DEFAULT_PAGE', 'welcome', 0),
(12, 'ARC_LDAP_ENABLED', '0', 0),
(13, 'ARC_LDAP_SERVER', 'localhost', 0),
(14, 'ARC_LDAP_DOMAIN', 'mydomain', 0),
(15, 'ARC_LDAP_BASE', 'dc=mydomain,dc=local', 0),
(16, 'ARC_ALLOWREG', 'true', 0),
(17, 'ARC_LOGO_PATH', 'assets/logo-200x48-light.png', 0),
(18, 'ARC_DATEFORMAT', 'd-m-Y', 0),
(19, 'ARC_TIMEFORMAT', 'H:i:s', 0),
(20, 'ARC_SITETITLE', 'Arc Project', 0),
(21, 'ARC_MEDIAMANAGERURL', 'administration/media-manager', 0),
(22, 'ARC_GADSENSE', '', 0);

ALTER TABLE `arc_system_settings`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `arc_system_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;