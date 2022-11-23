

CREATE TABLE `arc_apikeys` (
  `id` int NOT NULL,
  `userid` int NOT NULL,
  `apikey` varchar(255) NOT NULL,
  `secrethash` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


ALTER TABLE `arc_apikeys`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `arc_apikeys`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;
