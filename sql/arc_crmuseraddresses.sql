CREATE TABLE `arc_crmuseraddresses` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `addresslines` text NOT NULL,
  `county` varchar(50) NOT NULL,
  `postcode` varchar(10) NOT NULL,
  `country` varchar(50) NOT NULL,
  `isdelivery` tinyint(4) NOT NULL,
  `isbilling` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for table `arc_crmuseraddresses`
--
ALTER TABLE `arc_crmuseraddresses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for table `arc_crmuseraddresses`
--
ALTER TABLE `arc_crmuseraddresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;