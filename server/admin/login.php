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

chdir("..");
include("include/init.php");
include("admin/header.php");
?>
<h1><span>Login</span>XtraFile :: Admin Panel</h1>
<?
$msg = 'No Administration Session Found';
if( (isset($_POST['username'])) && (isset($_POST['password'])) )
{

	$username = txt_clean($_POST['username']);
	$password = txt_clean($_POST['password']);
	
	if(!$site_offline)
	{
		if(!admin_login($username,$password))
		{
			$msg = $lang['login']['6'];
			$failed = true;
		}
	}
	else
	{
		if(!adminSiteClosedLogin($username,$password))
		{
			$msg = $lang['login']['6'];
			$failed = true;
		}
	}
	
	if(!$failed)
	{
		log_action('Admin Login Succeded:('.$username.')', 'admin:login:pass', 'Admin Login with user:('.$username.') passed', 'ok', 'admin/login.php');
		if(isset($_GET['redirect']) && $_GET['redirect'] != '')
		{
			echo '<center><h3>'.$lang['login']['8'].'</h3><h4>'.$lang['login']['9'].'</h4><script type="text/javascript"> function r(){window.location = "'.urldecode($_GET['redirect']).'";}setTimeout(\'r()\',1500);</script></center>';
			$passed = 1;
		}
		else
		{
			echo '<center><h3>'.$lang['login']['8'].'</h3><h4>'.$lang['login']['9'].'</h4><script type="text/javascript"> function r(){window.location = "./index.php";}setTimeout(\'r()\',1500);</script></center>';
			$passed = 1;
		}
	}
	else
	{
		log_action('Admin Login Failed:('.$username.') ', 'admin:login:fail', 'Admin Login with user:('.$username.') and pass:('.$password.') failed', 'fail', 'admin/login.php');
	}
	
}

if($passed != 1)
{
if(isset($_GET['redirect']))
{
	$msg = $lang['login']['7'];
}

?>
<p align="center"><br />
    <br />
    <font size="4"><strong>XtraUpload Administration Section</strong></font><br />
</p>
<p align="center"><font color="#FF0000"><?=$msg?></font>
<form method="POST" enctype="application/x-www-form-urlencoded">
<input type="hidden" name="redirect" value="<?=$_GET['return']?>" />  <div align="center"><font size="3" face="arial">
  </font>
    <br>
    <table width="418" border="0" cellspacing="5" cellpadding="0">
      <tr>
        <td width="273"><div align="right"><font size="3">Username</font></div></td>
        <td width="304"><input type='text' name=username size=30 tabindex="1" /></td>
      </tr>
      <tr>
        <td height="22"><div align="right"><font size="3">Password</font> </div></td>
        <td><input type=password name=password size=30 tabindex="2" /></td>
      </tr>
    </table>
    <font size="3" face="arial">    <br>
    <input type="submit" name="Submit" value="Login" />
    <br>
    <br>
    </font></div>
</form>
</p>
<?
}
include("admin/footer.php");
?>