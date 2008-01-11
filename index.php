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
// Nag, Nag, Nag!
//----------------------------
if(is_dir('./setup/') and $_SERVER['HTTP_HOST'] != 'localhost')
{
	header("Location: ./setup/");
	die();
}
if(!isset($_GET['p']))
	$_GET['p'] = 'home';

//----------------------------
// Include the master file...
//----------------------------
include("./include/init.php");
//$timer->setMarker('Functions.inc.php');

//----------------------------
// Auto Redirect system to prevent errors
//----------------------------
$host = explode('/',$siteurl);
if($_SERVER['HTTP_HOST'] != $host[2])
{
	$script = explode('/',$_SERVER['SCRIPT_NAME']);
	$script = $script[(count($script) - 1)];
	header("Location: ".$siteurl.$script."?".$_SERVER['QUERY_STRING']);
	die();
}

// If we are in forced dev mode and the user has requested a forced prune, prune away!
if(isset($_GET['forcePrune']) && XU_DEBUG)
{
	include('./prune.php');
	@touch('./prune.php');
}

//----------------------------
// load header
//----------------------------
if(($_GET['p'] != 'download') and ($_GET['p'] != 'upload'))
{
	$kernel->tpl->display('site_header.tpl');
}


//----------------------------
// include the file where the pages are stored
//----------------------------
include('./page.php');

//----------------------------
// Load footer
//----------------------------
if(($_GET['p'] != 'download') and ($_GET['p'] != 'upload'))
{
	$kernel->tpl->display('site_footer.tpl');	
}

//----------------------------
// run sql debug
//----------------------------
if(XU_DEBUG)
{
	if(!isset($allow_debug_out))
	{
		$allow_debug_out = true/*false/**/;
	}
	
	if(true)
	{
		if(isset($_GET['debug']))
		{
			echo '
	
			<table width="950" cellspacing="0" cellpadding="5" bgcolor="#00FF99" align="center" border="0">
				<tr>
					<td>
						<font size=5 style="font-family: Arial, Helvetica, sans-serif">
							&lt;&lt; XtraUpload SQL Debug &gt;&gt; <hr />
							URL: http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'].' ('.basename(__FILE__).')<hr />					
						</font>				
					</td>
				</tr>
				<tr>
					<td>
						<font size=5  style="font-family: Arial, Helvetica, sans-serif">
							# of Queries: '.($db->querycount - 1).'					
						</font><hr />
					</td>
				</tr>
				'.$db->debug_html.' 
			</table>
			';
		}
	}
}
?>