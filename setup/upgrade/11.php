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
ALTER TABLE `groups` ADD `shownUploadMethod` INT NOT NULL DEFAULT '1';
UPDATE `faq_items` SET `answer` = '<a href=\"-SITEURL-index.php?p=tos\">Our TOS/AUP is Availabe Here</a>' WHERE `faq_items`.`id` =17 LIMIT 1 ;
UPDATE `faq_items` SET `answer` = 'We are available 24/7 to answer your questions through emails, to contact us, use our <a href=\"-SITEURL-index.php?p=contactus\">contact form</a>.' WHERE `faq_items`.`id` =14 LIMIT 1 ;
UPDATE `faq_items` SET `answer` = 'The maximum filesize depends on what type of user you are.<br /> For more information <a href=\"-SITEURL-index.php?p=fastpass\">click here</a>. ' WHERE `faq_items`.`id` =11 LIMIT 1 ;

UPDATE `config` SET `value` = '1.5.5,1.0.0.0' WHERE `name` = 'version'
";

echo '-> Upgrading From XtraUpload 1.5.4 STABLE to XtraUpload 1.5.5 STABLE.';
$sqls = explode(';', $sql1);
$i = 0;
foreach($sqls as $sql)
{
	$db->query($sql);
	$i++;
	flush();
}
echo '
-> Done, '.$i.' Querys Run!
--------------------------------------';
?>