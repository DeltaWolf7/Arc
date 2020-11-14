--
-- Table structure for table `arc_ecom_attribute_types`
--

CREATE TABLE `arc_ecom_attribute_types` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `isoption` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for table `arc_ecom_attribute_types`
--
ALTER TABLE `arc_ecom_attribute_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for table `arc_ecom_attribute_types`
--
ALTER TABLE `arc_ecom_attribute_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;