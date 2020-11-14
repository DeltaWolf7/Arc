--
-- Table structure for table `arc_ecom_brands`
--

CREATE TABLE `arc_ecom_brands` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for table `arc_ecom_brands`
--
ALTER TABLE `arc_ecom_brands`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for table `arc_ecom_brands`
--
ALTER TABLE `arc_ecom_brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;