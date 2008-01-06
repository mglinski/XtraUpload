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

include("./include/init.php");

// What size image?
if(isset($_GET['thumb']))
{
	// Thumbnail Viewer
	$file = $_GET['file'];
	$file = explode('.',$file);
	$file = $file[0];
	$sql = "SELECT * FROM files WHERE `hash` = '".txt_clean($file)."'";
	$qr1 = $db->query($sql);
	$ret = $db->fetch($qr1);
	
	$file = 'thumb_'.$ret->filename;
	
	$type = str_replace('.','',strtolower (strrchr ($file, '.')));
	
	if($type = "gif")
	{
		$type = 'gif';
	}
	else if($type = "bmp")
	{
		$type = 'bmp';
	}
	else if($type = "jpg")
	{
		$type = 'jpeg';
	}
	else if($type = "png")
	{
		$type = 'png';
	}
	
	header("Content-type: image/".$type);
	
	echo file_get_contents('./thumbs/'.substr($ret->md5,0,2).'/'.$file);
	die;
}
else
{
	// Image Viewer
	$file = str_replace('/','',$_GET['file']);
	$file = explode('.',$file);
	$file = $file[0];
	$sql = "SELECT * FROM files WHERE `hash` = '".txt_clean($file)."'";
	$qr1 = $db->query($sql);
	$ret = $db->fetch($qr1);
	$md5 = $ret->md5;
	$md5 = substr($md5,0,2);
	$file = $ret->filename;
	$type = str_replace('.','',strtolower (strrchr ($img, '.')));
	
	if($type = "gif")
	{
		$type = 'gif';
	}
	else if($type = "bmp")
	{
		$type = 'bmp';
	}
	else if($type = "jpg")
	{
		$type = 'jpeg';
	}
	else if($type = "'tif")
	{
		$type = 'tiff';
	}
	else if($type = "png")
	{
		$type = 'png';
	}
	
	$af = './files/'.$md5.'/'.$file;
	
	$fp = fopen($af, 'r');
	if($fp)
	{	
		$c = '';
		while(!feof($fp))
		{
			$c .= fread($fp,1024);
		}
		fclose($fp);
		
		header("Content-type: image/".$type);
		echo $c;
	}
	else
	{
		die("Image not found!");
	}
}
?>