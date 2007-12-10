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

include("./include/init.php");

switch( $_POST['act'])
{
	case "login": 
		if(user_login(txt_clean($_POST['username']), txt_clean($_POST['password'])))
		{
			echo "true";
		}
		else
		{
			echo "false";
		}
	break;
	
	case "checkLink":
		$line = $_POST['link'];
		if(trim($line) != '')
		{
			$hash = substr(trim($line),-12);
			$hash = txt_clean($hash);
			
			if(check_file_bool($hash))
			{
				$line_arr = "true";
			}
			else 
			{
				$line_arr = "false";
			}
		}
		
		echo $line_arr;
	break;
	
	case "getUploadVars":
		echo "uniqueHash=".md5(uniqid(rand()))."|-|serverUrl=".get_server()."|-|allow_featured=".(bool)$allow_featured."|-|limit_wait=".$limit_wait;
	break;
	
	case "getDownloadInfo":
		$id = txt_clean($_POST['link']);
		$id = substr(trim($id),-12);
		
		
		$sql = "SELECT * FROM files WHERE `hash` = '".$id."' LIMIT 1";
		$query = $db->query($sql);
		
		if($db->num($query) != '1')
		{
			echo "error";
			break;
		}
		
		$a = $db->fetch($query,'obj');
		$rand_id = makeFileDownloadLink($id, $a->o_filename, $a->filename);
		$time = time()+259200;
	
		if($rewrite_links)
		{
			$link = $a->server.'/file/'.$rand_id.'/'.str_replace(' ','_',$a->o_filename);
		}
		else
		{
			$link = $a->server.'/index.php?p=download&link='.$rand_id.'&name='.str_replace(' ','_',$a->o_filename);
		}
		
		echo $link."|".$a->size;
		
	break;
	
	case "updateAccountInfo":
		$sql = "UPDATE `users` SET ";
		if(($_POST['pass1'] == $_POST['pass2']) && $_POST['pass1'] != "" & $_POST['pass2'] != "")
		{
				$sql .= "`password` = '".$_POST['pass1']."', ";
		}
		$sql .= "`email` = '".$_POST['email']."' WHERE `uid` = '".$_SESSION['myuid']."'";
		$db->query($sql);
		echo "true";
	break;
	
	case "getAccountStats":
		// File count
		list($files) = $db->fetch( $db->query("SELECT COUNT(*) FROM `files` WHERE `status` = '1' AND `user` = '".$_SESSION['myuid']."' "), 'num' );
		echo $files."|";
		
		// Points Count
		$ds = "SELECT * FROM users WHERE `username` = '".$_SESSION['username']."'";
		$re = $db->query($ds);
		$s = $db->fetch($re,"obj"); 
		echo $s->points."|";
		
		// Size Count
		$ser = $db->query("SELECT * FROM `files` WHERE `status` = '1' AND `user` = '".$_SESSION['myuid']."'");
		$bw=0;
		while($serv = $db->fetch($ser))
		{
			$bw += $serv->size;
		}
		echo get_filesize_prefix($bw)."|";
		
		// Account Type, accountType
		$g = $db->fetch( $db->query("SELECT `name` FROM `groups` WHERE `id` = '".$s->group."'"));
		echo ucfirst($g->name);
		
	break;
	
	case "getUploadComplete":
	
		$query  = "SELECT * FROM `files` WHERE `secid` = '".txt_clean($_POST['secid'])."' LIMIT 1";
		$b = $db->query($query);
		$a = $db->fetch($b,'obj');
		if($a->hash != '')
		{
			$durl = makeXuLink('index.php', array('p' => 'delfile', 'file' => $a->hash, 'del' => $a->pkey));
			$furl = makeDownLinkFromHash($a->hash);
			$r_url = makeXuLink('index.php', array('p' => 'rate', 'id' => $a->hash));
			if($a->reupload)
			{
				$durl = "ERROR: You reuploaded a file, no delete link found.";
			}
			
			echo $furl."|".$durl."|".$r_url;
		}
		else
		{
			echo "error";
		}
	break;
	
	case "getAccountInfo":
		$user = $db->fetch($db->query("SELECT * FROM `users` WHERE `uid` = '".$_SESSION['myuid']."'"));
		echo $user->username."|".$user->email;
	break;
	
	case "getFiles":
		$qr1 = $db->query("SELECT * FROM `files` WHERE `user` = '".$_SESSION['myuid']."' AND `status` = '1'");
		while($file = $db->fetch($qr1))
		{
			echo $file->o_filename."|-|".$file->hash."|-|".dayDate($file->date)."|-|".makeDownLinkFromHash($file->hash)."|-|".$file->id."|--|";
		}
		
	break;
	
	case "deleteFile":
		$qr1 = $db->query("SELECT * FROM `files` WHERE `id` = '".intval($_POST['file'])."' AND `user` = '".$_SESSION['myuid']."'");
		$file = $db->fetch($qr1);
		delfile_user($file->pkey);
		echo "true";
	break;
	
	case "getSiteName":
		echo $sitename;
	break;
	
	default:
		echo ":P, not a valid API call!!!";
	break;
}


function makeFileDownloadLink($id, $orig, $file)   
{
	global $db, $siteurl, $rewrite_links, $lang,$can_resume, $max_file_streams;
	$rand_id = rand(111111,9999999999999);
	
	$time = time()+259200;

	$db->query("INSERT INTO dlinks (down_id,store_name,real_name,time,resume,can_r,`limit`)VALUES('".$rand_id."','".$file."','".$orig."','".$time."','".$_SERVER['REMOTE_ADDR']."','".$can_resume."','".$max_file_streams."')",'down_link_1');
	return $rand_id;
}
?>