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
class users
{
	var $name;
	var $pass;
	var $perm_level;
	var $ipaddr;
	var $sess_time;
	var $userid;
	var $isadmin;
	var $loggedin;
	var $session_time;
	var $unique_id;

	function users()
	{
		
	}
	
	function pre($name='',$pass='',$time = 3600)
	{
		$this->name = $name;
		$this->sess_time = $time;
		$this->pass = $pass;
		$this->clean_acc();
	}
	
	function login()
	{
		$this->login_auth();
		
		if($this->loggedin)
		{
			return true;
		}
		else
		{
			$this->terminate();
			return false;
		}
	}

	function check_sess()
	{
		
		$session = (( (int)$_SESSION['time'] ) + ((int)$this->sess_time));
		if($session < time() )
		{
			$this->terminate();
			return false;
		}
		return true;
	}
	
	function login_auth()
	{
		global $db,$sitename,$siteurl;
		$sql = "SELECT * FROM users WHERE username = '".$this->name."' AND password = '".$this->pass."' AND status='1'";
		$res = $db->query($sql);
		$res1 = $db->fetch($res,'obj');
		$num = $db->num($res);

		if($num == '1')
		{
			//$db->query("UPDATE users SET ipaddr = '".$_SERVER['REMOTE_ADDR']."' WHERE username = '".$this->name."'");
			$this->ipaddr = $_SERVER['REMOTE_ADDR'];
			$this->isadmin = $res1->isadmin;
			$this->perm_level = $res1->group;
			$this->userid = $res1->uid;
			$this->loggedin =  true;
		}
		else
		{
			$this->loggedin = false;
		}
	}

	function terminate()
	{
		session_destroy();
		return false;
	}

	function clean_acc()
	{
		global $db,$sitename,$siteurl;
		$sql = "SELECT * FROM users WHERE status = '1' AND expire >= '".time()."' AND username = '".$this->name."' ";
		$res = $db->query($sql);
		while( $a = $db->fetch($res,'obj'))
		{
			if($a->isadmin != '1')
			{
				$sql =  "UPDATE users SET status = '0' WHERE uid = '".$a->id."' ";
				$db->query($sql);
			}
		}
	}
}
?>