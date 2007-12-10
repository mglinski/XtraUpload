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
################
@session_start();
################
$dbServer = "localhost"; // mysql host
$dbUser = "root"; // mysql username
$dbPass = ""; //mysql password
$dbName = "xu"; //mysql database
$trans = "EN"; // Currently: EN = English, DE = Deutsch/German, SP = Spanish, KR = Korean, CH = Chinese, More to come soon!
$language = "english.php"; // The File That Contains all the Text for XtraUpload. Located in the include/languages folder.
$serverurl = "http://localhost/xu"; // URL to compare to for Progress bar
?>