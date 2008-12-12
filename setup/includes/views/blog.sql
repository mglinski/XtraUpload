-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL auto_increment,
  `date` int(11) NOT NULL,
  `author` varchar(30) collate latin1_general_ci NOT NULL,
  `title` varchar(150) collate latin1_general_ci NOT NULL,
  `body` text collate latin1_general_ci NOT NULL,
  `approved` tinyint(1) NOT NULL default '0',
  `comments` tinyint(1) NOT NULL default '1',
  `category` varchar(100) collate latin1_general_ci NOT NULL,
  `tags` text collate latin1_general_ci NOT NULL,
  `archived` tinyint(4) NOT NULL default '0',
  `rand_id` varchar(8) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `rand_id` (`rand_id`),
  FULLTEXT KEY `search` (`author`,`title`,`body`,`tags`,`category`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `blog`
--


-- --------------------------------------------------------

--
-- Table structure for table `blogcat`
--

CREATE TABLE `blogcat` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) collate latin1_general_ci NOT NULL,
  `description` text collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `blogcat`
--


-- --------------------------------------------------------

--
-- Table structure for table `blogcomments`
--

CREATE TABLE `blogcomments` (
  `id` int(11) NOT NULL auto_increment,
  `pid` int(11) NOT NULL,
  `author` varchar(40) collate latin1_general_ci NOT NULL,
  `link` varchar(150) collate latin1_general_ci NOT NULL,
  `email` varchar(200) collate latin1_general_ci NOT NULL,
  `body` text collate latin1_general_ci NOT NULL,
  `time` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `approved` tinyint(1) NOT NULL default '1',
  `ip` varchar(15) collate latin1_general_ci NOT NULL default '0.0.0.0',
  PRIMARY KEY  (`id`),
  FULLTEXT KEY `search` (`author`,`link`,`email`,`body`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `blogcomments`
--