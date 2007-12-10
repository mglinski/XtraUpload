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

// file_check.php
function checkExistenceOfFile($fileToDownload,$m)
{
	/* See whether the specified file is available, and can be read. If not, return false. */
	if(!is_file("./files/".substr($m,0,2).'/'.$fileToDownload))
	{
		//header(sprintf("Location:%s?error=404&file=%s",FILE_NOT_EXIST,$fileToDownload));
		return false;
	}
	/* Otherwise, return true */
	else
	{
		return true;
	}
}

$qr = $db->query("SELECT * FROM files WHERE hash = '".txt_clean($_GET['hash'])."' LIMIT 1");
$file = $db->fetch($qr, 'obj');
$fileToDownload = $file->filename;
$md5 = $file->md5;

/* Check to make sure the file exists and can be read */
if(!checkExistenceOfFile($fileToDownload,$md5))
{
	echo "false";
}
else
{
	echo "true";
}

?>