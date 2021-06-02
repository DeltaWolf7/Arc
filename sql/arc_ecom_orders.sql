
CREATE TABLE `arc_ecom_orders` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `vat` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `shipping` text NOT NULL,
  `status` varchar(20) NOT NULL,
  `billing` text NOT NULL,
  `shippingtypeid` int(11) NOT NULL,
  `paymentdata` text NOT NULL,
  `weight` decimal(10,2) NOT NULL,
  `shippingprice` decimal(10,2) NOT NULL,
  `tracking` varchar(100) NOT NULL,
  `dropshiporder` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE `arc_ecom_orders`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `arc_ecom_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000;
COMMIT;

