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

//---------------------------
// Begin Setting Up XU Enviroment
//---------------------------
	
	// Include database access information
	include('./config.php');
	
	// Try to disable a bug in php5 that makes no sence to me
	@ini_set('session.bug_compat_warn','off');
	
	// Define Hard Coded Script Version
	$versionDefault = '1.6.0,0.2.0.0'; // 1.6 Beta 2
	
	// Define PEAR folder For PEAR Includes
	define("PEAR_DIR", "include/kernel/pear/");

//----------------------------
// Define These Values As Constant
//----------------------------
	$defArr = array(
		
		//Allow the output of Sql Debug information
		'XU_DEBUG' => false,
		
		// Allow anyone into the admin panel, ONLY USE IN NON PRODUCTION SERVERS!
		'XU_NO_ADMIN_AUTH' => false
	);

	// Now Define() them into existance
	foreach($defArr as $def => $val)
	{
		if(!defined($def)) define($def,$val);
	}
	$defArr = NULL;

//----------------------------
// Include new XtraFile.com kernel for advanced functionality
//----------------------------

	// XU Kernel (v1.6)
	require_once('./include/kernel/kernel.php');
	
	// System Wide Functions
	require_once('./include/functions.inc.php');
	
	// Required Code to Setup Base System
	require_once('./include/functions.php');
	
	// Include functions that Can be edited
	require_once('./include/open.functions.inc.php');
?>