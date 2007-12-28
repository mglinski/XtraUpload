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


if($_GET['edit'])
{
	if($_POST['submit'] == 'Submit Changes')
	{
	
		$block = $_POST['block'];
		$title = txt_clean($_POST['title']);
		$author = txt_clean($_POST['author']);

		$db->query("UPDATE news SET
		`title` = '".$title."',
		`news` = '".$block."',
		`author` = '".$author."'
		WHERE id='".intval($_GET['news'])."'");
		echo "<center><font color='#0000FF' size='4'> News Article Edited.<br />Please wait while you are transfered.<script>function r(){location = './news.php';}setTimeout('r()',1750);</script></font></center><br /><br />";
		log_action('News Edited', 'news:edit', 'News article was edited', 'ok', 'admin/news.php');
		include('./admin/footer.php');
		die;
	}

	$c = $db->query("select * from news where id='".intval($_GET['news'])."' LIMIT 1");
	$a = $db->fetch($c,'obj');
	
	?>
    <h1><span>News Manager - Edit Article</span>XtraFile :: Admin Panel</h1>
<div class="actionsMenu">
    <a href="news.php">
        <div class="item">
            <div class="img" style="background-image:url(../images/small/back.png);"></div>
            <div class="txt">Return To News Manager</div>
        </div>
    </a> 
</div>
<div align="center">
<br />
</div>
      <form name="form1" enctype="multipart/form-data" method="post">
        <table width="527" height="177" border="0" align="center" cellpadding="5" cellspacing="0">
          <tr>
            <td width="99"><div align="right">Title: </div></td>
            <td width="408"><div align="left">
              <input name="title" type="text" id="name" size="50" value="<?=$a->title?>">
            </div></td>
          </tr>
          
          <tr>
            <td><div align="right">Article:</div></td>
            <td><textarea name="block" cols="60" rows='12' id="elm1"><?=$a->news?></textarea></td>
          </tr>
          <tr>
            <td><div align="right"><span class="style1">Autho</span>r:</div></td>
            <td><div align="left">
              <input name="author" type="text" id="link" size="50" value="<?=$a->author?>">
            </div></td>
          </tr>
        </table>
        <p align="center">          <input name="submit" type="submit" id="submit" value="Submit Changes">
        </p>
      </form><?
}
else
{
	if($_POST['submit'])
	{
		$block = $_POST['block'];
		$title = txt_clean($_POST['title']);
		$author = txt_clean($_POST['author']);
		$db->query("INSERT INTO news (title,news,date,author) VALUES ('$title','$block','".date("F j, Y, g:i a")."','$author')", 'insert_1');
		log_action('News Added', 'news:add', 'News article was added', 'ok', 'admin/news.php');
	}

	$step = $_REQUEST['step'];
	$id = $_REQUEST['id'];

	if (!$step)
	{
		$step = 1;
	}
	switch($step)
	{
		
		case "4":// delete users
			$sql1 = "DELETE FROM `news` WHERE `id` = '$id' LIMIT 1 ";
			log_action('News deleted', 'news:delete', 'News article was deleted', 'ok', 'admin/news.php');
			$db->query($sql1);
		break;
			
		default:// user index
			
		break;
	}
?>
<style type="text/css">
<!--
.style1 {font-size: 16px}
.style2 {font-size: 24px}
.style3 {font-size: 18px}
.style4 {font-weight: bold}
-->
</style>
<?php if(isset($_GET['add']))
{ ?>
<h1><span>Add News</span>XtraFile :: Admin Panel</h1>
<div class="actionsMenu">
    <a href="news.php">
        <div class="item">
            <div class="img" style="background-image:url(../images/small/back.png);"></div>
            <div class="txt">Return To News Manager</div>
        </div>
    </a> 
</div>
<br />
<script type="text/javascript">
	$(document).ready(function()
	{
		$('#elm1').tinymce();
	});
</script>
<div align="center"><span style="font-size:18px">Add a News Article</span> <br />
	  <br>
      <form name="form1" enctype="multipart/form-data" method="post" action="">
        <table width="527" height="177" border="0" align="center" cellpadding="5" cellspacing="0">
          <tr>
            <td width="187"><div align="right">Title: </div></td>
            <td width="572"><div align="left">
              <input name="title" type="text" id="name" size="50">
            </div></td>
          </tr>
          
          <tr>
            <td><div align="right">Article:</div></td>
            <td><textarea name="block" cols="60" rows='12' id="elm1"></textarea></td>
          </tr>
          <tr>
            <td><div align="right">Author:</div></td>
            <td><div align="left">
              <input name="author" type="text" id="link" size="50">
            </div></td>
          </tr>
        </table>
        <p>          <input name="submit" type="submit" id="submit" value="Add News">
        </p>
      </form>
</div>
<?php }else{?>
<h1><span>News</span>XtraFile :: Admin Panel</h1>
<div class="actionsMenu">
    <a href="news.php?add">
        <div class="item">
            <div class="img" style="background-image:url(../images/small/add.png);"></div>
            <div class="txt">Add News</div>
        </div>
    </a> 
</div><br />
<table id="a1" width='892' border='0' align="center" cellPadding='3' cellSpacing='0' style="border:1px solid #000000;">
<tr>
	<th width="26%" align=center class='a1'><strong>
	  Title</strong>
	<th width="45%" align=center class='a1'>Article
	<th width="15%" align=center class='a1'>Author
	<th width="14%" align=center class='a1'><strong>Action</font></strong></td>
</tr>
<?
	$sql = "SELECT * FROM news";
	$result = mysql_query($sql) or die( mysql_error() );
	if ($result){
		while( $row = mysql_fetch_object($result) ){
?>
			<tr style='background-color:' onmouseover="this.style.backgroundColor = '#C1DEF0';" onmouseout="this.style.backgroundColor = '';">
				<td height="25" class='a1'>
			    <div align="center"><?=$row->title?></div></td>
				<td class='a1'><div align="center">
				  <?=$row->news?>
				</div></td>
				<td class='a1'>			    <div align="center">
				  <?=$row->author?>
</div></td>
				<td class='a1'>
						
				  <div align="center">
                  <a href="<?=$PHP_SELF?>?edit=1&amp;news=<?=$row->id?>">
                  	<img border='0' alt='Edit News Article' src='../images/actions/Edit_24x24.png' />
                  </a>
                  <a onclick="return confirm('Are you sure you wish to delete this News Article?');" href="<?=$PHP_SELF?>?step=4&id=<?=$row->id?>">
                  	<img border='0' alt='Delete News' src='../images/actions/Close_24x24.png' />
                  </a> </div></td>
			</tr>
<?
		}
	}
?></table>
<?php }
}
include('./admin/footer.php');
?>