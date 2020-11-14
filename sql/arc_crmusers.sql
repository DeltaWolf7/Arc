--
-- Table structure for table `arc_crmusers`
--

CREATE TABLE `arc_crmusers` (
  `id` int(11) NOT NULL,
  `company` varchar(50) NOT NULL,
  `source` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `notes` text NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE `arc_crmusers`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `arc_crmusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;
