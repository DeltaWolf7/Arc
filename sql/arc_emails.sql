CREATE TABLE `arc_emails` (
  `id` int(11) NOT NULL,
  `key` varchar(50) NOT NULL,
  `subject` varchar(150) NOT NULL,
  `text` text NOT NULL,
  `protected` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `arc_emails` (`id`, `key`, `subject`, `text`, `protected`) VALUES
(1, 'ARC_PASSWORD_RESET', 'Password Reset', 'You or someone else has requested a password reset.&lt;br /&gt;Your new password is \'{password}\'.', 1);


ALTER TABLE `arc_emails`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `arc_emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;