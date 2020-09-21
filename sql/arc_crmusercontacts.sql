--
-- Table structure for table `arc_crmusercontacts`
--

CREATE TABLE `arc_crmusercontacts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `title` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `arc_crmusercontacts`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `arc_crmusercontacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;
