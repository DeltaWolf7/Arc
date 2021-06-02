CREATE TABLE `arc_ecom_deliveries` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `maxweightkg` decimal(10,2) NOT NULL,
  `enabled` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE `arc_ecom_deliveries`
  ADD PRIMARY KEY (`id`);

-
ALTER TABLE `arc_ecom_deliveries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

