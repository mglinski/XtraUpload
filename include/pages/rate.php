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

//** DO NOT EDIT BELOW **//
// EXTRA SECURITY SETTING TO PREVENT DIRECT LINKING
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME']))
{
  // tell people trying to access this file directly goodbye...
  echo"<script> location = '".makeXuLink('index.php', array('p' => 'home'))."';</script>";
  die();
}
//** DO NOT EDIT ABOVE **//

if(!isset($_REQUEST['id']))
{
	echo $lang['rate']['1'];?>
	<script type="text/javascript">
	function check()
	{
	
		if(document.getElementById("id").value.length != '12')
		{
		
			alert('<?=$lang['rate']['2']?>');
			return false;
		}
		return true;
	}
	</script>
	<form action="<?=makeXuLink('index.php', array('p' => 'rate'))?>" onsubmit="return check();" method="post"><?=$lang['rate']['3']?><input type="text" name="id" id="id" />
  <br />
  <input type="submit" name="Submit2" value="<?=$lang['rate']['4']?>" />
</form><?
echo skin_foot();
	die;
}

$sql = "SELECT * FROM files WHERE hash='".txt_clean($_REQUEST['id'])."'";
$qr1 = $db->query($sql,"1");
$num = $db->num($qr1);
if($num == '0')
{
	echo '<br />'.$lang['rate']['5'];
	echo skin_foot(); // Print the footer with blocks
	die;
}
$a = $db->fetch($qr1, "obj");
	
$update_rating = $a->rating_average;
$num_rating = $a->rating_num;
	
if(isset($_POST['valid']) && $_POST['valid'] = "yes")
{
	unset($update_rating);
	$num_rating = $a->rating_num;
	$num_rating++;
	$old_rating = $a->rating_average;
	$update_rating = ($old_rating + intval($_POST['rating']));
	//echo  $num_rating." | ".$old_rating." | ".$_POST['rating']." | ".$update_rating;
	$sql_5 = "UPDATE files SET `rating_average` = '$update_rating', `rating_num` = '$num_rating'  WHERE `hash` ='".txt_clean($_REQUEST['id'])."'";
	$qr5 = $db->query($sql_5,"5");
}
	
?><style type="text/css">
<!--
.style3 {font-weight: bold; font-size: 18px; }
.style4 {font-weight: bold}
-->
</style>

	<div align="center">
    <strong><span class="style3"><?=$a->o_filename?></span><br />
    </strong>
          <br>
  <a href='<?=makeXuLink('index.php', array('p' => 'download', 'hash' => $a->hash))?>'><strong><?=$lang['rate']['9']?></strong></a>
    <br />
    <br />
    <?=$lang['rate']['10']?>
    <? 
		$rating_new = 0;
	  	if(!$num_rating == 0)
	  	{
	  		$rating_new = $update_rating/$num_rating;
	  	}
	   $rating = round($rating_new, 2);
	   
	   echo '<b><font color="';
	   
	   	if($a->rating_num  == "0")
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
	   echo '</b></font>';
	  ?>
    <strong><br />
      </strong><br />
    <div id="2" style="width:230px; border-color:#000000; border-style:solid; border-top-width:1px; border-right-width:1px; border-left-width:1px; border-bottom-width:1px; ">
	<p align="center"><span class="style1"><br /><?=$lang['rate']['13']?></span><?=starRateGen($a->hash,$rating)?></p>
	</div>  
</div>
