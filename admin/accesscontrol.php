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

include_once('admin/inc/func.php');

if($site_offline)
{
	if(!(isset($_SESSION['a_id'])) && $_SESSION['a_id'] != '')
	{
		header("location: ./login.php");
		exit();
	}
	else if(!(isset($_SESSION['isadmin'])) && $_SESSION['isadmin'] != '1')
	{
		header("location: ./login.php");
		exit();
	}
	else if(!isset($_SESSION['adminSecret']) or md5(getAdminSessionString()) != $_SESSION['adminSecret'])
	{
		header("location: ./login.php");
		exit();
	}
	else if($_SESSION['adminTime'] < time())
	{
		$script = explode('admin/', $_SERVER['SCRIPT_NAME']);
		$script = $script[1];
		header("location: ./login.php?redirect=".urlencode('./'.$script.'?'.$_SERVER['QUERY_STRING']));
		exit();
	}
	else
	{
		$_SESSION['adminTime'] = (time() + 1800);	
	}
}
else
{
	if(!(isset($_SESSION['a_id'])) && $_SESSION['a_id'] != '')
	{
		header("location: ".makeXuLink('index.php','p=login'));
		exit();
	}
	else if(!(isset($_SESSION['isadmin'])) && $_SESSION['isadmin'] != '1')
	{
		header("location: ".makeXuLink('index.php','p=login'));
		exit();
	}
	else if(!isset($_SESSION['adminSecret']) or md5(getAdminSessionString()) != $_SESSION['adminSecret'])
	{
		header("location: ./login.php");
		exit();
	}
	else if($_SESSION['adminTime'] < time())
	{
		$script = explode('admin/', $_SERVER['SCRIPT_NAME']);
		$script = $script[1];
		header("location: ./login.php?redirect=".urlencode('./'.$script.'?'.$_SERVER['QUERY_STRING']));
		exit();
	}
	else
	{
		$_SESSION['adminTime'] = (time() + 1800);	
	}
}
?>