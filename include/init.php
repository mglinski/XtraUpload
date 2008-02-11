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
// EVIL!!! Kill it with fire!!
//----------------------------
if(get_magic_quotes_runtime())
	set_magic_quotes_runtime(false);
	
if (get_magic_quotes_gpc()) 
{
	foreach($_POST as $k => $v)
	{
		$_POST[$k] = stripslashes($v);
	}
	
	foreach($_GET as $k => $v)
	{
		$_GET[$k] = stripslashes($v);
	}
	
	foreach($_COOKIE as $k => $v)
	{
		$_COOKIE[$k] = stripslashes($v);
	}
}

//----------------------------
// Define These Values As Constant
//----------------------------
	$defArr = array(
		
		//Allow the output of Sql Debug information
		'XU_DEBUG' => TRUE,
		
		// Allow anyone into the admin panel, ONLY USE IN NON PRODUCTION SERVERS!
		'XU_NO_ADMIN_AUTH' => FALSE,
		
		// Do we check for the version of latest version of xtraupload or not.
		'XU_VERSION_CHECK' => true
	);

	// Now Define() them into existance
	foreach($defArr as $def => $val)
	{
		if(!defined($def)) define($def,$val);
	}
	$defArr = NULL;


//---------------------------
// Begin Setting Up XU Enviroment
//---------------------------
	
	// Include database access information
	include('./config.php');
	
	// Try to disable a bug in php5 that makes no sence to me
	@ini_set('session.bug_compat_warn','off');
	
	// Define Hard Coded Script Version
	$versionDefault = '1.6.0,0.3.0.0'; // 1.6 Beta 3
	
	// Define PEAR folder For PEAR Includes
	define("PEAR_DIR", "include/kernel/pear/");

//----------------------------
// Include new XtraFile.com kernel for advanced functionality
//----------------------------

	// XU Kernel (v1.6)
	require_once('./include/kernel/kernel.php');
	
	// Include Required Functions
	require_once('./include/functions.php');

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
	


#############################
## Site Config System Code ##
#############################
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
	
	$perm_level = '';
	if(isset($_SESSION['perm_level']))
	{
		$perm_level = $_SESSION['perm_level'];
	}
	else
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
	
	// add a trailing slash if not there
	if(substr($siteurl , -1) != '/')
	{
		$siteurl .= '/';
	}
	
	define('XU_VER_REAL', $version);
	
	##########################
	## Version System Code ##
	##########################
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
	
##########################
## MemCache System Code ##
##########################
// Memcache System
$kernel->db->use_memcache = $use_memcache;
$db->use_memcache = $use_memcache;

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


//----------------------------
// Grab Group Settings From Database
//----------------------------
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

##########################
## Language System Code ##
##########################

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
	else if($_SESSION['loggedin'])
	{
	//----------------------------
	// See if we are logged in and if so see if the user has a prefered language.
	//----------------------------
		$dbq = $db->query("SELECT `lang` FROM `users` WHERE `uid` = '".intval($_SESSION['myuid'])."'");
		$language2 = $db->fetch($dbq);
		if($language2->lang != '')
		{
			$language = $language1->file;
			$_SESSION['language'] = $language;
			session_register('language');
		}
		else
		{
			$language = $language1->file;
		}
	}
	else
	{
	//----------------------------
	// Damn free users, serve them the default language!
	//----------------------------
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
			
			// Set the new preferance in the users config( if logged in)
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



########################
## Points System Code ##
########################
//----------------------------
// and on the 8th day he created points for those who had them not...
//----------------------------
	if(!isset($_SESSION['points']))
	{
		$_SESSION['points'] = serialize(array());
		session_register('points');
	}


########################
## Cookie System Code ##
########################
//----------------------------
// COOKIE, COOKIE, COOKIE!!!
//----------------------------
	if(isset($_GET['cookieKill']) or (isset($_GET['p']) && $_GET['p'] == 'logout'))
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



#######################
## Login System Code ##
#######################
//----------------------------
// check users who are loggedin for timeouts...
//----------------------------
	if(!$_SESSION['loggedin'])
	{
		//----------------------------
		// Cookie is set! read it and try to log in
		//----------------------------
		if(isset($_COOKIE[substr(md5($sitename),0,5).'xuUser']))
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
		
		if(!isset($_SESSION['file_name']))
		{
			$_SESSION['file_name'] = $lang['functions']['8'];
			session_register('file_name');
		}
		
		if(!isset($_SESSION['file_size']))
		{
			$_SESSION['file_size'] = '0';
			session_register('file_size');
		}
		
		//----------------------------
		// I Can Has Coooookiez?
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
if(!isset($_SESSION['myuid']))
	$_SESSION['myuid'] = 0;
	
$kernel->tpl->assign('myuid', $_SESSION['myuid']);
	
?>