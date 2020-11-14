--
-- Table structure for table `arc_ecom_categories`
--

CREATE TABLE `arc_ecom_categories` (
  `id` int(11) NOT NULL,
  `parentid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for table `arc_ecom_categories`
--
ALTER TABLE `arc_ecom_categories`
  ADD PRIMARY KEY (`id`);
COMMIT;

ALTER TABLE `arc_ecom_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;