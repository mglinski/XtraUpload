<?
//******************************************************************************************************
//   ATTENTION: THIS FILE HEADER MUST REMAIN INTACT. DO NOT DELETE OR MODIFY THIS FILE HEADER.
//
//   Name: uber_uploader_get_data_ajax.php
//   Revision: 1.8
//   Date: 2006/08/27
//   Link: http://uber-uploader.sourceforge.net  
//   Author: Peter Schmandra
//   Description: Gather stats on an existing upload
//
//   Licence:
//   The contents of this file are subject to the Mozilla Public
//   License Version 1.1 (the "License"); you may not use this file
//   except in compliance with the License. You may obtain a copy of
//   the License at http://www.mozilla.org/MPL/
// 
//   Software distributed under the License is distributed on an "AS
//   IS" basis, WITHOUT WARRANTY OF ANY KIND, either express or
//   implied. See the License for the specific language governing
//   rights and limitations under the License.
//
//***************************************************************************************************************
// Modified for use with XtraUpload File Hosting Script(http://www.xtrafile.com)
// By: Matthew Glinski -> XtraFile.com Co-Owner / Main Programmer
//***************************************************************************************************************

chdir("..");
include("./include/init.php");

$_GET['server'] = urldecode($_GET['server']);

if($_GET['server'] != $serverurl && ($siteurl != $serverurl))
{
	echo 'alert("ERROR WITH REMOTE SERVER: '.$errstr.'");';
	die();
	echo '// Server: '.$serverurl.' != '.$_GET['server'].'
';
	flush();
	$fp = fopen($_GET['server']."/include/progress.php?".$_SERVER['QUERY_STRING'],"r");
	if($fp)
	{
		$exit = '';
		while(!feof($fp))
		{
			$exit .=  @fread($fp, 1024);
		}
		echo $exit;
	}
	else
	{
		echo 'alert("ERROR WITH REMOTE SERVER: '.$errstr.'");';
	}
}
else
{
	if($_GET['start_time'] == 0)
	{
		$_GET['start_time'] = time();
		//sleep(1);
	}
	
	$bRead = GetBytesRead();
	$iTotal = GetBytesTotal();
	$flength_file = './temp/' . $_GET['sid'] . "/flength.size";
	
	$lapsed = time() - $_GET['start_time'];
	$bSpeed = 0; 
	$remaining = 0;
	
	if($lapsed > 0){ $bSpeed = $bRead / $lapsed; }
	if($bSpeed > 0){ $remaining = round(($iTotal - $bRead) / $bSpeed); }
	
	$remaining_sec = ($remaining % 60); 
	$remaining_min = ((($remaining - $remaining_sec) % 3600) / 60); 
	$remaining_hours = (((($remaining - $remaining_sec) - ($remaining_min * 60)) % 86400) / 3600); 
	
	if($remaining_sec < 10){ $remaining_sec = "0$remaining_sec"; }
	if($remaining_min < 10){ $remaining_min = "0$remaining_min"; }
	if($remaining_hours < 10){ $remaining_hours = "0$remaining_hours"; }
	
	$remainingf = "$remaining_hours"."h : $remaining_min"."m : $remaining_sec"."s"; 
	
	
	$lapsed_sec = ($lapsed % 60); 
	$lapsed_min = ((($lapsed - $lapsed_sec) % 3600) / 60); 
	$lapsed_hours = (((($lapsed - $lapsed_sec) - ($lapsed_min * 60)) % 86400) / 3600); 
	
	if($lapsed_sec < 10){ $lapsed_sec = "0$lapsed_sec"; }
	if($lapsed_min < 10){ $lapsed_min = "0$lapsed_min"; }
	if($lapsed_hours < 10){ $lapsed_hours = "0$lapsed_hours"; }
	
	$lapsedf = "$lapsed_hours"."h : $lapsed_min"."m : $lapsed_sec"."s"; 
	
	
	$percent = round(100 * $bRead / $iTotal);
	
	if(is_dir('./temp/'.$_GET['sid']) && is_file($flength_file) && $bRead < $iTotal)
	{	
		$speed = $lapsed ? round($bRead / $lapsed) : 0;
		$speed = round($speed / 1024);
		$bRead = round($bRead /= 1024);	
	}
	else
	{
		//echo $bRead." -> ".GetBytesTotal() . " -> ". dirname(__FILE__);
		echo "void(0);";
		exit;
	}
	?>
   update("<? print $bRead;?>", "<? print round($iTotal/1024);?>", "<? print $remainingf;?>", "<? print $lapsedf?>", "<? print $speed;?>", "<? print $percent;?>", "<?=$siteurl.'include/progress.php?sid='.$_GET['sid'].'&start_time='.$_GET['start_time'].'&server='.urlencode($_GET['server'])?>");<?

}
	///////////////////////////////////////////////////////////////////////////////
	// Return the current size of the $_GET['sid'] - flength file size. //
	///////////////////////////////////////////////////////////////////////////////
	function GetBytesRead()
	{
		$tmp_dir = $_GET['sid'];
		$bytesRead = 0;
		
		
		if(is_dir('./temp/'.$tmp_dir))
		{
			if($handle = opendir('./temp/'.$tmp_dir))
			{
				while($file = readdir($handle))
				{
					if($file != '.' && $file != '..' && $file != 'flength.size')
					{ 
						$bytesRead += filesize('./temp/'.$tmp_dir . '/' . $file);
					}
				}
				closedir($handle);
			}
		}
				
		if($bytesRead == 0)
		{
			$bytesRead = 1;
		}
		return $bytesRead;   
	}
	
	function GetBytesTotal()
	{
		$bytesRead = 1;
		$tmp_dir = $_GET['sid'];
		
		if(is_dir('./temp/'.$tmp_dir))
		{
			$handle = opendir('./temp/'.$tmp_dir);
			
			while($file = readdir($handle))
			{
				if($file == 'flength.size')
				{ 
					$bytesRead += (int)file_get_contents('./temp/'.$tmp_dir . '/' . $file);
					break;
				}
			}
			closedir($handle);
		}
		return $bytesRead;   
	}
?>