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
chdir('..');
include("./include/functions.inc.php");


$value = txt_clean($_POST['ntg']);
$key = txt_clean($_POST['wsl']);
$table = $kernel->crypt->process(txt_clean($_POST['xtr']),'decrypt',NULL,$key);
$column = $kernel->crypt->process(txt_clean($_POST['dce']),'decrypt',NULL,$key);
$id = $kernel->crypt->process(txt_clean($_POST['jit']),'decrypt',NULL,$key);

$db->query("UPDATE `".$table."` SET `".$column."` = '".$value."' WHERE `id` = '".$id."' LIMIT 1");

echo $value;
?>