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
$res = $db->fetch($db->query("SELECT * FROM groups WHERE id = '".intval($_POST['group'])."'"),'obj');
if(!(floatval($res->price) > 0.000))
{
	include('./include/no_cost.php');
}
else
{
?>
<form method="post">
<input type="hidden" name="step" value="2" />
  <div align="center"><?='<span style="color: red">'.$msg.'</span>'?><br />
    <table width="361">
      <tr>
        <td width="154" height="24" align=right><div align="right"><?=$lang['step1']['1']?></div></td>
        <td width="195"><input name='username' type='text' value="<?=txt_clean($_POST['username'])?>" size='25' maxlength='25'></td>
      </tr>
      <tr>
        <td height="24" align=right>Password</td>
        <td><input name='pass' type='password' id="pass" size='25' /></td>
      </tr>
      <tr>
        <td height="24" align=right>Email</td>
        <td><input name='email' type='text' id="email" value="<?=txt_clean($_POST['email'])?>" size='25' /></td>
      </tr>
      <tr>
        <td align=right><?=$lang['step1']['2']?><br /></td>
	    <td>
<? 
$b = $db->query("SELECT * FROM payment WHERE status = '1'");
while($a = $db->fetch($b,'obj'))
{
	?>
	<input name="gate" type="radio" <? if($a->id == '2'){echo "checked='checked'";}?> id="pay_<?=$a->id?>" value="<?=$a->id?>" /><label for="pay_<?=$a->id?>"> <?=$a->f_name?></label><br />
	<?
}
?>	  </td>
    </tr>
  </table>
  	<input type="hidden" name="group" value="<?=$_POST['group']?>" />
    <input type=submit name="submit" value='<?=$lang['step1']['3']?>'>
  </div>
</form>
<? 
}
?>