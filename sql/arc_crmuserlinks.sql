CREATE TABLE `arc_crmuserlinks` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `linkedid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE `arc_crmuserlinks`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `arc_crmuserlinks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;