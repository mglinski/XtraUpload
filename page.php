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

$p = 'home';
if(isset($_GET['p']))
{
	$p = $_GET['p'];
}
if($site_offline)
{
	echo $offline_message;
}
else
{
	switch($p) 
	{ 
		default: include('./include/pages/home.php');		
		break; 
		
		case "home": include('./include/pages/home.php');
		break; 
		
		case 'download': include('./include/pages/download.php');
		break;
		
		case 'errordl': include('./include/pages/errordl.php');
		break;
		
		case 'fileUpload': include('./include/pages/file_upload.php');
		break;
		
		case "upload": include('./include/pages/upload.php');
		break; 
		
		case "url": include('./include/pages/url.php');
		break;
		
		case 'get': include('./include/pages/get.php');
		break;
		
		case 'view': include('./include/pages/view.php');
		break;
		
		case "fastpass": include('./include/pages/fastpass.php');
		break; 
		
		case "files": include('./include/pages/files.php');
		break;  
		
		case "login": include('./include/pages/login.php');
		break;
		
		case "usercp": include('./include/pages/usercp.php');
		break; 
		
		case "report": include('./include/pages/report.php');
		break; 
		
		case "logout": include('./include/pages/logout.php');
		break; 
		
		case "signup": include('./include/pages/join.php');
		break; 
		
		case "news": include('./include/pages/news.php');
		break;
		
		case "rss": include('./include/pages/rss.php');
		break; 
		
		case "faq": include('./faq.php');
		break;
		
		case "dfaq": include('./include/pages/dfaq.php');
		break; 
		
		case "advertising": include('./include/pages/advertising.php');
		break; 
		
		case "tos": include('./include/pages/rules.php');
		break; 
		
		case "contact": include('./include/pages/contactus.php');
		break; 
		
		case "forgotpass": include('./include/pages/forgotpassword.php');
		break; 
		
		case "abuse": include('./include/pages/report.php');
		break; 
		
		case "delacc": include('./include/pages/delacc.php');
		break;

		case "join": include('./include/pages/join.php');
		break; 
		
		case "support": include('./include/pages/support.php');
		break; 
		
		case "contactus": include('./include/pages/contactus.php');
		break; 
		
		case "file": include('./include/pages/files.php');
		break; 
		
		case "rules": include('./include/pages/rules.php');
		break; 
		
		case 'rate': include('./include/pages/rate.php');
		break;
		
		case 'addfolder': include('./include/pages/addfolder.php');
		break;
		
		case 'folders': include('./include/pages/folder.php');
		break;
		
		case 'ipn': include('./include/pages/ipn.php');
		break;
		
		case 'points': include('./include/pages/points.php');
		break;
		
		case 'delfile': include('./include/pages/delfile.php');
		break;
		
		case 'click': include('./include/pages/click.php');
		break;
		
		case 'fileError': include('./include/pages/error.php');
		break;
		
		case 'errordl': include('./include/pages/errordl.php');
		break;
		
		case 'comments': include('./include/pages/comments.php');
		break;
		
		case 'linkchecker': include('./include/pages/linkchecker.php');
		break;
		
		case 'file_upload': include('./include/pages/file_upload.php');
		break;
		
		case 'userFolders': include('./include/pages/userFolders.php');
		break;
		
		case 'uploadError': include('./include/pages/uploadError.php');
		break;
	
	}
}?>