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
*/include("./init.php");


if(isset($_GET['edit']))
{
	if(isset($_POST['submit']) and $_POST['submit'] == 'Submit Changes')
	{
		$db->query("UPDATE `lang` SET
		`file` = '".txt_clean($_POST['file'])."',
		`status` = '".intval($_POST['active'])."',
		`default` = '".intval($_POST['default'])."',
		`cc` = '".txt_clean($_POST['cc'])."',
		`name` = '".txt_clean($_POST['name'])."'
		WHERE `id` = '".intval($_GET['edit'])."'");
		echo "<center><font color='#0000FF' size='4'>Language File Edited.<br />Please wait while you are transfered.<script>function r(){location = './lang.php';}setTimeout('r()',1750);</script></font></center><br /><br />";
		log_action('Lang Edited', 'lang:edit', 'Language File was edited', 'ok', 'admin/lang.php');
		include('./admin/footer.php');
		die;
	}

	$c = $db->query("select * from lang where id='".intval($_GET['edit'])."' LIMIT 1");
	$a = $db->fetch($c,'obj');
	
	?>
<style type="text/css">
<!--
.style1 {
	font-weight: bold;
}
.style2 {
	font-weight: bold
}
.style3 {
	font-size: 24px
}
.style4 {
	font-weight: bold
}
-->
</style>
    <h1><span>Language Manager - Edit Settings</span>XtraFile :: Admin Panel</h1>
<div class="actionsMenu">
    <a href="lang.php">
        <div class="item">
            <div class="img" style="background-image:url(../images/small/back.png);"></div>
            <div class="txt">Return To Language Manger</div>
        </div>
    </a> 
</div><br />
<form name="form1" enctype="multipart/form-data" method="post">
  <table width="527" height="177" border="0" align="center" cellpadding="5" cellspacing="0">
    <tr>
      <td width="171"><div align="right"><strong>Name</strong>: </div></td>
      <td width="336"><div align="left">
          <input name="name" type="text" id="name" size="50" value="<?=$a->name?>" />
        </div></td>
    </tr>
    <tr>
      <td width="171"><div align="right"><strong>Country Code</strong>: </div></td>
      <td width="336"><div align="left">
          <input name="cc" type="text" id="name2" size="50" value="<?=$a->cc?>" />
        </div></td>
    </tr>
    <tr>
      <td><div align="right"><strong>Default Language?</strong> :</div></td>
      <td><input name="default" type="radio" <? if($a->default == 1){?>checked <? }?>value="1" />Yes<br />
      <input name="default" type="radio" <? if($a->default == 0){?>checked <? }?>value="0" />No
      </td>
    </tr>
    <tr>
      <td><div align="right"><strong>Active?</strong> :</div></td>
      <td><input name="active" type="radio" <? if($a->status == 1){?>checked <? }?>value="1" />Yes<br />
          <input name="active" type="radio" <? if($a->status == 0){?>checked <? }?>value="0" />No
          </td>
    </tr>
    <tr>
      <td><div align="right"><strong>File Name:</strong></div></td>
      <td><select name="file">
          <? 
		if ($handle = opendir('./include/language/')) 
		{
			while (false !== ($file = readdir($handle))) 
			{
				if (!is_dir('./include/language/'.$file) && $file != "index.php" ) 
				{
					echo'<option value="'.$file.'">'.$file.'</option>';
				}
				
			}
  			closedir($handle);
		}
	?>
        </select></td>
    </tr>
  </table>
  <p align="center">
    <input name="submit" type="submit" id="submit" value="Submit Changes">
  </p>
</form>
<?
}
else
{


	if(isset($_POST['submit']))
	{
		$block = $_POST['block'];
		$title = txt_clean($_POST['title']);
		$author = txt_clean($_POST['author']);
		$db->query("INSERT INTO lang (`file`,`name`,`default`,`status`, `cc`) VALUES ('".txt_clean($_POST['file'])."','".txt_clean($_POST['name'])."','".intval($_POST['default'])."','".intval($_POST['active'])."','".txt_clean($_POST['cc'])."')");
		log_action('Language Added', 'lang:add', 'A XtraUpload Translation was added', 'ok', 'admin/lang.php');
		header("Location: ./lang.php");
	}
	
	if(isset($_GET['default']))
	{
			while($res1 = $db->fetch($db->query("SELECT * FROM lang WHERE `default` = '1' ")))
			{
				$db->query("UPDATE lang SET `default` = '0' WHERE id = '".$res1->id."' ");
			}

			$db->query("UPDATE lang SET `default` = '1' WHERE id = '".intval($_GET['default'])."' ");
			log_action('Language Set as Default', 'lang:default', 'A languagee was set as default.', 'ok', 'admin/lang.php');
	}
	
	if(isset($_GET['active']))
	{
			$db->query("UPDATE lang SET status = '1' WHERE id = '".intval($_GET['active'])."' ");
			log_action('Language Set as active', 'lang:active', 'A language was set as active.', 'ok', 'admin/lang.php');
	}
	
	if(isset($_GET['deactive']))
	{
			$db->query("UPDATE lang SET status = '0' WHERE id = '".intval($_GET['deactive'])."' ");
			log_action('Language Set as not active', 'lang:active', 'A languagee was set as not active.', 'ok', 'admin/lang.php');
	}

	

	if(isset($_REQUEST['step']) and $_REQUEST['step'] == "4")
	{
		$id = intval($_REQUEST['id']);
		$sql1 = "DELETE FROM `lang` WHERE `id` = '$id' LIMIT 1 ";
		log_action('Lang Deleted', 'lang:delete', 'Language File Was Deleted', 'ok', 'admin/lang.php');
		$db->query($sql1);
	}
?>
<?php if(isset($_GET['add']))
{ ?>
<h1><span>Add Language</span>XtraFile :: Admin Panel</h1>
<div class="actionsMenu">
    <a href="lang.php">
        <div class="item">
            <div class="img" style="background-image:url(../images/small/back.png);"></div>
            <div class="txt">Return To Language Manger</div>
        </div>
    </a> 
</div><br />
<div align="center">
  <form name="form1" enctype="multipart/form-data" method="post" action="">
    <table width="527" height="177" border="0" align="center" cellpadding="5" cellspacing="0">
      <tr>
        <td width="171"><div align="right"><strong>Name</strong>: </div></td>
        <td width="336"><div align="left">
            <input name="name" type="text" id="name2" size="50" />
          </div></td>
      </tr>
      <tr>
        <td width="171"><div align="right"><strong>Country Code</strong>: </div></td>
        <td width="336"><div align="left">
            <input name="cc" type="text" id="name2" size="50" />
          </div></td>
      </tr>
      <tr>
        <td><div align="right"><strong>Default Language?</strong> :</div></td>
        <td><input name="default" type="radio" value="1" />Yes<br />
            <input name="default" type="radio" value="0" checked="checked" /> No
        </td>
      </tr>
      <tr>
        <td><div align="right"><strong>Active?</strong> :</div></td>
        <td><input name="active" type="radio" value="1" checked="checked" />Yes<br />
            <input name="active" type="radio" value="0" />No
            </td>
      </tr>
      <tr>
        <td><div align="right"><strong>File Name:</strong></div></td>
        <td><select name="file">
            <? 
		if ($handle = opendir('./include/language/')) 
		{
			$i = 0;
			while (false !== ($file = readdir($handle))) 
			{
				if (!is_dir('./include/language/'.$file) && $file != "index.php" ) 
				{	
					echo'<option value="'.$file.'">'.$file.'</option>';
		   			//echo $file.'<br />';
				}
				
			}
  			closedir($handle);
		}
	?>
          </select></td>
      </tr>
    </table>
    <input name="submit" type="submit" id="submit" value="Add Language">
  </form>
</div>
<?php }else{ ?>
<h1><span>Language Manager</span>XtraFile :: Admin Panel</h1>
<div class="actionsMenu">
    <a href="lang.php?add">
        <div class="item">
            <div class="img" style="background-image:url(../images/small/add.png);"></div>
            <div class="txt">Add Language</div>
        </div>
    </a> 
</div><br />
<table width='892' border='0' align="center" cellpadding='3' cellspacing='0' style="border:1px solid #000000;">
  <tr>
    <th width="20%" align=center class='a1'><strong> Name</strong> </th>
    <th width="36%" align=center class='a1'>File Name </th>
    <th width="12%" align="center" class='a1'>Active?</th>
    <th width="13%" align=center class='a1'>Default?</th>
    <th width="19%" align=center class='a1'><strong>Action</strong></th>
  </tr>
  <?
	$sql = "SELECT * FROM lang";
	$result = $db->query($sql);
	if ($result)
	{
		while( $row = $db->fetch($result) )
		{
?>
  <tr style='background-color:' onmouseover="this.style.backgroundColor = '#C1DEF0';" onmouseout="this.style.backgroundColor = '';">
    <td height="25" class='a1'><div align="center">
        <?=$row->name?>
      </div></td>
    <td class='a1'><div align="center">
        <?=$row->file?>
      </div></td>
    <td class='a1'><div align="center">
        <? if($row->status == '1')
		{
			echo "<a href='./lang.php?deactive=".$row->id."'><img border='0' alt='Deactivate Language' src='../images/actions/Light Bulb (On)_24x24.png' /></a>";
		}
		else
		{
			echo "<a href='./lang.php?active=".$row->id."'><img border='0' alt='Activate Language' src='../images/actions/Light Bulb (Off)_24x24.png' /></a>";
		}
		?>
      </div></td>
    <td class='a1'><div align="center">
        <? if($row->default == '1')
		{
			echo "<img border='0' alt='Language is Default' src='../images/actions/Light Bulb (On)_24x24.png' />";
		}
		else
		{
			echo "<a href='./lang.php?default=".$row->id."'><img border='0' alt='Make Language Default' src='../images/actions/Light Bulb (Off)_24x24.png' /></a>";
		}
		?>
      </div></td>
    <td class='a1'>
    	<div align="center">
        	<a href="<?=$PHP_SELF?>?edit=<?=$row->id?>"><img border='0' alt='Edit Language' src='../images/actions/Edit_24x24.png' /></a>
            <a onclick="return confirm('Are you sure you wish to delete this Language?');" href="<?=$PHP_SELF?>?step=4&id=<?=$row->id?>"><img border='0' alt='Delete Language' src='../images/actions/Close_24x24.png' /></a>
        </div>
    </td>
  </tr>
  <?
		}
	}
?>
</table>
<?php } ?>
<?
}
include('./admin/footer.php');
?>
