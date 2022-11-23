
CREATE TABLE `arc_servicedesk_comments` (
  `id` int NOT NULL,
  `userid` int NOT NULL,
  `created` datetime NOT NULL,
  `description` text NOT NULL,
  `ticketid` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


ALTER TABLE `arc_servicedesk_comments`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `arc_servicedesk_comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;

