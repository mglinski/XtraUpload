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
if($_REQUEST['link'] != '')
{
	$link = $_REQUEST['link'];
	$hash = explode('index.php?p=download&hash=',$link);
	if(count($hash) == 2)
	{
		$hash = txt_clean($hash[1]);
	}
	else
	{
		$hash = explode('/',$hash[0]);
		$count = count($hash);
		$count--;
		$hash = txt_clean($hash[$count]);
	}
	$hash = urldecode($hash);
	$db->query("UPDATE `files` SET `report` = '1' WHERE `hash` = '".$hash."'");
	log_action('File(HASH: '.txt_clean($link).') Reported', 'file:report', 'The file(HASH: '.txt_clean($link).') was Reported by "'.$_SERVER['REMOTE_ADDR'].'"', 'ok', 'report.php');
	//mail($adminemail,'File Reported','Dear Admin,\nWe have just recived a report that a file is violating the TOS of your site. \nThe file link is: ("'.txt_clean($link).'")\n Please look in to this.\n\nThanks,XtraUpload','From: '.$adminemail);
	echo "<h2>".$lang['report']['1']."</h2>";
}
else
{
?>
<h1 align="center"><?=$lang['report']['2']?></h1>
<p><?=$lang['report']['3'] ?></p>
<form id="form1" name="form1" method="post" action="<?=makeXuLink('index.php', 'p=report')?>">
  <table width="635" border="0" cellspacing="0" cellpadding="3">
    <tr>
      <td width="213"><div align="right"><?=$lang['report']['4']?></div></td>
      <td width="410"><input name="link" type="text" size="60" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="submit" value="<?=$lang['report']['5']?>" /></td>
    </tr>
  </table>
</form><? }?>