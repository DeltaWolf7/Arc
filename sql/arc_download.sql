--
-- Table structure for table `arc_downloads`
--

CREATE TABLE `arc_downloads` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `version` varchar(50) NOT NULL,
  `file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `arc_downloads`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `arc_downloads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Table structure for table `arc_download_images`
--

CREATE TABLE `arc_download_images` (
  `id` int(11) NOT NULL,
  `downloadid` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `arc_download_images`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `arc_download_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Table structure for table `arc_download_stats`
--

CREATE TABLE `arc_download_stats` (
  `id` int(11) NOT NULL,
  `downloadid` int(11) NOT NULL,
  `browser` varchar(255) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `arc_download_stats`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `arc_download_stats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
