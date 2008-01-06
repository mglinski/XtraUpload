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
if(!(isset($_GET['secid'])))
{
	$kernel->tpl->display('file_upload.tpl');
	$kernel->tpl->display('site_footer.tpl');
	die;
}
		
$query  = "SELECT * FROM `files` WHERE `secid` = '".txt_clean($_GET['secid'])."' LIMIT 1";
$b = $db->query($query);
$a = $db->fetch($b,'obj');
if($a->hash != '')
{
	$server = $a->server;
	$kernel->tpl->assign('sever', $server);
	
	$hash = $a->hash;
	$kernel->tpl->assign('hash', $hash);
	
	$r_filename = $a->filename;
	$kernel->tpl->assign('r_filename', $r_filename);
	
	$filename = $a->o_filename;
	$kernel->tpl->assign('filename', $filename);
	
	$durl = makeXuLink('index.php', array('p' => 'delfile', 'file' => $a->hash, 'del' => $a->pkey), $a->server);
	$kernel->tpl->assign('durl', $durl);
	
	$description = $a->description;
	$kernel->tpl->assign('desc', $$description);
	
	$password = $a->password;
	$kernel->tpl->assign('pass', $password);
	
	$furl = makeDownLinkFromHash($hash);
	$kernel->tpl->assign('furl', $furl);
	
	$r_url = makeXuLink('index.php', array('p' => 'rate', 'id' => $a->hash));
	$kernel->tpl->assign('r_url', $r_url);
	
	$img = $a->filename; 
	$img = str_replace('.','',strtolower (strrchr ($img, '.')));
	$type = $img;
	$kernel->tpl->assign('type', $type);
	
	if(($img == 'png' or $img == 'jpg' or $img == 'jpeg') && $allow_imaging)
	{
		$img = true;
		$thumb = $a->server.'/thumbs/'.substr($a->md5,0,2).'/thumb_'.$a->filename;
		$imgSize = imgSize($thumb);
		$kernel->tpl->assign('imgSize', $imgSize);
	}
	else
	{
		$img = false;
	}
	$kernel->tpl->assign('img', $img);
		
	if($a->reupload)
	{
		$reMsg = $lang['file_upload']['4'];
		$kernel->tpl->assign('reUpload', true);
		$kernel->tpl->assign('reMsg', $reMsg);
	}
	else
	{
		$kernel->tpl->assign('reUpload', false);
	}
		
	$icon = '';
	if(file_exists('./images/icons/'.$type.'.png'))
	{
		$icon = "<img id='".$type."' src='".$siteurl."images/icons/".$type.".png' alt='".$type." File' />";
	}
	$kernel->tpl->assign('icon', $icon);
	
	$kernel->tpl->assign('imgSite', makeXuLink('image.php','file=/'.$hash.'.'.$type));
	$kernel->tpl->assign('thumb', $a->server.'/imagedirect.php?'.'thumb=1&file='.$hash.'.'.$type);		
    $kernel->tpl->assign('imgFull', makeXuLink('imagedirect.php','file=/'.$hash.'.'.$type, $server));
}
else
{
	$kernel->tpl->assign('validUpload', false);
}
$kernel->tpl->display('file_upload.tpl');