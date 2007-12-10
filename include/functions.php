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

//----------------------------
// Allow all into the admin panel if defined as true
//----------------------------
if(XU_NO_ADMIN_AUTH)
{
	$_SESSION['is_admin'] = true;
}

//----------------------------
// Start Loggedin Logic
//----------------------------
if(!(isset($_SESSION['loggedin'])))
{
	$_SESSION['loggedin'] = false;
	
}
else
{

	if($_SESSION['loggedin'] == '1')
	{
		$_SESSION['loggedin'] = true;
	}else{
		$_SESSION['loggedin'] = false;
	}
}

if(isset($_SESSION['myuid']))
{
	$myuid = $_SESSION['myuid'];
	
}
else
{
	$myuid = '';
}

// Give Footer Copyright a language
$CPR_trans_ssde = cpr_translate();

// Initiate the new kernel System
$db='';
$xuTpl=array();
$kernel = new kernel('./config.php');

// Default Template Vars, Available to all templates
$qr1 = $db->query("SELECT * FROM `config` ", "config", true);	
while($a = $db->fetch($qr1))
{
	$name = $a->name;
	$$name = $a->value;
	$kernel->tpl->assign($name, $a->value);
}

// Memcache System
$kernel->db->use_memcache = $use_memcache;
$db->use_memcache = $use_memcache;

// add a trailing slash if not there
if(substr($siteurl , -1) != '/')
{
	$siteurl .= '/';
}

define('XU_VER_REAL', $version);

// XtraUpload Installed Version Definition
$verArr = explode(',',$version);
$verDefArr = explode(',',$versionDefault);
if((int)$verArr[0] < (int)$verDefArr[0])
{
	$version = $versionDefault;
}
else if((int)$verArr[1] < (int)$verDefArr[1])
{
	$version = $versionDefault;
}

define('XU_VER', $version);
$version = parseVersion($version);

// MemCache Support
if(class_exists('Memcache'))
{	
	if($use_memcache)
	{
		$kernel->memcache = new Memcache;
		if(!$kernel->memcache->connect($memcache_server, $memcache_port))
		{
			echo("Could not connect to memcache server $memcache_server:$memcache_port<br /><br />\n\n");
		}
		else
		{
			//$db->addHook($code, $location, 'memcache_query');
		}
	}
}

$path = ".".$files_dir; //dont touch this
$tos_page = "./include/pages/rules.php";// dont change this unless you know what you are doing

$perm_level = $_SESSION['perm_level'];
if($perm_level == '')
{
	$perm_level = '1';	
	$_SESSION['perm_level'] = '1';
}

//----------------------------
// Allow all into the admin panel if defined as true
//----------------------------
if(XU_NO_ADMIN_AUTH)
{
	$_SESSION['perm_level'] = '2';
}

$qr2 = $db->query("SELECT * FROM groups WHERE id = '".$perm_level."' ", '', true);
$b = $db->fetch($qr2,'obj');

// Group Config Options
$can_cgi = $b->can_cgi;
$kernel->tpl->assign('can_cgi',  $can_cgi);

$can_flash = $b->can_flash;
$kernel->tpl->assign('can_flash',  $can_flash);

$can_url = $b->can_url;
$kernel->tpl->assign('can_url',  $can_url);

$captcha_is = $b->captcha;
$kernel->tpl->assign('captcha_is', $captcha_is);

$limit_speed = $b->limit_speed;
$kernel->tpl->assign('limit_speed', $limit_speed);

$max_file_streams = $b->max_file_streams;
$kernel->tpl->assign('max_file_streams', $max_file_streams);

$limit_wait = $b->limit_wait;
if($limit_wait == '' or $limit_wait == 0) $limit_wait = 1;
$kernel->tpl->assign('limit_wait', $limit_wait);

$limit_size = $b->limit_size;
$kernel->tpl->assign('limit_size', $limit_size);

$filetypes = $b->allow_types;
$kernel->tpl->assign('filetypes', $filetypes);

$limit = $b->limit;
$downloadLimit = $b->limit;
$kernel->tpl->assign('limit', $limit);

$can_extend = $b->can_extend;
$kernel->tpl->assign('can_extend',  $can_extend);

$can_resume = $b->resume;
$kernel->tpl->assign('can_resume',  $can_resume);

$can_manage = $b->can_manage;
$kernel->tpl->assign('can_manage',  $can_manage);

$can_delete = $b->can_delete;
$kernel->tpl->assign('can_delete',  $can_delete);

$can_email = $b->can_email;
$kernel->tpl->assign('can_email',  $can_email);

$can_create_folders = $b->can_create_folders;
$kernel->tpl->assign('can_create_folders',  $can_create_folders);

$can_view_folders = $b->can_view_folders;
$kernel->tpl->assign('can_view_folders',  $can_view_folders);

$can_email = $b->can_email;
$kernel->tpl->assign('can_email',  $can_email);

$show_direct_link = $b->show_direct_link;
$kernel->tpl->assign('show_direct_link', $show_direct_link);

$files_restrict_allowed = $b->files_restrict_allowed;
$kernel->tpl->assign('files_restrict_allowed', $files_restrict_allowed);

$shownUploadMethod = $b->shownUploadMethod;
$kernel->tpl->assign('shownUploadMethod', $shownUploadMethod);

$no_ads = $b->no_ads;
$kernel->tpl->assign('no_ads', $no_ads);

$is_admin = $b->is_admin;
$kernel->tpl->assign('is_admin', $is_admin);

/**
* Language System Code from here down 30+- lines
*/
if(!isset($upgradeRunning))
{
	//----------------------------
	// Get languages from database
	//----------------------------
	$language1 = $db->fetch($db->query("SELECT * FROM `lang` WHERE `default` = '1'", '', true));
	
	//----------------------------
	// See if the language is already set in the session info and use it
	//----------------------------
	if(isset($_SESSION['language']))
	{
		$language = $_SESSION['language'];
	}
	//----------------------------
	// See if we are logged in and if so see if the user has a prefered language.
	//----------------------------
	else if($_SESSION['loggedin'])
	{
		$dbq = $db->query("SELECT `lang` FROM `users` WHERE `uid` = '".intval($_SESSION['myuid'])."'");
		$language2 = $db->fetch($dbq);
		if($language2->lang != '')
		{
			$language = $language2->file;
			$_SESSION['language'] = $language;
			session_register('language');
		}
		else
		{
			$language = $language1->file;
		}
	}
	//----------------------------
	// Damn free users, serve them the default language!
	//----------------------------
	else
	{
		$language = $language1->file;
	}
	
	//----------------------------
	// :P DEFAULT DEFAULT DEFAULT!!!!
	//----------------------------
	if($language == '')
	{
		$language = 'english.php';
	}
	
	//----------------------------
	// Change lelected language for users who dont like the default
	//----------------------------
	if(isset($_GET['langSwitch']))
	{
		if(file_exists('./include/language/'.txt_clean($_GET['langSwitch']).'.php'))
		{
			$language = txt_clean($_GET['langSwitch']).'.php';
			if(!isset($_SESSION['language']))
			{
				$_SESSION['language'] = $language;
				session_register('language');
			}
			else
			{
				$_SESSION['language'] = $language;
			}
			
			//----------------------------
			// Set the new preferance in the users config( if logged in)
			//----------------------------
			if($_SESSION['loggedin'])
			{
				$db->query("UPDATE `users` SET `lang` = '".$language."' WHERE `uid` = '".intval($_SESSION['myuid'])."'");
			}
		}
	}
	
	//----------------------------
	// include the above language
	//----------------------------
	include("./include/language/".$language);
	$kernel->tpl->assign('lang',$lang);
	
	//----------------------------
	// and on the 8th day he created points for those who had them not...
	//----------------------------
	if(!isset($_SESSION['points']))
	{
		$_SESSION['points'] = serialize(array());
		session_register('points');
	}
	
	
	//----------------------------
	// COOKIE, COOKIE, COOKIE!!!
	//----------------------------
	if($_GET['cookieKill'] or $_GET['p'] == 'logout')
	{
		// kill user cookie
		if($_COOKIE[substr(md5($sitename),0,5).'xuUser'] != '')
		{
			$lifetime 		= time() - 86400;
			$domain = explode('/', $siteurl);
			$domain = $domain[2];
			setcookie(substr(md5($sitename),0,5).'xuUser', ' ', $lifetime ,'/');
			$_COOKIE[substr(md5($sitename),0,5).'xuUser'] = '';
		}
		@session_destroy();
		@session_start();
	}
	
	//----------------------------
	// check users who are loggedin for timeouts...
	//----------------------------
	if(!$_SESSION['loggedin'])
	{
		//----------------------------
		// Cookie is set! read it and try to log in
		//----------------------------
		if($_COOKIE[substr(md5($sitename),0,5).'xuUser'] != '')
		{
			$split = explode('|-|',processUserCookie($_COOKIE[substr(md5($sitename),0,5).'xuUser'], 'dec'));
			
			$username = $split[0];
			$password = $split[1];
			
			$password = $kernel->crypt->process($password,'decrypt');
	
			//echo 'Cookie Login!<br />';
			user_login($username, $password);
		}
	}
	
	if($_SESSION['loggedin'])
	{
		if($_COOKIE[substr(md5($sitename),0,5).'xuUser'] != '')
		{
			$split = explode('|-|',processUserCookie($_COOKIE[substr(md5($sitename),0,5).'xuUser'], 'dec'));
			$username = $split[0];
		}
		if($username != '')
		{
			$check = false;
			if($username == $_SESSION['username'])
			{
				$check = true;
			}
		}
		else
		{
			$kernel->users->pre('','',$sess_time);
			$check = $kernel->users->check_sess();
		}
		
		if(!$check)
		{
			$url = urlencode('index.php?'.$_SERVER['QUERY_STRING']);
			header("Location: ".makeXuLink('index.php','p=login&return='.$url));
			exit();
		}
		
		$_SESSION['time'] = time();
		
		if($_SESSION['file_name']=='')
		{
			$_SESSION['file_name'] = $lang['functions']['8'];
		}
		
		if($_SESSION['file_size']=='')
		{
			$_SESSION['file_size'] = '0';
		}
		
		//----------------------------
		// COOOOOOOOOOOOKIE!!!!!!!!!!! (Cookie Monster, 1996)
		//----------------------------
		if($_COOKIE[substr(md5($sitename),0,5).'xuUser'] == '')
		{ 
			$secure = $_SERVER['SERVER_PORT'] == '443' ? 1 : 0; // secure(1) = using SSL
			$domain = explode('/', $siteurl);
			$domain = $domain[2];
			setcookie(substr(md5($sitename),0,5).'xuUser', processUserCookie($_SESSION['username'].'|-|'.$_SESSION['password'], 'enc'), (int)(time() + (3600 * 24 * 365)),'/','',$secure);
			//echo 'Cookie Set!<br />';
		}
	}
}

$kernel->tpl->assign('myuid', $_SESSION['myuid']);
?>