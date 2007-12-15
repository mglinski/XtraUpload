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

chdir('..');
include("./include/init.php");

$block = $_REQUEST['links'];
$block = explode("\n",$block);
$i = 0;
$a = 0;
$line_arr = '';
$hash_arr = array();

foreach($block as $line)
{
	$line = trim($line);
	if($line != '')
	{
		$hash = explode('index.php?p=download&hash=',$line);
		if(count($hash) == 2)
		{
			$hash = txt_clean($hash[1]);
		}
		else
		{
			$hash = explode('/',$hash[0]);
			$count = count($hash);
			$count--;
			$hash = $hash[$count];
		}
		
		if(!in_array($hash,$hash_arr))
		{
			$i++;
			if(check_file_bool($hash))
			{
				$line_arr .= "<working>#".$i.":  <a href='".$line."'><font color='#009900'>".$line."</font></a>  is Working! </working><br />";
				$a++;
			}
			else
			{
				$line_arr .= "<failed>#".$i.":  <font color='#FF0000'>".$line."</font>  is Not Working! </failed><br />";
			}
			$hash_arr[] = $hash;
		}
	}
}

$line_arr .= '<br />';

header("Content-type: text/javascript");
	
?>
$("#links_code").html("<?=$line_arr;?>");
$("#links_num").html("<?=$i?>");
$("#links_val_num").html("<?=$a?>");
<?
unset($hash,$line_arr,$i,$a,$hash_arr);
?>