--
-- Table structure for table `arc_ecom_products`
--

CREATE TABLE `arc_ecom_products` (
  `id` int(11) NOT NULL,
  `categoryid` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `model` varchar(50) NOT NULL,
  `cost` decimal(10,2) NOT NULL,
  `rrp` decimal(10,2) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text NOT NULL,
  `ean` varchar(14) NOT NULL,
  `brandid` int(100) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for table `arc_ecom_products`
--
ALTER TABLE `arc_ecom_products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for table `arc_ecom_products`
--
ALTER TABLE `arc_ecom_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;