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
require_once("./captcha.php");
$tmp_folder = $siteurl.'temp/';

$CAPTCHA_INIT = 
array(
	'tempfolder'     => './temp/',      // string: absolute path (with trailing slash!) to a writeable tempfolder which is also accessible via HTTP!
	'tempfolder_1'   => $tmp_folder,      // string: absolute path (with trailing slash!) to a writeable tempfolder which is also accessible via HTTP!
	'TTF_folder'     => './fonts/', // string: absolute path (with trailing slash!) to folder which contains your TrueType-Fontfiles.
	'TTF_RANGE'      => array('gothikka.ttf'),
	'chars'          => 3,       // integer: number of chars to use for ID
	'minsize'        => 16,      // integer: minimal size of chars
	'maxsize'        => 18,      // integer: maximal size of chars
	'maxrotation'    => 25,      // integer: define the maximal angle for char-rotation, good results are between 0 and 30
	'noise'          => false,    // boolean: TRUE = noisy chars | FALSE = grid	
	'websafecolors'  => true,   // boolean
	'refreshlink'    => false,    // boolean
	'lang'           => 'en',    // string:  ['en'|'de']
	'inline' 		 =>	true,
	'maxtry'         => 10,       // integer: [1-9]
	'secretstring'   => "sdfsOIUVYCTXdyf7gu*H(OJnbiuVYCTDXrsz4as5d6&^&*6&*6876897^&4^&)*8h9OnibuvycT", // totally random string
	'secretposition' => 17,      // integer: [1-32]
	'debug'          => false
);
$captcha = null;
$captcha = new hn_captcha($CAPTCHA_INIT);

if(isset($_POST['email']))
{
	switch($captcha->validate_submit())
	{
		case 1:
		// PUT IN ALL YOUR STUFF HERE // - START
			$valid = true;

			if (isset($_POST['email']))
			{
				$_POST['email'] = $kernel->cleaning->clean('txt', $_POST['email']);
				
				$resultID = $kernel->db->query("SELECT username FROM users WHERE email = '{$_POST['email']}'");
				
				$row =  $kernel->db->fetch($resultID);
				$username = $row->username;
		
				if ($username == "") 
				{
					print $lang['forgotpass']['1']."<br /><br />";
					show_reset_email();
				}
				else 
				{
					$password = $kernel->password->gen();
					$mpassword = md5($password);
			
					$resultID = $kernel->db->query("UPDATE `users` SET `password` = '$mpassword' WHERE `email` = '{$_POST['email']}'");
					
					$mes = $lang['forgotpass']['2']."$username,\n".v."$sitename($siteurl) to the following:\n--------------------------------------------\n".$lang['forgotpass']['4'].": $username\n".$lang['forgotpass']['5'] .": $password\n--------------------------------------------\n".$lang['forgotpass']['6']."\n".$lang['forgotpass']['7'].".\n\n".$lang['forgotpass']['8']."\n-$sitename ".$lang['forgotpass']['9'];
					$sender = $sitename.' <'.$adminemail.'>';
					$subject = $sitename.' - '.$lang['forgotpass']['11'];
					$send_to = $_POST['email'];
					$kernel->mail->send_email($sender, $subject, $mes, $send_to);			
					log_action('Password sent to email', 'user:passRequest', 'The user('.$username.') forgot his/her password and requested that they be sent a new one.', 'ok', 'forgotpassword.php');
					
				}
			}		
		// PUT IN ALL YOUR STUFF HERE // - END
		continue;
	}
}

if(!$valid)
{
	$kernel->tpl->assign('captcha', $captcha->display_form());
}
$kernel->tpl->assign('valid', $valid);
$kernel->tpl->display('forgotpassword.tpl');
?> 