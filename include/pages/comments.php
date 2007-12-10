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

switch($_GET['act'])
{


	case "add":
		$db->query("INSERT INTO `comments`(`email`,`file`,`author`,`date`,`status`,`body`,`title`,`url`) VALUES('".txt_clean($_POST['email'])."','".txt_clean($_GET['file'])."','".txt_clean($_POST['author'])."','".rdate()."','1','".html_clean($_POST['body'])."','".txt_clean($_POST['title'])."','".txt_clean($_POST['url'])."')");
		$msg = '<p><strong><font size="4">'.$lang['comments']['2'].'</font><font size="5"><br /><font size="3">'.$lang['comments']['1'].'</font></font></strong> </p>';
		log_action('Comment Added', 'file:comments:add', 'IP('.$_SERVER['REMOTE_ADDR'].') added a comment to file hash('.txt_clean($_GET['file']).')', 'ok', 'comments.php');
		redirect_foot($msg,'download&hash='.txt_clean($_GET['file']));
	break;
	
	
	case "status":
		$db->query("UPDATE `comments` SET `status` = '".intval($_GET['status'])."' WHERE `id` = '".intval($_GET['comment'])."'");
		$msg = '<p><strong><font size="4">'.$lang['comments']['3'];
		if(!intval($_GET['status']))
		{
			$msg .= $lang['comments']['4'].'!'; $stat = $lang['comments']['4'];
		}
		else
		{
			$msg .= $lang['comments']['5'].'!'; $stat = $lang['comments']['5'];
		}
		$msg .= '</font><font size="5"><br /><font size="3">'.$lang['comments']['1'].'</font></font></strong> </p>';
		log_action('Comment id('.intval($_GET['comment']).') was '.$stat, 'file:comments:change_status', 'IP('.$_SERVER['REMOTE_ADDR'].') '.$stat.' the comment id('.intval($_GET['comment']).')', 'ok', 'comments.php');
		redirect_foot($msg,'download&hash='.txt_clean($_GET['file']));
	break;
	
	
	case "delete":
		$db->query("DELETE FROM `comments` WHERE `id` = '".intval($_GET['comment'])."'");
		$msg = '<p><strong><font size="4">'.$lang['comments']['6'].'</font><font size="5"><br /><font size="3">'.$lang['comments']['1'].'</font></font></strong> </p>';
		log_action('Comment id('.intval($_GET['comment']).') was deleted', 'file:comments:delete', 'IP('.$_SERVER['REMOTE_ADDR'].') deleted the comment id('.intval($_GET['comment']).')', 'ok', 'comments.php');
		redirect_foot($msg,'download&hash='.txt_clean($_GET['file']));
	break;
	
	
	case "edit":
		if($_POST['edit'])
		{
			$db->query("UPDATE `comments` SET 
				`author` = '".txt_clean($_POST['author'])."',
				`title` = '".txt_clean($_POST['title'])."',
				`url` = '".txt_clean($_POST['url'])."',
				`email` = '".txt_clean($_POST['email'])."',
				`body` = '".html_clean($_POST['body'])."'
			WHERE `id` = '".intval($_GET['comment'])."'");
			$msg = '<p><strong><font size="4">'.$lang['comments']['7'].'</font><font size="5"><br /><font size="3">'.$lang['comments']['1'].'</font></font></strong> </p>';
			log_action('Comment id('.intval($_GET['comment']).') was edited', 'file:comments:edit', 'IP('.$_SERVER['REMOTE_ADDR'].') edited the comment id('.intval($_GET['comment']).')', 'ok', 'comments.php');
			redirect_foot($msg,'download&hash='.$_GET['file']);
		}
		else
		{
			$comment =  $db->fetch($db->query("SELECT * FROM `comments` WHERE `id` = '".txt_clean($_GET['comment'])."' LIMIT 1"));
			$kernel->tpl->assign('comment', $comment);
			$kernel->tpl->display('comments.tpl');
		}
	break;
	
	
	
	default:
		$msg = '<p><strong><font size="4">'.$lang['comments']['15'].'</font><font size="5"><br /><font size="3">'.$lang['comments']['1'].'</font></font></strong> </p>';
		echo $msg.'<script>location = \''.makeXuLink('index.php','p=download&hash='.txt_clean($_GET['file'])).'\';</script>';
	break;
	
	
}
?>