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

include_once("include/init.php");

function prune_folder_files($dir)
{
	global $db;
	$fh = @opendir($dir);
	while ($file = @readdir($fh))
	{
		//echo $file.'<br />\n';
		if (($file != '..' && $file != '.' && $file != 'index.php' && $file != 'index.html'  && $file != '.htaccess'))
		{
			if(is_dir($dir . '/' . $file))
			{
				prune_folder_files($dir.'/'.$file);
			}
			else
			{
				$s = $db->query("SELECT * FROM `files` WHERE `filename` = '".$file."' AND `status` = '1' LIMIT 1",'main_1');
				$num = $db->num($s);
				if($num == '0')
				{
					$un = @unlink($dir.'/'.$file);
					if($un)
					{
						$content = '-> File '.$file.' Was not found in the database and has been deleted
';
						//echo $content;
						log_action('File Deleted', 'file:delete', $content, 'ok', 'prune.php');
					}
					else
					{
						$content = '-> File '.$file.' Was not found in the database but could not be deleted
';
						//echo $content;
						log_action('File !Not! Deleted', 'file:delete', $content, 'warn', 'prune.php');
					}
				}
				
			}
		}
	}
	closedir ($fh);
	prune_folder_expire($dir);
}

function prune_folder_expire($dir)
{
	global $db;
	$fh = @opendir($dir);
	$group = array();
	while ($file = @readdir($fh))
	{
		//echo $file.'<br />\n';
		if (($file != '..' && $file != '.' && $file != 'index.php' && $file != 'index.html' && $file != '.htaccess'))
		{
			if(is_dir($dir . '/' . $file))
			{
				prune_folder_expire($dir.'/'.$file);
			}
			else
			{
				$s = $db->query("SELECT * FROM `files` WHERE `filename` = '".$file."' AND `status` = '1' LIMIT 1", 'main_1');
				$files = $db->fetch($s);
				if(!array_key_exists($file->group,$group))
				{
					$d = $db->query("SELECT * FROM `groups` WHERE `id` = '".$file->group."' LIMIT 1", 'main_1');
					$groups = $db->fetch($d);
					$group[$files->group] = $groups->file_expire;
				}
				if(($files->last_download + (3600*24*$group[$files->group])) < time() && $group[$files->group] != 0)
				{
					$db->query("UPDATE `files` SET `status` = '2' WHERE `filename` = '".$file."'");
					log_action('File Deleted', 'file:delete', 'File('.$file.') Download time limit Expired', 'ok', 'prune.php');
				}
			}
		}
	}
	closedir ($fh);
}

//*************************
// Endlessly Searches the files folder for files and sees if they are in the database
// Covers all folders in any specified folder.
prune_folder_files('./files');
//*************************

$temp = @opendir('./temp/');
while ($file = @readdir($temp))
{
	//echo $file.'<br />\n';
	if (($file != '..' && $file != '.' && $file != 'index.php' && $file != 'index.html' && $file != '.htaccess' && !is_dir('./temp/' . $file)))
	{
		@unlink('./temp/'.$file);
	}
}
@closedir ($temp);
?>