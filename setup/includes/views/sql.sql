
CREATE TABLE `bans` (
  `id` int(11) NOT NULL auto_increment,
  `md5` varchar(32) collate latin1_general_ci NOT NULL,
  `name` text collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `md5` (`md5`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `bans`
--


-- --------------------------------------------------------

--
-- Table structure for table `captcha`
--

CREATE TABLE `captcha` (
  `captcha_id` bigint(13) unsigned NOT NULL auto_increment,
  `captcha_time` text collate latin1_general_ci NOT NULL,
  `ip_address` varchar(16) collate latin1_general_ci NOT NULL default '0',
  `word` varchar(20) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`captcha_id`),
  KEY `word` (`word`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `captcha`
--


-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `id` int(11) NOT NULL auto_increment,
  `name` text collate latin1_general_ci NOT NULL,
  `value` text collate latin1_general_ci NOT NULL,
  `description1` text collate latin1_general_ci NOT NULL,
  `description2` text collate latin1_general_ci NOT NULL,
  `group` text collate latin1_general_ci NOT NULL,
  `type` text collate latin1_general_ci NOT NULL,
  `invincible` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=30 ;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `name`, `value`, `description1`, `description2`, `group`, `type`, `invincible`) VALUES
(1, 'sitename', 'XtraUpload v2', 'Site Name:', '(Site Name)', 'Main Settings', 'text', 1),
(2, 'slogan', 'Preview', 'Your Site Slogan', '', 'Main Settings', 'text', 1);

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL auto_increment,
  `filename` text collate latin1_general_ci NOT NULL,
  `size` int(11) NOT NULL,
  `md5` varchar(32) collate latin1_general_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `type` varchar(10) collate latin1_general_ci NOT NULL,
  `prefix` varchar(2) collate latin1_general_ci NOT NULL,
  `is_image` tinyint(1) NOT NULL default '0',
  `thumb` text collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `md5` (`md5`),
  KEY `prefix` (`prefix`),
  KEY `type` (`type`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `files`
--


-- --------------------------------------------------------

--
-- Table structure for table `folder`
--

CREATE TABLE `folder` (
  `id` int(11) NOT NULL auto_increment,
  `f_id` varchar(8) collate latin1_general_ci NOT NULL,
  `name` text collate latin1_general_ci NOT NULL,
  `descr` text collate latin1_general_ci NOT NULL,
  `pass` varchar(64) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `f_id` (`f_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `folder`
--


-- --------------------------------------------------------

--
-- Table structure for table `f_items`
--

CREATE TABLE `f_items` (
  `id` int(11) NOT NULL auto_increment,
  `folder_id` varchar(8) collate latin1_general_ci NOT NULL,
  `file_id` varchar(16) collate latin1_general_ci NOT NULL,
  `view` text collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `f_items`
--


-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL auto_increment,
  `g_id` varchar(8) collate latin1_general_ci NOT NULL,
  `name` text collate latin1_general_ci NOT NULL,
  `descr` text collate latin1_general_ci NOT NULL,
  `pass` varchar(64) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `g_id` (`g_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `gallery`
--


-- --------------------------------------------------------

--
-- Table structure for table `g_items`
--

CREATE TABLE `g_items` (
  `id` int(11) NOT NULL auto_increment,
  `gid` varchar(8) collate latin1_general_ci NOT NULL,
  `thumb` text collate latin1_general_ci NOT NULL,
  `direct` text collate latin1_general_ci NOT NULL,
  `fid` varchar(16) collate latin1_general_ci NOT NULL,
  `view` text collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `g_items`
--


-- -------------------------------------------------------

--
-- Table structure for table `progress`
--

CREATE TABLE `progress` (
  `id` int(11) NOT NULL auto_increment,
  `progress` bigint(1) NOT NULL,
  `curr_time` text collate latin1_general_ci NOT NULL,
  `total` varchar(50) collate latin1_general_ci NOT NULL,
  `start_time` text collate latin1_general_ci NOT NULL,
  `fid` varchar(16) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `fid` (`fid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `progress`
--


-- --------------------------------------------------------

--
-- Table structure for table `refrence`
--

CREATE TABLE `refrence` (
  `id` int(11) NOT NULL auto_increment,
  `file_id` varchar(16) collate latin1_general_ci NOT NULL,
  `descr` text collate latin1_general_ci NOT NULL,
  `password` varchar(32) collate latin1_general_ci NOT NULL,
  `o_filename` text collate latin1_general_ci NOT NULL,
  `secid` varchar(32) collate latin1_general_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `ip` varchar(15) collate latin1_general_ci NOT NULL,
  `link_name` text collate latin1_general_ci NOT NULL,
  `feature` tinyint(1) NOT NULL,
  `user` int(11) NOT NULL,
  `type` varchar(10) collate latin1_general_ci NOT NULL,
  `time` varchar(20) collate latin1_general_ci NOT NULL,
  `pass` varchar(32) collate latin1_general_ci NOT NULL,
  `rate_num` int(11) NOT NULL,
  `rate_total` int(11) NOT NULL,
  `is_image` tinyint(1) NOT NULL,
  `link_id` varchar(16) collate latin1_general_ci NOT NULL,
  `downloads` int(11) NOT NULL,
  `featured` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `file_id` (`file_id`),
  KEY `feature` (`feature`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `refrence`
--


-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `session_id` varchar(40) collate latin1_general_ci NOT NULL default '0',
  `ip_address` varchar(16) collate latin1_general_ci NOT NULL default '0',
  `user_agent` varchar(50) collate latin1_general_ci NOT NULL,
  `last_activity` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `sessions`
--


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(16) collate latin1_general_ci NOT NULL,
  `password` varchar(32) collate latin1_general_ci NOT NULL,
  `time` int(9) NOT NULL,
  `lastLogin` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `ip` varchar(15) collate latin1_general_ci NOT NULL default '0.0.0.0',
  `email` varchar(255) collate latin1_general_ci NOT NULL,
  `admin` tinyint(1) NOT NULL default '0',
  `group` tinyint(4) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `email` (`email`),
  KEY `group` (`group`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `time`, `lastLogin`, `status`, `ip`, `email`, `admin`, `group`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1205451610, 0, 1, '127.0.0.1', 'matthewglinski@gmail.com', 1, 0);
