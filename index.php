<?php
/** * XtraUpload * * A turn-key open source web 2.0 PHP file uploading package requiring PHP v5 * * @package		XtraUpload * @author		Matthew Glinski * @copyright	Copyright (c) 2006, XtraFile.com * @license		http://xtrafile.com/docs/license * @link		http://xtrafile.com * @since		Version 2.0 * @filesource */// ------------------------------------------------------------------------/** * XtraUpload Front-Conroller * * @package		CodeIgniter * @author		Matthew Glinski - Codeigniter Dev Team */// ------------------------------------------------------------------------

// Make sure errors are reported!
ini_set('display_errors', '1');

// define PHP version ID for versions less then 5.2.7
if(!defined('PHP_VERSION_ID'))
{
    $version = PHP_VERSION;

    define('PHP_VERSION_ID', ($version{0} * 10000 + $version{2} * 100 + $version{4}));
}
if(PHP_VERSION_ID < 50207)
{
    define('PHP_MAJOR_VERSION',     $version{0});
    define('PHP_MINOR_VERSION',     $version{2});
    define('PHP_RELEASE_VERSION',     $version{4});
}

// if the user is running a PHP version less the 5.2.1, WE MUST DIE IN A FIRE!
if(PHP_VERSION_ID < 50201)
{
    echo "<h2>Fatal Error</h2><p>Your installed PHP version is less then 5.2.1. XtraUpload requires at least PHP v5.2.1+ to run correctly. The latest version is highly reccomended. XtraUpload will not run until this basic requirement is met, and has quit.</p><!-- You will see the same message in the installer. If you install without upgrading, you do so at your own risk. -->";
    exit;
}

// Check for setup/upgrade folders and stop running if found
$setup_exists = file_exists('./setup');
$upgrade_exists = file_exists('./upgrade');

// Send user to setup folder to configure script, if exists
if(($setup_exists or $upgrade_exists) and ($_SERVER['HTTP_HOST'] != 'localhost' and substr($_SERVER['HTTP_HOST'], 0, 7) != '192.168'))
{
	echo "<html><head><title>XtraUpload: Fatal Error</title></head><body><h2 style='color:#F00'>WARNING!!!</h2><h3 style='text-decoration:underline'>The <a href='setup/' target='_blank'>Setup</a> and/or <a href='upgrade/' target='_blank'>Upgrade</a> folders exist!</h3><p>This is a BIG security risk and as such XtraUpload will not continue loading until these folders are deleted from your server. If you have just uploaded XtraUpload or are upgrading from a previous version use the above links to either: <ul><li><a href='setup/' target='_blank'>Setup XtraUpload for the first time</a></li><li><a href='upgrade/' target='_blank'>Upgrade XtraUpload from a previous version.</a></li></ul>Once complete please delete the 2 folders and reload this page.</p></body></html>";
	exit();
}

##############################
## Begin CI controller code ##
##############################

/*
|---------------------------------------------------------------
| PHP ERROR REPORTING LEVEL
|---------------------------------------------------------------
|
| By default CI runs with error reporting set to ALL.  For security
| reasons you are encouraged to change this when your site goes live.
| For more info visit:  http://www.php.net/error_reporting
|
*/
	error_reporting(E_ALL);

/*
|---------------------------------------------------------------
| SYSTEM FOLDER NAME
|---------------------------------------------------------------
|
| This variable must contain the name of your "system" folder.
| Include the path if the folder is not in the same  directory
| as this file.
|
| NO TRAILING SLASH!
|
*/
	$system_folder = "system";

/*
|---------------------------------------------------------------
| APPLICATION FOLDER NAME
|---------------------------------------------------------------
|
| If you want this front controller to use a different "application"
| folder then the default one you can set its name here. The folder 
| can also be renamed or relocated anywhere on your server.
| For more info please see the user guide:
| http://codeigniter.com/user_guide/general/managing_apps.html
|
|
| NO TRAILING SLASH!
|
*/
	$application_folder = "application";

/*
|===============================================================
| END OF USER CONFIGURABLE SETTINGS
|===============================================================
*/


/*
|---------------------------------------------------------------
| SET THE SERVER PATH
|---------------------------------------------------------------
|
| Let's attempt to determine the full-server path to the "system"
| folder in order to reduce the possibility of path problems.
| Note: We only attempt this if the user hasn't specified a 
| full server path.
|
*/
if (strpos($system_folder, '/') === FALSE)
{
	if (function_exists('realpath') AND @realpath(dirname(__FILE__)) !== FALSE)
	{
		$system_folder = realpath(dirname(__FILE__)).'/'.$system_folder;
	}
}
else
{
	// Swap directory separators to Unix style for consistency
	$system_folder = str_replace("\\", "/", $system_folder); 
}

/*
|---------------------------------------------------------------
| DEFINE APPLICATION CONSTANTS
|---------------------------------------------------------------
|
| EXT		- The file extension.  Typically ".php"
| FCPATH	- The full server path to THIS file
| SELF		- The name of THIS file (typically "index.php)
| BASEPATH	- The full server path to the "system" folder
| APPPATH	- The full server path to the "application" folder
|
*/
define('EXT', '.'.pathinfo(__FILE__, PATHINFO_EXTENSION));
define('FCPATH', __FILE__);
define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));
define('BASEPATH', $system_folder.'/');

if (is_dir($application_folder))
{
	define('APPPATH', $application_folder.'/');
}
else
{
	if ($application_folder == '')
	{
		$application_folder = 'application';
	}

	define('APPPATH', BASEPATH.$application_folder.'/');
}

/*
|---------------------------------------------------------------
| LOAD THE FRONT CONTROLLER
|---------------------------------------------------------------
|
| And away we go...
|
*/
require_once BASEPATH.'codeigniter/CodeIgniter'.EXT;
?>