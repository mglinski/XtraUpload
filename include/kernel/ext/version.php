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
class version
{	
	var $version;
	##############################################
	function version()
	{
		
		# You do not need to edit any of the following code
		
		// Home call details
		$home_url_site = 'www.xtrafile.com';
		$home_url_port = 80;
		$home_url_iono = '/versionXU.txt';
		$fsock_terminate = false;
		
		// Build request
		
		$request = $home_url_iono;
		
		// Build HTTP header
		$header  = "GET $request HTTP/1.0\r\nHost: $home_url_site\r\nConnection: Close\r\nUser-Agent: iono (www.olate.co.uk/iono)\r\n";
		$header .= "\r\n\r\n";
		
		// Contact license server
		$fpointer = @fsockopen($home_url_site, $home_url_port, $errno, $errstr, 2);
		$return = '';
		if ($fpointer) 
		{
			fwrite($fpointer, $header);
			while(!feof($fpointer)) 
			{
				$return .= fread($fpointer, 1024);
			}
			fclose($fpointer);
		}
		else
		{
			($fsock_terminate) ? exit : NULL;
		}
		
		// Get rid of HTTP headers
		$content = @explode("\r\n\r\n", $return);
		$content = @explode($content[0], $return);
		
		// Assign version to var
		$this->version = @trim($content[1]);
	}
}
?>