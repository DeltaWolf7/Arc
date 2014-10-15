--
-- Table structure for table `will_addresses`
--

CREATE TABLE IF NOT EXISTS `will_addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `clientid` int(11) NOT NULL,
  `address1` varchar(100) NOT NULL,
  `address2` varchar(100) NOT NULL,
  `address3` varchar(100) NOT NULL,
  `postcode` varchar(10) NOT NULL,
  `pri` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;



-- --------------------------------------------------------

--
-- Table structure for table `will_clients`
--

CREATE TABLE IF NOT EXISTS `will_clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `sex` varchar(1) NOT NULL,
  `disabled` tinyint(1) NOT NULL,
  `phone` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `will_wills`
--

CREATE TABLE IF NOT EXISTS `will_wills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `clientid` int(11) NOT NULL,
  `partnerid` int(11) NOT NULL,
  `relationship` varchar(20) NOT NULL,
  `exe1` int(11) NOT NULL,
  `exe2` int(11) NOT NULL,
  `exe3` int(11) NOT NULL,
  `exe4` int(11) NOT NULL,
  `gua` varchar(3) NOT NULL,
  `gua1` int(11) NOT NULL,
  `gua2` int(11) NOT NULL,
  `gua3` int(11) NOT NULL,
  `gua4` int(11) NOT NULL,
  `legacies` varchar(3) NOT NULL,
  `legs` text NOT NULL,
  `charchoice` varchar(3) NOT NULL,
  `char` text NOT NULL,
  `property` varchar(3) NOT NULL,
  `prop` text NOT NULL,
  `res1` int(11) NOT NULL,
  `res2` int(11) NOT NULL,
  `res3` int(11) NOT NULL,
  `res4` int(11) NOT NULL,
  `custom` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;
