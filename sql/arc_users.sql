--
-- Table structure for table `arc_users`
--

CREATE TABLE `arc_users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `passwordhash` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `groups` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Insert data for table `arc_users`
--

INSERT INTO `arc_users` (`id`, `firstname`, `lastname`, `email`, `passwordhash`, `created`, `enabled`, `groups`, `company`) VALUES
(1, 'Admin', 'Admin', 'admin@server.local', '$2y$10$V0uMtpafD9AniqZCdFp3xeGaMcLnQOsx7rqGG99juodlMfntUV/pm', '2017-01-01 00:00:00', 1, '["Users","Administrators"]', '[]');

--
-- Indexes for table `arc_users`
--
ALTER TABLE `arc_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for table `arc_users`
--
ALTER TABLE `arc_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
