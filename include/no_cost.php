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
if($_POST['valid'])
{
	$sql1 = "SELECT * FROM users WHERE email = '".txt_clean($_POST['email'])."' ";
	$sql2 = "SELECT * FROM users WHERE username = '".txt_clean($_POST['username'])."' ";
	$qr1 = $db->query($sql1);
	$qr2 = $db->query($sql2);
	$res1 = $db->num($qr1);
	$res2 = $db->num($qr2);
	$good = true;
	
	// Begin XU-safe text template system
	
	if($res1 != '0')
	{	
		$good = false;	
		$err = true;
		$msg = '<h4>'.$lang['no_cost']['1'].'</h4><br />';
	}
	
	if(isValidEmail($_POST['email']))
	{	
		$good = false;	
		$err = true;
		$msg = '<h4>'.$lang['no_cost']['16'].'</h4><br />';
	}
	
	if($res2 != '0')
	{
		$good = false;
		$err = true;
		$msg = '<h4>'.$lang['no_cost']['2'].'</h4><br />';
	}
	
	if($_POST['password1'] != $_POST['password2'])
	{
		$good = false;
		$err = true;
		$msg = '<h4>'.$lang['no_cost']['3'].'</h4><br />';
	}
	
	$ret = $db->fetch($db->query("SELECT * FROM groups WHERE id='".intval($_POST['group'])."'"),'obj');
	if($ret->userlimit != '0' &&($ret->users++ > $ret->userlimit))
	{
		$good = false;
		$err = true;
		$msg = '<h4>'.$lang['no_cost']['4'].'</h4><br />';
	}
}

if($good)
{
	$group = $db->fetch($db->query("SELECT * FROM groups WHERE id='".intval($_POST['group'])."'"),'obj');
	$sec = $group->expire * 24 * 3600;

	$db->query("INSERT INTO users (`group`,`username`,`password`,`email`,`time`) VALUES('".intval($_POST['group'])."', '".txt_clean($_POST['username'])."', '".md5($_POST['password1'])."', '".txt_clean($_POST['email'])."','".$sec."')");
	
	$db->query("UPDATE groups SET users = users+1 WHERE id='".intval($_POST['group'])."'");
	
	mail(txt_clean($_POST['username']).' <'.txt_clean($_POST['email']).'>', $sitename.' Account Activated', $lang['paypal']['1'].$sitename.$lang['paypal']['2'].''."\n".'################### '."\n".''.$lang['paypal']['3'].txt_clean($_POST['username']).$lang['paypal']['4'].$_POST['password1'].' '."\n".'###################'."\n".''."\n".''.$lang['paypal']['5'].$sitename.$lang['paypal']['6']);

	mail($adminemail, $sitename.' Account Activated (Admin Copy)', $lang['paypal']['1'].$sitename.$lang['paypal']['2'].''."\n".'################### '.$lang['paypal']['3'].txt_clean($_POST['username']).$lang['paypal']['4'].$_POST['password'].''."\n".'###################'."\n".''."\n".''.$lang['paypal']['5'].$sitename.$lang['paypal']['6']);
	
	$u = $group->users + 1;
	$ul = $group->userlimit;
	
	if($u >= $ul && $ul != 0)
	{
		$db->query("UPDATE groups SET visible = '0' WHERE id='".intval($_POST['group'])."'");
	}
echo $lang['no_cost']['5'];
?>
<p></p>
<script>
function r()
{
	location = "<?=makeXuLink('index.php','p=login')?>";
}
setTimeout('r()',2000);
</script>
  <?
}
else
{
?>
  <script>
function check()
{
	if(document.getElementById('password1').value == '')
	{
		alert('<?=$lang['no_cost']['6']?>');
		return false;
	}
	if(document.getElementById("password1").value != d.getElementById("password2").value )
	{
		alert('<?=$lang['no_cost']['7']?>');
		return false;
	}
	if(document.getElementById('username').value.length < 6 )
	{
		alert('<?=$lang['no_cost']['8']?>');
		return false;
	}
	if(document.getElementById('email').value.length < 7)
	{
		alert('<?=$lang['no_cost']['9']?>');
		return false;
	}
	return true;
}
  </script>
</p>
<div align="center">
<h1><?=$lang['no_cost']['10']?></h1>
<?=$msg?>
<br />
</div>
<form id="form1" name="register" method="post" onsubmit="return check();" >
<table width="350" height="1%" border="0" align="center" cellpadding="4" cellspacing="0">
  <tr>
    <td><div align="right"><?=$lang['no_cost']['11']?>:&nbsp</div></td>
    <td height="30"> <input name="username" type="text" size="30" id="username" value="<?=$_POST['username']?>" /></td>
  </tr>
  <tr>
    <td><div align="right"><?=$lang['no_cost']['12']?>:&nbsp</div></td>
    <td height="30"> <input name="password1" size="30" type="password" id="password1" value="" /></td>
  </tr>
  <tr>
    <td><div align="right"><?=$lang['no_cost']['13']?>:&nbsp</div></td>
    <td height="30"> <input name="password2" size="30" type="password" id="password2" value="" /></td>
  </tr>
  <tr>
    <td width="50%"><div align="right"><?=$lang['no_cost']['14']?>:&nbsp</div></td>
    <td width="50%" height="30"> <input name="email" size="30" type="text" id="email" value="<?=$_POST['email']?>" /></td>
  </tr>
</table>
<div align="center"><br />
</div>
<div align="center">
<input type="hidden" name="valid" value="true" />
<input type="hidden" name="step" value="1" />
<input type="hidden" name="group" value="<?=intval($_POST['group'])?>" />
<input type="submit" name="submit" value="<?=$lang['no_cost']['15']?>" />
</div>
</form>
<? }?>