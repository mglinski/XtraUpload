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

if( !check_file_bool( txt_clean($_GET['file']) ) )
{
	$kernel->tpl->assign('fileExists', false);
}
else if(isset($_POST['del']) && $_POST['del'] == 'yes')
{
	$kernel->tpl->assign('fileExists', true);
	$kernel->tpl->assign('msg', delfile_user(txt_clean($_GET['del'])));
}
else
{
	$kernel->tpl->assign('fileExists', true);
	$qr = $db->query("SELECT * FROM `files` WHERE `pkey` = '".txt_clean($_GET['del'])."' AND `hash` = '".txt_clean($_GET['file'])."' LIMIT 1");
	$file = $db->fetch($qr, 'alpha');
	$kernel->tpl->assign('file', $file);
}

$kernel->tpl->display('delfile.tpl');
?>