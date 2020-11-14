--
-- Table structure for table `arc_ecom_images`
--

CREATE TABLE `arc_ecom_images` (
  `id` int(11) NOT NULL,
  `imagetype` varchar(50) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `sortorder` int(11) NOT NULL,
  `productid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for table `arc_ecom_images`
--
ALTER TABLE `arc_ecom_images`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for table `arc_ecom_images`
--
ALTER TABLE `arc_ecom_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;