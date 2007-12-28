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

include("./init.php");
if(!is_dir('./admin/mods'))
{
	$can = @mkdir('./admin/mods');
	if(!$can)
	{
		echo "<h2>Fatal Error: Folder 'mods' does not exist in the admin folder. Please create this forder before trying to use the mods system.</h2>";
		include("admin/footer.php");
		die();
	}
	
}

if(!is_writable('./admin/mods'))
{
	$can = @chmod('./admin/mods', 0777);
	if(!$can)
	{
		echo "<h2>Fatal Error: Folder 'mods' does not have proper permissions. Please CHMOD this folder to '0777' before trying to use the mods system.</h2>";
		include("admin/footer.php");
		die();
	}
	
}



?>
<style type="text/css">
<!--
.style1 {font-size: 24px}
-->
</style>
<?
$cache_dir = './cache/mods/';

function process_mod($modfile)
{
	global $db;
	$command_num=0;
	$cur = '';
	$config = array();
	$command = array();
	$file = file($modfile);
	
	foreach($file as $buffer)
	{
		$line_num++;
		if(strstr($buffer,'####[@'))
		{
			$left_bracket = strpos($buffer, '####[@ ');
			$right_bracket = strpos($buffer, ': ');
			$left_of_bracket = substr($buffer, 0, $left_bracket);
			$right_of_bracket = substr($buffer, $right_bracket);

			$conf = strtolower(trim(substr($buffer, $left_bracket+7, (($right_bracket-7)-($left_bracket)))));
			$config[$conf] = '';
			
			
			$left_bracket = strpos($buffer, ': ');
			$right_bracket = strpos($buffer, ']##');
			$left_of_bracket = substr($buffer, 0, $left_bracket);
			$right_of_bracket = substr($buffer, $right_bracket);

			$config[$conf] = trim(substr($buffer, $left_bracket+2, (($right_bracket-2)-($left_bracket+1))));;
			

		}
		else if(stristr($buffer,'######[--'))
		{
			$left_bracket = strpos($buffer, '######[--');
			$right_bracket = strpos($buffer, '--]###');
			$left_of_bracket = substr($buffer, 0, $left_bracket);
			$right_of_bracket = substr($buffer, $right_bracket);
			
			if(trim(substr($buffer, $left_bracket+9, (($right_bracket-9)-($left_bracket+1)))) == 'END')
			{
				$command[$command_num]['action'] = trim($action);
				$action = '';
				$in_action = false;
			}
			else
			{
				$command_num++;
				$command[$command_num] = array();
				$command[$command_num]['command'] = strtoupper(trim(substr($buffer, $left_bracket+9, (($right_bracket-9)-($left_bracket+1)))));
				$cur = $command[$command_num]['command'];
			}
			$in_action = true;
		}
		else
		{
			if($in_action)
			{
				$action .= $buffer;
			}
		}
	}
	
	
	$curr_file = '';
	$curr_action = '';
	$file_name = '';
	$actions = array();
	$x = 0;
	foreach($command as $command)
	{
		$x++;
		if($command['command'] == 'OPEN')
		{
			check_file_access($command['action']);
			$curr_file = open_file($command['action'],$config);
			$file_name = $command['action'];
			$curr_action = $command['action'];
			$actions[$command['command']] = $command['action'];
		}
		else if($command['command'] == 'CREATE')
		{
			$curr_file = create_file($command['action'],$config);
			$file_name = $command['action'];
			$curr_action = $command['action'];
			$actions[$command['command']] = $command['action'];
		}
		else if($command['command'] == 'FIND')
		{
			$curr_file = find($command['action'],$curr_file);
			$curr_action = $command['action'];
			$actions[$command['command']] = $command['action'];
		}
		else if($command['command'] == 'SQL')
		{
			$db->query($command['action']);
		}
		else if($command['command'] == 'ADD-START')
		{
			$curr_file = $command['action'].$curr_file;
			$curr_action = $command['action'];
			$actions[$command['command']] = $command['action'];
		}
		else if($command['command'] == 'ADD-END')
		{
			$curr_file = $curr_file.$command['action'];
			$curr_action = $command['action'];
			$actions[$command['command']] = $command['action'];
		}
		else if($command['command'] == 'REPLACE')
		{
			$curr_file = replace($command['action'],$curr_file);
			$curr_action = $command['action'];
			$actions[$command['command']] = $command['action'];
		}
		else if($command['command'] == 'AFTER')
		{
			
			$curr_file = replace($curr_action.$command['action'],$curr_file);
			$curr_action = $command['action'];
			$actions[$command['command']] = $command['action'];
		}
		else if($command['command'] == 'BEFORE')
		{
			$curr_file = replace($command['action'].$curr_action,$curr_file);
			//echo $curr_action;
			$curr_action = $command['action'];
			$actions[$command['command']] = $command['action'];
		}
		else if($command['command'] == 'CLOSE')
		{
			write_file($curr_file,$file_name);
			$curr_file = '';
			$curr_action = '';
			$file_name = '';
			$curr_action = $command['action'];
			$actions[$command['command']] = $command['action'];
		}
		else if($command['command'] == 'DIE')
		{
			break;
		}
	}

	rename($modfile,str_replace('.xmd','',$modfile).'.installed.xmd');
	return $actions;
}

function display_main($msg='')
{	
  	$mods = array();
	$modsAlready = array();
	$modsSorted = array();
	$fh = opendir('./admin/mods/');
	while ($file = readdir($fh))
	{
		if (stristr($file,'.xmd'))
		{
			if (stristr($file,'.installed.'))
			{			
				$modsAlready[] = str_replace('.installed.xmd','',$file);
			}
			else
			{
				$mods[] = str_replace('.xmd','',$file);
			}
		}
	}
	
	closedir ($fh);
	?>
<h1><span>Modification/Patch System</span>XtraFile :: Admin Panel</h1>
<div class="actionsMenu">
    <a onclick="$('#mods1').show();$('#mods2').hide();$('#mods3').hide();" href="javascript:;">
        <div class="item">
            <div class="img" style="background-image:url(../images/small/private.png);"></div>
            <div class="txt">Show Not Installed</div>
        </div>
    </a> 
    <a onclick="$('#mods1').hide();$('#mods2').show();$('#mods3').hide();"  href="javascript:;">
        <div class="item">
            <div class="img" style="background-image:url(../images/small/ok.png);"></div>
            <div class="txt">Show Installed</div>
        </div>
    </a> 
    <a onclick="$('#mods1').hide();$('#mods2').hide();$('#mods3').show();" href="javascript:;">
        <div class="item">
            <div class="img" style="background-image:url(../images/small/up.png);"></div>
            <div class="txt">Upload New Mod</div>
        </div>
    </a> 
</div><br />
<? if($msg){?>
	<p align="center"><font color="#FF0000"><b><?=$msg?></b></font></p>
<? }?>
<div id="mods1">
<table width="850" style="border:thin #000 solid" border="0" bordercolor="#000000" align="center" cellpadding="3" cellspacing="0">
  <tr>
    <th width="166">Mod Name </th>
    <th width="289">Description</th>
    <th width="228">Author</th>
    <th width="122">Version</th>
    <th width="74">Actions</th>
  </tr>
  <?
  
  foreach($mods as $mod)
  {
  $conf = get_config($mod.'.xmd');
  ?>
  <tr>
    <td><div align="center">
      <strong>
      <?=$conf['name']?>
      </strong> </div>
    <div align="center"></div></td>
    <td><div align="center">
      <strong>
      <?=$conf['description']?>
      </strong> </div>
    <div align="center"></div></td>
    <td><div align="center"><a href="<?=$conf['url']?>">
      <strong>
      <?=$conf['author']?>
      </strong> </a></div></td>
    <td><div align="center">
      <strong>
      <?=$conf['version']?>
      </strong> </div>
    <div align="center"></div></td>
    <td><div align="center"><a href="mod.php?install=<?=$mod?>">Install</a></div></td>
  </tr>
  <?
  }
  ?>
  
</table>
</div>
<div style="display:none" id="mods2">
<table width="850" style="border:thin #000 solid" bordercolor="#000000" align="center" cellpadding="3" cellspacing="0">
  <tr>
    <th width="166">Mod Name </th>
    <th width="289">Description</th>
    <th width="228">Author</th>
    <th width="122">Version</th>
    <th width="74">Actions</th>
  </tr>
  <? 
  
  foreach($modsAlready as $mod)
  {
  $conf = get_config($mod.'.installed.xmd');
  ?>
  <tr>
    <td><div align="center">
      <strong>
      <?=$conf['name']?>
      </strong> </div>
    <div align="center"></div></td>
    <td><div align="center">
      <strong>
      <?=$conf['description']?>
      </strong> </div>
    <div align="center"></div></td>
    <td><div align="center"><a href="<?=$conf['url']?>">
      <strong>
      <?=$conf['author']?>
      </strong> </a></div></td>
    <td><div align="center">
      <strong>
      <?=$conf['version']?>
      </strong> </div>
    <div align="center"></div></td>
    <td><div align="center"><a href="mod.php?revert=<?=$mod?>">Delete</a></div></td>
  </tr>
  <?
  }
  ?>
  
</table>
</div>
<div id="mods3" style="display:none"><br />
<center>
<h2>Upload XtraUpload-Mod Files</h2>
<form method="post" enctype="multipart/form-data" onsubmit="if(this.mod.value.length == 0){alert('Please select a file to upload.'); return false;}">
File: <input type="file" name="attached" id="mod" size="50"  />( .xmd files only!)<br /><br />
<input type="submit" value="Upload XMD File" />
</form>
</center>
</div>
	  <?
}


function delete_mod($modfile)
{
	// get config info for the mod file
	$file = get_config($modfile);
	
	// restore file in the backup folder
	$actions = restore_folder('cache/mods/',$file['name'].$file['version'].'/');
	
	// delete the mod backup folder
	delete_folder('cache/mods/'.$file['name'].$file['version']);
	
	//Rename mod file so it can be installed again
	rename('./admin/mods/'.$modfile,'./admin/mods/'.str_replace('.installed.xmd','',$modfile).'.xmd');
	
	// return the actions taken
	return $actions;
}

function delete_folder($folder)
{
	$fh = opendir($folder);
	if($fh)
	{
		while ($file = readdir($fh))
		{
			//echo $file.'<br />\n';
			if (($file != '..' && $file != '.'))
			{
				if(is_dir($folder.'/'.$file))
				{
					delete_folder($folder.'/'.$file);
				}
				else
				{
					unlink($folder.'/'.$file);
				}
			}
		}
		closedir ($fh);
		rmdir($folder);
	}
	else
	{
		echo "Can't delete folder:".$folder;
	}
}

function restore_folder($dir,$ver='',$version='')
{
	$files = array();
	$fh = opendir($dir.$ver);
	if($fh)
	{
		while ($file = readdir($fh))
		{
			//echo $file.'<br />\n';
			if (($file != '..' && $file != '.'))
			{
				if(is_dir($dir . $ver . '/' . $file))
				{
					if($ver != '')
					{
						$files = array_merge($files, restore_folder($dir.$ver.$file.'/', '',str_replace('/','',$ver)));
					}
					else
					{
						$s = explode('/',$dir);
						$s = $s[2];
						$files = array_merge($files, restore_folder($dir.$ver.$file.'/', '',$s));
					}
				}
				else
				{
					$rest = str_replace(array('cache/mods/',$version,'/backup/'),'',$dir.$ver.$file);
					//echo $version.' || '.$dir.$ver.$file.' => '.$rest.'<br />';
					if(filesize($dir.$ver.$file) == 0)
					{
						unlink($rest);
						$files[] = array('act' => 'deleted', 'file' => $rest);
					}
					else
					{
						$cont = file_get_contents($dir.$ver.$file);
						$fp = fopen($rest, 'w');
						fwrite($fp,$cont);
						fclose($fp);
						$files[] = array('act' => 'restored', 'file' => $rest);
					}
				}
			}
		}
		closedir ($fh);
		return $files;
	}
	else
	{
		echo "Folder ".$dir.'not valid!';
	}
}

function open_file($file,$config)
{
	$file_cont = '';
	$fp = fopen($file, 'r+');
	if($fp)
	{
		while(!feof($fp))
		{
			$file_cont .= fread($fp,1024);
		}
		fclose($fp);
		
		if(!is_dir('./cache/mods/'.$config['name'].$config['version']))
		{
			mkdir('./cache/mods/'.$config['name'].$config['version']);
		}
		
		if(!is_dir('./cache/mods/'.$config['name'].$config['version'].'/backup'))
		{
			mkdir('./cache/mods/'.$config['name'].$config['version'].'/backup');
		}
		$file_a = explode('/',str_replace('../','',$file));
		$file_c = '';
		foreach($file_a as $file_b)
		{
			if(!is_dir('./cache/mods/'.$config['name'].$config['version'].'/backup/'.$file_c))
			{
				mkdir('./cache/mods/'.$config['name'].$config['version'].'/backup/'.$file_c);
			}
			$file_c .= $file_b.'/';
		}
		if(file_exists('./cache/mods/'.$config['name'].$config['version'].'/backup/'.str_replace('../','',$file)))
		{
			unlink('./cache/mods/'.$config['name'].$config['version'].'/backup/'.str_replace('../','',$file));
		}
		$fp = fopen('./cache/mods/'.$config['name'].$config['version'].'/backup/'.str_replace('../','',$file),'x+');
		fwrite($fp,$file_cont);
		fclose($fp);
		return $file_cont;
	}
	else
	{
		return false;
	}
}


function create_file($file,$config)
{
	$file_cont = '';
	$fp = fopen($file, 'x');
	if($fp)
	{
		fclose($fp);
		
		if(!is_dir('./cache/mods/'.$config['name'].$config['version']))
		{
			mkdir('./cache/mods/'.$config['name'].$config['version']);
		}
		
		if(!is_dir('./cache/mods/'.$config['name'].$config['version'].'/backup'))
		{
			mkdir('./cache/mods/'.$config['name'].$config['version'].'/backup');
		}
		$file_a = explode('/',str_replace('../','',$file));
		$file_c = '';
		foreach($file_a as $file_b)
		{
			if(!is_dir('./cache/mods/'.$config['name'].$config['version'].'/backup/'.$file_c))
			{
				mkdir('./cache/mods/'.$config['name'].$config['version'].'/backup/'.$file_c);
			}
			$file_c .= $file_b.'/';
		}
		if(file_exists('./cache/mods/'.$config['name'].$config['version'].'/backup/'.str_replace('../','',$file)))
		{
			unlink('./cache/mods/'.$config['name'].$config['version'].'/backup/'.str_replace('../','',$file));
		}
		$fp = fopen('./cache/mods/'.$config['name'].$config['version'].'/backup/'.str_replace('../','',$file),'x+');
		fwrite($fp,$file_cont);
		fclose($fp);
		return $file_cont;
	}
	else
	{
		return false;
	}
}

function get_config($file)
{

	$config = array();
	$file = file('./admin/mods/'.$file);
	
	foreach($file as $buffer)
	{
		if(strstr($buffer,'####[@'))
		{
			$left_bracket = strpos($buffer, '####[@ ');
			$right_bracket = strpos($buffer, ': ');
			$left_of_bracket = substr($buffer, 0, $left_bracket);
			$right_of_bracket = substr($buffer, $right_bracket);

			$conf = strtolower(trim(substr($buffer, $left_bracket+7, (($right_bracket-7)-($left_bracket)))));
			$config[$conf] = '';
			
			
			$left_bracket = strpos($buffer, ': ');
			$right_bracket = strpos($buffer, ']##');
			$left_of_bracket = substr($buffer, 0, $left_bracket);
			$right_of_bracket = substr($buffer, $right_bracket);

			$config[$conf] = trim(substr($buffer, $left_bracket+2, (($right_bracket-2)-($left_bracket+1))));;
		}
	}
	return $config;
}

function write_file($data,$file)
{
	if(is_writable($file))
	{
		$fp = fopen($file, 'w');
		fwrite($fp, $data);
		//echo '<textarea>'.$data.'</textarea>';
		fclose($fp);
		return $file;
	}
	else
	{
		error('File('.$file.') Cannot be writen to. Please check file permissions.');
	}
}

function check_file_access($file)
{
	if(!is_writable($file))
	{
		error('File('.$file.') Cannot be writen to. Please check file permissions and ownership.');
	}
	
	if(!is_readable($file))
	{
		error('File('.$file.') Cannot be read. Please check file permissions and ownership.');
	}
}

function find($search,$file)
{
	$file = str_replace($search,'<!--{[XUMS]->FIND}-->',$file);
	//echo 'Find: <textarea>'.$file.'</textarea><br />';
	return $file;
}

function replace($replace,$file)
{
	$file = str_replace('<!--{[XUMS]->FIND}-->',$replace,$file);
	//echo 'Replace with: <textarea>'.$replace.'</textarea><br />';
	return $file;
}

function error($msg)
{
	echo 'Fatal Error Occured: '.$msg;
	include './admin/footer.php';
	die();
}

if(isset($_GET['install']))
{
	$actions = process_mod('./admin/mods/'.$_GET['install'].'.xmd');
	?>
	<p align="center" class="style1">Mod Installed Sucessfully!	</p>
	<div align="center">
	  <table width="600" border="1" cellpadding="3" cellspacing="0" bordercolor="#000000">
        <tr>
          <th width="111">Command</th>
          <th width="477">Action</th>
        </tr>
		<?
		foreach($actions as $com => $act)
		{
		?>
        <tr>
          <td><div align="center">
            <?=$com?>
          </div></td>
          <td>
            <div align="left">
              <textarea cols="30" rows="3"><?=$act?></textarea>
            </div></td>
        </tr>
		<?
		}
		?>
      </table>
      <br />
      <br />
<a href="mod.php">Back to Overview </a></div>
	<?
}
else if($_GET['revert'])
{
$files = delete_mod($_GET['revert'].'.installed.xmd');
?>
	<p align="center" class="style1">Mod Uninstalled Sucessfully!	</p>
	<div align="center">
	  <table width="600" border="1" cellpadding="3" cellspacing="0" bordercolor="#000000">
        <tr>
          <th width="111">Action</th>
		  <th width="111">File</th>
        </tr>
		<?
		foreach($files as $file)
		{
		?>
        <tr>
          <td><div align="center">
            <?=$file['act']?>
          </div></td>
          <td><div align="center">
            <?=$file['file']?>
          </div></td>
        </tr>
		<?
		}
		?>
      </table>
      <br />
      <br />
<a href="mod.php">Back to Overview </a></div>
<?
}
else if($_FILES['attached']['name'] != '')
{
	move_uploaded_file($_FILES['attached']['tmp_name'], './admin/mods/'.$_FILES['attached']['name']);
	display_main('Mod File('.$_FILES['attached']['name'].') Uploaded!');
}
else
{
	display_main();
}

include("admin/footer.php");
?>