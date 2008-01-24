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
// Back to the Root, Part IV!
chdir('..');

// Has XU already made itself home?
if(file_exists("./config.php"))
{
	include("./config.php");
	if($dbServer != '')
	{
		$upgrade = true;
	}
	else
	{
		$upgrade = false;
	}
}
else
{
	$upgrade = false;
}

if(isset($_GET['forceInstall']) or $_SESSION['forceInstall'])
{
	if(session_id() == "")
	{
		session_start();
	}
	
	if(!$_SESSION['forceInstall'])
	{
		$_SESSION['forceInstall'] = true;
		session_register('forceInstall');
	}
	include('./setup/install.php');	
}
else if($upgrade)
{
	$upgradeRunning = true;
	// Yes, lets upgrade to the new version
	include("./include/init.php");

	// run that upgrade
	include('./setup/upgrade.php');
}
else
{
	// i guess not, lets move in!
	include('./setup/install.php');	
}

function xuSetupHeader()
{
?>

<html>
		          <head><title>XtraUpload Installer</title>
		          <style type='text/css'>
		          	
		          	BODY		          	
		          	{
		          		font-size: 11px;
		          		font-family: Verdana, Arial;
		          		color: #000;
		          		margin: 0px;
		          		padding: 0px;
		          		background-image: url(images/background.png);
		          		background-repeat: no-repeat;
		          		background-position: right bottom;
		          	}
		          	
		          	TABLE, TR, TD     { font-family:Verdana, Arial;font-size: 11px; color:#000 }
					
					a:link, a:visited, a:active  { color:#000055 }
					a:hover                      { color:#333377;text-decoration:underline }
					
					.centerbox { margin-right:10%;margin-left:10%;text-align:left }
					
					.warnbox {
							   border:1px solid #F00;
							   background: #FFE0E0;
							   padding:6px;
							   margin-right:10%;margin-left:10%;text-align:left;
							 }
					
					.tablepad    { background-color:#F5F9FD;padding:6px }
				    .description { color:gray;font-size:10px }
					.pformstrip { background-color: #D1DCEB; color:#3A4F6C;font-weight:bold;padding:7px;margin-top:1px;text-align:left }
					.pformleftw { background-color: #F5F9FD; padding:6px; margin-top:1px;width:50%; border-top:1px solid #C2CFDF; border-right:1px solid #C2CFDF; }
					.pformright { background-color: #F5F9FD; padding:6px; margin-top:1px;border-top:1px solid #C2CFDF; }

					.tableborder { border:1px solid #345487;background-color:#FFF; padding:0px; margin:0px; width:100% }

					.maintitle { text-align:left;vertical-align:middle;font-weight:bold; color:#FFF; letter-spacing:1px; padding:8px 0px 8px 5px; background-image: url("images/back1.png") }
					.maintitle a:link, .maintitle  a:visited, .maintitle  a:active { text-decoration: none; color: #FFF }
					.maintitle a:hover { text-decoration: underline }
					
					#copy { font-size:10px }
										
					#button   { background-color: #4C77B6; color: #FFFFFF; font-family:Verdana, Arial; font-size:11px }
					
					#textinput { background-color: #EEEEEE; color:Ê#000000; font-family:Verdana, Arial; font-size:11px; width:100% }
					
					#dropdown { background-color: #EEEEEE; color:Ê#000000; font-family:Verdana, Arial; font-size:10px }
					
					#multitext { background-color: #EEEEEE; color:Ê#000000; font-family:Courier, Verdana, Arial; font-size:10px }
					
					#logostrip {
	padding: 0px;
	margin: 0px;
	background-color: #8f9d71;
							   }
							   
					.fade					
					{
						background-image: url(images/fade.jpg);
						background-repeat: repeat-x;
					}
					
				  </style>
                  <script src="../js/xu.js"></script>
				  </head>
				 <body marginheight='0' marginwidth='0' leftmargin='0' topmargin='0' bgcolor='#FFFFFF'>
				 
				 <div id='logostrip'><img src='images/logo.png' alt='XtraUpload Installer' width="450" height="70" border='0' /></div>
				 <div class='fade'>&nbsp;</div>
				 <br />
<?
}

function xuSetupFooter()
{
?>				 <br><br><br><br><center>
				   <span id='copy'><a href='http://www.xtrafile.com'>Xtrafile.com</a> &copy; 2006 </span>
				 </center>
				 
				 </body>
				 </html><?
}

?>