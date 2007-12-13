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

// Grab fine info and make sure its there
$sql = $db->query("SELECT * FROM files WHERE `hash` = '".txt_clean($_GET['hash'])."' AND `status` = '1'");
$num = $db->num($sql);
if ($num == 0 && !(isset($_REQUEST['link'])))
{
	header("Location: $siteurl"."index.php?p=fileError&prob=".$num.'&hash='.txt_clean($_GET['hash']).'&link='.$_REQUEST['link']);	
}
else
{
	// Wahoo the file is there!
	$file = $db->fetch($sql);
	$o_filename = $file->o_filename;
	if(strlen($o_filename) > 36)
		{
			$o_filename = strsplit($o_filename, 3);
			$i=0; $new = '';
			$count = count($o_filename_1); $count--; $count--; $count--; $count--;
			while($i < 12)
			{
				$new .= $o_filename[$i];
				$i++;
			}
			$o_filename = $new.'...'.$o_filename[$count++].$o_filename[$count++].$o_filename[$count++].$o_filename[$count];
		}
	
	// Wait Counter VAR
	$waited = false;
	
	$skin_head = '';
	$skin_foot = '<br /><br />
	'.copyright();
	
	if(isset($_POST['waited']))
	{
		$waited = true;
	}
	
	if(isset($_GET['link']))
	{
		$down_link = intval($_GET['link']);
	}
	
	if(isset($file->password) && $file->password != "")
	{
		$pass_image = false;
	}
	else
	{
		$pass_image = true;
	}
	
	if(isset( $_POST['pass1']) && $file->password == txt_clean($_POST['pass1']))
	{
		$pass_image = true;
	}
	
	if($_POST['waited'])
	{
		$pass_image = true;
	}
	if($captcha_is)
	{
			require_once("./captcha.php");
			$tmp_folder = $siteurl.'temp/';
		
		$CAPTCHA_INIT = 
		array(
			'tempfolder'     => './temp/',      // string: absolute path (with trailing slash!) to a writeable tempfolder which is also accessible via HTTP!
			'tempfolder_1'   => $tmp_folder,      // string: absolute path (with trailing slash!) to a writeable tempfolder which is also accessible via HTTP!
			'TTF_folder'     => './fonts/', // string: absolute path (with trailing slash!) to folder which contains your TrueType-Fontfiles.
			'TTF_RANGE'      => array('gothikka.ttf'),
			'chars'          => 3,       // integer: number of chars to use for ID
			'minsize'        => 20,      // integer: minimal size of chars
			'maxsize'        => 28,      // integer: maximal size of chars
			'maxrotation'    => 22,      // integer: define the maximal angle for char-rotation, good results are between 0 and 30
			'noise'          => FALSE,    // boolean: TRUE = noisy chars | FALSE = grid	
			'websafecolors'  => FALSE,   // boolean
			'refreshlink'    => FALSE,    // boolean
			'inline'  		 => TRUE,    // boolean
			'lang'           => 'en',    // string:  ['en'|'de']
			'maxtry'         => 40,       // integer: [1-9]
			'badguys_url'    => '/',     // string: URL
			'secretstring'   => "sdfsdfdf3sdfsdfsjkfesbkjfk33hhgghbfjkshfbaejnwrgse7rvsdgb adggb", // totally random string
			'secretposition' => 17,      // integer: [1-32]
			'debug'          => false
		);
		
		$captcha = null;
		$captcha = new hn_captcha($CAPTCHA_INIT);
		//error_reporting(E_ALL);
		switch($captcha->validate_submit())
		{
			case 1:
				// PUT IN ALL YOUR STUFF HERE // - START
					$captchaValid = true;
				// PUT IN ALL YOUR STUFF HERE // - END
			continue;
			
			default:
				$captchaHTML = $captcha->display_form();
			break;
		}
	############################
	############################
	
		if(!$pass_image)
		{
				$kernel->tpl->display('site_header.tpl');
				?>
				<p>This file has been password protected by the uploader.<br />
				  Please insert the password below to access the download.</p>
				<form method="post" enctype="multipart/form-data">
				File Password: 
				  <input type="text" name="pass1" id="pass1" />
				<input type="hidden" name="pass_test" value="true" />
				<br />
				<input type="submit" name="Submit2" value="Submit" />
				</form>
				<br />
				<br />
				<?
				$kernel->tpl->display('site_footer.tpl');
		}
		else
		{
	
			if(isset($down_link))
			{
				startDownloadProcess('2');
				die();	
			}
			else
			{
				if ($waited)
				{
					startDownloadProcess("3",$captcha_is,$captchaHTML,$captchaValid);
					die;
				} 
				else 
				{
					startDownloadProcess("1",$captcha_is,$captchaHTML,$captchaValid);
					die;
				}
			}
		}
	}
	else
	{
		if(!$pass_image)
		{
				$kernel->tpl->display('site_header.tpl');
				?>
				<p>This file has been password protected by the uploader.<br />
				  Please insert the password below to access the download.</p>
				<form method="post" enctype="multipart/form-data">
				File Password: 
				  <input type="text" name="pass1" id="pass1" />
				<input type="hidden" name="pass_test" value="true" />
				<br />
				<input type="submit" name="Submit2" value="Submit" />
				</form>
				<br />
				<br />
				<?
			    $kernel->tpl->display('site_footer.tpl');
		}
		else
		{
	
			if(isset($down_link))
			{
				startDownloadProcess('2');
				die();	
			}
			else
			{
				if ($waited)
				{
					startDownloadProcess("3");
					die;
				} 
				else 
				{
					startDownloadProcess("1");
					die;
				}
			}
		}
	}
}
############################
############################
?>