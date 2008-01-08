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
if($_POST['submit'])
{

	if($_POST['image'] == '')
	{
		$image_src = './cache/ads/ads_'.time().'_'.rand().'_'.$_FILES['image']['name'];
		move_uploaded_file($_FILES['image']['tmp_name'],$image_src);
		$image_name = addslashes($_POST['name']);
		$o_name = $_FILES['image']['name'];
	}
	else
	{
		$image_src = $_POST['image'];
		$image_name = addslashes($_POST['name']);
		$o_name = 'java';
	}

	$link = addslashes($_POST['link']);
	$type = addslashes($_POST['type']);
	$impressions = intval($_POST['imp']);
	$imp_nolimit = intval($_POST['nolimit']);	

	$db->query("INSERT INTO ads (name,o_name,link,src,status,type,allow_imp,nolimit) VALUES ('$image_name','$o_name','$link','$image_src',1,'$type','$impressions','$imp_nolimit')", 'insert_1');
	log_action('Advertisement Added', 'ads:add', 'An Advertisement('.$image_name.') was Added', 'ok', 'admin/ads.php');
}

	$step = $_REQUEST['step'];
	$id = $_REQUEST['id'];

	if (!$step)
	{
		$step = 1;// Set a default $step Value
	}
	switch($step)
	{
		case "4":// delete ad
			$sd = $db->fetch($db->query("SELECT * FROM  `ads` WHERE id='$id'"));
			$sql1 = "DELETE FROM `ads` WHERE `id` = '$id' LIMIT 1 ";
			@unlink($sd->src);
			$db->query($sql1);
		break;
			
		case "5":// update ad with new impression count
			$sql2 = "UPDATE `ads` SET `status` = '$_REQUEST[a]' WHERE `id` = '$id'";
			$db->query($sql2);
		break;
			
		default:// user index
		// do nothing
		break;
	}
?>
<style type="text/css">
<!--
.style1 {
	font-weight: bold
}
.style2 {
	font-size: 24px
}
.style3 {
	font-size: 18px
}
-->
</style>
<? if($_GET['add'])
{
?>
<h1><span>Advertisement Manager - Add</span>XtraFile :: Admin Panel</h1>
<div class="actionsMenu">
    <a href="ads.php">
        <div class="item">
            <div class="img" style="background-image:url(../images/small/back.png);"></div>
            <div class="txt">Manage Advertisements</div>
        </div>
    </a> 
</div><br />
<div align="center"> <br>
  <form name="form1" enctype="multipart/form-data" method="post" action="ads.php">
    <table width="493" border="0" align="center" cellpadding="5" cellspacing="0">
      <tr>
        <td><div align="right"><strong>Name: </strong></div></td>
        <td><input name="name" type="text" id="name"></td>
      </tr>
      <tr>
        <td><div align="right"><strong>Type: </strong></div></td>
        <td><input name="type" type="radio" onclick="
			document.getElementById('type_1').innerHTML = '<strong>Image:</strong>'; 
			document.getElementById('image_1').innerHTML = '<input name=\'image\' type=\'file\' id=\'image\' >'; " value="image" checked>
          Image/Banner <br>
          <input name="type" type="radio" onclick="
document.getElementById('type_1').innerHTML = '<strong>JavaScript Code:</strong>'; 
document.getElementById('image_1').innerHTML = '<textarea cols=\'25\' rows=\'6\' id=\'image\' name=\'image\'></textarea>'; " value="java">
          Javascript Code Segment</td>
      </tr>
      <tr>
        <td width="229"><div align="right" id="type_1"><strong>Image:</strong></div></td>
        <td width="244" id="image_1"><input name="image" type="file" id="image" ></td>
      </tr>
      <tr>
        <td><div align="right"><strong>Link: </strong></div></td>
        <td><input name="link" type="text" id="link"></td>
      </tr>
      <tr>
        <td><div align="right"><strong>Allowed Impressions: </strong></div></td>
        <td><input name="imp" id="imp" type="text"d></td>
      </tr>
      <tr>
        <td height="54"><div align="right"><strong>Unlimited Impressions?</strong></div></td>
        <td><input name="nolimit" type="radio" value="1" onclick="document.getElementById('imp').value = ''; document.getElementById('imp').disabled = true; ">
          Yes ( Overides Above Setting ) <br>
          <input name="nolimit" type="radio" value="0" checked onclick="document.getElementById('imp').value = ''; document.getElementById('imp').disabled = false; ">
          No</td>
      </tr>
    </table>
    <p>
      <input name="submit" type="submit" id="submit" value="Upload!">
    </p>
  </form>
</div>
<? }else{?>
<h1><span>Advertisement Manager - Manage</span>XtraFile :: Admin Panel</h1>
<div class="actionsMenu">
    <a href="ads.php?add=1">
        <div class="item">
            <div class="img" style="background-image:url(../images/small/add.png);"></div>
            <div class="txt">Add </div>
        </div>
    </a> 
</div><br />
<table id="a1" width='850' border='0' align="center" cellPadding='3' cellSpacing='0'  style="border:1px solid #000000;">
  <tr>
    <th width="29%" align=center class='a1'><strong> Name</font></strong>
      </td>
    <th width="19%" align=center class='a1'>Type
    <th width="19%" align=center class='a1'>Impressions
    <th width="17%" align=center class='a1'>Clicks
    <th width="16%" align=center class='a1'><strong>Action</font></strong>
      </td>
  </tr>
  <?
	$sql = "SELECT * FROM ads";
	$result = mysql_query($sql) or die( mysql_error() );
	if ($result){
		while( $row = mysql_fetch_object($result) ){
		
		if($row->status == "1"){
		$a2 =  "0";
		$status = "On";
		}else{
		$a2 = "1";
		$status = "Off";
		
		}
?>
  <tr style='background-color:' onmouseover="this.style.backgroundColor = '#C1DEF0';" onmouseout="this.style.backgroundColor = '';">
    <td height="25" class='a1'><div align="center">
        <?=$row->name?>
      </div></td>
    <td class='a1'><div align="center">
        <?=$row->type?>
      </div></td>
    <td class='a1'><div align="center">
        <?=$row->impressions?>
      </div></td>
    <td class='a1'><div align="center">
        <?=$row->clicks?>
      </div></td>
    <td class='a1'><div align="center"><a href="<?=$PHP_SELF?>?a=<?=$a2?>&step=5&id=<?=$row->id?>"> <img border='0' alt='Ad <?=$status?>' src='../images/actions/Light Bulb (<?=$status?>)_24x24.png' /> </a> <a onclick="return confirm('Are you sure you wish to delete this Advert?');" href="<?=$PHP_SELF?>?step=4&id=<?=$row->id?>"> <img border='0' alt='Delete Ad' src='../images/actions/Close_24x24.png' /> </a> </div></td>
  </tr>
  <?
		}
	}
?>
</table>
<?
}
include('./admin/footer.php');
?>
