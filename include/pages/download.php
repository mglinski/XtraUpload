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

function startDownloadProcess($action,$captcha_is=false,$captchaHTML='',$captchaValid='')
{
	$hash = $_REQUEST['hash'];
	global $db, $siteurl, $max_file_streams;
	$m_query = $db->query("SELECT * FROM `files` WHERE `hash` = '".txt_clean($hash)."' AND status='1'");  
	$f_query = $db->fetch($m_query,"obj");
	
	$num = $db->num($m_query);
	
	$d = $db->query("SELECT * FROM `groups` WHERE `id` = '".$f_query->group."' LIMIT 1", 'main_1');
	$group = $db->fetch($d);

	if(($f_query->last_download + (3600*24*$group->file_expire)) < time() && $group->file_expire != 0)
	{
		delfile_expire($hash);
		$db->query("UPDATE `files` SET `status` = '2' WHERE `filename` = '".$file."'");
		log_action('File Deleted', 'file:delete', 'File('.$file.') Download time limit Expired', 'ok', 'prune.php');
		header("Location: ".$siteurl."index.php?p=file_error");
		exit;
	}
	
	// 
	$tD = $db->query("SELECT SUM(`filesize`) AS `total` FROM `downloads` WHERE `ip` = '".$_SERVER['REMOTE_ADDR']."'");
	$dlTotal = $db->fetch($tD);
	$totaldownload += intval($dlTotal->total);
	
	if (($limit != 0) && ($totaldownload >= ($limit * 1024 * 1024))) 
	{
		header('Location: '.makeXuLink('index.php','p=errordl'));
		die();
	}

	if($action == '3')
	{
		if($captcha_is)
		{
			if($captchaValid)
			{
				displayFileDownloadLink($f_query->id, $f_query->o_filename);
			}
			else
			{
				displayFileForDownloadSummary($f_query->filename, $f_query->o_filename, $f_query->description, $captchaHTML);
			}
		}
		else
		{
			displayFileDownloadLink($f_query->id, $f_query->o_filename);
		}
	}
	else if ($action == "2")
	{
		doDirectDownload($_REQUEST['link']);
	}
	else if ($action == "1")
	{
		if($captcha_is)
		{
			displayFileForDownloadSummary($f_query->filename, $f_query->o_filename, $f_query->description, $captchaHTML);
		}
		else
		{
			displayFileForDownloadSummary($f_query->filename, $f_query->o_filename, $f_query->description);
		}
	}
}

function detect_browser($var)
{
		if(eregi("(msie) ([0-9]{1,2}.[0-9]{1,3})", $var)) 
		{
			$c = "ie"; 
		}else{
			$c = "nn"; 
		}
	return $c;
}

function downloadFail($file,$name,$totaldownload,$fileSize,$limit_speed,$dlid)
{
	global $kernel, $db, $dlComplete;
	if(!$dlComplete)
	{
		log_action('File Downloaded:('.$name.') ', 'file:download', 'File('.$file.') was downloaded by '.$_SERVER['REMOTE_ADDR'].'', 'ok', 'download.php');
		$bw = $kernel->ext->download->bandwith;
		if (!($limit != '0' && ($totaldownload + $fileSize >= ($_SESSION['d_limit'] * 1024 * 1024))))  
		{
			$db->query('INSERT INTO downloads (ip,filesize,filename,time) VALUES ("' . $_SERVER['REMOTE_ADDR'] . '", "' . $bw . '", "' . $fileToDownload . '", UNIX_TIMESTAMP())');
		}
		update_bandwith($name,$bw);
		$db->query("DELETE FROM `dlsessions` WHERE `id` = '".$dlid."'");
	}
	die();
}

function doDirectDownload($link)
{
	global $db, $kernel, $siteurl, $rewrite_links, $limit_speed, $lang, $siteurl, $myuid, $downloadLimit;
	
	// Delete From Download links, old links
	$db->query("DELETE FROM `dlinks` WHERE `time` < '".time()."'");
	
	// Get Current dLink Stuff
	$q = $db->query("SELECT * FROM dlinks WHERE down_id = '".intval($_REQUEST['link'])."' ");

    /* Start by making sure the file actually exists */
    if($db->num($q) == '1')
    {
		$res = $db->fetch($q,'obj');
		$q1 = $db->query("SELECT * FROM files WHERE filename = '".$res->store_name."' ");
		$res1 = $db->fetch($q1,'obj');
		
		// Localize Vars
		$md5 = $res1->md5;
		$fileToDownload = $res->store_name;
		$hash = $res->hash;
		$orig_filename = $res->real_name;
		$ip = $res->resume;
		$resume = $res->can_r;
		$limit = intval($downloadLimit);
		$_SESSION['file_name'] = $res1->o_filename;
		
		// I Can Steal Cheezburger? -NO!!!
		if ($ip != $_SERVER['REMOTE_ADDR']) 
		{
			die('Location: '.$siteurl.'index.php?p=download&hash='.$res1->hash);
		}
		
		// Terminate if download threads over limit
		$dlse = 0;
		$dls = $db->query("SELECT * FROM `dlsessions` WHERE `file` = '" . intval($_REQUEST['link'])."'");  
		$dlse = $db->num($dls);
		
		if($dlse >= $res->limit)
		{
			header('Status: 416');
			exit();
		}
		
		// Make new thread
		$db->query("INSERT INTO `dlsessions` (`file`) VALUES ('".$link."')");
		$dlid =  $db->insert_id();
		
		/* Check if user has exceeded limit */
		$totaldownload = 0;
		$db->query("DELETE FROM `dlinks` WHERE `time` > '".(time() + 3600)."'");

		/* Read in the original file and present dialog to user */
		$limit_speed = intval($limit_speed);
		
		/**
		* If your web server has output compression enabled 
		* (quite common) this needs to be disabled in order 
		* for MSIE to obey our Content Disposition header 
		*/
        if(ini_get('zlib.output_compression'))
		{
			ini_set('zlib.output_compression', 'Off');
		}
		
		// Download system class under $kernel->ext->download
		$kernel->loadUserExt('download');
		
		// Function to call if user aborts connection
		register_shutdown_function('downloadFail','./files/'.substr($md5,0,2).'/'.$fileToDownload,$orig_filename,$totaldownload,$fileSize,$limit_speed,$dlid);

		$kernel->ext->download->set_byfile('./files/'.substr($md5,0,2).'/'.$fileToDownload); //Download from php data
		$kernel->ext->download->use_resume = ((bool)$res->can_r); //Enable Resume Mode
		$kernel->ext->download->filename = $orig_filename;
		
		if($limit_speed > 0)
		{
			$kernel->ext->download->speed = $limit_speed;
		}
		else
		{
			$kernel->ext->download->speed = 0;
		}
		$bw = $kernel->ext->download->sendDownload(); //Download File
		
		log_action('File Downloaded:('.$orig_filename.') ', 'file:download', 'File('.'./files/'.substr($md5,0,2).'/'.$fileToDownload.') was downloaded by '.$_SERVER['REMOTE_ADDR'].'', 'ok', 'download.php');
			
		$_SESSION['file_size'] = round($bw/1024,2);
		$db->query('INSERT INTO `downloads` (`ip`,`filesize`,`filename`,`time`) VALUES ("' . $_SERVER['REMOTE_ADDR'] . '", "' . $bw . '", "' . $fileToDownload . '", UNIX_TIMESTAMP())');
		$ret = update_bandwith($fileToDownload,$bw);
		$dlComplete = true;

		if(intval($myuid) > 0)
		{
			add_points_download($_SESSION['myuid'],$hash);
		}
		
		$db->query("UPDATE `files` SET `downloads` = downloads+1, `last_download` = '".time()."' WHERE `filename` = '".$fileToDownload."' LIMIT 1");
		$db->query("DELETE FROM `dlsessions` WHERE `id` = '".$dlid."'");
		//$db->query("DELETE FROM dlinks WHERE down_id='".intval($_REQUEST['link'])."'");
	} 
	else 
	{
			if($rewrite_links){$link=$siteurl."download/".intval($_REQUEST['link']);}else{$link = $siteurl."index.php?p=get&file=".intval($_REQUEST['link']);}
			header("Location: ".makeXuLink('index.php', 'p=home'));
			die();
	}
}

/*************************/
/* Show initial download options
/*************************/

function displayFileForDownloadSummary($fileToDownload, $orig_filename, $description, $captchaHTML='')   
{
	global $siteurl, $rewrite_links, $captcha_is, $sitename, $db, $lang, $limit_wait, $kernel, $downloadLimit, $report_links;
	$limit = $_SESSION['d_limit'];
	
	$kernel->tpl->assign('description', $description);
	
	$qr = $db->query("SELECT * FROM files WHERE filename = '".$fileToDownload."' LIMIT 1");
	$file = $db->fetch($qr, 'obj');
	$user = $db->fetch($db->query("SELECT * FROM users WHERE uid = '".$file->user."'"), 'obj');
	
	$user = $user->username;
	$md5 = $file->md5;
	$size = $file->size;
	$server = $file->server;
	$hash = $file->hash;
	$qa = '';
	
   	$wait_time = $limit_wait;	
	
	if($wait_time == '0')
	{
		$nowait = '';
	}
	if($wait_time == '1')
	{
		$nowait = '';
	}
	
	if($limit == '0')
	{
		$limit = $lang['download']['8'];
	}
	
	if($user == '')
	{
		$user = $lang['download']['9'];
	}
	
	if($rewrite_links)
	{
		$d_link = "./".$_REQUEST['hash'];
	}
	else
	{
		$d_link = "./index.php?p=download&hash=".$_REQUEST['hash'];
	}
	
	$icon = '';
	$o_filename = $orig_filename;
	$o_filename_1 = $orig_filename;
	$type = str_replace('.','',strtolower(strrchr($o_filename, '.')));
	$icon = '';
	if(file_exists('./images/icons/'.$type.'.png'))
	{
		$kernel->tpl->assign('type', $type);
	}

	if(strlen($o_filename_1) > 36)
	{
		$o_filename_1 = strsplit($o_filename_1, 3);
		$i=0; $new = '';
		$count = count($o_filename_1); $count--; $count--; $count--; $count--;
		while($i < 12)
		{
			$new .= $o_filename_1[$i];
			$i++;
		}
		$o_filename = $new.'...'.$o_filename_1[$count++].$o_filename_1[$count++].$o_filename_1[$count++].$o_filename_1[$count];
	}
	/* Now replace relevant spacers with file data */
	$rand = rand(1,100);

	$kernel->tpl->assign('FILE_TO_DOWNLOAD', $fileToDownload);
	$kernel->tpl->assign('ORIG_FILENAME', $o_filename);
	$kernel->tpl->assign('DESCRIPTION', $description);
	$kernel->tpl->assign('HASH', $d_link);
	$kernel->tpl->assign('FILE_TO_DOWNLOAD_LINK', $fileToDownload);
	$kernel->tpl->assign('WAIT_TIME', $wait_time);
	$kernel->tpl->assign('RAND_COUNTER', $rand);
	$kernel->tpl->assign('SITEURL', $siteurl);
	$kernel->tpl->assign('SITENAME', SITE_NAME);
	$kernel->tpl->assign('MBLIMIT', $downloadLimit);
	$kernel->tpl->assign('SPEED', SPEED);
	$kernel->tpl->assign('SIZE', get_filesize_prefix($size));
	$kernel->tpl->assign('MD5', $md5);
	$kernel->tpl->assign('ICON', $icon);
	//$kernel->tpl->assign('COMMENTS', get_comments(txt_clean($_REQUEST['hash'])));
	if($report_links)
	{
		$kernel->tpl->assign('REPORT_FILE_LINK', '<a href="'.$siteurl.'index.php?p=report&link='.urlencode($siteurl.'index.php?p=download&hash='.$hash).'" target="_blank">Report this file for breaking our TOS</a>');
	}
	else
	{
		$kernel->tpl->assign('REPORT_FILE_LINK', '');
	}
	$kernel->tpl->assign('CAPTCHA', $captchaHTML);
	if(strlen($captchaHTML) > 0)
	{
		$kernel->tpl->assign('CAPTCHA_TRUE', 'true');
	}
	else
	{
		$kernel->tpl->assign('CAPTCHA_TRUE', '');
	}
	
	$kernel->tpl->assign('NO_WAIT_PREMIUM', $nowait);
	$kernel->tpl->assign('UPLOADER', $user);
	$kernel->tpl->assign('DOWNLOADS', intval($file->downloads));
	$kernel->tpl->assign('ADS_INCLUDE', get_ads());
	$kernel->tpl->assign('F_HASH', txt_clean($_REQUEST['hash']));
	$kernel->tpl->assign('PASS', $_POST['pass1']);
	$kernel->tpl->assign('GET_ACC', get_accounts());
		
	$kernel->tpl->assign('status', 'info');	
	$kernel->tpl->display('site_header.tpl');
	$kernel->tpl->display('download.tpl');
	$kernel->tpl->display('site_footer.tpl');
}

function displayFileDownloadLink($id, $orig)   
{
	global $db, $siteurl, $rewrite_links, $lang, $can_resume, $show_direct_link, $kernel;
	$sql = "SELECT * FROM files WHERE id = '".$id."' LIMIT 1";
	$query = $db->query($sql);
	$a = $db->fetch($query,'obj');
	
	$o_filename = elipsis($a->o_filename);
	$rand_id = makeFileDownloadLink($id, $orig);
	
	if($rewrite_links)
	{
		$link .= $a->server.'/file/'.$rand_id.'/'.str_replace(' ','_',str_replace(',','-',$orig));
	}
	else
	{
		$link .= $a->server.'/index.php?p=download&link='.$rand_id.'&name='.str_replace(' ','_',str_replace(',','-',$orig));
	}

	$kernel->tpl->assign('link', $link);
	if($show_direct_link)
	{	
		$kernel->tpl->assign('status', 'link');	
		$kernel->tpl->display('site_header.tpl');
		$kernel->tpl->display('download.tpl');
		$kernel->tpl->display('site_footer.tpl');
	}
	else
	{
		header("Location: ".$link);
	}
}


function makeFileDownloadLink($id, $orig)   
{
	global $db, $siteurl, $rewrite_links, $lang,$can_resume, $max_file_streams;
	$rand_id = rand(111,2147483647);
	$sql = "SELECT * FROM files WHERE id = '".$id."' LIMIT 1";
	$query = $db->query($sql);
	$a = $db->fetch($query);
	
	$time = time()+3600;

	$db->query("INSERT INTO dlinks (`down_id`, `store_name`, `real_name`, `time`, `resume`, `can_r`, `limit`)VALUES('".$rand_id."','".$a->filename."','".$orig."','".$time."','".$_SERVER['REMOTE_ADDR']."','".$can_resume."','".$max_file_streams."')",'down_link_1');
	$db->query("UPDATE `files` SET `last_download` = '".time()."' WHERE id = '".$id."' LIMIT 1");
	return $rand_id;
}

// Grab fine info and make sure its there
$sql = $db->query("SELECT * FROM files WHERE `hash` = '".txt_clean($_GET['hash'])."' AND `status` = '1' AND `ban` != '1'");
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
			'maxtry'         => 9,       // integer: [1-9]
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
?>