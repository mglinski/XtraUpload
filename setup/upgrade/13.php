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
INSERT INTO `config` ( `id` , `name` , `value` , `description1` , `description2` , `group` , `type` , `invincible` )
VALUES 
(NULL , 'use_memcache', '0', 'Use Memcache', 'Yes|-|No', 'Memcache', 'yesno', '1'), 
(NULL , 'memcache_port', '11211', 'Memcache Server Port', 'The port php will connect to memcache with(default is 11211).', 'Memcache', 'text', '1'),
(NULL , '$memcache_server', 'localhost', 'Server Url', 'The url to the memcache server', 'Memcache', 'text', '1');


ALTER TABLE dlinks
    ALTER `limit` SET DEFAULT 0,
    ADD INDEX `time` (`time`(14));


ALTER TABLE dlsessions
    ADD INDEX ip (ip(16));


ALTER TABLE downloads
    DROP INDEX id;


ALTER TABLE faq
    ALTER pos SET DEFAULT 0;


ALTER TABLE faq_items
    ALTER pos SET DEFAULT 0,
    ALTER faq SET DEFAULT 0,
    ALTER status SET DEFAULT 0;


ALTER TABLE files
    ALTER size SET DEFAULT 0,
    ALTER ban SET DEFAULT 0,
    ALTER report SET DEFAULT 0,
    DROP INDEX filename,
    ADD INDEX filename1 (filename(40)),
    ADD INDEX featured (featured, password(40), approved, status),
    ADD INDEX user (ipaddress(16), description(255), `group`(1));

ALTER TABLE groups
    ALTER show_direct_link SET DEFAULT 0,
    ALTER files_restrict_allowed SET DEFAULT 0,
    ALTER no_ads SET DEFAULT 0,
    ALTER file_expire SET DEFAULT 0;


ALTER TABLE lang
    ALTER `default` SET DEFAULT 0,
    ALTER status SET DEFAULT 0;



ALTER TABLE transactions
    ALTER approved SET DEFAULT 0;


ALTER TABLE users
    ALTER lang SET DEFAULT 0;

UPDATE `config` SET `value` = '1.6.0,0.0.1.0' WHERE `name` = 'version'
";

echo '-> Upgrading From XtraUpload 1.5.6 STABLE to XtraUpload 1.6 BETA 1.';
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