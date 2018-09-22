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

--
-- Table structure for table `arc_download_images`
--

CREATE TABLE `arc_download_images` (
  `id` int(11) NOT NULL,
  `downloadid` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
