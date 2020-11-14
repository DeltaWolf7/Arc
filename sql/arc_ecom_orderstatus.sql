--
-- Table structure for table `arc_ecom_orderstatus`
--

CREATE TABLE `arc_ecom_orderstatus` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `arc_ecom_orderstatus` (`id`, `name`) VALUES
(1, 'Unconfirmed'),
(2, 'Pending'),
(3, 'Payment Failure'),
(4, 'Complete'),
(5, 'Cancelled'),
(6, 'Refunded'),
(7, 'Backorder'),
(8, 'Waiting Payment');

--
-- Indexes for table `arc_ecom_orderstatus`
--
ALTER TABLE `arc_ecom_orderstatus`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for table `arc_ecom_orderstatus`
--
ALTER TABLE `arc_ecom_orderstatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;