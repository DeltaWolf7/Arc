--
-- Table structure for table `arc_ecom_attributes`
--

CREATE TABLE `arc_ecom_attributes` (
  `id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL,
  `productid` int(11) NOT NULL,
  `priceadjust` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `typeid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for table `arc_ecom_attributes`
--
ALTER TABLE `arc_ecom_attributes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for table `arc_ecom_attributes`
--
ALTER TABLE `arc_ecom_attributes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;