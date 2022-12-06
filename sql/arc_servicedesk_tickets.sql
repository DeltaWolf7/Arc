
CREATE TABLE `arc_servicedesk_tickets` (
  `id` int NOT NULL,
  `summary` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  `created` datetime NOT NULL,
  `assignedto` int NOT NULL,
  `userid` int NOT NULL,
  `description` text NOT NULL,
  `labels` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


ALTER TABLE `arc_servicedesk_tickets`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `arc_servicedesk_tickets`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;

