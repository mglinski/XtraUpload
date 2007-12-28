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

if(isset($_GET['group']) && $_GET['group'] != '')
{
	$group = intval($_GET['group']);
	if($_GET['update'])
	{
		$sql = "UPDATE `groups` SET 
		`days` = '".intval($_POST['days'])."',
		`limit_wait` = '".intval($_POST['limit_wait'])."', 
		 limit_size = '".intval($_POST['limit_size'])."',
		`name` = '".txt_clean($_POST['name'])."', 
		`description` = '".txt_clean($_POST['description'])."',
		`price` = '".txt_clean($_POST['price'])."',
		`userlimit` = '".intval($_POST['userlimit'])."',
		`captcha` = '".intval($_POST['captcha'])."',	
		`home_captcha` = '".intval($_POST['home_captcha'])."', 
		`limit` = '".intval($_POST['limit'])."',
		`resume` = '".intval($_POST['resume'])."',
		`allow_types` = '".txt_clean($_POST['allow_types'])."',
		`extend_points` = '".intval($_POST['extend_points'])."',
		`files_restrict_allowed` = '".intval($_POST['files_restrict_allowed'])."',
		`no_ads` = '".intval($_POST['no_ads'])."',
		`expire` = '".intval($_POST['expire'])."',
		`max_file_streams` = '".intval($_POST['max_file_streams'])."',
		`can_extend` = '".intval($_POST['can_extend'])."',
		`visible` = '".intval($_POST['visible'])."',
		`can_cgi` = '".intval($_POST['can_cgi'])."',
		`can_flash` = '".intval($_POST['can_flash'])."',
		`file_expire` = '".intval($_POST['file_expire'])."',
		`can_url` = '".intval($_POST['can_url'])."',
		`limit_speed` = '".intval($_POST['limit_speed'])."',
		`show_direct_link` = '".intval($_POST['show_direct_link'])."',
		`can_manage` = '".intval($_POST['can_manage'])."',
		`can_delete` = '".intval($_POST['can_delete'])."',
		`can_email` = '".intval($_POST['can_email'])."',
		`can_create_folders` = '".intval($_POST['can_create_folders'])."',
		`can_view_folders` = '".intval($_POST['can_view_folders'])."',
		`can_email` = '".intval($_POST['can_email'])."',
		`shownUploadMethod` = '".intval($_POST['shownUploadMethod'])."',
		
		`is_admin` = '".intval($_POST['is_admin'])."'
		WHERE `id` = '".$group."'
		";
		$db->query($sql);
		log_action('Usergroup Edited', 'group:edit', 'The usergroup('.txt_clean($_POST['name']).') was edited', 'ok', 'admin/group.php');
		
	}
	$ret = $db->query("SELECT * FROM groups WHERE id='".$group."'");
	$groups = $db->fetch($ret,'obj');
?>
<style type="text/css">
<!--
.style1 {
	font-size: 16px
}
-->
</style>
<h1><span>User Group Manager - Edit Group</span>XtraFile :: Admin Panel</h1>
<br />
<center>
  <br />
  <? if(isset($_POST['name'])){?>
  <img src="../images/actions/Certificate_32x32.png" /><br />
  <span class="style1"><b>Saved Configuration</b></span><br />
  <br />
  <? }?>
  <a href="group.php" class="style1">Return To Overview</a>
  <center>
  </center>
  <table  height="252" id="config" style="border:1px solid #000000">
    <tr>
      <td width="604" height="246"><form action="group.php?group=<?=$group?>&update=1" method="post" >
          <table width="574" border="0" align="center" cellpadding="5" cellspacing="0">
            <tr>
              <td width="250" height="32"><div align="right"><strong>Name:</strong></div></td>
              <td width="304"><input name="name" type="text" size="30" value="<?=$groups->name?>"  /></td>
            </tr>
            <tr>
              <td width="250" height="32"><div align="right"><strong>Description:</strong></div></td>
              <td width="304"><textarea cols="35" rows="6" name="description" ><?=$groups->description?>
</textarea></td>
            </tr>
            <tr>
              <td width="250" height="32"><div align="right"><strong>Price:</strong></div></td>
              <td width="304"><input name="price" type="text" size="30" value="<?=$groups->price?>"  /></td>
            </tr>
            <tr>
              <td width="250" height="32"><div align="right"><strong>Hourly Download Limit:</strong></div></td>
              <td width="304"><input name="limit" type="text" size="30" value="<?=$groups->limit?>"  />
                (In Megabytes)</td>
            </tr>
            <tr>
              <td width="250" height="32"><div align="right"><strong>Can Be Purchased:</strong></div></td>
              <td width="304"><input name="visible" type="radio" size="30" value="1" <? if($groups->visible){?>checked<? }?>  />
                Yes <br />
                <input name="visible" type="radio" size="30" value="0" <? if(!$groups->visible){?>checked<? }?>  />
                No </td>
            </tr>
            <tr>
              <td width="250" height="32"><div align="right"><strong>Allowed File Types</strong></div></td>
              <td width="304"><input name="allow_types" type="text" size="30" value="<?=$groups->allow_types?>"  />
                <br />
                "|" seperated, lowercase extensions only, <br />
                * for all types allowed </td>
            </tr>
            <tr>
              <td width="250" height="32"><div align="right"><strong>Files Restricted or allowed:</strong></div></td>
              <td width="304"><input name="files_restrict_allowed" type="radio" size="30" value="1" <? if($groups->files_restrict_allowed){?>checked<? }?>  />
                File types above are restricted<br />
                <input name="files_restrict_allowed" type="radio" size="30" value="0" <? if(!$groups->files_restrict_allowed){?>checked<? }?>  />
                File Types above are allowed</td>
            </tr>
            <tr>
              <td width="250" height="32"><div align="right"><strong>Max File Size</strong></div></td>
              <td width="304"><input name="limit_size" type="text" size="30" value="<?=$groups->limit_size?>" />
                <br />
                (In Megabytes)</td>
            </tr>
            <tr>
              <td width="250" height="32"><div align="right"><strong>Max File Download Connections</strong></div></td>
              <td width="304"><input name="max_file_streams" type="text" size="30" value="<?=$groups->max_file_streams?>"  />
                <br /></td>
            </tr>
            <tr>
              <td width="250" height="32"><div align="right"><strong>Download Wait Time</strong></div></td>
              <td width="304"><input name="limit_wait" type="text" size="30" value="<?=$groups->limit_wait?>"  />
                <br />
                in seconds, "0" means no wait</td>
            </tr>
            <tr>
              <td width="250" height="32"><div align="right"><strong>Days uploaded files are kept on the server:</strong></div></td>
              <td width="304"><input name="file_expire" type="text" size="30" value="<?=$groups->file_expire?>" />
                Yes<br />
            </tr>
            <tr>
              <td width="250" height="32"><div align="right"><strong>Extend Cost(In Points)</strong></div></td>
              <td width="304"><input name="extend_points" type="text" size="30" value="<?=$groups->extend_points?>"  /></td>
            </tr>
            <tr>
              <td width="250" height="32"><div align="right"><strong>Account Expiry Time(In Days)</strong></div></td>
              <td width="304"><input name="expire" type="text" size="30" value="<?=$groups->expire?>"  />
                <br />
                &quot;0&quot; Means Account Never Exipres </td>
            </tr>
            <tr>
              <td width="250" height="32"><div align="right"><strong>Can Be Extended With Points</strong></div></td>
              <td width="304"><input name="can_extend" type="radio" size="30" value="1" <? if($groups->can_extend){?>checked<? }?>  />
                Yes (Can the expiry date be extended) <br />
                <input name="can_extend" type="radio" size="30" value="0" <? if(!$groups->can_extend){?>checked<? }?>  />
                No</td>
            </tr>
            <tr>
              <td width="250" height="32"><div align="right"><strong>Can Upload Via Browser(CGI/PHP)</strong></div></td>
              <td width="304"><input name="can_cgi" type="radio" size="30" value="1" <? if($groups->can_cgi){?>checked<? }?>  />
                Yes<br />
                <input name="can_cgi" type="radio" size="30" value="0" <? if(!$groups->can_cgi){?>checked<? }?>  />
                No</td>
            </tr>
            <tr>
              <td width="250" height="32"><div align="right"><strong>Can Upload Via Flash:</strong></div></td>
              <td width="304"><input name="can_flash" type="radio" size="30" value="1" <? if($groups->can_flash){?>checked<? }?>  />
                Yes<br />
                <input name="can_flash" type="radio" size="30" value="0" <? if(!$groups->can_flash){?>checked<? }?>  />
                No</td>
            </tr>
            <tr>
              <td width="250" height="32"><div align="right"><strong>Can Upload Via URL:</strong></div></td>
              <td width="304"><input name="can_url" type="radio" size="30" value="1" <? if($groups->can_url){?>checked<? }?>  />
                Yes<br />
                <input name="can_url" type="radio" size="30" value="0" <? if(!$groups->can_url){?>checked<? }?>  />
                No</td>
            </tr>
            <tr>
              <td width="250" height="32"><div align="right"><strong>Default Upload Method:</strong></div></td>
              <td width="304"><input name="shownUploadMethod" type="radio" size="30" value="1" <? if($groups->shownUploadMethod == '1'){?>checked<? }?>  />
                CGI/PHP<br />
                <input name="shownUploadMethod" type="radio" size="30" value="2" <? if($groups->shownUploadMethod == '2'){?>checked<? }?>  />
                URL<br />
                <input name="shownUploadMethod" type="radio" size="30" value="3" <? if($groups->shownUploadMethod == '3'){?>checked<? }?>  />
                Flash</td>
            </tr>
            <tr>
              <td ><div align="right"><strong>Require CAPTCHA Test </strong></div></td>
              <td><input name="captcha" type="radio" value="1"  <? if($groups->captcha){ ?>checked<? }?>>
                Yes ( Require Image Verification ) <br />
                <input name="captcha" type="radio" value="0" <? if(!$groups->captcha){ ?>checked<? }?> />
                No </td>
            </tr>
            <tr>
              <td ><div align="right"><strong>Display CAPTCHA on Home Page? </strong></div></td>
              <td><p>
                  <input name="home_captcha" type="radio" value="1"  <? if($groups->home_captcha){ ?>checked<? }?> />
                  Yes ( Image Verification on Home Page) <br />
                  <input name="home_captcha" type="radio" value="0" <? if(!$groups->home_captcha){ ?>checked<? }?> />
                  No </p></td>
            </tr>
            <tr>
              <td width="250" height="32"><div align="right"><strong>Can Use Down Accelerators:</strong></div></td>
              <td width="304"><input name="resume" type="radio" size="30" value="1" <? if($groups->resume){?>checked<? }?>  />
                Yes<br />
                <input name="resume" type="radio" size="30" value="0" <? if(!$groups->resume){?>checked<? }?>  />
                No</td>
            </tr>
            <tr>
              <td width="250" height="32"><div align="right"><strong>Show Direct Download Links:</strong></div></td>
              <td width="304"><input name="show_direct_link" type="radio" size="30" value="1" <? if($groups->show_direct_link){?>checked<? }?>  />
                Yes<br />
                <input name="show_direct_link" type="radio" size="30" value="0" <? if(!$groups->show_direct_link){?>checked<? }?>  />
                No</td>
            </tr>
            <tr>
              <td width="250" height="32"><div align="right"><strong>Download Speed( In KBPS )<br />
                  </strong></div></td>
              <td width="304"><input name="limit_speed" type="text" size="30" value="<?=$groups->limit_speed?>"  />
                <br />
                &quot;0&quot; means no Download Speed Restrictions </td>
            </tr>
            <tr>
              <td width="250" height="32"><div align="right"><strong>Allowed User Signups<br />
                  </strong></div></td>
              <td width="304"><input name="userlimit" type="text" size="30" value="<?=$groups->userlimit?>"  />
                <br />
                &quot;0&quot; means no limit </td>
            </tr>
            <tr>
              <td width="250" height="32"><div align="right"><strong>Can Change Account Details:</strong></div></td>
              <td width="304"><input name="can_manage" type="radio" size="30" value="1" <? if($groups->can_manage){?>checked<? }?>  />
                Yes<br />
                <input name="can_manage" type="radio" size="30" value="0" <? if(!$groups->can_manage){?>checked<? }?>  />
                No</td>
            </tr>
            <tr>
              <td width="250" height="32"><div align="right"><strong>Show User Ads:</strong></div></td>
              <td width="304"><input name="no_ads" type="radio" size="30" value="1" <? if($groups->no_ads){?>checked<? }?>  />
                Yes<br />
                <input name="no_ads" type="radio" size="30" value="0" <? if(!$groups->no_ads){?>checked<? }?>  />
                No</td>
            </tr>
            <tr>
              <td width="250" height="32"><div align="right"><strong>Can Delete Files:</strong></div></td>
              <td width="304"><input name="can_delete" type="radio" size="30" value="1" <? if($groups->can_delete){?>checked<? }?>  />
                Yes<br />
                <input name="can_delete" type="radio" size="30" value="0" <? if(!$groups->can_delete){?>checked<? }?>  />
                No</td>
            </tr>
            <tr>
              <td width="250" height="32"><div align="right"><strong>Can Create File Folders:</strong></div></td>
              <td width="304"><input name="can_create_folders" type="radio" size="30" value="1" <? if($groups->can_create_folders){?>checked<? }?>  />
                Yes<br />
                <input name="can_create_folders" type="radio" size="30" value="0" <? if(!$groups->can_create_folders){?>checked<? }?>  />
                No</td>
            </tr>
            <tr>
              <td width="250" height="32"><div align="right"><strong>Can View File Folders:</strong></div></td>
              <td width="304"><input name="can_view_folders" type="radio" size="30" value="1" <? if($groups->can_view_folders){?>checked<? }?>  />
                Yes<br />
                <input name="can_view_folders" type="radio" size="30" value="0" <? if(!$groups->can_view_folders){?>checked<? }?>  />
                No</td>
            </tr>
            <tr>
              <td width="250" height="32"><div align="right"><strong>Can Email Download Links:</strong></div></td>
              <td width="304"><input name="can_email" type="radio" size="30" value="1" <? if($groups->can_email){?>checked<? }?>  />
                Yes<br />
                <input name="can_email" type="radio" size="30" value="0" <? if(!$groups->can_email){?>checked<? }?>  />
                No</td>
            </tr>
            <tr>
              <td width="250" height="32"><div align="right"><strong>Can Access Admin Section:</strong></div></td>
              <td width="304"><input name="is_admin" type="radio" size="30" value="1" <? if($groups->is_admin){?>checked<? }?>  />
                Yes<br />
                <input name="is_admin" type="radio" size="30" value="0" <? if(!$groups->is_admin){?>checked<? }?>  />
                No</td>
            </tr>
          </table>
          <br />
          <br />
          <div align="center">
            <input type="hidden" name="valid"  value="true"/>
            <input type="submit" name="Submit" id='submit' value="  Update  " />
            <br />
          </div>
        </form></td>
    </tr>
  </table>
</center>
<?
}
else
{
	$step = $_REQUEST['step'];
	$uid = $_REQUEST['uid'];
	if (!$step)
	{
		$step = 1;
	}
	$display_block = true;
	switch($step)
	{
	
		case "4":// delete usergroup
			$qry2 = $db->query("SELECT * FROM groups  WHERE id = '".$uid."' ");
			$res = $db->fetch($qry2,'obj');
			$db->query("DELETE FROM groups  WHERE id = '".$uid."' ");
			log_action('Usergroup Deleted', 'group:delete', 'The usergroup('.$res->name.') was deleted', 'ok', 'admin/group.php');
			$display_block = false;
		break;
			
			
		case "9":// toggle visibility for usergroup
			
			$qry2 = $db->query("SELECT * FROM groups  WHERE id = '".$uid."' ");
			$res = $db->fetch($qry2,'obj');
			$db->query("UPDATE groups SET visible='".intval($_REQUEST['stat'])."' WHERE id = '".$uid."' ");
			log_action('Usergroup Updated', 'group:update', 'The usergroup('.$res->name.') was updated', 'ok', 'admin/group.php');
			$display_block = false;
			
		break;

		default:// user index
		// Nothing to do here
		break;
		
	}

	if(isset($_POST['s2']))
{

	$sql = "INSERT INTO `groups` 
	(
		`name`,`description`,`price`,`visible`,
		`can_cgi`,`can_flash`,`can_url`,`limit_speed`,
		`can_manage`,`can_delete`,`can_create_folders`,
		`can_view_folders`,`can_email`,`is_admin`,`resume`,
		`limit`,`allow_types`,`extend_points`,`days`,`can_extend`,`captcha`,
		`userlimit`,`limit_wait`, `limit_size`, 
		`max_file_streams`, `file_expire`, `shownUploadMethod`
	) 
	VALUES   
	(
		'$_POST[name]', '$_POST[description]','$_POST[price]',
		'$_POST[visible]','$_POST[can_cgi]','$_POST[can_flash]',
		'$_POST[can_url]','$_POST[limit_speed]','$_POST[can_manage]',
		'$_POST[can_delete]','$_POST[can_create_folders]','$_POST[can_view_folders]',
		'$_POST[can_email]','$_POST[is_admin]','$_POST[resume]',
		'$_POST[limit]','$_POST[allow_types]','$_POST[extend_points]',
		'$_POST[days]','$_POST[can_extend]', '$_POST[captcha]', 
		'$_POST[limit_wait]', '$_POST[userlimit]',
		'$_POST[limit_size]', '$_POST[max_file_streams]', '$_POST[file_expire]',
		'$_POST[shownUploadMethod]'
	)";
	$db->query($sql);
	log_action('Usergroup Added', 'group:add', 'The usergroup('.txt_clean($_POST['name']).') was added', 'ok', 'admin/group.php');
}

?>
<h1><span>User Group Manager</span>XtraFile :: Admin Panel</h1>
<br />
<div align="center">

  <a href="javascript:;" onclick='document.getElementById("a1").style.display = ""; document.getElementById("b1").style.display = "none"; '><strong>Manage User Groups</strong></a> | 
  <a href="javascript:;" onclick='document.getElementById("b1").style.display = ""; document.getElementById("a1").style.display = "none"; '><strong>Add User Group </strong></a>
</div><br /><br />
<div style=" border-width:thin; border-color:#000000">
<div id="a1">
  <div align="center">
    <table style="border:#000 thin solid" width=739 border='0' align="center" cellpadding=3 cellspacing=0>
      <tr>
        <td width="24%" align=center class='a1'><strong>Group Name</strong></td>
        <td width="41%" align=center class='a1'><strong>Group Description</strong></td>
        <td width="18%" align=center class='a1'><strong>Group Price </strong></td>
        <td width="17%" align=center class='a1'><strong>Manage Group </strong></td>
      </tr>
      <?
	$a_old = $a;
	unset($a);
	$sql3 = "SELECT * FROM `groups` ";
	$result1 = $db->query($sql3);
	if ($result1){
		while( $row = $db->fetch($result1,'obj') )
		{
		
			if($row->visible == '1')
			{
				$nst=0;
				$status = "Public";
			}
			else
			{
				$nst=1;
				$status = "Private";
			}
?>
      <tr style='background-color:' onmouseover="this.style.backgroundColor = '#C1DEF0';" onmouseout="this.style.backgroundColor = '';">
        <td class='a1'><div align="center">
            <?=$row->name?>
          </div>
          <div align="center"></div>
          <div align="center"></div></td>
        <td class='a1'><div align="center">
            <?=$row->description?>
          </div>
          <div align="center"></div></td>
        <td class='a1'><div align="center"> $
            <?=$row->price?>
          </div></td>
        <td class='a1'><center>
		<? 
			if($row->id != '1')
			{
				if($row->id != '2')
				{
					?><a href="<?=$PHP_SELF?>?a=<?=$a?>&step=9&stat=<?=$nst?>&uid=<?=$row->id?>"><? 
					if($status == 'Public')
					{
						?><img border='0' alt='Public' src='../images/actions/Light Bulb (On)_24x24.png' /><? 
					}
					else
					{
						?><img border='0' alt='Private' src='../images/actions/Light Bulb (Off)_24x24.png' /><? 
					} 
					?></a>&nbsp;<? 
				}
			}
			?><a href="<?=$PHP_SELF?>?group=<?=$row->id?>"><img border='0' alt='Edit Group Settings' src='../images/actions/Edit_24x24.png' /></a>&nbsp;<? 
			if($row->id != '1')
			{
				if($row->id != '2')
				{
				?><a onclick="return confirm('Are you sure you wish to delete this user group?');" href="<?=$PHP_SELF?>?a=<?=$a?>&step=4&uid=<?=$row->id?>"><img border='0' alt='Delete Group' src='../images/actions/Close_24x24.png' /></a>
            <?
				}
			}
			?>
        </center></td>
      </tr>
      <?
		}
	}
	$a = $a_old;
	unset($a_old);
?>
    </table>
  </div>
</div>
<div id="b1" style="display:none">
  <div align="center"><br />
    <font size="4" face="Verdana, Arial, Helvetica, sans-serif">Add a User Group </font><font face="Verdana, Arial, Helvetica, sans-serif"><br />
    </font></div>
  <table width="601" height="252" id="config" align="center" style="display:">
    <tr>
      <td width="713" height="246"><form method='post' action="group.php" name='f1' >
          <table width="102%" border="0" align="center" cellpadding="5" cellspacing="0">
            <tr>
              <td width="48%" height="32"><div align="right"><strong>Name:</strong></div></td>
              <td width="52%"><input name="name" type="text" size="30"  /></td>
            </tr>
            <tr>
              <td width="48%" height="32"><div align="right"><strong>Description:</strong></div></td>
              <td width="52%"><textarea name="description" rows="6" cols="35"></textarea></td>
            </tr>
            <tr>
              <td width="48%" height="32"><div align="right"><strong>Price:</strong></div></td>
              <td width="52%"><input name="price" type="text" size="30"  /></td>
            </tr>
            <tr>
              <td width="250" height="32"><div align="right"><strong>Hourly Download Limit:</strong></div></td>
              <td width="304"><input name="limit" type="text" size="30" value="300"  />
                ( In Megabytes )</td>
            </tr>
            <tr>
              <td width="250" height="32"><div align="right"><strong>Allowed File Types</strong></div></td>
              <td width="304"><input name="allow_types" type="text" size="30" value="zip|rar|tar|gz|txt|doc|rtf|db|mp3|mpg|mpeg|jpg|jpeg|gif|bmp|png|psd"  />
                "|" seperated, lowercase extensions only</td>
            </tr>
            <tr>
              <td width="250" height="32"><div align="right"><strong>Files Restricted or allowed:</strong></div></td>
              <td width="304"><input name="files_restrict_allowed" type="radio" size="30" value="1" />
                File types above are restricted<br />
                <input name="files_restrict_allowed" type="radio" size="30" value="0" checked  />
                File Types above are allowed</td>
            </tr>
            <tr>
              <td width="250" height="32"><div align="right"><strong>Max File Size</strong></div></td>
              <td width="304"><input name="limit_size" type="text" size="30" value="250"  />
                <br />
                (In Megabytes)</td>
            </tr>
            <tr>
              <td width="250" height="32"><div align="right"><strong>Max File Download Connections</strong></div></td>
              <td width="304"><input name="max_file_streams" type="text" size="30" value="1"  />
                <br /></td>
            </tr>
            <tr>
              <td width="250" height="32"><div align="right"><strong>Download Wait Time</strong></div></td>
              <td width="304"><input name="limit_wait" type="text" size="30" value="0"  />
                <br />
                in seconds, "0" means no wait</td>
            </tr>
            <tr>
              <td width="250" height="32"><div align="right"><strong>Days uploaded files are kept on the server:</strong></div></td>
              <td width="304"><input name="file_expire" type="text" size="30" value="<?=$groups->file_expire?>" />
                Yes<br />
            </tr>
            <tr>
              <td width="250" height="32"><div align="right"><strong>Extend Cost(In Points)</strong></div></td>
              <td width="304"><input name="points" type="text" size="30" value="10000"  /></td>
            </tr>
            <tr>
              <td width="250" height="32"><div align="right"><strong>Account Expiry Time(In Days)</strong></div></td>
              <td width="304"><input name="days" type="text" size="30" value="30"  />
                <br />
                &quot;0&quot; Means Never Expires</td>
            </tr>
            <tr>
              <td width="250" height="32"><div align="right"><strong>Allowed User Signups<br />
                  </strong></div></td>
              <td width="304"><input name="userlimit" type="text" size="30" value="0"  />
                <br />
                &quot;0&quot; means no limit </td>
            </tr>
            <tr>
              <td width="250" height="32"><div align="right"><strong>Can Be Extended With Points</strong></div></td>
              <td width="304"><input name="can_extend" type="radio" size="30" value="1" checked />
                Yes<br />
                <input name="can_extend" type="radio" size="30" value="0" />
                No</td>
            </tr>
            <tr>
              <td width="48%" height="32"><div align="right"><strong>Can Be Purchased:</strong></div></td>
              <td width="52%"><input name="visible" type="radio" size="30" value="1" checked />
                Yes <br />
                <input name="visible" type="radio" size="30" value="0" />
                No </td>
            </tr>
            <tr>
              <td width="48%" height="32"><div align="right"><strong>Can Upload Via Browser(CGI/PHP)</strong></div></td>
              <td width="52%"><input name="can_cgi" type="radio" size="30" value="1" checked />
                Yes <br />
                <input name="can_cgi" type="radio" size="30" value="0" />
                No </td>
            </tr>
            <tr>
              <td width="48%" height="32"><div align="right"><strong>Can Upload Via Flash:</strong></div></td>
              <td width="52%"><input name="can_flash" type="radio" size="30" value="1" checked />
                Yes <br />
                <input name="can_flash" type="radio" size="30" value="0" />
                No </td>
            </tr>
            <tr>
              <td width="48%" height="32"><div align="right"><strong>Can Upload Via URL:</strong></div></td>
              <td width="52%"><input name="can_url" type="radio" size="30" value="1" />
                Yes <br />
                <input name="can_url" type="radio" size="30" value="0" checked />
                No </td>
            </tr>
            <tr>
              <td width="250" height="32"><div align="right"><strong>Default Upload Method:</strong></div></td>
              <td width="304"><input name="shownUploadMethod" type="radio" size="30" value="1"  />
                CGI/PHP<br />
                <input name="shownUploadMethod" type="radio" size="30" value="2"  />
                URL<br />
                <input name="shownUploadMethod" type="radio" size="30" value="3"  />
                Flash</td>
            </tr>
            <tr>
              <td ><div align="right"><strong>Require CAPTCHA Test </strong></div></td>
              <td><input name="captcha" type="radio" value="1" checked >
                Yes ( Require Image Verification ) <br />
                <input name="captcha" type="radio" value="0"  />
                No </td>
            </tr>
            <tr>
              <td ><div align="right"><strong>Can Use Down Accelerators:</strong></div></td>
              <td ><input name="resume" type="radio" size="30" value="1" />
                Yes<br />
                <input name="resume" type="radio" size="30" value="0" checked />
                No</td>
            </tr>
            <tr>
              <td width="250" height="32"><div align="right"><strong>Show Direct Download Links:</strong></div></td>
              <td width="304"><input name="show_direct_link" type="radio" size="30" value="1" checked />
                Yes<br />
                <input name="show_direct_link" type="radio" size="30" value="0"  />
                No</td>
            </tr>
            <tr>
              <td width="250" height="32"><div align="right"><strong>Days uploaded files are kept on the server:</strong></div></td>
              <td width="304"><input name="file_expire" type="radio" size="30" value="1" checked />
                Yes<br />
                <input name="file_expire" type="radio" size="30" value="0"  />
                No</td>
            </tr>
            <tr>
              <td width="48%" height="32"><div align="right"><strong>Download Speed ( in KBPS )<br />
                  </strong></div></td>
              <td width="52%"><input name="limit_speed" type="text" value="100" size="30"  />
                <br />
                &quot;0&quot; Means No Download Speed Restrictions </td>
            </tr>
            <tr>
              <td width="48%" height="32"><div align="right"><strong>Can Change Account Details:</strong></div></td>
              <td width="52%"><input name="can_manage" type="radio" size="30" value="1" checked />
                Yes <br />
                <input name="can_manage" type="radio" size="30" value="0" />
                No </td>
            </tr>
            <tr>
              <td width="250" height="32"><div align="right"><strong>Show User Ads:</strong></div></td>
              <td width="304"><input name="no_ads" type="radio" size="30" value="1"  />
                Yes<br />
                <input name="no_ads" type="radio" size="30" value="0" />
                No</td>
            </tr>
            <tr>
              <td width="48%" height="32"><div align="right"><strong>Can Delete Files:</strong></div></td>
              <td width="52%"><input name="can_delete" type="radio" size="30" value="1" checked />
                Yes <br />
                <input name="can_delete" type="radio" size="30" value="0" />
                No </td>
            </tr>
            <tr>
              <td width="48%" height="32"><div align="right"><strong>Can Create File Folders:</strong></div></td>
              <td width="52%"><input name="can_create_folders" type="radio" size="30" value="1" checked />
                Yes <br />
                <input name="can_create_folders" type="radio" size="30" value="0" />
                No </td>
            </tr>
            <tr>
              <td width="48%" height="32"><div align="right"><strong>Can View File Folders:</strong></div></td>
              <td width="52%"><input name="can_view_folders" type="radio" size="30" value="1" checked />
                Yes <br />
                <input name="can_view_folders" type="radio" size="30" value="0" />
                No </td>
            </tr>
            <tr>
              <td width="48%" height="32"><div align="right"><strong>Can Email Download Links:</strong></div></td>
              <td width="52%"><input name="can_email" type="radio" size="30" value="1" checked />
                Yes <br />
                <input name="can_email" type="radio" size="30" value="0" />
                No </td>
            </tr>
            <tr>
              <td width="48%" height="32"><div align="right"><strong>Can Access Admin Section:</strong></div></td>
              <td width="52%"><input name="is_admin" type="radio" size="30" value="1" />
                Yes <br />
                <input name="is_admin" type="radio" size="30" value="0" checked />
                No </td>
            </tr>
          </table>
          <div align="center"><br />
            <input name="s2" type="hidden" value="true" />
            <input name="  Add Group  " type="submit" id="  Add Group  " value="Submit" />
          </div>
        </form></td>
    </tr>
  </table>
</div>
<?
	}
	include("admin/footer.php");
?>
