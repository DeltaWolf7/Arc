--
-- Table structure for table `arc_ecom_orderlines`
--

CREATE TABLE `arc_ecom_orderlines` (
  `id` int(11) NOT NULL,
  `orderid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `options` text NOT NULL,
  `cost` decimal(10,2) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for table `arc_ecom_orderlines`
--
ALTER TABLE `arc_ecom_orderlines`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for table `arc_ecom_orderlines`
--
ALTER TABLE `arc_ecom_orderlines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;