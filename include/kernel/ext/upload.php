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

class upload
{
	var $type;
	var $file;
	var $file_name;
	var $return;
	var $tmp_name;
	var $browse;
	var $featured;
	var $error;
	var $email;
	var $file_loc;
	var $userid;
	var $description;
	var $inProgress;
	var $password;
	var $server;
	var $sesid;
	var $md5;
	var $secid;
	
	function upload()
	{
	}

	function set($file='')
	{
		global $lang;
		@ini_set('max_execution_time','99999999999');
		$this->init($file);
		$this->inProgress = true;
		
		if($this->type == 'http')
		{
			$name = $this->url();
		}
		else if($this->type == 'ftp')
		{
			$name = $this->ftp();
		}
		else
		{
			$name = $this->browse();
		}
		
		if(!$name)
		{
			
			return false;
		}
		
		if(!file_exists($name))
		{
			$this->error = 'tmp_exists:'.$name;
			
			return false;
		}
		
		$this->inProgress = false;
		$this->return = $this->complete();
		if(!$this->return)
		{
			
			return false;
		}
		else
		{
			return true;
		}
		
	}
	
	function init($file)
	{
		global $lang;
		if($file == '')
		{
			$this->file = $file;
			$this->type = 'browse';
			$this->browse = true;
		}
		else
		{
			$this->file = $file;
			$file1 = explode('://', $file);
			$file2 = $file1[0];
			$type = strtolower ($file2);
			$this->type = $type;
			$this->browse = false;
		}
	}
	
function url()
{
	$urls=$this->file;
	$this->secid = txt_clean($_POST['sessionid']);
	global $limit_size, $lang;
	$http = new http_class();
	if ( !empty($urls) )
	{
		$num = 0;
		$uri = $urls;
		
		$parts = parse_url($uri);
		$url_user = ($parts['user'] ? $parts['user'] : '');
		$url_pass = ($parts['pass'] ? $parts['pass'] : '');
		
		$filename = basename ($uri);
		$type = strtolower (strrchr ($filename, '.'));
		$error = $http->GetRequestArguments ($uri, $arguments);
		$arguments['Headers']['Pragma'] = 'nocache';
		$error = $http->Open ($arguments);
		if ($error == '')
		{
			$error = $http->SendRequest ($arguments);
			if ($error == '')
			{
				$headers = array ();
				$error = $http->ReadReplyHeaders ($headers);
				$filesize = 1;
				if ($error == '')
				{
					reset ($headers);
					
					for ($header = 0; $header < count ($headers); next ($headers), ++$header)
					{
						$header_name = key ($headers);
						if (gettype ($headers[$header_name]) != 'array')
						{
							switch (strtolower ($header_name))
							{
								case 'content-length':
								{
									$filesize = $headers[$header_name];
									break;
								}
							}
							continue;
						}
					}
					
					if(($filesize > ($limit_size * 1024 * 1024)) && $limit_size != '0')
					{
						$this->error = 'size';
						return false;
					}
					
					$dtstart = time ();
					$iRead = 0;
					@mkdir('./temp/'.$this->secid);
					$tmp = './temp/'.$this->secid.'/upload_postdata';
					$flength = './temp/'.$this->secid.'/flength.size';
					$fp1 = fopen($flength, 'w');
					fwrite($fp1,$filesize);
					fclose($fp1);
					
					$fp = fopen($tmp, 'wb');
					if($iRead < $filesize)
					{
						while (true)
						{
							$i++;
							$error = $http->ReadReplyBody($body, (4096 * 32));
							
							if ($error != '')
							{
								$this->error = $error;
								return false;
							}
							
							$readlength = strlen($body);
							
							if ($readlength == 0)
							{
								break;
							}
							
							fwrite($fp, $body);
							
							$iRead += $readlength;
							$body = '';
						}
					}
					fclose($fp);
				}
				else
				{
					$this->error = 'unknown';
				}
			}
			else
			{
				$this->error = 'unknown';
			}
		}	
		else
		{
			$this->error = 'unknown';
		}	
		$http->Close ();
		
		unlink($flength);
		
		//uploadstatus($filesize, $iRead, $dtstart);
		$this->description = txt_clean($_POST['description']);
		$this->password = txt_clean($_POST['password']);
		$this->tmp_name = $tmp;
		$this->server = urldecode($_POST['server']);
		$this->featured = intval($_POST['featured']);
		$this->error = trim($this->error);
		return $tmp;
	}
}
	
	
	function browse()
	{
		global $limit_size, $lang;
		$file_size = filesize($_FILES['attached']['tmp_name']);
		$file_error = $_FILES['attached']['error'];
		$file_name = txt_clean($_FILES['attached']['name']);
		$file_temp_name = $_FILES['attached']['tmp_name'];
		$description = txt_clean(urldecode($_POST['description']));
		$email = txt_clean($_POST['email']);
		$password = txt_clean(urldecode($_POST['password']));
		$server = txt_clean(urldecode($_POST['server']));
		$secid = txt_clean($_POST['sessionid']);
		$featured = intval($_POST['featured']);
		##################################################
		
		if(!(isset($_GET['bar'])))
		{
			$_GET['bar'] = 'no';
		}
		
		if($_GET['bar'] == "yes")
		{
			
			$file_error = false;
			$file_name = txt_clean($_GET['filename']);
			$file_temp_name = "./temp/".txt_clean($_GET['sid']).'/upload_postdata';
			$file_size = filesize($file_temp_name);
			$server = txt_clean(urldecode($_GET['server']));
			$secid = txt_clean(urldecode($_GET['sid']));
			$email = txt_clean($_GET['email']);
			$description = txt_clean(urldecode($_GET['description']));
			$password = txt_clean(urldecode($_GET['password']));
			$featured = intval($_POST['featured']);
		}
		
		if(isset($_GET['flash']))
		{
			$file_size = filesize($_FILES['Filedata']['tmp_name']);
			$file_error = $_FILES['Filedata']['error']; 
			$file_name = txt_clean($_FILES['Filedata']['name']);
			$file_temp_name = $_FILES['Filedata']['tmp_name'];
			$description = txt_clean(urldecode($_GET['description']));
			$email = txt_clean(urldecode($_GET['email']));
			$password = txt_clean($_GET['password']);
			$server = urldecode($_GET['server']);
			$this->userid = intval($_GET['user']);
			$secid = txt_clean($_GET['secid']);
			$featured = intval($_GET['featured']);
		}
		
		if(!$file_error and file_exists($file_temp_name))
		{
			if(($file_size > ($limit_size * 1024 * 1024)) && $limit_size != '0')
			{
				$this->error = 'size';
				
				return false;
			}
			
			$this->tmp_name = $file_temp_name;
			$this->description = $description;
			$this->password = $password;
			$this->server = $server;
			$this->secid = $secid;
			$this->email = $email;
			$this->featured = $featured;
			$this->file = $file_name;
			return $file_temp_name;
		}
		else
		{
			$this->error = 'unknown';
			return false;
		} 
	}
	

	function ftp()
	{
		global $limit_size, $lang;
		$ftps = $this->file;
		$this->secid = txt_clean($_POST['sessionid']);
		//$ftp = new ftp();
		set_time_limit (0);
		if (!empty ($ftps))
		{
			$num = 0;
			$uri = $ftps;

			$parts = parse_url($uri);
			$ftp_host = $parts['host'];
			$ftp_user = ($parts['user'] ? $parts['user'] : 'anonymous');
			$ftp_pass = ($parts['pass'] ? $parts['pass'] : 'anonymous');

			$remote_filename = $parts['path'];
			$ftp = new ftp ();
			$ftp->debug = false;
			if(!$ftp->ftp_connect($ftp_host) )	
			{
				$this->error = $lang['upload']['19'].'\n';
				return false;
			}
		
			if (!$ftp->ftp_login($ftp_user, $ftp_pass))
			{
			    $ftp->ftp_quit();
				$this->error = 'ftp_login';
				return false;
			}

			$filename = basename ($uri);
			$type = strtolower (strrchr ($filename, '.'));
			$filesize = $ftp->ftp_size($remote_filename);

			if ($filesize == -1)
			{
				$this->error = 'unknown';
				return false;
			}
			else if ($limit_size != 0 && (($limit_size * 1024 * 1024) < $filesize))
			{
				$this->error = 'size';
				return false;
			}

			$name = $ftp->ftp_get($remote_filename, $filesize, $this->secid);

			if (!$name)
			{
				$ftp->ftp_quit();
				$this->error = 'unknown';
				return false;
			}
			
 			$ftp->ftp_quit ();
			$this->tmp_name = $name;
			$this->description = txt_clean($_POST['description']);
			$this->password = txt_clean($_POST['password']);
			$this->server = urldecode($_POST['server']);
			$this->featured = intval($_POST['featured']);
			return $name;
		}
	}
	
	function complete()
	{
		global $kernel, $db, $rewrite_links, $myuid, $lang, $imageCopyText, $imageTextColor, $allow_imaging, $sitename, $siteurl, $adminemail, $can_email;
		$name = $this->file;
		$name = str_replace(',','',$name);
		$name = str_replace(' ','_',$name);
		
		$uniq = $kernel->password->gen(10);
		$hash = $kernel->password->gen(12);
		
		/*
		$uniq = substr( md5(uniqid (rand())), 0, 10 );
		$hash = substr( md5(uniqid (rand())), 0, 12 );
		*/
		
		$description = $this->description;
		$password = $this->password;
		$server = $this->server;
		$secid = $this->secid;
		$featured = $this->featured;
		$email = $this->email;
		$file_temp_name = $this->tmp_name;
		
		$file_name = $uniq.".".basename($name);
		$file_real_name = basename($name);
		
		$file_md5 = md5_file($file_temp_name);
		$this->md5 = $file_md5;
		$file_size = filesize($file_temp_name);
		if($db->num($db->query("SELECT * FROM `files` WHERE `md5` = '".$file_md5."' AND `ban` = '1'")) != 0)
		{
			$this->error = 'banned';
			@unlink($file_temp_name);
			
			return false;
		}
		
		$dbq = $db->query("SELECT * FROM `files` WHERE `md5` = '".$file_md5."' AND `status` = '1'");
		$fileInfo = $db->fetch($dbq);
		$numFiles = $db->num($dbq);
		if($numFiles != 0 && file_exists('./files/'.substr($file_md5,0,2).'/'.$fileInfo->filename))
		{
			$this->description = $fileInfo->description;
			$this->password = $fileInfo->password;
			$this->server = $fileInfo->server;
			$this->featured = $fileInfo->featured;
			
			if($rewrite_links)
			{
				$furl = $fileInfo->server . '/download/' . $fileInfo->hash ;
			}
			else
			{
				$fileInfo->furl = $server . '/index.php?p=download&hash=' . $fileInfo->hash ;
			}
			$r_url = $fileInfo->server . "/index.php?p=rate&id=" . $fileInfo->hash ;
			$durl = $fileInfo->server . '/index.php?p=delfile&file='.$fileInfo->hash.'&del=' . $fileInfo->pkey ;
			$hash = $fileInfo->hash;
			
			if($this->secid != $fileInfo->secid)
			{
				$db->query("UPDATE `files` SET `secid` = '".$this->secid."', `reupload` = '1' WHERE `id` = '".$fileInfo->id."'");
			}
			
			if($_GET['bar'] == 'yes')
			{
				@unlink($file_temp_name);
				@rmdir(str_replace('/upload_postdata','',$file_temp_name));
			}
			else if(isset($_POST['file']))
			{
				@unlink($file_temp_name);
				@rmdir(str_replace('/upload_postdata','',$file_temp_name));
			}
			else
			{
				@unlink($file_temp_name);
			}
		}
		else
		{
			
			if(!is_dir('./files/'.substr($file_md5,0,2)))
			{
				mkdir('./files/'.substr($file_md5,0,2));
			}
			
			$file_loc = './files/'.substr($file_md5,0,2).'/'.$file_name;
			
			if($this->userid != '')
			{
				$myuid = $this->userid;
			}
	
			$filename = (!$file_error) ? substr($file_name, 0, strpos($file_name, '.')) : 'Error';
			$arr_old = $arr;
			$ok_filetypes = explode("|",$filetypes);
			$type = str_replace('.','',strtolower (strrchr ($filename, '.')));
			$isok = false;
			
			if(in_array($type,$ok_filetypes) or $ok_filetypes[0] == '*')
			{
				$isok = true;
			}
				
			if(!$isok)
			{
				$this->error = 'unknown';
				
				return false;
			}
			
			$arr = $arr_old;
			if(!file_exists($file_temp_name))
			{
				$this->error = 'unknown';
				
				return false;
			}
			
			if($_GET['bar'] == "yes" or $this->type == 'http' or $this->type == 'ftp' )
			{
				rename($file_temp_name, $file_loc);
			}
			else
			{
				move_uploaded_file($file_temp_name, $file_loc);
			}
			
			if($_GET['bar'] == 'yes' && !file_exists($file_loc))
			{
				@copy($file_temp_name, $file_loc);
				@unlink($file_temp_name);
				@rmdir(str_replace('/upload_postdata','',$file_temp_name));
			}
			else if(isset($_POST['file']))
			{
				@unlink($file_temp_name);
				@rmdir(str_replace('/upload_postdata','',$file_temp_name));
			}

			$this->file_loc = $file_loc;
			
			if(!file_exists($file_loc))
			{
				$this->error = 'unknown';
				
				return false;
			}
			
			$this->file_name = $file_name;
			update_total_size($this->file_name);
			$ipaddress = $_SERVER['REMOTE_ADDR'];
			
			$strQuery  = "INSERT INTO `files` SET ";	
			$strQuery .= "`filename` = '".$file_name."',";
			$strQuery .= "`o_filename` = '".$file_real_name."',";
			$strQuery .= "`ipaddress` = '{$ipaddress}',";
			$strQuery .= "`date` = '".time()."',";
			$strQuery .= "`pkey` = '{$uniq}',";
			$strQuery .= "`description` = '{$description}',";
			$strQuery .= "`password` = '{$password}',";
			$strQuery .= "`featured` = '{$featured}',";
			$strQuery .= "`last_download` = '".time()."',";
			$strQuery .= "`server` = '$server',";
			$strQuery .= "`group` = '".$_SESSION['perm_level']."',";
			$strQuery .= "`hash` = '{$hash}',";
			$strQuery .= "`secid` = '{$secid}',";
			$strQuery .= "`md5` = '{$file_md5}',";
			$strQuery .= "`size` = '{$file_size}',";
			$strQuery .= "`user` = '".$myuid."',";
			$strQuery .= "`status` = '1'";
				
			$result = $db->query($strQuery);
			$aid = mysql_insert_id();
			
			if($rewrite_links)
			{
				$furl = $server . '/download/' . $hash ;
			}
			else
			{
				$furl = $server . '/index.php?p=download&hash=' . $hash ;
			}
			$furl = str_replace('http://','%%',$furl);
			$furl = str_replace('//','/',$furl);
			$furl = str_replace('%%','http://',$furl);
			
			$r_url = $server . "/index.php?p=rate&id=" . $hash ;
			$r_url = str_replace('http://','%%',$r_url );
			$r_url = str_replace('//','/',$r_url );
			$r_url = str_replace('%%','http://',$r_url );
			$durl = $server . '/index.php?p=delfile&file='.$hash.'&del=' . $uniq ;
			
			// Add text to images!
			$img = $file_name; 
			$img = str_replace('.','',strtolower (strrchr ($img, '.')));
			if(($img == 'png' or $img == 'jpg' or $img == 'jpeg') && $allow_imaging)
			{
				img_text('./files/'.substr($file_md5,0,2).'/'.$file_name);
			}
			
			log_action('File('.$file_real_name.',hash='.$hash.') was uploaded', 'file:upload', 'IP('.$_SERVER['REMOTE_ADDR'].') uploaded the file('.$file_name.',hash='.$hash.')', 'ok', 'upload.php');
			
			if($can_email)
			{
				if(!strstr($email, ','))
				{
					$emailArr[] = $email;
				}
				else
				{
					$emailArr = explode(',',$email);
				}
				
				$emailSent = array();
				$i = 0;
				foreach($emailArr as $email1)
				{
					if($i < 100)
					{
						if($email1 != '')
						{
							if(!in_array($email1, $emailSent))
							{
								mail($email1, $lang['kernelUpload']['1'].' - '.$file_real_name,"\n".$lang['kernelUpload']['2'].$email1.",\n".$lang['kernelUpload']['3']."\n".$lang['kernelUpload']['4']."\n----------------------------\n".$lang['kernelUpload']['5']." ".$file_real_name."\n".$lang['kernelUpload']['9'].get_filesize_prefix($file_size)."\n".$lang['kernelUpload']['7'].$password."\n".$lang['kernelUpload']['6'].$description."\n".$lang['kernelUpload']['8'].$furl."\n----------------------------\n".$lang['kernelUpload']['10']."\n".$lang['kernelUpload']['11'].$sitename.$lang['kernelUpload']['12']."\n----------------------\n".$lang['kernelUpload']['13'],'From: '.$adminemail);
								$i++;
								$emailSent[] = $email1;
								
							}
						}
					}
				}
			}
		}
		return $furl."|".$r_url.'|'.$hash.'|'.$durl;
	}
}
?>