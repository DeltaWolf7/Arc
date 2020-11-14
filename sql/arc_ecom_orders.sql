--
-- Table structure for table `arc_ecom_orders`
--

CREATE TABLE `arc_ecom_orders` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `vat` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `shipping` decimal(10,2) NOT NULL,
  `shippingid` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `billingid` int(11) NOT NULL,
  `shippingtypeid` int(11) NOT NULL,
  `paymentdata` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for table `arc_ecom_orders`
--
ALTER TABLE `arc_ecom_orders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for table `arc_ecom_orders`
--
ALTER TABLE `arc_ecom_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;