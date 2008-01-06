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
$msg = '';
if( (isset($_POST['username'])) && (isset($_POST['password'])) )
{
	$username = txt_clean($_POST['username']);
	$password = md5($_POST['password']);

	if(!user_login($username,$password))
	{
		$msg = $lang['login']['6'];
		$failed = true;
	}
	
	$kernel->tpl->assign('failed', $failed);
	if(!$failed)
	{
		log_action('Login Succeded:('.$username.')', 'login:pass', 'Login with user:('.$username.') passed', 'ok', 'login.php');
		$kernel->tpl->assign('parts', explode('?',urldecode($_POST['return'])));
		if (isset($_POST['return']) && $_POST['return'] != '')
		{
			$parts = explode('?',urldecode($_POST['return']));
			$kernel->tpl->assign('redirect', makeXuLink($parts[0], $parts[1]));
		}
		else
		{
			$kernel->tpl->assign('redirect', makeXuLink('index.php', 'p=home'));
		}
		
		$kernel->tpl->display('login.tpl');
		$kernel->tpl->display('site_footer.tpl');
		die;
	}
	else
	{
		log_action('Login Failed:('.$username.') ', 'login:fail', 'Login with user:('.$username.') and pass:('.$password.') failed', 'fail', 'login.php');
	}
}

if(isset($_GET['return']))
{
	$msg = $lang['login']['7'];
}

if($msg != '')
{
	$kernel->tpl->assign('msg', $msg);
}
$kernel->tpl->assign('forgot', makeXuLink('index.php', 'p=forgotpass'));
$kernel->tpl->assign('fastpass', makeXuLink('index.php', 'p=fastpass'));
$kernel->tpl->display('login.tpl')
?>