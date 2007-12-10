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

class kernel
{
	var $db;
	var $tpl;
	var $download;
	var $users;
	var $password;
	var $image_toolbox;
	var $image_thumbnailer;
	var $mail;
	var $skin;
	var $points;
	var $transfer;
	var $manage;
	var $upgrade;
	var $crypt;
	var $server;
	var $language;
	var $licensing;
	var $version;
	var $clean;
	var $crontab;
	var $memcache;
	var $ext;
	
	function kernel($config_file)
	{
		global $db;
		
		// Include config file into this scope
		if(file_exists($config_file))
		{
			include($config_file);
		}
		else
		{
			$conf = explode('|~|',$config_file);
			$dbServer = $conf[0];
			$dbUser = $conf[1];
			$dbPass = $conf[2];
			$dbName = $conf[3];
		}
		
		$this->ext = new stdClass();
		
		// Database Connection Class
		include_once('./include/kernel/db.php');
		$this->db = new db_conn();
		$this->db->connect($dbServer,$dbUser,$dbPass,$dbName);
		$db = $this->db;
		
		// String crypting class
		include_once('./include/kernel/crypt.php');
		$this->crypt = new encrypt('@#$34T78hinbuvyfG89JIBVYCUTF7G*Y(bvYF7G89huyf7UYIVF78hiuvYF789iuvyfi78Y9HIUGfi78GUYTUD67Tdtyrs4E7R6T7t8yUYI');
		
		// pHp Scrubing Bubles
		include_once('./include/kernel/phpFilter.php');
		$this->clean = new InputFilter();
		
		
		// eMailer System, Now with logging functionality!
		include_once('./include/kernel/mail.php');
		$this->mail = new xu_mail();
		
		// Points Class System, 1.5.0
		include_once('./include/kernel/points.php');
		$this->points = new points();
		
		// Class to manage the servers and select which one to upload files to for this visit.
		include_once('./include/kernel/server.php');
		$this->server = new server();
		
		// User Management Class
		include_once('./include/kernel/users.php');
		$this->users = new users();
		
		// Password generation class
		include_once('./include/kernel/password.php');
		$this->password = new pass();
		
		// PHP Crontab clone Class
		include_once('./include/kernel/crontab.php');
		$this->crontab = new crontab();
		
		// Template Parsing Class
		include_once('./include/kernel/template.php');
		$this->tpl = new template();
		
	}
	
	function loadUserExt($extName,$ret=false)
	{
		if(file_exists('./include/kernel/ext/'.$extName.'.php'))
		{
			include('./include/kernel/ext/'.$extName.'.php');
			if($ret)
			{
				return new $extName;
			}
			else
			{
				$this->ext->$extName = new $extName;
				return true;
			}
		}
		else
		{
			return false;
		}
	}
}
?>