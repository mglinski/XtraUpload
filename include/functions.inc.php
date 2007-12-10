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

/**
* Non Functions have been moved to a new file init.php for 1.6
* this file will, from now on, only contain functions.
*/
function processUserCookie($cookie, $way)
{
	if($way == 'enc' or $way == 'encode' or $way == 'encrypt')
	{
		$cookie = bin2hex(base64_encode($cookie));
		$cookie = str_replace(
			array('a','b','c','d','e','f',1,2,3,4,5,6,7,8,9,0),
			array('@','$','%','^','*','(',')','-','_','[',']',';',':','<','>','|'),
			$cookie
		);
		$cookie = bin2hex(base64_encode($cookie));
	}
	else
	{
		$cookie = base64_decode(pack('H*',$cookie));
		$cookie = str_replace(
			array('@','$','%','^','*','(',')','-','_','[',']',';',':','<','>','|'),
			array('a','b','c','d','e','f',1,2,3,4,5,6,7,8,9,0),
			$cookie
		);
		$cookie = base64_decode(pack('H*',$cookie));
	}
	return $cookie;
}

//----------------------------
// Umm, WTF is this here for??
//----------------------------
function remove_slashes($str)
{
   return $str;
}

//----------------------------
// EVICTION!
//----------------------------
function logout()
{
	global $kernel;
	$kernel->users->terminate();
	log_action('User Logged Out', 'user:logout', 'User ('.$_SESSION['username'].') has logged out.', 'ok', 'logout.php');
}

//----------------------------
// New Tennants!
//----------------------------
function user_login($name,$pass)
{
	global $kernel;
	@session_destroy();
	@session_start();

	$kernel->users->pre($name,$pass);
	if($kernel->users->login())
	{			
		if($kernel->users->perm_level == '2')
		{
			$adminId = $kernel->users->userid;
			$_SESSION['isadmin'] = '1';
			session_register("isadmin");
			$_SESSION['a_id'] = $adminId;
			session_register("isadmin");
		}
		
		//----------------------------
		// Allow all into the admin panel if defined as true
		//----------------------------
		if(XU_NO_ADMIN_AUTH)
		{
			$_SESSION['isadmin'] = '1';
			session_register("isadmin");
			$_SESSION['a_id'] = '1';
			session_register("isadmin");
		}

		//----------------------------
		// set session crap
		//----------------------------
		$name = $kernel->users->name;
		$passSess = $kernel->crypt->process($pass,'encrypt');
		$loggedin = $kernel->users->loggedin;
		$uid = $kernel->users->userid;
		$perm = $kernel->users->perm_level;
		
		$_SESSION['username'] = $name;
		$_SESSION['password'] = $passSess;
		$_SESSION['loggedin'] = $loggedin;
		$_SESSION['myuid'] = $uid;
		$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
		$_SESSION['time'] = time();
		$_SESSION['perm_level'] = $perm;
		
		//----------------------------
		// Now that the vars are set make sure they stay that way...
		//----------------------------
		session_register("loggedin");
		session_register("myuid");
		session_register("username");
		session_register("password");
		session_register('ip');
		session_register('time');
		session_register('perm_level');
		return true;
	}
	else
	{
		//----------------------------
		// or not...
		//----------------------------
		return false;
	}
	
}

//----------------------------
// Boss-man wants in...
//----------------------------
function admin_login($name,$pass)
{
	global $kernel;
	if($_SESSION['isadmin'] == '1' && intval($_SESSION['a_id']) > 0)
	{	
		$_SESSION['adminSecret'] = md5(getAdminSessionString());		
		session_register("adminSecret");
		
		$_SESSION['adminTime'] = (time() + 1800);		
		session_register("adminTime");
		return true;
	}
	else
	{
		return false;
	}
}

function adminSiteClosedLogin($name,$pass)
{
	global $kernel;
	@session_destroy();
	@session_start();

	$kernel->users->pre($name,$pass);
	if($kernel->users->login())
	{			
		if($kernel->users->perm_level != '2')
		{
			return false;
		}
		$adminId = $kernel->users->userid;
			$_SESSION['isadmin'] = '1';
			session_register("isadmin");
			$_SESSION['a_id'] = $adminId;
			session_register("isadmin");
		
		//----------------------------
		// Allow all into the admin panel if defined as true
		//----------------------------
		if(XU_NO_ADMIN_AUTH)
		{
			$_SESSION['isadmin'] = '1';
			session_register("isadmin");
			$_SESSION['a_id'] = '1';
			session_register("isadmin");
		}

		//----------------------------
		// set session crap
		//----------------------------
		$name = $kernel->users->name;
		$passSess = $kernel->crypt->process($pass,'encrypt');
		$loggedin = $kernel->users->loggedin;
		$uid = $kernel->users->userid;
		$perm = $kernel->users->perm_level;
		
		$_SESSION['username'] = $name;
		$_SESSION['password'] = $passSess;
		$_SESSION['loggedin'] = $loggedin;
		$_SESSION['myuid'] = $uid;
		$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
		$_SESSION['time'] = time();
		$_SESSION['perm_level'] = $perm;
		$_SESSION['adminSecret'] = md5(getAdminSessionString());
		$_SESSION['adminTime'] = (time() + 1800);	
		
		//----------------------------
		// Now that the vars are set make sure they stay that way...
		//----------------------------
		session_register("loggedin");
		session_register("myuid");
		session_register("username");
		session_register("password");
		session_register('ip');
		session_register('time');
		session_register('perm_level');
		session_register("adminSecret");	
		session_register("adminTime");

		return true;
	}
	else
	{
		//----------------------------
		// or not...
		//----------------------------
		return false;
	}
}
	
function getAdminSessionString()
{
	global $kernel;
	$time = date('F-j');
	return $kernel->crypt->process($time, 'encrypt');
}

function isValidEmail($e)
{
	if(eregi("^[a-zA-Z0-9]+[_a-zA-Z0-9]*(\.[_a-z0-9-]+)*@[a-z 0-9]+(-[a-z 0-9+)*(\.[a-z 0-9-]+)*(\.[a-z]{2,4}$",$e))
	{
		return true;
	}
	else
	{
		return false;
	}
}

//----------------------------
// sanatize text
//----------------------------
function txt_clean($fix)
{
	global $kernel, $db;
	return $kernel->clean->safeSQL($fix,$db->connection);
}

//----------------------------
// sanatize text
//----------------------------
function html_clean($fix)
{
	global $kernel, $db;
	return $kernel->clean->process($fix);
}

//----------------------------
// Display ads
//----------------------------
function get_ads()
{
	global $kernel, $no_ads;
	
	// Advertisement Class
	if(!isset($kernel->ext->ads))
	{
		$kernel->loadUserExt('ads');
	}
	return $kernel->ext->ads->make_link();
}
	
//----------------------------
// Get a server url to upload to
//----------------------------
function get_server()
{
	global $kernel;
	return $kernel->server->get_server();
}

//----------------------------
// Update used bandwith 
//----------------------------
function update_bandwith($file)
{
	global $kernel;
	return $kernel->server->update_bandwith($file);
}

//----------------------------
// update used storage space
//----------------------------
function update_total_size($file)
{
	global $kernel;
	return $kernel->server->update_total_size($file);
}

//----------------------------
// Display that magical copyright info!
//----------------------------
function copyright()
{
	global $CPR_trans_ssde;
	if (file_exists("./plugins/cpr/cpr.php"))
	{
		include_once("./plugins/cpr/cpr.php");
		if ( !invalid_copyright_334ksjde() )
		{
			$c='';
		}
		else
		{
			$c='<!-- Copyright Info -->
			<a style="color:#000000; font-size:12px" href="http://xtrafile.com" target="_blank">'.$CPR_trans_ssde.'</a>
			<!-- Copyright Info -->';
		}
	}
	else
	{
		$c='<!-- Copyright Info -->
		<center><a style="color:#000000; font-size:12px" href="http://xtrafile.com" target="_blank">'.$CPR_trans_ssde.'</a></center>
		<!-- Copyright Info -->';
	}
	return $c;
}

//----------------------------
// Translate CPR Text.
//----------------------------
function cpr_translate()
{
	global $trans;
	if($trans == 'EN')
	{
		return 'Powered By XtraUpload File Hosting System';
	}
	else if($trans == 'DE')
	{
		return 'Prsentiert von XtraUpload File Hosting System';
	}
	else if($trans == 'DU')
	{
		return 'Gesponsort door XtraUpload File Hosting System';
	}
	else if($trans == 'FR')
	{
		return 'Puissance à travers XtraUpload File Hosting System';
	}
	else if($trans == 'SP')
	{
		return 'Accionado por: XtraUpload - Sistema de hosting de archivos';
	}
	else if($trans == 'KR')
	{
		return '??? ??: XtraUpload File Hosting System';
	}
	else if($trans == 'CH')
	{
		return '????: XtraUpload File Hosting System';
	}
	else
	{
		return 'Powered By XtraUpload File Hosting System';
	}
}

//----------------------------
// Get Bytes prefix for file size
//----------------------------
function get_filesize_prefix($size, $mode = 0)
{
	$times = 0;
	$comma = '.';
	while (1024 < $size)
	{
	  ++$times;
	  $size = $size / 1024;
	}

	$size2 = floor ($size);
	$rest = $size - $size2;
	$rest = $rest * 100;
	$decimal = floor ($rest);
	$addsize = $decimal;
	if ($decimal < 10)
	{
	  $addsize .= '0';
	}

	if ($times == 0)
	{
	  $addsize = $size2;
	}
	else
	{
	  $addsize = $size2 . $comma . substr ($addsize, 0, 2);
	}

	switch ($times)
	{
	  case 0:
	  {
		$mega = ' Byte';
		break;
	  }

	  case 1:
	  {
		$mega = ' KB';
		break;
	  }

	  case 2:
	  {
		$mega = ' MB';
		break;
	  }

	  case 3:
	  {
		$mega = ' GB';
		break;
	  }

	  case 4:
	  {
		$mega = ' TB';
		break;
	  }
	}

	if (($mode == 1 AND $pos = strrpos ($addsize, '.') !== false))
	{
	  $addsize = substr ($addsize, 0, $pos);
	}

	$addsize .= $mega;
	return $addsize;
}

function imgSize($file)
{
	$size = getimagesize($file);
	return array("width"=>$size[0],"height"=>$size[1]);
}
//----------------------------
// Create a thumbnail image from an original
//----------------------------
function img_thumb($file)
{
	global $kernal;
	
	$image = $file;
	$image = explode('/',$image);
	
	if(!is_dir('./thumbs/'.$image[(count($image) - 2)]))
	{
		mkdir('./thumbs/'.$image[(count($image) - 2)]);
	}
	
	$path = 'thumbs/'.$image[(count($image) - 2)].'/'.'thumb_'.$image[(count($image) - 1)];
	
	if(!file_exists($path))
	{	
		// Load Kernel Extension To Process This crap :P
		$kernel->loadUserExt('imageThumb');

		// Image Quality - Default to 100 ( original quality)
		$kernel->ext->imageThumb->quality = 100;
		
		// Image File path
		$kernel->ext->imageThumb->fileName = $file;

		//IMPORTANT - must run init() function before any manipulation is performed
		$kernel->ext->imageThumb->init();
		
		//shrink image
		$kernel->ext->imageThumb->percent = 0;
		$kernel->ext->imageThumb->maxWidth = 150;
		$kernel->ext->imageThumb->maxHeight = 150;
		$kernel->ext->imageThumb->resize();
		
		// Save
		$kernel->ext->imageThumb->save($path);
	}
	return $path;
}

//----------------------------
// Place text on an image
//----------------------------
function img_text($image,$text,$color)
{
	global $kernel, $imageFontSize;	
	$kernel->loadUserExt('imageTool');
	$kernel->ext->imageTool->newImage($image);
	$kernel->ext->imageTool->addText ( $text, './fonts/trebucbd.ttf', $imageFontSize, $color,  'right',  'bottom' , '0');
	$kernel->ext->imageTool->save($image,false,100);
	return $image;
}

//----------------------------
// run a javascript redirect with footer.
//----------------------------
function redirect_foot($error,$url)
{
	global $kernel, $siteurl;
	echo $error.'<script>function r(){location = "'.$siteurl.'index.php?p='.$url.'";}setTimeout("r()",1500)</script>';
	$kernel->tpl->display('site_footer.tpl');
	die;
}

//----------------------------
// Redirect in admin section with footer.
//----------------------------
function redirect_admin_foot($error,$url,$args)
{
	global $kernel, $siteurl;
	echo $error.'<script>function r(){location = "'.$siteurl.$url.'.php'.$args.'";}setTimeout("r()",1500)</script>';
	include("admin/footer.php");
	die;
}

//----------------------------
// duplicate of an above function
//----------------------------
function redirect_page($error,$url)
{
	global $kernel, $siteurl;
	echo $error.'<script>function r(){location = "'.makeXuLink('index.php','p='.$url).'";}setTimeout("r()",1500)</script>';
	echo $kernel->tpl->display('site_footer.tpl');
	die;
}

//----------------------------
// Javascript page redirect
//----------------------------
function redirect($error,$url)
{
	global $kernel, $siteurl;
	echo $error.'<script>function r(){location = "'.makeXuLink('index.php','p='.$url).'";}setTimeout("r()",1500)</script>';
	die;
}

//----------------------------
// delete file based on file ID
//----------------------------
function delfile($id,$silent = false)
{
	global $kernel, $lang;
	$sql = "SELECT * FROM files WHERE id='".$id."'";
	$qr1 = $kernel->db->query($sql);
	$num = $kernel->db->num($qr1);
	if($num == '0')
	{
		return '<center><h3>'.$lang['functions']['1'].'</h3></center>';
	}
	else
	{
		$row = $kernel->db->fetch($qr1,'obj');
		if( file_exists("./files/".substr($row->md5,0,2).'/'.$row->filename)	)
		{
			unlink("./files/".substr($row->md5,0,2).'/'.$row->filename);
		}
		
		if( file_exists("./thumbs/thumbs_".$row->filename)	)
		{
			unlink("./thumbs/thumbs_".$row->filename);
		}
		$kernel->db->query("UPDATE files SET `status` = '2' WHERE `id` = '".$id."'");
		log_action('File Deleted By Admin', 'file:delete', 'The File('.$row->o_filename.') was deleted by '.$_SESSION['username'], 'ok', 'admin/filemanager.php');
		if(!$silent)
		{
			return '<center><h3>'.$lang['functions']['2'].'</h3></center>';
		}
		else
		{
			return true;
		}
	}
}

//----------------------------
// delete file based on user delete link
//----------------------------
function delfile_user($pkey)
{
	global $kernel, $lang;
	$sql = "SELECT * FROM files WHERE pkey='".$pkey."'";
	$qr1 = $kernel->db->query($sql);
	$num = $kernel->db->num($qr1);
	if($num == '0')
	{
		return '<center><h3>'.$lang['functions']['1'].'</h3></center>';
	}
	else
	{
		$row = $kernel->db->fetch($qr1,'obj');
		if( file_exists("./files/".substr($row->md5,0,2).'/'.$row->filename)	)
		{
			unlink("./files/".substr($row->md5,0,2).'/'.$row->filename);
		}
		
		if( file_exists("./thumbs/thumbs_".$row->filename)	)
		{
			unlink("./thumbs/thumbs_".$row->filename);
		}
		$kernel->db->query("UPDATE files SET `status` = '2' WHERE `pkey` = '".$pkey."'");
		log_action('File Deleted By user', 'file:delete', 'The File('.$row->o_filename.') was deleted by '.$_SESSION['username'], 'ok', 'delfile.php');
		return '<center><h3>'.$lang['functions']['2'].'</h3></center>';
	}
}

//----------------------------
// Delete file based on file hash
//----------------------------
function delfile_expire($hash)
{
	global $kernel, $lang;
	$sql = "SELECT * FROM files WHERE hash='".$hash."'";
	$qr1 = $kernel->db->query($sql);
	$num = $kernel->db->num($qr1);
	if($num == '0')
	{
		return '<center><h3>'.$lang['functions']['1'].'</h3></center>';
	}
	else
	{
		$row = $kernel->db->fetch($qr1,'obj');
		if( file_exists("./files/".substr($row->md5,0,2).'/'.$row->filename)	)
		{
			unlink("./files/".substr($row->md5,0,2).'/'.$row->filename);
		}
		
		if( file_exists("./thumbs/thumbs_".$row->filename)	)
		{
			unlink("./thumbs/thumbs_".$row->filename);
		}
		$kernel->db->query("UPDATE files SET `status` = '2' WHERE `hash` = '".$hash."'");
		log_action('File Expired and Deleted', 'file:delete', 'The File('.$row->o_filename.') was deleted by XtraUpload because it expired.', 'ok', '{core}');
		return '<center><h3>'.$lang['functions']['2'].'</h3></center>';
	}
}

//----------------------------
// Check existance of a file
//----------------------------
function check_file($hash)
{
	global $kernel, $lang, $siteurl;
	$sql = "SELECT * FROM files WHERE hash='".$hash."'";
	$qr1 = $kernel->db->query($sql);
	$qr1 = $kernel->db->fetch($qr1);
	if($qr1->status == '1')
	{
		if(strstr($siteurl,$qr1->server))
		{
			/* See whether the specified file is available, and can be read. If not, return false. */
			if( file_exists('./files/'.substr($qr1->md5,0,2).'/'.$qr1->filename))
			{
				return "<font color='#009900'>".$lang['functions']['3']."</font>";
			}
			else
			{
				return "<font color='#FF0000'>".$lang['functions']['7']."</font>";
			}
		}
		else
		{
			$fp = fopen($qr1->server."/include/file_check.php?file=".$qr1->hash,"r");
			if($fp)
			{
				$exit = '';
				while(!feof($fp))
				{
					$exit .=  @fread($fp, 1024);
				}
				if($exit)
				{
					return "<font color='#009900'>".$lang['functions']['3']."</font>";
				}
				else
				{
					return "<font color='#FF0000'>".$lang['functions']['7']."</font>";
				}
			}
			else
			{
				return false;
			}
		}
	}
	else if($qr1->status == '0')
	{
		return "<font color='#FF0000'>".$lang['functions']['4']."</font>";
	}
	else if($qr1->status == '2')
	{
		return "<font color='#FF0000'>".$lang['functions']['5']."</font>";
	}
	else if($qr1->status == '3')
	{
		return "<font color='#FF0000'>".$lang['functions']['6']."</font>";
	}
	else
	{
		return "<font color='#FF0000'>".$lang['functions']['7']."</font>";
	}
}

//----------------------------
// Snynomus with above
//----------------------------
function check_file_descriptive($hash)
{
	global $kernel, $lang, $siteurl;
	$sql = "SELECT * FROM files WHERE hash='".$hash."'";
	$qr1 = $kernel->db->query($sql);
	$qr1 = $kernel->db->fetch($qr1);
	if($qr1->status == '1')
	{
		if(strstr($siteurl,$qr1->server))
		{
			/* See whether the specified file is available, and can be read. If not, return false. */
			if( file_exists('./files/'.substr($qr1->md5,0,2).'/'.$qr1->filename))
			{
				return "File was found";
			}
			else
			{
				return "File not found in server.";
			}
		}
		else
		{
			$fp = fopen($qr1->server."/include/file_check.php?file=".$qr1->hash,"r");
			if($fp)
			{
				$exit = '';
				while(!feof($fp))
				{
					$exit .=  @fread($fp, 1024);
				}
				if($exit)
				{
					return "File was found";
				}
				else
				{
					return "File not found in server.";
				}
			}
			else
			{
				return 'The server the file is located on is not responding';
			}
		}
	}
	else if($qr1->status == '0')
	{
		return "File was removed by admin";
	}
	else if($qr1->status == '2')
	{
		return "File was deleted by uploader";
	}
	else if($qr1->status == '3')
	{
		return "File was not downloaded in the alloted time and has been deleted";
	}
}

//----------------------------
// returns true/false on existance of file
//----------------------------
function check_file_bool($hash)
{
	global $kernel, $lang, $siteurl ;
	$sql = "SELECT * FROM files WHERE hash='".$hash."'";
	$qr1 = $kernel->db->query($sql);
	$qr1 = $kernel->db->fetch($qr1);
	if($qr1->status == '1')
	{
		if(strstr($siteurl,$qr1->server))
		{
			/* See whether the specified file is available, and can be read. If not, return false. */
			if( file_exists('./files/'.substr($qr1->md5,0,2).'/'.$qr1->filename))
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
		else
		{
			$fp = fopen($qr1->server."/include/file_check.php?file=".$qr1->hash,"r");
			if($fp)
			{
				$exit = '';
				while(!feof($fp))
				{
					$exit .=  @fread($fp, 1024);
				}
				
				if($exit)
				{
					return 1;
				}
				else
				{
					return 0;
				}
			}
			else
			{
				return 0;
			}
		}
	}
	else
	{
		return 0;
	}
}

//----------------------------
// Add a point to a user
//----------------------------
function add_points($uid='a')
{
	global $kernel;
	if($uid='a'){$uid=$_SESSION['myuid'];}
	$kernel->points->pre($uid);
	$kernel->points->add();
	log_action('Points Added:('.$_SESSION['username'].') ', 'points:add', 'Added 1 point to user '.$_SESSION['username'], 'ok', 'functions.inc.php');

}

//----------------------------
// same as above
//----------------------------
function add_points_download($uid='a',$file)
{
	global $kernel;
	if($uid='a'){$uid=$_SESSION['myuid'];}
	$kernel->points->pre($uid);
	$kernel->points->download_add();
	log_action('Points Added:('.$_SESSION['username'].') ', 'points:add', 'Added 1 point to user '.$_SESSION['username'], 'ok', 'functions.inc.php');

}

//----------------------------
// subtracts points.
//----------------------------
function subtract_points($uid='a')
{
	global $kernel;
	if($uid='a'){$uid=$_SESSION['myuid'];}
	$kernel->points->pre($uid);
	$kernel->points->subtract();
		log_action('Points Subtracted:('.$_SESSION['username'].') ', 'points:add', 'Subtracted 1 point from user '.$_SESSION['username'], 'ok', 'functions.inc.php');

}

//----------------------------
// totals points
//----------------------------
function total_points($uid='a')
{
	global $kernel;
	if($uid='a'){$uid=$_SESSION['myuid'];}
	$kernel->points->pre($uid);
	$kernel->points->total();
}

//----------------------------
// gets an icon image HTML
//----------------------------
function get_icon($name,$size,$alt=false,$escape=false)
{
	global $siteurl;
	$html='';
	$real_size = '';
	$h = '';
	$w = '';
	$name = str_replace('_',' ',$name);
	switch($size)
	{
		case "small": $real_size = '16x16'; $s = '16'; break;
		case "normal": $real_size = '24x24'; $s = '24'; break;
		case "large": $real_size = '32x32'; $s = '32'; break;
		default: $real_size = '32x32'; $s = '32'; break;		
	}
	if($escape)
	{
		$html .= '<img src="'.$siteurl.'/images/actions/';
		
		$html .= $name.'_'.$real_size.'.png';
		
		$html .= '" alt="';
		if(!$alt)
		{
			$html .= $name;
		}
		else
		{
			$html .= $alt;
		}
		$html .= '" width="'.$s.'" height="'.$s.'" border="0" />';
	}
	else
	{
		$html .= "<img src='".$siteurl."/images/actions/";
		
		$html .= $name.'_'.$real_size.'.png';
		
		$html .= "' alt='";
		if(!$alt)
		{
			$html .= $name;
		}
		else
		{
			$html .= $alt;
		}
		$html .= "' width='".$s."' height='".$s."' border='0' />";
	}
	return $html;
}

//----------------------------
// gets the "real" date
//----------------------------
function rdate()
{
	return date('F j, Y, g:i a',time());
}

//----------------------------
// gets the "real" date
//----------------------------
function inputDate($time)
{
	return date('F j, Y, g:i a',$time);
}

//----------------------------
// gets the "real" date, but just the day
//----------------------------
function dayDate($time)
{
	return date('F j, Y', $time);
}

//----------------------------
// Logs action
//----------------------------
function log_action($desc, $action, $content, $status, $sector)
{
	global $db;
	$db->query("INSERT INTO `syslog` (`desc`, `action`, `content`, `status`, `sector`, `date`) VALUES ('".$desc."','".$action."','".$content."','".$status."','".$sector."','".rdate()."')");
}

//----------------------------
// creates inline-editable JS
//----------------------------
function createEditableJS($dom_id,$table,$column,$id)
{
	global $kernel;
	$key = $kernel->password->gen(20);
	$table = $kernel->crypt->process($table,'encrypt',NULL,$key);
	$column = $kernel->crypt->process($column,'encrypt',NULL,$key);
	$id = $kernel->crypt->process($id,'encrypt',NULL,$key);
	$return = "$('#".$dom_id."').editInPlace('./jhp/eip.php', 'xtr=".$table."&dce=".$column."&jit=".$id."&wsl=".$key."');";
	return $return;
}

//----------------------------
// adds a link block to a folder
//----------------------------
function add_files_to_folder($fid,$links)
{
	global $db,$kernel;
	$block = explode("\n",$links);
	$hash_arr = array();
	$added = 0;
	foreach($block as $line)
	{
		$line = trim($line);
		if($line != '' and stristr($line,'index.php?p=download&hash='))
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
				echo $hash."|<br />";
				if(check_file_bool($hash))
				{
					$file = $db->fetch($db->query("SELECT `id` FROM `files` WHERE `hash` = '".$hash."'"));
					list($folder) = $db->fetch($db->query("SELECT COUNT(*) FROM `fitem` WHERE `fid` = '".$fid."' AND `file` = '".$file->id."'"),'num');
					if($folder == 0)
					{
						$db->query("INSERT INTO `fitem` SET `fid` = '$fid', `file` = '".$file->id."'");
						$added++;
					}
				}
				$hash_arr[] = $hash;
			}
		}
	}
	return $added;
}

//----------------------------
// Makes a download link from a file ID
//----------------------------
function make_download_link_html_with_id($id)
{
	global $rewrite_links, $siteurl, $db, $kernel;
	$file = $db->fetch($db->query("SELECT `hash` FROM `files` WHERE `id` = '".$id."'"));
	if($rewrite_links)
	{
		$furl = $siteurl . 'download/' . $file->hash ;
	}
	else
	{
		$furl = $siteurl . 'index.php?p=download&hash=' . $file->hash ;
	}
	return $furl;
}

//----------------------------
// shortens text with an elipsis
//----------------------------
function elipsis($str,$count = 13)
{
	$o_filename_1 = $str;
	if(strlen($o_filename_1) > ($count * 3))
	{
		$o_filename_1 = strsplit($o_filename_1, 3);
		$i=0; $new = '';
		$count = count($o_filename_1); $count--; $count--; $count--; 
		while($i < ($count))
		{
			$new .= $o_filename_1[$i];
			$i++;
		}
		return $new.'...'.$o_filename_1[$count++].$o_filename_1[$count++].$o_filename_1[$count++].$o_filename_1[$count];
	}
	return $str;
}

//----------------------------
// makes a download link from a file hash
//----------------------------
function makeDownLinkFromHash($hash)
{
	global $kernel, $db, $siteurl, $rewrite_links;
	if($rewrite_links)
	{
		$furl = $siteurl . 'download/' . $hash ;
	}
	else
	{
		$furl = $siteurl . 'index.php?p=download&hash=' . $hash ;
	}
	return $furl;
}

//----------------------------
// makes an internal link that works with the...
// new mod_rewrite rules if it is enabeled
//----------------------------
function makeXuLink($page, $args, $otherMain='', $href=true)
{
	global $rewrite_links, $siteurl;
	
	$main = $siteurl;
	if($otherMain != '')
	{
		$main = $otherMain.'/';
	}
	
	$str = $main . str_replace('.php','',$page);
	
	if($rewrite_links)
	{
		$str .= '/';
		
		if($page == 'imagedirect.php')
		{
			$args = explode('=', $args);
			$str = $main . 'imagedirect/'.str_replace('/','',$args[1]);
			return $str;
		}
		if($page == 'thumb.php')
		{
			$args = explode('=', $args);
			$str = $main . 'thumb/'.str_replace('/','',$args[1]);
			return $str;
		}
		
		if(is_array($args))
		{
			foreach($args as $key => $val)
			{
				$str .= $key.'_'.str_replace('/','',$val).'/';
			}
		}
		else if(is_string($args))
		{
			$part = explode('&', $args);
			foreach($part as $part1)
			{
				if(trim($part1) != '')
				{
					$uri = explode('=', $part1);
					$str .= $uri[0].'_'.str_replace('/','',$uri[1]).'/';
				}
			}
		}
	}
	else
	{
		$str .= '.php?';
		
		if($page == 'imagedirect.php')
		{
			$args = explode('=', $args);
			$str = $main . 'imagedirect.php?file='.str_replace('/','',$args[1]);
			return $str;
		}
		
		if($page == 'thumb.php')
		{
			$args = explode('=', $args);
			$str = $main . 'imagedirect.php?file='.str_replace('/','',$args[1]).'&thumb=true';
			return $str;
		}
		
		if(is_array($args))
		{
			foreach($args as $key => $val)
			{
				$str .= $key.'='.$val.'&';	
			}
		}
		else if(is_string($args))
		{
			$part = explode('&', $args);
			foreach($part as $part1)
			{
				if(trim($part1) != '')
				{
					$uri = explode('=', $part1);
					$str .= $uri[0].'='.str_replace('/','',$uri[1]).'&';
				}
			}
		}
	}
	return $str;
}

//smarty functions
function insert_languageFlags()
{
	global $db, $kernel, $language, $siteurl;
    
    $sql = "SELECT * FROM lang";
    $qr1 = $db->query($sql);
    
    $arr = array();
    $currLang = $_GET['langSwitch'];
    $i=0;
    while($a = $db->fetch($qr1))
    {
		$arr[$i]['link'] = makeXuLink('index.php', str_replace('&langSwitch='.$currLang,'',$_SERVER['QUERY_STRING'])."&langSwitch=".str_replace('.php','',$a->file));
    	$arr[$i]['cc'] = strtolower($a->cc);
        $arr[$i]['name'] = $a->name;
		$i++;
    }
    return $arr;
}

function insert_rand()
{
    return rand();
}

function insert_ads()
{
    return get_ads();
}

function parseVersion($v)
{
	$parts = explode(',',$v);
	$version = $parts[0];
	
	$part = (int)str_replace('.','',$parts[1]);
	if($part < 10)
	{
		$ver = explode('.',$parts[1]);
		$part = (int)($ver[3]);
		$version .= ' [ALPHA-'.round($part / 1).']';
	}
	else if($part < 100)
	{
		$ver = explode('.',$parts[1]);
		$part = (int)($ver[2].'0');
		$version .= ' [BETA-'.round($part / 10).']';
	}
	else if($part < 1000)
	{
		$ver = explode('.',$parts[1]);
		$part = (int)($ver[1].'00');
		$version .= ' [RC-'.round($part / 100).']';
	}
	else
	{
		if($part > 1000)
		{
			//$version .= '; Build: '.(int)substr($part,1,3);
			$version .= ' r'.(int)substr($part,1,3).' STABLE';
		}
		else
		{
			$version .= ' [STABLE]';
		}
		
	}
	
	return $version;
}

/*
//----------------------------
// Send upload status to the progress bar
//----------------------------
function uploadstatus($iTotal, $iRead, $dtstart)
{
	$dtnow = time ();
	$dtelapsed = $dtnow - $dtstart;
	$dtelapsed_sec = $dtelapsed % 60;
	$dtelapsed_min = ($dtelapsed - $dtelapsed_sec) % 3600 / 60;
	$dtelapsed_hours = ($dtelapsed - $dtelapsed_sec - $dtelapsed_min * 60) % 86400 / 3600;
	if ($dtelapsed_sec < 10)
	{
		$dtelapsed_sec = '' . '0' . $dtelapsed_sec;
	}

	if ($dtelapsed_min < 10)
	{
		$dtelapsed_min = '' . '0' . $dtelapsed_min;
	}

	if ($dtelapsed_hours < 10)
	{
		$dtelapsed_hours = '' . '0' . $dtelapsed_hours;
	}

	$dtelapsedf = '' . $dtelapsed_hours . ':' . $dtelapsed_min . ':' . $dtelapsed_sec;
	$bSpeed = 0;
	if (0 < $dtelapsed)
	{
		$bSpeed = $iRead / $dtelapsed;
		$bitSpeed = $bSpeed * 8;
		$kbitSpeed = $bitSpeed / 1000;
	}
	else
	{
		$kbitSpeed = $bSpeed;
	}

	$bSpeedf = sprintf ('%d', $kbitSpeed);
	$bRemaining = $iTotal - $iRead;
	$dtRemaining = 0;
	if (0 < $bSpeed)
	{
		$dtRemaining = $bRemaining / $bSpeed;
	}

	$dtRemaining = sprintf ('%d', $dtRemaining);
	$dtRemaining_sec = $dtRemaining % 60;
	$dtRemaining_min = ($dtRemaining - $dtRemaining_sec) % 3600 / 60;
	$dtRemaining_hours = ($dtRemaining - $dtRemaining_sec - $dtRemaining_min * 60) % 86400 / 3600;
	if ($dtRemaining_sec < 10)
	{
		$dtRemaining_sec = '' . '0' . $dtRemaining_sec;
	}

	if ($dtRemaining_min < 10)
	{
	  $dtRemaining_min = '' . '0' . $dtRemaining_min;
	}

	if ($dtRemaining_hours < 10)
	{
	  $dtRemaining_hours = '' . '0' . $dtRemaining_hours;
	}

	$dtRemainingf = '' . $dtRemaining_hours . ':' . $dtRemaining_min . ':' . $dtRemaining_sec;
	$percent = round($iRead * 100 / $iTotal);
	echo '' . '<script>update("'.$iRead.'", "'.$iTotal.'", "'.$dtRemainingf.'", "'.$dtelapsedf.'", "'.$bSpeedf.'", "'.$percent.'");</script>';
	flush();
}

//----------------------------
// gets a file comments
//----------------------------
function get_comments($id)
{
	
	global $db, $siteurl;
	$html = '<br />
<br />
<div style="border:1px solid #000000">';
	$i=0;
	
	if($_SESSION['isadmin'])
	{
		$base1 = $db->query("SELECT * FROM `comments` WHERE `file` = '".$id."'");
	}
	else
	{
		$base1 = $db->query("SELECT * FROM `comments` WHERE `file` = '".$id."' AND `status` = '1'");
	}
	$base2 = $db->query("SELECT * FROM `files` WHERE `hash` = '".$id."'");
	
	while($comment = $db->fetch($base1))
	{
		$i++;
		$html .= '<table width="48%" id="comment_'.$i.'" height="5%" border="0" cellpadding="6" cellspacing="0"  style="border:1px solid #000000">
  <tr>
	<td width="100%" height="169"><table width="100%" border="0" cellspacing="0" cellpadding="5">
		<tr>
		  <td width="72%"><font size="4"><u><b>'.$comment->title.' </b></u></font><br />
 		 <font size="3">By: <a href="'.$comment->url.'">'.$comment->author.'</a> On: '.$comment->date.'</font></td>
		  <td width="28%"><div align="right"><font size="4"><u><b><a href="#comment_'.$i.'">Comment #'.$i.'</a></b></u></font></div></td>
		</tr>
	  </table>
	  <hr noshade="noshade" color="#000000"/><div align="center">
	  <table width="769" height="48" border="0" cellpadding="5" cellspacing="0">
		<tr>
		  <td width="544"><font size="3">'.$comment->body.'</font></td>
		  <td width="205">';
		  if($_SESSION['isadmin'])
		  {
		  $html .= '<div align="center" style="border: 2px solid #FF0000;"><strong><font color="#FF0000">Quick Admin Actions</font> </strong><hr /><br />
			  <a href="'.$siteurl.'index.php?p=comments&act=edit&comment='.$comment->id.'&status=1&file='.$id.'">'.get_icon('Comment (Edit)','normal').'</a>
			  	&nbsp;&nbsp; 
			  <a onclick="return confirm(\'Are you sure you want to delete this comment?\')" href="'.makeXuLink('index.php','p=comments&act=delete&comment='.$comment->id.'&status=1&file='.$id).'">'.get_icon('Comment (Remove)','normal').' </a>
			  	&nbsp;&nbsp; ';

			 if(!$comment->status == '1')
			 {
			 	
			 	$html .= '<a href="'.makeXuLink('index.php','p=comments&act=status&comment='.$comment->id.'&status=1&file='.$id).'">'.get_icon('Add (Alt 2)','normal', 'Reveal Comment to Public').'</a>';
			 }
			 else
			 {
			 	$html .= '<a href="'.makeXuLink('index.php','p=comments&act=status&comment='.$comment->id.'&status=0&file='.$id).'">'.get_icon('Remove (Alt 2)','normal', 'Hide Comment From Public View').'</a>';
			 }
			 $html .= '<br />
				<br />
		  </div>';
		  }
		  $html .= '</td>
		</tr>
	  </table>
	</div></td>
  </tr>
</table>

<hr />';
		
	}
	
	
	
	$html .= '
	<script type="text/javascript">
	
var comm_name = false;
var comm_title = false;
var comm_body = false;
var comm_email = false;

function check_comment()
{
	if($("#author").attr("value") > 2)
	{
		alert(\'You must supply a name to post comments.\')
		return false;
	}
	else if($("#title").attr("value") > 2)
	{
		alert(\'You must give your comment a title .\')
		return false;
	}
	else if(!$("#email").attr("value") > 2)
	{
		alert(\'You must supply an email address to post comments.\')
		return false;
	}
	else if(!$("#body").attr("value") > 2)
	{
		alert(\'You must type a comment post one.\')
		return false;
	}
	else
	{
		return true;
	}
}
	</script>
	<div align="center">
<a href="javascript:;" onclick=\'$("#post_comment").slideDown("normal"); $(this).slideUp("normal");\'><br />'.get_icon('Comment (Add)','normal','Add Comment').' <font size="4">Post a comment!</font></a>
</div>
<table id="post_comment" style="display:none" border="0">
  <tr>
   <td>
   <hr />
	<form enctype="application/x-www-form-urlencoded" action="'.makeXuLink('index.php','p=comments&act=add&file='.$id).'" method="post" onsubmit="return check_comment()">
	<table width="700" height="177" border="0">
	  <tr>
		<td width="700"><table width="673" height="75" border="0">
		  <tr>
			<td width="197" height="25"><div align="right"><strong>Name:<font color="#FF0000">*</font></strong></div></td>
			<td width="466"><input type="text" name="author" id="author" size="40" /></td>
		  </tr>
		  <tr>
			<td height="25"><div align="right"><strong>Comment Title:<font color="#FF0000">*</font> </strong></div></td>
			<td><input type="text" name="title" id="title" size="40"  /></td>
		  </tr>
		   <tr>
			<td height="25"><div align="right"><strong>Website:</strong></div></td>
			<td><input type="text" name="url" id="url" size="40" value="#" /></td>
		  </tr>
		  <tr>
			<td><div align="right"><strong>Email:<font color="#FF0000">*</font> </strong></div></td>
			<td><input type="text" name="email" id="email" size="40" /></td>
		  </tr>
		  <tr>
			<td><div align="right"><strong>Comment:<font color="#FF0000">*</font> </strong></div></td>
			<td><textarea name="body" id="body" cols="40" rows="8" ></textarea></td>
		  </tr>
		</table>
		  <div align="center"><br />
			<input name="post" type="submit" id="post" value="Post Comment" />
		  </div></td>
	  </tr>
	</table>
	  <br />
	  <font color="#FF0000"><strong>*</strong></font> <strong>= <font color="#FF0000"><font color="#000000">required</font></font></strong><font color="#FF0000"><font color="#000000"></font></font>
	</form>
   </td>
  </tr>
 </table>
</div>';
	return $html;
}
*/
?>