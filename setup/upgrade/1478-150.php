<?php
/*
XtraUpload - File Hosting Software
Copyright (C) 2006-2007  Matthew Glinski and XtraFile.com
Link: http://www.xtrafile.com
-----------------------------------------------------------------
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program(LICENSE.txt); if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

$sql1 = "
CREATE TABLE `comments` 
(
  `id` tinyint(4) NOT NULL auto_increment,
  `title` text NOT NULL,
  `file` text NOT NULL,
  `author` text NOT NULL,
  `body` text NOT NULL,
  `status` text NOT NULL,
  `date` text NOT NULL,
  `url` text NOT NULL,
  `email` text NOT NULL,
  PRIMARY KEY  (`id`),
  FULLTEXT KEY `body` (`body`),
  FULLTEXT KEY `author` (`author`),
  FULLTEXT KEY `url` (`url`),
  FULLTEXT KEY `title` (`title`),
  FULLTEXT KEY `email` (`email`)
);
CREATE TABLE `syslog` 
(
  `id` tinyint(4) NOT NULL auto_increment,
  `desc` text NOT NULL,
  `action` text NOT NULL,
  `content` text NOT NULL,
  `status` text NOT NULL,
  `sector` text NOT NULL,
  `date` text NOT NULL,
  PRIMARY KEY  (`id`),
  FULLTEXT KEY `desc` (`desc`),
  FULLTEXT KEY `content` (`content`),
  FULLTEXT KEY `action` (`action`)
);
CREATE TABLE `dlsessions` 
(
  `id` tinyint(10) NOT NULL auto_increment,
  `ip` TEXT NOT NULL ,
  `user` TEXT NOT NULL ,
  `file` TEXT NOT NULL,
  PRIMARY KEY  (`id`)
);
CREATE TABLE `mods` 
(
  `id` TINYINT( 255 ) NOT NULL AUTO_INCREMENT,
  `name` TEXT NOT NULL ,
  `version` TEXT NOT NULL ,
  `author` TEXT NOT NULL ,
  `url` TEXT NOT NULL ,
  `desc` TEXT NOT NULL ,
  PRIMARY KEY(`id`),
  FULLTEXT (`name` ,`version` ,`author` ,`url` ,`desc`)
);
DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` 
(
  `id` int(11) NOT NULL auto_increment,
  `name` text NOT NULL,
  `value` text NOT NULL,
  `description1` text NOT NULL,
  `description2` text NOT NULL,
  `group` text NOT NULL,
  `type` text NOT NULL,
  `invincible` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
);
ALTER TABLE `downloads` ADD `ip` TEXT NOT NULL ;
ALTER TABLE `downloads` CHANGE `id` `id` INT( 32 ) NOT NULL AUTO_INCREMENT ;
ALTER TABLE `downloads` ADD INDEX ( `filename` ) ;
ALTER TABLE `downloads` ADD FULLTEXT (`ip`);
ALTER TABLE `downloads` ADD PRIMARY KEY ( `id` ) ;
ALTER TABLE `files` 
ADD `md5` VARCHAR( 32 ) NOT NULL ,
ADD `size` INT NOT NULL ;
ALTER TABLE `syslog` CHANGE `id` `id` BIGINT( 10 ) NOT NULL AUTO_INCREMENT ;
ALTER TABLE `ads` CHANGE `id` `id` INT( 255 ) NOT NULL AUTO_INCREMENT ;
ALTER TABLE `comments` CHANGE `id` `id` INT( 4 ) NOT NULL AUTO_INCREMENT ;
ALTER TABLE `dlsessions` CHANGE `id` `id` INT NOT NULL AUTO_INCREMENT ;
ALTER TABLE `mods` CHANGE `id` `id` INT( 255 ) NOT NULL AUTO_INCREMENT;
ALTER TABLE `news` CHANGE `id` `id` INT( 255 ) NOT NULL AUTO_INCREMENT ;
ALTER TABLE `payment` CHANGE `id` `id` INT( 2 ) NOT NULL AUTO_INCREMENT ;
ALTER TABLE `servers` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT ;
ALTER TABLE `files` CHANGE `id` `id` BIGINT( 11 ) NOT NULL AUTO_INCREMENT ;
ALTER TABLE `fitem` CHANGE `fid` `fid` TEXT NULL DEFAULT '';
ALTER TABLE `ads` CHANGE `impressions` `impressions` INT( 255 ) NULL DEFAULT '0',
CHANGE `clicks` `clicks` INT( 255 ) NULL DEFAULT '0';
ALTER TABLE `folder` ADD `admin_password` TEXT NOT NULL ;
ALTER TABLE `groups` ADD `file_expire` TINYINT( 1 ) NOT NULL, ADD `no_ads` TINYINT( 1 ) NOT NULL , ADD `show_direct_link` TINYINT( 1 ) NOT NULL , ADD `files_restrict_allowed` TINYINT( 1 ) NOT NULL ;
INSERT INTO `config` VALUES (1, 'sitename', 'Local Test Install ', 'Site Name:', '(Site Name)', 'Main Settings', 'text', 1);
INSERT INTO `config` VALUES (2, 'siteurl', 'http://localhost/', 'Site URL', '(URL to the Main Folder) ', 'Main Settings', 'text', 1);
INSERT INTO `config` VALUES (3, 'adminemail', 'admin@localhost', 'Admin Email Address', '(Your Email Address) ', 'Main Settings', 'text', 1);
INSERT INTO `config` VALUES (4, 'sess_time', '3600', 'Session Time Limit:', '( In Seconds)', 'Main Settings', 'text', 1);
INSERT INTO `config` VALUES (5, 'abs_path', '', 'Absolute path to the XU Directory', '( The Main Folder) ', 'Main Settings', 'text', 1);
INSERT INTO `config` VALUES (6, 'path', '/files/', 'File Storage Folder', '( Folder the uploaded files will be stored in ) ', 'Main Settings', 'text', 1);
INSERT INTO `config` VALUES (7, 'can_cgi', '0', 'Upload Method', 'CGI ( Progress bar, Slower)|-|PHP ( Faster, No Progress bar ) ', 'Feature Settings', 'yesno', 1);
INSERT INTO `config` VALUES (8, 'rewrite_links', '1', 'Use mod_rewrite Links? ', 'Yes ( Links look like: /files/2343n423i4n3i4)|-|No (Llinks look like: /download.php?hash=2343n423i4n3i4) ', 'Feature Settings', 'yesno', 1);
INSERT INTO `config` VALUES (9, 'allow_imaging', '1', 'Use Image Processing?', 'Yes ( Requires GD2 )|-|No (No BBCode links or Image Thumbnailing) ', 'Feature Settings', 'yesno', 1);
INSERT INTO `config` VALUES (10, 'allow_featured', '1', 'Allow Featured Uploads?', 'Yes|-|No  ', 'Feature Settings', 'yesno', 1);
INSERT INTO `config` VALUES (16, 'site_offline', '0', 'Site Closed', 'Yes, your site is closed|-|No, your site is open', 'Closure Settings', 'text\r\n', 1);
INSERT INTO `config` VALUES (17, 'offline_message', '<font size=\"4\"><font color=\"#ff0000\"><strong>Testing site closed system.</strong></font></font>', 'Site Offline Messaage', 'The message that is displayed if your site is offline.', 'Closure Settings', 'box', 1);
INSERT INTO `config` VALUES (18, 'metakey', '', 'Meta Tag: Keywords', 'Keywords that describe your site.', 'Site Meta', 'text', '1'); 
INSERT INTO `config` VALUES (19, 'metadesc', '', 'Meta Tag: Description', 'Your Site Description, to appear in the description < meta > tag.', 'Site Meta', 'text', '1');
INSERT INTO `config` VALUES (20, 'shortcut_icon', 'favicon.ico', 'Favicon', 'Your Site\'s Favicon URL', 'Site Meta', 'text', '1');
UPDATE `config` SET `id` = '9', `name` =  'allow_imaging', `value` = '1', `description1` = 'Use Image Processing?', `description2` = 'Yes ( Requires GD2 )|-|No (No BBCode links or Image Thumbnailing) ', `group` = 'Image Processing Settings', `type` = 'yesno', `invincible` = 1 WHERE `description2` = 'Yes ( Requires GD2 )|-|No (No BBCode links or Image Thumbnailing) ';
INSERT INTO `config` VALUES (22, 'imageCopyText', 'XtraUpload - Free File Hosting!', 'Uploaded Image Text', 'The Text to be displayed on all images uploaded that can be processed.', 'Image Processing Settings', 'text', 1);
INSERT INTO `config` VALUES (23, 'imageTextColor', '#ff0000', 'Uploaded Image Color', 'The color of the above text.', 'Image Processing Settings', 'color', 1);
INSERT INTO `config` VALUES (24, 'imageFontSize', 'dynamic', 'Uploaded Image Font Size', 'The font size in pixels to be written to a uploaded image.', 'Image Processing Settings', 'text', 1);
INSERT INTO `config` VALUES (25, 'version', '1.5.0,1.0.0.0', '', '', '', '', 1);
CREATE TABLE `transactions` (
`id` INT( 255 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`name` TEXT NOT NULL ,
`notes` TEXT NOT NULL ,
`postdata` TEXT NOT NULL ,
`result` TEXT NOT NULL ,
`ammount` TEXT NOT NULL ,
`email` TEXT NOT NULL ,
`username` TEXT NOT NULL ,
`password` TEXT NOT NULL ,
`processor` TEXT NOT NULL
) ENGINE = MYISAM ;
ALTER TABLE `files` ADD `report` TINYINT NOT NULL, ADD `ban` TINYINT NOT NULL;
INSERT INTO `payment` 
( `id` , `name` , `status` , `sell_id` , `f_name` , `price` , `cartid` , `address` )
VALUES 
(NULL , 'mb', '0', 'email@domain.com', 'MoneyBrokers', NULL, NULL , NULL), 
(NULL , 'stormpay', '1', 'email@domain.com', 'StormPay', NULL , NULL , NULL), 
(NULL , 'egold', '1', 'email@domain.com', 'eGold', NULL , NULL , NULL);
DROP TABLE IF EXISTS `lang`;
CREATE TABLE IF NOT EXISTS `lang` (
  `id` int(11) NOT NULL auto_increment,
  `default` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `name` text NOT NULL,
  `users` text NOT NULL,
  `file` text NOT NULL,
  `cc` text NOT NULL,
  PRIMARY KEY  (`id`),
  FULLTEXT KEY `name` (`name`)
) ENGINE=MyISAM;

INSERT INTO `lang` VALUES (1, 1, 1, 'English', '', 'english.php', 'us');
ALTER TABLE `dlinks` ADD `limit` INT NOT NULL ;
ALTER TABLE `users` ADD `lang` TEXT NOT NULL ;
ALTER TABLE `groups` ADD `max_file_streams` INT NOT NULL DEFAULT '1';
ALTER TABLE `files` ADD `reupload` TINYINT( 1 ) NOT NULL DEFAULT '0';

ALTER TABLE `users` DROP `first_name` ,
DROP `last_name` ,
DROP `street` ,
DROP `city` ,
DROP `state` ,
DROP `zip` ,
DROP `country` ,
DROP `telephone` ,
DROP `last_paid` ;

UPDATE  `faq_items` SET `answer` =  '<a href=\"-!-{$SITEURL}-!-index.php?p=tos\">TOS/AUP is Availabe Here</a>' WHERE `id` = 17;
UPDATE  `faq_items` SET `answer` =  'The maximum filesize depends on what type of user you are.<br />\r\nFor more information <a href=\"-!-{$SITEURL}-!-index.php?p=fastpass\">click here</a>' WHERE `id` = 11;
UPDATE  `faq_items` SET `answer` =  'We are available 24/7 to answer your questions through emails, to contact us, use our <a href=\"-!-{$SITEURL}-!-index.php?p=contactus\">contact form</a>.' WHERE `id` = 14;

UPDATE `skin` SET `active` = '0' WHERE `active` = '1';
INSERT INTO `skin` VALUES (5, 'Indigo', 1);
INSERT INTO `config` SET `value` = '1.5.0,1.0.0.0', `name` = 'version'
";


echo '-> Upgrading Database From XtraUpload 1.4.7.8 to XtraUpload 1.5.0... 
';
$sqls = explode(';',$sql1);
$i = 0;
foreach($sqls as $sql)
{
	$db->query($sql);
	echo '... ';
	$i++;
	if($i % 10 == 0)
	{
		echo "\n";
		$i=0;
	}
	flush();
}

echo '
-> Database Upgrade Complete!
->  '.$i.' Querys run!
-> Upgrading config.php file ...';

$dir=dirname('.'); 
$dir=explode('/public_html/',$dir); 
$dir=$dir[1]; 
$serverurl =  'http://'.$_SERVER['SERVER_NAME'].'/'.$dir;

include('config.php');
$configNew = '
<?PHP
// XtraUpload  |  1.5.0
// http://XtraFile.com/forums
// This file is (C) XtraFile.com
// All Rights Reserved Unless Explictly Noted.
/////////////////////////////
################
@session_start();
################
$dbServer = "'.$dbServer.'"; // mysql host
$dbUser = "'.$dbUser.'"; // mysql username
$dbPass = "'.$dbPass.'"; //mysql password
$dbName = "'.$dbName.'"; //mysql database
$trans = "'.$trans.'"; // Currently: EN = English, DE = Deutsch/German, SP = Spanish, KR = Korean, CH = Chinese, More to come soon!
$serverurl = "'.$serverurl.'"; // URL to compare to for Progress bar
?>';

$fp = fopen('config.php','w');
if($fp)
{
	fwrite($fp, $configNew);
	fclose($fp);
	echo '
-> New Config file writen';
}
else
{
	echo '
-> <font color="#FF0000"><b>ERROR!!!</b></font>
-> Could nont write to config file. Please copy+paste the following code into the config file relacing what is already there:
<textarea>'.$configNew.'</textarea';
}
// $configFile = file_get_contents('config.php');

echo '
-> Done!
--------------------------------------
';
?>