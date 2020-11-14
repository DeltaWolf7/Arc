--
-- Table structure for table `arc_ecom_deliveries`
--

CREATE TABLE `arc_ecom_deliveries` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `maxweightkg` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for table `arc_ecom_deliveries`
--
ALTER TABLE `arc_ecom_deliveries`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for table `arc_ecom_deliveries`
--
ALTER TABLE `arc_ecom_deliveries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;