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

$pageno = 0;
if(isset($_REQUEST['pageno']))
{
	$pageno = $_REQUEST['pageno'];
}
if($pageno == '')
{
	$pageno = 0;
}
$kernel->tpl->assign('pageno', $pageno);

$limit = 20;
if(isset($_REQUEST['limit']) && intval($_REQUEST['limit']) > 0)
{
	$limit = intval($_REQUEST['limit']);
}
if($limit == '')
{
	$limit = 20;
}
$kernel->tpl->assign('limit', $limit);

if(isset($_GET['del']))
{
	if($can_delete)
	{
		$sql = "SELECT * FROM files WHERE id='".intval($_GET['del'])."' AND user = '{$_SESSION['myuid']}'";
		$qr1 = $kernel->db->query($sql);
		$row = $kernel->db->fetch($qr1);
		delfile_user($row->pkey);
	}
	else
	{
		echo '<h4><center>'.$lang['editimg']['3'].'</center></h4><br />';
	}
}


$sql = "SELECT * FROM files WHERE user='".$myuid."' AND status != '2'";
$qr1 = $db->query($sql);
$rowcount = $db->num($qr1);
$pagecount = ceil($rowcount / $limit);

while($pageno >= $pagecount)
{
	$pageno--;
}

if($pageno < 0)
{
	$pageno = 0;
}

$pageInfo = array();
if($pageno == 0 && $pagecount == 0)
		{
				$pageInfo[0] = array();
				$pageInfo[0]['page'] = '0';
				$pageInfo[0]['type'] = 'none';
		}
		else
		{
			for ($i=0; $i<$pagecount; $i++) 
			{
				if($i == ($pageno - 6))
				{
					$pageInfo[$i] = array();
					$pageInfo[$i]['type'] = 'elip';
				}
				else if($i == ($pageno + 6))
				{
					$pageInfo[$i] = array();
					$pageInfo[$i]['type'] = 'elip';
				}
				else if ($pageno == $i) 
				{
					$pageInfo[$i] = array();
					$pageInfo[$i]['page'] = (int)$i;
					$pageInfo[$i]['type'] = 'none';
				}
				else if(($pageno - 5) <= $i and $i <= ($pageno + 5))
				{
					$pageInfo[$i] = array();
					$pageInfo[$i]['page'] = $i;
					$pageInfo[$i]['type'] = 'link';
				}
				else if($i == 0)
				{
					$pageInfo[$i] = array();
					$pageInfo[$i]['page'] = 0;
					$pageInfo[$i]['type'] = 'link';
				}
				else if($i == ($pagecount - 1))
				{
					$pageInfo[$i] = array();
					$pageInfo[$i]['page'] = $i;
					$pageInfo[$i]['type'] = 'link';
				}
				else if(($pageno - 5) <= $i and $i <= ($pageno + 5))
				{
					$pageInfo[$i] = array();
					$pageInfo[$i]['page'] = $i;
					$pageInfo[$i]['type'] = 'link';
				}
				else
				{
					continue;
				}
			}
		}
$kernel->tpl->assign('pagecount', $pagecount);
$kernel->tpl->assign('pageInfo', $pageInfo);

	
$fileArr = array();	
$x = 0;	

$sql = "SELECT * FROM files WHERE user='".$myuid."' AND status != '2' LIMIT ".($pageno*$limit).",".$limit."";
$qr2 = $db->query($sql);
while( $a = $db->fetch($qr2,'obj') )
{ 
	$fileArr[$x]['o_filename'] = $a->o_filename;
	$fileArr[$x]['downloads'] = $a->downloads;
	$fileArr[$x]['check_file'] = check_file($a->hash);
	$fileArr[$x]['id'] = $a->id;
	$fileArr[$x]['hash'] = $a->hash;
	$fileArr[$x]['link'] = makeXuLink('index.php', array('p' => 'download', 'hash' => $a->hash));
	$fileArr[$x]['del'] = makeXuLink('index.php', array('p' => 'files', 'del' => $a->id));
	$x++;
}

$kernel->tpl->assign('fileArr', $fileArr);
if($can_create_folders)
{
	$folderArr = array();
	$x = 0;
	$sql = "SELECT * FROM folder WHERE user='".intval($_SESSION['myuid'])."'";
	$qr1 = $db->query($sql);
	while( $a = $db->fetch($qr1) )
	{
		$folderArr[$x]['id'] = $a->fid;
		$folderArr[$x]['name'] = $a->name;
		$x++;
	}
	$kernel->tpl->assign('folderArr', $folderArr);
}

$kernel->tpl->display('files.tpl');
?>