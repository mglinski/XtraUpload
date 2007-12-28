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
include("./include/init.php");

$rating = intval($_POST['rating']);
$hash = txt_clean($_POST['hash']);

$sql = "SELECT * FROM files WHERE hash='".$hash."'";
$qr1 = $db->query($sql,"1");
$num = $db->num($qr1);
if($num == '0')
{
	die;
}
$a = $db->fetch($qr1, "obj");
	
$update_rating = $a->rating_average;
$num_rating = $a->rating_num;
unset($update_rating);
$num_rating = $a->rating_num;
$num_rating++;
$old_rating = $a->rating_average;
$update_rating = ($old_rating + $rating);
$sql_5 = "UPDATE files SET `rating_average` = '$update_rating', `rating_num` = '$num_rating'  WHERE `hash` ='".$hash."'";
$qr5 = $db->query($sql_5,"5");
$rating_new = $update_rating/$num_rating;

echo "File Rating: ".round($rating_new,2);
?>