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

$limit = 50;
if(isset($_POST['limit']))
{
	$limit = intval($_POST['limit']);
}

$pageno = 0;
if(isset($_REQUEST['pageno']))
{
	$pageno = intval($_REQUEST['pageno']);
}

if($_GET['edit'])
{
	if($_POST['submit'] == 'Submit Changes')
	{
		$sql = "
		UPDATE `users` SET
		`username` = '".txt_clean($_POST['username'])."',";
			
		if($_POST['spassword'] != '')
		{
			$sql .= "`password` = '".md5($_POST['spassword'])."', ";
		}
		
		$sql .= "
		`email` = '".txt_clean($_POST['semail'])."',
		`points` = '".intval($_POST['points'])."',
		`group` = '".intval($_POST['group'])."'
		WHERE `uid` = '".intval($_GET['user'])."'";
			
		$db->query($sql);
		log_action('User Edited', 'user:edit', 'User('.$_POST['username'].') Was updated.', 'ok', 'admin/user.php');
	}

	$c = $db->query("SELECT * FROM `users` WHERE `uid` = '".intval($_GET['user'])."' LIMIT 1");
	$d = $db->fetch($c);
	
	$cusername = $d->username;
	$cpassword = $d->password;
	$cemail = $d->email;
	$csignup_date = $d->signup_date; 
	$cgroup = $d->group;
	$cpoints = $d->points;
	
	?>
<style type="text/css">
<!--
.style1 {font-weight: bold}
.style2 {color: #009900}
-->
</style>
    <h1><span>User Manager - Edit User</span>XtraFile :: Admin Panel</h1><br />
<div align="center" class="style2"><a href="./user.php"><strong>Return to Account List </strong></a><br />
  <br />
</div>
<form method='post'>
	<div align="center" class="style1">Edit the account details and then click the submit button below to save changes.	</div><br />
<table height="100%" align="center">
  <tr>
    <td width="153" height="6%" align=right class="style1">Username:</td>
    <td width="316" class="style1"><input name="username" value="<?=$cusername?>" type="text" /></td>
  </tr>
  <tr>
    <td height="7%" align=right class="style1">New Password:</td><td class="style1">      <input name=spassword type=text class="style1" value='' size=35 maxlength=15>
      </td></tr>
  <tr>
    <td height="7%" align=right class="style1">Email:</td><td class="style1">      <input name=semail type=text value='<?=$cemail?>' size=35 maxlength=75>
      </td></tr>
  <tr>
    <td height="7%" align=right class="style1">Points</td>
    <td>      <input name="points" type="text" id="points" value="<?=$cpoints?>" />    </td>
  </tr>
  <tr>
    <td height="6%" align=right class="style1">User Group: </td>
    <td class="style1">
	<select name="group">
	<? $ff = $db->query("SELECT * FROM `groups` WHERE `id` != '1'");
	while($gr = $db->fetch($ff,'obj'))
	{
	?>
	  <option value="<?=$gr->id?>" <? if($gr->id == $cgroup){?>selected="selected"<? }?> ><?=$gr->name?></option>
	<? }?>
    </select>    </td>
  </tr>
  <tr>
    <td height="12%"> </td><td class="style1">&nbsp;</td>
  </tr>
  </table>
<div align="center"><span class="style1">
  <input name=submit type=submit class="style1" value='Submit Changes' />
  </span></div>
</form><?
}
else
{

	$step = $_REQUEST['step'];
	$uid = $_REQUEST['uid'];
	switch($step)
	{
		case "4":// delete users
			$db->query("DELETE FROM `users` WHERE uid = '".intval($uid)."'");
			log_action('User Deleted', 'user:delete', 'A User Was Deleted', 'ok', 'admin/user.php');
		break;
		
		default:// user index
		
		break;
	}
	
	$result = $db->query("SELECT * FROM users LIMIT ".($pageno * $limit).",".$limit."");
	$rowcount = $db->num($result);
	$pagecount = ceil($rowcount / $limit);
?>
<style type="text/css">
<!--
.style1 {
	font-size: 24px;
	font-weight: bold;
}
.style3 {font-size: 18px}
-->
</style>
    <h1><span>User Manager</span> XtraFile :: Admin Panel</h1><br />
<br />
<table style="border:#000 thin solid" width='803' border='0' align="center" cellPadding='2' cellSpacing='0' id="a1">
<tr>
	<th width="23%" align=center class='a1'><strong>User Name</font></strong></td>
	<th width="36%" align=center class='a1'>Email    
	<th width="23%" align=center class='a1'>User Group 
	<th width="18%" align=center class='a1'><strong>Action</font></strong></td>
</tr>
<?

	while( $row = $db->fetch($result))
	{		
		if($row->isadmin == "1")
		{
			$a1 = "0";
			$isadmin = "Is Admin";
		}
		else
		{
			$a1 = "1";
			$isadmin = "Is not Admin";
		}
			
		if($row->status == "1")
		{
			$a2 =  "0";
			$status = "Deactivate";
		}
		else
		{
			$a2 = "1";
			$status = "Activate";
		}
		?>
  <tr style='background-color:' onmouseover="this.style.backgroundColor = '#C1DEF0';" onmouseout="this.style.backgroundColor = '';">
      <td height="32" class='a1'>
    <div align="center"><?=$row->username?></div></td>
    <td class='a1'><div align="center">
        <div align="center">
          <? if(empty($row->email)){echo 'None Registered With Account';}else{echo $row->email;}?>
        </div>
            </div></td>
            <td class='a1'><div align="center"><? $fet = $db->fetch($db->query("SELECT * FROM groups WHERE id='".$row->group."'"),'obj'); echo $fet->name;?></div></td>
            <td class='a1'>
              <div align="center">
                <a href="<?=$PHP_SELF?>?edit=1&user=<?=$row->uid?>">
                	<img src="../images/actions/Edit_24x24.png" border="0" />
                </a> 
                &nbsp;
              	<a onclick="return confirm('Are you sure you wish to delete this user?');" href="<?=$PHP_SELF?>?step=4&uid=<?=$row->uid?>"> 
                	<img src="../images/actions/Close_24x24.png" border="0" />
                </a> 
    </div>				</td>
        </tr>
		<?
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
<br />
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
		}
  
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
    ?><form id="pagination1" method="post">
        <input type="hidden" id="pageno" name="pageno" value="<?=$pageno?>"/>
        <div style="float:right"># Per Page:
          <input size="2" type="text" name="limit" value="<?=$limit?>" />
          <br />
          <input type="submit" value="Get Results"  />
        </div>
      </form>
      </div>
      <?php

}
require_once("./admin/footer.php");
?>