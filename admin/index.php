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

chdir("..");
include("./include/init.php");
require_once("admin/accesscontrol.php");
require_once("admin/header.php");

list($users) = $db->fetch( $db->query("SELECT COUNT(*) FROM users"),'NUM');
list($files) = $db->fetch( $db->query("SELECT COUNT(*) FROM `files` WHERE `status` = '1' "),'NUM');
list($afiles) = $db->fetch( $db->query("SELECT COUNT(*) FROM files WHERE user='0'"),'NUM');
list($ufiles) = $db->fetch( $db->query("SELECT COUNT(*) FROM files WHERE user!='0'"),'NUM');
?>
<style type="text/css">
<!--
.style2 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 18px;
	font-weight: bold;
}
.style5 {
	font-size: 12px;
	color: #FF0000;
}
.style6 {color: #000000}
.style7 {font-size: 14px}
.style8 {font-size: 18px; font-family: Verdana, Arial, Helvetica, sans-serif;}
-->
</style>
<h1><span>Home</span>XtraFile :: Admin Panel</h1>      
<? 
	$kernel->loadUserExt('version');
	if(!XU_VERSION_CHECK)
	{
		$r_version = $version;
	}
	else
	{
		$r_version = parseVersion($kernel->ext->version->version);
	}
	
	if($version < $r_version)
	{ 
	?>
      <center>
      <div align="center" style="width:400px;">
      <fieldset>
      <legend class="warning"> XtraUpload Version Notice </legend>
      <span class="style2"><span class="style5"><span class="style7"><img src="large/caution_64x64.png" width="64" height="64" border="0" /><br />
            WARNING!!! </span><br />
            </span></span><span class="style8"><span class="style5"><strong>Your version of XtraUpload is out of date! </strong> <br />
            <span class="style6"><a href="http://www.xtrafile.com/downloads/XtraUpload_1.5.X/index.php">Please click here to update to the new version </a></span></span></span>
        </fieldset>
<br />
            </div>
            </center>
	  		<? } ?>
      <br />
      
     
<fieldset>
         <legend> Recent File Uploads </legend>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="0">
      <tr>
                <th>Name                </th>
                <th>Size</th>
                <th>Uploader</th>
                <th>Exists</th>
                <th>Actions</th>
              </tr>
              <? 
			$sql = "SELECT * FROM files WHERE `status` = '1' ORDER BY `id` DESC LIMIT 5";
			$qr1 = $db->query($sql);
			$i1=0;
			while( $a = $db->fetch($qr1,'obj') )
			{ 
				?>
		      <tr onmouseover="this.style.backgroundColor = '#C1DEF0'" onmouseout="this.style.backgroundColor = ''">
                <td width="49%" height="27">
                    <div align="center">
                      <?
;
				if(check_file_bool($a->hash))
				{
					echo $a->o_filename;
				}
				else
				{
					?>
                          <b><font size="2">
                            <?=$lang['editimg']['8']?>
                            </font></b>
                        <?
				}
					?>
                      </div></td>
		        <td width="12%"><div align="center"><?=get_filesize_prefix($a->size);?></div></td>
		        <td width="13%"><div align="center"><? 
				if($a->user == '0')
				{
					echo $a->ipaddress;
				}
				else
				{
					$user = $db->fetch($db->query("SELECT * FROM users WHERE uid = '".$a->user."'"), 'obj');
					echo $user->username;
				}?></div></td>
		        <td width="9%"><div align="center">
		          <?=check_file($a->hash);?>
		        </div></td>
		        <td valign="middle">
                <table>
                  <tr>
					<? if($a->ban == '1')
						{
						?>
                  <td><a href='filemanager.php?report=1&amp;&act=unban&id=<?=$a->id?>' onclick='return confirm(\"Are You Sure You Want To UnBan This File?\");'> <img border='0' id='ban_<?=$i1?>' alt='Ban File' src='../images/actions/Unlocked_16x16.png' /> </a> </td>
                    <?
						}
						else
						{
						?>
						
						<td><a href='<?=makeXuLink('index.php','p=download&hash='.$a->hash)?>'> <img border='0' id='delete_<?=$i1?>' alt='Approve File' src='../images/actions/Harddisk (Download)_16x16.png' /> </a> </td>
						<td><a href='filemanager.php?edit=1&amp;file=<?=$a->id?>'> <img border='0' id='edit_<?=$i1?>' alt='Edit File' src='../images/actions/Edit_16x16.png' /> </a> </td>
						<?
							if($a->approved != '1' && $a->featured)
							{
							?>
						<td><a href='filemanager.php?report=1&amp;&act=approve&id=<?=$a->id?>' onclick='return confirm(\"Are You Sure You Want To Approve This File?\");'> <img border='0' id='delete_<?=$i1?>' alt='Approve File' src='../images/actions/OK_16x16.png' /> </a> </td>
						<?
							}
							?>
							<td><a href='filemanager.php?report=1&amp;&act=ban&id=<?=$a->id?>' onclick='return confirm(\"Are You Sure You Want To Ban This File?\");'> <img border='0' id='unban_<?=$i1?>' alt='Ban File' src='../images/small/private.png' /> </a> </td>
							<?
							if($a->report == '1')
							{
							?>
						<td><a href='filemanager.php?report=1&amp;&act=dismiss&id=<?=$a->id?>' onclick='return confirm(\"Are You Sure You Want To Dismiss This Report?\");'> <img border='0' id='dismiss_<?=$i1?>' alt='Dismiss Report' src='../images/actions/Bookmark (Remove)_16x16.png' /> </a> </td>
					  </tr>
					  <?
							}
							?>
						<td><a href='filemanager.php?report=1&amp;&act=del&id=<?=$a->id?>' onclick='return confirm(\"Are You Sure You Want To Delete This File?\");'> <img border='0' id='delete_<?=$i1?>' alt='Delete File' src='../images/actions/Close_16x16.png' /> </a> </td>
                        </tr>
                        </table>
                  </td>
	          </tr>
		      <?
			}
			$i1++;
			}
			?>
            </table>
</fieldset>
<br />

<table width="100%" border="0">
  <tr>
    <td width="45%">
<fieldset>
         <legend> XtraUpload Version Status </legend>
<table width="311" border="0" align="left" cellpadding="2" cellspacing="2">
<tr>
              <td width="98" height="22"><div align="right"><span class="style1">Latest Version:</span></div></td>
    <td width="199"><?=$r_version?></td>
  </tr>
            <tr>
              <td height="22"><div align="right"><span class="style1">Your Version:</span></div></td>
              <td><?=$version?></td>
            </tr>
          </table>
</fieldset>
</td>
<td width="55%">
<fieldset>
         <legend> Files/User Stats </legend>
  <table width="100%" border="0" align="left" cellpadding="2" cellspacing="2">
            <tr>
              <td width="239" height="22"><div align="right"><span class="style1">Number of Uploads:</span></div></td>
              <td width="105"><span class="style1"><span class="a1">
                <?=$files?>
              </span></span></td>
              <td width="180" class="style1"><div align="right">Total Disk Space Used: </div></td>
              <td width="80"><span class="style1">
                 <? 
			  $ser = $db->query("SELECT SUM(`size`) AS `size` FROM `files` WHERE `status` = '1'");
			  $bw=0;
			  $serv = $db->fetch($ser);
			  $bw += $serv->size;
			  echo get_filesize_prefix($bw);
			  ?>
              </span></td>
    </tr>
            <tr>
              <td height="22"><div align="right"><span class="style1">Number of Registered Users:</span></div></td>
              <td><span class="style1"><span class="a1">
                <?=$users?>
              </span></span></td>
              <td class="style1"><div align="right">Total Bandwth Used: </div></td>
              <td><span class="style1">
                <? 
			  $ser = $db->query("SELECT SUM(used_bandwith) AS used_bandwith FROM `servers`");
			  $bw=0;
			  $serv = $db->fetch($ser);
			  $bw += $serv->used_bandwith;
			  echo get_filesize_prefix($bw);
			  ?>
              </span></td>
            </tr>
      </table>
     </fieldset>
</td>
  </tr>
</table>
<br />
     
     <fieldset>
         <legend> 5 Most Recent Log Entries  </legend>
 		  <?
		  echo readlog('',5);
		  ?>
     </fieldset>
<br />
<?
require_once("admin/footer.php");
?>