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
if($can_create_folders)
{
	if( isset($_POST['step']) && $_POST['step'] == 2)
	{	
		$fid = $kernel->password->gen_folder();
		$sql = "INSERT INTO folder SET fid='".$fid."', name='".txt_clean($_POST['fname'])."', `admin_password` = '".md5($_POST['admin_password'])."', user='".intval($_SESSION['myuid'])."', password='".txt_clean($_POST['password'])."'  ";
		$res = $db->query($sql);
		add_files_to_folder($fid,$_POST['files']);
        log_action('Folder(ID: '.$fid.') Created', 'folder:create', 'The folder('.$_POST['fname'].',id = '.$fid.') was created', 'ok', 'addfolder.php');
		$kernel->tpl->assign('fid', $fid);
	}
}


$kernel->tpl->assign('folderPass', txt_clean($_POST['password']));
$kernel->tpl->assign('adminPass', $_POST['admin_password']);
$kernel->tpl->assign('folderName', $_POST['fname']);
$kernel->tpl->display('addfolder.tpl');
?>