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
?><style type="text/css">
<!--
.style1 {font-size: 24px}
-->
</style>
<div align="center"><span class="style1"><?=$lang['step3']['1']?></span><br />
</div>
<?
$a = $db->fetch($db->query("SELECT * FROM payment WHERE id = '".intval($_POST['gate'])."'"),'obj');

if($a->id == '1')
{
	include("./include/payment/authnet.php");
}
else if($a->id == '2')
{
	include("./include/payment/paypal.php");
}
else if($a->id == '3')
{
	include("./include/payment/2co.php");
}
else if($a->id == '4')
{
	include("./include/payment/check.php");
}


$pay = new gate($_POST['username']);
echo $pay->callback($_POST['id']);
?>