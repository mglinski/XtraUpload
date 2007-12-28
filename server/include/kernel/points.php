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
class points
{
	var $current_points;
	var $myuid;
	var $addto = 1;
	var $takefrom = 1;
	var $group;
	var $points_session;
	var $can;
	
	function points($myuid='')
	{
		if($myuid != '')
		{
			$this->pre($myuid);
		}
	}
	
	function pre($myuid)
	{
		global $db;
		if($myuid=='')
		{
			return false;
		}
		$this->myuid = $myuid;
		$ret = $db->fetch($db->query("SELECT * FROM `users` WHERE `uid` = '".$this->myuid."'"));
		$this->current_points = $ret->points;
		$this->addto = 1;
		$this->takefrom = 1;
		$this->group = $ret->group;
		$this->can = $this->read_session();
		$this->clean_session();
		return false;
	}
	
	function add()
	{
		global $db;
		if($this->can)
		{
			$new_points = $this->current_points + $this->addto;
			$db->query("UPDATE `users` SET `points` = '".$new_points."' WHERE `uid` = '".$this->myuid."'");
			$this->insert_session();
			$this->write_session();
		}
		return false;
	}
	
	function download_add($file)
	{
		global $db;
		if($this->can)
		{
			if($this->check_user($file))
			{
				$new_points = $this->current_points + $this->addto;
				$db->query("UPDATE `users` SET `points` = '".$new_points."' WHERE `uid` = '".$this->myuid."'");
				$this->insert_session();
				$this->write_session();
			}
		}
		return false;
	}
	
	function subtract()
	{
		global $db;
		$new_points = $this->current_points - $this->takefrom;
		$db->query("UPDATE `users` SET `points` = '".$new_points."' WHERE `uid` = '".$this->myuid."'");
		return false;
	}
	
	function total()
	{
		global $db;
		$SQL1 = "SELECT * FROM `users` WHERE `uid` = '".$this->myuid."'";
		$result1 = $db->query($SQL1);
		$points = $db->fetch($result1,"obj");
		return $points->points;
	}
	
	function read_session()
	{
		$serial = $_SESSION['points'];
		$points_arr = unserialize($serial);
		$this->points_session = $points_arr;
		if(count($points_arr) >= 6)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	
	function write_session()
	{
		$_SESSION['points'] = serialize($this->points_session);
	}
	
	function clean_session()
	{
		$points_arr = $this->points_session;
		$new = array();
		foreach($points_arr as $key => $value)
		{
			if(!($key + 3600) < (time()) )
			{
				$new[$key] = $value;
			}
		}
		$this->points_session = $new;
	}
	
	function insert_session()
	{
		$points_arr = $this->points_session;
		$points_arr["".time().""] = '';
		$this->points_session = $points_arr;
	}
	
	function check_user($file)
	{
		global $db;
		$ret = $db->fetch($db->query("SELECT * FROM `files` WHERE `hash` = '".$file."'"),'obj');
		if($ret->user != $this->myuid)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}
?>