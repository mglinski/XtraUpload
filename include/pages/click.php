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
$sql1 = "SELECT * FROM `ads`  WHERE `id` = '".intval($_GET['id'])."' ";
$qr3 = $db->query($sql1, "ads_1");	
$d = $db->fetch($qr3,"obj");

$new_value = $d->clicks + 1;

$sql_3 = "UPDATE `ads` SET `clicks` = '$new_value' WHERE `id` ='".$d->id."' ";
$qr3 = $db->query($sql_3);

$kernel->tpl->assign('link',$d->link);
$kernel->tpl->display('click.tpl');
?>