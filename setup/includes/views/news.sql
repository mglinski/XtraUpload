
--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL auto_increment,
  `date` int(11) NOT NULL,
  `author` varchar(30) collate latin1_general_ci NOT NULL,
  `title` varchar(150) collate latin1_general_ci NOT NULL,
  `body` text collate latin1_general_ci NOT NULL,
  `approved` tinyint(1) NOT NULL default '0',
  `category` varchar(100) collate latin1_general_ci NOT NULL,
  `tags` text collate latin1_general_ci NOT NULL,
  `archived` tinyint(4) NOT NULL default '0',
  `rand_id` varchar(8) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `rand_id` (`rand_id`),
  FULLTEXT KEY `search` (`author`,`title`,`body`,`category`,`tags`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `news`
--


-- --------------------------------------------------------

--
-- Table structure for table `newscat`
--

CREATE TABLE `newscat` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) collate latin1_general_ci NOT NULL,
  `description` text collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `newscat`
--
