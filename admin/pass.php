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
include("./init.php");

if(isset($_POST['s2']))
{
	
	$sq = $db->query("SELECT * FROM groups WHERE id = '".txt_clean($_POST['group'])."'");
	$f = $db->fetch($sq,'obj');
	$sec = $f->days*24*60*60;
	if(!empty($_POST['NewPass1']))
	{
		$q1 = "INSERT INTO `users` ( `username` , `password`, `group`, `email`, `time`  ) VALUES 
		('".txt_clean($_POST['NewAdmin'])."', '".md5($_POST['NewPass1'])."', '".txt_clean($_POST['group'])."', '".txt_clean($_POST['email'])."' , '".(int)(time()+$sec)."' )";
		log_action('New User('.$_POST['NewAdmin'].') Added', 'user:new', 'New User('.$_POST['NewAdmin'].') Added', 'ok', 'admin/user.php');
		$db->query($q1);
	}
	echo "<br><center>New Admin <b>$_POST[NewAdmin]</b> was added.</center>";
}

?>
<script>
	function CheckInfo() {

		if(document.f1.NewAdmin.value == "")
		{
			alert('Enter your Admin username!');
			document.f1.NewAdmin.focus();
			return false;
		}

		if(document.f1.NewPass1.value != "")
		{
			if(document.f1.NewPass1.value != document.f1.NewPass2.value)
			{
				alert('Retype and confirm your new password again!');
				document.f1.NewPass1.value = "";
				document.f1.NewPass2.value = "";
				document.f1.NewPass1.focus();
				return false;
			}

		}

	}
</script>

<h1><span>User Manager - Add User</span>XtraFile :: Admin Panel</h1>
<br />
<form method=post onsubmit="return CheckInfo();" name='f1'>
  <div align="center">
    <table width=323 align=center>
      <tr>
        <td width="160"><div align="right">Username:</div></td>
        <td width="151"><input type='text' name='NewAdmin'>
        </td>
      </tr>
      <tr>
        <td><div align="right">Password:</div></td>
        <td><input type='password' name='NewPass1'></td>
      </tr>
      <tr>
        <td><div align="right">Email Address:</div></td>
        <td><input type='text' name='email'></td>
      </tr>
      <tr>
        <td><div align="right">User Group:</div></td>
        <td><select name="group">
            <?
		$qr1 = $db->query("SELECT * FROM groups WHERE id != '1'");
		while($a = $db->fetch($qr1,'obj'))
		{
		?>
            <option value="<?=$a->id?>">
            <?=$a->name?>
            </option>
            <? }?>
          </select></td>
      </tr>
      <tr>
        <td colspan=2 align=center><input type=submit name=s2 value=" Add User " class="sub1">
        </td>
      </tr>
    </table>
  </div>
</form>
<?
	include("admin/footer.php");
?>
