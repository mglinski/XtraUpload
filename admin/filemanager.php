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
	
if(!isset($_GET['act']))
{
	$_GET['act'] = '';
}
	
$pageno = 0;
if(isset($_REQUEST['pageno']))
{
	$pageno = $_REQUEST['pageno'];
}
if($pageno == '')
{
	$pageno = 0;
}

$limit = 50;
if(isset($_REQUEST['limit']) && intval($_REQUEST['limit']) > 0)
{
	$limit = intval($_REQUEST['limit']);
}

if($limit == '')
{
	$limit = 50;
}

$noMain = false;

if(isset($_GET['edit']))
{
	if($_POST['submit'] == 'Submit Changes')
	{
		$db->query("UPDATE files SET
		`o_filename` = '".txt_clean($_POST['sfilename'])."',
		`password` = '".txt_clean($_POST['spassword'])."',
		`description` = '".txt_clean($_POST['sdescription'])."',
		`downloads` = '".intval($_POST['sdownloads'])."',
		`approved` = '".intval($_POST['approved'])."',
		`featured` = '".intval($_POST['featured'])."',
		`ban` = '".intval($_POST['ban'])."',
		`user` = '".intval($_POST['suser'])."'
		WHERE id='".intval($_GET['file'])."'");
		$msg = "File Settings Changed";
		log_action('File('.txt_clean($_POST['sfilename']).') Edited', 'file:edit', 'The file('.txt_clean($_POST['sfilename']).') was edited', 'ok', 'admin/filemanager.php');
		
	}
	else
	{
		$c = $db->query("select * from files where id='".intval($_GET['file'])."' LIMIT 1");
		$d = $db->fetch($c,'obj');
		$cfilename = $d->o_filename;
		$cpassword = $d->password;
		$cdescription = $d->description;
		$cdownloads = $d->downloads;
		$capproved = $d->approved;
		$cban = $d->ban;
		$cuser = $d->user;
		$featured = $d->featured;
		?>
	
	<h1><span>File Manager - Edit File</span>XtraFile :: Admin Panel</h1>
    <div class="actionsMenu">
      <a href="filemanager.php?report=1&amp;byall=1">
      <div class="item">
        <div class="img" style="background-image:url(../images/small/back.png);"></div>
        <div class="txt">Return To List</div>
      </div>
      </a> 
    </div>
	<form method='post'>
	  <br />
	  <br />
	  <table height="29%" border="0" align="center" cellpadding="1" cellspacing="1">
		<tr align=center>
		  <td height="6%" colspan=2 class="style1"><b>Edit file details and then click the submit button below.</b></td>
		</tr>
		<tr>
		  <td height="22" align=right class="style1">Filename:</td>
		  <td class="style1"><input name='sfilename' type=text class="style1" value='<?=$cfilename?>' size=35 >
		  </td>
		</tr>
		<tr>
		  <td height="22" align=right class="style1">Password:</td>
		  <td class="style1"><input name='spassword' type=text class="style1" value='<?=$cpassword?>' size=35 >
		  </td>
		</tr>
		<tr>
		  <td height="22" align=right class="style1">Description:</td>
		  <td class="style1"><input name='sdescription' type=text class="style1" value='<?=$cdescription?>' size=35 >
		  </td>
		</tr>
		<tr>
		  <td height="22" align=right class="style1">Downloads:</td>
		  <td class="style1"><input name='sdownloads' type=text class="style1" value='<?=$cdownloads?>' size=35>
		  </td>
		</tr>
		<tr>
		  <td height="22" align=right class="style1">Banned?</td>
		  <td class="style1"><p>
			  <input name="ban" type="radio" <? if($cban){echo "checked='checked'";}?> value="1" />
			  Yes<br />
			  <input name="ban" type="radio" <? if(!$cban){echo "checked='checked'";}?> value="0" />
			  No</p></td>
		</tr>
		<tr>
		  <td height="22" align=right class="style1">Approved?</td>
		  <td class="style1"><p>
			  <input name="approved" type="radio" <? if($capproved){echo "checked='checked'";}?> value="1" />
			  Yes<br />
			  <input name="approved" type="radio" <? if(!$capproved){echo "checked='checked'";}?> value="0" />
			  No</p></td>
		</tr>
		<tr>
		  <td height="22" align=right class="style1">Featured?</td>
		  <td class="style1"><p>
			  <input name="featured" type="radio" <? if($featured){echo "checked='checked'";}?> value="1" />
			  Yes<br />
			  <input name="featured" type="radio" <? if(!$featured){echo "checked='checked'";}?> value="0" />
			  No</p></td>
		</tr>
		<td height="22" align=right class="style1">User: </td>
		  <td class="style1"><select name="suser">
			  <? 
		$ff = $db->query("SELECT * FROM users");
		while($gr = $db->fetch($ff,'obj'))
		{?>
			  <option value="<?=$gr->uid?>" <? if($gr->uid == $cuser){?>selected="selected"<? }?>>
			  <?=$gr->username?>
			  </option>
			  <? }?>
			</select>
		  </td>
		</tr>
		<tr>
		  <td height="12%"></td>
		  <td class="style1"><input name=submit type=submit class="style1" value='Submit Changes'></td>
		</tr>
	  </table>
	</form>
	<?
	$noMain = true;
	}
}


if(!$noMain)
{
	if($_GET['act'] == 'del')
	{
		if(isset($_POST['massCheck']))
		{
			$i=0;
			foreach($_POST['massCheck'] as $id)
			{
				delfile(intval($id));
				$i++;
			}
			$msg = $i. 'Files Were Deleted!';
			$i=0;
		}
		else
		{
			$msg = delfile(intval($_GET['id']));
		}
	}
	
	if($_GET['act'] == 'approve')
	{
		if(isset($_POST['massCheck']))
		{
			$i=0;
			foreach($_POST['massCheck'] as $id)
			{
				$id = intval($id);
				$sql = "SELECT * FROM files WHERE id='".$id."'";
				$qr1 = $db->query($sql);
				$row = $db->fetch($qr1,'obj');
				$db->query("UPDATE files SET `approved` = '1' WHERE id='".$id."'");
				log_action('File('.$row->o_filename.') Approved', 'file:edit', 'The file('.$row->o_filename.') was edited', 'ok', 'admin/filemanager.php');
				$i++;
			}
			$msg = $i. ' Files Were Approved!';
			$i=0;
		}
		else
		{
			$sql = "SELECT * FROM files WHERE id='".intval($_GET['id'])."'";
			$qr1 = $db->query($sql);
			$row = $db->fetch($qr1,'obj');
			$db->query("UPDATE files SET `approved` = '1' WHERE id='".intval($_GET['id'])."'");
			log_action('File('.$row->o_filename.') Approved', 'file:edit', 'The file('.$row->o_filename.') was edited', 'ok', 'admin/filemanager.php');
			$msg = 'File Was Approved!';
		}
	}
	
	if($_GET['act'] == 'ban')
	{
		if(isset($_POST['massCheck']))
		{
			$i=0;
			foreach($_POST['massCheck'] as $id)
			{
				$id = intval($id);
				$sql = "SELECT * FROM files WHERE id='".$id."'";
				$qr1 = $db->query($sql);
				$row = $db->fetch($qr1,'obj');
				$db->query("UPDATE files SET `ban` = '1' WHERE id='".intval($_GET['ban'])."'");
				log_action('File('.$row->o_filename.') Banned', 'file:ban', 'The file('.$row->o_filename.') was Banned', 'warn', 'admin/filemanager.php');
				delfile(intval($_GET['id']),false);
				$i++;
			}
			$msg = $i. 'Files Were Banned and Deleted!';
			$i=0;
		}
		else
		{
			$sql = "SELECT * FROM files WHERE id='".intval($_GET['id'])."'";
			$qr1 = $db->query($sql);
			$row = $db->fetch($qr1,'obj');
			$db->query("UPDATE files SET `ban` = '1' WHERE id='".intval($_GET['id'])."'");
			log_action('File('.$row->o_filename.') Banned', 'file:ban', 'The file('.$row->o_filename.') was Banned', 'warn', 'admin/filemanager.php');
			delfile(intval($_GET['ban']),false);
			$msg = 'File Was Banned and Deleted!';
		}
	}
	
	if($_GET['act'] == 'unban')
	{
		if(isset($_POST['massCheck']))
		{
			$i=0;
			foreach($_POST['massCheck'] as $id)
			{
				$id = intval($id);
				$sql = "SELECT * FROM files WHERE id='".$id."'";
				$qr1 = $db->query($sql);
				$row = $db->fetch($qr1,'obj');
				$db->query("UPDATE files SET `ban` = '0' WHERE id='".$id."'");
				log_action('File('.$row->o_filename.') UnBanned', 'file:unban', 'The file('.$row->o_filename.') was Unbanned', 'ok', 'admin/filemanager.php');
				$i++;
			}
			$msg = (string)$i." File(s) were Unbanned";
			$i=0;
		}
		else
		{
			$sql = "SELECT * FROM files WHERE id='".intval($_GET['id'])."'";
			$qr1 = $db->query($sql);
			$row = $db->fetch($qr1,'obj');
			$db->query("UPDATE files SET `ban` = '0' WHERE id='".intval($_GET['id'])."'");
			log_action('File('.$row->o_filename.') UnBanned', 'file:unban', 'The file('.$row->o_filename.') was UnBanned', 'ok', 'admin/filemanager.php');
			$msg = "File Was Unbanned";
		}
	}
	
	if($_GET['act'] == 'dismiss')
	{
		if(isset($_POST['massCheck']))
		{
			$i=0;
			foreach($_POST['massCheck'] as $id)
			{
				$sql = "SELECT * FROM files WHERE id='".$id."'";
				$qr1 = $db->query($sql);
				$row = $db->fetch($qr1,'obj');
				$db->query("UPDATE files SET `report` = '0' WHERE id='".$id."'");
				log_action('File('.$row->o_filename.') Report Removed', 'report:dismiss', 'The file('.$row->o_filename.') had its report removed.', 'ok', 'admin/filemanager.php');
				$msg = "File Report Was Dismissed!";
		
				$i++;
			}
			$msg = $i." File Reports Were Dismissed!";
			$i=0;
		}
		else
		{
			$sql = "SELECT * FROM files WHERE id='".intval($_GET['id'])."'";
			$qr1 = $db->query($sql);
			$row = $db->fetch($qr1,'obj');
			$db->query("UPDATE files SET `report` = '0' WHERE id='".intval($_GET['id'])."'");
			log_action('File('.$row->o_filename.') Report Removed', 'report:dismiss', 'The file('.$row->o_filename.') had its report removed.', 'ok', 'admin/filemanager.php');
			$msg = "File Report Was Dismissed!";
		}
	}

?>
<script>
		function gotocluster(s)
		{
			var d = s.options[s.selectedIndex].value
			self.location.href=d;
		}
	</script>
<?
	if (!(isset($_REQUEST['start_m'])))
	{
		$starttime = time();
		$start_y = date("Y",$starttime);
		$start_d = date("d",$starttime);
		$start_m = date("m",$starttime);
	}
	
	if(isset($_REQUEST['start_y']))
	{
		$start_y = $_REQUEST['start_y'];
	}
	
	if(isset($_REQUEST['start_d']))
	{
		$start_d = $_REQUEST['start_d'];
	}
	
	if(isset($_REQUEST['start_m']))
	{
		$start_m = $_REQUEST['start_m'];
	}
	
	if(isset($_REQUEST['starttime']))
	{
		$starttime = $_REQUEST['starttime'];
	}
	
	if (!(isset($_REQUEST['end_m'])))
	{
		$endtime = time();
		$end_y = date("Y",$endtime);
		$end_d = date("d",$endtime);
		$end_m = date("m",$endtime);
	}
	
	if(isset($_REQUEST['end_y']))
	{
		$end_y = $_REQUEST['end_y'];
	}
	
	if(isset($_REQUEST['end_d']))
	{
		$end_d = $_REQUEST['end_d'];
	}
	
	if(isset($_REQUEST['end_m']))
	{
		$end_m = $_REQUEST['end_m'];
	}
	
	if(isset($_REQUEST['endtime']))
	{
		$endtime = $_REQUEST['endtime'];
	}
?>
<h1><span><? if(isset($_GET['byban'])){?>Banned <? }?>File Manager</span>XtraFile :: Admin Panel</h1>
<div class="actionsMenu">
  <? if(isset($_GET['byban'])){?>
  <a href="#" onclick="massForm.action = './filemanager.php?report=1&amp;byban=1&amp;act=unban'; massForm.submit();">
  <div class="item">
    <div class="img" style="background-image:url(../images/small/unlock.png);"></div>
    <div class="txt">Unban File(s)</div>
  </div>
  </a>
  <? }else{?>
  <a href="#" onclick="massForm.action = './filemanager.php?report=1&amp;byban=1&amp;act=ban'; massForm.submit();">
  <div class="item">
    <div class="img" style="background-image:url(../images/small/private.png);"></div>
    <div class="txt">Ban File(s)</div>
  </div>
  </a>
    <a href="#" onclick="massForm.action = './filemanager.php?report=1&amp;byall=1&amp;act=del'; massForm.submit();">
  <div class="item">
    <div class="img" style="background-image:url(../images/small/close.png);"></div>
    <div class="txt">Delete File(s)</div>
  </div>
  </a> 
  <a href="#" onclick="massForm.action = './filemanager.php?report=1&amp;byappr=1&amp;act=approve'; massForm.submit();">
  <div class="item">
    <div class="img" style="background-image:url(../images/small/ok.png);"></div>
    <div class="txt">Approve File(s)</div>
  </div>
  </a>
  <? }?>
  <div class="spacer"></div>
   <? if(!isset($_GET['byappr'])){?>
  <a href="filemanager.php?report=1&amp;byappr=1">
  <div class="item">
    <div class="img" style="background-image:url(../images/small/go.png);"></div>
    <div class="txt">Featured</div>
  </div>
  </a>
  <? }?>
  <? if(!isset($_GET['byrepo'])){?>
  <a href="filemanager.php?report=1&amp;byrepo=1">
  <div class="item">
    <div class="img" style="background-image:url(../images/small/public.png);"></div>
    <div class="txt">Reported</div>
  </div>
  </a>
  <? }?>
  <? if(!isset($_GET['byban'] )){?>
  <a href="filemanager.php?report=1&amp;byban=1">
  <div class="item">
    <div class="img" style="background-image:url(../images/small/stop.png);"></div>
    <div class="txt">Banned</div>
  </div>
  </a>
  <? }
  if(!isset($_GET['byall']) ){?>
  <a href="filemanager.php?report=1&amp;byall=1">
  <div class="item">
    <div class="img" style="background-image:url(../images/small/hard_disk.png);"></div>
    <div class="txt">All Files</div>
  </div>
  </a> 
  <? }?>
  <? if(isset($_POST['report']) and ($_POST['report'] == 'Sort By Date' or $_POST['report'] == 'Search Files') and !isset($_GET['byban'])){?>
  <a href="filemanager.php?report=1&amp;byall=1">
  <div class="item">
    <div class="img" style="background-image:url(../images/small/hard_disk.png);"></div>
    <div class="txt">All Files</div>
  </div>
  </a> 
  <? }?>
  
  <div class="spacer"></div>
  <a href="#" onclick="showSearchForm()">
  <div class="item">
    <div class="img" style="background-image:url(../images/small/search.png);"></div>
    <div class="txt">Search</div>
  </div>
  </a> 
  <a href="#" onclick="showSortForm()">
  <div class="item">
    <div class="img" style="background-image:url(../images/small/calendar.png);"></div>
    <div class="txt">Sort</div>
  </div>
  </a> </div>
<br />
<? if(isset($msg) and $msg != ''){?>
<div id="msgBox" class="msgBox"> <img class="okImg" src="../images/actions/OK_24x24.png" alt="Ok!"  /> <span>
  <?=$msg?>
  </span> <a href="javascript:;" onclick="hideMsgBox()"> <img class="closeImg" src="../images/small/Close.png" alt="Close"  /> </a> </div>
<? }?>
<br />
<table width="100%" border="0" align="center">
  <tr>
    <td><form method="POST" action="filemanager.php">
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" id="sortForm" style="display:none">
          <tr valign="top">
            <td width="15%"><p align="center">Choose Dates:<br />
                <!-- add writecombo date here -->
                <? writeCombo($month_values, "start_m",$start_m);?>
                /
                <? writeCombo($day_values, "start_d",$start_d);?>
                /
                <input name="start_y" type="text" size="4" maxlength="4" value="<?=$start_y?>" />
                -to-
                <? writeCombo($month_values, "end_m",$end_m);?>
                /
                <? writeCombo($day_values, "end_d",$end_d);?>
                /
                <input name="end_y" type="text" size="4" maxlength="4" value="<?=$end_y?>" />
              </p>
              <center>
        	<input type="submit" name="report" value="Sort By Date" id="report1"/>
        </center></td>
          </tr>
        </table>
        <table width="617" border="0" align="center" id="searchForm" style="display:none">
          <tr>
            <td width="617"><div align="center">Search by Filename, File Hash, and Descriptions<br />
              </div>
              <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0">
                <tr valign="top">
                  <td width="35%"><p align="center"> Search:
                      <input name="search" type="text" id="search" size="50" />
                    </p>
                    <center>
        	<input type="submit" name="report" value="Search Files" id="report2"/>
        </center></td>
                </tr>
              </table>
              </td>
          </tr>
        </table>
        <table width="890" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="890"><input type='hidden' name='start_m' value='<?=$start_m?>' />
              <input type='hidden' name='start_d' value='<?=$start_d?>' />
              <input type='hidden' name='start_y2' value='<?=$start_y?>' />
              <input type='hidden' name='end_m' value='<?=$end_m?>' />
              <input type='hidden' name='end_d' value='<?=$end_d?>' />
              <input type='hidden' name='end_y' value='<?=$end_y?>' />
            </td>
          </tr>
        </table>
      </form>
      
      <form method="post" id="massForm">
        <?php
		
			$stime = mktime(0,0,0,$start_m,$start_d,$start_y);
			$etime = mktime(23,59,59,$end_m,$end_d,$end_y);
			
			
			if(isset($_REQUEST['byip']))
			{
				$sql = "SELECT * FROM files WHERE ipaddress='$_REQUEST[byip]' AND status='1' AND `ban` != '1'  ORDER BY `id` DESC";
			}
			else if(isset($_REQUEST['byuid']))
			{
				$sql = "SELECT * FROM files WHERE user='$_REQUEST[byuid]' AND status='1' AND `ban` != '1'  ORDER BY `id` DESC";
			}
			else if(isset($_REQUEST['byall']))
			{
				$sql = "SELECT * FROM files WHERE status='1' AND `ban` != '1'  ORDER BY `id` DESC";
			}
			else if(isset($_REQUEST['byrepo']))
			{
				$sql = "SELECT * FROM files WHERE status='1' AND `report` = '1'  ORDER BY `id` DESC";
			}
			else if(isset($_REQUEST['byappr']))
			{
				$sql = "SELECT * FROM files WHERE status='1' AND `approved` = '1'  ORDER BY `id` DESC";
			}
			else if(isset($_REQUEST['byban']))
			{
				$sql = "SELECT * FROM files WHERE ban = '1'  ORDER BY `id` DESC";
			}
			else if(isset($_REQUEST['search']) && $_REQUEST['search'] != '')
			{
				$result = $db->query('SELECT VERSION()');
				$mysql_version = $db->fetch($result,"alpha");
				$mysql_version = $mysql_version['VERSION()'];
	
				$use_boolean = version_compare($mysql_version, '4.0.2', '>=');
		
				if ($use_boolean)
				{
					$sql = 'SELECT * FROM files WHERE MATCH (filename,hash,description,o_filename) AGAINST ("'.$_REQUEST['search'].'" IN BOOLEAN MODE)  AND status=\'1\'  ORDER BY `id` DESC';	
				}
				else
				{
					$sql = 'SELECT * FROM files WHERE MATCH (filename,hash,description,o_filename) AGAINST ("'.$_REQUEST['search'].'")  AND status=\'1\'  ORDER BY `id` DESC';	
				}
			}
			else if(isset($_REQUEST['end_d']))
			{
				$sql = "SELECT * FROM files WHERE date >= $stime AND date <= $etime AND status='1' ORDER BY `id` DESC";
			}
			else
			{
				$sql = "SELECT * FROM files WHERE status='1' AND `ban` != '1' ORDER BY `id` DESC";
			}
			
			$qr1 = $db->query($sql." LIMIT ".($pageno * $limit).",".$limit."");
			$realRet = $db->query($sql);
			$realRetNum = $db->num($realRet);
			$rowcount = $db->num($qr1);
			$pagecount = ceil($realRetNum / $limit);
			?>
            <br /><b><font color=red>Number of files<? if(isset($_POST['report']) and ($_POST['report'] == 'Sort By Date' or $_POST['report'] == 'Search Files') and !isset($_GET['byban'])){?> found<? }?>: 
            (<?=((int)$pageno*(int)$limit).'-'.($limit < $realRetNum ? (((int)$pageno+1)*(int)$limit):$realRetNum)?>) of <?=$realRetNum?></font></b>
			<br /><br><?
			if(isset($_REQUEST['byip']))
			{
				$purl = "filemanager.php?report=1&byip=".$_REQUEST['byip'];
			}
			else if(isset($_REQUEST['byall']))
			{
				$purl = "filemanager.php?report=1&byall=1";
			}
			else if(isset($_REQUEST['byban']))
			{
				$purl = "filemanager.php?report=1&byban=1";
			}
			else if(isset($_REQUEST['byuid']))
			{
				$purl = "filemanager.php?report=1&byuid=".$_REQUEST['byip'];
			}
			else if(isset($_REQUEST['search']) && $_REQUEST['search'] != '')
			{
				$purl = "filemanager.php?report=1&search=".urlencode($_REQUEST['search']);
			}
			else if(isset($_REQUEST['end_d']))
			{
				$purl = "filemanager.php?report=1&start_m=".$start_m."&start_d=".$start_d."&start_y=".$start_y."&end_m=".$end_m."&end_d=".$end_d."&end_y=".$end_y;
			}
			else
			{
				$purl = "filemanager.php?report=1&byall=1";
			}
			?>
        <br />
        <table align='center' id="mainTable" style='border:thin #000 solid' width='892' border='0' cellpadding='0' cellspacing='0'>
          <tr>
            <th style="border-right:1px #000000 solid;border-bottom:1px #000000 solid;" >
              <input type="checkbox" name="mass" value="" onchange="if(this.checked){$('input[@type=checkbox]','#mainTable').attr('checked','checked');}else{$('input[@type=checkbox]','#mainTable').attr('checked','');}" />
            </th>
            <th style="border-bottom:1px #000000 solid;">Name</th>
            <th style="border-bottom:1px #000000 solid;">Uploader</th>
            <th style="border-bottom:1px #000000 solid;">Server</th>
            <th style="border-bottom:1px #000000 solid;">Upload Time</th>
            <th style="border-bottom:1px #000000 solid;">Actions</th>
          </tr>
          <?
			$i1 = 0;
			$i=0;
			while( $a = $db->fetch($qr1,'obj') )
			{
				if($rewrite_links == '1')
				{
					$filen = $siteurl."/files/".$a->hash;
				}
				else
				{
					$filen = $siteurl."/download.php?hash=".$a->hash;
				}
				
				$filen = str_replace('http://','%%',$filen);
				$filen = str_replace('//','/',$filen);
				$filen = str_replace('%%','http://',$filen);
				if($i%2 == 0)
				{
					$bgcolor = '#F2FDFF';
				}
				else
				{
					$bgcolor = 'transparent';
				}
				$i++;
				if(!$a->approved && $a->featured)
				{
					$bgcolor = "#FDEDC8";	
				}
				
				
				?>
          <tr style='background-color:<?=$bgcolor?>' onmouseover="this.style.backgroundColor = '#C1DEF0'" onmouseout="this.style.backgroundColor = '<?=$bgcolor?>'">
            <td style="border-right:1px #000000 solid;" width='27'><div align="center"><input name="massCheck[ ]" type="checkbox" value="<?=$a->id?>" /></div></td>
            <td width='312'><center>
                <?=elipsis($a->o_filename)?>
              </center></td>
            <td width='139' ><center>
                <?
				  
				if($a->user)
				{
					list($username) = $db->fetch( $db->query("SELECT username FROM users WHERE uid='".$a->user."'"),'assoc');
					echo "		<a href='filemanager.php?byuid=".$a->user."&report=1'>".$username."</a><br>";
				}
				else
				{
					echo " <a href='filemanager.php?byip=".$a->ipaddress."&report=1'>".$a->ipaddress."</a>";
				} 
				?>
              </center></td>
            <td width='149' ><center>
                <?
					echo $a->server;
				?>
              </center></td>
            <td width='150'><div align='center'>
                <?=inputDate($a->date)?>
              </div></td>
            <td width='139'><center>
                <table>
                  <tr>
                  <? if($a->ban == '1')
						{
						?>
                  <td><a href='<?=$purl?>&pageno=<?=$pageno?>&act=unban&id=<?=$a->id?>' onclick='return confirm(\"Are You Sure You Want To UnBan This File?\");'> <img border='0' id='ban_<?=$i1?>' alt='Ban File' src='../images/actions/Unlocked_24x24.png' /> </a> </td>
                    <?
						}
						else
						{
						?>
						
						<td><a href='<?=makeXuLink('index.php','p=download&hash='.$a->hash)?>'> <img border='0' id='delete_<?=$i1?>' alt='Approve File' src='../images/actions/Harddisk (Download)_24x24.png' /> </a> </td>
						<td><a href='filemanager.php?edit=1&file=<?=$a->id?>'> <img border='0' id='edit_<?=$i1?>' alt='Edit File' src='../images/actions/Edit_24x24.png' /> </a> </td>
						<?
							if($a->approved != '1' && $a->featured)
							{
							?>
						<td><a href='<?=$purl?>&pageno=<?=$pageno?>&act=approve&id=<?=$a->id?>' onclick='return confirm(\"Are You Sure You Want To Approve This File?\");'> <img border='0' id='delete_<?=$i1?>' alt='Approve File' src='../images/actions/OK_24x24.png' /> </a> </td>
						<?
							}
							?>
							<td><a href='<?=$purl?>&pageno=<?=$pageno?>&act=ban&id=<?=$a->id?>' onclick='return confirm(\"Are You Sure You Want To Ban This File?\");'> <img border='0' id='unban_<?=$i1?>' alt='Ban File' src='../images/med/private_24.png' /> </a> </td>
							<?
							if($a->report == '1')
							{
							?>
						<td><a href='<?=$purl?>&pageno=<?=$pageno?>&act=dismiss&id=<?=$a->id?>' onclick='return confirm(\"Are You Sure You Want To Dismiss This Report?\");'> <img border='0' id='dismiss_<?=$i1?>' alt='Dismiss Report' src='../images/actions/Bookmark (Remove)_24x24.png' /> </a> </td>
					  </tr>
					  <?
							}
							?>
						<td><a href='<?=$purl?>&pageno=<?=$pageno?>&act=del&id=<?=$a->id?>' onclick='return confirm(\"Are You Sure You Want To Delete This File?\");'> <img border='0' id='delete_<?=$i1?>' alt='Delete File' src='../images/actions/Close_24x24.png' /> </a> </td>
                    <? }?>
                  </tr>
                </table>
              </center></td>
          </tr>
          <?
				$i1++;
					
			}

			$pageInfo = array();
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
					$pageInfo[$i]['page'] = $i;
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
			?>
        </table>
        <div class="pagination" align="center">
        <hr  />
        <? 
		if($pageno >= 1)
		{
			?>
        <a href="javascript: newPage(<?=($pageno-1)?>);" class="nextprev" title="Go to Previous Page">&laquo; Previous</a>
        <? 
		}
		else
		{
			?>
        <span class="nextprev">&laquo; Previous</span>
        <? 
		}?>
        <? 
  
  for($i=0;count($pageInfo) > $i; $i++)
  	{
		if ($pageInfo[$i]['type'] == 'link')
		{
			?>
        <a href="javascript: newPage(<?=$pageInfo[$i]['page']?>);">
        <?=($pageInfo[$i]['page']+1)?>
        </a>
        <? 
		}
		elseif($pageInfo[$i]['type'] == 'elip')
		{
			?>
        <span>….</span>
        <? 
		}
		elseif($pageInfo[$i]['type'] == 'none')
		{
			?>
        <span class="current">
        <?=($pageInfo[$i]['page']+1)?>
        </span>
        <? 
		} 
	}
	?>
        <? 
    if( ($pageno + 1) != $pagecount)
    {
    	?>
        <a href="javascript:newPage(<?=$pageno+1?>);" class="nextprev" title="Go to Next Page">Next &raquo;</a>
        <? 
    }
    else
    {
    	?>
        <span class="nextprev">Next &raquo</span>
        <? 
    }
    ?>
      </form>
      <form id="pagination1" method="post">
        <input type="hidden" id="pageno" name="pageno" />
        <div style="float:right"># Per Page:
          <input size="2" type="text" name="limit" value="<?=$limit?>" />
          <br />
          <input type="submit" value="Get Results"  />
        </div>
      </form>
      </div>
      <br />
    </td>
  </tr>
</table>
<script>
function newPage(page)
{
	var form = $('#pagination1').get(0); 
	$('#pageno').attr('value',page);
	form.submit();
}
<? if(strlen($msg)){?>
function hideMsgBox()
{
	$('#msgBox').slideUp('normal');
}
setTimeout('hideMsgBox()', 20000);
<? }?>
var massForm = $('#massForm').get(0);

function showSortForm()
{
	if($('#searchForm').css('display') != '')
	{
		$('#searchForm').slideUp('normal');
	}
	$('#sortForm').toggle('normal');
}

function showSearchForm()
{
	if($('#sortForm').css('display') != '')
	{
		$('#sortForm').slideUp('normal');
	}
	$('#searchForm').toggle('normal');
}
</script>
<?

}
include("admin/footer.php");
?>
