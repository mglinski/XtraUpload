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

// Thumbnail Viewer
include("./include/init.php");
echo $kernel->tpl->display('site_header.tpl');
$file = str_replace('/','',$_GET['file']);
$file = explode('.',$file);
$file = $file[0];
$sql = "SELECT * FROM files WHERE `hash` = '".txt_clean($file)."'";
$qr1 = $db->query($sql);
$ret = $db->fetch($qr1);
$file = $ret->o_filename;
$size = getimagesize($ret->server.'/imagedirect.php?file='.$_GET['file']);
$srcWidth=$size[0];
$srcHeight=$size[1];
$srcHeightNew=$size[1];
$srcWidthNew=$size[0];
while($srcWidthNew >= 500){$srcWidthNew /= 2;}
while($srcHeightNew >= 500){$srcHeightNew /= 2;}

//Rating PHP Code
$update_rating = $ret->rating_average;
$num_rating = $ret->rating_num;
	
if(isset($_POST['valid']) && $_POST['valid'] = "yes")
{
	unset($update_rating);
	$num_rating = $ret->rating_num;
	$num_rating++;
	$old_rating = $ret->rating_average;
	$update_rating = ($old_rating + intval($_POST['rating']));
	//echo  $num_rating." | ".$old_rating." | ".$_POST['rating']." | ".$update_rating;
	$sql_5 = "UPDATE files SET `rating_average` = '$update_rating', `rating_num` = '$num_rating'  WHERE `hash` ='".$ret->hash."'";
	$qr5 = $db->query($sql_5,"5");
}
	
?>
<script>
var imagePhpResized = false;
function doResize(div)
{
	if(imagePhpResized)
	{
		div.width = '<?=$srcWidthNew?>';
		div.height = '<?=$srcHeightNew?>';
		imagePhpResized = false;
	}
	else
	{
		div.width = '<?=$srcWidth?>';
		div.height = '<?=$srcHeight?>';
		imagePhpResized = true;
	}
}
</script>
<div align="center">
  <span style="font-size: 24px">Image 
  <?=$file?>
  </span><br />
  <?=get_ads()?><br />
  <img border="0" onclick="doResize(this)" style="cursor:pointer;" width="<?=$srcWidthNew?>" height="<?=$srcHeightNew?>" alt="<?=$file?>, Click to Toggle Expansion" src="<?=makeXuLink('imagedirect.php', 'file='.str_replace('/','',$_GET['file']), $ret->server)?>" /><br />
(Click to Toggle Expansion)<br />
<br />
<br />
<style type="text/css">
<!--
.style3 {font-weight: bold; font-size: 18px; }
.style4 {font-weight: bold}
-->
</style>
<font size="4">
    <?=$lang['rate']['10']?>
    <? 
		$rating_new = 0;
	  	if(!$num_rating == 0)
	  	{
	  		$rating_new = $update_rating/$num_rating;
	  	}
	   $rating = round($rating_new, 2);
	   
	   echo '<b><font color="';
	   
	   	if($ret->rating_num  == "0")
		{
	   		$rating = $lang['rate']['11'];
	   	}else{
	   
	   		if($rating <= 4){
	   			echo "red";
	   		}else if($rating <= 7){
	   			echo "orange";
			} else  if($rating <= 7.1){
				echo "green";
			} 
		}
	   
	   echo '">';
	   echo $rating;
	   echo '</b></font></font>';
	  ?>
    <strong><br />
      </strong><br />
    <div id="2" style="width:230px; border-color:#000000; border-style:solid; border-top-width:1px; border-right-width:1px; border-left-width:1px; border-bottom-width:1px; ">
		<center>
			<span class="style1">
				<br /><font size="4"><?=$lang['rate']['13']?></font>
			</span>
			<?=starRateGen($ret->hash,$rating)?>
		<center>
	</div>  
  <?=get_ads()?><br />
  <br />
</div>
<?
echo $kernel->tpl->display('site_footer.tpl');
?>