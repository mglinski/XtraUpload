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
if($_GET['act'] == 'manage')
{
	$fid = txt_clean($_POST['fid']);
	$sql = "SELECT * FROM `folder` WHERE `fid` = '$fid' AND `admin_password` = '".md5($_REQUEST['admin_password'])."'";
	//echo $sql;
	$fol = $db->query($sql);
	$fold = (string)$db->num($fol);
	
	if($fold == '1')
	{	
		if(isset($_POST['files']))
		{	
			if (is_array($_POST['files'] ))
			{
				foreach( $_POST['files'] as $afile )
				{
					$afile = intval($afile);
					$db->query( "DELETE FROM `fitem` WHERE `fid` = '$fid' AND `file` = '$afile'" ,"Request: ".$i);
					$i++;
				}
			}
			$msg = '<span style="color:#009900;font-size:18px"><center>'.$i.$lang['folder']['17'].'</center></span>';
		}
		else if(isset($_POST['admin_pass']) )
		{	
			$admin = $db->query("UPDATE `folder` SET `admin_password` = '".md5($_POST['admin_pass'])."' WHERE `fid` = '".txt_clean($_POST['fid'])."'");
			$msg = '<span style="color:#009900;font-size:18px"><center>'.$lang['folder']['18'].'</center></span>';
		}
		else if(isset($_POST['new_files']))
		{	
			$added = add_files_to_folder($_POST['fid'],$_POST['new_files']);
			$msg = '<span style="color:#009900;font-size:18px"><center>'.$added.$lang['folder']['19'].'</center></span>';
		}
		else if(isset($_REQUEST['del']))
		{
			$db->query("DELETE FROM folder WHERE fid='".intval($_REQUEST['del'])."'");
			$db->query("DELETE FROM fitem WHERE fid='".intval($_REQUEST['del'])."'");
			$msg = '<span style="color:#009900;font-size:18px"><center>'.$lang['folder']['20'].'</center></span>';
			redirect_foot('','folders');
		}
			
		$folder = $db->fetch($db->query("SELECT * FROM `folder` WHERE `fid` = '".$_POST['fid']."'"));
		$kernel->tpl->assign('folder', $folder->namey);
		$kernel->tpl->assign('msg', $msg);
		$kernel->tpl->assign('fold', $fold);
		
		
		$pageno = 0;
		if(isset($_REQUEST['pageno']))
		{
			$pageno = intval($_REQUEST['pageno']);
		}
		
		$limit = 20;
		if(isset($_REQUEST['limit']) && intval($_REQUEST['limit']) > 0)
		{
			$limit = intval($_REQUEST['limit']);
		}
		
		$kernel->tpl->assign('pageno', $pageno);
		
		$sql = "SELECT * FROM fitem WHERE fid = '".txt_clean($_POST['fid'])."'";
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
		
		if($rowcount != '0')
		{
			$x = 0;
			$fileArr = array();
			$sql = "SELECT * FROM `fitem` WHERE `fid` = '".txt_clean($_POST['fid'])."' LIMIT ".($pageno*$limit).",".$limit;
			$qr2 = $db->query($sql);
			while( $a = $db->fetch($qr2,'obj') )
			{ 
				$fileArr[$x] = array();
				$b = $db->fetch($db->query("SELECT * FROM `files` WHERE `id` = '".intval($a->file)."'"));		
				$fileArr[$x]['name'] = $b->o_filename;
				$fileArr[$x]['file'] = $a->file;
				$fileArr[$x]['link'] = makeXuLink('index.php', 'p=download&hash='.$b->hash);
				$x++;
			}
			$kernel->tpl->assign('fileArr', $fileArr);
		}
	}
	else
	{
		$kernel->tpl->assign('loginFail', true);
	}
}
$kernel->tpl->display('folder.tpl');
?>