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

class virusScanner
{
	// RESOURCE - Virus Database Link
	var $vdb;
	
	// ARRAY - List of infected files and the malware they are infected with
	var $files = array();
	
	// ARRAY - List of pKey info and associated files
	var $pKey = array();
	
	//STRING - Most recent infection found, cleared after each scan
	var $infection = '';
	
	
	function virusScanner()
	{
		//$this->vdb = clamav_open_db('./cache/vs/db.cvd');
		echo "main() Working!<br />
";
	}
	
	function test()
	{
		echo '$kernel->vS->method() working!';
	}
	
	function scan(/* STRING */ $file)
	{
		
		if($v = clamav_scan_file($this->vdb, $file))
		{
				// Get Filename
				$f = str_replace('/','',strtolower (strrchr ($file, '/')));
				
				// Get pKey
				$p = explode('.',$file);
				$p = $p[0];
				
				// Store it if the calling script wants it later
				$this->files[$file] = $v;
				$this->pKey[$p] = $f;
				$this->infection = $v;
				return false;
		}
		else
		{
			return true;
		}
	}
}
?>