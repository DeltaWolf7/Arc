
CREATE TABLE `arcforum_categories` (
  `id` int(11) NOT NULL,
  `parentid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `arcforum_posts` (
  `id` int(11) NOT NULL,
  `posterid` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `posted` datetime NOT NULL,
  `categoryid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `arcforum_categories`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `arcforum_posts`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `arcforum_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `arcforum_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

