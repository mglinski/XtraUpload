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
//
// includes/pages/url.php
// Provides Functionality for uploaing files from other servers.
//
if(!(isset($_POST['file'])) || $_POST['file'] == '')
{
	echo $lang['url']['1'];
}
else
{
	include('./incude/transfer.class.php');
	$kernel->loadUserExt('upload');
	$upload = $kernel->ext->upload->set($_POST['file']);
	$ret = $kernel->ext->upload->return;
	
	if(!$upload)
	{
		header("location: ".makeXuLink('index.php', array('p'=>'uploadError', 'error' => $kernel->upload->error)));
		die;
	}
	else
	{
		$kernel->server->update_bandwith($kernel->upload->file_name);
		//echo 'File Uploaded. Please wait while we process your file.<br />file_upload&secid='.$kernel->upload->secid.'<div class="clearer"></div>';
		
		$img = $kernel->ext->upload->file_name; 
		$img = str_replace('.','',strtolower (strrchr ($img, '.')));
		$type = $img;
		if(($img == 'png' or $img == 'jpg' or $img == 'jpeg') && $allow_imaging)
		{
			$img = true;
			$thumb = img_thumb('./files/'.substr($kernel->ext->upload->md5,0,2).'/'.$kernel->ext->upload->file_name);
		}
		
		echo "<script> location = '".makeXuLink('index.php', array('p'=>'fileUpload', 'secid' => $kernel->ext->upload->secid) )."'; </script>";
		die;
	}
}
?>