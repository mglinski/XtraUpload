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
	'chars'          => 4,       // integer: number of chars to use for ID
	'minsize'        => 18,      // integer: minimal size of chars
	'maxsize'        => 20,      // integer: maximal size of chars
	'maxrotation'    => 20,      // integer: define the maximal angle for char-rotation, good results are between 0 and 30
	'noise'          => false,    // boolean: TRUE = noisy chars | FALSE = grid	
	'websafecolors'  => true,   // boolean
	'refreshlink'    => false,    // boolean
	'lang'           => 'en',    // string:  ['en'|'de']
	'inline' 		 =>	true,
	'maxtry'         => 9,       // integer: [1-9]
	'secretstring'   => "sdfsdfdf3sdfsdfsdfsd0fsdsjfdlkjfrgse7rvsdgb adggb", // totally random string
	'secretposition' => 17,      // integer: [1-32]
	'debug'          => false
);
$captcha = null;
$captcha = new hn_captcha($CAPTCHA_INIT);
$msg = '';
if(isset($_POST['submit']))
{
	if(!eregi ("^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,6}$", stripslashes(trim($_POST['email']))))
	{
	  $msg .= $lang['contactus']['4'].'<br />';
	}
	if($_POST['subj'] == '')
	{
		$msg .= $lang['contactus']['5'].'<br />';
	}
	if($_POST['msg'] == '')
	{
		$msg .= $lang['contactus']['6'].'<br />';
	}
	
	switch($captcha->validate_submit())
	{
		case 1:
		// PUT IN ALL YOUR STUFF HERE // - START
			if($msg == '')
			{
				$valid = true;
				mail($adminemail, 'Contact Form submission('.$siteurl.')', "Dear Admin,\nYou have recived a contact request.\nPlease review the info\n------------------------------\nReturn Email: ".txt_clean($_POST['email'])."\n\nSubject: ".txt_clean($_POST['subj'])."\n\nMessage: \n".txt_clean($_POST['msg'])."\n-------------------------------\n\nThank you for attending to this matter.\nXtraUpload Automated Contact Scrpt","From: ".$sitename." - Contact Form <contact@".$_SERVER['SERVER_NAME'].">");
				$kernel->tpl->assign('valid', $valid);
			}
		// PUT IN ALL YOUR STUFF HERE // - END
		continue;
	}
}

$kernel->tpl->assign('msg', $msg);
if(!$valid and $allow_imaging)
{
	$kernel->tpl->assign('captcha',$captcha->display_form());
}
$kernel->tpl->display('contactus.tpl');
?>