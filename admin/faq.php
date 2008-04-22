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

if(isset($_GET['part']))
{
	$part = txt_clean($_GET['part']);
	$act = txt_clean($_GET['act']);
	$submit = (bool)($_GET['submit']);
	$id = intval($_GET['id']);
	echo '<style type="text/css">
<!--
.style2 {font-weight: bold}
-->
</style>
';
	switch($part)
	{
		
		case "section":
			switch($act)
			{
				case "edit":
					if($submit)
					{
						$db->query("UPDATE `faq` SET name='".$_POST['name']."' WHERE id='".$id."'");
						echo '<center><h4 style="color:#009900">Edit Completed Successfully </h4> Transfering you to FAQ Manager Main Page</center><script>function r(){location = \'./faq.php\'}setTimeout(\'r()\',1750);</script><br /><br />';
						log_action('FAQ Section Edited', 'faq:edit', 'The FAQ Section('.$_POST['name'].') was edited', 'ok', 'admin/faq.php');
						include("./admin/footer.php");
						die;
					}
					$f1 = $db->query("SELECT * FROM `faq` WHERE id='".$id."'");
 					$faq = $db->fetch($f1,'obj');
					?>
                    <h1><span>FAQ Manager - Edit</span>XtraFile :: Admin Panel</h1>
                    <div class="actionsMenu">
                        <a href="javascript:history.go(-1)">
                            <div class="item">
                                <div class="img" style="background-image:url(../images/small/back.png);"></div>
                                <div class="txt">Back to Sections</div>
                            </div>
                        </a> 
                    </div><br />
  <form action="faq.php?part=section&act=edit&id=<?=$id?>&submit=1"  method="post">
  <table width="700" border="0" cellspacing="0" cellpadding="5">
    <tr>
      <td width="292"><div align="right"><strong>Section Title: </strong></div></td>
      <td width="402"><input name="name" type="text" size="60" value="<?=$faq->name?>" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" value="Update Item" /></td>
    </tr>
  </table>
  <br />
  </form><?
				break;
				case "new":
					if($submit)
					{
						$db->query("INSERT INTO `faq` (`name`) VALUES('".$_POST['name']."')");
						echo '<center><h4 style="color:#009900">Creation Completed Successfully </h4> Transfering you to FAQ Manager Main Page</center><script>function r(){location = \'./faq.php\'}setTimeout(\'r()\',1750);</script><br /><br />';
						include("./admin/footer.php");
						log_action('FAQ Section Created', 'faq:new', 'The FAQ Section('.$_POST['name'].') was created', 'ok', 'admin/faq.php');
						die;
					}
					?>
                    <h1><span>FAQ Manager - New</span>XtraFile :: Admin Panel</h1>
                    <div class="actionsMenu">
                        <a href="javascript:history.go(-1)">
                            <div class="item">
                                <div class="img" style="background-image:url(../images/small/back.png);"></div>
                                <div class="txt">Back to Sections</div>
                            </div>
                        </a> 
                    </div><br />
  <form action="faq.php?part=section&act=new&submit=1"  method="post">
  <table width="700" border="0" cellspacing="0" cellpadding="5">
    <tr>
      <td width="292"><div align="right"><strong>Section Title: </strong></div></td>
      <td width="402"><input name="name" type="text" size="60" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" value="Update Item" /></td>
    </tr>
  </table>
  <br />
  </form>
					<?
				break;
				case "delete":
					$db->query("DELETE FROM `faq` WHERE id='".$id."'");
					echo '<center><h4 style="color:#009900">Delete Completed Successfully </h4> Transfering you to FAQ Manager Main Page</center><script>function r(){location = \'./faq.php\'}setTimeout(\'r()\',1750);</script><br /><br />';
					log_action('FAQ Section Deleted', 'faq:delete', 'A FAQ Section was deleted', 'ok', 'admin/faq.php');
					include("./admin/footer.php");
					die;
				break;
			}
		break;
		
		case "items":
		case "section":
			switch($act)
			{
				case "edit":
					if($submit)
					{
						$db->query("UPDATE `faq_items` SET name='".$_POST['name']."', answer='".$_POST['answer']."' WHERE id='".$id."'");
						echo '<center><h4 style="color:#009900">Edit Completed Successfully </h4> Transfering you to FAQ Manager Main Page</center><script>function r(){location = \'./faq.php\'}setTimeout(\'r()\',1750);</script><br /><br />';
						log_action('FAQ Item Edited', 'faq:edit', 'The FAQ item('.$_POST['name'].') was edited', 'ok', 'admin/faq.php');
						include("./admin/footer.php");
						die;
					}
					$f1 = $db->query("SELECT * FROM `faq_items` WHERE id='".$id."'");
 					$faq = $db->fetch($f1,'obj');
  					?>
                    <h1><span>FAQ Manager &raquo; Item Manager - Edit</span>XtraFile :: Admin Panel</h1>
<script type="text/javascript">
	$(document).ready(function()
	{
		$('#answer').tinymce();
	});
</script>
					<div class="actionsMenu">
                        <a href="javascript:history.go(-1)">
                            <div class="item">
                                <div class="img" style="background-image:url(../images/small/back.png);"></div>
                                <div class="txt">Back to Items</div>
                            </div>
                        </a> 
                    </div><br />
  <form action="faq.php?part=items&act=edit&id=<?=$id?>&submit=1"  method="post">
  <table width="700" border="0" cellspacing="0" cellpadding="5">
    <tr>
      <td width="292"><div align="right"><strong>Question: </strong></div></td>
      <td width="402"><input name="name" type="text" size="60" value="<?=$faq->name?>" /></td>
    </tr>
    <tr>
      <td><div align="right"><strong>Answer: </strong></div></td>
      <td><textarea name="answer" id="answer" cols="64" rows="8"><?=$faq->answer?></textarea></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" value="Update Item" /></td>
    </tr>
  </table>
  <br />
  </form><?
				break;
				case "new":
					if($submit)
					{
						$db->query("INSERT INTO `faq_items` (`name`,`answer`,`faq`) VALUES('".$_POST['name']."','".$_POST['answer']."', '".intval($_GET['id'])."')");
						echo '<center><h4 style="color:#009900">Creation Completed Successfully </h4> Transfering you to FAQ Manager Main Page</center><script>function r(){location = \'./faq.php\'}setTimeout(\'r()\',1750);</script><br /><br />';
						log_action('FAQ Item Created', 'faq:new', 'The FAQ item('.$_POST['name'].') was created', 'ok', 'admin/faq.php');
						include("./admin/footer.php");
						die;
					}
					?>
                    <h1><span>FAQ Manager &raquo; Item Manager - New</span>XtraFile :: Admin Panel</h1>
<script type="text/javascript">
	$(document).ready(function()
	{
		$('#answer').tinymce();
	});
</script>
					<div class="actionsMenu">
                        <a href="javascript:history.go(-1)">
                            <div class="item">
                                <div class="img" style="background-image:url(../images/small/back.png);"></div>
                                <div class="txt">Back to Itmes</div>
                            </div>
                        </a> 
                    </div><br />
					<form action="faq.php?part=items&act=new&id=<?=$id?>&submit=1" method="post">
  <table width="700" border="0" cellspacing="0" cellpadding="5">
    <tr>
      <td width="292"><div align="right"><strong>Question: </strong></div></td>
      <td width="402"><input name="name" type="text" size="60" /></td>
    </tr>
    <tr>
      <td><div align="right"><strong>Answer: </strong></div></td>
      <td><textarea name="answer" id="answer" cols="64" rows="8"></textarea></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" value="Create New Item" /></td>
    </tr>
  </table>
  <br />
  </form><?
				break;
				case "delete":
					$db->query("DELETE FROM `faq_items` WHERE id='".$id."'");
					echo '<center><h4 style="color:#009900">Delete Completed Successfully </h4> Transfering you to FAQ Manager Main Page</center><script>function r(){location = \'./faq.php\'}setTimeout(\'r()\',1750);</script><br /><br />';
					log_action('FAQ Item Deleted', 'faq:delete', 'A FAQ item was deleted', 'ok', 'admin/faq.php');
					include("./admin/footer.php");
					die;
				break;
				case "manage":
					?>
<h1><span>FAQ Manager &raquo; Item Manager</span>XtraFile :: Admin Panel</h1>
<div class="actionsMenu">
    <a href="faq.php?part=items&act=new&id=<?=$id?>">
        <div class="item">
            <div class="img" style="background-image:url(../images/small/new.png);"></div>
            <div class="txt">Add New Item</div>
        </div>
    </a>
    <a href="faq.php">
        <div class="item">
            <div class="img" style="background-image:url(../images/small/back.png);"></div>
            <div class="txt">Back to Main</div>
        </div>
    </a> 
</div><br />
<table width="851" height="62"  style="border:#000 thin solid" cellpadding="4" cellspacing="0" align="center">
  <tr>
    <td width="195"><div align="center"><strong>Question</strong></div></td>
    <td width="391" height="31"><div align="center"><strong>Answer</strong></div></td>
    <td width="233"><div align="center"><strong>Actions
    </strong></div>
    <div align="center"></div></td>
  </tr>
  <? 
  $f1 = $db->query("SELECT * FROM `faq_items` WHERE faq='".$id."'");
  while($faq = $db->fetch($f1,'obj'))
  {?>
  <tr style='background-color:' onmouseover="this.style.backgroundColor = '#C1DEF0';" onmouseout="this.style.backgroundColor = '';">
    <td><div align="center">
      <?=$faq->name?>
    </div></td>
    <td height="21"><div align="center"><?=$faq->answer?></div></td>
    <td>
    	<div align="center">
    		<a href="./faq.php?part=items&act=edit&id=<?=$faq->id?>">
    			<img border='0' alt='Edit Item'  src='../images/actions/Edit_24x24.png' />
    		</a>
    		<a href="./faq.php?part=items&act=delete&id=<?=$faq->id?>" onclick="return confirm('Are you sure you want to delete this?')">
    			<img border='0' alt='Delete Item'  src='../images/actions/Close_24x24.png' />
    		</a>
    	</div>
    </td>
  </tr>
  <? }?>
</table>
<?
				break;
			}
		break;
		
	}

}
else
{

?>
<style type="text/css">
<!--
.style2 {font-size: 24px}
-->
</style>
<h1><span>FAQ Manager</span>XtraFile :: Admin Panel</h1>
<div class="actionsMenu">
    <a href="faq.php?part=section&amp;act=new">
        <div class="item">
            <div class="img" style="background-image:url(../images/small/new.png);"></div>
            <div class="txt">Add New Section</div>
        </div>
    </a>
</div><br />
<table width="700" height="44" style="border:#000 thin solid" cellpadding="4" cellspacing="0" align="center">
  <tr>
    <th width="448" height="21"><div align="center">Name</div></th>
    <th width="230"><div align="center">Actions</div></th>
  </tr>
  <? 
  $f1 = $db->query("SELECT * FROM `faq` ORDER BY `pos`");
  while($faq = $db->fetch($f1,'obj'))
  {?>
  <tr style='background-color:' onmouseover="this.style.backgroundColor = '#C1DEF0';" onmouseout="this.style.backgroundColor = '';">
    <td height="21"><div align="center"><?=$faq->name?></div></td>
    <td>
    	<div align="center">
        	<a href="./faq.php?part=items&act=manage&id=<?=$faq->id?>">
            	<img border='0' alt='Manage Section Items'  src='../images/actions/View_24x24.png' />
            </a>
            
            <a href="./faq.php?part=section&act=edit&id=<?=$faq->id?>">
            	<img border='0' alt='Edit Section'  src='../images/actions/Edit_24x24.png' />
            </a>
            
            <a href="./faq.php?part=section&act=delete&id=<?=$faq->id?>" onclick="return confirm('Are you SURE you want to delete this Section?')">
            	<img border='0' alt='Delete Section'  src='../images/actions/Close_24x24.png' />
            </a>
        </div>
    </td>
  </tr>
  <? }?>
</table>
<?
}
require_once("./admin/footer.php");
?>