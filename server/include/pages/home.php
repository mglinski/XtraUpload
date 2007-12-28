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
$sid = md5(uniqid(rand()));
$kernel->tpl->assign('sid', $sid);

$server_id = get_server();
$kernel->tpl->assign('server_id', $server_id);

if($upload_cgi)
{
	$up_method = "$server_id/cgi-bin/upload.cgi?sid=$sid";
}
else
{
	$up_method = makeXuLink('index.php', 'p=upload', $server_id);
	
}
$up_method_url = makeXuLink('index.php', 'p=url', $server_id);


$kernel->tpl->assign('up_method', $up_method);
$kernel->tpl->assign('up_method_url', $up_method_url);
$kernel->tpl->assign('getFiles', getFiles());
$kernel->tpl->assign('fpLink', makeXuLink('index.php','p=fastpass'));

$kernel->tpl->assign('limit_size_int', $limit_size);
if($limit_size == '0')
{
	$limit_size = 'Unlimited';
	 $kernel->tpl->assign('limit_size', $limit_size);
}

$kernel->tpl->assign('allow_featured_int', intval($allow_featured));

$uploadProgressLink = $siteurl."include/progress.php?sid=".$sid."&start_time=0&server=".urlencode($server_id);
$kernel->tpl->assign('uploadProgressLink', $uploadProgressLink);

$kernel->tpl->assign('forceLogin', '0');
if(!($can_flash) && !($can_url) && !($can_cgi))
{ 
	$kernel->tpl->assign('forceLogin', '1');
	$kernel->tpl->assign('loginLink', makeXuLink('index.php','p=login'));
}

// javascript Dynamic values
$kernel->tpl->assign('fileExt', strtolower(str_replace(array('\n','\r'),'',$filetypes)));

$featuredArr = array();
$files = array(); 
$d = $db->query("SELECT `id` AS num FROM files WHERE `featured` = '1' AND `password` = '' AND `approved` = '1' AND `status` = '1'  ORDER BY RAND() LIMIT 3");
$num = $db->num($d);
$i=0;

while($file = $db->fetch($d))
{
	$files[$i++] = $file;
}

if($num > 0 && $allow_featured)
{
	$a=0;
	while($a < $n)
	{
		$featuredArr[]['type'] = str_replace('.','',strtoupper (strrchr ($files[$a]->o_filename, '.')));
		$featuredArr[]['desc'] = $files[$a]->description;
		$featuredArr[]['name'] = $files[$a]->o_filename;
		$featuredArr[]['title'] = htmlspecialchars($files[$a]->o_filename.' -> '.$files[$a]->description);
		$featuredArr[]['dl'] = $files[$a]->downloads;
		$featuredArr[]['id'] = $files[$a]->id;
		$featuredArr[]['dlLink'] = makeDownLinkFromHash($files[$a]->hash);
		
		if(file_exists('./images/icons/'.$type.'.png'))
		{
			$featuredArr[]['iconExists'] = true;
		}
		
		if(file_exists('./thumbs/'.substr($files[$a]->md5,0,2).'/'.$img))
		{
			$featuredArr[]['thumbExists'] = true;
			$featuredArr[]['imageDirect'] = makeXuLink('imagedirect.php', 'file='.$files[$a]->hash.'.'.$type);
			$featuredArr[]['thumbSrc'] = makeXuLink('thumb.php', 'file='.$files[$a]->hash.'.'.$type);			
		}
		$a++;
	}
	$files = NULL;
}
$kernel->tpl->assign('featuredArr', $featuredArr);
$kernel->tpl->display('home.tpl');
?>