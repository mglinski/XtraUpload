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

class pass
{
	var $vals = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabchefghjkmnpqrstuvwxyz0123456789';              
	var $length;
	
	function pass($length=10) 
	{
		$this->length = $length;
	}
	
	function gen($length=10) 
	{
		$password = "";
		$this->length = $length;
		while (strlen($password) < $this->length) 
		{
			mt_getrandmax();
			$num = rand() % strlen($this->vals);
			$password .= substr($this->vals, $num+4, 1);
		}
		return $password;
	}
	
	function gen_folder($length=6) 
	{
		$password = "";
		$this->length = $length;
		while (strlen($password) < $this->length) 
		{
			mt_getrandmax();
			$num = rand() % strlen($this->vals);
			$password .= substr($this->vals, $num+4, 1);
		}
		return $password;
	}

}
?>