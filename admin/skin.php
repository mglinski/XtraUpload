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


$step = intval($_REQUEST['step']);
$uid = intval($_REQUEST['uid']);
$stat = intval($_REQUEST['stat']);

if (!$step)
{
	$step = 1;
}
$display_block = true;
switch($step)
{
	case "9": // set skin active

		$qry2 = $db->query("SELECT * FROM skin  WHERE id = '".$uid."' ");
		$res = $db->fetch($qry2,'obj');

		while($res1 = $db->fetch($db->query("SELECT * FROM skin WHERE active = '1' "),'obj'))
		{
			$db->query("UPDATE skin SET active = '0' WHERE id = '".$res1->id."' ");
		}

		$db->query("UPDATE skin SET active='".$stat."' WHERE id = '".$uid."' ");
		log_action('Skin Set as Active', 'skin:active', 'A skin was set as active.', 'ok', 'admin/skin.php');
		$display_block = false;

	break;
	
	case '6': // delete skin
	
		$qry2 = $db->query("SELECT * FROM skin  WHERE id = '".$uid."' ");
		$res = $db->fetch($qry2,'obj');
		
		$db->query("DELETE FROM skin WHERE id='".$uid."' ");
		
		log_action('Skin Uninstalled', 'skin:delete', 'A skin was deleted from the database.', 'ok', 'admin/skin.php');
		$display_block = false;

	break;
		
	default:// user index
	// Nothing to do here
	break;
}

if($_GET['install'])
{
	if(intval($_POST['active']) == 1)
	{
		while($res = $db->fetch($db->query("SELECT * FROM skin WHERE active = '1'"),'obj'))
		{
			$db->query("UPDATE skin SET active = '0' WHERE id = '".$res->id."'");
		}
	
	}
	$db->query("INSERT INTO skin (name,active) VALUES ('".txt_clean($_POST['name'])."','".intval($_POST['active'])."') ");
	log_action('Skin Installed', 'skin:new', 'A skin was Installed.', 'ok', 'admin/skin.php');
}

if($_GET['add'])
{
?>
<h1><span>Skin Manager - Add</span>XtraFile :: Admin Panel</h1>
<div class="actionsMenu">
    <a href="skin.php">
        <div class="item">
            <div class="img" style="background-image:url(../images/small/back.png);"></div>
            <div class="txt">Return To Skin Manger</div>
        </div>
    </a> 
</div><br />
<div align="center">
<form method="post" action="skin.php?install=true">
<table width="457" height="138" border="0" cellpadding="3" cellspacing="0" style="border-color:#000000; border-style:solid; border-width:1px;">
  <tr>
    <td width="259" height="46"><div align="right"><strong>Skins Not Yet Installed  </strong></div></td>
    <td width="186"><select name="name"><? 
		if ($handle = opendir('./skin/')) 
		{
			$i = 0;
			while (false !== ($file = readdir($handle))) 
			{
				if ($file != "." && $file != ".." && $file != "index.php" ) 
				{
					$num = $db->num($db->query("SELECT * FROM skin WHERE name = '" . $file . "'"));
					if($num == '0')
					{	
						echo'<option value="'.$file.'">'.$file.'</option>';
		   				//echo $file.'<br />';
						$i++;
					}
				}
				
			}
  			closedir($handle);
		}
	?></select>      <!-- <?=$i?> --></td>
  </tr>
  <tr>
    <td height="57"><div align="right"><strong>Is this skin active?<br />
      (This Will Deactivate all other skins)
    </strong></div></td>
    <td><input name="active" type="radio" value="1" />
      Yes
      <br />
      <input name="active" type="radio" value="0"  checked="checked"/>
      No</td>
  </tr>
  <tr>
    <td height="35">&nbsp;</td>
    <td><input type="submit" name="Submit"  <? if($i == '0'){?> disabled="disabled" value="No Skins to Install"<? }else{?>value="Install Skin"<? }?> /></td>
  </tr>
</table>
</form>
<br />
</div>
<?
}
else
{
?>
<h1><span>Skin Manager</span>XtraFile :: Admin Panel</h1>

<div class="actionsMenu">
    <a href="skin.php?add=1">
        <div class="item">
            <div class="img" style="background-image:url(../images/small/add.png);"></div>
            <div class="txt">Add New Skin</div>
        </div>
    </a> 
</div><div align="center"><br />
<table width=594 height="61" border='0' align="center" cellPadding=3 cellSpacing=0 style=" border:#000000 solid 1px;">
<tr>
	<th width="161" height="28" align='center'>Name</td>
	<th width="203" align='center'>Status</td>
	<th width="198" align='center'>Actions</td>
</tr>
<?

	$a_old = $a;
	unset($a);
	$sql3 = "SELECT * FROM `skin` ";
	$result1 = $db->query($sql3);
	if ($result1){
		while( $row = $db->fetch($result1,'obj') )
		{
		
			if($row->active == '1')
			{
				$nst=0;
				$status = "On";
			}
			else
			{
				$nst=1;
				$status = "Off";
			}
?>
	<tr style='background-color:' onmouseover="this.style.backgroundColor = '#C1DEF0';" onmouseout="this.style.backgroundColor = '';">
		<td height="28">
        	<center>
				<?=$row->name?>
            </center>
        </td>
		<td>
        	<div align="center">
            	<a href="<?=$PHP_SELF?>?step=9&stat=<?=$nst?>&uid=<?=$row->id?>">
					<img border='0' alt='Skin <?=$status?>'  src='../images/actions/Light Bulb (<?=$status?>)_24x24.png' />
                </a>
            </div>
        </td>
		<td>
        	<div align="center">
            	<a onclick="return confirm('Are you SURE you want to delete this skin?');" href="<?=$PHP_SELF?>?step=6&uid=<?=$row->id?>">
                	<img border='0' alt='Delete Skin' src='../images/actions/Close_24x24.png' />
                </a>
            </div>
        </td>
	</tr>
<?
		}
	}
	
	$a = $a_old;
	unset($a_old);
?>
</table>
</div>
    <?
	}
include("admin/footer.php");
?>
